<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $_GET['where'] == '1'}
{if $products}
<table>
{foreach $products as $v}
<tr>
 <td class="photo"><a class="ajax_link" href="{$current_location}/admin/products/{$v['productid']}">
{if $v['photo']}
{product_image image=`$v['photo']` class=`"product-image"` id=`"pid-".$v["productid"]` new_width=80 new_height=80}
{/if}
</a>
 </td>
 <td class="res-name"><a class="ajax_link" href="{$current_location}/admin/products/{$v['productid']}">{$v['name']}</a>
<p>{price $v['price']}</p>
 </td>
</tr>
{/foreach}
</table>
{if $total_items > 30}
<div class="more-no-search">And more</div>
{/if}
{else}
<div class="more-no-search">No products found</div>
{/if}
{elseif $_GET['where'] == '2'}
{if $users}
<table>
{foreach $users as $v}
<tr>
 <td class="res-name"><a class="ajax_link" href="{$current_location}/admin/user/{$v['id']}">{$v['firstname']} {$v['lastname']} ({$v['email']})</a></td>
</tr>
{/foreach}
</table>
{if $total_items > 30}
<div class="more-no-search">And more</div>
{/if}
{else}
<div class="more-no-search">No customers found</div>
{/if}
{elseif $_GET['where'] == '3'}
{if $orders}
<table>
{foreach $orders as $v}
<tr>
 <td class="res-name"><a class="ajax_link" href="{$current_location}/admin/invoice/{$v['orderid']}">#{$v['orderid']}, {$v['firstname']} {$v['lastname']} ({$v['email']})</a></td>
</tr>
{/foreach}
</table>
{if $total_items > 30}
<div class="more-no-search">And more</div>
{/if}
{else}
<div class="more-no-search">No orders found</div>
{/if}
{/if}