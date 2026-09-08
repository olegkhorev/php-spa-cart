<table class="db-stats-1" cellspacing="30">
<tr>
 <td class="ajax_link td-1" href='/admin/products'><span><?php echo $products;?></span><h2>Товары</h2></td>
 <td class="ajax_link td-2" href='/admin/orders'><span><?php echo $orders_count;?></span><h2>Заказы</h2></td>
 <td class="ajax_link td-3" href='/admin/users'><span><?php echo $users;?></span><h2>Клиенты</h2></td>
 <td class="ajax_link td-4" href='/admin/categories'><span><?php echo $categories;?></span><h2>Категории</h2></td>
</tr>
</table>

<table class="db-stats-2" cellspacing="30">
<tr>
 <td class="ajax_link td-1" href='/admin/news'><span><?php echo $news;?></span><h2>Новости</h2></td>
 <td class="ajax_link td-2" href='/admin/subscribtions'><span><?php echo $subscribers;?></span><h2>Подписчики</h2></td>
 <td class="ajax_link td-3" href='/admin/blog'><span><?php echo $blogs;?></span><h2>Блоги</h2></td>
 <td class="ajax_link td-4" href='/admin/pages'><span><?php echo $static_pages;?></span><h2>Страницы</h2></td>
</tr>
<tr>
 <td class="ajax_link td-5" href='/admin/testimonials'><span><?php echo $testimonials;?></span><h2>Отзывы</h2></td>
 <td class="ajax_link td-6" href='/admin/gift_cards'><span><?php echo $gift_cards;?></span><h2>Подарочные карты</h2></td>
 <td class="ajax_link td-7" href='/admin/coupons'><span><?php echo $coupons;?></span><h2>Купоны</h2></td>
 <td class="ajax_link td-8" href='/admin/memberships'><span><?php echo $memberships;?></span><h2>Группы членства</h2></td>
</tr>
</table>

<table class="db-stats-3" cellspacing="30">
<tr>
 <td>
<h3>Рекомендуемые товары<a class="float-right" target="_blank" href="/admin/categories">(Управление)</a></h3>
<?php 
$products = $featured_products;
$type = 'F';
?>
<?php include SITE_ROOT."/var/cache/ru/admin/pages/dashboard_products.php";?>
 </td>
 <td>
<h3>Новые поступления</h3>
<?php 
$products = $new_arrivals;
$type = 'N';
?>
<?php include SITE_ROOT."/var/cache/ru/admin/pages/dashboard_products.php";?>
 </td>
 <td>
<h3>Бестселлеры</h3>
<?php 
$products = $bestsellers;
$type = 'B';
?>
<?php include SITE_ROOT."/var/cache/ru/admin/pages/dashboard_products.php";?>
 </td>
 <td>
<h3>Наиболее просмотренные</h3>
<?php 
$products = $most_viewed;
$type = 'M';
?>
<?php include SITE_ROOT."/var/cache/ru/admin/pages/dashboard_products.php";?>
 </td>
</tr>
</table>

<?php /* ?>
<table class="dashboard-statistic">
<tr>
 <td class="first">
<h3>Статистика за сегодня</h3>
<table cellspacing="1">
<tr>
    <th>Заказы за сегодня</th>
	<th>Итого за сегодня</th>
	<th>Оплачено за сегодня</th>
</tr>
<tr>
    <td><?php  echo $orders_today ? $orders_today : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_today); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_today_paid); ?></td>
</tr>
</table>
 </td>
 <td class="second">
<h3>Статистика за неделю</h3>
<table cellspacing="1">
<tr>
    <th>Заказы за неделю</th>
	<th>Итого за неделю</th>
	<th>Оплачено за неделю</th>
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
<h3>Статистика за месяц</h3>
<table cellspacing="1">
<tr>
    <th>Заказы за месяц</th>
	<th>Итого за месяц</th>
	<th>Оплачено за месяц</th>
</tr>
<tr>
    <td><?php  echo $orders_month ? $orders_month : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_month); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_month_paid); ?></td>
</tr>
</table>
 </td>
 <td class="second">
<h3>Статистика за год</h3>
<table cellspacing="1">
<tr>
    <th>Заказы за год</th>
	<th>Итого за год</th>
	<th>Оплачено за год</th>
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
<h3>Общая статистика</h3>
<table cellspacing="1">
<tr>
    <th>Всего заказов</th>
	<th>Общая сумма заказов</th>
	<th>Всего оплачено</th>
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