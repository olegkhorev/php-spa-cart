<div class="checkout-container">
<h1><a href="{$current_location}/cart" class="ajax_link back-to-cart"><img src="/images/back_arrow.png" alt="" /></a>{lng[Checkout]}</h1>

<div align="left">
<div class="cart-items">
{foreach $products as $v}
<div class="cart-item">
{if $v['gift_card']}
<b>Gift Card</b>
{else}
{php $url = $v['cleanurl'] ? $v['cleanurl'].'.html' : 'product/'.$v['productid'];}
<a class="name" href="{$current_location}/{$url}">{$v['name']}</a>
{/if}
{if $v['weight']}
<br /><small>{lng[Weight]}: {weight $v['weight']}</small>
{/if}
{if $v['product_options']}
<hr />
<b>{lng[Selected options]}:</b><br />
<table width="100%">
{foreach $v['product_options'] as $o}
<tr>
	<td width="100" valign="top">{$o['name']}:</td>
	<td>{$o['option']['name']}</td>
</tr>
{/foreach}
</table>
{/if}

<br />
<a href="{$current_location}/cart/remove/{$v['cartid']}" class="remove-link">{lng[Delete]}</a>
{if $v['gift_card']}
<div class="price">{price $v['amount']}</div>
{else}
{php $product_subtotal = $v['price'] * $v['quantity']}
<div class="price">{price $v['price']} * {$v['quantity']} = {price $product_subtotal}</div>
{/if}
</div>
{/foreach}
</div>
<hr />
{if !$login}
<br />
<div class="checkout-guest">
You can checkout as guest. Or <a href="/login">{lng[Login]}</a>, <a href="/register">{lng[Register]}</a>.
</div>
{/if}
<br />
{php $checkout_reason = func_check_checkout();}
{if $checkout_reason == 1}
<table>
<tr>
 <td width="300">
<form method="post" action="/checkout/user_form" id="checkout_user_form">
    <div class="group">
      <input type="text" name="posted_data[firstname]" required value="{php echo escape($userinfo['firstname'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[First name]}</label>
    </div>

    <div class="group">
      <input type="text" name="posted_data[lastname]" required value="{php echo escape($userinfo['lastname'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Last name]}</label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[phone]" required value="{php echo escape($userinfo['phone'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Phone]}</label>
    </div>
    <div class="group">
      <input type="text" name="posted_data[email]" required value="{php echo escape($userinfo['email'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Email]}</label>
    </div>
{*
    <div class="group">
      <input type="password" name="password" required value="" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Password]}</label>
    </div>
*}
    <div class="group">
      <input type="text" name="posted_data[address]" required value="{php echo escape($userinfo['address'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Address]}</label>
    </div>

    <div class="group">
      <input type="text" name="posted_data[city]" required value="{php echo escape($userinfo['city'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[City]}</label>
    </div>
    <div class="group group-select">
<label>{lng[State]}:</label>
<div>
{php $found = false;}
{foreach $countries as $v}
 {if $v['code'] == $userinfo['country'] && $v['states']}
  {php $found = true;}
<select name="posted_data[state]" id="state">
  {foreach $v['states'] as $s}
 <option value="{$s['code']}"{if $s['code'] == $userinfo['state']} selected{/if}>{$s['state']}</option>
   {/foreach}
</select>
 {/if}
{/foreach}

{if !$found}
<input type="text" name="posted_data[state]" id="state" value="{php echo escape($userinfo['state'], 2);}" />
{/if}
</div>
    </div>

    <div class="group group-select">
 <label>{lng[Country]}:</label>
<select name="posted_data[country]" id="country">
{foreach $countries as $v}
 <option value="{$v['code']}"{if $v['code'] == $userinfo['country'] || (!$userinfo['country'] && $v['code'] == 'US')} selected{/if}>{$v['country']}</option>
{/foreach}
</select>
    </div>

    <div class="group">
      <input type="text" name="posted_data[zipcode]" required value="{php echo escape($userinfo['zipcode'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Zip/Postal code]}</label>
    </div>

<button>{lng[Continue]}</button>
{*
<table cellpadding="2" class="checkout_user_table textinputs">
<tr>
 <td class="name">{lng[First name]}</td>
 <td><input type="text" name="posted_data[firstname]" value="<?php echo escape($userinfo['firstname']); ?>" /></td>
</td>
<tr>
 <td class="name">{lng[Last name]}</td>
 <td><input type="text" name="posted_data[lastname]" value="<?php echo escape($userinfo['lastname']); ?>" /></td>
</tr>
<tr>
 <td class="name">{lng[Phone]}</td>
 <td><input type="text" name="posted_data[phone]" value="<?php echo escape($userinfo['phone'], 2); ?>" /></td>
</tr>
<tr>
 <td class="name">{lng[Email]}</td>
 <td><input type="text" name="posted_data[email]" value="<?php echo escape($userinfo['email']); ?>" /></td>
</tr>
<tr>
 <td class="name">{lng[Address]}</td>
 <td><input type="text" name="posted_data[address]" value="<?php echo escape($userinfo['address']); ?>" /></td>
</tr>
<tr>
 <td class="name">{lng[City]}</td>
 <td><input type="text" name="posted_data[city]" value="<?php echo escape($userinfo['city']); ?>" /></td>
</tr>

<script>
var states = {ldelim}{rdelim};
	user_state = "{php echo escape($userinfo['state'], 2);}";
{foreach $countries as $v}
 {if $v['states']}
states.{$v['code']} = {states: []};
  {foreach $v['states'] as $k=>$s}
states.{$v['code']}.states[{$k}] = {code: "{$s['code']}", state: "{php echo escape($s['state'], 2);}"};
  {/foreach}
 {/if}
{/foreach}
</script>

<tr>
 <td class="name">{lng[State]}</td>
 <td>
{php $found = false;}
{foreach $countries as $v}
 {if $v['code'] == $userinfo['country'] && $v['states']}
  {php $found = true;}
<select name="posted_data[state]" id="state_checkout">
  {foreach $v['states'] as $s}
<option value="{$s['code']}"{if $s['code'] == $userinfo['state']} selected{/if}>{$s['state']}</option>
  {/foreach}
</select>
 {/if}
{/foreach}
{if !$found}
 <input type="text" name="posted_data[state]" id="state_checkout" value="{php echo escape($userinfo['state'], 2);}" /></td>
{/if}
</tr>

<tr>
 <td class="name">{lng[Country]}</td>
 <td>
<select name="posted_data[country]" id="country_checkout">
{foreach $countries as $v}
<option value="{$v['code']}"{if $v['code'] == $userinfo['country'] || (!$userinfo['country'] && $v['code'] == 'US')} selected{/if}>{$v['country']}</option>
{/foreach}
</select>
 </td>
</tr>

<tr>
 <td class="name">{lng[Zip/Postal code]}</td>
 <td><input type="text" name="posted_data[zipcode]" value="{php echo escape($userinfo['zipcode'], 2);}" /></td>
</tr>

<tr>
 <td></td>
 <td><br /><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">{lng[Continue]}</button></td>
</tr>
</table>
*}
</form>
</div>
 </td>
</tr>
<tr>
 <td width="300" id="place_order" style="opacity: .3;">
{include="checkout/right_part.php"}
 </td>
</tr>
</table>
{else}
{lng[Subtotal]}: {price $cart['subtotal']}<br /><br />
{$checkout_reason}
{/if}
</div>