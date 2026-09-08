<a href="/admin/user/new">Create new user account</a><br /><br />
<form method="post" name="user_form_admin"<?php /* ?><?php if (!$user['id']) {?> class="noajax"<?php } ?><?php */ ?>>
<table cellpadding="2" class="user_table normal-table">
<tr>
 <td class="name">First name</td>
 <td><input type="text" name="posted_data[firstname]" value="<?php  echo escape($user['firstname']); ?>" /></td>
</td>
<tr>
 <td class="name">Last name</td>
 <td><input type="text" name="posted_data[lastname]" value="<?php  echo escape($user['lastname']); ?>" /></td>
</td>
<tr>
 <td class="name">Phone</td>
 <td><input type="text" name="posted_data[phone]" value="<?php  echo escape($user['phone']); ?>" /></td>
</td>
<tr>
 <td class="name">Email</td>
 <td><input type="text" name="posted_data[email]" value="<?php  echo escape($user['email']); ?>" /></td>
</td>
<tr>
 <td class="name">Password</td>
 <td><input type="password" name="password" value="" /></td>
</td>

<?php if ($userinfo['usertype'] == 'A' && $root_admin) {?>
<tr>
 <td class="name">Role</td>
 <td>
<select name="posted_data[usertype]">
<option value="C"<?php  if ($user['usertype'] == 'C') echo ' selected'; ?>>Customer</option>
<option value="A"<?php  if ($user['usertype'] == 'A') echo ' selected'; ?>>Administrator</option>
</select>
 </td>
</td>
<?php } ?>

<?php if ($userinfo['usertype'] == 'A' && $root_admin) {?>
<tr>
 <td class="name">Role</td>
 <td>
<select name="posted_data[roleid]">
<option value="0"></option>
<?php foreach ($roles as $v) {?>
<option value="<?php echo $v['roleid'];?>"<?php  if ($user['roleid'] == $v['roleid']) echo ' selected'; ?>><?php echo $v['title'];?></option>
<?php } ?>
</select>
 </td>
</td>
<?php } ?>

<tr>
 <td class="name">Status</td>
 <td>
<select name="posted_data[status]">
<option value="1"<?php  if ($user['status'] == 1) echo ' selected'; ?>>Active</option>
<option value="0"<?php  if (!$user['status'] && $user['email']) echo ' selected'; ?>>Not active</option>
</select>
 </td>
</tr>

<tr>
 <td class="name">Address</td>
 <td><input type="text" name="posted_data[address]" value="<?php  echo escape($user['address']); ?>" /></td>
</td>

<tr>
 <td class="name">City</td>
 <td><input type="text" name="posted_data[city]" value="<?php  echo escape($user['city']); ?>" /></td>
</td>

<script>
var states = {};
	user_state = "<?php  echo escape($user['state']); ?>";
<?php 
foreach ($countries as $v) {
	if (!empty($v['states'])) {
		echo 'states.'.$v['code'].' = {states: []};'."\n";
		foreach ($v['states'] as $k=>$s) {
			echo 'states.'.$v['code'].'.states['.$k.'] = {code: "'.escape($s['code']).'", state: "'.escape($s['state']).'"};'."\n";
		}
	}
}
?>
</script>

<tr>
 <td class="name">State</td>
 <td>
<?php 
$found = false;
foreach ($countries as $v)
	if ($v['code'] == $user['country'] && !empty($v['states'])) {
		$found = true;
		echo '<select name="posted_data[state]" id="state">';
		foreach ($v['states'] as $s)
			echo '<option value="'.escape($s['code']).'"'.($s['code'] == $user['state'] ? ' selected' : '').'>'.$s['state'].'</option>';

		echo '</select>';
	}
if (!$found) {
?>
 <input type="text" name="posted_data[state]" id="state" value="<?php  echo escape($user['state']); ?>" /></td>
<?php 
}
?>
</td>

<tr>
 <td class="name">Country</td>
 <td>
<select name="posted_data[country]" id="country">
<option value=""></option>
<?php 
foreach ($countries as $v) {
	echo '<option value="'.$v['code'].'"'.(($v['code'] == $user['country']) ? ' selected' : '').'>'.$v['country'].'</option>';
}
?>
</select>
 </td>
</td>

<tr>
 <td class="name">Zip/Postal code</td>
 <td><input type="text" name="posted_data[zipcode]" value="<?php  echo escape($user['zipcode']); ?>" /></td>
</td>

<tr>
 <td class="name">Pending membership</td>
 <td>
<select name="posted_data[pending_membershipid]">
<option value="0">No membership</option>
<?php 
if ($memberships)
	foreach ($memberships as $m) {
		echo '<option value="'.$m['membershipid'].'"'.($user['pending_membershipid'] == $m['membershipid'] ? ' selected="selected"' : '').'>'.$m['membership'].'</option>';
	}
?>
</select>
 </td>
</td>

<tr>
 <td class="name">Membership</td>
 <td>
<select name="posted_data[membershipid]">
<option value="0">No membership</option>
<?php 
if ($memberships)
	foreach ($memberships as $m) {
		echo '<option value="'.$m['membershipid'].'"'.($user['membershipid'] == $m['membershipid'] ? ' selected="selected"' : '').'>'.$m['membership'].'</option>';
	}
?>
</select>
 </td>
</td>
</table>

<div class="fixed_save_button">
<button>Save</button>
</div>

</form>