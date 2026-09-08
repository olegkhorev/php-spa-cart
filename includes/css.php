<?php
$dir = SITE_ROOT.'/var/cache/other/css';
foreach ($css as $v) {
	if (!file_exists($dir.'/'.$v.'.css') || $templates['css'][$v] != filemtime(SITE_ROOT.'/templates/css/'.$v.'.css') || DEVELOPMENT) {
		$file = file(SITE_ROOT.'/templates/css/'.$v.'.css');
		if (!$file)
			$file = array();

		$content = implode("", array_map('trim', $file));
		$content = str_replace("\n", "", $content);
		$content = str_replace("\r", "", $content);
		$content = str_replace(": ", ":", $content);
		$content = str_replace(" {", "{", $content);
		$content = str_replace("\t", "", $content);
		$content = str_replace(";}", "}", $content);
		$fp = fopen($dir.'/'.$v.'.css', 'w');
		fputs($fp, $content);
		fclose($fp);
		$db->query("REPLACE INTO templates SET lng='css', template='".$v."', time='".filemtime(SITE_ROOT.'/templates/css/'.$v.'.css')."'");
	}
}

global $css_js_cache;

$default_css = func_get_ajax_css();
$css_cache = '';
foreach ($default_css as $v) {
	$css_cache .= file_get_contents(SITE_ROOT . '/var/cache/other/css/'.$v.'.css');
}

$fp = fopen(SITE_ROOT . '/var/cache/css.css', 'w');
fputs($fp, $css_cache);
fclose($fp);

echo '@import url("/var/cache/css.css?'.$css_js_cache.'");';
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
