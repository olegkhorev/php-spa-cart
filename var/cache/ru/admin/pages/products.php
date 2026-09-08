<?php 
if (!isset($_GET['direction']) || $_GET['direction'])
	$direction = "&direction=0";
else 
	$direction = "&direction=1";
?>
<h3>Продукты <b class="translate"><span class="hidden word">Products</span><span class="hidden translate-phrase">Продукты</span>(Edit)</b></h3>
<form method="POST" name="psform" href="/admin/products">
<input type="hidden" name="mode" value="search" />
<table class="search_table">
<tr>
 <td class="data-name">Поиск по подстроке <b class="translate"><span class="hidden word">Search by substring</span><span class="hidden translate-phrase">Поиск по подстроке</span>(Edit)</b>:</td>
 <td><input type="text" name="substring" value="<?php  echo escape($search_products['substring'], 2); ?>" size="40" />
&nbsp;
<button>Поиск <b class="translate"><span class="hidden word">Search</span><span class="hidden translate-phrase">Поиск</span>(Edit)</b></button>
 </td>
</tr>
<tr>
 <td colspan="2"><a href="javascript: void(0);" onclick="$(this).hide(); $('#advanced_search').show();">Расширенный поиск <b class="translate"><span class="hidden word">Advanced search</span><span class="hidden translate-phrase">Расширенный поиск</span>(Edit)</b></a></td>
</tr>
</table>

<table id="advanced_search" class="search_table">
<tr>
 <td class="data-name top">Поиск в категории <b class="translate"><span class="hidden word">Search in category</span><span class="hidden translate-phrase">Поиск в категории</span>(Edit)</b>:</td>
 <td><?php  echo $categories_tree; ?><br />
как <b class="translate"><span class="hidden word">as</span><span class="hidden translate-phrase">как</span>(Edit)</b> <label><input type="checkbox" name="main_category" value="1"<?php  if (!$search_products || $search_products['main_category']) echo 'checked="checked"'; ?> /> Основная категория <b class="translate"><span class="hidden word">Main category</span><span class="hidden translate-phrase">Основная категория</span>(Edit)</b></label>
&nbsp; <label><input type="checkbox" name="additional_category" value="1"<?php  if ($search_products['additional_category']) echo ' checked="checked"'; ?> /> Дополнительная категория <b class="translate"><span class="hidden word">Additional category</span><span class="hidden translate-phrase">Дополнительная категория</span>(Edit)</b></label><br />
<label><input type="checkbox" name="in_subcategories" value="1"<?php  if ($search_products['in_subcategories']) echo ' checked="checked"'; ?> /> также искать в подкатегориях <b class="translate"><span class="hidden word">also search in subcategories</span><span class="hidden translate-phrase">также искать в подкатегориях</span>(Edit)</b></label><br />
 </td>
</tr>
<?php 
if ($brands) {
?>
<tr>
 <td class="data-name">Поиск по бренду <b class="translate"><span class="hidden word">Search by brand</span><span class="hidden translate-phrase">Поиск по бренду</span>(Edit)</b>:</td>
 <td><select name="brandid">
 <option value=""></option>
<?php 
	foreach ($brands as $b) {
		echo '<option value="'.$b['brandid'].'"'.($search_products['brandid'] == $b['brandid'] ?  ' selected="selected"' : '').'>'.$b['name'].'</option>';
	}
?>

 </select></td>
</tr>
<?php 
}
?>
<tr>
 <td class="data-name">SKU <b class="translate"><span class="hidden word">SKU</span><span class="hidden translate-phrase">SKU</span>(Edit)</b>:</td>
 <td><input type="text" name="sku" value="<?php  echo escape($search_products['sku'], 2); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Идентификатор товара <b class="translate"><span class="hidden word">Product #ID</span><span class="hidden translate-phrase">Идентификатор товара</span>(Edit)</b>:</td>
 <td><input type="text" name="productid" value="<?php  echo escape($search_products['productid'], 2); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Цена <b class="translate"><span class="hidden word">Price</span><span class="hidden translate-phrase">Цена</span>(Edit)</b>:</td>
 <td><input type="text" size="8" name="price_min" value="<?php  echo escape($search_products['price_min'], 2); ?>" /> - <input type="text" size="8" name="price_max" value="<?php  echo escape($search_products['price_max'], 2); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Цена по прейскуранту <b class="translate"><span class="hidden word">List price</span><span class="hidden translate-phrase">Цена по прейскуранту</span>(Edit)</b>:</td>
 <td><input type="text" size="8" name="list_price_min" value="<?php  echo escape($search_products['list_price_min'], 2); ?>" /> - <input type="text" size="8" name="list_price_max" value="<?php  echo escape($search_products['list_price_max'], 2); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Количество <b class="translate"><span class="hidden word">Quantity</span><span class="hidden translate-phrase">Количество</span>(Edit)</b>:</td>
 <td><input type="text" size="8" name="avail_min" value="<?php  echo escape($search_products['avail_min'], 2); ?>" /> - <input type="text" size="8" name="avail_max" value="<?php  echo escape($search_products['avail_max'], 2); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Вес (кг) <b class="translate"><span class="hidden word">Weight (lbs)</span><span class="hidden translate-phrase">Вес (кг)</span>(Edit)</b>:</td>
 <td><input type="text" size="8" name="weight_min" value="<?php  echo escape($search_products['weight_min'], 2); ?>" /> - <input type="text" size="8" name="weight_max" value="<?php  echo escape($search_products['weight_max'], 2); ?>" /></td>
</tr>
<tr>
 <td class="data-name">Доступность <b class="translate"><span class="hidden word">Availability</span><span class="hidden translate-phrase">Доступность</span>(Edit)</b>:</td>
 <td><select name="status">
 <option value=""></option>
 <option value="1"<?php  if ($search_products['status'] == 1) echo ' selected="selected"'; ?>>Доступно для продажи <b class="translate"><span class="hidden word">Available for sale</span><span class="hidden translate-phrase">Доступно для продажи</span>(Edit)</b></option>
 <option value="2"<?php  if ($search_products['status'] == 2) echo ' selected="selected"'; ?>>Нет в наличии <b class="translate"><span class="hidden word">Not available</span><span class="hidden translate-phrase">Нет в наличии</span>(Edit)</b></option>
 <option value="3"<?php  if ($search_products['status'] == 3) echo ' selected="selected"'; ?>>Скрыт, но доступен для продажи <b class="translate"><span class="hidden word">Hidden, but available for sale</span><span class="hidden translate-phrase">Скрыт, но доступен для продажи</span>(Edit)</b></option>
 </select></td>
</tr>
<tr>
 <td></td>
 <td><br /><button>Поиск <b class="translate"><span class="hidden word">Search</span><span class="hidden translate-phrase">Поиск</span>(Edit)</b></button></td>
</tr>
</table>
<br /><br />
<?php 
if (empty($products)) {
?>
Товары не найдены <b class="translate"><span class="hidden word">No products found</span><span class="hidden translate-phrase">Товары не найдены</span>(Edit)</b>
<?php 
} else  {
?>

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<br />
<?php 
}
?>
<br /><a href="javascript: void(0);" onclick="javascript: check_all(document.psform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.psform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>

<table width="100%" class="lines-table">
<tr>
 <th width="10"></th>
 <th><a href="/admin/products?sort=sku<?php  echo $direction; ?>">SKU <b class="translate"><span class="hidden word">SKU</span><span class="hidden translate-phrase">SKU</span>(Edit)</b></a></th>
 <th width="100%"><a href="/admin/products?sort=name&direction=<?php if ($_GET['direction']) {?>0<?php } else  { ?>1<?php } ?>">Название товара <b class="translate"><span class="hidden word">Product name</span><span class="hidden translate-phrase">Название товара</span>(Edit)</b></a></th>
 <th><a href="/admin/products?sort=price<?php  echo $direction; ?>">Цена <b class="translate"><span class="hidden word">Price</span><span class="hidden translate-phrase">Цена</span>(Edit)</b></a></th>
 <th><a href="/admin/products?sort=avail<?php  echo $direction; ?>">В наличии <b class="translate"><span class="hidden word">In stock</span><span class="hidden translate-phrase">В наличии</span>(Edit)</b></a></th>
 <th>Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></th>
</tr>
<?php 
	foreach ($products as $v) {		echo '
<tr>
 <td><input type="checkbox" pid="'.$v['productid'].'" name="to_delete['.$v['productid'].']" value="1" /></td>
 <td nowarp>'.$v['sku'].'</td>
 <td><a href="/admin/products/'.$v['productid'].'">'.$v['name'].'</a></td>
 <td><input type="text" size="10" name="posted_data['.$v['productid'].'][price]" value="'.$v['price'].'"></td>
 <td><input type="text" size="10" name="posted_data['.$v['productid'].'][avail]" value="'.$v['avail'].'"></td>
 <td>
<select name="posted_data['.$v['productid'].'][status]">
 <option value="1">Доступно для продажи <b class="translate"><span class="hidden word">Available for sale</span><span class="hidden translate-phrase">Доступно для продажи</span>(Edit)</b></option>
 <option value="2"'.($v['status'] == 2 ? ' selected' : '').'>Нет в наличии <b class="translate"><span class="hidden word">Not available</span><span class="hidden translate-phrase">Нет в наличии</span>(Edit)</b></option>
 <option value="3"'.($v['status'] == 3 ? ' selected' : '').'>Скрыт, но доступен для продажи <b class="translate"><span class="hidden word">Hidden, but available for sale</span><span class="hidden translate-phrase">Скрыт, но доступен для продажи</span>(Edit)</b></option>
</select>
 </td>
</tr>
		';	}
?>
</table>
<br />

<div class="fixed_save_button">
<button type="button" onclick="submitForm(this, 'update');">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
&nbsp; <button type="button" onclick="export_selected();">Export selected <b class="translate"><span class="hidden word">Export selected</span><span class="hidden translate-phrase">Export selected</span>(Edit)</b></button>
&nbsp;
<button type="button" onclick="if (confirm('Are you sure?', $(this)) || confirmed) submitForm(this, 'delete_products');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>

<?php 
}
?>
</form>

<script>
function export_selected() {
	var selected = '';
	$('.lines-table input').each(function() {
		if ($(this).is(':checked'))
			selected += $(this).attr('pid')+',';
	});

	if (selected)
		self.location='/admin/export?product='+selected;
	else 
		alert('You not selected any products');
}
</script>