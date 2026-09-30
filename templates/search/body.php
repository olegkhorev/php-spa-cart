<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<div id="dcart"><img src="{$current_location}/images/dcart.png" alt="" /><br />{lng[Move product here]}</div>
{if $products} {php $tag_id = "products"; $per_row = 4;}
<h3>{lng[Search results]}</h3>
<div class="products-results">
 {$products_results_html}
</div>
{else}<br />
<center>{lng[No products found]}</center>{/if}