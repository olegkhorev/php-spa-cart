<form method="post">
<input type="hidden" name="mode" value="update" />

<table cellpadding="3" cellspacing="1" width="600">

<tr class="TableHead">
	<td width="10">&nbsp;</td>
	<td width="50%">Membership</td>
	<td width="15%" align="center">Active</td>
	<td width="15%" align="center">Pos</td>
	<td width="20%" nowrap="nowrap" align="center">Assigned users</td>
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
	<button>Update</button>
	<button type="button" onclick="submitForm(this, 'delete')">Delete selected</button>
	</td>
</tr>
<?php 
} else  {
?>

<tr>
	<td colspan="5" align="center"><br />No memberships defined</td>
</tr>

<?php 
}
?>

<tr>
	<td colspan="5"><br /><h3>Add new</h3></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type="text" size="30" name="add[membership]" /></td>
	<td align="center"><input type="checkbox" name="add[active]" value="Y" checked="checked" /></td>
	<td align="center"><input type="text" size="5" name="add[orderby]" value="" /></td>
	<td><button type="button" onclick="javascript: submitForm(this, 'add');">Add</button></td>
</tr>

</table>

</form>