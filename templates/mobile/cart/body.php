<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Cart</h1>
{if $products}
<form action="/cart" id="cartform" method="POST">
<div class="cart-items">
{foreach $products as $v}
<div class="cart-item">
{php $url = $v['cleanurl'] ? $v['cleanurl'].'.html' : 'product/'.$v['productid'];}
{if $v['gift_card']}
<b>{lng[Gift Card]}</b><br />
{lng[You will see the Gift Card key phrase on paid invoice]}
{else}
<a class="name" href="{$current_location}/{$url}">{$v['name']}</a>
{/if}
{if $v['weight']}
<br /><small>{lng[Weight]}: {weight $v['weight']}</small>
{/if}
{if $v['product_options']}
<hr />
<b>{lng[Selected options]}:</b><br />
<table style="width:100%">
{foreach $v['product_options'] as $o}
<tr>
	<td style="width:100px;vertical-align:top">{$o['name']}:</td>
	<td>{$o['option']['name']}</td>
</tr>
{/foreach}
</table>
{/if}

<br />
<a href="{$current_location}/cart/remove/{$v['cartid']}" class="remove-link">{lng[Delete]}</a>
{if $v['gift_card']}
<div class="price">{price $v['amount']}</div>
{else}
{php $product_subtotal = $v['price'] * $v['quantity']}
<div class="price">{price $v['price']} * <input type="text" size="4" data-max="{$v['avail']}" class="cart-quantity" name="quantity[{$v['cartid']}]" value="{$v['quantity']}" /> = {price $product_subtotal}</div>
{/if}
</div>
{/foreach}
</div>
<hr />
<br />
<table style="width:100%">
<tr>
 <td style="text-align:right;line-height: 23px;">
 {lng[Subtotal]}: {price $cart['subtotal']}<br />
{if $cart['coupon']}
{lng[Coupon discount]}({$cart['coupon']['coupon']}) <span class="remove_coupon">(x)</span>: {price $cart['coupon_discount']}<br />
{php $discounted_subtotal = $cart['subtotal'] - $cart['coupon_discount'];}
{lng[Discounted subtotal]}: {price $discounted_subtotal}<br />
{/if}
{lng[Shipping]}: {price $shipping_fee}<br />
{if $cart['tax_details']}
{lng[Tax]}({$cart['tax_details']['tax_name']}): {price $cart['tax']}<br />
{/if}
 <b>{lng[Total]}: {price $cart['total']}</b><br />
 <br />
<button style="float: left;" type="button" class="clear-cart mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='cart/clear'">{lng[Clear cart]}</button>
 <button class="button_ajax_link mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button" href="/checkout"{if !$is_ajax} onclick="self.location='/checkout'"{/if}>{lng[Checkout]}</button></td>
</tr>
</table>
</form>
{else}
<br /><br />
{lng[Cart is empty]}
{/if}