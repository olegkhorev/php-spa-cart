<?php 
if ($newss) {
?>
<a href="<?php  echo $current_location; ?>/admin/news/new">Add new</a>
<br /><br />
<form method="post" name="newssform">
<input type="hidden" name="mode" value="update" />

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php 
	echo '<br />';
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.newssform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.newssform, 'to_delete', false);">Uncheck all</a>

<table cellpadding="3" cellspacing="1" width="600" class="lines-table">
<tr>
	<th width="10">&nbsp;</th>
	<th width="90%">Title</th>
	<th width="5%">Active</th>
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
<button type="button" onclick="javascript: submitForm(this, 'update');">Update</button> &nbsp;
<button type="button" onclick="javascript: if (confirmed || confirm('This operation will delete selected news.', $(this))) submitForm(this, 'delete');">Delete selected</button>
</div>
</form>
<?php 
} else  {
?>
<script src="<?php  echo $current_location; ?>/ckeditor/ckeditor.js"></script>
<form method="post" name="newsform" enctype="multipart/form-data"<?php /* ?> class="noajax"<?php */ ?>>

<?php if (($get['2'] == 'new')) {?>
<h3>New news</h3>
<?php } else  { ?>
<h3><?php echo $news['title'];?></h3>
<?php } ?>

<table cellpadding="3" cellspacing="1" width="90%" class="normal-table">
<?php if ($news['date']) {?>
<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Added</div>
	<?php  echo date('m/d/Y', $news['date']); ?></td>
</tr>
<?php } ?>
<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Image</div>
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
 <a href="<?php  echo $current_location.'/admin/news/'.$news['newsid'].'/?mode=delete_image'; ?>">Delete image</a><br />
<?php 
}
?>
<input type="file" name="userfile" />
 </td>
</tr>

<tr>
 <td><b>Title</b></td>
 <td><input type="text" name="title" size="40" value="<?php  echo escape($news['title'], 2); ?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" /></td>
</tr>

<tr>
 <td><b>Clean URL</b></td>
 <td><input type="text" name="cleanurl" size="40" value="<?php  echo escape($news['cleanurl'], 2); ?>" /></td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td>
 <div class="select-title">Short description</div>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="descr"><?php  echo $news['descr']; ?></textarea>
 </td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td>
 <div class="select-title">Detailed description</div>
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
 <td valign="top"><b>Meta title</b></td>
 <td><br /><input type="text" size="80" name="meta_title" value="<?php  echo escape($news['meta_title'], 2); ?>" /></td>
</tr>

<tr>
 <td valign="top"><b>Meta keywords</b></td>
 <td><textarea cols="80" rows="5" name="meta_keywords"><?php  echo $news['meta_keywords']; ?></textarea></td>
</tr>

<tr>
 <td valign="top"><b>Meta description</b></td>
 <td><textarea cols="80" rows="5" name="meta_descr"><?php  echo $news['meta_descr']; ?></textarea></td>
</tr>

<tr>
 <td><b>Active</b></td>
 <td><input type="checkbox" name="active" value="Y"<?php  echo ((!$news || $news['active'] == 'Y') ? ' checked="checked"' : ''); ?> /></td>
</tr>

</table>
<div class="fixed_save_button">
<button type="submit"><?php  if ($get['2'] == 'new') { ?>Add<?php  } else  { ?>Save<?php  } ?></button>
</div>
</form>
<?php 
}
?>