<h1>Taxes</h1>

<?php 
if ($taxes) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.taxesform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.taxesform, 'to_delete', false);">Uncheck all</a>
<?php 
}
?>

<form method="post" name="taxesform">
<input type="hidden" name="mode" value="update" />

<table cellpadding="3" cellspacing="1" width="700">

<tr>
  <th>&nbsp;</th>
  <th width="30%">Tax name</th>
  <th width="30%" align="center">Tax apply to</th>
  <th width="20%" align="center">Tax priority</th>
  <th width="20%" align="center">Status</th>
</tr>

<?php 
if ($taxes) {
	foreach ($taxes as $t) {
		echo '<tr>
  <td><input type="checkbox" name="to_delete['.$t['taxid'].']" /></td>
  <td><a href="/admin/taxes/'.$t['taxid'].'">'.$t['tax_name'].'</a>
('.$t['rates_count'].' Tax rates defined)
  </td>
  <td align="center">'.$t['formula'].'</a></td>
  <td align="center"><input type="text" size="5" name="posted_data['.$t['taxid'].'][tax_priority]" value="'.$t['priority'].'" /></td>
  <td align="center">
  <select name="posted_data['.$t['taxid'].'][active]">
    <option value="Y">Enabled</option>
    <option value="N"'.($t['active'] == "N" ? ' selected="selected"' : '').'>Disabled</option>
  </select>
  </td>
</tr>
';
	}
?>

<tr>
  <td colspan="5" class="SubmitBox">
<button type="button" onclick="javascript: submitForm(this, 'delete');">Delete selected</button> &nbsp; <button type="submit">Update</button>
<br />
<button type="button" onclick="javascript: submitForm(this, 'apply');">Apply selected taxes to all products</button>
  </td>
</tr>
<?php 
} else  {
?>

<tr>
  <td colspan="5" align="center">No taxes defined</td>
</tr>

<?php 
}
?>

</table>
</form>

<br /><br />

<button type="button" onclick="javascript: self.location='/admin/taxes/add';">Add new...</button>
