<?php 
if ($category_location)
	echo $category_location.'<hr />';
if ($category) {
	if ($category['enabled'] != 1)
		echo "<font color='#c60'>";
?>
Категория отключена <b class="translate"><span class="hidden word">Category disabled</span><span class="hidden translate-phrase">Категория отключена</span>(Edit)</b>
<?php 
		echo "</font><br /><br />";

	echo '<a href="/admin/category/'.$category['categoryid'].'">';
?>
Изменить категорию <b class="translate"><span class="hidden word">Modify category</span><span class="hidden translate-phrase">Изменить категорию</span>(Edit)</b>
<?php 
	echo '</a> | ';
	echo '<a href="/admin/category/'.$category['categoryid'].'/products">';
?>
Товары категории <b class="translate"><span class="hidden word">Category products</span><span class="hidden translate-phrase">Товары категории</span>(Edit)</b>
<?php 
	echo '</a> | ';
	echo '<a href="javascript: void(0);" onclick="javascript: confirm(\'\', $(\'#delete_category\'), \'/admin/category/'.escape($category['categoryid'], 3).'/delete\'); return false;">';
?>
Удалить категорию <b class="translate"><span class="hidden word">Delete category</span><span class="hidden translate-phrase">Удалить категорию</span>(Edit)</b>
<?php 
	echo '</a><br /><br />';
?>
<h3>Список подкатегорий <b class="translate"><span class="hidden word">List of subcategories</span><span class="hidden translate-phrase">Список подкатегорий</span>(Edit)</b></h3><br />
<?php 
}
?>
<form action="<?php echo $current_location;?>/admin/categories/<?php  echo $category['categoryid']; ?>" method="post" name="categories_form">
<input type="hidden" name="mode" value="" />

<table cellpadding="2" cellspacing="1" class="categories lines-table">

<tr>
  <th>Включено <b class="translate"><span class="hidden word">Enabled</span><span class="hidden translate-phrase">Включено</span>(Edit)</b></th>
  <th>Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
  <th colspan="2">Название категории <b class="translate"><span class="hidden word">Category name</span><span class="hidden translate-phrase">Название категории</span>(Edit)</b></th>
  <th align="center">Продукты <b class="translate"><span class="hidden word">Products</span><span class="hidden translate-phrase">Продукты</span>(Edit)</b></th>
  <th align="center">Подкатегории <b class="translate"><span class="hidden word">Subcategories</span><span class="hidden translate-phrase">Подкатегории</span>(Edit)</b></th>
</tr>

<?php 

if (empty($categories)) {
?>
<tr>
 <td colspan="6" align="center" class="submit-row"><br />Нет категорий <b class="translate"><span class="hidden word">No categories</span><span class="hidden translate-phrase">Нет категорий</span>(Edit)</b><br /><br /></td>
</tr>
<?php 
} else  {
	foreach ($categories as $v) {
		echo '<tr>
  <td width="1%"><input type="checkbox" size="3" name="posted_data['.$v['categoryid'].'][enabled]" maxlength="3" value="1"'.($v['enabled'] ? ' checked="checked"' : '').'" /></td>
  <td width="1%"><input type="text" size="3" name="posted_data['.$v['categoryid'].'][orderby]" maxlength="3" value="'.$v['orderby'].'" /></td>
  <td width="1%"><input type="radio" name="cat" value="'.$v['categoryid'].'" /></td>
  <td><a href="/admin/categories/'.$v['categoryid'].'">'.$v['title'].'</a> (<a href="/admin/category/'.$v['categoryid'].'">';
	?>
	Редактировать <b class="translate"><span class="hidden word">Edit</span><span class="hidden translate-phrase">Редактировать</span>(Edit)</b>
	<?php 
		echo '</a>)</td>
  <td align="center"><a href="/admin/category/'.$v['categoryid'].'/products">'.$v['products'].'</a> ('.$v['products_global'].')</td>
  <td align="center"><a href="/admin/categories/'.$v['categoryid'].'">'.$v['subcategories'].'</a></td>
		</tr>';
	}
?>
</table>
<br />
<button type="button" onclick="javascript: submitForm(this, '');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
<br /><br />
<button type="button" onclick="javascript: self.location='/admin/category/'+document.categories_form.cat.value;">Изменить выбранную категорию <b class="translate"><span class="hidden word">Modify selected</span><span class="hidden translate-phrase">Изменить выбранную категорию</span>(Edit)</b></button>
<button type="button" onclick="javascript: submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
<?php 
}
?>
<button type="button" onclick="self.location='/admin/category?parentid=<?php  echo $category['categoryid']; ?>'">Добавить новую категорию <b class="translate"><span class="hidden word">Add new category</span><span class="hidden translate-phrase">Добавить новую категорию</span>(Edit)</b></button>
</form>

<br /><br />

<a name="featured"></a>

<h3>Рекомендуемые товары <b class="translate"><span class="hidden word">Featured products</span><span class="hidden translate-phrase">Рекомендуемые товары</span>(Edit)</b></h3>

<a href="javascript: void(0);" onclick="javascript: check_all(document.fpform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.fpform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<form action="<?php echo $current_location;?>/admin/categories/<?php  echo $category['categoryid'];?>" method="post" name="fpform">
<input type="hidden" name="mode" value="update" />
<input type="hidden" name="action" value="featured_products" />

<table cellpadding="3" cellspacing="1" width="100%" class="lines-table">

<tr>
  <th width="10">&nbsp;</th>
  <th width="70%">Название товара <b class="translate"><span class="hidden word">Product name</span><span class="hidden translate-phrase">Название товара</span>(Edit)</b></th>
  <th width="15%" align="center">Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
  <th width="15%" align="center">Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></th>
</tr>

<?php 
if ($featured_products) {
	foreach ($featured_products as $v) {
?>

<tr>
  <td><input type="checkbox" name="to_delete[<?php  echo $v['productid']; ?>]" /></td>
  <td><b><a href="<?php echo $current_location;?>/admin/products/<?php  echo $v['productid']; ?>" target="_blank"><?php  echo $v['name']; ?></a></b></td>
  <td align="center"><input type="text" name="posted_data[<?php  echo $v['productid']; ?>][orderby]" size="5" value="<?php  echo $v['orderby']; ?>" /></td>
  <td align="center"><input type="checkbox" name="posted_data[<?php  echo $v['productid']; ?>][enabled]"<?php  if ($v['enabled']) echo ' checked="checked"'; ?> /></td>
</tr>
<?php 
	}
?>
<tr>
  <td colspan="4">
  <button type="button" onclick="javascript: document.fpform.mode.value = 'delete'; document.fpform.submit();">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
  <button type="submit">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
  </td>
</tr>

<?php 
} else  {
?>

<tr>
	<td colspan="4" align="center">В этой категории нет рекомендуемых товаров <b class="translate"><span class="hidden word">No featured products in this category</span><span class="hidden translate-phrase">В этой категории нет рекомендуемых товаров</span>(Edit)</b></td>
</tr>

<?php 
}
?>

<tr>
<td colspan="4"><br /><h3>Добавить товар <b class="translate"><span class="hidden word">Add product</span><span class="hidden translate-phrase">Добавить товар</span>(Edit)</b></td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td>
    <input type="hidden" name="newproductid" />
    <input type="text" size="35" name="newproduct" disabled="disabled" />
<script>
var popup_product_pid = document.fpform.newproductid,
	popup_product_pname = document.fpform.newproduct;
</script>
    <button type="button" onclick="javascript: popup_product();">Загрузить... <b class="translate"><span class="hidden word">Browse...</span><span class="hidden translate-phrase">Загрузить...</span>(Edit)</b></button>
  </td>
  <td align="center"><input type="text" name="neworderby" size="5" /></td>
  <td align="center"><input type="checkbox" name="newenabled" checked="checked" /></td>
</tr>

<tr>
  <td colspan="4" class="SubmitBox">
  <button type="button" onclick="javascript: document.fpform.mode.value = 'add'; document.fpform.submit();">Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></button>
  </td>
</tr>

</table>
</form>