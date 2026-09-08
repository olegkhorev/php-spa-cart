<?php if ($get['2'] != 'print' && !$is_mail) {?> <?php if ($get['2'] == 'success') {?><div style="padding: 0 0 20px 0;">Your order placed successfully.</div>
 <?php } else if ($get['2'] == 'failed') {?><div style="padding: 0 0 20px 0; color: red;">We are unable to process your order.</div>
 <?php } ?>
<a href="/invoice/<?php echo $order['orderid'];?>/print" target="_blank" onclick="javascript: return print_invoice($(this));">Print invoice</a>
<br /><br /><?php } ?>
<div style="width: 650px; margin: 0 auto; background: #fff; padding: 10px; <?php if ($get['2'] != 'print' && !$is_mail) {?>border: 1px solid #ccc;<?php } ?>" class="invoice">
<h1 style="text-align: center;">Invoice</h1>
<h1 class="invoice-title"><span style="float: right;"><?php echo date($datetime_format, $order['date']);; ?></span>Order #<?php echo $order['orderid'];?> (<?php echo $order_statuses[$order['status']];?>)</h1>
<h1 style="font-size: 12px; padding: 10px 0 0 0; margin: 0;">
<?php if ($order['shipping_method']) {?>
<span style="text-align:right; float: right;" class="delivery-method"><?php if ($order['local_pickup']) {?>Local pickup:<?php if ($admin_display) {?> <?php echo $order['warehouse']['wcode'];?>,<?php } ?> <?php echo $order['warehouse']['title'];?> (<?php echo $order['warehouse']['address'];?>)<?php } else  { ?>Delivery method: <?php echo $order['shipping_method']['shipping'];?><?php if ($order['shipping_method']['shipping_time']) {?> (<?php echo $order['shipping_method']['shipping_time'];?>)<?php } ?><?php } ?></span>
<?php } ?>

<?php /* ?>
<span style="text-align:right; float: right;" class="delivery-method">Delivery method: <?php echo $order['shipping_method']['shipping'];?><?php if ($order['shipping_method']['shipping_time']) {?> (<?php echo $order['shipping_method']['shipping_time'];?>)<?php } ?></span>
<?php */ ?>
<?php if ($order['payment_method']) {?>
Payment method: <?php echo $order['payment_method'];?><?php if ($order['payment_details']) {?> (<?php echo $order['payment_details'];?>)<?php } ?>
<?php } ?>
</h1>
<table class="invoice-table" style="width: 100%; margin: 10px auto 10px auto;">
<tr>
 <td valign="top" width="50%">
<h2 style="margin: 0; padding: 10px 0; text-align: center;">Company information</h2>
<b><?php echo $config['Company']['company_name'];?></b><br />
<a href="<?php echo $http_location;?>" target="_blank"><?php echo $http_location;?></a><br /><br />
<?php echo $config['Company']['location_address'];?>, <?php echo $config['Company']['location_city'];?><br />
<?php echo $config['Company']['location_zipcode'];?>, <?php echo $config['Company']['location_statename'];?><br />
<?php echo $config['Company']['location_countryname'];?><br />
<?php if ($config['Company']['company_phone']) {?>CALL US: <?php echo $config['Company']['company_phone'];?><br /><?php } ?>
<?php if ($config['Company']['company_phone_2']) {?>International: <?php echo $config['Company']['company_phone_2'];?><br /><?php } ?>
<?php if ($config['Company']['company_fax']) {?>Fax: <?php echo $config['Company']['company_fax'];?><br /><?php } ?>
<?php if ($config['Company']['orders_department']) {?>Email: <?php echo $config['Company']['orders_department'];?><?php } ?>
 </td>
 <td valign="top"><h2 style="margin: 0; padding: 10px 0; text-align: center;">Customer information</h2>
<table width="100%">
<tr>
 <td><b>First name:</b></td>
 <td><?php echo $order['firstname'];?></td>
</tr>
<tr>
 <td><b>Last name:</b></td>
 <td><?php echo $order['lastname'];?></td>
</tr>
<tr>
 <td><b>Address:</b></td>
 <td><?php echo $order['address'];?></td>
</tr>
<tr>
 <td><b>City:</b></td>
 <td><?php echo $order['city'];?></td>
</tr>
<tr>
 <td><b>State:</b></td>
 <td><?php echo $order['statename'];?></td>
</tr>
<tr>
 <td><b>Country:</b></td>
 <td><?php echo $order['countryname'];?></td>
</tr>
<tr>
 <td><b>Zip/Postal code:</b></td>
 <td><?php echo $order['zipcode'];?></td>
</tr>
<tr>
 <td><b>Phone:</b></td>
 <td><?php echo $order['phone'];?></td>
</tr>
<tr>
 <td><b>E-mail:</b></td>
 <td><?php echo $order['email'];?></td>
</tr>
</table>
 </td>
</tr>
</table>

<h3>Products</h3>
<table width="100%">
<?php foreach ($products as $v) {?>
 <?php $url = $v['cleanurl'] ? $v['cleanurl'] .'.html' : 'product/'.$v['productid'];; ?>
	<tr>
	 <td class="image" valign="top" style="padding-right: 10px;"><a href="<?php echo $http_location;?>/<?php echo $url;?>">
<?php if ($v['variant_photo']) {?>
<?php 
$image = $v['variant_photo'];
$image['new_width'] = 100;
$image['new_height'] = 100;
include SITE_ROOT . '/includes/variant_image.php';
?>
<?php } else if ($v['photo']) {?>
<?php 
$image = $v['photo'];
$image['new_width'] = 100;
$image['new_height'] = 100;
include SITE_ROOT . '/includes/image.php';
?>
<?php } ?>
	  </a></td>
	  <td width="100%" valign="top">
<?php if ($v['gift_card']) {?>
<b>Gift Card</b>
<?php if ($order['gc_generated']) {?>
<?php if ($userinfo['id'] == $order['userid']) {?>
<br />
Gift Card key phrase: <?php echo $v['gift_card'];?>
<?php } ?>
<?php } ?>
<?php } else  { ?>
<a href="<?php echo $http_location;?>/<?php echo $url;?>"><?php echo $v['name'];?></a>
<?php if ($v['weight']) {?>
<br />
<small>Weight: <?php echo price_format($v['weight']).' <span class="weight-symbol">lbs</span>'; ?></small>
<?php } ?>
<?php if ($v['product_options']) {?>
<hr />
<b>Selected options:</b><br />
<table width="100%">
 <?php foreach ($v['product_options'] as $o) {?>
<tr>
 <td valign="top" width="100"><?php echo $o['name'];?>:</td>
 <td><?php echo $o['option']['name'];?></td>
</tr>
 <?php } ?>
</table>
<?php } ?>
<?php } ?>
 </td>
<?php $product_subtotal = $v['price'] * $v['quantity'];; ?>
 <td align="right" valign="top" nowrap>
<?php if ($v['gift_card']) {?>
<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?>
<?php } else  { ?>
<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?> x <?php echo $v['quantity'];?> = <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product_subtotal); ?>
<?php } ?>
 </td>
	</tr>
 <?php } ?>
</table>

<div align="right">
<table class="subtotal" cellspacing="0" cellpadding="0">
<tr>
 <td width="250" align="right">Subtotal:</td>
 <td width="70" align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($order['subtotal']); ?></td>
</tr>
<?php if ($order['coupon']) {?>
<?php if ($order['coupon']) {?>
<tr>
 <td align="right">Coupon discount(<?php echo $order['coupon'];?>):</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($order['coupon_discount']); ?></td>
</tr>
<?php } ?>
<?php $discounted_subtotal = $order['subtotal'] - $order['coupon_discount'];; ?>
<tr>
 <td align="right">Discounted subtotal:</td>
 <td width="50" align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($discounted_subtotal); ?></td>
</tr>
<?php } ?>

<tr>
 <td align="right">Shipping:</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($order['shipping']); ?></td>
</tr>
<?php if ($order['tax_details']['tax_name']) {?>
<tr class="totals">
 <td align="right">Tax(<?php echo $order['tax_details']['tax_name'];?>):</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($order['tax']); ?></td>
</tr>
<?php } ?>
<?php if ($order['gc_discount'] > 0) {?>
<tr>
 <td align="right">Gift Card:</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($order['gc_discount']); ?></td>
</tr>
<?php } ?>

<tr class="totals">
 <td align="right">Total:</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($order['total']); ?></td>
</tr>
</table>
</div>
<?php if ($order['notes']) {?>
<br />
Comments:
<hr />
<?php echo $order['notes'];?>
<?php } ?>
<h2 style="padding: 20px 0; margin: 0; text-align: center;">Thank you for your ordering</h2>
</div>
