<h1>Tax details</h1>

<form method="post" name="taxdetailsform" onsubmit="javascript: return submitTaxForm();">
<input type="hidden" name="mode" value="details" />
<input type="hidden" name="taxid" value="<?php  echo $tax_details['taxid']; ?>" />

<table cellpadding="3" cellspacing="1" width="600" class="normal-table">

<tr>
  <td width="20%">Name:</td>
  <td width="10" class="star">*</td>
  <td width="80%"><input type="text" size="15" maxlength="10" name="tax_service_name" value="<?php  echo escape($tax_details['tax_name'], 2); ?>" /></td>
</tr>

<tr>
  <td>Status:</td>
  <td></td>
  <td>
  <select name="active">
    <option value="Y">Enabled</option>
    <option value="N"<?php  if ($tax_details['active'] == "N") echo ' selected="selected"'; ?>>Disabled</option>
  </select>
  </td>
</tr>

<tr>
  <td colspan="2"></td>
  <td><br /></td>
</tr>

</table>
<button class="button-margin-left" type="submit">Save</button>
</form>

<?php 
if ($tax_details['taxid'] && $tax_details['taxid'] != 'add') {
?>
<br />
<h3>Tax rates</h3>
<a name="rates"></a>

<a href="javascript: void(0);" onclick="javascript: check_all(document.taxratesform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.taxratesform, 'to_delete', false);">Uncheck all</a>

<form method="post" name="taxratesform">
<input type="hidden" name="mode" value="update_rates" />
<input type="hidden" name="taxid" value="<?php  echo $tax_details['taxid']; ?>" />

<table cellpadding="3" cellspacing="1" width="100%" class="lines-table resp-table">
<thead>
<tr>
  <th width="10">&nbsp;</th>
  <th width="30%">Zone</th>
  <th width="20%" align="center">Membership</th>
  <th width="30%" align="center">Tax rate value</th>
  <th width="20%" align="center">Tax apply to</th>
</tr>
</thead>
<?php 
if ($tax_rates) {
	foreach ($tax_rates as $t) {
		echo '<tr>
  <td><input type="checkbox" name="to_delete['.$t['rateid'].']" /></td>
  <td><label>Zone</label>';
?>
<?php if ($t['zoneid'] == 0) {?>Default zone<?php } else  { ?><a href='<?php echo $current_location;?>/admin/zones/<?php echo $t['zoneid'];?>'><?php echo $t['zone_name'];?></a><?php } ?>
<?php 
  echo '</td><td align="center"><label>Membership</label>
<a href="/admin/taxes/'.$tax_details['taxid'].'?rateid='.$t['rateid'].'#rates">
		';
?>
<?php if (($t['membershipids'])) {?>
<?php foreach ($t['membershipids'] as $m) {?>
<?php echo $m;?><br />
<?php } ?>
<?php } else  { ?>
All
<?php } ?>
<?php 
		echo '</a>
</td>
  <td align="center" nowrap="nowrap" class="no-word-break"><label>Tax rate value</label>
<input type="text" size="10" maxlength="13" name="posted_data['.$t['rateid'].'][rate_value]" value="'.$t['rate_value'].'" />
<select name="posted_data['.$t['rateid'].'][rate_type]">
  <option value="%"'.($t['rate_type'] == "%" ? ' selected="selected"' : '').'>%</option>
  <option value="$"'.($t['rate_type'] == "$" ? ' selected="selected"' : '').'>'.$config['General']['currency_symbol'].'</option>
</select>
  </td>
  <td align="center"><label>Tax apply to</label><a href="/admin/taxes/'.$tax_details['taxid'].'?rateid='.$t['rateid'].'#rates">'.($t['formula'] == "" ? $tax_details['formula'] : $t['formula']).($t['shipping'] ? '+Shipping' : '').'</a></td>
</tr>
		';
	}
?>

<?php 
} else  {
?>

<tr>
  <td colspan="5" align="center">No tax rates defined</td>
</tr>

<?php 
}
?>
</table>
<?php if ($tax_rates) {?>
<br />
  <button type="button" onclick="javascript: submitForm(this, 'delete_rates');">Delete selected</button>
  <button type="submit">Update</button>
<?php } ?>
</form>

<br />
<a name="rates"></a>

<form method="post" name="tax_rate_edit" onsubmit="javascript: return submitTaxForm('rate');">
<input type="hidden" name="mode" value="rate_details" />
<input type="hidden" name="taxid" value="<?php  echo $tax_details['taxid']; ?>" />
<input type="hidden" name="rateid" value="<?php  echo $rate_details['rateid'] ? $rate_details['rateid'] : 0; ?>" />
<?php 
if ($rate_details) {
?>
<h3>Edit rate</h3>
<?php 
} else  {
?>
<h3>Add rate</h3>
<?php 
}
?>

<br />

<table cellpadding="3" cellspacing="1" width="600" class="normal-table">

<tr>
  <td width="15%" class="display-none">Tax rate value:</td>
  <td class="star">*</td>
  <td width="85%">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input custom-element" type="text" size="20" maxlength="13" name="rate_value" value="<?php  echo $rate_details['rate_value']; ?>" id="sample3">
    <label class="mdl-textfield__label" for="sample3">Tax rate value</label>
  </div>

  <select name="rate_type" onchange="javascript: $('#box2').toggle();" class="custom-element">
    <option value="%">%</option>
    <option value="$"<?php  if ($rate_details['rate_type'] == '$') echo ' selected="selected"'; ?>><?php  echo $config['General']['currency_symbol']; ?></option>
  </select>
  <br /><div id="box2"<?php  if ($rate_details['rate_type'] != '$') echo ' class="display-none"'; ?>>An absolute tax value is added to each item in the cart, not to the cart subtotal</div>
  </td>
</tr>

<tr>
  <td>Zone:</td>
  <td></td>
  <td>
  <select name="zoneid">
    <option value="0">Default zone</option>
<?php 
foreach ($zones as $z)
	echo '<option value="'.$z['zoneid'].'"'.($rate_details['zoneid'] == $z['zoneid'] ? ' selected="selected"' : '').'>'.$z['zone_name'].'</option>';
?>
  </select>
  </td>
</tr>

<tr>
  <td>Membership:</td>
  <td></td>
 <td><select name="membershipids[]" multiple="multiple" size="5">
  <option value="-1">All</option>
<?php 
		if ($memberships)
			foreach ($memberships as $m) {
				echo '<option value="'.$m['membershipid'].'"'.(!empty($rate_details['membershipids']) && $rate_details['membershipids'][$m['membershipid']] != '' ? ' selected="selected"' : '').'>'.$m['membership'].'</option>';
			}
?>
</select>
  </td>
</tr>

<tr>
  <td>Apply tax to:</td>
  <td class="star">&nbsp;</td>
  <td>
  <select name="formula">
	<option value="DST"<?php if ($rate_details['formula'] == "DST") {?> selected<?php } ?>>Discounted subtotal</option>
	<option value="ST"<?php if ($rate_details['formula'] == "ST") {?> selected<?php } ?>>Subtotal</option>
  </select>
<br /><br />
<label>
<input type="checkbox" class="custom-element" name="shipping" value="1"<?php if ($rate_details['shipping']) {?> checked<?php } ?>> Apply to shipping
</label>
  </td>
</tr>

<tr>
  <td colspan="2"></td>
  <td>
<br />
  </td>
</tr>

</table>

<button class="button-margin-left" type="submit"><?php  if ($rate_details['rateid']) {?>Update<?php  } else  { ?>Add<?php  } ?></button>
<?php 
if ($rate_details['rateid']) {
?>
<button type="button" onclick="javascript: self.location='/admin/taxes/<?php  echo $rate_details['taxid']; ?>';">Cancel</button>
<?php 
}
?>
</form>



<?php 
}
?>