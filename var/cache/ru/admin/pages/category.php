<?php  echo $category_location; ?>

<br /><br />

<?php  if (empty($_GET['parentid'])) { ?>
<ul class="admin-tabs">
<li<?php  if (empty($get['3'])) echo ' class="active"'; ?>><a href="/admin/category/<?php  echo $category['categoryid']; ?>">Подробности <b class="translate"><span class="hidden word">Details</span><span class="hidden translate-phrase">Подробности</span>(Edit)</b></a></li>
<?php if ($category['categoryid']) {?>
<li<?php  if ($get['3'] == 'banners') echo ' class="active"'; ?>><a href="/admin/category/<?php  echo $category['categoryid']; ?>/banners">Баннеры <b class="translate"><span class="hidden word">Banners</span><span class="hidden translate-phrase">Баннеры</span>(Edit)</b></a></li>
<?php } ?>
</li>
<div class="clear"></div>
<br />
<?php  } ?>

<form name="category_form" action="/admin/category/<?php  echo $category['categoryid']; ?>/<?php  echo $get['3']; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="mode" value="" />
<?php 
if ($get['3'] == 'banners') {
?>

<table cellpadding="3" cellspacing="1">

<tr>
	<th width="10">&nbsp;</th>
	<th>Баннер <b class="translate"><span class="hidden word">Banner</span><span class="hidden translate-phrase">Баннер</span>(Edit)</b></th>
	<th>Ссылка <b class="translate"><span class="hidden word">Link</span><span class="hidden translate-phrase">Ссылка</span>(Edit)</b></th>
	<th>Alt <b class="translate"><span class="hidden word">Alt</span><span class="hidden translate-phrase">Alt</span>(Edit)</b></th>
	<th width="100">Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
</tr>

<?php 
if ($banners) {
	foreach ($banners as $b) {
?>
<tr>
	<td><input type="checkbox" name="to_delete[<?php  echo $b['bannerid'];?>]" /></td>
	<td align="center"><a href="<?php  echo $b['image_url'];?>" target="_blank"><img src="<?php  echo $b['image_url'];?>" width="100"></a></td>
	<td><input size="30" type="text" name="to_update[<?php  echo $b['bannerid'];?>][url]" value="<?php  echo escape($b['url']);?>" /></td>
	<td><input size="30" type="text" name="to_update[<?php  echo $b['bannerid'];?>][alt]" value="<?php  echo escape($b['alt']);?>" /></td>
	<td><input size="5" type="text" name="to_update[<?php  echo $b['bannerid'];?>][pos]" value="<?php  echo $b['pos'];?>"></td>
</tr>
<?php 
	}
?>
<tr>
	<td colspan="5" class="SubmitBox">
	<br />
	<button type="button" onclick="javascript: submitForm(this, 'update');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
	<button type="button" onclick="javascript: submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
	</td>
</tr>

<?php 
} else  {
?>
<tr>
 <td colspan="5" align="center">Нет баннеров для этой категории <b class="translate"><span class="hidden word">No banners for this category</span><span class="hidden translate-phrase">Нет баннеров для этой категории</span>(Edit)</b></td>
</tr>
<?php 
}
?>

<tr>
<td colspan="5"><br /><h3>Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type="file" size="10" name="userfile" /></td>
	<td><input size="30" type="text" name="new_url"></td>
	<td><input size="30" type="text" name="new_alt"></td>
	<td align="center"><input type="text" size="5" name="new_pos" /></td>
</tr>

<tr>
	<td colspan="5">
<button type="button" onclick="javascript: submitForm(this, 'add');">Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b></button>
	</td>
</tr>

</table>

<?php 
} else  {
?>
<script src="/ckeditor/ckeditor.js"></script>
<?php  if (!empty($_GET['parentid'])) { ?>
<input type="hidden" name="parentid" value="<?php echo $_GET['parentid'];?>" />
<?php  } ?>
<table cellpadding="3" cellspacing="1" class="category normal-table">
<tr>
	<td height="10" nowrap="nowrap">Заголовок <b class="translate"><span class="hidden word">Title</span><span class="hidden translate-phrase">Заголовок</span>(Edit)</b></td>
	<td width="10" height="10" class="star">*</td>
	<td height="10">
		<input type="text" name="title" maxlength="255" size="65" value="<?php  echo escape($category['title']); ?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" />
	</td>
</tr>

<tr>
	<td height="10" nowrap="nowrap">Чистый URL <b class="translate"><span class="hidden word">Clean URL</span><span class="hidden translate-phrase">Чистый URL</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<input type="text" name="cleanurl" maxlength="255" size="65" value="<?php  echo $category['cleanurl']; ?>" />
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Позиция <b class="translate"><span class="hidden word">Position</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></td>
	<td width="10" height="10">&nbsp;</td>
	<td height="10">
		<input type="text" name="orderby" size="5" value="<?php  echo $category['orderby']; ?>" />
	</td>
</tr>

<tr>
	<td height="10" nowrap="nowrap">Включено <b class="translate"><span class="hidden word">Enabled</span><span class="hidden translate-phrase">Включено</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<input type="checkbox" name="enabled" value="1" <?php  if (!$category || $category['enabled'] == 1) echo ' checked="checked"'; ?> />
	</td>
</tr>

<tr class="standard">
 <td valign="top" class="hide-td-for-mdl"></td>
	<td width="10" height="10">&nbsp;</td>
 <td><div class="select-title">Значок категории <b class="translate"><span class="hidden word">Category icon</span><span class="hidden translate-phrase">Значок категории</span>(Edit)</b></div>
	<?php 
	if ($category_icon) {
		if ($category_icon['y'] > 100) echo '<a href="'.$current_location.'/photos/category/'.$category['categoryid'].'/'.$category_icon['iconid'].'/'.$category_icon['file'].'" target="_blank">';
		$image = $category_icon;
		$image['new_width'] = 500;
		$image['new_height'] = 100;
		include SITE_ROOT . '/includes/icon.php';
		if ($category_icon['y'] > 100) echo '</a>';
		echo '<br />';
?>
<label><input type="checkbox" name="delete_icon" value="1" /> Удалить значок <b class="translate"><span class="hidden word">Delete icon</span><span class="hidden translate-phrase">Удалить значок</span>(Edit)</b></label><br /><br />
<?php 
	}
	?>
	<input type="file" name="icon" />
	</td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
	<td width="10" height="10">&nbsp;</td>
 <td><div class="select-title">Описание <b class="translate"><span class="hidden word">Description</span><span class="hidden translate-phrase">Описание</span>(Edit)</b></div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="description"><?php  echo $category['description']; ?></textarea>
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Тег заголовка <b class="translate"><span class="hidden word">Title tag</span><span class="hidden translate-phrase">Тег заголовка</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<input type="text" size="65" name="meta_title" value="<?php  echo escape($category['meta_title']); ?>" />
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Мета-тег keywords <b class="translate"><span class="hidden word">Meta keywords</span><span class="hidden translate-phrase">Мета-тег keywords</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<textarea cols="65" rows="4" name="meta_keywords"><?php  echo $category['meta_keywords']; ?></textarea>
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Мета-описание <b class="translate"><span class="hidden word">Meta description</span><span class="hidden translate-phrase">Мета-описание</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<textarea cols="65" rows="4" name="meta_description"><?php  echo $category['meta_description']; ?></textarea>
	</td>
</tr>

</table>
<br /><br /><br /><br />
<div class="fixed_save_button">
<button class="button-margin-left" type="button" onclick="javascript: submit_category();">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
<?php 
if ($category && $new_category != 'Y') {
?>
&nbsp; <b>Расположение категории <b class="translate"><span class="hidden word">Category location</span><span class="hidden translate-phrase">Расположение категории</span>(Edit)</b>:</b>

<?php 
echo $categories_tree;
?>

<button type="button" onclick="javascript: submitForm(this, 'move');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
<?php 
}
?>
</div>
<?php 
}
?>
</form>