<form method="POST" name="poform">
<input type="hidden" name="section" value="options">
<input type="hidden" name="mode" value="update">
<?php 
if ($option_groups) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.poform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.poform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<?php 
}
?>
<table width="800" class="lines-table">
<?php 
if ($option_groups) {
?>
<tr>
 <th width="10">&nbsp;</th>
 <th width="100%" colspan="2">Группа опций <b class="translate"><span class="hidden word">Option group</span><span class="hidden translate-phrase">Группа опций</span>(Edit)</b></th>
 <th>Позиция <b class="translate"><span class="hidden word">Pos</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
 <th>Вариант <b class="translate"><span class="hidden word">Variant</span><span class="hidden translate-phrase">Вариант</span>(Edit)</b></th>
 <th>Включено <b class="translate"><span class="hidden word">Enabled</span><span class="hidden translate-phrase">Включено</span>(Edit)</b></th>
</tr>
<?php 
foreach ($option_groups as $v) {
	echo '
<tr>
 <td><input type="checkbox" name="to_delete['.$v['groupid'].']"></td>
 <td width="100%"><a href="'.$current_location.'/admin/products/'.$v['productid'].'/options/'.$v['groupid'].'">'.$v['name'].' ('.($v['options'] ? count($v['options']) : '0').')</a></td>
 <td nowrap>';
?>
<?php if (($v['view_type'] == 's')) {?>
Поле выбора <b class="translate"><span class="hidden word">Select box</span><span class="hidden translate-phrase">Поле выбора</span>(Edit)</b>
<?php } else if (($v['view_type'] == 'p')) {?>
Квадраты <b class="translate"><span class="hidden word">Squares</span><span class="hidden translate-phrase">Квадраты</span>(Edit)</b>
<?php } else if (($v['view_type'] == 'r')) {?>
Список кнопок для выбора опций <b class="translate"><span class="hidden word">Radio buttons list</span><span class="hidden translate-phrase">Список кнопок для выбора опций</span>(Edit)</b>
<?php } else if (($v['view_type'] == 't')) {?>
Текстовая область <b class="translate"><span class="hidden word">Text area</span><span class="hidden translate-phrase">Текстовая область</span>(Edit)</b>
<?php } else  { ?>
Поле ввода <b class="translate"><span class="hidden word">Input box</span><span class="hidden translate-phrase">Поле ввода</span>(Edit)</b>
<?php } ?>
<?php 
 echo '</td>
 <td><input type="text" size="5" name="posted_data['.$v['groupid'].'][orderby]" value="'.$v['orderby'].'" /></td>
 <td align="center"><input type="checkbox" name="posted_data['.$v['groupid'].'][variant]" value="1" '.($v['variant'] ? ' checked="checked"' : '').' /></td>
 <td align="center"><input type="checkbox" name="posted_data['.$v['groupid'].'][enabled]" value="1" '.($v['enabled'] ? ' checked="checked"' : '').' /></td>
</tr>
	';
}
?>
<?php 
}
?>
</table>
<?php if ($option_groups) {?>
<br><button type="submit">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button> <button type="button" onclick="submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
<br />
<?php } ?>
<br /><a href="<?php echo $current_location;?>/admin/products/<?php  echo $get['2']; ?>/options/add">Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></a>

<?php 

if ($option_groups) {
?>
<br /><br />
<h2>Исключения опций <b class="translate"><span class="hidden word">Options exceptions</span><span class="hidden translate-phrase">Исключения опций</span>(Edit)</b></h2>
<small>Здесь вы можете установить «недоступные» комбинации опций. <b class="translate"><span class="hidden word">You can set "not available" options combinations here.</span><span class="hidden translate-phrase">Здесь вы можете установить «недоступные» комбинации опций.</span>(Edit)</b></small>
<?php 
	if ($options_ex) {?>
<br /><br />
<table>
<?php 
		foreach ($options_ex as $k=>$v) {			echo '<tr><td><input type="checkbox" name="to_delete['.$k.']" /></td><td>';
			foreach ($v as $k2=>$v2) {
				foreach ($option_groups as $g) {					if ($g['options'])
						foreach ($g['options'] as $o) {							if ($o['optionid'] == $v2)
								echo $g['name'].': '.$o['name'].' &nbsp; ';
						}				}
			}

			echo '</td></tr>';
		}
?>
</table>
<br />
<button type="button" onclick="submitForm(this, 'delete_ex');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
<?php 
	}
?>
<br /><br />
<h3>Добавить исключение <b class="translate"><span class="hidden word">Add exception</span><span class="hidden translate-phrase">Добавить исключение</span>(Edit)</b></h3>
<table>
<?php 
	foreach ($option_groups as $v) {		echo '<tr><td nowrap>'.$v['name'].':</td><td>';
		if ($v['options']) {			echo '<select name="new_exception['.$v['groupid'].']">';
			foreach ($v['options'] as $o)
				echo '<option value="'.$o['optionid'].'">'.$o['name'].'</option>';
			echo '</select>';
		}

		echo '</td></tr>';
    }
?>
<tr>
 <td colspan="2"><button type="button" onclick="submitForm(this, 'add_exception')">Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b></button></td>
</tr>
</table>
<?php 
}
?>

</form>