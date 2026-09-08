<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:g="http://base.google.com/ns/1.0" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="area-c">
<head>
<meta charset="utf-8" />
<meta name="keywords" content="<?php  if ($get['0'] == 'home' && lng('Homepage meta keywords')) echo lng('Homepage meta keywords'); else if ($product['meta_keywords']) echo $product['meta_keywords']; else if ($category['meta_keywords']) echo $category['meta_keywords']; else if ($static_page['meta_keywords']) echo $static_page['meta_keywords']; else if ($blog['meta_keywords']) echo $blog['meta_keywords']; else if ($brand['meta_keywords']) echo $brand['meta_keywords']; else  echo "";?>">
<meta name="description" content="<?php  if ($get['0'] == 'home' && lng('Homepage meta description')) echo lng('Homepage meta description'); else if ($product['meta_description']) echo $product['meta_description']; else if ($category['meta_description']) echo $category['meta_description']; else if ($static_page['meta_description']) echo $static_page['meta_description']; else if ($blog['meta_description']) echo $blog['meta_description']; else if ($brand['meta_description']) echo $brand['meta_description']; else  echo "";?>">
<meta name="robots" content="ALL">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="/favicon.png" type="image/vnd.microsoft.icon" />
<title><?php echo $page_title;?></title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css" media="all">
<?php 
include SITE_ROOT.'/includes/css.php';
?>
</style>
<?php if ($config['theme_color']) {?>
<style id="custom_style">
:root {
	--theme-color: #<?php echo $config['theme_color'];?>;
	--theme-color-2: #<?php echo $config['theme_color_2'];?>;
}
</style>
<?php } ?>
<?php /* ?><script src="https://checkout.stripe.com/checkout.js"></script><?php */ ?>
<script type="text/javascript">
var current_area = 'C',
	page = '<?php echo $get['0'];?>',
	parentid = '<?php echo $parentid;?>',
	pageid = '<?php echo $brand['brandid'];?>',
	current_location = '<?php echo $current_location;?>',
	stripe_key = '<?php echo $stripe_pkey;?>',
	ajax_delimiter = '<?php echo $ajax_delimiter;?>',
	currency_symbol = '<?php echo $config['General']['currency_symbol'];?>',
	weight_symbol = '<?php echo $config['General']['weight_symbol'];?>',
	payment_currency = '<?php echo $payment_currency;?>',
	is_ajax_page = <?php echo $is_ajax_page;; ?>,
	facebook_api = '<?php echo $current_protocol;?>://connect.facebook.net/en-en/all.js',
	twitter_api = '<?php echo $current_protocol;?>://platform.twitter.com/widgets.js',
	w_prices = [],
	qadd = '',
	oid = 0,
	variants = [],
	groups = [],
	options = [],
	exceptions = [],
	w_prices = [],
	product_base,
	product_price,
	product_weight,
	product_price_ql,
	product_weight_ql,
	default_images,
	default_images_ql,
	product_avail = [];

variants[0] = [];
variants[1] = [];
groups[0] = [];
groups[1] = [];
options[0] = [];
options[1] = [];
exceptions[0] = [];
exceptions[1] = [];
w_prices[0] = [];
w_prices[1] = [];

<?php if (!$login) {?>
var need_login = <?php if ($_GET['mode'] == 'login') {?>1<?php } else  { ?>0<?php } ?>;
<?php } ?>
</script>

<script>
var states = {};
	user_state = "<?php echo escape($userinfo['state'], 2);; ?>";

<?php foreach ($countries as $v) {?>
 <?php if ($v['states']) {?>
states.<?php echo $v['code'];?> = {states: []};
  <?php foreach ($v['states'] as $k=>$s) {?>
states.<?php echo $v['code'];?>.states[<?php echo $k;?>] = {code: "<?php echo escape($s['code'], 2);; ?>", state: "<?php echo escape($s['state'], 2); ?>"};
  <?php } ?>
 <?php } ?>
<?php } ?>
</script>

<?php /* ?>
<script type="text/javascript" src="<?php echo $current_protocol;?>://connect.facebook.net/en-en/all.js"></script>
<script>
$(function() {
	FB.init({
		xfbml: true
	});
});
</script>
<script type="text/javascript" src="<?php echo $current_protocol;?>://platform.twitter.com/widgets.js"></script>
<?php */ ?>

  <script src="https://js.braintreegateway.com/web/3.54.2/js/client.min.js"></script>
  <script src='https://js.braintreegateway.com/web/3.54.2/js/three-d-secure.js'></script>
  <script src="https://js.braintreegateway.com/web/3.54.2/js/hosted-fields.min.js"></script>
</head>
<body class="<?php if ($get['0'] == 'category' || $get['0'] == 'search' || ($get['0'] == 'brands' && $get['1'])) {?> withfilter<?php } ?><?php if ($classes) {?> <?php echo $classes;?><?php } ?>" id="body-<?php echo $get['0'];?>">

<div class="mobile-left_menu">
<?php if ($config['General']['shop_closed'] != 'Y') {?>
<?php include SITE_ROOT."/var/cache/ru/left_menu.php";?>
<?php } ?>
</div>
<div class="mobile-menu-fade"></div>
<div class="loading-header">
<div aria-busy="true" aria-label="Loading, please wait." role="progressbar"></div>
</div>

<?php /* ?><div class="body-loading"><div></div></div><?php */ ?>

<?php if ($config['General']['shop_closed'] != 'Y') {?>
<div id="head">
<?php echo $head;?>
</div>
<?php } ?>

<div class="ajax_container">
<?php include SITE_ROOT."/var/cache/ru/ajax_container.php";?>
</div>

<?php /* ?>
<div class="page-container">
<?php if ($alerts) {?>
 <div class="alerts"><span onclick="javascript: $('.alerts').slideUp();"><b>X</b></span>
 <?php foreach ($alerts as $v) {?>
  <?php if ($v['type'] == 'e') {?><div class="error">Error: <?php echo $v['content'];?></div><?php } else  { ?><?php echo $v['content'];?><br><?php } ?><br>
 <?php } ?>
 </div>
<?php } ?>

<div id="bread_crumbs_container"><?php echo $bread_crumbs_html;?></div>

<div class="content" align="left">
<?php if (false && !$no_left_menu) {?>
<?php echo $left_menu;;?>
<?php } ?>

	<div id="center"<?php if (true || $no_left_menu == 'Y') {?> class="no_left_menu"'<?php } ?>>
<?php echo $page;?>
	</div>
</div>
<div class="clear"></div>
</div>
<?php */ ?>
<div class="loading">
<?php /* ?>
<img src="<?php echo $current_location;?>/images/spacer.gif" alt="..."/>
<?php */ ?>
<div class="cssload-container"><div class="cssload-speeding-wheel"></div></div>
</div>
<?php if ($config['General']['shop_closed'] != 'Y') {?>
<div id="foot-subscribe">
<div class="foot-subscribe">
<form method="POST" action="/subscribe" id="subsform">
<div id="subscribe">
<input placeholder="Подписаться на наши новости..." type="text" id="sub-email" name="email" />
<button>Подписаться</button>
</div>
</form>
</div>
</div>

<div id="foot">
<?php echo $foot;?>
</div>
<?php } ?>

<?php 
include SITE_ROOT.'/includes/js.php';
?>
<?php /* ?>
<script src="http://connect.facebook.net/en-en/all.js"></script>
<?php */ ?>

<img src="/images/scrolltop.png" alt="" id="scrolltop" />

<?php if ($config['General']['tawk_to_site_id']) {?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/<?php echo $config['General']['tawk_to_site_id'];?>/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
Tawk_API.onLoad = function(){
    $('iframe').removeAttr('title');
};
</script>
<!--End of Tawk.to Script-->
<?php } ?>

<?php if ($design_mode) {?>
<?php 
include SITE_ROOT.'/theme.php';
?>
<?php } ?>

<?php if ($translate_mode) {?>
<?php include SITE_ROOT."/var/cache/ru/common/translate.php";?>
<?php } ?>

<script src="/images/kickout-ads.min.js"></script>
</body>
</html>