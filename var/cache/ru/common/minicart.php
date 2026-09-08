<svg><use xlink:href="/images/sprite.svg#cart"></use></svg>
<?php if ($cart['products']) {?>
<span class="hide4mobile">Товары: </span><?php echo count($cart['products']);; ?>
<div class="cart-links">
<a href="<?php echo $current_location;?>/cart" class="cart-link">Корзина</a><span class="hide4mobile"><a href="<?php echo $current_location;?>/checkout" class="checkout-link">Заказать</a></span>
</div>
<?php } else  { ?>
<span>Корзина пуста</span>
<?php } ?>