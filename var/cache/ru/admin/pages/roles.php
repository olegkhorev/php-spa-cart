<form method="post">
<input type="hidden" name="mode" value="update" />

<a href="/admin/roles/new" class="ajax_link">Новая роль <b class="translate"><span class="hidden word">New role</span><span class="hidden translate-phrase">Новая роль</span>(Edit)</b></a><br />

<table cellpadding="3" cellspacing="1" width="600" class="lines-table">
<?php 
if ($roles) {
?>
<tr>
	<th width="10">&nbsp;</th>
	<th width="80%">Заголовок <b class="translate"><span class="hidden word">Title</span><span class="hidden translate-phrase">Заголовок</span>(Edit)</b></th>
	<th width="15%" align="center">Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
</tr>

<?php 
	foreach ($roles as $v) {
?>
<tr>
	<td width="10"><input type="checkbox" name="to_delete[]" value="<?php  echo $v['roleid']; ?>" /></td>
	<td><a href="/admin/roles/<?php echo $v['roleid'];?>" class="ajax_link"><?php echo $v['title'];?></a></td>
	<td align="center"><input type="text" size="5" name="posted_data[<?php  echo $v['roleid']; ?>][pos]" value="<?php  echo $v['pos']; ?>" /></td>
</tr>
<?php 
	}
?>
<?php 
} else  {
?>

<tr>
	<td colspan="3" align="center"><br />No Roles defined <b class="translate"><span class="hidden word">No Roles defined</span><span class="hidden translate-phrase">No Roles defined</span>(Edit)</b></td>
</tr>

<?php 
}
?>

</table>

<?php if ($roles) {?>
<div class="fixed_save_button">
	<button>Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
	<button type="button" onclick="submitForm(this, 'delete')">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
<?php } ?>
</form>