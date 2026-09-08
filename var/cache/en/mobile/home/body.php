<?php if ($banners) {?>
 <?php $categoryid = 0;; ?>
<?php include SITE_ROOT."/var/cache/en/common/banners.php";?>
<?php } ?>

<?php 
if (lng('Site title'))
	echo "<h1>".lng('Site title')."</h1>";

if (lng('Site description'))
	echo "<br /><p>".lng('Site description')."</p>";
?>

<?php if ($featured_products) {?>
<h2>Featured products</h2>
<?php $products = $featured_products;; ?>
<?php include SITE_ROOT."/var/cache/en/common/products.php";?>
<?php } ?>