<?php
/**
 * Functions that need to be loaded on every request.
 */

error_reporting(E_ERROR | E_PARSE);
ini_set('memory_limit', '128M');

ini_set('magic_quotes_runtime', '0');
setlocale(LC_ALL, 'C');

define('REPLACE_FLAGS', ENT_SUBSTITUTE);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pass = array('pswd', 'new_pswd', 'password', 'descr', 'fulldescr', 'content', 'message', 'data', 'lbl', 'translate');
	foreach ($_POST as $k=>$v) {
		if (in_array($k, $pass))
			continue;

		if (is_array($v)) {
			foreach ($v as $k2=>$v2) {
				if (is_array($v2)) {
					foreach ($v2 as $k3=>$v3) {
						if (is_array($v3)) {
							foreach ($v3 as $k4=>$v4)
								$_POST[$k][$k2][$k3][$k4] = htmlspecialchars($v4, REPLACE_FLAGS);
						} else
							$_POST[$k][$k2][$k3] = htmlspecialchars($v3, REPLACE_FLAGS);
					}
				} else
					$_POST[$k][$k2] = htmlspecialchars($v2, REPLACE_FLAGS);
			}
		} else
			$_POST[$k] = htmlspecialchars($v, REPLACE_FLAGS);
	}
}

$_GET['q'] = htmlspecialchars($_GET['q'], REPLACE_FLAGS);

include_once 'includes/settings.php';
$qloaded_functions = array();
include_once SITE_ROOT . '/includes/func/func.core.php';
include_once SITE_ROOT . '/includes/logging.php';

$cookie_domain = $http_domain;

if ($is_mysqli)
	include_once SITE_ROOT . '/includes/database_mysqli.php';
else
	include_once SITE_ROOT . '/includes/database.php';

$db = new Database();
$db->connect();

if ($is_mysqli)
	$db->setUTF8();
else
	mysql_set_charset("utf8");

$db->query("SET sql_mode = '';");

# Start session
session_start();

# Recovery var directory
$var_dir = SITE_ROOT.'/var';
if (!is_dir($var_dir)) {
	mkdir($var_dir, 0777) || die('Cannot create '.$var_dir.' directory. Please, check permissions.');
	copy(SITE_ROOT.'/includes/index_file', $var_dir.'/index.php');

	$dirs = array('cache', 'log', 'photo', 'photo/blog', 'photo/brand', 'photo/category', 'photo/product', 'photo/variant', 'cache/other', 'cache/other/css', 'cache/other/images', 'cache/en', 'cache/en/js', 'cache/ru', 'cache/ru/js');
	foreach ($dirs as $v) {
		$dir = $var_dir.'/'.$v;
		mkdir($dir, 0777) || die('Cannot create '.$dir.' directory. Please, check permissions.');
		copy(SITE_ROOT.'/includes/index_file', $dir.'/index.php');
	}

	$dest = $var_dir.'/cache/other/images';
	$source = SITE_ROOT.'/images';
	foreach ($iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST) as $item) {
		if ($item->isDir())
			mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName(), 0777);
		else
			copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
	}
}

# Parse url
$get = array();
$tmp = explode("?", $_SERVER['REQUEST_URI']);
$tmp2 = explode("/", $tmp[0]);
if (!empty($tmp2))
	foreach ($tmp2 as $v)
		if ($v != '')
			$get[] = addslashes($v);

if ($_SESSION['current_language']) {
	$lng = $_SESSION['current_language']['code'];
}

$taxes_units = array(
	'ST'  => lng('Subtotal'),
	'DST' => lng('Discounted subtotal'),
	'SH'  => lng('Shipping cost')
);

# Get config
$config = array();
$tmp = $db->all("SELECT * FROM config ORDER BY category, orderby");
foreach ($tmp as $v) {
	if ($v['category'])
		$config[$v['category']][$v['name']] = $v['value'];
	else
		$config[$v['name']] = $v['value'];
}

if ($get['0'] != 'admin' && $_SESSION['current_currency']) {
	$config['General']['currency_symbol'] = $_SESSION['current_currency']['symbol'];
}

$config['Company']['location_countryname'] = $db->field("SELECT country FROM countries WHERE code='".$config['Company']['location_country']."'");
$config['Company']['location_statename'] = $db->field("SELECT state FROM states WHERE code='".$config['Company']['location_state']."' AND country_code='".$config['Company']['location_country']."'");
if (!$config['Company']['location_statename'])
	$config['Company']['location_statename'] = $config['Company']['location_state'];

$config['Company']['company_mail_from'] = htmlspecialchars_decode($config['Company']['company_mail_from']);

$company_email = $config['Company']['company_mail_from'];
$company_name = $config['Company']['company_name'];
$company_slogan = $config['Company']['company_slogan'];

if ($get['0'] == 'admin') {
	define('ADMIN_AREA', 1);
	$config['General']['shop_closed'] = '';
} else {
	define('ADMIN_AREA', 0);
	if ($_GET['shopkey'] == $config['General']['shop_closed_key'])
		$_SESSION['shop_not_closed'] = 'Y';

	if ($_SESSION['shop_not_closed'] == 'Y')
		unset($config['General']['shop_closed']);
}

$template = array();

$template['domain'] = $http_domain;
$template['http_location'] = $http_location;
$template['https_location'] = $https_location;

if ($_SERVER['HTTPS'])
	$template['current_protocol'] = 'https';
else
	$template['current_protocol'] = 'http';

$template['warehouse_enabled'] = $warehouse_enabled;
$template['ajax_delimiter'] = $ajax_delimiter;
$template['payment_currency'] = $payment_currency;

if (preg_match('/bot|andex|oogle|robot|spider|crawl|curl|search|^$/i', $_SERVER['HTTP_USER_AGENT']))
	$template['bot'] = $bot = 'Y';

if ($company_slogan)
	$template['head_title'] = $company_name.' - '.$company_slogan;
else
	$template['head_title'] = $company_name;

$template['company_name'] = $company_name;
$template['company_slogan'] = $company_slogan;

$template['css'][] = 'style';
if ($get['0'] != 'admin') {
	$template['js'][] = 'jquery.ui.tooltip';
}

$template['js'][] = 'scripts';
$template['css'][] = 'jquery.ui.tooltip';
# Get templates
$tmp = $db->all("SELECT template, time, lng FROM templates WHERE lng IN ('".$lng."', 'css', 'js')");
if (!empty($tmp)) {
	$templates = array();
	foreach ($tmp as $v)
		$templates[$v['lng']][$v['template']] = $v['time'];
}

$template['templates'] = $templates;

# Config
$config['company_name'] = $config['Company']['company_name'];
$config['company_url'] = $config['Company']['company_website'];
$template['config'] = $config;

$template['db'] = $db;

$unset_variables = ['db', 'root_admin', 'login', 'get', 'userinfo'];
foreach ($unset_variables as $v) {
	if ($_POST[$v])
		unset($_POST[$v]);

	if ($_GET[$v])
		unset($_GET[$v]);
}

extract($_SESSION);

if (!$session_id) {
	$salt = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCD!@#^&&*%*($)*@#($%*#%)-=.,;\'][EFGHIJKLMNOPQRSTUVWXYZ0123456789' ), 0, 8 );
	$_SESSION['session_id'] = $session_id = md5($salt.$user_id.$_SERVER['REMOTE_ADDR'].$salt.time().rand(0,100).$salt);
}

if ($_GET['ac_email']) {
	if (!$_SESSION['cart']) {
		$tmp = $db->field("SELECT cart FROM users_carts WHERE email='".addslashes($_GET['ac_email'])."'");
		$_SESSION['userinfo']['email'] = $_GET['ac_email'];
		if ($tmp) {
			$_SESSION['cart'] = $cart = unserialize($tmp);
		}
	}
}

if ($_GET['set_rem']) {
	$userid = $db->field("SELECT userid FROM users_remember WHERE pswd='".addslashes($_GET['set_rem'])."'");
	if ($userid) {
		$url = str_replace($_GET['set_rem'], '', $_SERVER['REQUEST_URI']);
		$url = str_replace('set_rem=', '', $url);
		func_setcookie('remember', $_GET['set_rem']);
		redirect($url);
	}
}


if (empty($_SESSION['login'])) {
	if ($_COOKIE['remember']) {
		$login = $db->field("SELECT userid FROM users_remember WHERE pswd='".addslashes($_COOKIE['remember'])."'");
		$usertype = $db->field("SELECT usertype FROM users WHERE id='".$login."'");
		if ($usertype == 'A' || !$usertype) {
			func_setcookie('remember', '');
		} elseif ($login) {
			$_SESSION['login'] = $login;
			redirect($_SERVER['REQUEST_URI']);
		} else
			func_setcookie('remember', '');
	}

	$userinfo = array(
		'membershipid'	=> '0',
		'state'			=> '',
		'b_state'		=> '',
	);
	$template['userinfo'] = $userinfo;
	$template['js'][] = 'login';
	$template['css'][] = 'login';
	unset($login);
} else {
	if (!$_SESSION['cart']) {
		$tmp = $db->field("SELECT cart FROM users_carts WHERE userid='$login'");
		if ($tmp) {
			$_SESSION['cart'] = $cart = unserialize($tmp);
		}
	}

	$template['css'][] = 'logged';
	$template['js'][] = 'logged';
	$userinfo = $db->row("SELECT * FROM users WHERE id=".$login." AND status=1");
	if (empty($userinfo)) {
        $_SESSION['login'] = '';
		func_setcookie('remember', '');
		redirect('/');
	}

    $template['userinfo'] = $userinfo;
	$tmp = $db->all("SELECT * FROM user_sessions WHERE userid='".$login."'");
	if (!empty($tmp)) {
		$sessions = array();
		foreach ($tmp as $v) {
			$sessions[$v['name']] = arrayMap('stripslashes', unserialize($v['value']));
		}

		if (!$sessions['to_remove'])
			$to_remove = '';

		extract($sessions);
	}

	if ($_SESSION['recently']) {
		$db->query("REPLACE INTO user_sessions SET userid='".$login."', name='recently', value='".addslashes(serialize($_SESSION['recently']))."'");
	} elseif ($sessions['recently']) {
		$_SESSION['recently'] = $sessions['recently'];
	}
}

$template['css'][] = 'register';
$template['js'][] = 'register';

$template['date_format'] = $date_format;
$template['datetime_format'] = $datetime_format;

$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

if (preg_match('/msie/', $userAgent) || preg_match('/rv:11.0/', $userAgent)) {
	$template['ie'] = true;
	$template['browser'] = 1;
} elseif (preg_match('/opera/', $userAgent)) {
	$template['browser'] = 4;
} elseif (preg_match('/chrome/', $userAgent))
	$template['browser'] = 2;
elseif (preg_match('/safari/', $userAgent))
	$template['browser'] = 3;
else
	$template['browser'] = 5;

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' || $get['0'] == 'ajax') {
	$template['is_ajax'] = $is_ajax = true;
} else {
	$is_ajax = false;
}

$template['order_statuses'] = $order_statuses = array(
	'4'	=> 'Declined',
	'5'	=> 'Failed',
	'1'	=> 'Queued',
	'2'	=> 'Paid',
	'6'	=> 'Shipped',
	'3'	=> 'Completed',
);

$template['shipping_fee'] = $shipping_fee = 9.95;

$template['email_header'] = $email_header = 'You have received this email because you or someone else with your email registered on our site '.$company_name.'.<br /><br />';
$template['signature'] = $signature = '--<br />Warmest regards,<br />'.$company_name.'<br />'.$company_slogan;

require_once SITE_ROOT . '/vendor/autoload.php';