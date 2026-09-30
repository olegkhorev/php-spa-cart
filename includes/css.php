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
global $css_js_cache, $_SESSION;

$dir = SITE_ROOT.'/var/cache/other/css';
foreach ($css as $v) {
	func_put_css_content(SITE_ROOT.'/templates/css/'.$v.'.css', $dir.'/'.$v.'.css', $v, 'css');
}

$default_css = func_get_ajax_css();
$css_cache = '';
foreach ($default_css as $v) {
	$css_cache .= file_get_contents(SITE_ROOT . '/var/cache/other/css/'.$v.'.css');
}

$fp = fopen(SITE_ROOT . '/var/cache/css.css', 'w');
fputs($fp, $css_cache);
fclose($fp);

echo '@import url("/var/cache/css.css?'.$css_js_cache.'");';

if ($get['0'] != 'admin') {
	$dir = SITE_ROOT.'/var/cache/other/css_modules';
	$modules_css = func_get_modules_ajax_css();
	$modules_css_cache = '';
	foreach ($modules_css as $v) {
		if (!is_dir($dir.'/'.$v))
			mkdir($dir.'/'.$v, 0777, true);

		func_put_css_content(SITE_ROOT.'/templates/modules/'.$v.'/styles.css', $dir.'/'.$v.'/styles.css', $v, 'css');
		$modules_css_cache .= file_get_contents(SITE_ROOT . '/var/cache/other/css_modules/'.$v.'/styles.css');
	}

	$fp = fopen(SITE_ROOT . '/var/cache/css_modules.css', 'w');
	fputs($fp, $modules_css_cache);
	fclose($fp);
	echo '@import url("/var/cache/css_modules.css?'.$css_js_cache.($_SESSION['current_theme'] ? $_SESSION['current_theme']['code'] : '').'");';
}

$already = array();
foreach ($css as $v) {
	if (!$already[$v]) {
		if ($v == 'overflow') {
			if ($custom_css )
				echo '@import url("'.$custom_css.'");';
		}

		if (!in_array($v, $default_css))
			echo '@import url("/var/cache/other/css/'.$v.'.css?'.$css_js_cache.'");';

		$already[$v] = 1;
	}
}

if ($get['0'] == 'admin') {
	global $modules;
	foreach ($modules as $v) {
		$file = '/templates/modules/'.$v['author'].'/'.$v['module'].'/admin.css';
		if (file_exists(SITE_ROOT . $file))
			echo '@import url("'.$file.'?'.$css_js_cache.'");';
	}
}