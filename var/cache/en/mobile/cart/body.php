<h1>Cart</h1>
<?php if ($products) {?>
<form action="/cart" id="cartform" method="POST">
<div class="cart-items">
<?php foreach ($products as $v) {?>
<div class="cart-item">
<?php $url = $v['cleanurl'] ? $v['cleanurl'].'.html' : 'product/'.$v['productid'];; ?>
<?php if ($v['gift_card']) {?>
<b>Gift Card</b><br />
You will see the Gift Card key phrase on paid invoice
<?php } else  { ?>
<a class="name" href="<?php echo $current_location;?>/<?php echo $url;?>"><?php echo $v['name'];?></a>
<?php } ?>
<?php if ($v['weight']) {?>
<br /><small>Weight: <?php echo price_format($v['weight']).' <span class="weight-symbol">lbs</span>'; ?></small>
<?php } ?>
<?php if ($v['product_options']) {?>
<hr />
<b>Selected options:</b><br />
<table width="100%">
<?php foreach ($v['product_options'] as $o) {?>
<tr>
	<td width="100" valign="top"><?php echo $o['name'];?>:</td>
	<td><?php echo $o['option']['name'];?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

<br />
<a href="<?php echo $current_location;?>/cart/remove/<?php echo $v['cartid'];?>" class="remove-link">Delete</a>
<?php if ($v['gift_card']) {?>
<div class="price"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount']); ?></div>
<?php } else  { ?>
<?php $product_subtotal = $v['price'] * $v['quantity']; ?>
<div class="price"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?> * <input type="text" size="4" data-max="<?php echo $v['avail'];?>" class="cart-quantity" name="quantity[<?php echo $v['cartid'];?>]" value="<?php echo $v['quantity'];?>" /> = <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product_subtotal); ?></div>
<?php } ?>
</div>
<?php } ?>
</div>
<hr />
<br />
<table width="100%">
<tr>
 <td align="right" style="line-height: 23px;">
 Subtotal: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['subtotal']); ?><br />
<?php if ($cart['coupon']) {?>
Coupon discount(<?php echo $cart['coupon']['coupon'];?>) <span class="remove_coupon">(x)</span>: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['coupon_discount']); ?></br>
<?php $discounted_subtotal = $cart['subtotal'] - $cart['coupon_discount'];; ?>
Discounted subtotal: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($discounted_subtotal); ?></br>
<?php } ?>
Shipping: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($shipping_fee); ?><br />
<?php if ($cart['tax_details']) {?>
Tax(<?php echo $cart['tax_details']['tax_name'];?>): <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['tax']); ?><br />
<?php } ?>
 <b>Total: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['total']); ?></b><br />
 <br />
<button style="float: left;" type="button" class="clear-cart mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='cart/clear'">Clear cart</button>
 <a href="/checkout" class="ajax_link"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button"<?php if (!$is_ajax) {?> onclick="self.location='/checkout'"<?php } ?>>Checkout</button></a></td>
</tr>
</table>
</form>
<?php } else  { ?><br /><br />
Cart is empty
<?php } ?>