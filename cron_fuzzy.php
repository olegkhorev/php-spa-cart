<?php
@ini_set('log_errors','On');
@ini_set('display_errors','Off');
extract($_GET);
if (php_sapi_name() != 'cli' && $pswd != '01230') {
	header("Location: /");
	exit;
}

ini_set('memory_limit', '524288000');
set_time_limit(36000);

include 'includes/boot.php';

$result = $result_words = array();
$products = $db->all("SELECT * FROM products WHERE status='1'");
foreach ($products as $k=>$v) {
	$v['descr'] = strip_tags($v['descr']);
	$v['name'] = fuzzy_clean($v['name']);
	$words = explode(' ', $v['name']);
	$result[$v['productid']] = $v['name'];
	foreach ($words as $w) {
		if (!$result_words[$w])
				$result_words[$w] = 1;
		else
		 $result_words[$w]++;
	}
}

arsort($result, true);
$text = '';
foreach ($result as $k=>$v) {
	$text .= $k.':::'.$v."\n"; 
}

$fp = fopen(SITE_ROOT.'/var/fuzzy_keywords.txt', 'w+');
fputs($fp, $text);
fclose($fp);
arsort($result_words, true);
$text = '';
foreach ($result_words as $k=>$v) {
	$text .= $k.':::'.$v."\n"; 
}

$fp = fopen(SITE_ROOT.'/var/fuzzy_keywords_words.txt', 'w+');
fputs($fp, $text);
fclose($fp);

foreach ($products as $k=>$v) {
	$v['descr'] = strip_tags($v['descr']);
	$v['descr'] = nl2br($v['descr']);
	$v['descr'] = strip_tags($v['descr']);
	$v['descr'] = str_replace("\n", " ", $v['descr']);
	$words = fuzzy_generate_phrases($v['descr']);
	$result[$v['productid']] = $v['descr'];
	foreach ($words as $w) {
		if (!$result_words[$w])
		 $result_words[$w] = 1;
		else
		 $result_words[$w]++;
	}
}

arsort($result, true);
$text = '';
foreach ($result as $k=>$v) {
	$text .= $k.':::'.$v."\n"; 
}

$fp = fopen(SITE_ROOT.'/var/fuzzy_keywords_descr.txt', 'w+');
fputs($fp, $text);
fclose($fp);

function fuzzy_generate_phrases($text) {
    $wordCount = str_word_count(strtolower($text), 1);
    $phrases = array();

    for ($i = 0; $i < count($wordCount) - 1; $i++) {
        $phrase = $wordCount[$i] . ' ' . $wordCount[$i + 1];
        $phrases[] = $phrase;
    }

    return $phrases;
}
	
function fuzzy_clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
			$string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
   return $string;
}
