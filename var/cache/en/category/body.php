<div id="dcart"><img src="<?php echo $current_location;?>/images/dcart.png" alt="" /><br />Move product here</div>

<h1><?php echo $category['title'];?></h1>
<?php if ($banners) {?><?php $categoryid = $category['categoryid'];; ?><?php include SITE_ROOT."/var/cache/en/common/banners.php";?>
<div class="category-banners-descr">
<?php echo $category['description'];;?>
</div>
<div class="clear"></div>
<?php } else  { ?>
<table class="category-details">
<tr>
<?php if ($category_icon) {?>
	<td>
<?php 
$image = $category_icon;
$image['new_width'] = 500;
$image['new_height'] = 300;
include SITE_ROOT . '/includes/icon.php';
?>
</td>
<?php } ?>

<td width="100%"><?php echo $category['description'] ? '<p>'.$category['description'].'</p>' : '';; ?></td></tr></table>
<?php } ?>

<?php if ($subcategories) {?>
<br />
<h3></h3>
<br /><br />
<h2>Subcategories</h2>
<div id='subcategories' class="responsive-sub">
<?php foreach ($subcategories as $v) {?>
<div class="res-sub-item">
<div class="photo">
<?php $url = $v['cleanurl'] ? $v['cleanurl'] : $v['categoryid'];; ?>
<?php if ($v['icon']) {?>
<a href="<?php echo $current_location;?>/<?php echo $url;?>">
<?php 
$image = $v['icon'];
$image['new_width'] = 234;
$image['new_height'] = 200;
include SITE_ROOT . '/includes/icon.php';
?>
</a>
<?php } ?>
</div>
<div class="res-name"><a href="<?php echo $current_location;?>/<?php echo $url;?>"><?php echo $v['title'];?></a></div>
</div>
<?php } ?>
</div>
<div class="clear"></div>
<?php } ?>

<?php if ($featured_products) {?>
<?php $tag_id = "featured_products"; $products = $featured_products; $per_row = 4; $sort_by = '';; ?>
<h3>Featured products</h3>
<?php include SITE_ROOT."/var/cache/en/common/products.php";?>
<br />
<?php } ?>

<?php if ($category_products) {?>
<?php $tag_id = "products"; $products = $category_products; $per_row = 4;; ?>
<h3>Products</h3>
<div class="products-results">
<?php echo $products_results_html;?>
</div>
<?php } else if (!$subcategories) {?><br />
<center>No products in this category</center><?php } ?>
