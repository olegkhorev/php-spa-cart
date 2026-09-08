<?php if ($brand) {?>
<div class="brand_page">
<?php if ($brand['imageid']) {?>
<?php 
		$image = $brand;
		$image['new_width'] = 200;
		$image['new_height'] = 400;
		include SITE_ROOT . '/includes/brand_image.php';
?>
<?php } ?>
<h1><?php echo $brand['name'];?></h1>
<br />
<div class="descr"><?php echo $brand['descr'];?></div>
</div>
<?php if ($brand_products) {?>
<?php $tag_id = "products"; $products = $brand_products;; ?>
<div class="clear"></div>
<h3>Товары <b class="translate"><span class="hidden word">Products</span><span class="hidden translate-phrase">Товары</span>(Edit)</b></h3>
<div class="products-results">
<?php echo $products_results_html;?>
</div>
<?php } ?>
<?php } else if ($brands) {?>
<?php if ($total_pages > 2) {?>
<div align="right"><?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?></div>
<br />
<?php } ?>
<div class="brands">
<?php foreach ($brands as $b) {?>
<?php $url = $current_location.'/brands/'.($b['cleanurl'] ? $b['cleanurl'] : $b['brandid']);; ?>
<div class="brand">
<?php if ($b['imageid']) {?>
<a href="<?php echo $url;?>">
<?php 
$image = $b;
$image['new_width'] = 205;
$image['new_height'] = 205;
$image['valign'] = true;
$image['center'] = true;
include SITE_ROOT . '/includes/brand_image.php';
?>
<?php } ?>
</a>
<a href="<?php echo $url;?>"><?php echo $b['name'];?></a>
<br />
</div>
<?php } ?>
</div>
<?php if ($total_pages > 2) {?>
<div align="right"><?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?></div>
<br />
<?php } ?>
<?php } else  { ?>
<br />
<center>Бренды не найдены <b class="translate"><span class="hidden word">No brands found</span><span class="hidden translate-phrase">Бренды не найдены</span>(Edit)</b></center>
<?php } ?>
