<table cellpadding="2" cellspacing="1" class="countries lines-table">

<tr>
  <th>Code</th>
  <th>Country</th>
  <th>States</th>
</tr>

<?php 
foreach ($countries as $v) {
	echo '<tr>
  <td width="5%" align="center">'.$v['code'].'</td>
  <td>'.$v['country'].'</td>
  <td align="left"><a href="/admin/countries/'.$v['code'].'">Manage</a> '.($v['states'] ? '('.$v['states'].')' : '').'</td>
</tr>';
}
?>

</table>