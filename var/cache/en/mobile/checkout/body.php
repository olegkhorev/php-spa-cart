<div class="checkout-container">
<h1><a href="<?php echo $current_location;?>/cart" class="ajax_link back-to-cart"><img src="/images/back_arrow.png" alt="" /></a>Checkout</h1>

<div align="left">
<div class="cart-items">
<?php foreach ($products as $v) {?>
<div class="cart-item">
<?php if ($v['gift_card']) {?>
<b>Gift Card</b>
<?php } else  { ?>
<?php $url = $v['cleanurl'] ? $v['cleanurl'].'.html' : 'product/'.$v['productid'];; ?>
<a class="name" href="<?php echo $current_location;?>/<?php echo $url;?>"><?php echo $v['name'];?></a>
<?php } ?>
<?php if ($v['weight']) {?>
<br /><small>Weight: <?php echo price_format($v['weight']).' <span class="weight-symbol">lbs</span>'; ?></small>
<?php } ?>
<?php if ($v['product_options']) {?>
<hr />
<b>Selected options:</b><br />
<table width="100%">
<?php foreach ($v['product_options'] as $o) {?>
<tr>
	<td width="100" valign="top"><?php echo $o['name'];?>:</td>
	<td><?php echo $o['option']['name'];?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

<br />
<a href="<?php echo $current_location;?>/cart/remove/<?php echo $v['cartid'];?>" class="remove-link">Delete</a>
<?php if ($v['gift_card']) {?>
<div class="price"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount']); ?></div>
<?php } else  { ?>
<?php $product_subtotal = $v['price'] * $v['quantity']; ?>
<div class="price"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?> * <?php echo $v['quantity'];?> = <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product_subtotal); ?></div>
<?php } ?>
</div>
<?php } ?>
</div>
<hr />
<?php if (!$login) {?>
<br />
<div class="checkout-guest">
You can checkout as guest. Or <a href="/login">Login</a>, <a href="/register">Register</a>.
</div>
<?php } ?>
<br />
<?php $checkout_reason = func_check_checkout();; ?>
<?php if ($checkout_reason == 1) {?>
<table>
<tr>
 <td width="300">
<form method="post" action="/checkout/user_form" id="checkout_user_form">
    <div class="group">
      <input type="text" name="posted_data[firstname]" required value="<?php echo escape($userinfo['firstname'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>First name</label>
    </div>

    <div class="group">
      <input type="text" name="posted_data[lastname]" required value="<?php echo escape($userinfo['lastname'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Last name</label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[phone]" required value="<?php echo escape($userinfo['phone'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Phone</label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[email]" required value="<?php echo escape($userinfo['email'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Email</label>
    </div>
<?php /* ?>
    <div class="group">
      <input type="password" name="password" required value="" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Password</label>
    </div>
<?php */ ?>
    <div class="group">
      <input type="text" name="posted_data[address]" required value="<?php echo escape($userinfo['address'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Address</label>
    </div>

    <div class="group">
      <input type="text" name="posted_data[city]" required value="<?php echo escape($userinfo['city'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>City</label>
    </div>
    <div class="group group-select">
<label>State:</label>
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
 <label>Country:</label>
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
      <label>Zip/Postal code</label>
    </div>

<button>Continue</button>
<?php /* ?>
<table cellpadding="2" class="checkout_user_table textinputs">
<tr>
 <td class="name">First name</td>
 <td><input type="text" name="posted_data[firstname]" value="<?php  echo escape($userinfo['firstname']); ?>" /></td>
</td>
<tr>
 <td class="name">Last name</td>
 <td><input type="text" name="posted_data[lastname]" value="<?php  echo escape($userinfo['lastname']); ?>" /></td>
</tr>
<tr>
 <td class="name">Phone</td>
 <td><input type="text" name="posted_data[phone]" value="<?php  echo escape($userinfo['phone'], 2); ?>" /></td>
</tr>
<tr>
 <td class="name">Email</td>
 <td><input type="text" name="posted_data[email]" value="<?php  echo escape($userinfo['email']); ?>" /></td>
</tr>
<tr>
 <td class="name">Address</td>
 <td><input type="text" name="posted_data[address]" value="<?php  echo escape($userinfo['address']); ?>" /></td>
</tr>
<tr>
 <td class="name">City</td>
 <td><input type="text" name="posted_data[city]" value="<?php  echo escape($userinfo['city']); ?>" /></td>
</tr>

<script>
var states = {};
	user_state = "<?php echo escape($userinfo['state'], 2);; ?>";
<?php foreach ($countries as $v) {?>
 <?php if ($v['states']) {?>
states.<?php echo $v['code'];?> = {states: []};
  <?php foreach ($v['states'] as $k=>$s) {?>
states.<?php echo $v['code'];?>.states[<?php echo $k;?>] = {code: "<?php echo $s['code'];?>", state: "<?php echo escape($s['state'], 2);; ?>"};
  <?php } ?>
 <?php } ?>
<?php } ?>
</script>

<tr>
 <td class="name">State</td>
 <td>
<?php $found = false;; ?>
<?php foreach ($countries as $v) {?>
 <?php if ($v['code'] == $userinfo['country'] && $v['states']) {?>
  <?php $found = true;; ?>
<select name="posted_data[state]" id="state_checkout">
  <?php foreach ($v['states'] as $s) {?>
<option value="<?php echo $s['code'];?>"<?php if ($s['code'] == $userinfo['state']) {?> selected<?php } ?>><?php echo $s['state'];?></option>
  <?php } ?>
</select>
 <?php } ?>
<?php } ?>
<?php if (!$found) {?>
 <input type="text" name="posted_data[state]" id="state_checkout" value="<?php echo escape($userinfo['state'], 2);; ?>" /></td>
<?php } ?>
</tr>

<tr>
 <td class="name">Country</td>
 <td>
<select name="posted_data[country]" id="country_checkout">
<?php foreach ($countries as $v) {?>
<option value="<?php echo $v['code'];?>"<?php if ($v['code'] == $userinfo['country'] || (!$userinfo['country'] && $v['code'] == 'US')) {?> selected<?php } ?>><?php echo $v['country'];?></option>
<?php } ?>
</select>
 </td>
</tr>

<tr>
 <td class="name">Zip/Postal code</td>
 <td><input type="text" name="posted_data[zipcode]" value="<?php echo escape($userinfo['zipcode'], 2);; ?>" /></td>
</tr>

<tr>
 <td></td>
 <td><br /><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Continue</button></td>
</tr>
</table>
<?php */ ?>
</form>
</div>
 </td>
</tr>
<tr>
 <td width="300" id="place_order" style="opacity: .3;">
<?php include SITE_ROOT."/var/cache/en/checkout/right_part.php";?>
 </td>
</tr>
</table>
<?php } else  { ?>
Subtotal: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($cart['subtotal']); ?><br /><br />
<?php echo $checkout_reason;?>
<?php } ?>
</div>