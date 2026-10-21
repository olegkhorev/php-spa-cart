<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($products) {?>
 <?php $tag_id = "products"; $per_row = 4;; ?>
<h3>Search results</h3>
<div class="products-results">
 <?php echo $products_results_html;?>
</div>
<?php } else  { ?>
<br />
<div style="text-align:center">No products found</div>
<?php } ?>