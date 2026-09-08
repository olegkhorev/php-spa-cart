<h1>Способы доставки  <b class="translate"><span class="hidden word">Shipping methods</span><span class="hidden translate-phrase">Способы доставки </span>(Edit)</b></h1>

<?php 
if ($config['Shipping']['enable_shipping'] != 'Y') {
?>

<br />

<b>Доставка отключена. Вы можете управлять ей <а href="конфигурация/доставка">здесь</a>. <b class="translate"><span class="hidden word">Shipping is disabled. You can manage it <a href="configuration/Shipping">here</a>.</span><span class="hidden translate-phrase">Доставка отключена. Вы можете управлять ей <а href="конфигурация/доставка">здесь</a>.</span>(Edit)</b></b>

<br />

<?php 
} else  {
?>

<form method="post" name="shippingmethodsform">
<input type="hidden" name="carrier" value="<?php  echo escape($carrier, 2); ?>" />

<script type="text/javascript">//<![CDATA[
var expands = new Array(<?php  foreach ($carriers as $v) echo "'".$v['code']."',"; ?>'');
function expand_all(flag) {
  var x;
  for (x = 0; x < expands.length; x++) {
    if (expands[x].length == 0)
      continue;

    if (!flag)
      $("#box"+expands[x]).hide();
    else 
      $("#box"+expands[x]).show();
  }
}
//]]></script>

<table cellpadding="2" cellspacing="1" width="700">

<tr class="TableHead">
  <th>Способ доставки  <b class="translate"><span class="hidden word">Shipping method</span><span class="hidden translate-phrase">Способ доставки </span>(Edit)</b></th>
  <th>Сроки доставки  <b class="translate"><span class="hidden word">Delivery time</span><span class="hidden translate-phrase">Сроки доставки </span>(Edit)</b></th>
  <th>Пункт назначения <b class="translate"><span class="hidden word">Destination</span><span class="hidden translate-phrase">Пункт назначения</span>(Edit)</b></th>
  <th>Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
  <th>Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></th>
  <th></th>
</tr>
<?php 
foreach ($shipping as $s) {
	if ($s['code'] == "") {
		echo '
<tr>
  <td><input type="text" name="data['.$s['shippingid'].'][shipping]" size="27" value="'.escape($s['shipping'], 2).'" /></td>
  <td align="center"><input type="text" name="data['.$s['shippingid'].'][shipping_time]" size="8" value="'.escape($s['shipping_time'], 2).'" /></td>
  <td align="center"><select name="data['.$s['shippingid'].'][destination]">
    <option value="I"'.($s['destination'] == 'I' ? ' selected="selected"' : '').'>Международная <b class="translate"><span class="hidden word">International</span><span class="hidden translate-phrase">Международная</span>(Edit)</b></option>
    <option value="N"'.($s['destination'] == 'N' ? ' selected="selected"' : '').'>Национальная <b class="translate"><span class="hidden word">National</span><span class="hidden translate-phrase">Национальная</span>(Edit)</b></option>
  </select></td>
  <td align="center"><input type="text" name="data['.$s['shippingid'].'][orderby]" size="4" value="'.$s['orderby'].'" /></td>
  <td nowrap="nowrap" align="center"><input type="checkbox" name="data['.$s['shippingid'].'][active]" value="Y"'.($s['active'] == 'Y' ? ' checked="checked"' : '').' /></td>
  <td><button type="button" onclick="self.location=\''.$current_location.'/admin/shipping/?mode=delete&amp;shippingid='.$s['shippingid'].'\'">Удалить <b class="translate"><span class="hidden word">Delete</span><span class="hidden translate-phrase">Удалить</span>(Edit)</b></button></td>
</tr>';
	}
}
?>

<tr>
  <td colspan="7"><br /><h3>Добавить способ доставки  <b class="translate"><span class="hidden word">Add shipping method</span><span class="hidden translate-phrase">Добавить способ доставки </span>(Edit)</b></td>
</tr>

<tr>
  <td><input type="text" name="add[shipping]" size="27" /></td>
  <td align="center"><input type="text" name="add[shipping_time]" size="10" /></td>
  <td align="center"><select name="add[destination]">
    <option value="I">Международная <b class="translate"><span class="hidden word">International</span><span class="hidden translate-phrase">Международная</span>(Edit)</b></option>
    <option value="N">Национальная <b class="translate"><span class="hidden word">National</span><span class="hidden translate-phrase">Национальная</span>(Edit)</b></option>
  </select></td>

  <td align="center"><input type="text" name="add[orderby]" size="4" value="0" /></td>
  <td align="center"><input type="checkbox" name="add[active]" value="Y" checked="checked" /></td>
  <td></td>
</tr>

<tr>
  <td colspan="7">&nbsp;</td>
</tr>

<tr>
  <td colspan="7">
<div class="fixed_save_button">
    <button type="submit">Применить изменения <b class="translate"><span class="hidden word">Apply changes</span><span class="hidden translate-phrase">Применить изменения</span>(Edit)</b></button>
</div>
  </td>
</tr>


</table>
</form>

<br /><br />

<?php 
}
?>
