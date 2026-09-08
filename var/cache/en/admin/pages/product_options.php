<form method="POST" name="poform">
<input type="hidden" name="section" value="options">
<input type="hidden" name="mode" value="update">
<?php 
if ($option_groups) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.poform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.poform, 'to_delete', false);">Uncheck all</a>
<?php 
}
?>
<table width="800" class="lines-table">
<?php 
if ($option_groups) {
?>
<tr>
 <th width="10">&nbsp;</th>
 <th width="100%" colspan="2">Option group</th>
 <th>Pos</th>
 <th>Variant</th>
 <th>Enabled</th>
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
Select box
<?php } else if (($v['view_type'] == 'p')) {?>
Squares
<?php } else if (($v['view_type'] == 'r')) {?>
Radio buttons list
<?php } else if (($v['view_type'] == 't')) {?>
Text area
<?php } else  { ?>
Input box
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
<br><button type="submit">Update</button> <button type="button" onclick="submitForm(this, 'delete');">Delete selected</button>
<br />
<?php } ?>
<br /><a href="<?php echo $current_location;?>/admin/products/<?php  echo $get['2']; ?>/options/add">Add new</a>

<?php 

if ($option_groups) {
?>
<br /><br />
<h2>Options exceptions</h2>
<small>You can set "not available" options combinations here.</small>
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
<button type="button" onclick="submitForm(this, 'delete_ex');">Delete selected</button>
<?php 
	}
?>
<br /><br />
<h3>Add exception</h3>
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
 <td colspan="2"><button type="button" onclick="submitForm(this, 'add_exception')">Add</button></td>
</tr>
</table>
<?php 
}
?>

</form>