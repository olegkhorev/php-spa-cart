<h1><?php echo $category['title'];?></h1>

<?php if ($banners) {?>
<div class="category-banners">
<?php $categoryid = $category['categoryid'];; ?>
<?php include SITE_ROOT."/var/cache/en/common/banners.php";?>
</div>
<?php } ?>

<?php if ($category_icon) {?>
<?php 
$image = $category_icon;
$image['new_width'] = 500;
$image['new_height'] = 300;
include SITE_ROOT . '/includes/icon.php';
?>
<?php } ?>

<?php echo $category['description'] ? '<p>'.$category['description'].'</p>' : '';; ?>

<?php if ($subcategories) {?>
<br />
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
<?php } ?>
</div>
<div class="res-name"><a href="<?php echo $current_location;?>/<?php echo $url;?>"><?php echo $v['title'];?></a></div>
</div>
<?php } ?>
</div>
<div class="clear"></div>
<?php } ?>

<?php if ($category_products) {?>
<?php $tag_id = "products"; $products = $category_products; $per_row = 3;; ?>
<br />
<h2>Products</h2>
<div class="products-results">
<?php echo $products_results_html;?>
</div>
<?php } else if (!$subcategories) {?><br />
<center>No products in this category</center><?php } ?>