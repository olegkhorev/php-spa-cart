<form id="checkoutform" method="POST">
<input type="hidden" name="stripe_token" id="stripe_token" />
<input type="hidden" name="order_total" id="order_total" value="<?php  echo price_format($cart['total']); ?>" />
<?php if ($cart['need_shipping']) {?>
<h3>Shipping method</h3>
<?php if ($shipping_methods) {?>
<select name="shippingid" onchange="javascript: recalculate_shipping(this.value);"<?php if ($cart['shippingid'] == 'L') {?> class="hidden"<?php } ?>>
<?php foreach ($shipping_methods as $v) {?>
<option value="<?php echo $v['shippingid'];?>"<?php if ($cart['shippingid'] == $v['shippingid']) {?> selected<?php } ?>><?php echo $v['shipping'];?><?php if ($v['shipping_time']) {?> (<?php echo $v['shipping_time'];?>)<?php } ?> - <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['rate']); ?></option>
<?php } ?>
</select>
<?php } else if (!$userinfo['firstname']) {?>
Please enter your address
<?php } else if (!$cart['local_pickup']) {?>
No shipping methods to your location available
<?php } ?>

<?php if ($cart['local_pickup']) {?>
<br />
<label><input type="checkbox" name="local_pickup" id="local_pickup" value="1"<?php if ($cart['shippingid'] == 'L') {?> checked<?php } ?> />Local pickup(free shipping)</label>
<div class="choose-warehouse<?php if ($cart['shippingid'] != 'L') {?> hidden<?php } ?>"><h2>Choose warehouse</h2>
<table>
<?php foreach ($cart['warehouses'] as $k=>$w) {?>
<tr<?php if (!$k) {?> class="active"<?php } ?>>
 <td width="10"><input type="radio" id="wid-<?php echo $w['wid'];?>" name="wid" value="<?php echo $w['wid'];?>"<?php if (!$k) {?> checked<?php } ?> /></td>
 <td><label for="wid-<?php echo $w['wid'];?>"><?php echo $w['title'];?>, <?php echo $w['address'];?></label> <a href="http://maps.google.com/?q=<?php echo escape($w['address'], 2);; ?>" target="_blank">Open in map</a></td>
</tr>
<?php } ?>
</table>
</div>
<br /><br />
<?php } ?>
<?php } ?>

<h3>Payment method</h3>
<?php if ($cart['total'] == "0.00") {?>
Free
<?php } else  { ?>
<select name="paymentid" id="paymentid">
<?php foreach ($payment_methods as $v) {?>
<option value="<?php echo $v['paymentid'];?>"><?php echo $v['name'];?></option>
<?php } ?>
</select>
<?php } ?>
<br />
    <div class="group">
      <textarea style="width: 95%;" cols="30" rows="4" name="notes"></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Your comments</label>
    </div>

<?php /* ?><textarea style="width: 100%;" placeholder="Your comments" cols="30" rows="4" name="notes"></textarea><?php */ ?>
<br /><br />
<div align="right">
<table class="subtotal" cellspacing="0" cellpadding="0" width="100%">
<tr>
 <td align="right">Subtotal:</td>
 <td width="50" align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['subtotal']); ?></td>
</tr>
<?php if ($cart['coupon']) {?>
<tr>
 <td align="right">Coupon discount(<?php echo $cart['coupon']['coupon'];?>) <span class="remove_coupon">(x)</span>:</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['coupon_discount']); ?></td>
</tr>
<?php /* ?><?php $discounted_subtotal = $cart['subtotal'] - $cart['coupon_discount'];; ?><?php */ ?>
<tr>
 <td align="right">Discounted subtotal:</td>
 <td width="50" align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['discounted_subtotal']); ?></td>
</tr>
<?php } ?>
<tr>
 <td align="right">Shipping:</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['shipping_cost']); ?></td>
</tr>
<?php if ($cart['tax_details']) {?>
<tr>
 <td align="right">Tax(<?php echo $cart['tax_details']['tax_name'];?>):</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['tax']); ?></td>
</tr>
<?php } ?>
<?php if ($cart['gift_card']) {?>
<tr>
 <td align="right">Paid with Gift Card <span class="remove_gc">(x)</span>:</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['gc_discount']); ?></td>
</tr>
<?php } ?>
<tr class="totals">
 <td align="right">Total:</td>
 <td align="right"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['total']); ?></td>
</tr>
</table>
</div>
<?php if (!$cart['coupon']) {?><div class="apply_coupon">Have a discount coupon?</div>
<?php } ?>
<?php if (!$cart['gift_card']) {?>
<br />
<div class="apply_gc">Have a Gift Card?</div>
<?php } ?>
<br />
<div class="register_error"></div>
<?php if ($shipping_methods || (!$cart['need_shipping'] && $get['1'] == 'user_form')) {?>
<center>
<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Place order</button>
</center>
<?php } ?>
</form>