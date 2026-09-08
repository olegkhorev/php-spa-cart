<script src="<?php echo $current_location;?>/ckeditor/ckeditor.js"></script>

<?php  if ($get['2'] == 'add') { ?>
<h3>Add product</h3>
<?php  } ?>

<form method="POST" enctype='multipart/form-data' name="pform"<?php /* ?>if $get['2'] == 'add'} class="noajax"{/if<?php */ ?>>
<input type="hidden" name="mode" value="" />
<table width="800" class="normal-table">
<tr>
 <td>SKU</td>
 <td><input type="text" size="10" name="sku" value="<?php  echo escape($product['sku']);?>" /></td>
</tr>
<tr>
 <td>Name</td>
 <td><input type="text" size="80" name="name" value="<?php  echo escape($product['name']);?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" /></td>
</tr>
<tr>
 <td>Clean URL</td>
 <td><input type="text" size="80" name="cleanurl" value="<?php  echo escape($product['cleanurl']);?>" /></td>
</tr>
<?php if (!$warehouse_enabled) {?>
<tr>
 <td>In stock</td>
 <td><input type="text" size="10" name="avail" value="<?php  echo $product['name'] ? $product['avail'] : '1000'; ?>" />
 </td>
</tr>
<?php } ?>
<tr>
 <td>Price (<?php echo $config['General']['currency_symbol'];?>)</td>
 <td><input type="text" size="10" name="price" value="<?php  echo $product['price'] ? $product['price'] : '0.00'; ?>" /></td>
</tr>
<tr>
 <td>List price (<?php echo $config['General']['currency_symbol'];?>)</td>
 <td><input type="text" size="10" name="list_price" value="<?php  echo $product['list_price'] ? $product['list_price'] : '0.00'; ?>" /></td>
</tr>
<tr>
 <td>Weight (<?php echo $config['General']['weight_symbol'];?>)</td>
 <td><input type="text" size="10" name="weight" value="<?php  echo $product['weight'] ? $product['weight'] : '0.00'; ?>" /></td>
</tr>
<tr>
 <td>Category</td>
 <td>
<?php  echo $categories_tree; ?>
 </td>
</tr>
<tr>
 <td>Additional categories</td>
 <td>
<?php  echo $categories_tree_m; ?>
 </td>
</tr>
<tr>
 <td class="data-name">Brand:</td>
 <td><select name="brandid">
 <option value=""></option>
<?php 
if ($brands) {
	foreach ($brands as $b) {
		echo '<option value="'.$b['brandid'].'"'.($product['brandid'] == $b['brandid'] ?  ' selected="selected"' : '').'>'.$b['name'].'</option>';
	}
}
?>
 </select></td>
</tr>
<tr>
 <td>Status</td>
 <td>
<select name="status">
<option value="1">Available</option>
<option value="2"<?php  if ($product['status'] == 2) echo ' selected';?>>Not available</option>
<option value="3"<?php  if ($product['status'] == 3) echo ' selected';?>>Hidden, but available for sale</option>
</select>
 </td>
</tr>
<tr>
 <td>Keywords</td>
 <td><input type="text" size="80" name="keywords" value="<?php  echo escape($product['keywords']);?>" /></td>
</tr>
<tr>
 <td colspan="2"><br />Description<br />
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		    $('*').removeAttr("title");
		});
	</script>
	<textarea class="ckeditor" id="ck_editor" name="descr" cols="100" rows="10"><?php  echo $product['descr'];?></textarea><br />
 </td>
</tr>
<tr>
 <td>Meta title</td>
 <td><input type="text" size="80" name="title_tag" value="<?php  echo escape($product['title_tag']);?>" /></td>
</tr>
<tr>
 <td>Meta keywords</td>
 <td><input type="text" size="80" name="meta_keywords" value="<?php  echo escape($product['meta_keywords']);?>" /></td>
</tr>
<tr>
 <td>Meta description</td>
 <td><input type="text" size="80" name="meta_description" value="<?php  echo escape($product['meta_description']);?>" /></td>
</tr>
<tr>
 <td colspan="2"><br>

<div class="fixed_save_button">
<button>Save</button>
<?php if ($product) {?>
&nbsp; <button type="button" onclick="self.location='/admin/export?product=<?php echo $product['productid'];?>';">Export</button>
&nbsp; <button type="button" onclick="if (confirm('Are you sure?', $(this)) || confirmed) { document.pform.mode.value='clone'; document.pform.submit(); }">Clone product</button>
&nbsp; <button type="button" onclick="window.open('<?php echo $current_location;?>/product/<?php echo $product['productid'];?>', '');">View product</button>
&nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp;
<button type="button" onclick="if (confirm('Are you sure?', $(this)) || confirmed) { document.pform.mode.value='delete'; document.pform.submit(); }">Delete</button>
<?php } ?>
</div>
 </td>
</tr>
</table>
</form>