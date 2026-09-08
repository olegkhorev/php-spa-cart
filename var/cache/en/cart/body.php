<h1>Your cart</h1>
<?php if ($products) {?>
<form action="/cart" id="cartform" method="POST">
<table width="100%" class="carttable">
<tbody>
<tr>
 <th width="50%" align="left" colspan="2">Product</th>
 <th width="20%">Price</th>
 <th>Quantity</th>
 <th width="20%">Total</th>
 <td width="10%"></td>
</tr>
<?php foreach ($products as $v) {?>
<?php $url = $v['cleanurl'] ? $v['cleanurl'].'.html' : 'product/'.$v['productid'];; ?>
	<tr>
	 <td class="image"><a href="<?php echo $current_location;?>/<?php echo $url;?>">
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
	  </a>
<div class="cart4mobile">
<br />
	<?php if (!$v['variant_photo'] && !$v['photo']) {?>
	<br /><br />
	<?php } ?>
<div class="cart-mobile-title-line"><?php include SITE_ROOT."/var/cache/en/cart/mobile_title.php";?></div></div>
	  </td>
	  <td><?php include SITE_ROOT."/var/cache/en/cart/mobile_title.php";?></td>
	<td align="center" valign="middle">
<?php if ($v['gift_card']) {?>
	<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount']); ?>
<?php } else  { ?>
	<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?>
<?php } ?>
	</td>
	<td align="center">
<?php if (!$v['gift_card']) {?>
<input type="text" size="4" data-max="<?php echo $v['avail'];?>" class="cart-quantity" name="quantity[<?php echo $v['cartid'];?>]" value="<?php echo $v['quantity'];?>" />
<?php } ?>
	</td>
<?php $product_subtotal = $v['price'] * $v['quantity']; ?>
	<td align="center" nowrap>
<?php if (!$v['gift_card']) {?>
<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product_subtotal); ?>
<?php } ?>
	</td>
	<td><a href="<?php echo $current_location;?>/cart/remove/<?php echo $v['cartid'];?>" class="remove-link">Delete</a></td>
	</tr>
<?php } ?>
</tbody>
</table>
<br />
<hr />
<br />
<table width="100%">
<tr>
 <td><button<?php  if ($is_ajax) echo ' type="button"'; ?> class="update-cart">Update</button> &nbsp; <button type="button" class="clear-cart main-button"<?php  if (!$is_ajax) echo ' onclick="self.location=\'cart/clear\'"'; ?>>Clear cart</button></td>
 <td align="right" class="cart-line-height">
 Subtotal: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['subtotal']); ?><br />
<?php if ($cart['coupon']) {?>
Coupon discount(<?php echo $cart['coupon']['coupon'];?>) <span class="remove_coupon">(x)</span>: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['coupon_discount']); ?></br>
<?php $discounted_subtotal = $cart['subtotal'] - $cart['coupon_discount'];; ?>
Discounted subtotal: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['discounted_subtotal']); ?></br><?php /* ?> <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($discounted_subtotal); ?> <?php */ ?>
<?php } ?>
Shipping: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['shipping_cost']); ?><br />
<?php if ($cart['tax_details']) {?>
Tax(<?php echo $cart['tax_details']['tax_name'];?>): <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['tax']); ?><br />
<?php } ?>
 <b>Total: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['total']); ?></b><br />
 <br /><button class="checkout-link" type="button"<?php if (!$is_ajax) {?> onclick="self.location='/checkout'"<?php } ?>>Checkout</button></td>
</tr>
</table>
</form>
<?php } else  { ?><br /><br />
Cart is empty
<?php } ?>