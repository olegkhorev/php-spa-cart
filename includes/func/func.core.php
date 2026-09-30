<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function func_setcookie($name, $value, $expire = 0) {
	global $cookie_domain;
	if (!$expire)
		$expire = time() + 3600 * 24 * 365;

	setcookie($name, $value, $expire, "/", ".".$cookie_domain);
}

function redirect($location, $specified = false, $is_301 = false) {
	global $current_location, $is_ajax;
	if ($location == '/')
		$location = '';

	if (!$specified)
		$location = $current_location.'/'.$location;

	if (ADMIN_AREA && $is_ajax) {
		header('where_redirect: '.$location);
		exit;
	}

	if ($is_301)
		header("HTTP/1.1 301 Moved Permanently");

	header("Location: ".$location);
    echo "<meta http-equiv=\"Refresh\" content=\"0;URL=" . $location ."\" />";
    flush();
	exit;
}

function arrayMap($fn, $arr) {
    $rarr = array();
    foreach ($arr as $k=>$v)
        $rarr[$k] = is_array($v) ? arrayMap($fn, $v) : $fn($v);

    return $rarr;
}

function get_include_contents($filename) {
	global $template, $login, $user, $lng, $current_location, $config, $design_mode, $_SESSION, $company_name, $company_slogan, $company_email, $_GET, $warehouse_enabled;
	extract($_SESSION);
	extract($template);
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }

    return false;
}

function get_template_contents($filename, $force = false) {
	global $lng, $db, $templates, $config, $device, $warehouse_enabled, $translate_mode, $_SESSION;

	$cache = SITE_ROOT.'/var/cache/'.$lng;
	if (!is_dir($cache)) {
		mkdir($cache);
		mkdir($cache.'/js');
	}

	if ($_SESSION['current_theme'])
		$custom_theme = $_SESSION['current_theme'];
	else
		$custom_theme = $db->row("SELECT * FROM modules WHERE enabled='1' AND template<>'' ORDER BY pos");

	if ($custom_theme) {
		$theme_filename = 'themes/'.$custom_theme['author'].'/'.$custom_theme['module'].'/'.$filename;
		if (file_exists(SITE_ROOT.'/templates/'.$theme_filename))
			$filename = $theme_filename;
	}

	if (!file_exists(SITE_ROOT.'/templates/'.$filename))
		return false;

	if (!file_exists($cache.'/'.$filename) || $templates[$lng][$filename] != filemtime(SITE_ROOT.'/templates/'.$filename) || $force || DEVELOPMENT) {
		$content = file_get_contents(SITE_ROOT.'/templates/'.$filename);
		$content = str_replace("<?php", "<?php ", $content);

		# Variables
		preg_match_all("/\{[[:punct:]](.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$pass = substr($matches['0'][$k], 0, 2);
				if ($pass == '{$')
					$content = str_replace($v, '<?php echo $'.$matches['1'][$k].';?>', $content);
			}
		}

		# Assign
		preg_match_all("/\{assign (.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$content = str_replace($v, '<?php '.$matches['1'][$k].'; ?>', $content);
			}
		}

		# Assign
		preg_match_all("/\{php (.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$content = str_replace($v, '<?php '.$matches['1'][$k].'; ?>', $content);
			}
		}

		$content = str_replace('{php}', '<?php ', $content);
		$content = str_replace('{/php}', ' ?>', $content);
		# Price
		preg_match_all("/\{price (.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$content = str_replace($v, '<?php echo \'<span class="currency">\'.currency_symbol().\'</span>\'.price_format_currency('.$matches['1'][$k].'); ?>', $content);
			}
		}

		# Weight
		preg_match_all("/\{weight (.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$content = str_replace($v, '<?php echo price_format('.$matches['1'][$k].').\' <span class="weight-symbol">'.$config['General']['weight_symbol'].'</span>\'; ?>', $content);
			}
		}

		# If, else, elseif
		preg_match_all("/\{if (.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$content = str_replace($v, '<?php if ('.$matches['1'][$k].') {?>', $content);
			}
		}

		preg_match_all("/\{elseif (.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$content = str_replace($v, '<?php } elseif ('.$matches['1'][$k].') {?>', $content);
			}
		}

		$content = str_replace('{/if}', '<?php } ?>', $content);
		$content = str_replace("{else}", "<?php } else { ?>", $content);

		# Foreach
		preg_match_all("/\{foreach (.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$content = str_replace($v, '<?php foreach ('.$matches['1'][$k].') {?>', $content);
			}
		}

		$content = str_replace("{/foreach}", "<?php } ?>", $content);

		# For
		preg_match_all("/\{for (.*?)\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				$content = str_replace($v, '<?php for ('.$matches['1'][$k].') {?>', $content);
			}
		}

		$content = str_replace("{/for}", "<?php } ?>", $content);

		# Comment code
		$content = str_replace('{*', '<?php /* ?>', $content);
		$content = str_replace('*}', '<?php */ ?>', $content);

		# Delimiters
		$content = str_replace('{ldelim}', '{', $content);
		$content = str_replace('{rdelim}', '}', $content);

		# Include
		preg_match_all("/\{include=\"(.*?)\"\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				get_template_contents($matches['1'][$k], true);
				$content = str_replace($v, '<?php include SITE_ROOT."/var/cache/'.$lng.'/'.$matches['1'][$k].'";?>', $content);
			}
		}

        # Language
		preg_match_all("/\{lng\[(.*?)\]\}/", $content, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k=>$v) {
				if (strstr($matches['1'][$k], "|")) {
					$functions = explode("|", $matches['1'][$k]);
					$to = $functions['0'];
					unset($functions['0']);
				} else {
					$to = $matches['1'][$k];
					$functions = array();
				}

				$word = $to;
				$tmp = $db->field("SELECT translation FROM languages WHERE lng='".$lng."' AND word='".addslashes($to)."'");
				if (empty($tmp)) {
					$db->query("INSERT INTO languages SET lng='".$lng."', word='".addslashes($to)."', translation='".addslashes($to)."'");
				} else {
					if (!empty($functions)) {
						if (in_array('lower', $functions)) {
							$tmp = strtolower($tmp);
						}

						if (in_array('js', $functions)) {
							$tmp = str_replace('"', '\"', $tmp);
							$tmp = str_replace("\n", '', $tmp);
							$tmp = str_replace("\r", '', $tmp);
						}

						if (in_array('escape', $functions)) {
							$tmp = str_replace('"', '\"', $tmp);
						}
					}

					$to = $tmp;
				}

				if ($translate_mode) {
					$to = $to.' <b class="translate"><span class="hidden word">'.$word.'</span><span class="hidden translate-phrase">'.$to.'</span>(Edit)</b>';
					$content = str_replace($matches['0'][$k], $to, $content);
				} else {
					$content = str_replace($matches['0'][$k], $to, $content);
				}
			}
		}

		$content = str_replace("else", "else ", $content);
		$tmp = explode("/", $filename);
		$add = '';
		foreach ($tmp as $v) {
			if (!is_dir($cache.'/'.$add.$v) && is_dir(SITE_ROOT.'/templates/'.$add.$v)) {
				mkdir($cache.'/'.$add.$v);
				copy(SITE_ROOT . '/includes/index_file', $cache.'/'.$add.$v.'/index.php');
			}

			$add .= $v.'/';
		}

		$fp = fopen($cache.'/'.$filename, 'w');
		fputs($fp, $content);
		fclose($fp);
		$already_in_table = $db->row("SELECT * FROM templates WHERE lng='".$lng."' AND template='".$filename."'");
		if ($already_in_table)
			$db->query("UPDATE templates SET time='".filemtime($file_path)."' WHERE lng='".$lng."' AND template='".$filename."'");
		else
			$db->query("REPLACE INTO templates SET lng='".$lng."', template='".$filename."', time='".filemtime(SITE_ROOT.'/templates/'.$filename)."'");
	}

	if (!$force)
		return get_include_contents($cache.'/'.$filename);
}

function lng($word, $replace = array()) {
	global $db, $lng;

	if ($word == 'Site title' || $word == 'Site description') {
		$translation = $db->row("SELECT translation, id FROM languages WHERE lng='en' AND word='".addslashes($word)."'");
	} else
		$translation = $db->row("SELECT translation, id FROM languages WHERE lng='".$lng."' AND word='".addslashes($word)."'");

	if (empty($translation['id'])) {
		$db->query("INSERT INTO languages SET lng='".$lng."', word='".addslashes($word)."', translation='".addslashes($word)."'");
		$translation = $word;
	} else
		$translation = $translation['translation'];

	if (!empty($replace))
		foreach ($replace as $k=>$v)
			$translation = str_replace('{'.$k.'}', $v, $translation);

	return $translation;
}

function escape($text, $to_escape = 0) {
	if ($to_escape == 1)
		return str_replace("'", "\'", $text);
	elseif ($to_escape == 2)
		return str_replace('"', '&quot;', $text);
	elseif ($to_escape == 3) {
		$text = str_replace("'", "\'", $text);
		return str_replace('"', '\"', $text);
	} else
		return str_replace('"', '&quot;', $text);
}

function price_format($value) {
    return sprintf("%.2f", round((double)$value + 0.00000000001, 2));
}

function price_format_currency($value) {
	global $_SESSION;
	if ($_SESSION['current_currency'])
	    return sprintf("%.2f", round((((double)$value + 0.00000000001) * $_SESSION['current_currency']['rate']), 2));
	else
	    return sprintf("%.2f", round((double)$value + 0.00000000001, 2));
}

function func_eol2br($text) {
    return $text == strip_tags($text)
        ? str_replace("\n", "<br />", $text)
        : $text;
}

function func_mail($name, $email, $from = '', $subject, $message, $replyto = '', $attachments = '') {
	global $company_email, $email_replyto, $config;
	if (DEMO) {
		return;
	}

	if ($replyto)
		$email_replyto = $replyto;

	if (!$from)
		$from = $company_email;

	try {
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->isHTML(true);                       // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $message;
		if ($attachments) {
			foreach ($attachments as $v) {
				$mail->addAttachment($v['file_path']);         //Add attachments
			}
		}

		$mail->setFrom($from, $config['Company']['company_name']);
		$mail->addAddress($email, $name);     //Add a recipient
		if ($email_replyto)
			$mail->addReplyTo($email_replyto, '');

		$mail->send();
	} catch (\Throwable $t) {
		echo $t;
	} catch (\Exception $e) {
		echo $e;
	}
}

function func_load($func_name) {
	global $qloaded_functions;

    $names = func_get_args();
    foreach ($names as $n) {
        if (isset($qloaded_functions[$n]))
            continue;

        $n = str_replace('..', '', $n);
        $f = SITE_ROOT.'/includes/func/func.' . $n . '.php';
        if (file_exists($f))
            require_once $f;

        $qloaded_functions[$n] = 1;
    }
}

function func_login($userid) {
	global $db, $_SESSION, $login, $social_login;

	$_SESSION['login'] = $login = $userid;
	$pswd = $db->field("SELECT pswd FROM users_remember WHERE userid=".$login."");
	if (!$pswd) {
		$salt = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCD!@#^&&*%*($)*@#($%*#%)-=.,;\'][EFGHIJKLMNOPQRSTUVWXYZ0123456789' ), 0, 8 );
		$pswd = md5($salt.$login.$_SERVER['REMOTE_ADDR'].$salt.time().rand(0,100).$salt);
		$db->query("REPLACE INTO users_remember SET userid=".$login.", pswd='".addslashes($pswd)."'");
	}

	func_setcookie('remember', $pswd);
   	if (!empty($social_login['profile']['identifier']))
		$db->query("INSERT INTO users_social_login SET userid='".$userid."', identifier='".addslashes($social_login['profile']['identifier'])."'");

	$_SESSION['social_login'] = '';
}

function func_check_cleanurl($url) {
    if (!is_string($url)) {
        return false;
    }

    if (empty($url) || strlen($url) > 250) {
        return false;
    }

	$regexp = '^([a-zA-Z0-9_.-]{1}|[a-zA-Z0-9_.-][a-zA-Z0-9_.\/-]{0,248}[a-zA-Z0-9_.-])$';

    if (!preg_match('/' . $regexp . '/D', $url)) {
        return false;
    }

    if (preg_match('/\.html$/iD', $url)) {
        return false;
    }

	return true;
}

function func_trademark($string) {
    if (strpos($string, '##') === false)
        return $string;

	$reg = "&#174;";
	$sm = "<sup>SM</sup>";
	$tm = "<sup>TM</sup>";
    $result = str_replace("##R##", $reg, trim($string));
    $result = str_replace("##SM##", $sm, $result);
    $result = str_replace("##TM##", $tm, $result);

    return $result;
}

function func_array_empty($data) {
    if (empty($data))
        return true;

    if (!is_array($data))
        return empty($data);

    foreach ($data as $v) {
        if (is_array($v)) {
            if (!func_array_empty($v))
                return false;
        } elseif (!empty($v))
            return false;
    }

    return true;
}

function func_get_state($state_code, $country_code) {
    global $db;

    $state_name = $db->field("SELECT state FROM states WHERE country_code='".addslashes($country_code)."' AND code='".addslashes($state_code)."'");

    return $state_name ? $state_name : $state_code;
}

function func_get_country($country_code) {
    global $db;

    $country_name = $db->field("SELECT country FROM countries WHERE code='".addslashes($country_code)."'");

    return $country_name ? $country_name : $country_code;
}

function func_optimize_photo($productid) {
	global $db;
	$photoid = $db->field("SELECT photoid FROM products_photos WHERE productid=".$productid." ORDER BY pos, photoid DESC");
	if (!$photoid)
		$photoid = 0;

	$db->query("UPDATE products SET photoid=".$photoid." WHERE productid=".$productid);
}

function func_check_checkout() {
	global $config, $cart;
	if ($config['General']['minimal_order_amount'] > 0 && $cart['subtotal'] < $config['General']['minimal_order_amount'])
		return lng('You cannot order below ').$config['General']['currency_symbol'].price_format($config['General']['minimal_order_amount']);

	if ($config['General']['maximum_order_amount'] > 0 && $cart['subtotal'] > $config['General']['maximum_order_amount'])
		return lng('You cannot order more than ').$config['General']['currency_symbol'].price_format($config['General']['maximum_order_amount']);

	if ($config['General']['maximum_order_items'] > 0) {
		$quantity = 0;
		foreach ($cart['products'] as $v)
			$quantity += $v['quantity'];

		if ($quantity > $config['General']['maximum_order_items'])
			return lng('You cannot order items quantity more than ').$config['General']['maximum_order_items'];
	}

	return 1;
}

    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }

function is_url($url) {
	if (filter_var($url, FILTER_VALIDATE_URL) === FALSE)
		return false;

	return true;
}

function func_get_ajax_css() {
	$array = array();
	$array[] = 'style';
	$array[] = 'blog';
	$array[] = 'static';
	$array[] = 'banners';
	$array[] = 'home';
	$array[] = 'category';
	$array[] = 'products';
	$array[] = 'popup';
	$array[] = 'product';
	$array[] = 'cart';
	$array[] = 'checkout';
	$array[] = 'register';
	$array[] = 'help';
	$array[] = 'testimonials';
	$array[] = 'news';
	$array[] = 'blog';
	$array[] = 'brands';
	$array[] = 'category';

	return $array;
}

function func_get_ajax_js() {
	$array = array();
	$array[] = 'jquery.ui.touch-punch.min';
	$array[] = 'scripts';
	$array[] = 'blog_bb';
	$array[] = 'banners';
	$array[] = 'home';
	$array[] = 'category';
	$array[] = 'products';
	$array[] = 'popup';
	$array[] = 'jquery.zoom.min';
	$array[] = 'product';
	$array[] = 'cart';
	$array[] = 'states';
	$array[] = 'checkout';
	$array[] = 'checkout';
	$array[] = 'testimonials';
	$array[] = 'ticket';

	return $array;
}

function func_get_modules_ajax_css() {
	global $db, $_SESSION;

	$array = [];
	$modules = $db->all("SELECT * FROM modules WHERE enabled=1 ORDER BY pos");
	if ($_SESSION['current_theme'])
		$modules[] = $_SESSION['current_theme'];

	foreach ($modules as $v) {
		$array[] = $v['author'].'/'.$v['module'];
	}

	return $array;
}

function func_get_modules_ajax_js() {
	global $db, $_SESSION;

	$array = [];
	$modules = $db->all("SELECT * FROM modules WHERE enabled=1 ORDER BY pos");
	if ($_SESSION['current_theme'])
		$modules[] = $_SESSION['current_theme'];

	foreach ($modules as $v) {
		$array[] = $v['author'].'/'.$v['module'];
	}

	return $array;
}

function func_put_css_content($from_file, $to_file, $template_var_name, $template_var, $force_parse = false) {
	global $db, $templates;

	if (!file_exists($to_file) || $templates[$template_var][$template_var_name] != filemtime($from_file) || DEVELOPMENT || $force_parse) {
		$content = file_get_contents($from_file);
		file_put_contents($to_file, $content);
		$exists = $db->field("SELECT id FROM templates WHERE lng='".$template_var."' AND template='".$template_var_name."'");
		if ($exists)
			$db->query("UPDATE templates SET time='".filemtime($from_file)."' WHERE lng='".$template_var."' AND template='".$template_var_name."'");
		else
			$db->query("INSERT INTO templates SET lng='".$template_var."', template='".$template_var_name."', time='".filemtime($from_file)."'");
	}
}

function func_put_javascript_content($from_file, $to_file, $template_var_name, $template_var, $force_parse = false, $is_module_script = false) {
	global $db, $templates, $lng;

	if (!file_exists($to_file) || $templates[$template_var][$template_var_name] != filemtime($from_file) || DEVELOPMENT || $force_parse) {
		$script = file_get_contents($from_file);
		preg_match_all("/\{lng\[(.*?)\]\}/", $script, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k2=>$v2) {
				$to = $matches['1'][$k2];
				$tmp = $db->field("SELECT translation FROM languages WHERE lng='".$lng."' AND word='".addslashes($to)."'");
				if (empty($tmp)) {
					$db->query("INSERT INTO languages SET lng='".$lng."', word='".addslashes($to)."', translation='".addslashes($to)."'");
					$script = str_replace($v2, $to, $script);
				} else {
					$tmp = str_replace('"', '\"', $tmp);
					$script = str_replace($v2, $tmp, $script);
				}
			}
		}

		$packed = $script;
		if ($v == 'jquery.min') {
		} elseif ($v == 'jquery.zoom.min') {
			$packed = '/*!Zoom v1.7.11 - 2013-11-12	Enlarge images on click or mouseover.	(c) 2013 Jack Moore - http://www.jacklmoore.com/zoom	license: http://www.opensource.org/licenses/mit-license.php*/'.$packed;
		} elseif ($v == 'jquery.ui.sortable') {
			$packed = '/*! jQuery UI Sortable 1.10.2
* http://jqueryui.com
* Copyright 2013 jQuery Foundation and other contributors Licensed MIT */'.$packed;
		} elseif ($v == 'jquery-ui.min') {
			$packed = '/*! jQuery UI
* http://jqueryui.com
* Copyright (c) 2013 jQuery Foundation and other contributors Licensed MIT */'.$packed;
		} elseif ($v == 'scroll') {
			$packed = '/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 *
 * Requires: 1.2.2+
 */
'.$packed;
		} elseif ($v == 'jquery.gradientPicker') {
			$packed = '/**
@author Matt Crinklaw-Vogt (tantaman)
*/'.$packed;
		} elseif ($v == 'jquery.ui.draggable') {
			$packed = '/*! jQuery UI Draggable 1.10.2
* http://jqueryui.com
* Copyright 2013 jQuery Foundation and other contributors Licensed MIT */'.$packed;
		} elseif ($v == 'colorpicker') {
			$packed = '/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 *
 * Dual licensed under the MIT and GPL licenses
 *
 */'.$packed;
		}

		file_put_contents($to_file, $packed);
		$exists = $db->field("SELECT id FROM templates WHERE lng='".$template_var."' AND template='".$template_var_name."'");
		if ($exists)
			$db->query("UPDATE templates SET time='".filemtime($from_file)."' WHERE lng='".$template_var."' AND template='".$template_var_name."'");
		else {
			$db->query("INSERT INTO templates SET lng='".$template_var."', template='".$template_var_name."', time='".filemtime($from_file)."'");
		}
	}
}

function func_save_cart() {
	global $db, $_SESSION, $userinfo;

	if ($_SESSION['cart']) {
		if ($_SESSION['login']) {
			$db->query("DELETE FROM users_carts WHERE email='".addslashes($userinfo['email'])."'");
			$db->query("REPLACE INTO users_carts SET userid='".$_SESSION['login']."', cart='".addslashes(serialize($_SESSION['cart']))."', date='".time()."', reminded_1=0, reminded_2=0");
		} elseif ($_SESSION['user'] && $_SESSION['user']['email']) {
			$db->query("REPLACE INTO users_carts SET email='".addslashes($_SESSION['user']['email'])."', cart='".addslashes(serialize($_SESSION['cart']))."', date='".time()."', reminded_1=0, reminded_2=0");
		}
	}
}

function func_remove_cart() {
	global $db, $_SESSION;

	if (!$_SESSION['cart']) {
		if ($_SESSION['login']) {
			$db->query("DELETE FROM users_carts WHERE userid='".$_SESSION['login']."'");
		} elseif ($_SESSION['user']['email']) {
			$db->query("DELETE FROM users_carts WHERE email='".addslashes($_SESSION['user']['email'])."'");
		}
	}
}

function func_giftcert_generate() {
    global $db;
    while (true) {
        $gcid = substr(strtoupper(md5(uniqid(rand()))), 0, 16);
        if ($db->field("SELECT COUNT(gcid) FROM gift_cards WHERE gcid='$gcid'") == 0)
            break;
    }

    return $gcid;
}

function currency_symbol() {
	global $config;

	return $config['General']['currency_symbol'];
}

function func_filter_id($c) {
   $c = str_replace(' ', '-', $c);
   return preg_replace('/[^A-Za-z0-9\-]/', '', $c);
}

function func_average_rating($product) {
	global $db;
	$average = $db->field("SELECT AVG(rating) FROM reviews WHERE productid='".$product['productid']."' AND status='1'");
	echo round($average * 100 / 5);
}

function func_copy_folder($source, $destination) {
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }

    $dirIterator = new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS);
    $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

    foreach ($iterator as $item) {
        $targetPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

        if ($item->isDir()) {
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
        } else {
            copy($item->getRealPath(), $targetPath);
        }
    }
}