<a href="/admin/user/new">Create new user account</a><br /><br />
<form action="<?php echo $current_location;?>/admin/users/search" method="post" name="users_form">
<input type="hidden" name="mode" value="" />

<?php 
if ($get['2'] == 'search') {
?>
<a href="<?php echo $current_location;?>/admin/users" class="search_again">Search again</a>
<h3>Users search results</h3>
<?php 
if ($users) {
?>
<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php 
	echo '<br />';
}
?>

<table cellpadding="2" class="users_list lines-table">
<tr>
 <th width="10">&nbsp;</th>
 <th width="40%">User name</th>
 <th width="40%">User email</th>
 <th width="10%">User role</th>
 <th width="10%">Status</th>
</tr>
<?php 
foreach ($users as $k=>$v) {
?>
<tr>
 <td><input type="checkbox" name="to_delete[<?php  echo $v['id']; ?>]" /></td>
 <td><a href="<?php echo $current_location;?>/admin/user/<?php  echo $v['id']; ?>"><?php  echo $v['firstname'].' '.$v['lastname']; ?></a></td>
 <td><?php  echo $v['email']; ?></a></td>
 <td align="center"><?php  if ($v['usertype'] == 'A') {?>Administrator<?php } else  {?>Customer<?php } ?></a></td>
 <td>
<select name="status[<?php  echo $v['id']; ?>]">
<option value="1"<?php  if ($v['status'] == 1) echo ' selected="selected"'; ?>>Active</option>
<option value="0"<?php  if (empty($v['status'])) echo ' selected="selected"'; ?>>Not active</option>
</select>
 </td>
</tr>
<?php 
}
?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="submitForm(document.users_form, 'update');">Update</button>
&nbsp;
<button type="button" onclick="submitForm(document.users_form, 'delete');">Delete selected</button>
</div>
<?php 
} else  {
?>
No users found
<?php 
}
} else  {
?>
<h3>Users management</h3><br />
<table cellpadding="2" cellspacing="1" class="users_management">
<tr>
 <td class="name">Search for</td>
 <td><input type="text" name="substring" value="<?php  echo escape($users_search['substring']); ?>" size="80" /></td>
</tr>

<tr>
 <td class="name">Search in</td>
 <td>
<label><input type="checkbox" name="firstname" value="1"<?php  if ($users_search['firstname']) echo ' checked="checked"'; ?> /> First name</label>
<label><input type="checkbox" name="lastname" value="1"<?php  if ($users_search['lastname']) echo ' checked="checked"'; ?> /> Last name</label>
<label><input type="checkbox" name="email" value="1"<?php  if ($users_search['email']) echo ' checked="checked"'; ?> /> Email</label>
 </td>
</tr>

<tr>
 <td class="name">Status</td>
 <td>
<select name="status">
<option value="">All</option>
<option value="1"<?php  if ($users_search['status'] == 1) echo ' selected="selected"'; ?>>Active</option>
<option value="0"<?php  if ($users_search['status'] == '0') echo ' selected="selected"'; ?>>Not active</option>
</select>
 </td>
</tr>

<tr>
 <td class="name">Role</td>
 <td>
<select name="usertype">
<option value="">All</option>
<option value="C"<?php  if ($users_search['usertype'] == 'C') echo ' selected="selected"'; ?>>Customer</option>
<option value="A"<?php  if ($users_search['usertype'] == 'A') echo ' selected="selected"'; ?>>Administrator</option>
</select>
 </td>
</tr>

<tr>
 <td class="name">Membership</td>
 <td>
<select name="membershipid">
<option value="0">No membership</option>
<?php 
if ($memberships)
	foreach ($memberships as $m) {
		echo '<option value="'.$m['membershipid'].'"'.($users_search['membershipid'] == $m['membershipid'] ? ' selected="selected"' : '').'>'.$m['membership'].'</option>';
	}
?>
</select>
 </td>
</td>

<tr>
 <td class="name">Pending membership</td>
 <td>
<input type="checkbox" name="pending_membership" value="Y"<?php  if ($users_search['pending_membership'] == 'Y') echo ' checked="checked"'; ?> />
 </td>
</tr>

<tr>
  <td></td>
  <td><br /><button type="submit">Search</button></td>
</tr>

</table>
</form>
<?php 
}
?>
