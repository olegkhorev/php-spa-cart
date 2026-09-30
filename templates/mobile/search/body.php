<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Search results]}</h1>

{if $products}
{php $tag_id = "products"; $per_row = 3;}
<div class="products-results">
{$products_results_html}
</div>
{else}<br />
<center>{lng[No results found]}</center>{/if}