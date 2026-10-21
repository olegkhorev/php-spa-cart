<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{$category['title']}</h1>

{if $banners}
<div class="category-banners">
{php $categoryid = $category['categoryid'];}
{include="common/banners.php"}
</div>
{/if}

{if $category_icon}
{category_icon image=`$category_icon` new_width=500 new_height=300}
{/if}

{php echo $category['description'] ? '<p>'.$category['description'].'</p>' : '';}

{if $subcategories}
<br />
<h2>{lng[Subcategories]}</h2>
<div id='subcategories' class="responsive-sub">
{foreach $subcategories as $v}
<div class="res-sub-item">
<div class="photo">
{php $url = $v['cleanurl'] ? $v['cleanurl'] : $v['categoryid'];}
{if $v['icon']}
<a href="{$current_location}/{$url}">
{category_icon image=`$v['icon']` new_width=234 new_height=200}
</a>
{/if}
</div>
<div class="res-name"><a href="{$current_location}/{$url}">{$v['title']}</a></div>
</div>
{/foreach}
</div>
<div class="clear"></div>
{/if}

{if $category_products}
{php $tag_id = "products"; $products = $category_products; $per_row = 3;}
<br />
<h2>{lng[Products]}</h2>
<div class="products-results">
{$products_results_html}
</div>
{elseif !$subcategories}
<br />
<div style="text-align:center">{lng[No products in this category]}</div>
{/if}