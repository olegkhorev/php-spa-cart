<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1 class="products-title-h3">Users <a href="/admin/user/new" class="link-button ajax_link">Create new user account</a><br /><br /></h1>

<form action="<?php echo $current_location;?>/admin/users/search" method="post" name="users_form">
<input type="hidden" name="mode" value="" />

<?php 
if ($get['2'] == 'search') {
?>
<a href="<?php echo $current_location;?>/admin/users" class="search_again ajax_link link-button">Search again</a>
<h3>Users search results</h3>
<?php 
if ($users) {
?>
<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php 
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.users_form, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.users_form, 'to_delete', false);">Uncheck all</a>

<br /><br />

<table class="users_list lines-table resp-table">
<thead>
<tr>
 <th style="width:10px">&nbsp;</th>
 <th style="width:40%">User name</th>
 <th style="width:40%">User email</th>
 <th style="width:10%">User role</th>
 <th style="width:10%">Status</th>
</tr>
</thead>
<?php 
foreach ($users as $k=>$v) {
?>
<tr>
 <td><input type="checkbox" name="to_delete[<?php  echo $v['id']; ?>]" /></td>
 <td><label>User name</label><a href="<?php echo $current_location;?>/admin/user/<?php  echo $v['id']; ?>"><?php  echo $v['firstname'].' '.$v['lastname']; ?></a></td>
 <td><label>User email</label><?php  echo $v['email']; ?></td>
 <td style="text-align:center"><label>User role</label><?php  if ($v['usertype'] == 'A') {?>Administrator<?php  } else  {?>Customer<?php  } ?></td>
 <td class="no-word-break td-align-center"><label>Status</label>
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
<button type="button" onclick="javascript: submitForm(document.users_form, 'update');">Update</button>
&nbsp;
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(document.users_form, 'delete');">Delete selected</button>
</div>
<?php 
} else  {
?>
No users found
<?php 
}
} else  {
?>
<table class="users_management search_table">
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
 <td class="name">User type</td>
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
</tr>

<tr>
 <td class="name">Pending membership</td>
 <td>
<input type="checkbox" name="pending_membership" value="Y"<?php  if ($users_search['pending_membership'] == 'Y') echo ' checked="checked"'; ?> />
 </td>
</tr>

<tr>
  <td></td>
  <td><br /><button type="submit">Search</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a class="ajax_link" href="<?php echo $current_location;?>/admin/users/reset">Reset</a></td>
</tr>

</table>
</form>
<?php 
}
?>
