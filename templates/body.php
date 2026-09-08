<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:g="http://base.google.com/ns/1.0" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="area-c">
<head>
<meta charset="utf-8" />
<meta name="keywords" content="<?php if ($get['0'] == 'home' && lng('Homepage meta keywords')) echo lng('Homepage meta keywords'); elseif ($product['meta_keywords']) echo $product['meta_keywords']; elseif ($category['meta_keywords']) echo $category['meta_keywords']; elseif ($static_page['meta_keywords']) echo $static_page['meta_keywords']; elseif ($blog['meta_keywords']) echo $blog['meta_keywords']; elseif ($brand['meta_keywords']) echo $brand['meta_keywords']; else echo "";?>">
<meta name="description" content="<?php if ($get['0'] == 'home' && lng('Homepage meta description')) echo lng('Homepage meta description'); elseif ($product['meta_description']) echo $product['meta_description']; elseif ($category['meta_description']) echo $category['meta_description']; elseif ($static_page['meta_description']) echo $static_page['meta_description']; elseif ($blog['meta_description']) echo $blog['meta_description']; elseif ($brand['meta_description']) echo $brand['meta_description']; else echo "";?>">
<meta name="robots" content="ALL">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="/favicon.png" type="image/vnd.microsoft.icon" />
<title>{$page_title}</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css" media="all">
<?php
include SITE_ROOT.'/includes/css.php';
?>
</style>
{if $config['theme_color']}
<style id="custom_style">
:root {
	--theme-color: #{$config['theme_color']};
	--theme-color-2: #{$config['theme_color_2']};
}
</style>
{/if}
{*<script src="https://checkout.stripe.com/checkout.js"></script>*}
<script type="text/javascript">
var current_area = 'C',
	page = '{$get['0']}',
	parentid = '{$parentid}',
	pageid = '{$brand['brandid']}',
	current_location = '{$current_location}',
	stripe_key = '{$stripe_pkey}',
	ajax_delimiter = '{$ajax_delimiter}',
	currency_symbol = '{$config['General']['currency_symbol']}',
	weight_symbol = '{$config['General']['weight_symbol']}',
	payment_currency = '{$payment_currency}',
	is_ajax_page = {php echo $is_ajax_page;},
	facebook_api = '{$current_protocol}://connect.facebook.net/en-en/all.js',
	twitter_api = '{$current_protocol}://platform.twitter.com/widgets.js',
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

  <script src="https://js.braintreegateway.com/web/3.54.2/js/client.min.js"></script>
  <script src='https://js.braintreegateway.com/web/3.54.2/js/three-d-secure.js'></script>
  <script src="https://js.braintreegateway.com/web/3.54.2/js/hosted-fields.min.js"></script>
</head>
<body class="{if $get['0'] == 'category' || $get['0'] == 'search' || ($get['0'] == 'brands' && $get['1'])} withfilter{/if}{if $classes} {$classes}{/if}" id="body-{$get['0']}">

<div class="mobile-left_menu">
{if $config['General']['shop_closed'] != 'Y'}
{include="left_menu.php"}
{/if}
</div>
<div class="mobile-menu-fade"></div>
<div class="loading-header">
<div aria-busy="true" aria-label="Loading, please wait." role="progressbar"></div>
</div>

{*<div class="body-loading"><div></div></div>*}

{if $config['General']['shop_closed'] != 'Y'}
<div id="head">
{$head}
</div>
{/if}

<div class="ajax_container">
{include="ajax_container.php"}
</div>

{*
<div class="page-container">
{if $alerts}
 <div class="alerts"><span onclick="javascript: $('.alerts').slideUp();"><b>X</b></span>
 {foreach $alerts as $v}
  {if $v['type'] == 'e'}<div class="error">Error: {$v['content']}</div>{else}{$v['content']}<br>{/if}<br>
 {/foreach}
 </div>
{/if}

<div id="bread_crumbs_container">{$bread_crumbs_html}</div>

<div class="content" align="left">
{if false && !$no_left_menu}
{$left_menu;}
{/if}

	<div id="center"{if true || $no_left_menu == 'Y'} class="no_left_menu"'{/if}>
{$page}
	</div>
</div>
<div class="clear"></div>
</div>
*}
<div class="loading">
{*
<img src="{$current_location}/images/spacer.gif" alt="..."/>
*}
<div class="cssload-container"><div class="cssload-speeding-wheel"></div></div>
</div>
{if $config['General']['shop_closed'] != 'Y'}
<div id="foot-subscribe">
<div class="foot-subscribe">
<form method="POST" action="/subscribe" id="subsform">
<div id="subscribe">
<input placeholder="{lng[Subscribe to our news here...]}" type="text" id="sub-email" name="email" />
<button>{lng[Subscribe]}</button>
</div>
</form>
</div>
</div>

<div id="foot">
{$foot}
</div>
{/if}

<script src="//code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/ui/1.14.1/jquery-ui.min.js" integrity="sha256-AlTido85uXPlSyyaZNsjJXeCs07eSv3r43kyCVc8ChI=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css" type="text/css" />

<?php
include SITE_ROOT.'/includes/js.php';
?>
{*
<script src="http://connect.facebook.net/en-en/all.js"></script>
*}

<img src="/images/scrolltop.png" alt="" id="scrolltop" />

{if $config['General']['tawk_to_site_id']}
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/{$config['General']['tawk_to_site_id']}/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
Tawk_API.onLoad = function(){
    $('iframe').removeAttr('title');
};
</script>
<!--End of Tawk.to Script-->
{/if}

{if $design_mode}
<?php
include SITE_ROOT.'/theme.php';
?>
{/if}

{if $translate_mode}
{include="common/translate.php"}
{/if}

<script src="/images/kickout-ads.min.js"></script>
</body>
</html>