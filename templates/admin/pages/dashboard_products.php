<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<table>
{foreach $products as $v}
<tr>
 <td class="photo"><a target="_blank" href="/admin/products/{$v['productid']}">
{if $v['photo']}
{product_image image=`$v['photo']` class=`"product-image"` id=`"pid-".$v["productid"]` new_width=50 new_height=50 center=1}
{/if}
</a>
 </td>
 <td class="name"><a target="_blank" href="/admin/products/{$v['productid']}">{$v['name']}</a><span>{if $type == 'B'} ({$v['sales_stats']} sales){elseif $type == 'M'} ({$v['views_stats']} views){/if}</span></td>
</tr>
{/foreach}
</table>