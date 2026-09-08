<h1>Детали зоны  <b class="translate"><span class="hidden word">Zone details</span><span class="hidden translate-phrase">Детали зоны </span>(Edit)</b></h1>

<form method="post" name="zoneform" onsubmit="javascript: if (this.zone_name.value == '') { alert('Название зоны должно быть введено <b class="translate"><span class="hidden word">Zone name must be entered</span><span class="hidden translate-phrase">Название зоны должно быть введено</span>(Edit)</b>'); return false; } else  return saveSelects(new Array('zone_countries','zone_states'));"<?php /* ?><?php if (!$zone['zoneid']) {?> class="noajax"<?php } ?><?php */ ?>>
<input type="hidden" name="mode" value="details" />

<table cellpadding="3" cellspacing="1" width="1000" class="normal-table">

<tr>
  <td>Название зоны  <b class="translate"><span class="hidden word">Zone name</span><span class="hidden translate-phrase">Название зоны </span>(Edit)</b></td>
  <td><input type="text" size="50" name="zone_name" value="<?php  echo escape($zone['zone_name'], 2); ?>" />
<br /><br />
<button type="submit"><?php if ($zone['zone_name']) {?>Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b><?php } else  { ?>Создать <b class="translate"><span class="hidden word">Create</span><span class="hidden translate-phrase">Создать</span>(Edit)</b><?php } ?></button>
<?php 
if ($zoneid) {
?>
&nbsp;&nbsp;
<button type="button" onclick="javascript: submitForm(this, 'clone');">Дублировать <b class="translate"><span class="hidden word">Clone</span><span class="hidden translate-phrase">Дублировать</span>(Edit)</b></button>
<?php 
}
?>
  </td>
</tr>
</table>

<table cellpadding="3" cellspacing="1" width="1000">
<tr>
  <td colspan="3"><br /><br /><h3>Страны <b class="translate"><span class="hidden word">Countries</span><span class="hidden translate-phrase">Страны</span>(Edit)</b></td>
</tr>

<tr>
  <td width="45%">Установить значение <b class="translate"><span class="hidden word">Set value</span><span class="hidden translate-phrase">Установить значение</span>(Edit)</b></td>
  <td> </td>
  <td width="45%">Сбросить значение <b class="translate"><span class="hidden word">Unset value</span><span class="hidden translate-phrase">Сбросить значение</span>(Edit)</b></td>
</tr>

<tr>
  <td>
<input type="hidden" id="zone_countries_store" name="zone_countries_store" value="" />
<select id="zone_countries" multiple="multiple" class="width-100p" size="20">
<?php 
foreach ($zone_countries as $c)
	echo '<option value="'.$c['code'].'">'.$c['country'].'</option>';
?>
<option value="">&nbsp;</option>
</select>
<script>
normalizeSelect('zone_countries');
</script>
  </td>
  <td align="center">
<input type="button" value="&lt;&lt;" onclick="javascript: moveSelect(document.getElementById('zone_countries'), document.getElementById('rest_countries'), 'R');" />
<br /><br />
<input type="button" value="&gt;&gt;" onclick="javascript: moveSelect(document.getElementById('zone_countries'), document.getElementById('rest_countries'), 'L');" />
  </td>
  <td>
<select id="rest_countries" multiple="multiple" class="width-100p" size="20">
<?php 
foreach ($rest_countries as $c)
	echo '<option value="'.$c['code'].'">'.$c['country'].'</option>';
?>
</select>
  </td>
</tr>

<tr>
  <td colspan="3"><br /><br /><h3>Регионы <b class="translate"><span class="hidden word">States</span><span class="hidden translate-phrase">Регионы</span>(Edit)</b></td>
</tr>

<tr>
  <td>Установить значение <b class="translate"><span class="hidden word">Set value</span><span class="hidden translate-phrase">Установить значение</span>(Edit)</b></td>
  <td> </td>
  <td>Сбросить значение <b class="translate"><span class="hidden word">Unset value</span><span class="hidden translate-phrase">Сбросить значение</span>(Edit)</b></td>
</tr>

<tr>
  <td>
<input type="hidden" id="zone_states_store" name="zone_states_store" value="" />
<select id="zone_states" multiple="multiple" class="width-100p" size="20">
<?php 
foreach ($zone_states as $s)
	echo '<option value="'.$s['country_code'].'_'.$s['code'].'">'.substr($s['country'], 0, 30).': '.$s['state'].'</option>';
?>
<option value="">&nbsp;</option>
</select>
<script type="text/javascript">
normalizeSelect('zone_states');
</script>
  </td>
  <td align="center">
<input type="button" value="&lt;&lt;" onclick="javascript: moveSelect(document.getElementById('zone_states'), document.getElementById('rest_states'), 'R');" />
<br /><br />
<input type="button" value="&gt;&gt;" onclick="javascript: moveSelect(document.getElementById('zone_states'), document.getElementById('rest_states'), 'L');" />
  </td>
  <td>
<select id="rest_states" name="rest_states" multiple="multiple" class="width-100p" size="20">
<?php 
foreach ($rest_states as $s)
	echo '<option value="'.$s['country_code'].'_'.$s['code'].'">'.substr($s['country'], 0, 17).': '.$s['state'].'</option>';
?>
</select>
  </td>
</tr>

<tr>
  <td colspan="3"><br /><br /><h3>Города <b class="translate"><span class="hidden word">Cities</span><span class="hidden translate-phrase">Города</span>(Edit)</b></td>
</tr>

<tr>
  <td>Установить значение <b class="translate"><span class="hidden word">Set value</span><span class="hidden translate-phrase">Установить значение</span>(Edit)</b></td>
  <td> </td>
  <td>Примеры масок городов  <b class="translate"><span class="hidden word">City mask examples</span><span class="hidden translate-phrase">Примеры масок городов </span>(Edit)</b>:</td>
</tr>

<tr>
  <td>
<textarea cols="40" rows="20" class="width-100p" name="zone_cities"><?php 
foreach ($zone_elements as $e)
	if ($e['field_type'] == 'T')
		echo $e['field']."\n";
?></textarea>
  </td>
  <td align="center">&nbsp;</td>
  <td valign="top">New Yo%<br />Washington<br />Los Angeles<br />Dallas</td>
</tr>

<tr>
  <td colspan="3"><br /><br /><h3>Почтовые индексы <b class="translate"><span class="hidden word">Zip/Postal codes</span><span class="hidden translate-phrase">Почтовые индексы</span>(Edit)</b></td>
</tr>

<tr>
  <td>Установить значение <b class="translate"><span class="hidden word">Set value</span><span class="hidden translate-phrase">Установить значение</span>(Edit)</b></td>
  <td> </td>
  <td>Примеры масок почтовых индексов <b class="translate"><span class="hidden word">Zipcode mask examples</span><span class="hidden translate-phrase">Примеры масок почтовых индексов</span>(Edit)</b>:</td>
</tr>

<tr>
  <td>
<textarea cols="40" rows="20" class="width-100p" name="zone_zipcodes"><?php  foreach ($zone_elements as $e) if ($e['field_type'] == 'Z') echo $e['field']."\n";?></textarea>
  </td>
  <td align="center">&nbsp;</td>
  <td valign="top">1000%<br />38245<br />4320%</td>
</tr>

</table>

<br />

<div class="fixed_save_button">
<button type="submit">Сохранять данные о зоне  <b class="translate"><span class="hidden word">Save zone details</span><span class="hidden translate-phrase">Сохранять данные о зоне </span>(Edit)</b></button>
</div>

</form>
