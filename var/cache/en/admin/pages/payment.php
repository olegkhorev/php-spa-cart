<h1>Payment methods</h1>

<form method="post" class="payment_methods">
<table cellpadding="2" cellspacing="1" width="900" class="lines-table resp-table">
<thead>
<tr>
  <th>Payment method</th>
  <th>Comment</th>
  <th>Mode</th>
  <th>Params</th>
  <th>Order by</th>
  <th>Enabled</th>
</tr>
</thead>
<?php 
foreach ($payment_methods as $m) {
	echo '
<tr>
  <td align="center"><label>Payment method</label><input type="text" name="data['.$m['paymentid'].'][name]" size="20" value="'.escape($m['name'], 2).'" /></td>
  <td align="center"><label>Comment</label><input type="text" name="data['.$m['paymentid'].'][details]" size="20" value="'.escape($m['details'], 2).'" /></td>
  <td align="center"><label>Mode</label>'.(($m['paymentid'] == 7 || $m['paymentid'] == 2 || $m['paymentid'] == 8) ? '<select name="data['.$m['paymentid'].'][live]"'.(DEMO ? ' disabled' : '').'>
    <option value="0">Test</option>
    <option value="1"'.($m['live'] == 1 ? ' selected="selected"' : '').'>Live</option>
  </select>' : 'Offline').'</td>
  <td align="left" nowrap><label>Params</label>';
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
  <td align="center"><label>Pos</label><input type="text" name="data['.$m['paymentid'].'][orderby]" size="4" value="'.$m['orderby'].'" /></td>
  <td nowrap="nowrap" align="center"><label>Enabled</label><input type="checkbox" name="data['.$m['paymentid'].'][enabled]" value="1"'.($m['enabled'] ? ' checked="checked"' : '').' /></td>
</tr>';
}
?>

</table>

<div class="fixed_save_button">
    <button type="submit">Apply changes</button>
</div>

</form>