<form action="<?php echo $current_location;?>/admin/countries/<?php  echo $country['code']; ?>" method="post" name="states_form">
<input type="hidden" name="mode" value="" />

<a href="javascript: void(0);" onclick="javascript: check_all(document.states_form, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.states_form, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<table cellpadding="2" cellspacing="1" class="states lines-table">

<tr>
  <th>&nbsp;</th>
  <th>Код <b class="translate"><span class="hidden word">Code</span><span class="hidden translate-phrase">Код</span>(Edit)</b></th>
  <th>Регионы <b class="translate"><span class="hidden word">States</span><span class="hidden translate-phrase">Регионы</span>(Edit)</b></th>
</tr>

<?php 
if ($states) {
	foreach ($states as $v) {
		echo '<tr>
  <td width="1%" align="center"><input type="checkbox" name="to_delete['.$v['code'].']" /></td>
  <td width="5%" align="center"><input type="text" name="posted_data['.$v['code'].'][code]" size="10" value="'.escape($v['code']).'" /></td>
  <td align="center"><input type="text" name="posted_data['.$v['code'].'][state]" size="35" value="'.escape($v['state']).'" /></td>
</tr>';
	}
} else  {
	echo "<tr><td colspan='3' align='center'>";
?>
В этой стране не определены регионы <b class="translate"><span class="hidden word">No states defined in this country</span><span class="hidden translate-phrase">В этой стране не определены регионы</span>(Edit)</b>
<?php 
 echo "</td></tr>";
}
?>

<tr>
 <td colspan="3"><h3>Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></h3></td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td width="5%" align="center"><input type="text" name="new_state[code]" size="10" /></td>
  <td align="center"><input type="text" name="new_state[state]" size="35" /></td>
</tr>

</table>

<div class="fixed_save_button">
<button type="submit">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
&nbsp;
<button type="button" onclick="javascript: submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>

</form>