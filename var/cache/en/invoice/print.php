<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="keywords" content="<?php  if ($get['0'] == 'home' && lng('Homepage meta keywords')) echo lng('Homepage meta keywords'); else if ($product['meta_keywords']) echo $product['meta_keywords']; else if ($category['meta_keywords']) echo $category['meta_keywords']; else if ($static_page['meta_keywords']) echo $static_page['meta_keywords']; else if ($blog['meta_keywords']) echo $blog['meta_keywords']; else if ($brand['meta_keywords']) echo $brand['meta_keywords']; else  echo "";?>">
<meta name="description" content="<?php  if ($get['0'] == 'home' && lng('Homepage meta description')) echo lng('Homepage meta description'); else if ($product['meta_description']) echo $product['meta_description']; else if ($category['meta_description']) echo $category['meta_description']; else if ($static_page['meta_description']) echo $static_page['meta_description']; else if ($blog['meta_description']) echo $blog['meta_description']; else if ($brand['meta_description']) echo $brand['meta_description']; else  echo "";?>">
<meta name="robots" content="ALL">
<link rel="shortcut icon" href="/favicon2.png" type="image/vnd.microsoft.icon" />
<title>Invoice #<?php  echo $order['orderid']; ?></title>

<style type="text/css" media="all">
<?php 
include SITE_ROOT.'/includes/css.php';
?>
</style>
<script type="text/javascript">
var current_area = 'A',
	page = '<?php  echo $get['0']; ?>',
	current_location = '<?php echo $current_location;?>',
	stripe_key = '<?php  echo $stripe_pkey; ?>',
	ajax_delimiter = '<?php  echo $ajax_delimiter; ?>',
	currency_symbol = '<?php echo $config['General']['currency_symbol'];?>',
	weight_symbol = '<?php echo $config['General']['weight_symbol'];?>',
	is_ajax_page = <?php echo $is_ajax_page;; ?>,
	facebook_api = '<?php echo $current_protocol;?>://connect.facebook.net/en-en/all.js',
	twitter_api = '<?php echo $current_protocol;?>://platform.twitter.com/widgets.js',
	payment_currency = '<?php echo $payment_currency;?>';
</script>
</head>
<body class="print_body">
<div class="print_div">
<?php include SITE_ROOT."/var/cache/en/invoice/body.php";?>
</div>
<?php 
include SITE_ROOT.'/includes/js.php';
?>
</body>
</html>