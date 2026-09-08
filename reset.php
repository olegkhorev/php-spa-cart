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

q_load('category');
session_write_close();
$languages = $db->all("SELECT * FROM languages_codes WHERE active=1 ORDER BY orderby, code");
if (!$languages)
	$languages[] = array(
		'code' => 'en'
	);

foreach ($languages as $v) {
	$lng = $v['code'];
	foreach ($templates[$lng] as $file=>$v) {
		$tmp = get_template_contents($file, true);
	}
}

	function parse_js($lng, $file) {
		global $db;

		$dir = SITE_ROOT.'/var/cache/'.$lng.'/js';
		$script = file_get_contents(SITE_ROOT.'/templates/js/'.$file.'.js');
		$tmp = explode("\r", $script);
		$script = implode("\r\n", $tmp);
		preg_match_all("/\{lng\[(.*?)\]\}/", $script, $matches);
		if (!empty($matches['1']['0'])) {
			foreach ($matches['0'] as $k2=>$file2) {
				$to = $matches['1'][$k2];
				$tmp = $db->field("SELECT translation FROM languages WHERE lng='".$lng."' AND word='".addslashes($to)."'");
				if (empty($tmp)) {
					$db->query("INSERT INTO languages SET lng='".$lng."', word='".addslashes($to)."', translation='".addslashes($to)."'");
					$script = str_replace($file2, $to, $script);
				} else {
					$tmp = str_replace('"', '\"', $tmp);
					$tmp = str_replace("\n", '', $tmp);
					$tmp = str_replace("\r", '', $tmp);
					$script = str_replace($file2, $tmp, $script);
				}
			}
		}

		$packed = $script;
		if ($file == 'jquery.min') {
		} elseif ($file == 'jquery.ui.sortable') {
			$packed = '/*! jQuery UI Sortable 1.10.2
* http://jqueryui.com
* Copyright 2013 jQuery Foundation and other contributors Licensed MIT */'.$packed;
		} elseif ($file == 'jquery-ui.min') {
			$packed = '/*! jQuery UI
* http://jqueryui.com
* Copyright (c) 2013 jQuery Foundation and other contributors Licensed MIT */'.$packed;
		} elseif ($file == 'scroll') {
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
		} elseif ($file == 'jquery.gradientPicker') {
			$packed = '/**
@author Matt Crinklaw-Vogt (tantaman)
*/'.$packed;
		} elseif ($file == 'jquery.ui.draggable') {
			$packed = '/*! jQuery UI Draggable 1.10.2
* http://jqueryui.com
* Copyright 2013 jQuery Foundation and other contributors Licensed MIT */'.$packed;
		} elseif ($file == 'colorpicker') {
			$packed = '/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 *
 * Dual licensed under the MIT and GPL licenses
 *
 */'.$packed;
		} elseif ($file == '') {
			$packed = ''.$packed;
		}

		file_put_contents($dir.'/'.$file.'.js', $packed);
		$db->query("REPLACE INTO templates SET lng='js', template='".$file."', time='".filemtime(SITE_ROOT.'/templates/js/'.$file.'.js')."'");
	}

	include SITE_ROOT.'/includes/classes/class.JavaScriptPacker.php';

	foreach ($templates['js'] as $file=>$v) {
		parse_js('en', $file);
		foreach ($languages as $v) {
			if ($v['code'] != 'en')
				parse_js($v['code'], $file);
		}
	}

	$dir = SITE_ROOT.'/var/cache/other/css';
	foreach ($templates['css'] as $file=>$v) {
		$file_tmp = file(SITE_ROOT.'/templates/css/'.$file.'.css');
		if (!$file_tmp)
			$file_tmp = array();

		$content = implode("", array_map('trim', $file_tmp));
		$content = str_replace("\n", "", $content);
		$content = str_replace("\r", "", $content);
		$content = str_replace(": ", ":", $content);
		$content = str_replace(" {", "{", $content);
		$content = str_replace("\t", "", $content);
		$content = str_replace(";}", "}", $content);
		file_put_contents($dir.'/'.$file.'.css', $content);
		$db->query("REPLACE INTO templates SET lng='css', template='".$file."', time='".filemtime(SITE_ROOT.'/templates/css/'.$file.'.css')."'");
	}

	exit('done');
