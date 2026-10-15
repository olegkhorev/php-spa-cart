<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $meant}
<div class="did-you-mean">
<b>{lng[Did you mean]}:</b>
{foreach $meant as $v}
<span>{$v}</span>
{/foreach}
</div>
{/if}

{if $products}
<table>
{foreach $products as $v}
<tr>
 <td class="photo"><a class="ajax_link" href="{$current_location}/{if $v['cleanurl']}{$v['cleanurl']}.html{else}product/{$v['productid']}{/if}">
{if $v['photo']}
{product_image image=`$v['photo']` class=`"product-image"` id=`"pid-".$v["productid"]` new_width=80 new_height=80 center=1}
{/if}
</a>
 </td>
 <td class="res-name"><a class="ajax_link" href="{$current_location}/{if $v['cleanurl']}{$v['cleanurl']}.html{else}product/{$v['productid']}{/if}">{$v['name']}</a>
<p>{price $v['price']}</p>
 </td>
</tr>
{/foreach}
</table>
{if $total_items > 10}
<div class="more-no-search load-more-products">{lng[And more]}</div>
{/if}
{else}
<div class="more-no-search">{lng[No products found]}</div>
{/if}