<svg><use xlink:href="/images/sprite.svg#cart"></use></svg>
<?php if ($cart['products']) {?>
<span class="hide4mobile">Produkte: </span><?php echo count($cart['products']);; ?>
<div class="cart-links">
<a href="<?php echo $current_location;?>/cart" class="cart-link">Warenkorb anzeigen</a><span class="hide4mobile"><a href="<?php echo $current_location;?>/checkout" class="checkout-link">Kasse</a></span>
</div>
<?php } else  { ?>
<span>Warenkorb ist leer</span>
<?php } ?>