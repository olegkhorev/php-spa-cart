<div class="checkout-container">
<h1><a href="<?php echo $current_location;?>/cart" class="cart-link back-to-cart"><img src="/images/back_arrow.png" alt="" /></a>Заказать <b class="translate"><span class="hidden word">Checkout</span><span class="hidden translate-phrase">Заказать</span>(Edit)</b></h1>

<div align="left">
<table width="100%" cellspacing="0" class="checkout_products">
<?php foreach ($products as $v) {?>
<?php $url = $v['cleanurl'] ? $v['cleanurl'].'.html' : 'product/'.$v['productid'];; ?>
	<tr>
	 <td class="image"><a href="<?php echo $current_location;?>/<?php echo $url;?>">
<?php if ($v['variant_photo']) {?>
<?php 
		$image = $v['variant_photo'];
		$image['new_width'] = 100;
		$image['new_height'] = 100;
		include SITE_ROOT . '/includes/variant_image.php';
?>
<?php } else if ($v['photo']) {?>
<?php 
		$image = $v['photo'];
		$image['new_width'] = 100;
		$image['new_height'] = 100;
		include SITE_ROOT . '/includes/image.php';
?>
<?php } ?>

	  </a></td>
	  <td width="100%" class="line" align="left">
<?php if ($v['gift_card']) {?>
<b>Gift Card</b>
<?php } else  { ?>
<a href="<?php echo $current_location;?>/<?php echo $url;?>"><?php echo $v['name'];?></a>
<?php } ?>
<?php if ($v['weight']) {?>
<br />
<small>Вес <b class="translate"><span class="hidden word">Weight</span><span class="hidden translate-phrase">Вес</span>(Edit)</b>: <?php echo price_format($v['weight']).' <span class="weight-symbol">lbs</span>'; ?></small>
<?php } ?>
<?php if ($v['product_options']) {?>
<hr />
<b>Выбранные параметры <b class="translate"><span class="hidden word">Selected options</span><span class="hidden translate-phrase">Выбранные параметры</span>(Edit)</b>:</b><br />
<table width="100%">
<?php foreach ($v['product_options'] as $o) {?>
<tr>
	<td valign="top" width="100"><?php if ($o['fullname']) {?><?php echo $o['fullname'];?><?php } else  { ?><?php echo $o['name'];?><?php } ?>:</td>
	<td><?php echo $o['option']['name'];?></td>
</tr>
<?php } ?>
</table>
<?php } ?>
 </td>
 <td class="line" nowrap align="right">
<?php if ($v['gift_card']) {?>
<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount']); ?>
<?php } else  { ?>
<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?> x <?php echo $v['quantity'];?> = <?php $product_subtotal = $v['price'] * $v['quantity'];; ?><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product_subtotal); ?>
<?php } ?>
 </td>
</tr>
<?php } ?>
</table>

<br />
<hr />
<?php if (!$login) {?>
<br />
<div class="checkout-guest-mobile">
You can checkout as guest. Or <a href="/login">Логин <b class="translate"><span class="hidden word">Login</span><span class="hidden translate-phrase">Логин</span>(Edit)</b></a>, <a href="/register">Зарегистрироваться <b class="translate"><span class="hidden word">Register</span><span class="hidden translate-phrase">Зарегистрироваться</span>(Edit)</b></a>.
</div>

<div class="checkout-guest">
You can checkout as guest. Or <a href="/login" onclick="return login_popup();">Логин <b class="translate"><span class="hidden word">Login</span><span class="hidden translate-phrase">Логин</span>(Edit)</b></a>, <a href="/register" onclick="return register_popup();">Зарегистрироваться <b class="translate"><span class="hidden word">Register</span><span class="hidden translate-phrase">Зарегистрироваться</span>(Edit)</b></a>.
</div>
<?php } ?>
<br />
<?php $checkout_reason = func_check_checkout();; ?>
<?php if ($checkout_reason == 1) {?>
<table id="checkout_table">
<tr>
 <td width="340" id="custom_details">
<form method="post" action="/checkout/user_form" id="checkout_user_form">
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
<?php /* ?>
    <div class="group">
      <input type="password" name="password" required value="" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Пароль <b class="translate"><span class="hidden word">Password</span><span class="hidden translate-phrase">Пароль</span>(Edit)</b></label>
    </div>
<?php */ ?>
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

<script>
var states = {};
	user_state = "<?php echo escape($userinfo['state'], 2);; ?>",
	user_state_b = "<?php echo escape($userinfo['b_state'], 2);; ?>";
<?php foreach ($countries as $v) {?>
 <?php if ($v['states']) {?>
states.<?php echo $v['code'];?> = {states: []};
  <?php foreach ($v['states'] as $k=>$s) {?>
states.<?php echo $v['code'];?>.states[<?php echo $k;?>] = {code: "<?php echo $s['code'];?>", state: "<?php echo escape($s['state'], 2);; ?>"};
  <?php } ?>
 <?php } ?>
<?php } ?>
</script>

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

<label><input type="checkbox" id="same_address" name="same_address" value="1"<?php if ($userinfo['same_address'] || !$userinfo['firstname']) {?> checked<?php } ?> /> Платежный адрес такой же <b class="translate"><span class="hidden word">Billing address is the same</span><span class="hidden translate-phrase">Платежный адрес такой же</span>(Edit)</b></label>
<br /><br />
<div class="billing_address <?php if ($userinfo['same_address'] || !$userinfo['firstname']) {?> display-none<?php } else  { ?> display-block<?php } ?>">
<h1 class="checkout-h1">Платежный адрес <b class="translate"><span class="hidden word">Billing address</span><span class="hidden translate-phrase">Платежный адрес</span>(Edit)</b></h1><br />
    <div class="group">
      <input type="text" name="posted_data[b_firstname]" required value="<?php echo escape($userinfo['b_firstname'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Имя <b class="translate"><span class="hidden word">First name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></label>
    </div>

    <div class="group">
      <input type="text" name="posted_data[b_lastname]" required value="<?php echo escape($userinfo['b_lastname'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Фамилия <b class="translate"><span class="hidden word">Last name</span><span class="hidden translate-phrase">Фамилия</span>(Edit)</b></label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[b_phone]" required value="<?php echo escape($userinfo['b_phone'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Телефон <b class="translate"><span class="hidden word">Phone</span><span class="hidden translate-phrase">Телефон</span>(Edit)</b></label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[b_address]" required value="<?php echo escape($userinfo['b_address'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Адрес <b class="translate"><span class="hidden word">Address</span><span class="hidden translate-phrase">Адрес</span>(Edit)</b></label>
    </div>

    <div class="group">
      <input type="text" name="posted_data[b_city]" required value="<?php echo escape($userinfo['b_city'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Город <b class="translate"><span class="hidden word">City</span><span class="hidden translate-phrase">Город</span>(Edit)</b></label>
    </div>
    <div class="group group-select">
<label>Регион <b class="translate"><span class="hidden word">State</span><span class="hidden translate-phrase">Регион</span>(Edit)</b>:</label>
<div>
<?php $found = false;; ?>
<?php foreach ($countries as $v) {?>
 <?php if ($v['code'] == $userinfo['b_country'] && $v['states']) {?>
  <?php $found = true;; ?>
<select name="posted_data[b_state]" id="b_state">
  <?php foreach ($v['states'] as $s) {?>
 <option value="<?php echo $s['code'];?>"<?php if ($s['code'] == $userinfo['b_state']) {?> selected<?php } ?>><?php echo $s['b_state'];?></option>
   <?php } ?>
</select>
 <?php } ?>
<?php } ?>

<?php if (!$found) {?>
<input type="text" name="posted_data[b_state]" id="b_state" value="<?php echo escape($userinfo['b_state'], 2);; ?>" />
<?php } ?>
</div>
    </div>

    <div class="group group-select">
 <label>Страна <b class="translate"><span class="hidden word">Country</span><span class="hidden translate-phrase">Страна</span>(Edit)</b>:</label>
<select name="posted_data[b_country]" id="b_country">
<?php foreach ($countries as $v) {?>
 <option value="<?php echo $v['code'];?>"<?php if ($v['code'] == $userinfo['b_country'] || (!$userinfo['b_country'] && $v['code'] == 'US')) {?> selected<?php } ?>><?php echo $v['country'];?></option>
<?php } ?>
</select>
    </div>

    <div class="group">
      <input type="text" name="posted_data[b_zipcode]" required value="<?php echo escape($userinfo['b_zipcode'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Почтовый индекс <b class="translate"><span class="hidden word">Zip/Postal code</span><span class="hidden translate-phrase">Почтовый индекс</span>(Edit)</b></label>
    </div>

</div>

<button>Продолжить <b class="translate"><span class="hidden word">Continue</span><span class="hidden translate-phrase">Продолжить</span>(Edit)</b></button>
</form>
</div>
 </td>
 <td width="260" id="place_order" class="opacity-03">
<?php include SITE_ROOT."/var/cache/ru/checkout/right_part.php";?>
 </td>
</tr>
</table>
<?php } else  { ?>
Итого <b class="translate"><span class="hidden word">Subtotal</span><span class="hidden translate-phrase">Итого</span>(Edit)</b>: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['subtotal']); ?><br /><br />
<?php echo $checkout_reason;?>
<?php } ?>
</div>