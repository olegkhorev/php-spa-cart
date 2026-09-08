<form method="post">
<input type="hidden" name="mode" value="update" />

<table cellpadding="3" cellspacing="1" width="600">

<tr class="TableHead">
	<td width="10">&nbsp;</td>
	<td width="50%">Подписка <b class="translate"><span class="hidden word">Membership</span><span class="hidden translate-phrase">Подписка</span>(Edit)</b></td>
	<td width="15%" align="center">Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></td>
	<td width="15%" align="center">Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></td>
	<td width="20%" nowrap="nowrap" align="center">Назначенные пользователи <b class="translate"><span class="hidden word">Assigned users</span><span class="hidden translate-phrase">Назначенные пользователи</span>(Edit)</b></td>
</tr>

<?php 
if ($memberships) {
	foreach ($memberships as $v) {
?>
<tr>
	<td><input type="checkbox" name="to_delete[]" value="<?php  echo $v['membershipid']; ?>" /></td>
	<td><input type="text" size="30" name="posted_data[<?php  echo $v['membershipid']; ?>][membership]" value="<?php  echo escape($v['membership']); ?>" /></td>
	<td align="center"><input type="checkbox" name="posted_data[<?php  echo $v['membershipid']; ?>][active]" value="Y"<?php  echo $v['active'] == 'Y' ? ' checked="checked"' : ''; ?> /></td>
	<td align="center"><input type="text" size="5" name="posted_data[<?php  echo $v['membershipid']; ?>][orderby]" value="<?php  echo $v['orderby']; ?>" /></td>
	<td align="center"><?php  echo $v['users'] ? $v['users'] : '0'; ?></td>
</tr>
<?php 
	}
?>
<tr>
	<td colspan="5">
	<button>Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
	<button type="button" onclick="submitForm(this, 'delete')">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
	</td>
</tr>
<?php 
} else  {
?>

<tr>
	<td colspan="5" align="center"><br />Членство не найдено <b class="translate"><span class="hidden word">No memberships defined</span><span class="hidden translate-phrase">Членство не найдено</span>(Edit)</b></td>
</tr>

<?php 
}
?>

<tr>
	<td colspan="5"><br /><h3>Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></h3></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type="text" size="30" name="add[membership]" /></td>
	<td align="center"><input type="checkbox" name="add[active]" value="Y" checked="checked" /></td>
	<td align="center"><input type="text" size="5" name="add[orderby]" value="" /></td>
	<td><button type="button" onclick="javascript: submitForm(this, 'add');">Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b></button></td>
</tr>

</table>

</form>