<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
{*
<meta name="keywords" content="<?php if (
    $get["0"] == "home" &&
    lng("Homepage meta keywords")
) {
    echo lng("Homepage meta keywords");
} elseif ($product["meta_keywords"]) {
    echo $product["meta_keywords"];
} elseif ($category["meta_keywords"]) {
    echo $category["meta_keywords"];
} elseif ($static_page["meta_keywords"]) {
    echo $static_page["meta_keywords"];
} elseif ($blog["meta_keywords"]) {
    echo $blog["meta_keywords"];
} elseif ($brand["meta_keywords"]) {
    echo $brand["meta_keywords"];
} else {
    echo "";
} ?>">
*}
<meta name="description" content="<?php if (
    $get["0"] == "home" &&
    lng("Homepage meta description")
) {
    echo lng("Homepage meta description");
} elseif ($product["meta_description"]) {
    echo $product["meta_description"];
} elseif ($category["meta_description"]) {
    echo $category["meta_description"];
} elseif ($static_page["meta_description"]) {
    echo $static_page["meta_description"];
} elseif ($blog["meta_description"]) {
    echo $blog["meta_description"];
} elseif ($brand["meta_description"]) {
    echo $brand["meta_description"];
} else {
    echo "";
} ?>">
<meta name="robots" content="ALL">
<link rel="shortcut icon" href="/favicon2.png" type="image/vnd.microsoft.icon" />
<title>{lng[Invoice]} #<?php echo $order["orderid"]; ?></title>

<style media="all">
{include_css}
</style>

<script>
var current_area = 'A',
	page = '<?php echo $get["0"]; ?>',
	current_location = '{$current_location}',
	stripe_key = '<?php echo $stripe_pkey; ?>',
	ajax_delimiter = '<?php echo $ajax_delimiter; ?>',
	currency_symbol = '{$config['General']['currency_symbol']}',
	weight_symbol = '{$config['General']['weight_symbol']}',
	is_ajax_page = {php echo $is_ajax_page;},
	facebook_api = '{$current_protocol}://connect.facebook.net/en-en/all.js',
	twitter_api = '{$current_protocol}://platform.twitter.com/widgets.js',
	payment_currency = '{$payment_currency}';
</script>
</head>
<body style="background: #fff;">
<div style="float: left;">
{include="invoice/body.php"}
</div>

{include_js}

</body>
</html>