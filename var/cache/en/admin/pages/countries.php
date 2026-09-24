<table cellpadding="2" cellspacing="1" class="lines-table resp-table">
<thead>
<tr>
  <th width="50">Code</th>
  <th>Country</th>
  <th width="150">States</th>
</tr>
</thead>
<?php 
foreach ($countries as $v) {
	echo '<tr>
  <td align="center"><label>Code</label>'.$v['code'].'</td>
  <td><label>Country</label>'.$v['country'].'</td>
  <td align="center"><label>States</label><a href="/admin/countries/'.$v['code'].'">Manage</a> '.($v['states'] ? '('.$v['states'].')' : '').'</td>
</tr>';
}
?>

</table>