<a href="/admin/user/new">Создать нового пользователя <b class="translate"><span class="hidden word">Create new user account</span><span class="hidden translate-phrase">Создать нового пользователя</span>(Edit)</b></a><br /><br />
<form method="post" name="user_form"<?php /* ?><?php if (!$user['id']) {?> class="noajax"<?php } ?><?php */ ?>>
<table cellpadding="2" class="user_table normal-table">
<tr>
 <td class="name">Имя <b class="translate"><span class="hidden word">First name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></td>
 <td><input type="text" name="posted_data[firstname]" value="<?php  echo escape($user['firstname']); ?>" /></td>
</td>
<tr>
 <td class="name">Фамилия <b class="translate"><span class="hidden word">Last name</span><span class="hidden translate-phrase">Фамилия</span>(Edit)</b></td>
 <td><input type="text" name="posted_data[lastname]" value="<?php  echo escape($user['lastname']); ?>" /></td>
</td>
<tr>
 <td class="name">Телефон <b class="translate"><span class="hidden word">Phone</span><span class="hidden translate-phrase">Телефон</span>(Edit)</b></td>
 <td><input type="text" name="posted_data[phone]" value="<?php  echo escape($user['phone']); ?>" /></td>
</td>
<tr>
 <td class="name">Электронная почта <b class="translate"><span class="hidden word">Email</span><span class="hidden translate-phrase">Электронная почта</span>(Edit)</b></td>
 <td><input type="text" name="posted_data[email]" value="<?php  echo escape($user['email']); ?>" /></td>
</td>
<tr>
 <td class="name">Пароль <b class="translate"><span class="hidden word">Password</span><span class="hidden translate-phrase">Пароль</span>(Edit)</b></td>
 <td><input type="password" name="password" value="" /></td>
</td>

<?php if ($userinfo['usertype'] == 'A' && $root_admin) {?>
<tr>
 <td class="name">Роль <b class="translate"><span class="hidden word">Role</span><span class="hidden translate-phrase">Роль</span>(Edit)</b></td>
 <td>
<select name="posted_data[usertype]">
<option value="C"<?php  if ($user['usertype'] == 'C') echo ' selected'; ?>>Клиент <b class="translate"><span class="hidden word">Customer</span><span class="hidden translate-phrase">Клиент</span>(Edit)</b></option>
<option value="A"<?php  if ($user['usertype'] == 'A') echo ' selected'; ?>>Администратор <b class="translate"><span class="hidden word">Administrator</span><span class="hidden translate-phrase">Администратор</span>(Edit)</b></option>
</select>
 </td>
</td>
<?php } ?>

<?php if ($userinfo['usertype'] == 'A' && $root_admin) {?>
<tr>
 <td class="name">Роль <b class="translate"><span class="hidden word">Role</span><span class="hidden translate-phrase">Роль</span>(Edit)</b></td>
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
 <td class="name">Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></td>
 <td>
<select name="posted_data[status]">
<option value="1"<?php  if ($user['status'] == 1) echo ' selected'; ?>>Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></option>
<option value="0"<?php  if (!$user['status'] && $user['email']) echo ' selected'; ?>>Не активен <b class="translate"><span class="hidden word">Not active</span><span class="hidden translate-phrase">Не активен</span>(Edit)</b></option>
</select>
 </td>
</tr>

<tr>
 <td class="name">Адрес <b class="translate"><span class="hidden word">Address</span><span class="hidden translate-phrase">Адрес</span>(Edit)</b></td>
 <td><input type="text" name="posted_data[address]" value="<?php  echo escape($user['address']); ?>" /></td>
</td>

<tr>
 <td class="name">Город <b class="translate"><span class="hidden word">City</span><span class="hidden translate-phrase">Город</span>(Edit)</b></td>
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
 <td class="name">Регион <b class="translate"><span class="hidden word">State</span><span class="hidden translate-phrase">Регион</span>(Edit)</b></td>
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
 <td class="name">Страна <b class="translate"><span class="hidden word">Country</span><span class="hidden translate-phrase">Страна</span>(Edit)</b></td>
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
 <td class="name">Почтовый индекс <b class="translate"><span class="hidden word">Zip/Postal code</span><span class="hidden translate-phrase">Почтовый индекс</span>(Edit)</b></td>
 <td><input type="text" name="posted_data[zipcode]" value="<?php  echo escape($user['zipcode']); ?>" /></td>
</td>

<tr>
 <td class="name">Членство на рассмотрении <b class="translate"><span class="hidden word">Pending membership</span><span class="hidden translate-phrase">Членство на рассмотрении</span>(Edit)</b></td>
 <td>
<select name="posted_data[pending_membershipid]">
<option value="0">Нет членства <b class="translate"><span class="hidden word">No membership</span><span class="hidden translate-phrase">Нет членства</span>(Edit)</b></option>
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
 <td class="name">Подписка <b class="translate"><span class="hidden word">Membership</span><span class="hidden translate-phrase">Подписка</span>(Edit)</b></td>
 <td>
<select name="posted_data[membershipid]">
<option value="0">Нет членства <b class="translate"><span class="hidden word">No membership</span><span class="hidden translate-phrase">Нет членства</span>(Edit)</b></option>
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
<button>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
</div>

</form>