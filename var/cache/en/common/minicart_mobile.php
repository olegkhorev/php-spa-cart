<?php if ($cart['products']) {?>
<a href="<?php echo $current_location;?>/cart" class="ajax_link"><img class="cart-icon" src="/images/cart.png" alt="" /> Cart (<?php echo count($cart['products']);; ?>)</a>
<?php } else  { ?>
<img src="/images/cart.png" class="cart-icon" alt="" />
<span>Cart</span>
<?php } ?>
