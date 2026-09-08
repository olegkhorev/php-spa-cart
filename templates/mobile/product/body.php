{if $config['General']['recaptcha_key']}
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
{/if}

<div class="photo">
 <div id="zoom-mobile">
<?php
$image = $photos[0];
$image['new_width'] = 2000;
$image['new_height'] = 4000;
$image['link'] = 'Y';
include SITE_ROOT . '/includes/image.php';
?>
</div>
<table>
{if count($photos) > 1} {foreach $photos as $k=>$v}  {if $k == 0 || $k == 3 || $k == 7}
<tr>
{/if}
 <td>
<?php$image = $v;
$image['new_width'] = 95;
$image['new_height'] = 95;
$image['link'] = 'Y';
$image['blank'] = 'Y';
include SITE_ROOT . '/includes/image.php';
?>
 </td>
  {if $k == 2 || $k == 6}
</tr>
  {/if}
 {/foreach}

</tr>
{/if}
</table>
<script>
{if $oid == 1}
oid = 1;
qadd = '.product_popup ';
product_price_ql = "{$product['price']}";
product_weight_ql = "{$product['weight']}";
{else}
{php $oid = 0;}
oid = 0;
qadd = '';
product_price = "{$product['price']}";
product_weight = "{$product['weight']}";
{/if}
var product_avail = [];
product_avail[{$oid}] = {$product['avail']};
</script>
 </div>
<br />
 <div class="mobile-product-details">
{if $oid == 1} <div class="see_all"><a href="{$current_location}/{php echo $product['cleanurl'] ? $product['cleanurl'].'.html' : 'product/'.$product['productid'];}">{lng[See more details]}</a></div>
{/if}
 <h1 class="fn title">{$product['name']}</h1>
 <h1 class="fntitle hidden">{$product['name']}</h1>
<form name="product-details" action="{$current_location}/cart/add" onsubmit="return add_to_cart();">
<input type="hidden" name="productid" value="{$product['productid']}" />
<br />
<script>
{if $wholesale}
w_prices[{$oid}] = [];
 {foreach $wholesale as $k=>$v}
w_prices[{$oid}][{$k}] = [{$v['quantity']}, {$v['price']}];
 {/foreach}{else}
w_prices[{$oid}] = [];
{/if}

{if $options_ex}
 {foreach $options_ex as $k=>$v}exceptions[{$oid}][{$k}] = [];
  {foreach $v as $g=>$o}
exceptions[{$oid}][{$k}][{$g}] = {$o};
  {/foreach}
 {/foreach}
{else}
exceptions[{$oid}] = [];
{/if}
</script>
<h3>{lng[Product details]}</h3>
<table id="product-details">
{if $average_rating}
<tr>
 <td class="name">{lng[Rating]}:</td>
 <td class="value"><div class="rating-votes"><div style="width: {$average_rating}%;"></div></div></td>
</tr>
{/if}
<tr>
 <td class="name">{lng[SKU]}:</td>
 <td class="value product-sku">{$product['sku']}</td>
</tr>
{if $product['list_price'] > $product['price']}
{php $save_price = $product['list_price'] - $product['price'];}
{php $save_percentage = round(100 - 100 * $product['price'] / $product['list_price']);}
<tr>
 <td class="name">{lng[List price]}:</td>
 <td class="value product-list-price"><s>{price $product['list_price']}</s>, save {price $save_price} ({$save_percentage}%)</td>
</tr>
{/if}
<tr{if !$product['weight']} class="hidden"{/if}>
 <td class="name">{lng[Weight]}:</td>
 <td class="value product-weight">{weight $product['weight']}</td>
</tr>
</table>

{if $option_groups}<h3>{lng[Product options]}</h3>
{/if}

{if $variants}<div class="variants-data" style="display: none;">
<table><tbody><tr></tr></tbody></table>
</div>
<span id="hasVariants"></span>
<script>
{foreach $variants as $k=>$v} {php $k = $v['variantid'];}variants[{$oid}][{$k}] = ["{php echo escape($v['sku'], 2);}", {$v['price']}, {$v['weight']}, {$v['avail']}, {ldelim}{rdelim}, [], {$v['variantid']}, [], "{php echo escape($v['title'], 2);}"];
 {if $v['options']}
  {foreach $v['options'] as $k2=>$v2}
variants[{$oid}][{$k}][4][{$v2['groupid']}] = {$v2['optionid']};
  {/foreach}
 {/if}

 {if $v['images']}
  {foreach $v['images'] as $k2=>$v2}
<?php
$image = $v2;
$image['new_width'] = 95;
$image['new_height'] = 95;
$image['only_url'] = 'Y';
ob_start();
include SITE_ROOT . '/includes/variant_image.php';
$image_url = ob_get_clean();
?>
variants[{$oid}][{$k}][5][{$k2}] = "<a href='{$current_location}/photos/variant/{$v2['variantid']}/{$v2['imageid']}/{$v2['file']}' onclick='javascript: return switch_photo($(this));' rev='width: {$v2['x']}, height: {$v2['y']}'><img src='{$image_url}' alt='{php echo escape($v2['alt'], 3);}' /></a>";
  {/foreach}
 {/if}

 {if $v['wholesale']}
  {foreach $v['wholesale'] as $k2=>$v2}
variants[{$oid}][{$k}][7][{$k2}] = [{$v2['quantity']}, {$v2['price']}];
  {/foreach}
 {/if}
{/foreach}
</script>
{else}<script>
variants[{$oid}] = [];
</script>
{/if}

{if $option_groups}<script>
{foreach $option_groups as $k=>$v}groups[{$oid}][{$v['groupid']}] = [{$v['groupid']}, {$v['variant']}, "{$v['type']}", {ldelim}{rdelim}];
 {if $v['options']}  {foreach $v['options'] as $o}options[{$oid}][{$o['optionid']}] = "{php echo escape($o['name'], 2);}";
groups[{$oid}][{$v['groupid']}][3][{$o['optionid']}] = [{$o['price_modifier']}, "{$o['price_modifier_type']}", {$o['weight_modifier']}, "{$o['weight_modifier_type']}"];
  {/foreach} {/if}{/foreach}
</script>
<table class="product-options">
{php $cnt = 0;}
{foreach $option_groups as $k=>$v}<tr>

 <td class="product-option"><strong class="subtitle">{php echo $v['fullname'] ? $v['fullname'] : $v['name'];}<span id="pot-{$v['groupid']}"></span> <a href="javascript: void(0);" class="clear_option" id="poa-{$v['groupid']}">{lng[Clear]}</a></strong><br />
 {if $v['view_type'] == 's' && $v['options']}<select name="product_options[{$v['groupid']}]" id="po-{$v['groupid']}" class="product_options{if !$v['variant']} novar{/if}">
 <option></option>
{foreach $v['options'] as $o}
 <option value="{$o['optionid']}"{if $preselected[$v['groupid']] == $o['optionid']} selected{/if}>{$o['name']}
 {if !$v['variant']}
  {if $o['price_modifier'] != "0.00"}	{if $o['price_modifier_type'] == '%'}
{php $modifier = $o['price_modifier'] * $product["price"] / 100;}(+{price $modifier})
    {elseif $o['price_modifier_type'] == '$'}(+{price $o['price_modifier']})
    {/if}   {/if}
  {/if}
  </option>
{/foreach}
</select>

{elseif $v['view_type'] == 'p' && $v['options']}<div class="options_container{if !$v['variant']} novar{/if}" id="pog-{$v['groupid']}">
 {foreach $v['options'] as $o}<div class="option-name" id="poi-{$o['optionid']}" data-title="{php echo escape($o['name'], 2);}">{$o['name']}
  {if !$v['variant']}
   {if $o['price_modifier'] != "0.00"}
	{if $o['price_modifier_type'] == '%'}{php $modifier = $o['price_modifier'] * $product["price"] / 100;}
(+{price $modifier})
    {elseif $o['price_modifier_type'] == '$'}
(+{price $o['price_modifier']})
    {/if}
   {/if}
  {/if}
</div>
 {/foreach}
<div class="clear"></div>
</div>
<input type="hidden" name="product_options[{$v['groupid']}]" value="{php echo $preselected[$v['groupid']] ? $preselected[$v['groupid']] : "";}" id="po-{$v['groupid']}" />
{*
<?php
		} elseif ($v['view_type'] == 'r' && $v['options']) {?>
<ul id="po-{$v['groupid']}">
<?php
			foreach ($v['options'] as $k2=>$o) {
?>
  <li>
    <input type="radio" id="product_option_{$o['optionid']}" name="product_options[{$v['groupid']}]" value="{$o['optionid']}"{if $preselected[$v['groupid']] == $o['optionid']} checked{/if} class="product_options" />
    <label for="product_option_{$o['optionid']}">
      {$o['name']}
<?php
    			if (!$v['variant']) {
					if ($o['price_modifier'] != "0.00") {
						if ($o['price_modifier_type'] == '%') {
							echo '(+$'.price_format($o['price_modifier'] * $product["price"] / 100).')';
						} elseif ($o['price_modifier_type'] == '$') {
							echo '(+$'.$o['price_modifier'].')';
						}
					}
				}
?>
    </label>
  </li>
<?php
			}
?>
</ul>
*}
{elseif $v['view_type'] == 't'}<textarea name="product_options[{$v['groupid']}]">{$preselected[$v['groupid']]}</textarea>
{elseif $v['view_type'] == 'i'}
<input type="text" name="product_options[{$v['groupid']}]" value="{php echo escape($preselected[$v['groupid']], 2);}" />
{/if}
</td>
</tr>
{/foreach}

{*{if $cnt < 2}*}
</table>
{else}
<script>
groups[{$oid}] = [];
options[{$oid}] = [];
</script>
{/if}
<br />
<table class="product-to-cart">
<tr class="options-error">
 <td colspan="5" align="left">{lng[Please, select all options.]}</td>
</tr>
<tr>
 <td nowrap>
<input type="hidden" name="nongstprice" value="{$product['price']}" />
{lng[Price]}: <span class="product-details-price">{price $product['price']}</span>
 </td>
{if $product['avail'] > 0}
 <td>{lng[Qty]}:</td>
 <td id="quantity" class="quantity-box-container"><input type="text" size="3" name="amount" class="min[1],max[{$product['avail']}]" value="1" /></td>
 <td id="out_of_stock"{if $product['avail'] < 1} class="shown"{/if}>{lng[Out of stock]}</td>
 <td>
<input type="hidden" name="options_ex" value="" />
 <button class="add2cart" id="productid-{$product['productid']}">{lng[Add to cart]}</button>
 </td>
{else}
 <td class="out-of-stock"> &nbsp; {lng[Out of stock]}</td>
{/if}

</tr>
<tr>
 <td colspan="3">
<a class="main-button" onclick="javascript: return {if $login}add_wishlist({$product['productid']});{else}login_popup();{/if}" href="javascript: void(0);">{lng[Add to wishlist]}</a>
<br />
<a class="main-button" onclick="javascript: buy_one_click({$product['productid']});" href="javascript: void(0);">{lng[Buy with one click]}</a>
<br /><br />
 <div class="price-breaks">
<span>{lng[Wholesale Price Breaks]}</span>
<div><table></table><img src="images/spacer.gif" alt="" /></div>
</div>
 </td>
</tr>
</table>
{if !$oid}
<div class="social-buttons">
{assign $href = $http_location.'/'.$_SERVER['REQUEST_URI']}
	<div class="soc-item">
		<div class="fb-like" data-href="{$href}" data-send="true" data-layout="button_count" data-show-faces="false"></div>{*<div class="fb-send" data-href="{$href}"></div>*}
	</div>

	<div class="soc-item">
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="{$href}" data-count="horizontal">Tweet</a>
	</div>
</div>
{/if}
 </div>
</form>
{if $oid == 0}
<br />
<h2>{lng[Description]}</h2>
{php echo func_eol2br($product['descr']);}

{if $related_products}
<br />
<hr />
<br />
<h2>{lng[Related products]}</h2>
{php $products = $related_products; $per_row = 4;}
{include="common/products.php"}
{/if}

<br />
<hr />
<br />
<h2>{lng[Send to friend]}</h2>

{*
<form method="POST" id="send_to_friend">
<input type="hidden" name="mode" value="send_to_friend" />

  <table>
    <tr>
      <td class="name">{lng[Your name]}:</td>
      <td class="star">*</td>
      <td><input type="text" name="name" value="{php echo escape($send_to_friend['name'], 2);}" /></td>
    </tr>

    <tr>
      <td class="name">{lng[Your E-mail]}:</td>
      <td class="star">*</td>
      <td><input type="text" name="email" value="{php echo escape($send_to_friend['email'], 2);}" /></td>
    </tr>

    <tr>
      <td class="name">{lng[Friend E-mail]}:</td>
      <td class="star">*</td>
      <td><input type="text" name="friend" value="{php echo escape($send_to_friend['friend'], 2);}" /></td>
    </tr>

    <tr>
      <td colspan="2"></td>
      <td id="send_message_box"><label><input type="checkbox" id="is_msg" name="is_msg" value="1" onclick="javascript: $('#send_message_box div').toggle();" value="Y"{if $send_to_friend['is_msg']} checked{/if} />{lng[Add personal message]}</label>
        <div{if !$send_to_friend['is_msg']} class="hidden"{/if}>
          <textarea name="message">{$send_to_friend['message']}</textarea>
*}

<form method="POST" id="send_to_friend">
<input type="hidden" name="mode" value="send_to_friend" />

  <table>
    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <input type="text" name="name" required value="{php echo escape($send_to_friend['name'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Your name]}</label>
    </div>
      </td>
    </tr>

    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <input type="text" name="email" required value="{php echo escape($send_to_friend['email'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Your E-mail]}</label>
    </div>
      </td>
    </tr>

    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <input type="text" name="friend" required value="{php echo escape($send_to_friend['friend'], 2);}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Friend E-mail]}</label>
    </div>

      </td>
    </tr>

    <tr>
      <td colspan="2"></td>
      <td id="send_message_box"><label><input type="checkbox" id="is_msg" name="is_msg" value="1" onclick="javascript: $('.message-box').toggle();" value="Y"{if $send_to_friend['is_msg']} checked{/if} />{lng[Add personal message]}</label>
        <div class="message-box{if !$send_to_friend['is_msg']} hidden{/if}">
<br /><br />
    <div class="group">
      <textarea name="message">{$send_to_friend['message']}</textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Your message]}</label>
    </div>
        </div>
      </td>
    </tr>

{if $config['General']['recaptcha_key']}
	<tr>
		<td colspan="3"><div class="g-recaptcha" data-sitekey="{$config['General']['recaptcha_key']}"></div></td>
	</tr>
{/if}

    <tr>
      <td colspan="2">&nbsp;</td>
      <td><br /><button type="button" onclick="javascript: send_to_friend();">{lng[Send to friend]}</td>
    </tr>
  </table>
</form>

<br />
<hr />
<br />
<h2>{lng[Reviews]}</h2>
{if $reviews}
<div class="reviews-list">
{foreach $reviews as $r}
<div class="rating-votes"><div style="width: {php echo $r['rating'] * 100 / 5;}%;"></div></div>
<b>{$r['name']}</b>
<div class="message">
{php echo func_eol2br($r['message']);}
</div>
{/foreach}
</div>
<br />
{/if}

<h3>Add your review</h3>
<br />
<div id="tab-5">
<form method="POST" class="add-review">
<input type="hidden" name="mode" value="add_review" />
<input type="hidden" id="review_rating" name="rating" />
<input type="hidden" name="review_productid" value="{$product['productid']}" />
<table cellspacing="10">
    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td><div class="rating"><span class="r1"></span><span class="r2"></span><span class="r3"></span><span class="r4"></span><span class="r5"></span></div></td>
    </tr>

    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <input type="text" name="name" required />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Your name]}</label>
    </div>
      </td>
    </tr>

    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <textarea cols="40" rows="4" name="message"></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Your message]}</label>
    </div>
      </td>
    </tr>
{if $config['General']['recaptcha_key']}
	<tr>
		<td></td>
		<td colspan="2"><div id="recaptcha_reviews" data-sitekey="{$config['General']['recaptcha_key']}"></div></td>
	</tr>
{/if}
    <tr>
      <td colspan="2"></td>
      <td><br /><button type="button" onclick="javascript: add_review();">{lng[Add review]}</td>
    </tr>
</table>
</form>
</div>
{/if}