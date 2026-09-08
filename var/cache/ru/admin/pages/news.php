<?php 
if ($newss) {
?>
<a href="<?php  echo $current_location; ?>/admin/news/new">Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></a>
<br /><br />
<form method="post" name="newssform">
<input type="hidden" name="mode" value="update" />

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<?php 
	echo '<br />';
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.newssform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.newssform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>

<table cellpadding="3" cellspacing="1" width="600" class="lines-table">
<tr>
	<th width="10">&nbsp;</th>
	<th width="90%">Заголовок <b class="translate"><span class="hidden word">Title</span><span class="hidden translate-phrase">Заголовок</span>(Edit)</b></th>
	<th width="5%">Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></th>
</tr>

<?php 
foreach ($newss as $b) {
	echo '<tr>
	<td><input type="checkbox" name="to_delete['.$b['newsid'].']" value="Y" /></td>
	<td><a href="'.$current_location.'/admin/news/'.$b['newsid'].'">'.$b['title'].'</a></td>
	<td><input type="checkbox" name="to_update['.$b['newsid'].'][active]" value="Y"'.($b['active'] == 'Y' ? ' checked="checked"' : '').' /></td>
</tr>';
}
?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'update');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button> &nbsp;
<button type="button" onclick="javascript: if (confirmed || confirm('Эта команда удалит выбранные новости. <b class="translate"><span class="hidden word">This operation will delete selected news.</span><span class="hidden translate-phrase">Эта команда удалит выбранные новости.</span>(Edit)</b>', $(this))) submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
</form>
<?php 
} else  {
?>
<script src="<?php  echo $current_location; ?>/ckeditor/ckeditor.js"></script>
<form method="post" name="newsform" enctype="multipart/form-data"<?php /* ?> class="noajax"<?php */ ?>>

<?php if (($get['2'] == 'new')) {?>
<h3>Свежие новости <b class="translate"><span class="hidden word">New news</span><span class="hidden translate-phrase">Свежие новости</span>(Edit)</b></h3>
<?php } else  { ?>
<h3><?php echo $news['title'];?></h3>
<?php } ?>

<table cellpadding="3" cellspacing="1" width="90%" class="normal-table">
<?php if ($news['date']) {?>
<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Добавлено <b class="translate"><span class="hidden word">Added</span><span class="hidden translate-phrase">Добавлено</span>(Edit)</b></div>
	<?php  echo date('m/d/Y', $news['date']); ?></td>
</tr>
<?php } ?>
<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Изображение <b class="translate"><span class="hidden word">Image</span><span class="hidden translate-phrase">Изображение</span>(Edit)</b></div>
<?php 
if ($news['image']) {
	$image = $news['image'];
	$image['new_width'] = 400;
	$image['new_height'] = 100;
	$image['link'] = 'Y';
	$image['blank'] = 'Y';
	include SITE_ROOT . '/includes/news_image.php';
?>
<br />
 <a href="<?php  echo $current_location.'/admin/news/'.$news['newsid'].'/?mode=delete_image'; ?>">Удалить изображение <b class="translate"><span class="hidden word">Delete image</span><span class="hidden translate-phrase">Удалить изображение</span>(Edit)</b></a><br />
<?php 
}
?>
<input type="file" name="userfile" />
 </td>
</tr>

<tr>
 <td><b>Заголовок <b class="translate"><span class="hidden word">Title</span><span class="hidden translate-phrase">Заголовок</span>(Edit)</b></b></td>
 <td><input type="text" name="title" size="40" value="<?php  echo escape($news['title'], 2); ?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" /></td>
</tr>

<tr>
 <td><b>Чистый URL <b class="translate"><span class="hidden word">Clean URL</span><span class="hidden translate-phrase">Чистый URL</span>(Edit)</b></b></td>
 <td><input type="text" name="cleanurl" size="40" value="<?php  echo escape($news['cleanurl'], 2); ?>" /></td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td>
 <div class="select-title">Краткое описание <b class="translate"><span class="hidden word">Short description</span><span class="hidden translate-phrase">Краткое описание</span>(Edit)</b></div>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="descr"><?php  echo $news['descr']; ?></textarea>
 </td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td>
 <div class="select-title">Подробное описание <b class="translate"><span class="hidden word">Detailed description</span><span class="hidden translate-phrase">Подробное описание</span>(Edit)</b></div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor_2" cols="65" rows="7" name="fulldescr"><?php  echo $news['fulldescr']; ?></textarea>
 </td>
</tr>

<tr>
 <td valign="top"><b>Мета-тег title <b class="translate"><span class="hidden word">Meta title</span><span class="hidden translate-phrase">Мета-тег title</span>(Edit)</b></b></td>
 <td><br /><input type="text" size="80" name="meta_title" value="<?php  echo escape($news['meta_title'], 2); ?>" /></td>
</tr>

<tr>
 <td valign="top"><b>Мета-тег keywords <b class="translate"><span class="hidden word">Meta keywords</span><span class="hidden translate-phrase">Мета-тег keywords</span>(Edit)</b></b></td>
 <td><textarea cols="80" rows="5" name="meta_keywords"><?php  echo $news['meta_keywords']; ?></textarea></td>
</tr>

<tr>
 <td valign="top"><b>Мета-описание <b class="translate"><span class="hidden word">Meta description</span><span class="hidden translate-phrase">Мета-описание</span>(Edit)</b></b></td>
 <td><textarea cols="80" rows="5" name="meta_descr"><?php  echo $news['meta_descr']; ?></textarea></td>
</tr>

<tr>
 <td><b>Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></b></td>
 <td><input type="checkbox" name="active" value="Y"<?php  echo ((!$news || $news['active'] == 'Y') ? ' checked="checked"' : ''); ?> /></td>
</tr>

</table>
<div class="fixed_save_button">
<button type="submit"><?php  if ($get['2'] == 'new') { ?>Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b><?php  } else  { ?>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b><?php  } ?></button>
</div>
</form>
<?php 
}
?>