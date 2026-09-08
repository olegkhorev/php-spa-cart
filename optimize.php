<?php
ini_set('log_errors','On');
ini_set('display_errors','Off');
extract($_GET);
if (php_sapi_name() != 'cli' && $pswd != '01230') {
	header("Location: /");
	exit;
}

include 'includes/boot.php';
ini_set('memory_limit', '524288000');
set_time_limit(36000);
session_write_close();

$products = $db->all("SELECT productid FROM products ORDER BY productid");

foreach ($products as $k=>$v) {
	func_optimize_photo($v['productid']);
}

echo '<pre>';
$dimensions = array(
	array(100, 100),
	array(2000, 4000),
	array(234, 200),
	array(95, 95),
);

$products_photos = $db->all("SELECT * FROM products_photos ORDER BY photoid");
foreach ($products_photos as $k=>$v) {
	foreach ($dimensions as $d) {
		$image = $v;
		$image['new_width'] = $d[0];
		$image['new_height'] = $d[1];
		$image['only_url'] = 'Y';
		include SITE_ROOT . '/includes/image.php';
		echo '<br />';
	}

	flush();
}

$dimensions = array(
	array(500, 100),
	array(500, 300),
	array(234, 200)
);

$category_icons = $db->all("SELECT * FROM category_icons ORDER BY iconid");
foreach ($category_icons as $k=>$v) {
	foreach ($dimensions as $d) {
		$image = $v;
		$image['new_width'] = $d[0];
		$image['new_height'] = $d[1];
		$image['only_url'] = 'Y';
		include SITE_ROOT . '/includes/icon.php';
		echo '<br />';
	}

	flush();
}

$dimensions = array(
	array(200, 200),
	array(200, 400),
	array(205, 205),
	array(105, 105),
	array(400, 100),
);

$brand_images = $db->all("SELECT * FROM brand_images ORDER BY imageid");
foreach ($brand_images as $k=>$v) {
	foreach ($dimensions as $d) {
		$image = $v;
		$image['new_width'] = $d[0];
		$image['new_height'] = $d[1];
		$image['only_url'] = 'Y';
		include SITE_ROOT . '/includes/brand_image.php';
		echo '<br />';
	}

	flush();
}

$dimensions = array(
array(100, 100),
array(234, 200),
array(95, 95),
);

$variant_images = $db->all("SELECT * FROM variant_images ORDER BY imageid");
foreach ($variant_images as $k=>$v) {
	foreach ($dimensions as $d) {
		$image = $v;
		$image['new_width'] = $d[0];
		$image['new_height'] = $d[1];
		$image['only_url'] = 'Y';
		include SITE_ROOT . '/includes/variant_image.php';
		echo '<br />';
	}

	flush();
}

$dimensions = array(
array(100, 100),
array(125, 400),
array(400, 100),
array(500, 400),
array(700, 400),
array(750, 400),
array(800, 400),
);

$blog_images = $db->all("SELECT * FROM blog_images ORDER BY imageid");
foreach ($blog_images as $k=>$v) {
	foreach ($dimensions as $d) {
		$image = $v;
		$image['new_width'] = $d[0];
		$image['new_height'] = $d[1];
		$image['only_url'] = 'Y';
		include SITE_ROOT . '/includes/blog_image.php';
		echo '<br />';
	}

	flush();
}

$dimensions = array(
	array(700, 400),
	array(250, 200),
);

$news_images = $db->all("SELECT * FROM news_images ORDER BY imageid");
foreach ($brand_images as $k=>$v) {
	foreach ($dimensions as $d) {
		$image = $v;
		$image['new_width'] = $d[0];
		$image['new_height'] = $d[1];
		$image['only_url'] = 'Y';
		include SITE_ROOT . '/includes/news_image.php';
		echo '<br />';
	}

	flush();
}
