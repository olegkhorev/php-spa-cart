<table cellpadding="2" cellspacing="1" class="lines-table resp-table">
<thead>
<tr>
  <th width="50">{lng[Code]}</th>
  <th>{lng[Country]}</th>
  <th width="150">{lng[States]}</th>
</tr>
</thead>
<?php
foreach ($countries as $v) {
	echo '<tr>
  <td align="center"><label>{lng[Code]}</label>'.$v['code'].'</td>
  <td><label>{lng[Country]}</label>'.$v['country'].'</td>
  <td align="center"><label>{lng[States]}</label><a href="/admin/countries/'.$v['code'].'">{lng[Manage]}</a> '.($v['states'] ? '('.$v['states'].')' : '').'</td>
</tr>';
}
?>

</table>