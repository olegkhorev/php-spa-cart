<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($get["2"] == 'add') {?>
<h1>Add product</h1>
<?php } else  { ?>
<h1>Edit product</h1>
<br />
<?php } ?>

<?php  echo $product_tabs; ?>
<div class="clear"></div>

<?php  if (empty($get["3"])) { ?>
<?php get_template_contents("admin/pages/product_details.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_details.php";?>
<?php  } else if ($get["3"] == "images") { ?>
<?php get_template_contents("admin/pages/product_images.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_images.php";?>
<?php } else if ($get['3'] == 'inventory') {?>
<?php get_template_contents("admin/pages/product_inventory.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_inventory.php";?>
<?php  } else if ($get["3"] == "related") { ?>
<?php get_template_contents("admin/pages/product_related.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_related.php";?>
<?php  } else if ($get["3"] == "options") {
    if ($get["4"]) { ?>
<?php get_template_contents("admin/pages/product_options_group.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_options_group.php";?>
<?php  } else  { ?>
<?php get_template_contents("admin/pages/product_options.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_options.php";?>
<?php  }
} else if ($get["3"] == "variants") { ?>
<?php get_template_contents("admin/pages/product_variants.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_variants.php";?>
<?php  } else if ($get["3"] == "variant_images") { ?>
<?php get_template_contents("admin/pages/product_variant_images.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_variant_images.php";?>
<?php  } else if ($get["3"] == "wholesale") { ?>
<?php get_template_contents("admin/pages/product_wholesale.php", false, true); include SITE_ROOT."/var/cache/en/admin/pages/product_wholesale.php";?>
<?php  } ?>
