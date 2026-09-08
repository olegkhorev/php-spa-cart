<table class="db-stats-1" cellspacing="30">
<tr>
 <td class="ajax_link td-1" href='/admin/products'><span><?php echo $products;?></span><h2>Products</h2></td>
 <td class="ajax_link td-2" href='/admin/orders'><span><?php echo $orders_count;?></span><h2>Orders</h2></td>
 <td class="ajax_link td-3" href='/admin/users'><span><?php echo $users;?></span><h2>Customers</h2></td>
 <td class="ajax_link td-4" href='/admin/categories'><span><?php echo $categories;?></span><h2>Categories</h2></td>
</tr>
</table>

<table class="db-stats-2" cellspacing="30">
<tr>
 <td class="ajax_link td-1" href='/admin/news'><span><?php echo $news;?></span><h2>News</h2></td>
 <td class="ajax_link td-2" href='/admin/subscribtions'><span><?php echo $subscribers;?></span><h2>Subscribers</h2></td>
 <td class="ajax_link td-3" href='/admin/blog'><span><?php echo $blogs;?></span><h2>Blogs</h2></td>
 <td class="ajax_link td-4" href='/admin/pages'><span><?php echo $static_pages;?></span><h2>Pages</h2></td>
</tr>
<tr>
 <td class="ajax_link td-5" href='/admin/testimonials'><span><?php echo $testimonials;?></span><h2>Testimonials</h2></td>
 <td class="ajax_link td-6" href='/admin/gift_cards'><span><?php echo $gift_cards;?></span><h2>Gift Cards</h2></td>
 <td class="ajax_link td-7" href='/admin/coupons'><span><?php echo $coupons;?></span><h2>Coupons</h2></td>
 <td class="ajax_link td-8" href='/admin/memberships'><span><?php echo $memberships;?></span><h2>Memberships</h2></td>
</tr>
</table>


<div class="income_all_chart hidden"><?php echo json_encode($last_30_days_all); ?></div>
<?php /* ?>
<div class="income_paid_chart hidden"><?php echo json_encode($last_30_days_paid); ?></div>
<?php */ ?>
<h1>All orders</h1>
<div class="chart-container chart-container--line" style="max-width: calc(100% - 60px);">
<canvas id="chart-line"></canvas>
</div>
<br /><br />

<table class="db-stats-3" cellspacing="30">
<tr>
 <td>
<h3>Featured products<a class="float-right" target="_blank" href="/admin/categories">(Manage)</a></h3>
<?php 
$products = $featured_products;
$type = 'F';
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/dashboard_products.php";?>
 </td>
 <td>
<h3>New arrivals</h3>
<?php 
$products = $new_arrivals;
$type = 'N';
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/dashboard_products.php";?>
 </td>
 <td>
<h3>Bestsellers</h3>
<?php 
$products = $bestsellers;
$type = 'B';
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/dashboard_products.php";?>
 </td>
 <td>
<h3>Most viewed</h3>
<?php 
$products = $most_viewed;
$type = 'M';
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/dashboard_products.php";?>
 </td>
</tr>
</table>

<?php /* ?>
<table class="dashboard-statistic">
<tr>
 <td class="first">
<h3>Today's statistic</h3>
<table cellspacing="1">
<tr>
    <th>Today's orders</th>
	<th>Today's total</th>
	<th>Today's paid</th>
</tr>
<tr>
    <td><?php  echo $orders_today ? $orders_today : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_today); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_today_paid); ?></td>
</tr>
</table>
 </td>
 <td class="second">
<h3>Week's statistic</h3>
<table cellspacing="1">
<tr>
    <th>Week's orders</th>
	<th>Week's total</th>
	<th>Week's paid</th>
</tr>
<tr>
    <td><?php  echo $orders_week ? $orders_week : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_week); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_week_paid); ?></td>
</tr>
</table>
 </td>
</tr>
<tr>
 <td class="first">
<h3>Month's statistic</h3>
<table cellspacing="1">
<tr>
    <th>Month's orders</th>
	<th>Month's total</th>
	<th>Month's paid</th>
</tr>
<tr>
    <td><?php  echo $orders_month ? $orders_month : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_month); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_month_paid); ?></td>
</tr>
</table>
 </td>
 <td class="second">
<h3>Year's statistic</h3>
<table cellspacing="1">
<tr>
    <th>Year's orders</th>
	<th>Year's total</th>
	<th>Year's paid</th>
</tr>
<tr>
    <td><?php  echo $orders_year ? $orders_year : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_year); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_year_paid); ?></td>
</tr>
</table>
 </td>
</tr>
<tr>
 <td class="first">
<h3>General statistic</h3>
<table cellspacing="1">
<tr>
    <th>Total orders</th>
	<th>Orders total</th>
	<th>Total paid</th>
</tr>
<tr>
    <td><?php  echo $orders_all ? $orders_all : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_all); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_all_paid); ?></td>
</tr>
</table>
 </td>
 <td></td>
</tr>

</table>
<?php */ ?>

<?php /* ?>
<table class="dashboard">
<tr>
 <td class="first">
<h3>Bestsellers</h3>
<ul>
<?php 
foreach ($bestsellers as $v) {
		echo '<li><a href="/admin/products/'.$v['productid'].'">'.$v['name'].'</a> ('.$v['sales_stats'].' sales)</li>';
	}
?>
</ul>
 </td>
 <td class="second">
<h3>Most viewed</h3>
<ul>
<?php 
foreach ($most_viewed as $v) {
		echo '<li><a href="/admin/products/'.$v['productid'].'">'.$v['name'].'</a> ('.$v['views_stats'].' views)</li>';
	}
?>
</ul>
 </td>
</tr>
</table>
<?php */ ?>