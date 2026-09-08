<form method="POST" name="prform">
<input type="hidden" name="section" value="related">
<input type="hidden" name="mode" value="update">
<?php 
if ($related_products) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.prform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.prform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<?php 
}
?>
<table width="500" class="lines-table">
<?php 
if ($related_products) {
?>
<tr>
 <th width="10">&nbsp;</th>
 <th width="100%">товар <b class="translate"><span class="hidden word">Product</span><span class="hidden translate-phrase">товар</span>(Edit)</b></th>
 <th>Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
</tr>
<?php 
foreach ($related_products as $v) {
	echo '
<tr>
 <td><input type="checkbox" name="to_delete['.$v['productid'].']"></td>
 <td><a href="'.$current_location.'/admin/products/'.$v['productid'].'" target="_blank">'.$v['name'].'</a></td>
 <td><input size="5" type="text" name="posted_data['.$v['productid'].'][orderby]" value="'.$v['orderby'].'"></td>
</tr>
	';
}
?>
<tr>
 <td colspan="3"><br><button type="submit">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button> <button type="button" onclick="submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button></td>
</tr>
<?php 
}
?>
<tr>
 <td colspan="3"><br /><h3>Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></h3></td>
</tr>
<tr>
 <td colspan="3">
    <input type="hidden" name="newproductid" />
    <input type="text" size="35" name="newproduct" disabled="disabled" />
<script>
var popup_product_pid = document.prform.newproductid,
	popup_product_pname = document.prform.newproduct;
</script>
    <button type="button" onclick="javascript: popup_product();">Загрузить... <b class="translate"><span class="hidden word">Browse...</span><span class="hidden translate-phrase">Загрузить...</span>(Edit)</b></button>
 </td>
</tr>
<tr>
 <td colspan="3"><br><button>Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b></button></td>
</tr>
</table>
</form>