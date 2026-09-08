<form name="pform" action="<?php echo $current_location;?>/admin/pages/<?php  echo $get['2']; ?>" method="post"<?php /* ?><?php if (!$pages && !$page['id']) {?> class="noajax"<?php } ?><?php */ ?>>
<input type="hidden" name="mode" value="" />
<?php 
if (empty($get['2'])) {
?>

<table cellpadding="3" width="600" cellspacing="1" class="lines-table">

<tr>
	<th width="10">&nbsp;</th>
	<th width="100%">Страница <b class="translate"><span class="hidden word">Page</span><span class="hidden translate-phrase">Страница</span>(Edit)</b></th>
	<th width="100">Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
</tr>

<?php 
if ($pages) {
	foreach ($pages as $p) {
?>
<tr>
	<td><input type="checkbox" name="to_delete[<?php  echo $p['pageid'];?>]" /></td>
	<td><a href="<?php  echo $current_location.'/admin/pages/'.$p['pageid']; ?>"><?php  echo $p['title']; ?></a></td>
	<td><input size="5" type="text" name="to_update[<?php  echo $p['pageid'];?>][orderby]" value="<?php  echo $p['orderby'];?>"></td>
</tr>
<?php 
	}
?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'update');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
<button type="button" onclick="javascript: submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
<?php 
} else  {
?>
Нет страниц <b class="translate"><span class="hidden word">No pages</span><span class="hidden translate-phrase">Нет страниц</span>(Edit)</b>
<?php 
}
?>
<br /><br />
<a href="<?php  echo $current_location.'/admin/pages/new'; ?>">Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></a>
<?php 
} else  {
?>
<script src="/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.config.protectedSource.push( /<\?[\s\S]*?\?>/g );   // PHP Code
</script>
<table cellpadding="3" cellspacing="1" class="category normal-table">
<tr>
	<td height="10" nowrap="nowrap">Название страницы <b class="translate"><span class="hidden word">Page title</span><span class="hidden translate-phrase">Название страницы</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<input type="text" name="title" maxlength="255" size="80" value="<?php  echo escape($page['title'], 2); ?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" />
	</td>
</tr>

<tr>
	<td height="10" nowrap="nowrap">Чистый URL <b class="translate"><span class="hidden word">Clean URL</span><span class="hidden translate-phrase">Чистый URL</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<input type="text" name="cleanurl" maxlength="255" size="80" value="<?php  echo escape($page['cleanurl'], 2); ?>" />
	</td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
	<td width="10" height="10">&nbsp;</td>
 <td><div class="select-title">Содержание страницы <b class="translate"><span class="hidden word">Page content</span><span class="hidden translate-phrase">Содержание страницы</span>(Edit)</b></div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( e ) {
			editor = e.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="content"><?php  echo $page['content']; ?></textarea>
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Тег заголовка <b class="translate"><span class="hidden word">Title tag</span><span class="hidden translate-phrase">Тег заголовка</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<input type="text" size="65" name="meta_title" value="<?php  echo escape($page['meta_title'], 2); ?>" />
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Мета-тег keywords <b class="translate"><span class="hidden word">Meta keywords</span><span class="hidden translate-phrase">Мета-тег keywords</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<textarea cols="65" rows="4" name="meta_keywords"><?php  echo $page['meta_keywords']; ?></textarea>
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Мета-описание <b class="translate"><span class="hidden word">Meta description</span><span class="hidden translate-phrase">Мета-описание</span>(Edit)</b></td>
	<td width="10" height="10"></td>
	<td height="10">
		<textarea cols="65" rows="4" name="meta_description"><?php  echo $page['meta_description']; ?></textarea>
	</td>
</tr>

</table>

<div class="fixed_save_button">
<button class="button-margin-left" type="submit">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
</div>

<?php 
}
?>
</form>