<?php
ini_set('log_errors','On');
ini_set('display_errors','Off');
extract($_GET);
if (php_sapi_name() != 'cli' && $pswd != '01230') {
	header("Location: /");
	exit;
}

ini_set('memory_limit', '524288000');
set_time_limit(36000);

include 'includes/boot.php';

func_load('category');
session_write_close();
$languages = $db->all("SELECT * FROM languages_codes WHERE active=1 ORDER BY orderby, code");
if (!$languages)
	$languages[] = array(
		'code' => 'en'
	);

foreach ($languages as $l) {
	$lng = $l['code'];
	foreach ($templates[$lng] as $file=>$v) {
		$tmp = get_template_contents($file, true);
	}
}

foreach ($languages as $l) {
	$lng = $l['code'];
	$dir = SITE_ROOT.'/var/cache/'.$lng.'/js';
	foreach ($templates['js'] as $name=>$time) {
		func_put_javascript_content(SITE_ROOT.'/templates/js/'.$name.'.js', $dir.'/'.$name.'.js', $name, 'js', true);
	}

	$dir = SITE_ROOT.'/var/cache/'.$lng.'/js_modules';
	foreach ($templates['js_modules'] as $name=>$time) {
		if (!is_dir($dir.'/'.$name))
			mkdir($dir.'/'.$name, 0777, true);

		func_put_javascript_content(SITE_ROOT.'/templates/modules/'.$name.'/scripts.js', $dir.'/'.$name.'/scripts.js', $name, 'js', true);
	}
}

$modules = $db->all("SELECT * FROM modules WHERE enabled='1' ORDER BY pos");
foreach ($languages as $l) {
	$lng = $l['code'];
	foreach ($modules as $v) {
		$dir = SITE_ROOT.'/var/cache/'.$lng.'/js';
		$dir_module = SITE_ROOT . '/templates/modules/'.$v['author'].'/'.$v['module'];
		if (file_exists($dir_module.'/admin.js')) {
			mkdir($dir.'/'.$v['code'], 0755, true);
			func_put_javascript_content($dir_module.'/admin.js', $dir.'/'.$v['code'].'/admin.js', 'admin.js', 'js_module_'.$v['code'], true, true);
		}
	}
}

$dir = SITE_ROOT.'/var/cache/other/css';
foreach ($templates['css'] as $file=>$v) {
	func_put_css_content(SITE_ROOT.'/templates/css/'.$file.'.css', $dir.'/'.$file.'.css', $file, 'css');
}

$dir = SITE_ROOT.'/var/cache/other/css_modules';
foreach ($templates['css_modules'] as $file=>$v) {
	func_put_css_content(SITE_ROOT.'/templates/modules/'.$file.'.css', $dir.'/'.$file.'.css', $file, 'css');
}

exit('done');
