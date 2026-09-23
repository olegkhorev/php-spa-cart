<table cellpadding="2" cellspacing="1" class="lines-table">

<tr>
  <th width="50">Code</th>
  <th>Country</th>
  <th width="150">States</th>
</tr>

<?php 
foreach ($countries as $v) {
	echo '<tr>
  <td align="center">'.$v['code'].'</td>
  <td>'.$v['country'].'</td>
  <td align="center"><a href="/admin/countries/'.$v['code'].'">Manage</a> '.($v['states'] ? '('.$v['states'].')' : '').'</td>
</tr>';
}
?>

</table>