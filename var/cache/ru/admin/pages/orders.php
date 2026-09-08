<?php 
if ($get['2'] != 'recent') {?>
<form method="POST">
<input type="hidden" name="mode" value="search" />
<table cellspacing="1" cellpadding="3" class="orders_search">
<tr>
 <td align="right">Идентификатор заказа <b class="translate"><span class="hidden word">Order #ID</span><span class="hidden translate-phrase">Идентификатор заказа</span>(Edit)</b></td>
 <td><input type="text" name="orderid" size="5" value="<?php  echo $search_orders['orderid']; ?>" /></td>
</tr>
<tr>
 <td align="right">Электронная почта <b class="translate"><span class="hidden word">Email</span><span class="hidden translate-phrase">Электронная почта</span>(Edit)</b></td>
 <td><input type="text" name="email" value="<?php  echo $search_orders['email']; ?>" /></td>
</tr>
<tr>
 <td align="right">Customer name <b class="translate"><span class="hidden word">Customer name</span><span class="hidden translate-phrase">Customer name</span>(Edit)</b></td>
 <td><input type="text" name="customer" value="<?php  echo $search_orders['customer']; ?>" /></td>
</tr>
<tr>
 <td align="right">Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></td>
 <td><select name="status"><option value="">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
<?php 
	foreach ($order_statuses as $k2=>$v2) {
		echo '<option value="'.$k2.'"'.($k2 == $search_orders['status'] ? ' selected' : '').'>'.$v2.'</option>';
	}
?>
</select>
 </td>
</tr>
<tr>
 <td valign="top" width="170" align="right">Поиск по дате <b class="translate"><span class="hidden word">Search by date</span><span class="hidden translate-phrase">Поиск по дате</span>(Edit)</b></td>
 <td>
<label><input type="radio" name="date_period" value="0"<?php  if (!$search_orders['date_period']) echo ' checked="checked"'; ?> /> Все даты <b class="translate"><span class="hidden word">All dates</span><span class="hidden translate-phrase">Все даты</span>(Edit)</b></label><br />
<label><input type="radio" name="date_period" value="1"<?php  if ($search_orders['date_period'] == '1') echo ' checked="checked"'; ?> /> За сегодня <b class="translate"><span class="hidden word">Today</span><span class="hidden translate-phrase">За сегодня</span>(Edit)</b></label><br />
<label><input type="radio" name="date_period" value="2"<?php  if ($search_orders['date_period'] == '2') echo ' checked="checked"'; ?> /> За неделю <b class="translate"><span class="hidden word">This week</span><span class="hidden translate-phrase">За неделю</span>(Edit)</b></label><br />
<label><input type="radio" name="date_period" value="3"<?php  if ($search_orders['date_period'] == '3') echo ' checked="checked"'; ?> /> За месяц <b class="translate"><span class="hidden word">This month</span><span class="hidden translate-phrase">За месяц</span>(Edit)</b></label><br />
<label><input type="radio" name="date_period" value="4"<?php  if ($search_orders['date_period'] == '4') echo ' checked="checked"'; ?> /> Диапазон дат <b class="translate"><span class="hidden word">Date period</span><span class="hidden translate-phrase">Диапазон дат</span>(Edit)</b>:</label><br />
<input type="text" id="date_from" name="date_from" value="<?php  echo $search_orders['date_from']; ?>" size="7" /> - <input type="text" id="date_to" name="date_to" value="<?php  echo $search_orders['date_to']; ?>" size="7" />
 </td>
</tr>
<tr>
 <td></td>
 <td><br /><button>Поиск <b class="translate"><span class="hidden word">Search</span><span class="hidden translate-phrase">Поиск</span>(Edit)</b></button> &nbsp; <a href="<?php echo $current_location;?>/admin/orders/reset">Сбросить фильтр <b class="translate"><span class="hidden word">Reset filter</span><span class="hidden translate-phrase">Сбросить фильтр</span>(Edit)</b></a></td>
</tr>
</table>
</form>
<h3>Результаты поиска <b class="translate"><span class="hidden word">Search results</span><span class="hidden translate-phrase">Результаты поиска</span>(Edit)</b></h3>
<?php 
} else  {
?>
<h3>Последние заказы <b class="translate"><span class="hidden word">Recent orders</span><span class="hidden translate-phrase">Последние заказы</span>(Edit)</b></h3>
<?php 
}
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<?php 
	echo '<br />';
}
?>

<form method="POST">
<?php 
if ($orders) {
?>
<table cellspacing="1" cellpadding="14" width="700" class="lines-table">
<tr>
 <th>#</th>
 <th>Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></th>
 <th>Клиент <b class="translate"><span class="hidden word">Customer</span><span class="hidden translate-phrase">Клиент</span>(Edit)</b></th>
 <th>Дата <b class="translate"><span class="hidden word">Date</span><span class="hidden translate-phrase">Дата</span>(Edit)</b></th>
 <th>Итого <b class="translate"><span class="hidden word">Total</span><span class="hidden translate-phrase">Итого</span>(Edit)</b></th>
</tr>
<?php 
	$total = 0;
	$total_paid = 0;
	foreach ($orders as $k=>$v) {		if ($v['status'] == '2' || $v['status'] == '3' || $v['status'] == '6')
			$total_paid += $v['total'];

		$total += $v['total'];

		echo '
		<tr>
			<td width="10"><a href="/admin/invoice/'.$v['orderid'].'">#'.$v['orderid'].'</a></td>
			<td width="100">
				<select name="status['.$v['orderid'].']">';
		foreach ($order_statuses as $k2=>$v2) {			echo '<option value="'.$k2.'"'.($k2 == $v['status'] ? ' selected' : '').'>'.$v2.'</option>';		}

		echo '</select>';
		if ($v['gift_card'])
			echo '<b>Paid with GC</b>';
#echo '<pre>';
#exit(print_R($v));

		echo '</td>
			<td nowrap><a href="/admin/user/'.$v['userid'].'">'.$v['firstname'].' '.$v['lastname'].' ('.$v['email'].')</a></td>
			<td width="130" nowrap><a href="/admin/invoice/'.$v['orderid'].'">'.date($datetime_format, $v['date']).'</a></td>
			<td align="right"><a href="/admin/invoice/'.$v['orderid'].'">$'.$v['total'].'</a></td>
		</tr>
		';
  	}

	echo '<tr><td colspan="5" align="right"><hr />Итого <b class="translate"><span class="hidden word">Total</span><span class="hidden translate-phrase">Итого</span>(Edit)</b>: $'.$total.'</td></tr>';
	echo '<tr><td colspan="5" align="right"><b>Всего оплачено <b class="translate"><span class="hidden word">Total Paid</span><span class="hidden translate-phrase">Всего оплачено</span>(Edit)</b>: $'.$total_paid.'</b></td></tr>';
	echo '</table>';
?>
<div class="fixed_save_button">
<button>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
</div>

<?php 
} else  echo 'No orders found.';
?>
</form>