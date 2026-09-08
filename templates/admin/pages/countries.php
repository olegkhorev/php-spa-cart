<table cellpadding="2" cellspacing="1" class="lines-table">

<tr>
  <th width="50">{lng[Code]}</th>
  <th>{lng[Country]}</th>
  <th width="150">{lng[States]}</th>
</tr>

<?php
foreach ($countries as $v) {
	echo '<tr>
  <td align="center">'.$v['code'].'</td>
  <td>'.$v['country'].'</td>
  <td align="center"><a href="/admin/countries/'.$v['code'].'">{lng[Manage]}</a> '.($v['states'] ? '('.$v['states'].')' : '').'</td>
</tr>';
}
?>

</table>