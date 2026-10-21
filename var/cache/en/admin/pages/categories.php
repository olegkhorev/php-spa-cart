<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Categories</h1>
<br />
<?php if ($category_location) {?>
Category path: <?php echo $category_location;?><hr />
<?php } ?>
<?php 
if ($category) {
?>
<?php if ($category["enabled"] != 1) {?>
<span style="color:#c60">Category disabled</span>
<?php } ?>
<?php 
echo '<a href="/admin/category/' . $category["categoryid"] . '">';
?>
Modify category
<?php 
echo "</a> | ";
echo '<a href="/admin/category/' . $category["categoryid"] . '/products">';
?>
Category products
<?php 
echo "</a> | ";
echo '<a href="javascript: void(0);" onclick="javascript: confirm(\'\', $(\'#delete_category\'), \'/admin/category/' .
    escape($category["categoryid"], 3) .
    '/delete\'); return false;">';
?>
Delete category
<?php  echo "</a><br /><br />"; ?>
<h3>List of subcategories</h3><br />
<?php 
}
?>
<form action="<?php echo $current_location;?>/admin/categories/<?php  echo $category[
    "categoryid"
]; ?>" method="post" name="categories_form">
<input type="hidden" name="mode" value="" />

<table class="categories lines-table resp-table">
<thead>
<tr>
  <th>Enabled</th>
  <th>Pos</th>
  <th colspan="2">Category name</th>
  <th style="text-align:center">Products</th>
  <th style="text-align:center">Subcategories</th>
</tr>
</thead>
<?php  if (empty($categories)) { ?>
<tr>
 <td colspan="6" class="var-wh-100 submit-row td-align-center"><br />No categories<br /><br /></td>
</tr>
<?php  } else  {foreach ($categories as $v) {
        echo '<tr>
  <td class="td-align-center td-w-1pct"><label>Enabled</label><input type="checkbox" name="posted_data[' .
            $v["categoryid"] .
            '][enabled]" value="1"' .
            ($v["enabled"] ? ' checked="checked"' : "") .
            ' /></td>
  <td class="td-w-1pct"><label>Pos</label><input type="text" size="3" name="posted_data[' .
            $v["categoryid"] .
            '][orderby]" maxlength="3" value="' .
            $v["orderby"] .
            '" /></td>
  <td class="td-w-1pct"><label>&nbsp;</label><input type="radio" name="cat" value="' .
            $v["categoryid"] .
            '" /></td>
  <td><label>Category name</label><a href="/admin/categories/' .
            $v["categoryid"] .
            '">' .
            $v["title"] .
            '</a> (<a href="/admin/category/' .
            $v["categoryid"] .
            '">Edit</a>)</td>
  <td class="td-align-center"><label>Products</label><a href="/admin/category/' .
            $v["categoryid"] .
            '/products">' .
            $v["products"] .
            "</a> (" .
            $v["products_global"] .
            ')</td>
  <td class="td-align-center"><label>Subcategories</label><a href="/admin/categories/' .
            $v["categoryid"] .
            '">' .
            $v["subcategories"] .
            '</a></td>
		</tr>';
    } ?>
</table>
<br /><br />
<button type="button" onclick="javascript: submitForm(this, '');">Update</button>
<br /><br />
<button type="button" onclick="javascript: self.location='/admin/category/'+document.categories_form.cat.value;">Modify selected</button>
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');">Delete selected</button>
<?php  } ?>
<button type="button" onclick="self.location='/admin/category?parentid=<?php  echo $category[
    "categoryid"
]; ?>'">Add new category</button>
</form>

<br /><br />

<a id="featured"></a>

<h3>Featured products</h3>

<a href="javascript: void(0);" onclick="javascript: check_all(document.fpform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.fpform, 'to_delete', false);">Uncheck all</a>

<br /><br />

<form action="<?php echo $current_location;?>/admin/categories/<?php  echo $category[
    "categoryid"
]; ?>" method="post" name="fpform">
<input type="hidden" name="mode" value="update" />
<input type="hidden" name="action" value="featured_products" />

<table class="lines-table resp-table">
<thead>
<tr>
  <th style="width:10px">&nbsp;</th>
  <th style="width:70%">Product name</th>
  <th style="width:15%;text-align:center">Pos</th>
  <th style="width:15%;text-align:center">Active</th>
</tr>
</thead>
<?php  if ($featured_products) {
    foreach ($featured_products as $v) { ?>
<tr>
  <td><input type="checkbox" name="to_delete[<?php  echo $v[
      "productid"
  ]; ?>]" /></td>
  <td><label>Product name</label><b><a href="<?php echo $current_location;?>/admin/products/<?php  echo $v[
      "productid"
  ]; ?>" target="_blank"><?php  echo $v["name"]; ?></a></b></td>
  <td class="td-align-center"><label>Pos</label><input type="text" name="posted_data[<?php  echo $v[
      "productid"
  ]; ?>][orderby]" size="5" value="<?php  echo $v["orderby"]; ?>" /></td>
  <td class="td-align-center"><label>Active</label><input type="checkbox" name="posted_data[<?php  echo $v[
      "productid"
  ]; ?>][enabled]"<?php  if ($v["enabled"]) {
    echo ' checked="checked"';
} ?> /></td>
</tr>
<?php  } ?>
<tr>
  <td colspan="4" class="var-wh-100 background-transparent">
    <br />
    <button type="submit">Update</button>
    &nbsp; &nbsp; &nbsp;<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) { document.fpform.mode.value = 'delete'; $(document.fpform).submit(); }">Delete selected</button>
  </td>
</tr>

<?php 
} else  {
     ?>

<tr>
	<td colspan="4" class="var-wh-100 background-transparent td-align-center">No featured products in this category</td>
</tr>

<?php 
} ?>

<tr>
<td colspan="4" class="var-wh-100 background-transparent"><br /><h3>Add product</h3></td>
</tr>

<tr>
  <td class="background-transparent">&nbsp;</td>
  <td class="background-transparent no-word-break"><label>Select product</label>
    <input type="hidden" name="newproductid" />
    <input type="text" size="35" name="newproduct" disabled="disabled" />
<script>
var popup_product_pid = document.fpform.newproductid,
	popup_product_pname = document.fpform.newproduct;
</script>
    <button type="button" onclick="javascript: popup_product();">Browse...</button>
  </td>
  <td class="background-transparent td-align-center"><label>Pos</label><input type="text" name="neworderby" size="5" /></td>
  <td class="background-transparent td-align-center"><label>Active</label><input type="checkbox" name="newenabled" checked="checked" /></td>
</tr>

<tr>
  <td colspan="4" class="var-wh-100 background-transparent">
<br />
  <button type="button" onclick="javascript: document.fpform.mode.value = 'add'; $(document.fpform).submit();">Add new</button>
  </td>
</tr>

</table>
</form>
