<form method="post" name="currenciesform">
<input type="hidden" name="mode" value="update" />
<?php if ($currencies) {?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.currenciesform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.currenciesform, 'to_delete', false);">Uncheck all</a>
<?php } ?>
<table cellpadding="3" cellspacing="1" width="600">
<tr>
	<th width="10">&nbsp;</th>
	<th width="15%">Currency code</th>
	<th width="10%">Rate</th>
	<th width="15%">Symbol</th>
	<th width="20%">Active</th>
	<th width="20%">Pos</th>
	<th width="20%">Main</th>
</tr>
<?php if ($currencies) {?>
<?php 
foreach ($currencies as $b) {
	echo '<tr>
	<td><input type="checkbox" name="to_delete['.$b['id'].']" value="Y" /></td>
	<td align="center"><input type="text" size="20" name="to_update['.$b['id'].'][code]" value="'.$b['code'].'" /></td>
	<td align="center"><input type="text" size="20" name="to_update['.$b['id'].'][rate]" value="'.$b['rate'].'" /></td>
	<td align="center"><input type="text" size="20" name="to_update['.$b['id'].'][symbol]" value="'.$b['symbol'].'" /></td>
	<td align="center"><input type="checkbox" name="to_update['.$b['id'].'][active]" value="1"'.($b['active'] ? ' checked="checked"' : '').' /></td>
	<td align="center"><input type="text" size="5" name="to_update['.$b['id'].'][orderby]" value="'.$b['orderby'].'" /></td>
	<td align="center"><input type="radio" name="main_currency" value="'.$b['id'].'"'.($b['main'] ? ' checked="checked"' : '').' /></td>
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
	<td align="center"><input type="text" size="20" name="new_currency[code]" value="" /></td>
	<td align="center"><input type="text" size="20" name="new_currency[rate]" value="" /></td>
	<td align="center"><input type="text" size="20" name="new_currency[symbol]" value="" /></td>
	<td align="center"><input type="checkbox" name="new_currency[active]" value="1" checked="checked" /></td>
	<td align="center"><input type="text" size="5" name="new_currency[orderby]" value="" /></td>
	<td></td>
</tr>

<tr>
	<td colspan="7"><button type="button" onclick="javascript: submitForm(this, 'add');">Add</button></td>
</tr>

</table>
</form>
