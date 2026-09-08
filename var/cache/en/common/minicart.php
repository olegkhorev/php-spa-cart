<svg><use xlink:href="/images/sprite.svg#cart"></use></svg>
<?php if ($cart['products']) {?>
<span class="hide4mobile">Products: </span><?php echo count($cart['products']);; ?>
<div class="cart-links">
<a href="<?php echo $current_location;?>/cart" class="cart-link">View cart</a><span class="hide4mobile"><a href="<?php echo $current_location;?>/checkout" class="checkout-link">Checkout</a></span>
</div>
<?php } else  { ?>
<span>Cart is empty</span>
<?php } ?>