<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1 class="products-title-h3">Products <a class="ajax_link link-button" href="/admin/products/add">Add new product</a></h1>
<br />

<?php  if (!isset($_GET["direction"]) || $_GET["direction"]) {
    $direction = "&direction=0";
} else  {
    $direction = "&direction=1";
} ?>
<form method="POST" name="psform" href="/admin/products">
<input type="hidden" name="mode" value="search" />
<table class="search_table">
<tr>
 <td class="data-name">Search by substring:</td>
 <td><input type="text" name="substring" value="<?php  echo escape(
     $search_products["substring"],
     2,
 ); ?>" size="40" />
&nbsp;
<button>Search</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a class="ajax_link" href="<?php echo $current_location;?>/admin/products/reset">Reset</a>
 </td>
</tr>
<?php 
$found_advanced_search = false;
if ($search_products) {
    foreach ($search_products as $k=>$v) {
        if ($v && in_array($k, array('brandid', 'sku', 'productid', 'price_min', 'price_max', 'list_price_min', 'list_price_max', 'avail_min', 'avail_max', 'weight_min', 'weight_max', 'status'))) {
            $found_advanced_search = true;
            break;
        }
    }
}
?>
<?php if (!$found_advanced_search) {?>
<tr>
 <td colspan="2"><a href="javascript: void(0);" onclick="$(this).hide(); $('#advanced_search').show();">Advanced search</a></td>
</tr>
<?php } ?>
</table>
<table id="advanced_search" class="search_table"<?php if ($found_advanced_search) {?> style="display: block;"<?php } ?>>
<tr>
 <td class="data-name top">Search in category:</td>
 <td><?php  echo $categories_tree; ?><br />
<label><input type="checkbox" name="main_category" value="1"<?php  if (
    !$search_products ||
    $search_products["main_category"]
) {
    echo ' checked="checked"';
} ?> /> Main category</label>
&nbsp; <label><input type="checkbox" name="additional_category" value="1"<?php  if (
    $search_products["additional_category"]
) {
    echo ' checked="checked"';
} ?> /> Additional category</label><br />
<label><input type="checkbox" name="in_subcategories" value="1"<?php  if (
    $search_products["in_subcategories"]
) {
    echo ' checked="checked"';
} ?> /> also search in subcategories</label><br />
 </td>
</tr>
<?php  if ($brands) { ?>
<tr>
 <td class="data-name">Search by brand:</td>
 <td><select name="brandid">
 <option value="">&nbsp;</option>
<?php  foreach ($brands as $b) {
    echo '<option value="' .
        $b["brandid"] .
        '"' .
        ($search_products["brandid"] == $b["brandid"]
            ? ' selected="selected"'
            : "") .
        ">" .
        $b["name"] .
        "</option>";
} ?>

 </select></td>
</tr>
<?php  } ?>
<tr>
 <td class="data-name">SKU:</td>
 <td><input type="text" name="sku" value="<?php  echo escape(
     $search_products["sku"],
     2,
 ); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Product #ID:</td>
 <td><input type="text" name="productid" value="<?php  echo escape(
     $search_products["productid"],
     2,
 ); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Price:</td>
 <td><input type="text" size="8" name="price_min" value="<?php  echo escape(
     $search_products["price_min"],
     2,
 ); ?>" /><span class="search-from-to-sep">-</span><input type="text" size="8" name="price_max" value="<?php  echo escape(
    $search_products["price_max"],
    2,
); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Market price:</td>
 <td><input type="text" size="8" name="list_price_min" value="<?php  echo escape(
     $search_products["list_price_min"],
     2,
 ); ?>" /><span class="search-from-to-sep">-</span><input type="text" size="8" name="list_price_max" value="<?php  echo escape(
    $search_products["list_price_max"],
    2,
); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Quantity:</td>
 <td><input type="text" size="8" name="avail_min" value="<?php  echo escape(
     $search_products["avail_min"],
     2,
 ); ?>" /><span class="search-from-to-sep">-</span><input type="text" size="8" name="avail_max" value="<?php  echo escape(
    $search_products["avail_max"],
    2,
); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Weight (lbs):</td>
 <td><input type="text" size="8" name="weight_min" value="<?php  echo escape(
     $search_products["weight_min"],
     2,
 ); ?>" /><span class="search-from-to-sep">-</span><input type="text" size="8" name="weight_max" value="<?php  echo escape(
    $search_products["weight_max"],
    2,
); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Availability:</td>
 <td><select name="status">
 <option value="">&nbsp;</option>
 <option value="1"<?php  if ($search_products["status"] == 1) {
     echo ' selected="selected"';
 } ?>>Available for sale</option>
 <option value="2"<?php  if ($search_products["status"] == 2) {
     echo ' selected="selected"';
 } ?>>Not available</option>
 <option value="3"<?php  if ($search_products["status"] == 3) {
     echo ' selected="selected"';
 } ?>>Hidden, but available for sale</option>
 </select></td>
</tr>
<tr>
 <td></td>
 <td><br /><button>Search</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a class="ajax_link" href="<?php echo $current_location;?>/admin/products/reset">Reset</a></td>
</tr>
</table>
<br />
<?php if (!$products) {?>
<br />
No products found
<?php } else  { ?>
<h3 class="scroll_to_products">Product search results</h3>
<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php } ?>

<br />

<a href="javascript: void(0);" onclick="javascript: check_all(document.psform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.psform, 'to_delete', false);">Uncheck all</a>

<br /><br />

<table class="lines-table resp-table products-table">
<thead>
<tr>
 <th style="width:10px"></th>
 <th><a href="/admin/products?sort=sku<?php  echo $direction; ?>">SKU</a></th>
 <th style="width:100%"><a href="/admin/products?sort=name&direction=<?php if ($_GET['direction']) {?>0<?php } else  { ?>1<?php } ?>">Product name</a></th>
 <th><a href="/admin/products?sort=price<?php  echo $direction; ?>">Price</a></th>
 <th><a href="/admin/products?sort=avail<?php  echo $direction; ?>">In stock</a></th>
 <th>Status</th>
</tr>
</thead>
<?php  foreach ($products as $v) {
    echo '
<tr>
 <td><input type="checkbox" data-pid="' .
        $v["productid"] .
        '" name="to_delete[' .
        $v["productid"] .
        ']" value="1" /></td>
 <td><label>SKU</label>' .
        $v["sku"] .
        '</td>
 <td><label>Product name</label><a href="/admin/products/' .
        $v["productid"] .
        '">' .
        $v["name"] .
        '</a></td>
 <td class="no-word-break"><label>Price</label><input type="text" size="10" name="posted_data[' .
        $v["productid"] .
        '][price]" value="' .
        $v["price"] .
        '"></td>
 <td class="no-word-break"><label>In stock</label><input type="text" size="10" name="posted_data[' .
        $v["productid"] .
        '][avail]" value="' .
        $v["avail"] .
        '"></td>
 <td class="no-word-break"><label>Status</label>
<select name="posted_data[' .
        $v["productid"] .
        '][status]">
 <option value="1">Available for sale</option>
 <option value="2"' .
        ($v["status"] == 2 ? " selected" : "") .
        '>Not available</option>
 <option value="3"' .
        ($v["status"] == 3 ? " selected" : "") .
        '>Hidden, but available for sale</option>
</select>
 </td>
</tr>
		';
} ?>
</table>
<br />

<div class="fixed_save_button">
<button type="button" onclick="submitForm(this, 'update');">Save</button>
&nbsp; <button type="button" onclick="export_selected();">Export selected</button>
&nbsp;
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete_products');">Delete selected</button>
</div>

<?php if ($search_products) {?>
<script>
$([document.documentElement, document.body]).animate({
    scrollTop: $('.scroll_to_products').offset().top
}, 500);
</script>
<?php } ?>
<?php } ?>
</form>

<script>
function export_selected() {
	var selected = '';
	$('.lines-table input').each(function() {
		if ($(this).is(':checked'))
			selected += $(this).attr('data-pid')+',';
	});

	if (selected)
		self.location='/admin/export?product='+selected;
	else 
		alert('You not selected any products');
}
</script>