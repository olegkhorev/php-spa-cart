<script src="<?php echo $current_location;?>/ckeditor/ckeditor.js"></script>

<?php  if ($get['2'] == 'add') { ?>
<h3>Добавить товар <b class="translate"><span class="hidden word">Add product</span><span class="hidden translate-phrase">Добавить товар</span>(Edit)</b></h3>
<?php  } ?>

<form method="POST" enctype='multipart/form-data' name="pform"<?php /* ?>if $get['2'] == 'add'} class="noajax"{/if<?php */ ?>>
<input type="hidden" name="mode" value="" />
<table width="800" class="normal-table">
<tr>
 <td>SKU <b class="translate"><span class="hidden word">SKU</span><span class="hidden translate-phrase">SKU</span>(Edit)</b></td>
 <td><input type="text" size="10" name="sku" value="<?php  echo escape($product['sku']);?>" /></td>
</tr>
<tr>
 <td>Имя <b class="translate"><span class="hidden word">Name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></td>
 <td><input type="text" size="80" name="name" value="<?php  echo escape($product['name']);?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" /></td>
</tr>
<tr>
 <td>Чистый URL <b class="translate"><span class="hidden word">Clean URL</span><span class="hidden translate-phrase">Чистый URL</span>(Edit)</b></td>
 <td><input type="text" size="80" name="cleanurl" value="<?php  echo escape($product['cleanurl']);?>" /></td>
</tr>
<?php if (!$warehouse_enabled) {?>
<tr>
 <td>В наличии <b class="translate"><span class="hidden word">In stock</span><span class="hidden translate-phrase">В наличии</span>(Edit)</b></td>
 <td><input type="text" size="10" name="avail" value="<?php  echo $product['name'] ? $product['avail'] : '1000'; ?>" />
 </td>
</tr>
<?php } ?>
<tr>
 <td>Цена <b class="translate"><span class="hidden word">Price</span><span class="hidden translate-phrase">Цена</span>(Edit)</b> (<?php echo $config['General']['currency_symbol'];?>)</td>
 <td><input type="text" size="10" name="price" value="<?php  echo $product['price'] ? $product['price'] : '0.00'; ?>" /></td>
</tr>
<tr>
 <td>Цена по прейскуранту <b class="translate"><span class="hidden word">List price</span><span class="hidden translate-phrase">Цена по прейскуранту</span>(Edit)</b> (<?php echo $config['General']['currency_symbol'];?>)</td>
 <td><input type="text" size="10" name="list_price" value="<?php  echo $product['list_price'] ? $product['list_price'] : '0.00'; ?>" /></td>
</tr>
<tr>
 <td>Вес <b class="translate"><span class="hidden word">Weight</span><span class="hidden translate-phrase">Вес</span>(Edit)</b> (<?php echo $config['General']['weight_symbol'];?>)</td>
 <td><input type="text" size="10" name="weight" value="<?php  echo $product['weight'] ? $product['weight'] : '0.00'; ?>" /></td>
</tr>
<tr>
 <td>Категория <b class="translate"><span class="hidden word">Category</span><span class="hidden translate-phrase">Категория</span>(Edit)</b></td>
 <td>
<?php  echo $categories_tree; ?>
 </td>
</tr>
<tr>
 <td>Дополнительные категории <b class="translate"><span class="hidden word">Additional categories</span><span class="hidden translate-phrase">Дополнительные категории</span>(Edit)</b></td>
 <td>
<?php  echo $categories_tree_m; ?>
 </td>
</tr>
<tr>
 <td class="data-name">Бренд <b class="translate"><span class="hidden word">Brand</span><span class="hidden translate-phrase">Бренд</span>(Edit)</b>:</td>
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
 <td>Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></td>
 <td>
<select name="status">
<option value="1">Доступно <b class="translate"><span class="hidden word">Available</span><span class="hidden translate-phrase">Доступно</span>(Edit)</b></option>
<option value="2"<?php  if ($product['status'] == 2) echo ' selected';?>>Нет в наличии <b class="translate"><span class="hidden word">Not available</span><span class="hidden translate-phrase">Нет в наличии</span>(Edit)</b></option>
<option value="3"<?php  if ($product['status'] == 3) echo ' selected';?>>Скрыт, но доступен для продажи <b class="translate"><span class="hidden word">Hidden, but available for sale</span><span class="hidden translate-phrase">Скрыт, но доступен для продажи</span>(Edit)</b></option>
</select>
 </td>
</tr>
<tr>
 <td>Ключевые слова <b class="translate"><span class="hidden word">Keywords</span><span class="hidden translate-phrase">Ключевые слова</span>(Edit)</b></td>
 <td><input type="text" size="80" name="keywords" value="<?php  echo escape($product['keywords']);?>" /></td>
</tr>
<tr>
 <td colspan="2"><br />Описание <b class="translate"><span class="hidden word">Description</span><span class="hidden translate-phrase">Описание</span>(Edit)</b><br />
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
 <td>Мета-тег title <b class="translate"><span class="hidden word">Meta title</span><span class="hidden translate-phrase">Мета-тег title</span>(Edit)</b></td>
 <td><input type="text" size="80" name="title_tag" value="<?php  echo escape($product['title_tag']);?>" /></td>
</tr>
<tr>
 <td>Мета-тег keywords <b class="translate"><span class="hidden word">Meta keywords</span><span class="hidden translate-phrase">Мета-тег keywords</span>(Edit)</b></td>
 <td><input type="text" size="80" name="meta_keywords" value="<?php  echo escape($product['meta_keywords']);?>" /></td>
</tr>
<tr>
 <td>Мета-описание <b class="translate"><span class="hidden word">Meta description</span><span class="hidden translate-phrase">Мета-описание</span>(Edit)</b></td>
 <td><input type="text" size="80" name="meta_description" value="<?php  echo escape($product['meta_description']);?>" /></td>
</tr>
<tr>
 <td colspan="2"><br>

<div class="fixed_save_button">
<button>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
<?php if ($product) {?>
&nbsp; <button type="button" onclick="self.location='/admin/export?product=<?php echo $product['productid'];?>';">Экспорт <b class="translate"><span class="hidden word">Export</span><span class="hidden translate-phrase">Экспорт</span>(Edit)</b></button>
&nbsp; <button type="button" onclick="if (confirm('Are you sure?', $(this)) || confirmed) { document.pform.mode.value='clone'; document.pform.submit(); }">Clone product <b class="translate"><span class="hidden word">Clone product</span><span class="hidden translate-phrase">Clone product</span>(Edit)</b></button>
&nbsp; <button type="button" onclick="window.open('<?php echo $current_location;?>/product/<?php echo $product['productid'];?>', '');">View product <b class="translate"><span class="hidden word">View product</span><span class="hidden translate-phrase">View product</span>(Edit)</b></button>
&nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp;
<button type="button" onclick="if (confirm('Are you sure?', $(this)) || confirmed) { document.pform.mode.value='delete'; document.pform.submit(); }">Удалить <b class="translate"><span class="hidden word">Delete</span><span class="hidden translate-phrase">Удалить</span>(Edit)</b></button>
<?php } ?>
</div>
 </td>
</tr>
</table>
</form>