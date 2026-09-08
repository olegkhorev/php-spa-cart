<h1>Search results</h1>

<?php if ($products) {?>
<?php $tag_id = "products"; $per_row = 3;; ?>
<div class="products-results">
<?php echo $products_results_html;?>
</div>
<?php } else  { ?><br />
<center>No results found</center><?php } ?>