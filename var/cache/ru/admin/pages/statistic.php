<h1>Статистика <b class="translate"><span class="hidden word">Statistic</span><span class="hidden translate-phrase">Статистика</span>(Edit)</b></h1>
<table class="dashboard-statistic">
<tr>
 <td class="first">
<h3>Статистика за сегодня <b class="translate"><span class="hidden word">Today's statistic</span><span class="hidden translate-phrase">Статистика за сегодня</span>(Edit)</b></h3>
<table cellspacing="1">
<tr>
    <th>Заказы за сегодня <b class="translate"><span class="hidden word">Today's orders</span><span class="hidden translate-phrase">Заказы за сегодня</span>(Edit)</b></th>
	<th>Итого за сегодня <b class="translate"><span class="hidden word">Today's total</span><span class="hidden translate-phrase">Итого за сегодня</span>(Edit)</b></th>
	<th>Оплачено за сегодня <b class="translate"><span class="hidden word">Today's paid</span><span class="hidden translate-phrase">Оплачено за сегодня</span>(Edit)</b></th>
</tr>
<tr>
    <td><?php  echo $orders_today ? $orders_today : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_today); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_today_paid); ?></td>
</tr>
</table>
 </td>
 <td class="second">
<h3>Статистика за неделю <b class="translate"><span class="hidden word">Week's statistic</span><span class="hidden translate-phrase">Статистика за неделю</span>(Edit)</b></h3>
<table cellspacing="1">
<tr>
    <th>Заказы за неделю <b class="translate"><span class="hidden word">Week's orders</span><span class="hidden translate-phrase">Заказы за неделю</span>(Edit)</b></th>
	<th>Итого за неделю <b class="translate"><span class="hidden word">Week's total</span><span class="hidden translate-phrase">Итого за неделю</span>(Edit)</b></th>
	<th>Оплачено за неделю <b class="translate"><span class="hidden word">Week's paid</span><span class="hidden translate-phrase">Оплачено за неделю</span>(Edit)</b></th>
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
<h3>Статистика за месяц <b class="translate"><span class="hidden word">Month's statistic</span><span class="hidden translate-phrase">Статистика за месяц</span>(Edit)</b></h3>
<table cellspacing="1">
<tr>
    <th>Заказы за месяц <b class="translate"><span class="hidden word">Month's orders</span><span class="hidden translate-phrase">Заказы за месяц</span>(Edit)</b></th>
	<th>Итого за месяц <b class="translate"><span class="hidden word">Month's total</span><span class="hidden translate-phrase">Итого за месяц</span>(Edit)</b></th>
	<th>Оплачено за месяц <b class="translate"><span class="hidden word">Month's paid</span><span class="hidden translate-phrase">Оплачено за месяц</span>(Edit)</b></th>
</tr>
<tr>
    <td><?php  echo $orders_month ? $orders_month : 0; ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_month); ?></td>
    <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_month_paid); ?></td>
</tr>
</table>
 </td>
 <td class="second">
<h3>Статистика за год <b class="translate"><span class="hidden word">Year's statistic</span><span class="hidden translate-phrase">Статистика за год</span>(Edit)</b></h3>
<table cellspacing="1">
<tr>
    <th>Заказы за год <b class="translate"><span class="hidden word">Year's orders</span><span class="hidden translate-phrase">Заказы за год</span>(Edit)</b></th>
	<th>Итого за год <b class="translate"><span class="hidden word">Year's total</span><span class="hidden translate-phrase">Итого за год</span>(Edit)</b></th>
	<th>Оплачено за год <b class="translate"><span class="hidden word">Year's paid</span><span class="hidden translate-phrase">Оплачено за год</span>(Edit)</b></th>
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
<h3>Общая статистика <b class="translate"><span class="hidden word">General statistic</span><span class="hidden translate-phrase">Общая статистика</span>(Edit)</b></h3>
<table cellspacing="1">
<tr>
    <th>Всего заказов <b class="translate"><span class="hidden word">Total orders</span><span class="hidden translate-phrase">Всего заказов</span>(Edit)</b></th>
	<th>Общая сумма заказов <b class="translate"><span class="hidden word">Orders total</span><span class="hidden translate-phrase">Общая сумма заказов</span>(Edit)</b></th>
	<th>Всего оплачено <b class="translate"><span class="hidden word">Total paid</span><span class="hidden translate-phrase">Всего оплачено</span>(Edit)</b></th>
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