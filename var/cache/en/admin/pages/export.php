<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Export catalog</h1>
<form action="/admin/export<?php if ($_GET['product']) {?>?product=<?php echo $_GET['product'];?><?php } ?>" method="post" accept-charset="utf-8" class="list-form noajax" name="exportForm">

<?php if ($_GET['product']) {?>
<input type="hidden" name="export_product" value="<?php echo $_GET['product'];?>" />
<br />
Export product #<?php echo $_GET['product'];?>. <a href="/admin/export">Reset</a>
<hr />
<?php } ?>

<br />
<a href="/admin/export/download" target="_blank">Download last generated file</a>

<br />
<br />
<a href="javascript: void(0);" onclick="javascript: import_checkboxes('Y');">Check all</a> / <a href="javascript: void(0);" onclick="javascript: import_checkboxes();">Uncheck all</a>

<table class="lines-table export">
<?php if (!$_GET['product']) {?>
<tr>
 <th style="width:15px"><input type="checkbox" name="import[categories]" /></th>
 <th>Categories</th>
</tr>
<tr>
 <td></td>
 <td class="second">
  <table>
   <tr>
    <td><input type="checkbox" name="import[cat_banners]" /></td>
    <td>Banners</td>
   </tr>
  </table>
 </td>
</tr>

<tr>
 <th style="width:15px"><input type="checkbox" name="import[brands]" /></th>
 <th>Brands</th>
</tr>
<?php } ?>

<?php if ($warehouse_enabled) {?>
<tr>
 <th style="width:15px"><input type="checkbox" name="import[warehouses]" /></th>
 <th>Warehouses</th>
</tr>
<?php } ?>

<tr>
 <th style="width:15px"><input type="checkbox" name="import[products]" /></th>
 <th style="width:100%">Products</th>
</tr>

<?php if ($warehouse_enabled) {?>
<tr>
 <td></td>
 <td class="second">
  <table>
   <tr>
    <td><input type="checkbox" name="import[inventory]" /></td>
    <td>Warehouses inventory</td>
   </tr>
  </table>
 </td>
</tr>
<?php } ?>
<tr>
 <td></td>
 <td class="second">
  <table>
   <tr>
    <td><input type="checkbox" name="import[images]" /></td>
    <td>Images</td>
   </tr>
  </table>
 </td>
</tr>
<tr>
 <td></td>
 <td class="second">
  <table>
   <tr>
    <td><input type="checkbox" name="import[options]" /></td>
    <td>Products Options</td>
   </tr>
  </table>
 </td>
</tr>
<tr>
 <td></td>
 <td class="third">
  <table>
   <tr>
    <td><input type="checkbox" name="import[variants]" /></td>
    <td>Variants</td>
   </tr>
  </table>
 </td>
</tr>
<tr>
 <td></td>
 <td class="third">
  <table>
   <tr>
    <td><input type="checkbox" name="import[variant_images]" /></td>
    <td>Variants images</td>
   </tr>
  </table>
 </td>
</tr>
<?php if ($warehouse_enabled) {?>
<tr>
 <td></td>
 <td class="third">
  <table>
   <tr>
    <td><input type="checkbox" name="import[variant_inventory]" /></td>
    <td>Variants warehouses inventory</td>
   </tr>
  </table>
 </td>
</tr>
<?php } ?>
<tr>
 <td></td>
 <td class="second">
  <table>
   <tr>
    <td><input type="checkbox" name="import[wholesale]" /></td>
    <td>Wholesale pricing</td>
   </tr>
  </table>
 </td>
</tr>
<tr>
 <td></td>
 <td class="second">
  <table>
   <tr>
    <td><input type="checkbox" name="import[related]" /></td>
    <td>Related items</td>
   </tr>
  </table>
 </td>
</tr>
<?php /* ?>
<tr>
 <td></td>
 <td class="second">
  <table>
   <tr>
    <td><input type="checkbox" name="import[reviews]" /></td>
    <td>Customer reviews</td>
   </tr>
  </table>
 </td>
</tr>
<?php */ ?>
<tr>
 <td></td>
 <td><br /><button type="submit">Export</button></td>
</tr>
</table>

</form>

