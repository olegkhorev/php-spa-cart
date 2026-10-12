<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $brand}
<div class="brand_page">
{if $brand['imageid']}
{brand_image image=`$brand` new_width=205 new_height=400}
{/if}
<h1>{$brand['name']}</h1>
<br />
<div class="descr">{$brand['descr']}</div>
</div>
{if $brand_products}
{php $tag_id = "products"; $products = $brand_products;}
<div class="clear"></div>
<h3>{lng[Products]}</h3>
<div class="products-results">
{$products_results_html}
</div>
{/if}
{elseif $brands}
{if $total_pages > 2}
<div align="right">{include="common/navigation.php"}</div>
<br />
{/if}
<div class="brands">
{foreach $brands as $b}
{php $url = $current_location.'/brands/'.($b['cleanurl'] ? $b['cleanurl'] : $b['brandid']);}
<div class="brand">
{if $b['imageid']}
<a href="{$url}">
{brand_image image=`$b` new_width=205 new_height=205 center=1 valign=1}
{/if}
</a>
<a href="{$url}">{$b['name']}</a>
<br />
</div>
{/foreach}
</div>
{if $total_pages > 2}
<div align="right">{include="common/navigation.php"}</div>
<br />
{/if}
{else}
<br />
<center>{lng[No brands found]}</center>
{/if}
