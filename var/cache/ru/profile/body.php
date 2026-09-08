<div class="tabs">
<a onclick="javascript: return profile_popup();" href="/profile"<?php if ($section != 'orders') {?> class="active"<?php } ?>>Ваш профиль <b class="translate"><span class="hidden word">Your profile</span><span class="hidden translate-phrase">Ваш профиль</span>(Edit)</b></a>
<a onclick="javascript: return profile_popup('/orders');" href="/profile/orders"<?php if ($section == 'orders') {?> class="active"<?php } ?>>История заказов <b class="translate"><span class="hidden word">Orders history</span><span class="hidden translate-phrase">История заказов</span>(Edit)</b></a>
</div>
<br />
<?php if ($section == 'orders') {?>
 <?php if ($orders) {?>
<table cellspacing="0" cellpadding="15">
  <?php foreach ($orders as $k=>$v) {?>
<tr>
 <td><a href="/invoice/<?php echo $v['orderid'];?>">#<?php echo $v['orderid'];?></a></td>
 <td><a href="/invoice/<?php echo $v['orderid'];?>"><?php echo $order_statuses[$v['status']];?></a></td>
 <td><a href="/invoice/<?php echo $v['orderid'];?>"><?php echo date($datetime_format, $v['date']);; ?></a></td>
 <td><a href="/invoice/<?php echo $v['orderid'];?>"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['total']); ?></a></td>
</tr>
  <?php } ?>
</table>
 <?php } else  { ?>
У вас еще нет заказов. <b class="translate"><span class="hidden word">You have no orders yet.</span><span class="hidden translate-phrase">У вас еще нет заказов.</span>(Edit)</b>
 <?php } ?>
<?php } else  { ?>
<center>
<form method="post" action="/profile" name="user_form" class="material-form">
    <div class="group">
      <input type="text" name="posted_data[firstname]" required value="<?php echo escape($userinfo['firstname'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Имя <b class="translate"><span class="hidden word">First name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></label>
    </div>

    <div class="group">
      <input type="text" name="posted_data[lastname]" required value="<?php echo escape($userinfo['lastname'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Фамилия <b class="translate"><span class="hidden word">Last name</span><span class="hidden translate-phrase">Фамилия</span>(Edit)</b></label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[phone]" required value="<?php echo escape($userinfo['phone'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Телефон <b class="translate"><span class="hidden word">Phone</span><span class="hidden translate-phrase">Телефон</span>(Edit)</b></label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[email]" required value="<?php echo escape($userinfo['email'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Электронная почта <b class="translate"><span class="hidden word">Email</span><span class="hidden translate-phrase">Электронная почта</span>(Edit)</b></label>
    </div>
    <div class="group">
      <input type="password" name="password" value="" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Пароль <b class="translate"><span class="hidden word">Password</span><span class="hidden translate-phrase">Пароль</span>(Edit)</b></label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[address]" required value="<?php echo escape($userinfo['address'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Адрес <b class="translate"><span class="hidden word">Address</span><span class="hidden translate-phrase">Адрес</span>(Edit)</b></label>
    </div>

    <div class="group">
      <input type="text" name="posted_data[city]" required value="<?php echo escape($userinfo['city'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Город <b class="translate"><span class="hidden word">City</span><span class="hidden translate-phrase">Город</span>(Edit)</b></label>
    </div>
    <div class="group group-select">
<label>Регион <b class="translate"><span class="hidden word">State</span><span class="hidden translate-phrase">Регион</span>(Edit)</b>:</label>
<div>
<?php $found = false;; ?>
<?php foreach ($countries as $v) {?>
 <?php if ($v['code'] == $userinfo['country'] && $v['states']) {?>
  <?php $found = true;; ?>
<select name="posted_data[state]" id="state">
  <?php foreach ($v['states'] as $s) {?>
 <option value="<?php echo $s['code'];?>"<?php if ($s['code'] == $userinfo['state']) {?> selected<?php } ?>><?php echo $s['state'];?></option>
   <?php } ?>
</select>
 <?php } ?>
<?php } ?>

<?php if (!$found) {?>
<input type="text" name="posted_data[state]" id="state" value="<?php echo escape($userinfo['state'], 2);; ?>" />
<?php } ?>
</div>
    </div>

    <div class="group group-select">
 <label>Страна <b class="translate"><span class="hidden word">Country</span><span class="hidden translate-phrase">Страна</span>(Edit)</b>:</label>
<select name="posted_data[country]" id="country">
<?php foreach ($countries as $v) {?>
 <option value="<?php echo $v['code'];?>"<?php if ($v['code'] == $userinfo['country'] || (!$userinfo['country'] && $v['code'] == 'US')) {?> selected<?php } ?>><?php echo $v['country'];?></option>
<?php } ?>
</select>
    </div>

    <div class="group">
      <input type="text" name="posted_data[zipcode]" required value="<?php echo escape($userinfo['zipcode'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Почтовый индекс <b class="translate"><span class="hidden word">Zip/Postal code</span><span class="hidden translate-phrase">Почтовый индекс</span>(Edit)</b></label>
    </div>

<?php if ($memberships) {?>
<?php if ($userinfo['membershipid']) {?>
    <div class="group">
      <input type="text" disabled value="<?php foreach ($memberships as $v) {?><?php if ($v['membershipid'] == $userinfo['membershipid']) {?><?php echo escape($v['membership'], 2);; ?><?php } ?><?php } ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Подписка <b class="translate"><span class="hidden word">Membership</span><span class="hidden translate-phrase">Подписка</span>(Edit)</b></label>
    </div>
<?php } ?>

<?php $name="pending_membershipid"; $value = $userinfo['pending_membershipid'];; ?>
    <div class="group group-select">
 <label>Оформить членство <b class="translate"><span class="hidden word">Sign up for membership</span><span class="hidden translate-phrase">Оформить членство</span>(Edit)</b>:</label>
<?php include SITE_ROOT."/var/cache/ru/common/membership.php";?>
    </div>
<?php } ?>

<div align="center"><button>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button></div>
<?php /* ?>
<table cellpadding="2" class="user_table textinputs">
<tr>
 <td class="name">Имя <b class="translate"><span class="hidden word">First name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b>:</td>
 <td><input type="text" name="posted_data[firstname]" value="<?php echo escape($userinfo['firstname'], 2);; ?>" /></td>
</td>
<tr>
 <td class="name">Фамилия <b class="translate"><span class="hidden word">Last name</span><span class="hidden translate-phrase">Фамилия</span>(Edit)</b>:</td>
 <td><input type="text" name="posted_data[lastname]" value="<?php echo escape($userinfo['lastname'], 2);; ?>" /></td>
</tr>
<tr>
 <td class="name">Телефон <b class="translate"><span class="hidden word">Phone</span><span class="hidden translate-phrase">Телефон</span>(Edit)</b>:</td>
 <td><input type="text" name="posted_data[phone]" value="<?php echo escape($user['phone'], 2);; ?>" /></td>
</tr>
<tr>
 <td class="name">Электронная почта <b class="translate"><span class="hidden word">Email</span><span class="hidden translate-phrase">Электронная почта</span>(Edit)</b>:</td>
 <td><input type="text" name="posted_data[email]" value="<?php echo escape($userinfo['email'], 2);; ?>" /></td>
</tr>

<tr>
 <td class="name">Пароль <b class="translate"><span class="hidden word">Password</span><span class="hidden translate-phrase">Пароль</span>(Edit)</b>:</td>
 <td><input type="password" name="password" value="" /></td>
</tr>
<tr>
 <td class="name">Адрес <b class="translate"><span class="hidden word">Address</span><span class="hidden translate-phrase">Адрес</span>(Edit)</b>:</td>
 <td><input type="text" name="posted_data[address]" value="<?php echo escape($userinfo['address'], 2);; ?>" /></td>
</tr>
<tr>
 <td class="name">Город <b class="translate"><span class="hidden word">City</span><span class="hidden translate-phrase">Город</span>(Edit)</b>:</td>
 <td><input type="text" name="posted_data[city]" value="<?php echo escape($userinfo['city'], 2);; ?>" /></td>
</tr>

<tr>
 <td class="name">Регион <b class="translate"><span class="hidden word">State</span><span class="hidden translate-phrase">Регион</span>(Edit)</b>:</td>
 <td>
<?php $found = false;; ?>
<?php foreach ($countries as $v) {?>
 <?php if ($v['code'] == $userinfo['country'] && $v['states']) {?>
  <?php $found = true;; ?>
<select name="posted_data[state]" id="state">
  <?php foreach ($v['states'] as $s) {?>
 <option value="<?php echo $s['code'];?>"<?php if ($s['code'] == $userinfo['state']) {?> selected<?php } ?>><?php echo $s['state'];?></option>
   <?php } ?>
</select>
 <?php } ?>
<?php } ?>

<?php if (!$found) {?>
<input type="text" name="posted_data[state]" id="state" value="<?php echo escape($userinfo['state'], 2);; ?>" /></td>
<?php } ?>
</tr>

<tr>
 <td class="name">Страна <b class="translate"><span class="hidden word">Country</span><span class="hidden translate-phrase">Страна</span>(Edit)</b>:</td>
 <td>
<select name="posted_data[country]" id="country">
<?php foreach ($countries as $v) {?>
 <option value="<?php echo $v['code'];?>"<?php if ($v['code'] == $userinfo['country'] || (!$userinfo['country'] && $v['code'] == 'US')) {?> selected<?php } ?>><?php echo $v['country'];?></option>
<?php } ?>
</select>
 </td>
</tr>

<tr>
 <td class="name">Почтовый индекс <b class="translate"><span class="hidden word">Zip/Postal code</span><span class="hidden translate-phrase">Почтовый индекс</span>(Edit)</b>:</td>
 <td><input type="text" name="posted_data[zipcode]" value="<?php echo escape($userinfo['zipcode'], 2);; ?>" /></td>
</tr>

<?php if ($memberships) {?>
<tr>
 <td colspan="2"><hr /></td>
</tr>
<?php if ($userinfo['membershipid']) {?>
<tr>
 <td class="name">Membership:</td>
 <td><?php foreach ($memberships as $v) {?><?php if ($v['membershipid'] == $userinfo['membershipid']) {?><?php echo $v['membership'];?><?php } ?><?php } ?></td>
</tr>
<?php } ?>

<?php $name="pending_membershipid"; $value = $userinfo['pending_membershipid'];; ?>
<tr>
 <td class="name">Sign up for membership:</td>
 <td><?php include SITE_ROOT."/var/cache/ru/common/membership.php";?></td>
</tr>
<?php } ?>

<tr>
 <td></td>
 <td><br /><button>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button></td>
</tr>
</table>
<?php */ ?>
</form>
<?php } ?>