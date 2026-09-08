<h1>{$category['title']}</h1>

{if $banners}
<div class="category-banners">
{php $categoryid = $category['categoryid'];}
{include="common/banners.php"}
</div>
{/if}

{if $category_icon}
<?php
$image = $category_icon;
$image['new_width'] = 500;
$image['new_height'] = 300;
include SITE_ROOT . '/includes/icon.php';
?>
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
<?php
$image = $v['icon'];
$image['new_width'] = 234;
$image['new_height'] = 200;
include SITE_ROOT . '/includes/icon.php';
?>
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
{elseif !$subcategories}<br />
<center>{lng[No products in this category]}</center>{/if}