<?php  if (empty($_GET['parentid'])) { ?>
<ul class="admin-tabs">
<li<?php  if (empty($get['2'])) echo ' class="active"'; ?>><a href="/admin/homepage">Details</a></li>
<li<?php  if ($get['2'] == 'banners') echo ' class="active"'; ?>><a href="/admin/homepage/banners">Banners</a></li>
</li>
<div class="clear"></div>
<br />
<?php  } ?>

<form name="category_form" action="/admin/homepage/<?php  echo $get['2']; ?>" method="post" enctype="multipart/form-data"<?php /* ?> class="noajax"<?php */ ?>>
<input type="hidden" name="mode" value="" />
<?php 
if ($get['2'] == 'banners') {
?>

<table cellpadding="3" cellspacing="1">

<tr>
	<th width="10">&nbsp;</th>
	<th>Banner</th>
	<th>Link</th>
	<th>Alt</th>
	<th width="100">Pos</th>
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
	<button type="button" onclick="javascript: submitForm(this, 'update');">Update</button>
	<button type="button" onclick="javascript: submitForm(this, 'delete');">Delete selected</button>
	</td>
</tr>

<?php 
} else  {
?>
<tr>
 <td colspan="5" align="center">No banners for  homepage</td>
</tr>
<?php 
}
?>

<tr>
<td colspan="5"><br /><h3>Add new</td>
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
<button type="button" onclick="javascript: submitForm(this, 'add');">Add</button>
	</td>
</tr>

</table>

<?php 
} else  {
?>
<script src="/ckeditor/ckeditor.js"></script>
<table cellpadding="3" cellspacing="1" class="category normal-table">
<tr>
	<td height="10" nowrap="nowrap">Title</td>
	<td width="10" height="10"></td>
	<td height="10">
		<input type="text" name="site_title" maxlength="255" size="80" value="<?php  echo escape(lng('Site title'), 2); ?>" />
	</td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
	<td width="10" height="10">&nbsp;</td>
 <td><div class="select-title">Description</div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( e ) {
			editor = e.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="site_description"><?php  echo lng('Site description'); ?></textarea>
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Title tag</td>
	<td width="10" height="10"></td>
	<td height="10">
		<input type="text" size="65" name="meta_title" value="<?php  echo escape(lng('Homepage meta title'), 2); ?>" />
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Meta keywords</td>
	<td width="10" height="10"></td>
	<td height="10">
		<textarea cols="65" rows="4" name="meta_keywords"><?php  echo lng('Homepage meta keywords'); ?></textarea>
	</td>
</tr>

<tr>
	<td height="10" class="FormButton" nowrap="nowrap">Meta description</td>
	<td width="10" height="10"></td>
	<td height="10">
		<textarea cols="65" rows="4" name="meta_description"><?php  echo lng('Homepage meta description'); ?></textarea>
	</td>
</tr>

</table>
<br /><br /><br /><br />
<div class="fixed_save_button">
<button class="button-margin-left" type="submit">Save</button>
</div>

<?php 
}
?>
</form>