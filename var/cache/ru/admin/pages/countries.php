<table cellpadding="2" cellspacing="1" class="countries lines-table">

<tr>
  <th>Код <b class="translate"><span class="hidden word">Code</span><span class="hidden translate-phrase">Код</span>(Edit)</b></th>
  <th>Страна <b class="translate"><span class="hidden word">Country</span><span class="hidden translate-phrase">Страна</span>(Edit)</b></th>
  <th>Регионы <b class="translate"><span class="hidden word">States</span><span class="hidden translate-phrase">Регионы</span>(Edit)</b></th>
</tr>

<?php 
foreach ($countries as $v) {
	echo '<tr>
  <td width="5%" align="center">'.$v['code'].'</td>
  <td>'.$v['country'].'</td>
  <td align="left"><a href="/admin/countries/'.$v['code'].'">Управление <b class="translate"><span class="hidden word">Manage</span><span class="hidden translate-phrase">Управление</span>(Edit)</b></a> '.($v['states'] ? '('.$v['states'].')' : '').'</td>
</tr>';
}
?>

</table>