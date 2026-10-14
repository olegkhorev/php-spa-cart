<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php
$template['location'] .= ' &gt; '.lng('Statistic');
$template['head_title'] = lng('Statistic').' :: '.$template['head_title'];

$today = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
$orders_today = [];
$orders = $db->all("SELECT orderid, date, total FROM orders WHERE date>=".$today);
foreach ($orders as $k => $v) {
    $orders_today[date('m/d', $v['date'])] += $v['total'];
}

$template['orders_today'] = $orders_today;
$template['total_today'] = $db->field("SELECT SUM(total) FROM orders WHERE date>=".$today);
$template['total_today_paid'] = $db->field("SELECT SUM(total) FROM orders WHERE status IN ('2', '3', '6') AND date>=".$today);

$first_weekday = time() - date("w") * 86400;
$week = mktime(0, 0, 0, date("n", $first_weekday), date("j", $first_weekday), date("Y", $first_weekday));
$orders_week = [];
$orders = $db->all("SELECT orderid, date, total FROM orders WHERE date>=".$week);
foreach ($orders as $k => $v) {
    $orders_week[date('m/d', $v['date'])] += $v['total'];
}

$template['orders_week'] = $orders_week;
$template['total_week'] = $db->field("SELECT SUM(total) FROM orders WHERE date>=".$week);
$template['total_week_paid'] = $db->field("SELECT SUM(total) FROM orders WHERE status IN ('2', '3', '6') AND date>=".$week);

$month = mktime(0, 0, 0, date("n"), 1, date("Y"));
$orders_month = [];
$orders = $db->all("SELECT orderid, date, total FROM orders WHERE date>=".$month);
foreach ($orders as $k => $v) {
    $orders_month[date('m/d', $v['date'])] += $v['total'];
}

$template['orders_month'] = $orders_month;
$template['total_month'] = $db->field("SELECT SUM(total) FROM orders WHERE date>=".$month);
$template['total_month_paid'] = $db->field("SELECT SUM(total) FROM orders WHERE status IN ('2', '3', '6') AND date>=".$month);

$year = mktime(0, 0, 0, 1, 1, date("Y"));
$template['orders_year'] = $db->field("SELECT COUNT(orderid) FROM orders WHERE date>=".$year);
$template['total_year'] = $db->field("SELECT SUM(total) FROM orders WHERE date>=".$year);
$template['total_year_paid'] = $db->field("SELECT SUM(total) FROM orders WHERE status IN ('2', '3', '6') AND date>=".$year);

$template['orders_all'] = $db->field("SELECT COUNT(orderid) FROM orders");
$template['total_all'] = $db->field("SELECT SUM(total) FROM orders");
$template['total_all_paid'] = $db->field("SELECT SUM(total) FROM orders WHERE status IN ('2', '3', '6')");

$template['page'] = get_template_contents('admin/pages/statistic.php');
$template['css'][] = 'admin_statistic';
