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
<b><?php echo $product['name'];?></b> added to cart
<br /><br />
<strong class="added_price">Price: <span><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product['price']); ?></span></strong>
<?php if ($product_options) {?>
<div class="added_options">
<b>Selected options:</b>
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
 <td><button class="close_popup">Continue shopping</button></td>
 <td align="right">

<a href="/cart" class="main-button">View cart</a>
<a href="/checkout" class="main-button">Checkout</a>

 <button type="button" class="cart-link">View cart</button> <button type="button" class="checkout-link">Checkout</button>

 </td>
</tr>
</table>