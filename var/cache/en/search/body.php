<div id="dcart"><img src="<?php echo $current_location;?>/images/dcart.png" alt="" /><br />Move product here</div>
<?php if ($products) {?> <?php $tag_id = "products"; $per_row = 4;; ?>
<h3>Search results</h3>
<div class="products-results">
 <?php echo $products_results_html;?>
</div>
<?php } else  { ?><br />
<center>No products found</center><?php } ?>