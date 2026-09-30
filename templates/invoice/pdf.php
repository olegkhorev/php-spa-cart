<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<html class="itsinvoicepage">
<head>
<meta charset="utf-8" />
<title>{lng[Invoice]} #<?php echo $order['orderid']; ?></title>
<style type="text/css" media="all">
<?php
include SITE_ROOT.'/includes/css.php';
?>
body {
    font-family: sans-serif;
    font-size: 13px;
}
</style>
</head>
<body class="pdf-invoice print_body">
<div class="print_div">
{include="invoice/body.php"}
</div>
</body>
</html>