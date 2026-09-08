<a href="/admin/user/new">Создать нового пользователя <b class="translate"><span class="hidden word">Create new user account</span><span class="hidden translate-phrase">Создать нового пользователя</span>(Edit)</b></a><br /><br />
<form action="<?php echo $current_location;?>/admin/users/search" method="post" name="users_form">
<input type="hidden" name="mode" value="" />

<?php 
if ($get['2'] == 'search') {
?>
<a href="<?php echo $current_location;?>/admin/users" class="search_again">Повторный поиск <b class="translate"><span class="hidden word">Search again</span><span class="hidden translate-phrase">Повторный поиск</span>(Edit)</b></a>
<h3>Результаты поиска пользователя <b class="translate"><span class="hidden word">Users search results</span><span class="hidden translate-phrase">Результаты поиска пользователя</span>(Edit)</b></h3>
<?php 
if ($users) {
?>
<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<?php 
	echo '<br />';
}
?>

<table cellpadding="2" class="users_list lines-table">
<tr>
 <th width="10">&nbsp;</th>
 <th width="40%">Имя пользователя <b class="translate"><span class="hidden word">User name</span><span class="hidden translate-phrase">Имя пользователя</span>(Edit)</b></th>
 <th width="40%">Электронная почта пользователя <b class="translate"><span class="hidden word">User email</span><span class="hidden translate-phrase">Электронная почта пользователя</span>(Edit)</b></th>
 <th width="10%">Роль пользователя <b class="translate"><span class="hidden word">User role</span><span class="hidden translate-phrase">Роль пользователя</span>(Edit)</b></th>
 <th width="10%">Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></th>
</tr>
<?php 
foreach ($users as $k=>$v) {
?>
<tr>
 <td><input type="checkbox" name="to_delete[<?php  echo $v['id']; ?>]" /></td>
 <td><a href="<?php echo $current_location;?>/admin/user/<?php  echo $v['id']; ?>"><?php  echo $v['firstname'].' '.$v['lastname']; ?></a></td>
 <td><?php  echo $v['email']; ?></a></td>
 <td align="center"><?php  if ($v['usertype'] == 'A') {?>Администратор <b class="translate"><span class="hidden word">Administrator</span><span class="hidden translate-phrase">Администратор</span>(Edit)</b><?php } else  {?>Клиент <b class="translate"><span class="hidden word">Customer</span><span class="hidden translate-phrase">Клиент</span>(Edit)</b><?php } ?></a></td>
 <td>
<select name="status[<?php  echo $v['id']; ?>]">
<option value="1"<?php  if ($v['status'] == 1) echo ' selected="selected"'; ?>>Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></option>
<option value="0"<?php  if (empty($v['status'])) echo ' selected="selected"'; ?>>Не активен <b class="translate"><span class="hidden word">Not active</span><span class="hidden translate-phrase">Не активен</span>(Edit)</b></option>
</select>
 </td>
</tr>
<?php 
}
?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="submitForm(document.users_form, 'update');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
&nbsp;
<button type="button" onclick="submitForm(document.users_form, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
<?php 
} else  {
?>
Пользователи не найдены <b class="translate"><span class="hidden word">No users found</span><span class="hidden translate-phrase">Пользователи не найдены</span>(Edit)</b>
<?php 
}
} else  {
?>
<h3>Управление пользователями <b class="translate"><span class="hidden word">Users management</span><span class="hidden translate-phrase">Управление пользователями</span>(Edit)</b></h3><br />
<table cellpadding="2" cellspacing="1" class="users_management">
<tr>
 <td class="name">Искать <b class="translate"><span class="hidden word">Search for</span><span class="hidden translate-phrase">Искать</span>(Edit)</b></td>
 <td><input type="text" name="substring" value="<?php  echo escape($users_search['substring']); ?>" size="80" /></td>
</tr>

<tr>
 <td class="name">Поиск в <b class="translate"><span class="hidden word">Search in</span><span class="hidden translate-phrase">Поиск в</span>(Edit)</b></td>
 <td>
<label><input type="checkbox" name="firstname" value="1"<?php  if ($users_search['firstname']) echo ' checked="checked"'; ?> /> Имя <b class="translate"><span class="hidden word">First name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></label>
<label><input type="checkbox" name="lastname" value="1"<?php  if ($users_search['lastname']) echo ' checked="checked"'; ?> /> Фамилия <b class="translate"><span class="hidden word">Last name</span><span class="hidden translate-phrase">Фамилия</span>(Edit)</b></label>
<label><input type="checkbox" name="email" value="1"<?php  if ($users_search['email']) echo ' checked="checked"'; ?> /> Электронная почта <b class="translate"><span class="hidden word">Email</span><span class="hidden translate-phrase">Электронная почта</span>(Edit)</b></label>
 </td>
</tr>

<tr>
 <td class="name">Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></td>
 <td>
<select name="status">
<option value="">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
<option value="1"<?php  if ($users_search['status'] == 1) echo ' selected="selected"'; ?>>Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></option>
<option value="0"<?php  if ($users_search['status'] == '0') echo ' selected="selected"'; ?>>Не активен <b class="translate"><span class="hidden word">Not active</span><span class="hidden translate-phrase">Не активен</span>(Edit)</b></option>
</select>
 </td>
</tr>

<tr>
 <td class="name">Роль <b class="translate"><span class="hidden word">Role</span><span class="hidden translate-phrase">Роль</span>(Edit)</b></td>
 <td>
<select name="usertype">
<option value="">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
<option value="C"<?php  if ($users_search['usertype'] == 'C') echo ' selected="selected"'; ?>>Клиент <b class="translate"><span class="hidden word">Customer</span><span class="hidden translate-phrase">Клиент</span>(Edit)</b></option>
<option value="A"<?php  if ($users_search['usertype'] == 'A') echo ' selected="selected"'; ?>>Администратор <b class="translate"><span class="hidden word">Administrator</span><span class="hidden translate-phrase">Администратор</span>(Edit)</b></option>
</select>
 </td>
</tr>

<tr>
 <td class="name">Подписка <b class="translate"><span class="hidden word">Membership</span><span class="hidden translate-phrase">Подписка</span>(Edit)</b></td>
 <td>
<select name="membershipid">
<option value="0">Нет членства <b class="translate"><span class="hidden word">No membership</span><span class="hidden translate-phrase">Нет членства</span>(Edit)</b></option>
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
 <td class="name">Членство на рассмотрении <b class="translate"><span class="hidden word">Pending membership</span><span class="hidden translate-phrase">Членство на рассмотрении</span>(Edit)</b></td>
 <td>
<input type="checkbox" name="pending_membership" value="Y"<?php  if ($users_search['pending_membership'] == 'Y') echo ' checked="checked"'; ?> />
 </td>
</tr>

<tr>
  <td></td>
  <td><br /><button type="submit">Поиск <b class="translate"><span class="hidden word">Search</span><span class="hidden translate-phrase">Поиск</span>(Edit)</b></button></td>
</tr>

</table>
</form>
<?php 
}
?>
