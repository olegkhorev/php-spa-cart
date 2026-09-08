<h1>Ваша корзина <b class="translate"><span class="hidden word">Your cart</span><span class="hidden translate-phrase">Ваша корзина</span>(Edit)</b></h1>
<?php if ($products) {?>
<form action="/cart" id="cartform" method="POST">
<table width="100%" class="carttable">
<tbody>
<tr>
 <th width="50%" align="left" colspan="2">Товар <b class="translate"><span class="hidden word">Product</span><span class="hidden translate-phrase">Товар</span>(Edit)</b></th>
 <th width="20%">Цена <b class="translate"><span class="hidden word">Price</span><span class="hidden translate-phrase">Цена</span>(Edit)</b></th>
 <th>Количество <b class="translate"><span class="hidden word">Quantity</span><span class="hidden translate-phrase">Количество</span>(Edit)</b></th>
 <th width="20%">Итого <b class="translate"><span class="hidden word">Total</span><span class="hidden translate-phrase">Итого</span>(Edit)</b></th>
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
<div class="cart-mobile-title-line"><?php include SITE_ROOT."/var/cache/ru/cart/mobile_title.php";?></div></div>
	  </td>
	  <td><?php include SITE_ROOT."/var/cache/ru/cart/mobile_title.php";?></td>
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
	<td><a href="<?php echo $current_location;?>/cart/remove/<?php echo $v['cartid'];?>" class="remove-link">Удалить <b class="translate"><span class="hidden word">Delete</span><span class="hidden translate-phrase">Удалить</span>(Edit)</b></a></td>
	</tr>
<?php } ?>
</tbody>
</table>
<br />
<hr />
<br />
<table width="100%">
<tr>
 <td><button<?php  if ($is_ajax) echo ' type="button"'; ?> class="update-cart">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button> &nbsp; <button type="button" class="clear-cart main-button"<?php  if (!$is_ajax) echo ' onclick="self.location=\'cart/clear\'"'; ?>>Очистить корзину <b class="translate"><span class="hidden word">Clear cart</span><span class="hidden translate-phrase">Очистить корзину</span>(Edit)</b></button></td>
 <td align="right" class="cart-line-height">
 Итого <b class="translate"><span class="hidden word">Subtotal</span><span class="hidden translate-phrase">Итого</span>(Edit)</b>: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['subtotal']); ?><br />
<?php if ($cart['coupon']) {?>
Скидка по купону <b class="translate"><span class="hidden word">Coupon discount</span><span class="hidden translate-phrase">Скидка по купону</span>(Edit)</b>(<?php echo $cart['coupon']['coupon'];?>) <span class="remove_coupon">(x)</span>: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['coupon_discount']); ?></br>
<?php $discounted_subtotal = $cart['subtotal'] - $cart['coupon_discount'];; ?>
Итого со скидкой <b class="translate"><span class="hidden word">Discounted subtotal</span><span class="hidden translate-phrase">Итого со скидкой</span>(Edit)</b>: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['discounted_subtotal']); ?></br><?php /* ?> <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($discounted_subtotal); ?> <?php */ ?>
<?php } ?>
Доставка <b class="translate"><span class="hidden word">Shipping</span><span class="hidden translate-phrase">Доставка</span>(Edit)</b>: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['shipping_cost']); ?><br />
<?php if ($cart['tax_details']) {?>
Налог <b class="translate"><span class="hidden word">Tax</span><span class="hidden translate-phrase">Налог</span>(Edit)</b>(<?php echo $cart['tax_details']['tax_name'];?>): <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['tax']); ?><br />
<?php } ?>
 <b>Итого <b class="translate"><span class="hidden word">Total</span><span class="hidden translate-phrase">Итого</span>(Edit)</b>: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['total']); ?></b><br />
 <br /><button class="checkout-link" type="button"<?php if (!$is_ajax) {?> onclick="self.location='/checkout'"<?php } ?>>Заказать <b class="translate"><span class="hidden word">Checkout</span><span class="hidden translate-phrase">Заказать</span>(Edit)</b></button></td>
</tr>
</table>
</form>
<?php } else  { ?><br /><br />
Корзина пуста <b class="translate"><span class="hidden word">Cart is empty</span><span class="hidden translate-phrase">Корзина пуста</span>(Edit)</b>
<?php } ?>