<h1>Statistic</h1>
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