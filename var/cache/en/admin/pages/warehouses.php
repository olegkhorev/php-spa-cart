<?php /* ?>
<label><input type="checkbox" id="wenabled"<?php if ($config['warehouse_enabled']) {?> checked<?php } ?>> Enable warehouses</label>
<div class="warehouses-area<?php if (!$config['warehouse_enabled']) {?> hidden<?php } ?>">
<?php */ ?>
<form method="post">
<input type="hidden" name="mode" value="update" />

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php } ?>

<table cellpadding="3" cellspacing="1" width="800">
<tr>
	<th width="10">&nbsp;</th>
	<th width="20%">Warehouse code</th>
	<th width="20%">Title</th>
	<th width="35%" align="center">Warehouse address</th>
	<th width="35%" align="center">Warehouses description</th>
	<th width="5%" nowrap="nowrap" align="center">Pos</th>
	<th width="5%" nowrap="nowrap" align="center">Enabled</th>
</tr>

<?php 
if ($warehouses) {
	foreach ($warehouses as $v) {
?>
<tr>
	<td><input type="checkbox" name="to_delete[<?php echo $v['wid'];?>]" /></td>
	<td><input type="text" size="20" name="posted_data[<?php echo $v['wid'];?>][wcode]" value="<?php echo escape($v['wcode'], 2);; ?>" /></td>
	<td><input type="text" size="20" name="posted_data[<?php echo $v['wid'];?>][title]" value="<?php echo escape($v['title'], 2);; ?>" /></td>
	<td align="center"><input type="text" size="40" name="posted_data[<?php echo $v['wid'];?>][address]" value="<?php echo escape($v['address'], 2);; ?>" /></td>
	<td align="center"><textarea cols="40" rows="10" name="posted_data[<?php echo $v['wid'];?>][descr]"><?php echo $v['descr'];?></textarea></td>
	<td align="center"><input type="text" size="5" name="posted_data[<?php echo $v['wid'];?>][pos]" value="<?php echo $v['pos'];?>" /></td>
	<td align="center"><input type="checkbox" name="posted_data[<?php echo $v['wid'];?>][enabled]" value="1"<?php if ($v['enabled']) {?> checked<?php } ?> /></td>
</tr>
<?php 
	}
?>
<tr>
	<td colspan="7">
	<button>Update</button>
	<button type="button" onclick="submitForm(this, 'delete')">Delete selected</button>
	</td>
</tr>
<?php 
} else  {
?>

<tr>
	<td colspan="7" align="center"><br />No warehouses defined</td>
</tr>

<?php 
}
?>

<tr>
	<td colspan="7"><br /><h3>Add new</h3></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type="text" size="20" name="add_warehouse[wcode]" /></td>
	<td><input type="text" size="20" name="add_warehouse[title]" /></td>
	<td align="center"><input type="text" size="40" name="add_warehouse[address]" /></td>
	<td align="center"><textarea cols="40" rows="10" name="add_warehouse[descr]"></textarea></td>
	<td align="center"><input type="text" size="5" name="add_warehouse[pos]" value="<?php echo $new_pos;?>" /></td>
	<td align="center"><input type="checkbox" name="add_warehouse[enabled]" value="1" checked /></td>
</tr>
<tr>
	<td colspan="6"><br /><button type="button" onclick="javascript: submitForm(this, 'add');">Add</button></td>
</tr>
</table>

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php } ?>

</form>
<?php /* ?></div><?php */ ?>