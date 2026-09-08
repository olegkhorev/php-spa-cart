<div class="product-added">
<?php if ($product['variant_photo']) {?>
<?php 
	$image = $product['variant_photo'];
	$image['new_width'] = 234;
	$image['new_height'] = 200;
	include SITE_ROOT . '/includes/variant_image.php';
?>
<?php } else if ($product['photo']) {?>
<?php 
	$image = $product['photo'];
	$image['new_width'] = 234;
	$image['new_height'] = 200;
	include SITE_ROOT . '/includes/image.php';
?>
<?php } ?>
<b><?php echo $product['name'];?></b> добавлено в корзину <b class="translate"><span class="hidden word">added to cart</span><span class="hidden translate-phrase">добавлено в корзину</span>(Edit)</b>
<br /><br />
<strong class="added_price">Цена <b class="translate"><span class="hidden word">Price</span><span class="hidden translate-phrase">Цена</span>(Edit)</b>: <span><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product['price']); ?></span></strong>
<?php if ($product_options) {?>
<div class="added_options">
<b>Выбранные параметры <b class="translate"><span class="hidden word">Selected options</span><span class="hidden translate-phrase">Выбранные параметры</span>(Edit)</b>:</b>
<?php foreach ($product_options as $o) {?>
<?php if ($o['value']) {?>
<?php echo $o['group']['name'];?>: {$o['value']<br />
<?php } else  { ?>
<?php echo $o['group']['name'];?>: <?php echo $o['option']['name'];?><br />
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</div>
<br /><br />
<table width="100%" class="product-added-table">
<tr>
 <td><button class="close_popup">Продолжить покупки <b class="translate"><span class="hidden word">Continue shopping</span><span class="hidden translate-phrase">Продолжить покупки</span>(Edit)</b></button></td>
 <td align="right">

<a href="/cart" class="main-button">Корзина <b class="translate"><span class="hidden word">View cart</span><span class="hidden translate-phrase">Корзина</span>(Edit)</b></a>
<a href="/checkout" class="main-button">Заказать <b class="translate"><span class="hidden word">Checkout</span><span class="hidden translate-phrase">Заказать</span>(Edit)</b></a>

 <button type="button" class="cart-link">Корзина <b class="translate"><span class="hidden word">View cart</span><span class="hidden translate-phrase">Корзина</span>(Edit)</b></button> <button type="button" class="checkout-link">Заказать <b class="translate"><span class="hidden word">Checkout</span><span class="hidden translate-phrase">Заказать</span>(Edit)</b></button>

 </td>
</tr>
</table>