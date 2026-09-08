<svg><use xlink:href="/images/sprite.svg#cart"></use></svg>
<?php if ($cart['products']) {?>
<span class="hide4mobile">Produits: </span><?php echo count($cart['products']);; ?>
<div class="cart-links">
<a href="<?php echo $current_location;?>/cart" class="cart-link">Voir le panier</a><span class="hide4mobile"><a href="<?php echo $current_location;?>/checkout" class="checkout-link">La caisse</a></span>
</div>
<?php } else  { ?>
<span>Panier est vide</span>
<?php } ?>