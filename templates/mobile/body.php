<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:g="http://base.google.com/ns/1.0" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="utf-8" />
<meta name="keywords" content="<?php if ($get['0'] == 'home' && lng('Homepage meta keywords')) echo lng('Homepage meta keywords'); elseif ($product['meta_keywords']) echo $product['meta_keywords']; elseif ($category['meta_keywords']) echo $category['meta_keywords']; elseif ($static_page['meta_keywords']) echo $static_page['meta_keywords']; elseif ($blog['meta_keywords']) echo $blog['meta_keywords']; elseif ($brand['meta_keywords']) echo $brand['meta_keywords']; else echo "";?>">
<meta name="description" content="<?php if ($get['0'] == 'home' && lng('Homepage meta description')) echo lng('Homepage meta description'); elseif ($product['meta_description']) echo $product['meta_description']; elseif ($category['meta_description']) echo $category['meta_description']; elseif ($static_page['meta_description']) echo $static_page['meta_description']; elseif ($blog['meta_description']) echo $blog['meta_description']; elseif ($brand['meta_description']) echo $brand['meta_description']; else echo "";?>">
<meta name="robots" content="ALL">
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="shortcut icon" href="/favicon.png" type="image/vnd.microsoft.icon" />
<title>{$page_title}</title>
<style type="text/css" media="all">
<?php
include SITE_ROOT.'/includes/css.php';
?>
</style>
{*
<script src="https://checkout.stripe.com/checkout.js"></script>
*}
<script type="text/javascript">
var current_area = 'C',
	page = '{$get['0']}',
	pageid = '',
	parentid = '{$parentid}',
	current_location = '{$current_location}',
	stripe_key = '{$stripe_pkey}',
	ajax_delimiter = '{$ajax_delimiter}',
	currency_symbol = '{$config['General']['currency_symbol']}',
	weight_symbol = '{$config['General']['weight_symbol']}',
	payment_currency = '{$payment_currency}',
	is_ajax_page = {php echo $is_ajax_page;},
	facebook_api = '{$current_protocol}://connect.facebook.net/en-en/all.js',
	twitter_api = '{$current_protocol}://platform.twitter.com/widgets.js',
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
	w_prices = [],
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

{if !$login}
var need_login = {if $_GET['mode'] == 'login'}1{else}0{/if};
{/if}
</script>

<script>
var states = {ldelim}{rdelim};
	user_state = "{php echo escape($userinfo['state'], 2);}";

{foreach $countries as $v}
 {if $v['states']}
states.{$v['code']} = {states: []};
  {foreach $v['states'] as $k=>$s}
states.{$v['code']}.states[{$k}] = {code: "{php echo escape($s['code'], 2);}", state: "{php echo escape($s['state'], 2)}"};
  {/foreach}
 {/if}
{/foreach}
</script>

{*
<script type="text/javascript" src="{$current_protocol}://connect.facebook.net/en-en/all.js"></script>
<script>
$(function() {
	FB.init({
		xfbml: true
	});
});
</script>
<script type="text/javascript" src="{$current_protocol}://platform.twitter.com/widgets.js"></script>
*}
</head>
<body<?php if ($classes) echo ' class="'.$classes.'"'; ?> data-mobile="1">

{if $config['General']['shop_closed'] != 'Y'}
{$head}
{/if}

<div class="mobile-left_menu">
{if $config['General']['shop_closed'] != 'Y'}
{$left_menu}
{/if}
</div>

<div class="ajax_container">
{include="mobile/ajax_container.php"}
</div>

<div class="clear"></div>
{if $config['General']['shop_closed'] != 'Y'}
{$foot}
{/if}
<div class="loading">
<div class="cssload-container"><div class="cssload-speeding-wheel"></div></div>
</div>

<?php
include SITE_ROOT.'/includes/js.php';
?>
</body>
</html>