<form method="post" name="currenciesform">
<input type="hidden" name="mode" value="update" />
<?php if ($currencies) {?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.currenciesform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.currenciesform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<?php } ?>
<table cellpadding="3" cellspacing="1" width="600">
<tr>
	<th width="10">&nbsp;</th>
	<th width="15%">Код валюты <b class="translate"><span class="hidden word">Currency code</span><span class="hidden translate-phrase">Код валюты</span>(Edit)</b></th>
	<th width="10%">Курс <b class="translate"><span class="hidden word">Rate</span><span class="hidden translate-phrase">Курс</span>(Edit)</b></th>
	<th width="15%">Символ <b class="translate"><span class="hidden word">Symbol</span><span class="hidden translate-phrase">Символ</span>(Edit)</b></th>
	<th width="20%">Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></th>
	<th width="20%">Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
	<th width="20%">Главная <b class="translate"><span class="hidden word">Main</span><span class="hidden translate-phrase">Главная</span>(Edit)</b></th>
</tr>
<?php if ($currencies) {?>
<?php 
foreach ($currencies as $b) {
	echo '<tr>
	<td><input type="checkbox" name="to_delete['.$b['id'].']" value="Y" /></td>
	<td align="center"><input type="text" size="20" name="to_update['.$b['id'].'][code]" value="'.$b['code'].'" /></td>
	<td align="center"><input type="text" size="20" name="to_update['.$b['id'].'][rate]" value="'.$b['rate'].'" /></td>
	<td align="center"><input type="text" size="20" name="to_update['.$b['id'].'][symbol]" value="'.$b['symbol'].'" /></td>
	<td align="center"><input type="checkbox" name="to_update['.$b['id'].'][active]" value="1"'.($b['active'] ? ' checked="checked"' : '').' /></td>
	<td align="center"><input type="text" size="5" name="to_update['.$b['id'].'][orderby]" value="'.$b['orderby'].'" /></td>
	<td align="center"><input type="radio" name="main_currency" value="'.$b['id'].'"'.($b['main'] ? ' checked="checked"' : '').' /></td>
</tr>';
}
?>

<tr>
	<td colspan="7">
<button type="button" onclick="javascript: submitForm(this, 'update');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button> &nbsp;
<button type="button" onclick="javascript: submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
	</td>
</tr>
<?php } ?>

<tr>
	<td colspan="7"><h3>Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></h3></td>
</tr>
<tr>
	<td></td>
	<td align="center"><input type="text" size="20" name="new_currency[code]" value="" /></td>
	<td align="center"><input type="text" size="20" name="new_currency[rate]" value="" /></td>
	<td align="center"><input type="text" size="20" name="new_currency[symbol]" value="" /></td>
	<td align="center"><input type="checkbox" name="new_currency[active]" value="1" checked="checked" /></td>
	<td align="center"><input type="text" size="5" name="new_currency[orderby]" value="" /></td>
	<td></td>
</tr>

<tr>
	<td colspan="7"><button type="button" onclick="javascript: submitForm(this, 'add');">Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b></button></td>
</tr>

</table>
</form>
