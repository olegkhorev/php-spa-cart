<h1>{lng[Taxes]}</h1>

<?php
if ($taxes) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.taxesform, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.taxesform, 'to_delete', false);">{lng[Uncheck all]}</a>
<?php
}
?>

<form method="post" name="taxesform">
<input type="hidden" name="mode" value="update" />

<table class="lines-table">

<tr>
  <th>&nbsp;</th>
  <th style="width:30%">{lng[Tax name]}</th>
  <th style="width:30%;text-align:center">{lng[Tax apply to]}</th>
  <th style="width:20%;text-align:center">{lng[Tax priority]}</th>
  <th style="width:20%;text-align:center">{lng[Status]}</th>
</tr>

<?php
if ($taxes) {
	foreach ($taxes as $t) {
		echo '<tr>
  <td><input type="checkbox" name="to_delete['.$t['taxid'].']" /></td>
  <td><a href="/admin/taxes/'.$t['taxid'].'">'.$t['tax_name'].'</a>
('.$t['rates_count'].' {lng[Tax rates defined]})
  </td>
  <td style="text-align:center">'.$t['formula'].'</td>
  <td style="text-align:center"><input type="text" size="5" name="posted_data['.$t['taxid'].'][tax_priority]" value="'.$t['priority'].'" /></td>
  <td style="text-align:center">
  <select name="posted_data['.$t['taxid'].'][active]">
    <option value="Y">{lng[Enabled]}</option>
    <option value="N"'.($t['active'] == "N" ? ' selected="selected"' : '').'>{lng[Disabled]}</option>
  </select>
  </td>
</tr>
';
	}
?>

<tr>
  <td colspan="5" class="SubmitBox">
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');">{lng[Delete selected]}</button> &nbsp; <button type="submit">{lng[Update]}</button>
<br />
<button type="button" onclick="javascript: submitForm(this, 'apply');">{lng[Apply selected taxes to all products]}</button>
  </td>
</tr>
<?php
} else {
?>

<tr>
  <td style="text-align:center" colspan="5">{lng[No taxes defined]}</td>
</tr>

<?php
}
?>

</table>
</form>

<br /><br />

<button type="button" onclick="javascript: self.location='/admin/taxes/add';">{lng[Add new...]}</button>
