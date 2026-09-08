<h1>Налоговые данные <b class="translate"><span class="hidden word">Tax details</span><span class="hidden translate-phrase">Налоговые данные</span>(Edit)</b></h1>

<form method="post" name="taxdetailsform" onsubmit="javascript: return submitTaxForm();">
<input type="hidden" name="mode" value="details" />
<input type="hidden" name="taxid" value="<?php  echo $tax_details['taxid']; ?>" />

<table cellpadding="3" cellspacing="1" width="600" class="normal-table">

<tr>
  <td width="20%">Имя <b class="translate"><span class="hidden word">Name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b>:</td>
  <td width="10" class="star">*</td>
  <td width="80%"><input type="text" size="15" maxlength="10" name="tax_service_name" value="<?php  echo escape($tax_details['tax_name'], 2); ?>" /></td>
</tr>
<?php /* ?>
<tr>
  <td>Отображаемое название налога <b class="translate"><span class="hidden word">Tax display name</span><span class="hidden translate-phrase">Отображаемое название налога</span>(Edit)</b>:</td>
  <td></td>
  <td><input type="text" size="45" name="tax_display_name" value="<?php  echo escape($tax_details['tax_display_name'], 2); ?>" /></td>
</tr>

<tr>
  <td>ИНН <b class="translate"><span class="hidden word">Tax reg number</span><span class="hidden translate-phrase">ИНН</span>(Edit)</b>:</td>
  <td></td>
  <td><input type="text" size="32" maxlength="32" name="tax_regnumber" value="<?php  echo escape($tax_details['regnumber'], 2); ?>" /></td>
</tr>

<tr>
  <td>Приоритетность налога <b class="translate"><span class="hidden word">Tax priority</span><span class="hidden translate-phrase">Приоритетность налога</span>(Edit)</b>:</td>
  <td></td>
  <td><input type="text" size="10" name="tax_priority" value="<?php  echo escape($tax_details['priority'], 2); ?>" /></td>
</tr>
<?php */ ?>
<tr>
  <td>Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b>:</td>
  <td></td>
  <td>
  <select name="active">
    <option value="Y">Включено <b class="translate"><span class="hidden word">Enabled</span><span class="hidden translate-phrase">Включено</span>(Edit)</b></option>
    <option value="N"<?php  if ($tax_details['active'] == "N") echo ' selected="selected"'; ?>>Отключено <b class="translate"><span class="hidden word">Disabled</span><span class="hidden translate-phrase">Отключено</span>(Edit)</b></option>
  </select>
  </td>
</tr>
<?php /* ?>
<tr>
  <td>Налог применяется к <b class="translate"><span class="hidden word">Tax apply to</span><span class="hidden translate-phrase">Налог применяется к</span>(Edit)</b>:</td>
  <td class="star">*</td>
  <td>
<table cellpadding="0" cellspacing="0" width="100%">

<tr>
  <td><input type="text" size="25" id="tax_formula" name="tax_formula" value="=<?php  echo escape($tax_details['formula'], 2); ?>" readonly="readonly" /></td>
  <td nowrap>
<button type="button" onclick="javacript: undoFormula('tax_formula');" />Отменить <b class="translate"><span class="hidden word">Undo</span><span class="hidden translate-phrase">Отменить</span>(Edit)</b></button>
<button  type="button" onclick="javacript: undoFormula('tax_formula', 1);" />Повторить <b class="translate"><span class="hidden word">Redo</span><span class="hidden translate-phrase">Повторить</span>(Edit)</b></button>
<button  type="button" onclick="javacript: addElm('tax_formula', '=', '=');" />Очистить <b class="translate"><span class="hidden word">Clear</span><span class="hidden translate-phrase">Очистить</span>(Edit)</b></button>
  </td>
</tr>

<tr>
  <td class="tax-padding">
<input type="button" value=" + " onclick="javascript: addElm('tax_formula', '+', 1);" /></button>
<input type="button" value=" - " onclick="javascript: addElm('tax_formula', '-', 1);" /></button>
<input type="button" value=" * " onclick="javascript: addElm('tax_formula', '*', 1);" /></button>
<input type="button" value=" / " onclick="javascript: addElm('tax_formula', '/', 1);" /></button>
  </td>
  <td class="tax-padding" nowrap>
  <select id="unit_tax_formula">
  <option value="">&nbsp;</option>
<?php 
foreach ($taxes_units as $key=>$item)
	echo '<option value="'.$key.'">'.$key.($key != $item ? ' ('.$item.')' : '').'</option>';
?>
  </select>&nbsp;
  <input type="button" value="Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b>" onclick="javascript: if(document.getElementById('unit_tax_formula').value != '') addElm('tax_formula', document.getElementById('unit_tax_formula').value, 2);" /></button>
  </td>
</tr>
<?php */ ?>
<?php /* ?>
<tr>
  <td>
  <input type="text" id="value_tax_formula" />
  <input type="button" size="8" value="Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b>" onclick="javascript: document.getElementById('value_tax_formula').value = (isNaN(parseFloat(document.getElementById('value_tax_formula').value)) ? '' : Math.abs(parseFloat(document.getElementById('value_tax_formula').value))); if (document.getElementById('value_tax_formula').value != '') addElm('tax_formula', document.getElementById('value_tax_formula').value, 2);" /></button>
  </td>
</tr>
<?php */ ?>
<?php /* ?>
</table>
  </td>
</tr>
<?php */ ?>
<?php /* ?>
<tr>
  <td nowrap="nowrap">Ставка налога зависит от <b class="translate"><span class="hidden word">Tax rates depended on</span><span class="hidden translate-phrase">Ставка налога зависит от</span>(Edit)</b>:</td>
  <td></td>
  <td>
  <select name="address_type">
    <option value="S"<?php  echo ($tax_details['address_type'] == "S" ? ' selected="selected"' : ''); ?>>Адрес доставки <b class="translate"><span class="hidden word">Shipping address</span><span class="hidden translate-phrase">Адрес доставки</span>(Edit)</b></option>
    <option value="B"<?php  echo ($tax_details['address_type'] == "B" ? ' selected="selected"' : ''); ?>>Адрес выставления счета <b class="translate"><span class="hidden word">Billing address</span><span class="hidden translate-phrase">Адрес выставления счета</span>(Edit)</b></option>
  </select>
  </td>
</tr>
<?php */ ?>
<?php /* ?>
<tr>
  <td colspan="2"></td>
  <td><label><input type="checkbox" name="price_includes_tax" value="Y"<?php  echo ($tax_details['price_includes_tax'] == "Y" ? ' checked="checked"' : ''); ?> /> Включено в цену товара <b class="translate"><span class="hidden word">Included in product price</span><span class="hidden translate-phrase">Включено в цену товара</span>(Edit)</b></label></td>
</tr>

<tr>
  <td colspan="2"></td>
  <td><label><input type="checkbox" name="display_including_tax" value="Y" onclick="javascript: document.taxdetailsform.display_info.disabled = !document.taxdetailsform.display_including_tax.checked;"<?php  echo ($tax_details['display_including_tax'] == "Y" ? ' checked="checked"' : ''); ?> /> Отображать с учетом налога <b class="translate"><span class="hidden word">Display including tax</span><span class="hidden translate-phrase">Отображать с учетом налога</span>(Edit)</b></label></td>
</tr>

<tr>
  <td colspan="2"></td>
  <td>Отображать также <b class="translate"><span class="hidden word">Display also</span><span class="hidden translate-phrase">Отображать также</span>(Edit)</b>:<br />
<label><input type="radio" value=""<?php  echo $tax_details['display_info'] == '' ? ' checked="checked"' : ''; ?> name="display_info"<?php  echo $tax_details['display_including_tax'] != "Y" ? ' disabled="disabled"': ''; ?>> Не отображать налог <b class="translate"><span class="hidden word">Display tax none</span><span class="hidden translate-phrase">Не отображать налог</span>(Edit)</b></label>
<label><input type="radio" value="1"<?php  echo $tax_details['display_info'] == '1' ? ' checked="checked"' : ''; ?> name="display_info"<?php  echo $tax_details['display_including_tax'] != "Y" ? ' disabled="disabled"': ''; ?>> Отображать ставку налога <b class="translate"><span class="hidden word">Display tax rate</span><span class="hidden translate-phrase">Отображать ставку налога</span>(Edit)</b></label>
<label><input type="radio" value="2"<?php  echo $tax_details['display_info'] == '2' ? ' checked="checked"' : ''; ?> name="display_info"<?php  echo $tax_details['display_including_tax'] != "Y" ? ' disabled="disabled"': ''; ?>> Отображать стоимость налога <b class="translate"><span class="hidden word">Display tax cost</span><span class="hidden translate-phrase">Отображать стоимость налога</span>(Edit)</b></label>
<label><input type="radio" value="3"<?php  echo $tax_details['display_info'] == '3' ? ' checked="checked"' : ''; ?> name="display_info"<?php  echo $tax_details['display_including_tax'] != "Y" ? ' disabled="disabled"': ''; ?>> Отображение ставку и стоимость налога <b class="translate"><span class="hidden word">Display tax rate and cost</span><span class="hidden translate-phrase">Отображение ставку и стоимость налога</span>(Edit)</b></label>
  </td>
</tr>
<?php */ ?>
<tr>
  <td colspan="2"></td>
  <td><br /></td>
</tr>

</table>
<button class="button-margin-left" type="submit">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
</form>

<?php 
if ($tax_details['taxid'] && $tax_details['taxid'] != 'add') {
?>
<br />
<h3>Налоговые ставки <b class="translate"><span class="hidden word">Tax rates</span><span class="hidden translate-phrase">Налоговые ставки</span>(Edit)</b></h3>
<a name="rates"></a>

<a href="javascript: void(0);" onclick="javascript: check_all(document.taxratesform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.taxratesform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>

<form method="post" name="taxratesform">
<input type="hidden" name="mode" value="update_rates" />
<input type="hidden" name="taxid" value="<?php  echo $tax_details['taxid']; ?>" />

<table cellpadding="3" cellspacing="1" width="100%" class="lines-table">

<tr>
  <th width="10">&nbsp;</th>
  <th width="30%">Зона <b class="translate"><span class="hidden word">Zone</span><span class="hidden translate-phrase">Зона</span>(Edit)</b></th>
  <th width="20%" align="center">Подписка <b class="translate"><span class="hidden word">Membership</span><span class="hidden translate-phrase">Подписка</span>(Edit)</b></th>
  <th width="30%" align="center">Значение налоговой ставки <b class="translate"><span class="hidden word">Tax rate value</span><span class="hidden translate-phrase">Значение налоговой ставки</span>(Edit)</b></th>
  <th width="20%" align="center">Налог применяется к <b class="translate"><span class="hidden word">Tax apply to</span><span class="hidden translate-phrase">Налог применяется к</span>(Edit)</b></th>
</tr>

<?php 
if ($tax_rates) {
	foreach ($tax_rates as $t) {
		echo '<tr>
  <td><input type="checkbox" name="to_delete['.$t['rateid'].']" /></td>
  <td>';
?>
<?php if ($t['zoneid'] == 0) {?>Зона по умолчанию <b class="translate"><span class="hidden word">Default zone</span><span class="hidden translate-phrase">Зона по умолчанию</span>(Edit)</b><?php } else  { ?><a href='<?php echo $current_location;?>/admin/zones/<?php echo $t['zoneid'];?>'><?php echo $t['zone_name'];?></a><?php } ?>
<?php 
  echo '</td><td align="center">
<a href="/admin/taxes/'.$tax_details['taxid'].'?rateid='.$t['rateid'].'#rates">
		';
?>
<?php if (($t['membershipids'])) {?>
<?php foreach ($t['membershipids'] as $m) {?>
<?php echo $m;?><br />
<?php } ?>
<?php } else  { ?>
Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b>
<?php } ?>
<?php 
		echo '</a>
</td>
  <td align="center" nowrap="nowrap">
<input type="text" size="10" maxlength="13" name="posted_data['.$t['rateid'].'][rate_value]" value="'.$t['rate_value'].'" />
<select name="posted_data['.$t['rateid'].'][rate_type]">
  <option value="%"'.($t['rate_type'] == "%" ? ' selected="selected"' : '').'>%</option>
  <option value="$"'.($t['rate_type'] == "$" ? ' selected="selected"' : '').'>'.$config['General']['currency_symbol'].'</option>
</select>
  </td>
  <td align="center"><a href="/admin/taxes/'.$tax_details['taxid'].'?rateid='.$t['rateid'].'#rates">'.($t['formula'] == "" ? $tax_details['formula'] : $t['formula']).($t['shipping'] ? '+Shipping' : '').'</a></td>
</tr>
		';
	}
?>

<?php 
} else  {
?>

<tr>
  <td colspan="5" align="center">Налоговые ставки не указаны <b class="translate"><span class="hidden word">No tax rates defined</span><span class="hidden translate-phrase">Налоговые ставки не указаны</span>(Edit)</b></td>
</tr>

<?php 
}
?>
</table>
<?php if ($tax_rates) {?>
<br />
  <button type="button" onclick="javascript: submitForm(this, 'delete_rates');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
  <button type="submit">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
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
  <td width="15%" class="display-none">Значение налоговой ставки <b class="translate"><span class="hidden word">Tax rate value</span><span class="hidden translate-phrase">Значение налоговой ставки</span>(Edit)</b>:</td>
  <td class="star">*</td>
  <td width="85%">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input custom-element" type="text" size="20" maxlength="13" name="rate_value" value="<?php  echo $rate_details['rate_value']; ?>" id="sample3">
    <label class="mdl-textfield__label" for="sample3">Значение налоговой ставки <b class="translate"><span class="hidden word">Tax rate value</span><span class="hidden translate-phrase">Значение налоговой ставки</span>(Edit)</b></label>
  </div>

  <select name="rate_type" onchange="javascript: $('#box2').toggle();" class="custom-element">
    <option value="%">%</option>
    <option value="$"<?php  if ($rate_details['rate_type'] == '$') echo ' selected="selected"'; ?>><?php  echo $config['General']['currency_symbol']; ?></option>
  </select>
  <br /><div id="box2"<?php  if ($rate_details['rate_type'] != '$') echo ' class="display-none"'; ?>>An absolute tax value is added to each item in the cart, not to the cart subtotal</div>
  </td>
</tr>

<tr>
  <td>Зона <b class="translate"><span class="hidden word">Zone</span><span class="hidden translate-phrase">Зона</span>(Edit)</b>:</td>
  <td></td>
  <td>
  <select name="zoneid">
    <option value="0">Зона по умолчанию <b class="translate"><span class="hidden word">Default zone</span><span class="hidden translate-phrase">Зона по умолчанию</span>(Edit)</b></option>
<?php 
foreach ($zones as $z)
	echo '<option value="'.$z['zoneid'].'"'.($rate_details['zoneid'] == $z['zoneid'] ? ' selected="selected"' : '').'>'.$z['zone_name'].'</option>';
?>
  </select>
  </td>
</tr>

<tr>
  <td>Подписка <b class="translate"><span class="hidden word">Membership</span><span class="hidden translate-phrase">Подписка</span>(Edit)</b>:</td>
  <td></td>
 <td><select name="membershipids[]" multiple="multiple" size="5">
  <option value="-1">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
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
  <td>Применить налог к <b class="translate"><span class="hidden word">Apply tax to</span><span class="hidden translate-phrase">Применить налог к</span>(Edit)</b>:</td>
  <td class="star">&nbsp;</td>
  <td>
  <select name="formula">
	<option value="DST"<?php if ($rate_details['formula'] == "DST") {?> selected<?php } ?>>Discounted subtotal</option>
	<option value="ST"<?php if ($rate_details['formula'] == "ST") {?> selected<?php } ?>>Subtotal</option>
  </select>
<br /><br />
<label>
<input type="checkbox" class="custom-element" name="shipping" value="1"<?php if ($rate_details['shipping']) {?> checked<?php } ?>> Применить к доставке <b class="translate"><span class="hidden word">Apply to shipping</span><span class="hidden translate-phrase">Применить к доставке</span>(Edit)</b>
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

<button class="button-margin-left" type="submit"><?php  if ($rate_details['rateid']) {?>Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b><?php  } else  { ?>Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b><?php  } ?></button>
<?php 
if ($rate_details['rateid']) {
?>
<button type="button" onclick="javascript: self.location='/admin/taxes/<?php  echo $rate_details['taxid']; ?>';">Отменить <b class="translate"><span class="hidden word">Cancel</span><span class="hidden translate-phrase">Отменить</span>(Edit)</b></button>
<?php 
}
?>
</form>



<?php 
}
?>