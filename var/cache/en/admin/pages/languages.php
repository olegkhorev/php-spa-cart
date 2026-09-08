<form method="post" name="languagesform">
<input type="hidden" name="mode" value="update" />
<?php if ($translate_mode) {?>
<a href="/admin/language?exit_translate_mode=1" class="mdl-button">Exit "Translate" mode</a>
<?php } else  { ?>
<a href="/admin/language?translate_mode=1" class="mdl-button">Enter "Translate" mode</a>
<?php } ?>
&nbsp; (Make sure you do it in Development mode - see settings.php)
<br /><br />
<?php if ($languages) {?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.languagesform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.languagesform, 'to_delete', false);">Uncheck all</a>
<?php } ?>
<table cellpadding="3" cellspacing="1" width="600">
<tr>
	<th width="10">&nbsp;</th>
	<th width="15%">Code</th>
	<th width="10%">Name</th>
	<th width="20%">Active</th>
	<th width="20%">Pos</th>
	<th width="20%">Main</th>
	<th width="20%">Manage</th>
</tr>
<?php if ($languages) {?>
<?php 
foreach ($languages as $b) {
	echo '<tr>
	<td><input type="checkbox" name="to_delete['.$b['id'].']" value="Y" /></td>
	<td align="center"><input type="text" size="20" name="to_update['.$b['id'].'][code]" value="'.$b['code'].'" /></td>
	<td align="center"><input type="text" size="20" name="to_update['.$b['id'].'][name]" value="'.$b['name'].'" /></td>
	<td align="center"><input type="checkbox" name="to_update['.$b['id'].'][active]" value="1"'.($b['active'] ? ' checked="checked"' : '').' /></td>
	<td align="center"><input type="text" size="5" name="to_update['.$b['id'].'][orderby]" value="'.$b['orderby'].'" /></td>
	<td align="center"><input type="radio" name="main_lang" value="'.$b['id'].'"'.($b['main'] ? ' checked="checked"' : '').' /></td>
	<td align="center"><a href="/admin/language/'.$b['code'].'">Manage</a></td>
</tr>';
}
?>

<tr>
	<td colspan="7">
<button type="button" onclick="javascript: submitForm(this, 'update');">Update</button> &nbsp;
<button type="button" onclick="javascript: submitForm(this, 'delete');">Delete selected</button>
	</td>
</tr>
<?php } ?>

<tr>
	<td colspan="7"><h3>Add new</h3></td>
</tr>
<tr>
	<td></td>
	<td align="center"><input type="text" size="20" name="new_language[code]" value="" /></td>
	<td align="center"><input type="text" size="20" name="new_language[name]" value="" /></td>
	<td align="center"><input type="checkbox" name="new_language[active]" value="1" checked="checked" /></td>
	<td align="center"><input type="text" size="5" name="new_language[orderby]" value="" /></td>
	<td colspan="2"></td>
</tr>

<tr>
	<td colspan="7"><button type="button" onclick="javascript: submitForm(this, 'add');">Add</button></td>
</tr>

</table>
</form>
