<table width="1000">
<tr>
 <td width="50%">
<h1>Shipping info</h1>
<form method="POST">
<input type="text" name="tracking" placeholder="Tracking number" value="<?php echo escape($order['tracking'], 2); ?>" />
<br >
<input type="text" name="tracking_url" placeholder="Tracking URL" value="<?php echo escape($order['tracking_url'], 2); ?>" />
<br >
<button type="submit">Save</button>
</form>
 </td>
 <td>
<h1>Order #<?php  echo $order['orderid']; ?> (	<select id="status">
<?php 
		foreach ($order_statuses as $k=>$v) {
			echo '<option value="'.$k.'"'.($k == $order['status'] ? ' selected' : '').'>'.$v.'</option>';
		}
?>
</select>
<button onclick="javascript: self.location='/admin/invoice/<?php  echo $order['orderid']; ?>/status/'+$('#status').val();">Save</button>
)</h1>
<small>Chagned status will be sent to customer</small>
<br /><br />
<div>Order date: <?php  echo date($datetime_format, $order['date']); ?></div>
<div class="clear"></div>
<?php if ($order['transaction_id']) {?>
Transaction #: <?php echo $order['transaction_id'];?>
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
<?php include SITE_ROOT."/var/cache/en/invoice/body.php";?>