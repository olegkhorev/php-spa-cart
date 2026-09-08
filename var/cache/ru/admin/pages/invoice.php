<table width="1000">
<tr>
 <td width="50%">
<h1>Shipping info</h1>
<form method="POST">
<input type="text" name="tracking" placeholder="Tracking number <b class="translate"><span class="hidden word">Tracking number</span><span class="hidden translate-phrase">Tracking number</span>(Edit)</b>" value="<?php echo escape($order['tracking'], 2); ?>" />
<br >
<input type="text" name="tracking_url" placeholder="Tracking URL <b class="translate"><span class="hidden word">Tracking URL</span><span class="hidden translate-phrase">Tracking URL</span>(Edit)</b>" value="<?php echo escape($order['tracking_url'], 2); ?>" />
<br >
<button type="submit">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
</form>
 </td>
 <td>
<h1>Заказ <b class="translate"><span class="hidden word">Order</span><span class="hidden translate-phrase">Заказ</span>(Edit)</b> #<?php  echo $order['orderid']; ?> (	<select id="status">
<?php 
		foreach ($order_statuses as $k=>$v) {
			echo '<option value="'.$k.'"'.($k == $order['status'] ? ' selected' : '').'>'.$v.'</option>';
		}
?>
</select>
<button onclick="javascript: self.location='/admin/invoice/<?php  echo $order['orderid']; ?>/status/'+$('#status').val();">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
)</h1>
<small>Chagned status will be sent to customer <b class="translate"><span class="hidden word">Chagned status will be sent to customer</span><span class="hidden translate-phrase">Chagned status will be sent to customer</span>(Edit)</b></small>
<br /><br />
<div>Дата заказа <b class="translate"><span class="hidden word">Order date</span><span class="hidden translate-phrase">Дата заказа</span>(Edit)</b>: <?php  echo date($datetime_format, $order['date']); ?></div>
<div class="clear"></div>
<?php if ($order['transaction_id']) {?>
ID транзакции <b class="translate"><span class="hidden word">Transaction</span><span class="hidden translate-phrase">ID транзакции</span>(Edit)</b> #: <?php echo $order['transaction_id'];?>
<br />
<?php if ($order['payment_indent']) {?>
Payment Indent: <?php echo $order['payment_indent'];?>
<br />
<?php } ?>
<br />
<?php } ?>
 </td>
</tr>
</table>
<br /><br />
<?php include SITE_ROOT."/var/cache/ru/invoice/body.php";?>