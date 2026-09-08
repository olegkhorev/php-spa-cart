<?php 
echo $product_tabs;
?>
<div class="clear"></div>

<?php 
if (empty($get['3'])) {
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_details.php";?>
<?php 
} else if ($get['3'] == 'images') {
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_images.php";?>
<?php } else if ($get['3'] == 'inventory') {?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_inventory.php";?>
<?php 
} else if ($get['3'] == 'related') {
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_related.php";?>
<?php 
} else if ($get['3'] == 'options') {
	if ($get['4']) {
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_options_group.php";?>
<?php 
	} else  {?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_options.php";?>
<?php 	}
} else if ($get['3'] == 'variants') {
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_variants.php";?>
<?php 
} else if ($get['3'] == 'variant_images') {
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_variant_images.php";?>
<?php 
} else if ($get['3'] == 'wholesale') {
?>
<?php include SITE_ROOT."/var/cache/en/admin/pages/product_wholesale.php";?>
<?php 
}
?>
