<?php 
if ($type == "D") {
?>
<h1>Стоимость доставки  <b class="translate"><span class="hidden word">Shipping charges</span><span class="hidden translate-phrase">Стоимость доставки </span>(Edit)</b></h1>
<?php 
} else  {
?>
<h1>Надбавки к доставке <b class="translate"><span class="hidden word">Shipping markups</span><span class="hidden translate-phrase">Надбавки к доставке</span>(Edit)</b></h1>
<?php 
}
?>

<form method="get" name="zoneform">

<input type="hidden" name="type" value="<?php echo $type;?>" />

<b>Редактирование тарифов для <b class="translate"><span class="hidden word">Edit rates for</span><span class="hidden translate-phrase">Редактирование тарифов для</span>(Edit)</b></b><br />

<select name="shippingid" onchange="document.zoneform.submit()">
  <option value="">Всех способов <b class="translate"><span class="hidden word">All methods</span><span class="hidden translate-phrase">Всех способов</span>(Edit)</b></option>
<?php foreach ($shipping as $s) {?>
<option value="<?php echo $s['shippingid'];?>"<?php if ($_GET['shippingid'] != "" && $_GET['shippingid'] == $s['shippingid']) {?> selected="selected"<?php } ?>'><?php echo func_trademark($s['shipping']); ?> (<?php if ($s['destination'] == "I") {?>Международная <b class="translate"><span class="hidden word">International</span><span class="hidden translate-phrase">Международная</span>(Edit)</b><?php } else  { ?>Национальная <b class="translate"><span class="hidden word">National</span><span class="hidden translate-phrase">Национальная</span>(Edit)</b><?php } ?>))</option>';
<?php } ?>
</select>

<select name="zoneid" onchange="document.zoneform.submit()">
  <option value="">Всех зон <b class="translate"><span class="hidden word">All zones</span><span class="hidden translate-phrase">Всех зон</span>(Edit)</b></option>
<?php 
foreach ($zones as $z)
	echo '<option value="'.$z['zoneid'].'"'.(($_GET['zoneid'] != "" && $_GET['zoneid'] == $z['zoneid']) ? ' selected="selected"' : '').'>'.$z['zone'].'</option>';
?>
</select>

</form>

<br /><br />

<?php 
if ($shipping_rates_avail > 0) {
?>
<div align="right"><a href="#addrate">Добавить стоимость тарифов доставки <b class="translate"><span class="hidden word">Add shipping rates values</span><span class="hidden translate-phrase">Добавить стоимость тарифов доставки</span>(Edit)</b></a></div>

<br /><br />

<form method="post" name="shippingratesform">
<input type="hidden" name="mode" value="update" />
<input type="hidden" name="zoneid" value="<?php echo $_GET['zoneid'];?>" />
<input type="hidden" name="shippingid" value="<?php  echo $_GET['shippingid']; ?>" />
<input type="hidden" name="type" value="<?php  echo $type; ?>" />

<table cellpadding="0" cellspacing="1" width="1000">

<?php 
foreach ($zones_list as $z) {
	if ($z['shipping_methods']) {
		echo '<tr>
  <td><h3>'.$z['zone']['zone'].'</h3></td>
</tr>';

		if ($z['shipping_methods']) {
			foreach ($z['shipping_methods'] as $shipid=>$shipping_method) {
				echo '<tr><td><hr /></td></tr>
<tr>
  <th>
<table cellpadding="2" cellspacing="0" width="100%">
<tr>
  <th><input type="checkbox" id="sm_'.$z['zone']['zoneid'].'_'.$shipid.'" name="sm_'.$z['zone']['zoneid'].'_'.$shipid.'" onchange="javascript: bc = false; if ($(this).is(\':checked\')) { $(\'.checkboxes_'.$z['zone']['zoneid'].'_'.$shipid.'\')[0].checked = true; }else  $(\'.checkboxes_'.$z['zone']['zoneid'].'_'.$shipid.'\')[0].checked = false; " /></th>
  <th><b><label for="sm_'.$z['zone']['zoneid'].'_'.$shipid.'">'.func_trademark($shipping_method['shipping']).' (';
?>
<?php if ($shipping_method['destination'] == "I") {?>Международная <b class="translate"><span class="hidden word">International</span><span class="hidden translate-phrase">Международная</span>(Edit)</b><?php } else  { ?>Национальная <b class="translate"><span class="hidden word">National</span><span class="hidden translate-phrase">Национальная</span>(Edit)</b><?php } ?>
<?php 
  echo ')</label></b></th>
  <th align="right">
  </th>
</tr>
</table>
  </th>
</tr>

<tr>
  <td><hr /></td>
</tr>

<tr>
  <td>
';
				if ($shipping_method['rates']) {
					echo '<table cellpadding="0" cellspacing="3" width="100%">';

					foreach ($shipping_method['rates'] as $shipping_rate) {
						echo '<tr>
  <td rowspan="2" nowrap="nowrap"> &nbsp; <input type="checkbox" name="posted_data['.$shipping_rate['rateid'].'][to_delete]" class="checkboxes_'.$z['zone']['zoneid'].'_'.$shipid.'" /></td>
  <td>Весовому диапазону <b class="translate"><span class="hidden word">Weight range</span><span class="hidden translate-phrase">Весовому диапазону</span>(Edit)</b>:</td>
  <td nowrap="nowrap">
<input type="text" name="posted_data['.$shipping_rate['rateid'].'][minweight]" size="9" value="'.$shipping_rate['minweight'].'" />
-
<input type="text" name="posted_data['.$shipping_rate['rateid'].'][maxweight]" size="9" value="'.$shipping_rate['maxweight'].'" />
  </td>
  <td>Фиксированной цене <b class="translate"><span class="hidden word">Flat charge</span><span class="hidden translate-phrase">Фиксированной цене</span>(Edit)</b> ('.$config['General']['currency_symbol'].'):</td>
  <td nowrap="nowrap"><input type="text" name="posted_data['.$shipping_rate['rateid'].'][rate]" size="5" value="'.$shipping_rate['rate'].'" /></td>
  <td>Процентному сбору <b class="translate"><span class="hidden word">Percent charge</span><span class="hidden translate-phrase">Процентному сбору</span>(Edit)</b>:</td>
  <td><input type="text" name="posted_data['.$shipping_rate['rateid'].'][rate_p]" size="5" value="'.$shipping_rate['rate_p'].'" /></td>
</tr>

<tr>
  <td>Промежуточному итогу <b class="translate"><span class="hidden word">Subtotal range</span><span class="hidden translate-phrase">Промежуточному итогу</span>(Edit)</b>:</td>
  <td nowrap="nowrap">
<input type="text" name="posted_data['.$shipping_rate['rateid'].'][mintotal]" size="9" value="'.$shipping_rate['mintotal'].'" />
-
<input type="text" name="posted_data['.$shipping_rate['rateid'].'][maxtotal]" size="9" value="'.$shipping_rate['maxtotal'].'" />
  </td>
  <td>Взимание платы за единицу товара <b class="translate"><span class="hidden word">Per item charge</span><span class="hidden translate-phrase">Взимание платы за единицу товара</span>(Edit)</b> ('.$config['General']['currency_symbol'].'):</td>
  <td nowrap="nowrap"><input type="text" name="posted_data['.$shipping_rate['rateid'].'][item_rate]" size="5" value="'.$shipping_rate['item_rate'].'" /></td>
  <td>Per '.$config['General']['weight_symbol'].' charge ('.$config['General']['currency_symbol'].'):</td>
  <td nowrap="nowrap"><input type="text" name="posted_data['.$shipping_rate['rateid'].'][weight_rate]" size="5" value="'.$shipping_rate['weight_rate'].'" /></td>
</tr>
<tr>
  <td colspan="7"><hr /></td>
</tr>
';
					}

					echo '</table>
  </td>
</tr>
';
				}
			}
		}
	} else  {
	}
}
?>
<tr>
  <td>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
</div>
  </td>
</tr>

</table>
</form>

<br /><br /><br />

<a name="addrate"></a>

<?php 
}
?>

<br />
<?php 
if ($type == "D") {
?>
<h3>Добавить стоимость доставки <b class="translate"><span class="hidden word">Add shipping charges</span><span class="hidden translate-phrase">Добавить стоимость доставки</span>(Edit)</b></h3>
<?php 
} else  {
?>
<h3>Добавить надбавки к доставке <b class="translate"><span class="hidden word">Add shipping markups</span><span class="hidden translate-phrase">Добавить надбавки к доставке</span>(Edit)</b></h3>
<?php 
}

if ($shipping != "") {
?>

<form method="post" name="addshippingrate">
<input type="hidden" name="mode" value="add" />
<input type="hidden" name="zoneid" value="<?php  echo $zoneid; ?>" />
<input type="hidden" name="shippingid" value="<?php  echo $shippingid; ?>" />
<input type="hidden" name="type" value="<?php  echo $type; ?>" />

<table cellpadding="0" cellspacing="3">

<tr>
  <td width="150"><b>Способ доставки  <b class="translate"><span class="hidden word">Shipping method</span><span class="hidden translate-phrase">Способ доставки </span>(Edit)</b>:</b></td>
  <td>
  <select name="shippingid_new">
    <option value="">Выберите один <b class="translate"><span class="hidden word">Select one</span><span class="hidden translate-phrase">Выберите один</span>(Edit)</b></option>
<?php foreach ($shipping as $s) {?>
<option value="<?php echo $s['shippingid'];?>"'><?php echo func_trademark($s['shipping']); ?> (<?php if ($s['destination'] == "I") {?>Международная <b class="translate"><span class="hidden word">International</span><span class="hidden translate-phrase">Международная</span>(Edit)</b><?php } else  { ?>Национальная <b class="translate"><span class="hidden word">National</span><span class="hidden translate-phrase">Национальная</span>(Edit)</b><?php } ?>))</option>';
<?php } ?>
  </select>
  </td>
</tr>

<tr>
  <td><b>Зона <b class="translate"><span class="hidden word">Zone</span><span class="hidden translate-phrase">Зона</span>(Edit)</b>:</b></td>
  <td>
  <select name="zoneid_new">
<?php 
	foreach ($zones as $z)
		echo '<option value="'.$z['zoneid'].'"'.($_GET['zoneid'] == $z['zoneid'] ? ' selected="selected"' : '').'>'.$z['zone'].'</option>';
?>
  </select>
  </td>
</tr>

<?php /* ?>
<tr>
  <td><b>Применить тариф к <b class="translate"><span class="hidden word">Apply rate to</span><span class="hidden translate-phrase">Применить тариф к</span>(Edit)</b>:</b></td>
  <td>
  <select name="apply_to_new">
    <option value="DST" selected="selected">DST (Итого со скидкой <b class="translate"><span class="hidden word">Discounted subtotal</span><span class="hidden translate-phrase">Итого со скидкой</span>(Edit)</b>)</option>
    <option value="ST">ST (Итого <b class="translate"><span class="hidden word">Subtotal</span><span class="hidden translate-phrase">Итого</span>(Edit)</b>)</option>
  </select>
  </td>
</tr>
<?php */ ?>

</table>

<table cellpadding="0" cellspacing="3" width="1000">

<tr>
  <td><b>Весовому диапазону <b class="translate"><span class="hidden word">Weight range</span><span class="hidden translate-phrase">Весовому диапазону</span>(Edit)</b>:</b></td>
  <td nowrap="nowrap">
<input type="text" name="minweight_new" size="9" value="0.00" />
-
<input type="text" name="maxweight_new" size="9" value="<?php  echo price_format($maxvalue); ?>" />
  </td>
  <td><b>Фиксированной цене <b class="translate"><span class="hidden word">Flat charge</span><span class="hidden translate-phrase">Фиксированной цене</span>(Edit)</b> (<?php  echo $config['General']['currency_symbol']; ?>):</b></td>
  <td nowrap="nowrap"><input type="text" name="rate_new" size="5" value="0.00" /></td>
  <td><b>Процентному сбору <b class="translate"><span class="hidden word">Percent charge</span><span class="hidden translate-phrase">Процентному сбору</span>(Edit)</b>:</b></td>
  <td><input type="text" name="rate_p_new" size="5" value="0.00" /></td>
</tr>

<tr>
  <td width="150"><b>Промежуточному итогу <b class="translate"><span class="hidden word">Subtotal range</span><span class="hidden translate-phrase">Промежуточному итогу</span>(Edit)</b>:</b></td>
  <td nowrap="nowrap"><input type="text" name="mintotal_new" size="9" value="0.00" />
-
<input type="text" name="maxtotal_new" size="9" value="<?php  echo price_format($maxvalue); ?>" />
  </td>
  <td><b>Взимание платы за единицу товара <b class="translate"><span class="hidden word">Per item charge</span><span class="hidden translate-phrase">Взимание платы за единицу товара</span>(Edit)</b> (<?php  echo $config['General']['currency_symbol']; ?>):</b></td>
  <td nowrap="nowrap"><input type="text" name="item_rate_new" size="5" value="0.00" /></td>
  <td><b>Per <?php  echo $config['General']['weight_symbol']; ?> charge (<?php  echo $config['General']['currency_symbol']; ?>):</b></td>
  <td nowrap="nowrap"><input type="text" name="weight_rate_new" size="5" value="0.00" /></td>
</tr>

</table>

<br />
<button type="submit">Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b></button>

</form>

<?php 
} else if ($type == "D") {
?>
Установленные пользователем способы доставки не определяются <b class="translate"><span class="hidden word">User-defined shipping methods are not defined</span><span class="hidden translate-phrase">Установленные пользователем способы доставки не определяются</span>(Edit)</b>
<?php 
}
?>
