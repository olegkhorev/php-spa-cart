<form method="POST" name="poform">
<input type="hidden" name="section" value="options">
<input type="hidden" name="mode" value="update">
  <table cellspacing="1" cellpadding="3" width="400" class="normal-table">

    <tr>
      <td>Имя <b class="translate"><span class="hidden word">Name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></td>
      <td class="star">*</td>
      <td><input type="text" name="posted_data[name]" value="<?php  echo $option_group['name']; ?>" />
    </tr>

    <tr>
      <td>Текст <b class="translate"><span class="hidden word">Text</span><span class="hidden translate-phrase">Текст</span>(Edit)</b></td>
      <td></td>
      <td><input type="text" size="40" name="posted_data[fullname]" value="<?php  echo $option_group['fullname']; ?>" />
    </tr>

    <tr>
      <td>Тип <b class="translate"><span class="hidden word">Type</span><span class="hidden translate-phrase">Тип</span>(Edit)</b></td>
      <td></td>
      <td>
      <select name="posted_data[type]" id="data_type">
        <option value="g">Группа опций <b class="translate"><span class="hidden word">Options group</span><span class="hidden translate-phrase">Группа опций</span>(Edit)</b></option>
		<option value="t"<?php  if ($option_group['type'] == 't') echo ' selected'; ?>>Параметр текста <b class="translate"><span class="hidden word">Text option</span><span class="hidden translate-phrase">Параметр текста</span>(Edit)</b></option>
      </select>
      </td>
    </tr>

    <tr>
      <td nowrap>Тип отображения <b class="translate"><span class="hidden word">Display type</span><span class="hidden translate-phrase">Тип отображения</span>(Edit)</b></td>
      <td></td>
      <td>
      <select name="posted_data[view_type]" id="data_view_type">
<?php 
if ($option_group['type'] == 'g' || !$option_group) {
?>
        <option value="s">Поле выбора <b class="translate"><span class="hidden word">Select box</span><span class="hidden translate-phrase">Поле выбора</span>(Edit)</b></option>
        <option value="p"<?php  if ($option_group['view_type'] == 'p') echo ' selected'; ?>>Квадраты <b class="translate"><span class="hidden word">Squares</span><span class="hidden translate-phrase">Квадраты</span>(Edit)</b></option>
<?php /* ?>
        <option value="r"<?php  if ($option_group['view_type'] == 'r') echo ' selected'; ?>>Список кнопок для выбора опций <b class="translate"><span class="hidden word">Radio buttons list</span><span class="hidden translate-phrase">Список кнопок для выбора опций</span>(Edit)</b></option>-->
<?php */ ?>
<?php 
} else  {
?>
        <option value="t">Текстовая область <b class="translate"><span class="hidden word">Text area</span><span class="hidden translate-phrase">Текстовая область</span>(Edit)</b></option>
        <option value="i"<?php  if ($option_group['view_type'] == 'i') echo ' selected'; ?>>Поле ввода <b class="translate"><span class="hidden word">Input box</span><span class="hidden translate-phrase">Поле ввода</span>(Edit)</b></option>
<?php 
}
?>
      </select>
      </td>
    </tr>

    <tr>
      <td>Позиция <b class="translate"><span class="hidden word">Position</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></td>
      <td></td>
      <td><input size="5" type="text" name="posted_data[orderby]" value="<?php  echo $option_group['orderby']; ?>" /></td>
    </tr>

    <tr>
      <td>Вариант <b class="translate"><span class="hidden word">Variant</span><span class="hidden translate-phrase">Вариант</span>(Edit)</b></td>
      <td></td>
      <td><input type="checkbox" name="posted_data[variant]" value="1"<?php  if ($option_group['variant']) echo ' checked'; ?> /></td>
    </tr>

    <tr>
      <td>Включено <b class="translate"><span class="hidden word">Enabled</span><span class="hidden translate-phrase">Включено</span>(Edit)</b></td>
      <td></td>
      <td><input type="checkbox" name="posted_data[enabled]" value="1"<?php  if (!$option_group || $option_group['enabled']) echo ' checked'; ?> /></td>
    </tr>

  </table>
<br />
    <h3>Групповые опции <b class="translate"><span class="hidden word">Group options</span><span class="hidden translate-phrase">Групповые опции</span>(Edit)</b></h3>
<?php 
if ($options) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.poform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.poform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<?php 
}
?>
<table cellspacing="1" width="100%">
<tr>
 <th width="10"></th>
 <th width="100%">Имя <b class="translate"><span class="hidden word">Name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></th>
 <th colspan="2">Модификатор цены <b class="translate"><span class="hidden word">Price modifier</span><span class="hidden translate-phrase">Модификатор цены</span>(Edit)</b></th>
 <th colspan="2">Модификатор веса <b class="translate"><span class="hidden word">Weight modifier</span><span class="hidden translate-phrase">Модификатор веса</span>(Edit)</b></th>
 <th>Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
 <th>Включено <b class="translate"><span class="hidden word">Enabled</span><span class="hidden translate-phrase">Включено</span>(Edit)</b></th>
</tr>
<?php 
if ($options) {	foreach ($options as $k=>$v) {		echo '<tr>
 <td><input type="checkbox" name="to_delete['.$v['optionid'].']" /></td>
 <td><input type="text" class="width-95p" name="options_data['.$v['optionid'].'][name]" value="'.escape($v['name']).'" /></td>
 <td><input size="5" type="text" name="options_data['.$v['optionid'].'][price_modifier]" value="'.escape($v['price_modifier']).'" /></td>
 <td>
  <select name="options_data['.$v['optionid'].'][price_modifier_type]">
   <option value="%">Процент <b class="translate"><span class="hidden word">Percent</span><span class="hidden translate-phrase">Процент</span>(Edit)</b></option>
   <option value="$"'.($v['price_modifier_type'] == '$' ? ' selected="selected"' : '').'>Абсолютный <b class="translate"><span class="hidden word">Absolute</span><span class="hidden translate-phrase">Абсолютный</span>(Edit)</b></option>
  </select>
 </td>
 <td><input size="5" type="text" name="options_data['.$v['optionid'].'][weight_modifier]" value="'.escape($v['weight_modifier']).'" /></td>
 <td>
  <select name="options_data['.$v['optionid'].'][weight_modifier_type]">
   <option value="%">Процент <b class="translate"><span class="hidden word">Percent</span><span class="hidden translate-phrase">Процент</span>(Edit)</b></option>
   <option value="$"'.($v['weight_modifier_type'] == '$' ? ' selected="selected"' : '').'>Абсолютный <b class="translate"><span class="hidden word">Absolute</span><span class="hidden translate-phrase">Абсолютный</span>(Edit)</b></option>
  </select>
 </td>
 <td><input size="5" type="text" name="options_data['.$v['optionid'].'][orderby]" value="'.$v['orderby'].'" /></td>
 <td align="center"><input type="checkbox" name="options_data['.$v['optionid'].'][enabled]" value="1" '.($v['enabled'] ? ' checked' : '').'></td>
</tr>';
	}
}
?>
<tr id="add_new">
 <td><a href="javascript: void(0);" onclick="duplicate_row($('#add_new'), $(this));" class="duplicate_plus">+</a></td>
 <td><input type="text" class="width-95p" name="new_option[0][name]" /></td>
 <td><input size="5" type="text" name="new_option[0][price_modifier]" /></td>
 <td>
  <select name="new_option[0][price_modifier_type]">
   <option value="%">Процент <b class="translate"><span class="hidden word">Percent</span><span class="hidden translate-phrase">Процент</span>(Edit)</b></option>
   <option value="$">Абсолютный <b class="translate"><span class="hidden word">Absolute</span><span class="hidden translate-phrase">Абсолютный</span>(Edit)</b></option>
  </select>
 </td>
 <td><input size="5" type="text" name="new_option[0][weight_modifier]" /></td>
 <td>
  <select name="new_option[0][weight_modifier_type]">
   <option value="%">Процент <b class="translate"><span class="hidden word">Percent</span><span class="hidden translate-phrase">Процент</span>(Edit)</b></option>
   <option value="$">Абсолютный <b class="translate"><span class="hidden word">Absolute</span><span class="hidden translate-phrase">Абсолютный</span>(Edit)</b></option>
  </select>
 </td>
 <td><input size="5" type="text" name="new_option[0][orderby]" /></td>
 <td align="center"><input type="checkbox" name="new_option[0][enabled]" checked value="1" /></td>
</tr>
</table>
<br />
<?php 
if ($option_group) {
?>
<button type="submit">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button> <button type="button" onclick="submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
<?php 
} else  {
?>
<button type="submit">Добавить группу опций <b class="translate"><span class="hidden word">Add option group</span><span class="hidden translate-phrase">Добавить группу опций</span>(Edit)</b></button>
<?php 
}
?>
</form>