<form method="POST" name="vform" enctype='multipart/form-data' class="noajax">
<input type="hidden" name="section" value="variant_images">
<input type="hidden" name="mode" value="update">

<?php 
if ($has_images == 'Y') {?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.vform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.vform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<table>
<?php 
	foreach ($variants as $v) {
		if ($v['images']) {?>
<tr>
 <td valign="top">
<table>
<?php 
			foreach ($v['options'] as $o) {
?>
 <tr>
  <td nowrap><b><?php  echo $o['group_name']; ?>:</b></td>
  <td nowrap><?php  echo $o['name']; ?></td>
 </tr>
<?php 
			}
?>
</table>
 </td>
 <td> &nbsp;</td>
 <td class="variant_images">
<?php 
			foreach ($v['images'] as $img) {?>
<div>
<a href="<?php  echo $current_location . '/photos/variant/' . $img['variantid'] . '/' . $img['imageid'] . '/' . $img['file']; ?>" target="_blank"><img src="<?php  echo $current_location . '/photos/variant/' . $img['variantid'] . '/' . $img['imageid'] . '/' . $img['file']; ?>" height="70" alt="" /></a>
<input type="checkbox" name="to_delete[<?php  echo $img['imageid']; ?>]" />
<br />
Alt <b class="translate"><span class="hidden word">Alt</span><span class="hidden translate-phrase">Alt</span>(Edit)</b>:<br />
<input type="text" name="posted_data[<?php  echo $img['imageid']; ?>][alt]" value="<?php  echo escape($img['alt']); ?>" /><br />
Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b>:<br />
<input type="text" size="5" name="posted_data[<?php  echo $img['imageid']; ?>][pos]" value="<?php  echo $img['pos']; ?>" />
</div>
<?php 
			}
?>
 </td>
</tr>
<tr>
 <td colspan="3">&nbsp;</td>
</tr>
<?php 
		}
	}
?>
<tr>
 <td colspan="3"><button>Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button> <button type="button" onclick="submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button><br /><br /></td>
</tr>
</table>
<?php 
}
?>

<div class="addnew">
<h3>Добавить картинку <b class="translate"><span class="hidden word">Add image</span><span class="hidden translate-phrase">Добавить картинку</span>(Edit)</b></h3>
<table>
<?php 
foreach ($option_groups as $v) {
?>

<tr>
 <td width="150" valign="top"><?php  echo $v['name']; ?></td>
 <td valign="top">
 <select name="new_group[<?php  echo $v['groupid']; ?>][]" multiple size="10">
<?php 
if ($v['options']) {	foreach ($v['options'] as $o) {
?>
 <option value="<?php  echo $o['optionid']; ?>"><?php  echo $o['name']; ?></option>
<?php 
	}
}
?>
 </select>
 </td>
</tr>
<?php 
}
?>
<tr>
 <td colspan="2">
<br />
<input type="file" name="userfile[0]" /><br />
<input type="file" name="userfile[1]" /><br />
<input type="file" name="userfile[2]" /><br />
<input type="file" name="userfile[3]" /><br />
<input type="file" name="userfile[4]" /><br /><br />
<button type="button" onclick="javascript: submitForm(this, 'upload');">Загрузить изображения <b class="translate"><span class="hidden word">Upload images</span><span class="hidden translate-phrase">Загрузить изображения</span>(Edit)</b></button>
 </td>
</tr>
</table>
</div>
</form>