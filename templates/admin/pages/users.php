<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1 class="products-title-h3">{lng[Users]} <a href="/admin/user/new" class="link-button ajax_link">{lng[Create new user account]}</a><br /><br /></h1>

<form action="{$current_location}/admin/users/search" method="post" name="users_form">
<input type="hidden" name="mode" value="" />

<?php
if ($get['2'] == 'search') {
?>
<a href="{$current_location}/admin/users" class="search_again ajax_link link-button">{lng[Search again]}</a>
<h3>{lng[Users search results]}</h3>
<?php
if ($users) {
?>
<?php
if ($total_pages > 2) {
?>
{include="common/navigation.php"}
<br />
<?php
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.users_form, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.users_form, 'to_delete', false);">{lng[Uncheck all]}</a>

<br /><br />

<table class="users_list lines-table resp-table">
<thead>
<tr>
 <th style="width:10px">&nbsp;</th>
 <th style="width:40%">{lng[User name]}</th>
 <th style="width:40%">{lng[User email]}</th>
 <th style="width:10%">{lng[User role]}</th>
 <th style="width:10%">{lng[Status]}</th>
</tr>
</thead>
<?php
foreach ($users as $k=>$v) {
?>
<tr>
 <td><input type="checkbox" name="to_delete[<?php echo $v['id']; ?>]" /></td>
 <td><label>{lng[User name]}</label><a href="{$current_location}/admin/user/<?php echo $v['id']; ?>"><?php echo $v['firstname'].' '.$v['lastname']; ?></a></td>
 <td><label>{lng[User email]}</label><?php echo $v['email']; ?></td>
 <td style="text-align:center"><label>{lng[User role]}</label><?php if ($v['usertype'] == 'A') {?>{lng[Administrator]}<?php } else {?>{lng[Customer]}<?php } ?></td>
 <td class="no-word-break td-align-center"><label>{lng[Status]}</label>
<select name="status[<?php echo $v['id']; ?>]">
<option value="1"<?php if ($v['status'] == 1) echo ' selected="selected"'; ?>>{lng[Active]}</option>
<option value="0"<?php if (empty($v['status'])) echo ' selected="selected"'; ?>>{lng[Not active]}</option>
</select>
 </td>
</tr>
<?php
}
?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(document.users_form, 'update');">{lng[Update]}</button>
&nbsp;
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(document.users_form, 'delete');">{lng[Delete selected]}</button>
</div>
<?php
} else {
?>
{lng[No users found]}
<?php
}
} else {
?>
<table class="users_management search_table">
<tr>
 <td class="name">{lng[Search for]}</td>
 <td><input type="text" name="substring" value="<?php echo escape($users_search['substring']); ?>" size="80" /></td>
</tr>

<tr>
 <td class="name">{lng[Search in]}</td>
 <td>
<label><input type="checkbox" name="firstname" value="1"<?php if ($users_search['firstname']) echo ' checked="checked"'; ?> /> {lng[First name]}</label>
<label><input type="checkbox" name="lastname" value="1"<?php if ($users_search['lastname']) echo ' checked="checked"'; ?> /> {lng[Last name]}</label>
<label><input type="checkbox" name="email" value="1"<?php if ($users_search['email']) echo ' checked="checked"'; ?> /> {lng[Email]}</label>
 </td>
</tr>

<tr>
 <td class="name">{lng[Status]}</td>
 <td>
<select name="status">
<option value="">{lng[All]}</option>
<option value="1"<?php if ($users_search['status'] == 1) echo ' selected="selected"'; ?>>{lng[Active]}</option>
<option value="0"<?php if ($users_search['status'] == '0') echo ' selected="selected"'; ?>>{lng[Not active]}</option>
</select>
 </td>
</tr>

<tr>
 <td class="name">{lng[User type]}</td>
 <td>
<select name="usertype">
<option value="">{lng[All]}</option>
<option value="C"<?php if ($users_search['usertype'] == 'C') echo ' selected="selected"'; ?>>{lng[Customer]}</option>
<option value="A"<?php if ($users_search['usertype'] == 'A') echo ' selected="selected"'; ?>>{lng[Administrator]}</option>
</select>
 </td>
</tr>

<tr>
 <td class="name">{lng[Membership]}</td>
 <td>
<select name="membershipid">
<option value="0">{lng[No membership]}</option>
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
 <td class="name">{lng[Pending membership]}</td>
 <td>
<input type="checkbox" name="pending_membership" value="Y"<?php if ($users_search['pending_membership'] == 'Y') echo ' checked="checked"'; ?> />
 </td>
</tr>

<tr>
  <td></td>
  <td><br /><button type="submit">{lng[Search]}</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a class="ajax_link" href="{$current_location}/admin/users/reset">{lng[Reset]}</a></td>
</tr>

</table>
</form>
<?php
}
?>
