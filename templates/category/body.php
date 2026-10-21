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
{php $categoryid = $category['categoryid'];}
{include="common/banners.php"}
<div class="category-banners-descr">
{$category['description'];}
</div>
<div class="clear"></div>
{else}
<table class="category-details">
<tr>
{if $category_icon}
	<td>
{category_icon image=`$category_icon` new_width=500 new_height=300}
</td>
{/if}

<td style="width:100%">{php echo $category['description'] ? '<p>'.$category['description'].'</p>' : '';}</td></tr></table>
{/if}

{if $subcategories}
<br />
<div style="padding:5px 0 5px 10px;margin:5px 0;border-bottom:1px solid var(--theme-color)"></div>
<br /><br />
<h2>{lng[Subcategories]}</h2>
<div id='subcategories' class="responsive-sub">
{foreach $subcategories as $v}
<div class="res-sub-item">
<div class="photo">
{php $url = $v['cleanurl'] ? $v['cleanurl'] : $v['categoryid'];}
{if $v['icon']}
<a href="{$current_location}/{$url}">
{category_icon image=`$v["icon"]` new_width=234 new_height=200}
</a>
{/if}
</div>
<div class="res-name"><a href="{$current_location}/{$url}">{$v['title']}</a></div>
</div>
{/foreach}
</div>
<div class="clear"></div>
{/if}

{if $featured_products}
{php $tag_id = "featured_products"; $products = $featured_products; $per_row = 4; $sort_by = '';}
<h3>{lng[Featured products]}</h3>
{include="common/products.php"}
<br />
{/if}

{if $category_products}
{php $tag_id = "products"; $products = $category_products; $per_row = 4;}
<h3>{lng[Products]}</h3>
<div class="products-results">
{$products_results_html}
</div>
{elseif !$subcategories}
<br />
<div style="text-align:center">{lng[No products in this category]}</div>
{/if}
