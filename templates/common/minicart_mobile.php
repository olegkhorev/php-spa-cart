<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $cart['products']}
<a href="{$current_location}/cart" class="ajax_link"><img class="cart-icon" src="/images/cart.png" alt="" /> {lng[Cart]} ({php echo count($cart['products']);})</a>
{else}
<img src="/images/cart.png" class="cart-icon" alt="" />
<span>{lng[Cart]}</span>
{/if}
