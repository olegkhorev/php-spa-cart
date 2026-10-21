<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Categories]}</h1>
<br />
{if $category_location}
{lng[Category path]}: {$category_location}<hr />
{/if}
<?php
if ($category) {
?>
{if $category["enabled"] != 1}
<span style="color:#c60">{lng[Category disabled|escape]}</span>
{/if}
<?php
echo '<a href="/admin/category/' . $category["categoryid"] . '">';
?>
{lng[Modify category|escape]}
<?php
echo "</a> | ";
echo '<a href="/admin/category/' . $category["categoryid"] . '/products">';
?>
{lng[Category products|escape]}
<?php
echo "</a> | ";
echo '<a href="javascript: void(0);" onclick="javascript: confirm(\'\', $(\'#delete_category\'), \'/admin/category/' .
    escape($category["categoryid"], 3) .
    '/delete\'); return false;">';
?>
{lng[Delete category|escape]}
<?php echo "</a><br /><br />"; ?>
<h3>{lng[List of subcategories]}</h3><br />
<?php
}
?>
<form action="{$current_location}/admin/categories/<?php echo $category[
    "categoryid"
]; ?>" method="post" name="categories_form">
<input type="hidden" name="mode" value="" />

<table class="categories lines-table resp-table">
<thead>
<tr>
  <th>{lng[Enabled]}</th>
  <th>{lng[Pos]}</th>
  <th colspan="2">{lng[Category name]}</th>
  <th style="text-align:center">{lng[Products]}</th>
  <th style="text-align:center">{lng[Subcategories]}</th>
</tr>
</thead>
<?php if (empty($categories)) { ?>
<tr>
 <td colspan="6" class="var-wh-100 submit-row td-align-center"><br />{lng[No categories]}<br /><br /></td>
</tr>
<?php } else {foreach ($categories as $v) {
        echo '<tr>
  <td class="td-align-center td-w-1pct"><label>{lng[Enabled]}</label><input type="checkbox" name="posted_data[' .
            $v["categoryid"] .
            '][enabled]" value="1"' .
            ($v["enabled"] ? ' checked="checked"' : "") .
            ' /></td>
  <td class="td-w-1pct"><label>{lng[Pos]}</label><input type="text" size="3" name="posted_data[' .
            $v["categoryid"] .
            '][orderby]" maxlength="3" value="' .
            $v["orderby"] .
            '" /></td>
  <td class="td-w-1pct"><label>&nbsp;</label><input type="radio" name="cat" value="' .
            $v["categoryid"] .
            '" /></td>
  <td><label>{lng[Category name]}</label><a href="/admin/categories/' .
            $v["categoryid"] .
            '">' .
            $v["title"] .
            '</a> (<a href="/admin/category/' .
            $v["categoryid"] .
            '">{lng[Edit|escape]}</a>)</td>
  <td class="td-align-center"><label>{lng[Products]}</label><a href="/admin/category/' .
            $v["categoryid"] .
            '/products">' .
            $v["products"] .
            "</a> (" .
            $v["products_global"] .
            ')</td>
  <td class="td-align-center"><label>{lng[Subcategories]}</label><a href="/admin/categories/' .
            $v["categoryid"] .
            '">' .
            $v["subcategories"] .
            '</a></td>
		</tr>';
    } ?>
</table>
<br /><br />
<button type="button" onclick="javascript: submitForm(this, '');">{lng[Update]}</button>
<br /><br />
<button type="button" onclick="javascript: self.location='/admin/category/'+document.categories_form.cat.value;">{lng[Modify selected]}</button>
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');">{lng[Delete selected]}</button>
<?php } ?>
<button type="button" onclick="self.location='/admin/category?parentid=<?php echo $category[
    "categoryid"
]; ?>'">{lng[Add new category]}</button>
</form>

<br /><br />

<a id="featured"></a>

<h3>{lng[Featured products]}</h3>

<a href="javascript: void(0);" onclick="javascript: check_all(document.fpform, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.fpform, 'to_delete', false);">{lng[Uncheck all]}</a>

<br /><br />

<form action="{$current_location}/admin/categories/<?php echo $category[
    "categoryid"
]; ?>" method="post" name="fpform">
<input type="hidden" name="mode" value="update" />
<input type="hidden" name="action" value="featured_products" />

<table class="lines-table resp-table">
<thead>
<tr>
  <th style="width:10px">&nbsp;</th>
  <th style="width:70%">{lng[Product name]}</th>
  <th style="width:15%;text-align:center">{lng[Pos]}</th>
  <th style="width:15%;text-align:center">{lng[Active]}</th>
</tr>
</thead>
<?php if ($featured_products) {
    foreach ($featured_products as $v) { ?>
<tr>
  <td><input type="checkbox" name="to_delete[<?php echo $v[
      "productid"
  ]; ?>]" /></td>
  <td><label>{lng[Product name]}</label><b><a href="{$current_location}/admin/products/<?php echo $v[
      "productid"
  ]; ?>" target="_blank"><?php echo $v["name"]; ?></a></b></td>
  <td class="td-align-center"><label>{lng[Pos]}</label><input type="text" name="posted_data[<?php echo $v[
      "productid"
  ]; ?>][orderby]" size="5" value="<?php echo $v["orderby"]; ?>" /></td>
  <td class="td-align-center"><label>{lng[Active]}</label><input type="checkbox" name="posted_data[<?php echo $v[
      "productid"
  ]; ?>][enabled]"<?php if ($v["enabled"]) {
    echo ' checked="checked"';
} ?> /></td>
</tr>
<?php } ?>
<tr>
  <td colspan="4" class="var-wh-100 background-transparent">
    <br />
    <button type="submit">{lng[Update]}</button>
    &nbsp; &nbsp; &nbsp;<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) { document.fpform.mode.value = 'delete'; $(document.fpform).submit(); }">{lng[Delete selected]}</button>
  </td>
</tr>

<?php
} else {
     ?>

<tr>
	<td colspan="4" class="var-wh-100 background-transparent td-align-center">{lng[No featured products in this category]}</td>
</tr>

<?php
} ?>

<tr>
<td colspan="4" class="var-wh-100 background-transparent"><br /><h3>{lng[Add product]}</h3></td>
</tr>

<tr>
  <td class="background-transparent">&nbsp;</td>
  <td class="background-transparent no-word-break"><label>{lng[Select product]}</label>
    <input type="hidden" name="newproductid" />
    <input type="text" size="35" name="newproduct" disabled="disabled" />
<script>
var popup_product_pid = document.fpform.newproductid,
	popup_product_pname = document.fpform.newproduct;
</script>
    <button type="button" onclick="javascript: popup_product();">{lng[Browse...]}</button>
  </td>
  <td class="background-transparent td-align-center"><label>{lng[Pos]}</label><input type="text" name="neworderby" size="5" /></td>
  <td class="background-transparent td-align-center"><label>{lng[Active]}</label><input type="checkbox" name="newenabled" checked="checked" /></td>
</tr>

<tr>
  <td colspan="4" class="var-wh-100 background-transparent">
<br />
  <button type="button" onclick="javascript: document.fpform.mode.value = 'add'; $(document.fpform).submit();">{lng[Add new]}</button>
  </td>
</tr>

</table>
</form>
