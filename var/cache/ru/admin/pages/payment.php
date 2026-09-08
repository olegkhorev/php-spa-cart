<h1>Способы оплаты <b class="translate"><span class="hidden word">Payment methods</span><span class="hidden translate-phrase">Способы оплаты</span>(Edit)</b></h1>

<form method="post" class="payment_methods">
<table cellpadding="2" cellspacing="1" width="700" class="lines-table">

<tr class="TableHead">
  <th>Способ оплаты <b class="translate"><span class="hidden word">Payment method</span><span class="hidden translate-phrase">Способ оплаты</span>(Edit)</b></th>
  <th>Комментарий <b class="translate"><span class="hidden word">Comment</span><span class="hidden translate-phrase">Комментарий</span>(Edit)</b></th>
  <th>Режим <b class="translate"><span class="hidden word">Mode</span><span class="hidden translate-phrase">Режим</span>(Edit)</b></th>
  <th>Параметры <b class="translate"><span class="hidden word">Params</span><span class="hidden translate-phrase">Параметры</span>(Edit)</b></th>
  <th>Заказ по <b class="translate"><span class="hidden word">Order by</span><span class="hidden translate-phrase">Заказ по</span>(Edit)</b></th>
  <th>Включено <b class="translate"><span class="hidden word">Enabled</span><span class="hidden translate-phrase">Включено</span>(Edit)</b></th>
</tr>
<?php 
foreach ($payment_methods as $m) {
	echo '
<tr>
  <td align="center"><input type="text" name="data['.$m['paymentid'].'][name]" size="20" value="'.escape($m['name'], 2).'" /></td>
  <td align="center"><input type="text" name="data['.$m['paymentid'].'][details]" size="20" value="'.escape($m['details'], 2).'" /></td>
  <td align="center">'.(($m['paymentid'] == 7 || $m['paymentid'] == 2 || $m['paymentid'] == 8) ? '<select name="data['.$m['paymentid'].'][live]"'.(DEMO ? ' disabled' : '').'>
    <option value="0">Тест <b class="translate"><span class="hidden word">Test</span><span class="hidden translate-phrase">Тест</span>(Edit)</b></option>
    <option value="1"'.($m['live'] == 1 ? ' selected="selected"' : '').'>Онлайн <b class="translate"><span class="hidden word">Live</span><span class="hidden translate-phrase">Онлайн</span>(Edit)</b></option>
  </select>' : 'Offline').'</td>
  <td align="left" nowrap>';
	if ($m['paymentid'] == '7') {
		echo '
		<input type="text" name="data['.$m['paymentid'].'][param1]" size="20" placeholder="Secret key"'.(DEMO ? ' disabled' : '').' value="'.escape($m['param1'], 2).'" /> <input type="text" name="data['.$m['paymentid'].'][param2]" size="20" placeholder="Publisher key"'.(DEMO ? ' disabled' : '').' value="'.escape($m['param2'], 2).'" />
		';
	} else if ($m['paymentid'] == '2') {
		echo '
		<input type="text" name="data['.$m['paymentid'].'][param1]" size="20" placeholder="Merchant ID"'.(DEMO ? ' disabled' : '').' value="'.escape($m['param1'], 2).'" /> <input type="text" name="data['.$m['paymentid'].'][param2]" size="20" placeholder="Public key"'.(DEMO ? ' disabled' : '').' value="'.escape($m['param2'], 2).'" /> <input type="text" name="data['.$m['paymentid'].'][param3]" size="20" placeholder="Private key"'.(DEMO ? ' disabled' : '').' value="'.escape($m['param3'], 2).'" />
		';
	} else if ($m['paymentid'] == '8') {
		echo '
		<input type="text" name="data['.$m['paymentid'].'][param1]" size="20" placeholder="Paypal Email"'.(DEMO ? ' disabled' : '').' value="'.escape($m['param1'], 2).'" />
		';
	}
  echo '</td>
  <td align="center"><input type="text" name="data['.$m['paymentid'].'][orderby]" size="4" value="'.$m['orderby'].'" /></td>
  <td nowrap="nowrap" align="center"><input type="checkbox" name="data['.$m['paymentid'].'][enabled]" value="1"'.($m['enabled'] ? ' checked="checked"' : '').' /></td>
</tr>';
}
?>

</table>

<div class="fixed_save_button">
    <button type="submit">Применить изменения <b class="translate"><span class="hidden word">Apply changes</span><span class="hidden translate-phrase">Применить изменения</span>(Edit)</b></button>
</div>

</form>