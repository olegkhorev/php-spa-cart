<form method="POST" name="prform">
<input type="hidden" name="section" value="related">
<input type="hidden" name="mode" value="update">
<?php 
if ($related_products) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.prform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.prform, 'to_delete', false);">Uncheck all</a>
<?php 
}
?>
<table width="500" class="lines-table resp-table related-table" style="margin-bottom: 0;">
<?php 
if ($related_products) {
?>
<thead>
<tr>
 <th width="10">&nbsp;</th>
 <th width="100%">Product</th>
 <th>Pos</th>
</tr>
</thead>
<?php 
foreach ($related_products as $v) {
	echo '
<tr>
 <td><input type="checkbox" name="to_delete['.$v['productid'].']"></td>
 <td><label>Product</label><a href="'.$current_location.'/admin/products/'.$v['productid'].'" target="_blank">'.$v['name'].'</a></td>
 <td><label>Pos</label><input size="5" type="text" name="posted_data['.$v['productid'].'][orderby]" value="'.$v['orderby'].'"></td>
</tr>
	';
}
?>
<tr>
 <td colspan="3" class="resp-td-width-100"><br><button type="submit">Update</button> <button type="button" onclick="submitForm(this, 'delete');">Delete selected</button></td>
</tr>
<?php 
}
?>
<tr>
 <td colspan="3" class="resp-td-width-100" style="border-top: 0 !important;"><br /><h3>Add new</h3></td>
</tr>
<tr>
 <td colspan="3" class="resp-td-width-100">
    <input type="hidden" name="newproductid" />
    <input type="text" size="35" name="newproduct" disabled="disabled" />
<script>
var popup_product_pid = document.prform.newproductid,
	popup_product_pname = document.prform.newproduct;
</script>
    <button type="button" onclick="javascript: popup_product();">Browse...</button>
 </td>
</tr>
<tr>
 <td colspan="3" class="resp-td-width-100"><br><button>Add</button></td>
</tr>
</table>
</form>