<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="area-a">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="shortcut icon" href="/favicon.png" type="image/vnd.microsoft.icon" />
<title><?php  echo $head_title; ?></title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
<?php /* ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<?php */ ?>
<link rel="stylesheet" href="/materialize/material.orange-amber.min.css" />
<script src="//code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/ui/1.14.1/jquery-ui.min.js" integrity="sha256-AlTido85uXPlSyyaZNsjJXeCs07eSv3r43kyCVc8ChI=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css" type="text/css" />

<script defer src="/materialize/material.min.js"></script>
<script defer src="/images/chart.umd.js"></script>

<style type="text/css" media="all">
<?php 
if (!empty($css)) {
	include 'includes/css.php';
}
?>
</style>
<?php if ($login && $config['admin_theme_color'] && $userinfo['usertype'] == 'A') {?>
<style id="custom_style">
:root {
	--blue: #<?php echo $config['admin_theme_color'];?> !important;
}
</style>
<?php } ?>

<script type="text/javascript">
var custId = 0;
var current_area = 'A',
	page = '<?php  echo $get['1']; ?>',
	pageid = '',
	browser = <?php  echo $browser; ?>,
	current_location = '<?php  echo $current_location;?>',
	ajax_delimiter = '<?php  echo $ajax_delimiter; ?>',
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

<?php if (!$login || $userinfo['usertype'] != 'A') {?>
var need_login = <?php if ($_GET['mode'] == 'login') {?>1<?php } else  { ?>0<?php } ?>;
<?php } ?>

<?php 
if ($userinfo['usertype'] != 'A') {
?>
var login_form = [];
login_form['email'] = "E-mail";
login_form['password'] = "Password";
<?php 
}
?>
</script>
<script src="/ckeditor/ckeditor.js"></script>

<?php 
if (!empty($js)) {
	include 'includes/js.php';
}
?>

<script src="/images/jquery.flot.js"></script>
<script src="/images/jquery.flot.time.js"></script>
</head>
<body class="admin-area<?php if (!$login || $userinfo['usertype'] != 'A') {?> no-logged<?php } ?>">
  <?php 
	if ($alerts) {
		echo '<div class="alerts"><span class="close-alerts"><b>X</b> Close</span>';
		foreach ($alerts as $v) {
			if ($v['type'] == 'e') {
?>
<div class="error">Error:
<?php 
				echo ' '.$v['content'].'</div>';
			} else  {
				echo ' '.$v['content'].'<br>';
			}

			echo '<br>';
		}

		echo '</div>';
	}
  ?>
<?php if (!$login || $userinfo['usertype'] != 'A') {?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/login_new.php";?>
<?php } else  { ?>
	<div class="container">
		<div class="navigation-admin">
<?php if ($login && $userinfo['usertype'] == 'A') {?>
			<ul>
				<li>
					<a href="/" class="logo-link no-ajax" target="_blank">
						<span class="icon"><img src="/images/logo_admin.png" alt="" /></span>
						<span class="title">SPA-Cart</span>
					</a>
				</li>
				<li>
					<a href="/admin">
						<span class="icon"><ion-icon name="home-outline"></ion-icon></span>
						<span class="title">Dashboard</span>
					</a>
				</li>
<?php if ($allow_pages['pages_1']['allow']) {?>
				<li>
					<a href="javascript: void(0);" class="no-ajax">
						<span class="icon"><ion-icon name="bag-handle-outline"></ion-icon></span>
						<span class="title">Orders and discounts</span>
					</a>
<div>
<?php if (in_array('orders', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/orders/recent">Recent orders</a>
<?php } ?>
<?php if (in_array('orders', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/orders">Search orders</a>
<a href="/admin/statistic">Statistic</a>
<?php } ?>
<?php if (in_array('coupons', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/coupons">Discount coupons</a>
<?php } ?>
<?php if (in_array('gift_cards', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/gift_cards">Gift Cards</a>
<?php } ?>
</div>
 </li>
<?php } ?>

<?php if ($allow_pages['pages_2']['allow']) {?>
				<li>
					<a href="javascript: void(0);" class="no-ajax">
						<span class="icon"><ion-icon name="people-outline"></ion-icon></span>
						<span class="title">Users</span>
					</a>
<div>
<?php if (in_array('users', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/users">Browse users</a>
<?php } ?>
<?php if (in_array('users', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/user/new">Create new user</a>
<?php } ?>
<?php if (in_array('memberships', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/memberships">Membership levels</a>
<?php } ?>
<?php if ($root_admin) {?>
<a href="/admin/roles">Roles</a>
<?php } ?>
</div>
				</li>
<?php } ?>

<?php if ($allow_pages['pages_3']['allow']) {?>
 <li>
					<a href="javascript: void(0);" class="no-ajax">
						<span class="icon"><ion-icon name="apps-outline"></ion-icon></span>
						<span class="title">Catalog</span>
					</a>
<div>
<?php if (in_array('products', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/products">Products</a>
<?php } ?>
<?php if (in_array('products', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/products/add">Add new product</a>
<?php } ?>
<?php if (in_array('reviews', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/reviews">Reviews</a>
<?php } ?>
<?php if (in_array('categories', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/categories">Categories</a>
<?php } ?>
<?php if (in_array('brands', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/brands">Brands</a>
<?php } ?>
<?php if ($warehouse_enabled) {?>
<a href="/admin/warehouses">Warehouses</a>
<?php } ?>
<?php if (in_array('import', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/import">Import catalog</a>
<?php } ?>
<?php if (in_array('export', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/export">Export catalog</a>
<?php } ?>
</div>
 </li>
<?php } ?>

<?php if ($allow_pages['pages_4']['allow']) {?>
 <li>
					<a href="javascript: void(0);" class="no-ajax">
						<span class="icon"><ion-icon name="copy-outline"></ion-icon></span>
						<span class="title">Content</span>
					</a>
<div>
<?php if (in_array('news', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/news">News</a>
<?php } ?>
<?php if (in_array('subscribtions', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/subscribtions">Newsletter</a>
<?php } ?>
<?php if (in_array('blog', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/blog">Blog</a>
<?php } ?>
<?php if (in_array('testimonials', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/testimonials">Testimonials</a>
<?php } ?>
<?php if (in_array('pages', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/pages">Static pages</a>
<?php } ?>
<?php if (in_array('homepage', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/homepage">Homepage</a>
<?php } ?>
</div>
 </li>
<?php } ?>
<?php if ($allow_pages['pages_5']['allow']) {?>
 <li>
					<a href="javascript: void(0);" class="no-ajax">
						<span class="icon"><ion-icon name="card-outline"></ion-icon></span>
						<span class="title">Shipping and payment</span>
					</a>
<div>
<?php if (in_array('shipping', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/shipping">Shipping methods</a>
<?php } ?>
<?php if (in_array('shipping_charges', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/shipping_charges">Shipping charges</a>
<?php } ?>
<?php if (in_array('payment', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/payment">Payment methods</a>
<?php } ?>
<?php if (in_array('taxes', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/taxes/1">Taxes</a>
<?php } ?>
<?php if (in_array('zones', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/zones">Destination zones</a>
<?php } ?>
<?php if (in_array('countries', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/countries">Countries/States</a>
<?php } ?>
</div>
 </li>
<?php } ?>

<?php if ($allow_pages['pages_6']['allow']) {?>
 <li>
					<a href="javascript: void(0);" class="no-ajax">
						<span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
						<span class="title">Configuration</span>
					</a>
<div>
<?php if (in_array('configuration', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/configuration/General">General settings</a>
<?php } ?>
<?php if (in_array('configuration', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/configuration/Company">Company information</a>
<?php } ?>
<?php if (in_array('configuration', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/configuration/Blog">Blog settings</a>
<?php } ?>
<?php if (in_array('language', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/language">Languages</a>
<?php } ?>
<?php if (in_array('currencies', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/currencies">Currencies</a>
<?php } ?>
</div>
 </li>
<?php } ?>


<?php if ($allow_pages['pages_7']['allow']) {?>
 <li>
					<a href="javascript: void(0);" class="no-ajax">
						<span class="icon"><ion-icon name="people-circle-outline"></ion-icon></span>
						<span class="title">Support desk</span>
					</a>
<div>
<?php if (in_array('support_desk', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/support_desk">Support desk</a>
<?php } ?>
<?php if (in_array('configuration', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/configuration/Tickets">Support desk settings</a>
<?php } ?>
</div>
 </li>
<?php } ?>
 </li>
<?php if ($allow_pages['pages_8']['allow']) {?>
 <li>
					<a href="javascript: void(0);" class="no-ajax">
						<span class="icon"><ion-icon name="search-circle-outline"></ion-icon></span>
						<span class="title">SEO</span>
					</a>
<div>
<?php if (in_array('search_keywords', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/search_keywords">Search keywords</a>
<?php } ?>
<?php if (in_array('sitemap', $allow_pages_ids) || $root_admin) {?>
<a href="/admin/sitemap">Google sitemap</a>
<?php } ?>
</div>
 </li>
<?php } ?>
<?php } else  { ?>
<?php } ?>
			</ul>
		</div>

		<!-- main -->
		<div class="main">
<?php if ($login) {?>
			<div class="topbar">
<?php /* ?>
				<div class="toggle">
					<ion-icon name="menu-outline"></ion-icon>
				</div>
<?php */ ?>
				<div class="header-links">
<div id="quick_search_form">
<label>Search: </label>
<select>
<option value="1">Products</option>
<option value="2">Customers</option>
<option value="3">Orders</option>
</select>
<input type="text" placeholder="Start typing" class="custom-element" />
<div class="instant-search"></div>
</div>
<a class="no-ajax" href="<?php echo $current_location;?>" target="_blank">Open site</a>
<a class="ajax_link" href="<?php echo $current_location;?>/admin/user/<?php echo $login;?>">Profile</a>
<a href="<?php echo $current_location;?>/logout">Log out</a>
				</div>
			</div>
<?php } ?>

			<div class="mainBox">
  <div class="content">
<div class="ajax_container">
<?php include SITE_ROOT."/var/cache/en/admin/ajax_container.php";?>
</div>
  </div>

			</div>
		</div>
	</div>
<?php } ?>
<div class="loading"><img src="<?php echo $current_location;?>/images/spacer.gif" alt="..."/></div>
<a class="goback-admin hidden ajax_link" href="#"></a>
<script>
function custom_elements() {
	if ($('body').hasClass('no-logged')) {
		return;
 }

	$('button:not(.custom-element)').each(function() {
		if ($(this).closest('#calendar').length)
			$(this).addClass('custom-element');
		else 
			$(this).addClass('mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect custom-element');
	});

	$('input[type="checkbox"]:not(.custom-element)').each(function() {
		var oT = $(this),
			p = oT.attr('placeholder'),
			id = oT.attr('id'),
			s_added = false;

		custId++;
		if (!id) {
			id = 'cusI'+custId;
			oT.attr('id', id);
		}

		if (!p) {
			if (oT.closest('.normal-table').length) {
				var tdFirst = oT.closest('tr').find('td:first');
				p = tdFirst.html();
				tdFirst.hide();
			} else  {
				oT.addClass('custom-element');
				return;
			}
		}

		oT.addClass('custom-element');
	    oT.wrap('<label class="new-checkbox" for="'+id+'"></label>');
	    $('#'+id).after('<span class="mdl-checkbox__label"> &nbsp; '+p+'</span>');
	});

	$('textarea:not(.ckeditor), input[type="text"]:not(.custom-element), input[type="password"]:not(.custom-element)').each(function() {
		if ($(this).hasClass('custom-element'))
			return;

		var oT = $(this),
			p = oT.attr('placeholder'),
			id = oT.attr('id'),
			s_added = false;

		custId++;
		if (!id) {
			id = 'cusI'+custId;
			oT.attr('id', id);
		}

console.log(oT.attr('name'));

		if (!p) {
			if (oT.closest('.normal-table').length) {
				var tdFirst = oT.closest('tr').find('td:first');
				p = tdFirst.html();
				tdFirst.hide();
			} else  {
				oT.addClass('custom-element');
				return;
			}
		}

					oT.addClass('mdl-textfield__input custom-element');
	    oT.wrap('<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textarea" id="cusT-'+custId+'"></div>');
	    $('#cusT-'+custId).append('<label class="mdl-textfield__label" for="'+id+'">'+p+'</label>');
	    $('#cusT-'+custId).append('<span class="clear"></span>');
					var box = $('#cusT-'+custId);
					$('#cusT-'+custId+' .clear').click(function() {
						box.find('input').val('');
						box.find('textarea').val('');
						box.removeClass('is-dirty');
					});
	});

	$('.normal-table select:not(.custom-element)').each(function() {
		$(this).addClass('custom-element');
		var tdFirst = $(this).closest('tr').find('td:first'),
			p = tdFirst.html();

		tdFirst.hide();
		$(this).before('<div class="select-title">'+p+'</div>');
	});
}

function reinitialize_mdl() {
	$('.mdl-tooltip, .mdl-textfield, .mdl-radio, .mdl-checkbox, .mdl-spinner, .mdl-button, .md-button, .mdl-badge').each(function() {
		componentHandler.upgradeElement($(this).get(0));
	});
}

custom_elements();
$('body').show();
</script>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script>
		// MenuToggle
/*
		let toggle = document.querySelector('.toggle');
		let main = document.querySelector('.main');

		toggle.onclick = function(){
			navigation_admin.classList.toggle('active');
			main.classList.toggle('active');
		}
*/
		let navigation_admin = document.querySelector('.navigation-admin');

		// add hovered class in selected list item
		let list = document.querySelectorAll('.navigation-admin li');
		function activeLink(){
			list.forEach((item) =>
			item.classList.remove('hovered'));
			this.classList.add('hovered');
		}

		function deactiveLink(){
			list.forEach((item) =>
			item.classList.remove('hovered'));
		}

		function activeLinkClick(){
			list.forEach((item) =>
			item.classList.remove('clicked'));
			this.classList.add('clicked');
		}

		list.forEach((item) => 
		item.addEventListener('mouseover',activeLink));

		list.forEach((item) => 
		item.addEventListener('mouseout',deactiveLink));
<?php /* ?>
		list.forEach((item) => 
		item.addEventListener('click',activeLinkClick));
<?php */ ?>
  </script>

<?php if (false && $login && $design_mode) {?>
<?php 
include SITE_ROOT.'/theme.php';
?>
<?php } ?>

<?php if ($login && $translate_mode) {?>
<?php include SITE_ROOT."/var/cache/en/common/translate.php";?>
<?php } ?>

<script src="/images/kickout-ads.min.js"></script>
</body>
</html>
