<form method="POST" name="wform">
<input type="hidden" name="section" value="wholesale">
<input type="hidden" name="mode" value="update">
<?php 
if ($wholesale) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.wform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.wform, 'to_delete', false);">Uncheck all</a>
<?php 
}
?>
<table cellspacing="1" width="600">
<tr>
 <th width="10"></th>
 <th>Quantity</th>
 <th>Price</th>
 <th>Membership</th>
</tr>
<?php 
if ($wholesale) {	foreach ($wholesale as $k=>$v) {		echo '<tr>
 <td><input type="checkbox" name="to_delete['.$v['priceid'].']" /></td>
 <td><input size="5" type="text" class="width-85p" name="posted_data['.$v['priceid'].'][quantity]" value="'.$v['quantity'].'" /></td>
 <td><input size="5" type="text" name="posted_data['.$v['priceid'].'][price]" value="'.$v['price'].'" /></td>
 <td><select name="posted_data['.$v['priceid'].'][membershipid]">
<option value="0">All</option>
 ';
		if ($memberships)
			foreach ($memberships as $m) {
				echo '<option value="'.$m['membershipid'].'"'.($m['membershipid'] == $v['membershipid'] ? ' selected="selected"' : '').'>'.$m['membership'].'</option>';
			}

		echo '</select></td>
</tr>';
	}
}
?>
<tr id="add_new">
 <td><a href="javascript: void(0);" onclick="duplicate_row($('#add_new'), $(this));" class="duplicate_plus">+</a></td>
 <td><input type="text" class="width-85p" name="new_wp[0][quantity]" value="1" /></td>
 <td><input size="5" type="text" name="new_wp[0][price]" /></td>
 <td><select name="new_wp[0][membershipid]">
<option value="0">All</option>
<?php 
if ($memberships)
	foreach ($memberships as $m) {
		echo '<option value="'.$m['membershipid'].'">'.$m['membership'].'</option>';
	}
?>
 </select></td>
 </td>
</tr>
</table>
<br />
<button type="submit">Update</button><?php  if ($wholesale) {?> <button type="button" onclick="submitForm(this, 'delete');">Delete selected</button><?php  }?>
</form>