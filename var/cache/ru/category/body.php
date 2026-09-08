<div id="dcart"><img src="<?php echo $current_location;?>/images/dcart.png" alt="" /><br />Переместить товар сюда <b class="translate"><span class="hidden word">Move product here</span><span class="hidden translate-phrase">Переместить товар сюда</span>(Edit)</b></div>

<h1><?php echo $category['title'];?></h1>
<?php if ($banners) {?><?php $categoryid = $category['categoryid'];; ?><?php include SITE_ROOT."/var/cache/ru/common/banners.php";?>
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
<h2>Подкатегории <b class="translate"><span class="hidden word">Subcategories</span><span class="hidden translate-phrase">Подкатегории</span>(Edit)</b></h2>
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
<h3>Рекомендуемые товары <b class="translate"><span class="hidden word">Featured products</span><span class="hidden translate-phrase">Рекомендуемые товары</span>(Edit)</b></h3>
<?php include SITE_ROOT."/var/cache/ru/common/products.php";?>
<br />
<?php } ?>

<?php if ($category_products) {?>
<?php $tag_id = "products"; $products = $category_products; $per_row = 4;; ?>
<h3>Товары <b class="translate"><span class="hidden word">Products</span><span class="hidden translate-phrase">Товары</span>(Edit)</b></h3>
<div class="products-results">
<?php echo $products_results_html;?>
</div>
<?php } else if (!$subcategories) {?><br />
<center>Нет товаров в этой категории <b class="translate"><span class="hidden word">No products in this category</span><span class="hidden translate-phrase">Нет товаров в этой категории</span>(Edit)</b></center><?php } ?>
