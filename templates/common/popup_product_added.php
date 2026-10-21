<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<div class="product-added">
{if $product['variant_photo']}
{variant_image image=`$product["variant_photo"]` new_width=234 new_height=200}
{elseif $product['photo']}
{product_image image=`$product['photo']` new_width=234 new_height=200}
{/if}
<b>{$product['name']}</b> {lng[added to cart]}
<br /><br />
<strong class="added_price">{lng[Price]}: <span>{price $product['price']}</span></strong>
{if $product_options}
<div class="added_options">
<b>{lng[Selected options]}:</b>
{foreach $product_options as $o}
{if $o['value']}
{$o['group']['name']}: {$o['value']}<br />
{else}
{$o['group']['name']}: {$o['option']['name']}<br />
{/if}
{/foreach}
</div>
{/if}
</div>
<br /><br />
<table style="width: 100%;" class="product-added-table">
<tr>
 <td><button class="close_popup">{lng[Continue shopping]}</button></td>
 <td style="text-align: right;">

<a href="/cart" class="main-button">{lng[View cart]}</a>
<a href="/checkout" class="main-button">{lng[Checkout]}</a>

 <button type="button" class="cart-link">{lng[View cart]}</button> <button type="button" class="checkout-link">{lng[Checkout]}</button>

 </td>
</tr>
</table>