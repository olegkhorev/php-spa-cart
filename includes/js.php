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
global $css_js_cache;

$dir = SITE_ROOT.'/var/cache/'.$lng.'/js';
foreach ($js as $v) {
	func_put_javascript_content(SITE_ROOT.'/templates/js/'.$v.'.js', $dir.'/'.$v.'.js', $v, 'js');
}

$default_js = func_get_ajax_js();
$js_cache = '';
foreach ($default_js as $v) {
	$js_cache .= file_get_contents(SITE_ROOT . '/var/cache/'.$lng.'/js/'.$v.'.js', 'js');
}

$fp = fopen(SITE_ROOT . '/var/cache/'.$lng.'/js.js', 'w');
fputs($fp, $js_cache);
fclose($fp);

echo '<script src="/var/cache/'.$lng.'/js.js?'.$css_js_cache.'"></script>';

$dir = SITE_ROOT.'/var/cache/'.$lng.'/js_modules';
$modules_js = func_get_modules_ajax_js();
$modules_js_cache = '';
foreach ($modules_js as $v) {
	if (!is_dir($dir.'/'.$v))
		mkdir($dir.'/'.$v, 0777, true);

	func_put_javascript_content(SITE_ROOT.'/templates/modules/'.$v.'/scripts.js', $dir.'/'.$v.'/scripts.js', $v, 'js_modules');
	$modules_js_cache .= file_get_contents($dir.'/'.$v.'/scripts.js');
}

$fp = fopen(SITE_ROOT . '/var/cache/'.$lng.'/js_modules.js', 'w');
fputs($fp, $modules_js_cache);
fclose($fp);

echo '<script src="/var/cache/'.$lng.'/js_modules.js?'.$css_js_cache.'"></script>';

$already = array();
foreach ($js as $v) {
	if (!$already[$v]) {
		if (!in_array($v, $default_js))
			echo '<script async src="/var/cache/'.$lng.'/js/'.$v.'.js?'.$css_js_cache.'"></script>';

		$already[$v] = 1;
	}
}

if ($get['0'] == 'admin') {
	global $modules;
	foreach ($modules as $v) {
		$dir = SITE_ROOT.'/var/cache/'.$lng.'/js';
		$dir_module = SITE_ROOT . '/templates/modules/'.$v['author'].'/'.$v['module'];
		if (file_exists($dir_module.'/admin.js')) {
			mkdir($dir.'/'.$v['code'], 0755, true);
			func_put_javascript_content($dir_module.'/admin.js', $dir.'/'.$v['code'].'/admin.js', 'admin.js', 'js_module_'.$v['code'], true, true);
			echo '<script async src="/var/cache/'.$lng.'/js/'.$v['code'].'/admin.js?'.$css_js_cache.'"></script>';
		}
	}
}