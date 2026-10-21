<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Wishlist]}</h1>
{if $wishlist}
<table style="width:100%">
<tr>
 <th style="width:70%;text-align:left" colspan="2">{lng[Product]}</th>
 <th style="width:20%">{lng[Price]}</th>
 <td style="width:10%"></td>
</tr>
{foreach $wishlist as $v}
{php $url = $v['product']['cleanurl'] ? $v['product']['cleanurl'].'.html' : 'product/'.$v['product']['productid'];}
	<tr>
	 <td class="image"><a href="{$current_location}/{$url}">
	{if $v['product']['photo']}
{product_image image=`$v['product']['photo']` new_width=100 new_height=100}
	{/if}
	 </a></td>
	 <td><a href="{$current_location}/{$url}">{$v['product']['name']}</a></td>
	 <td style="text-align:center;vertical-align:middle">{price $v['product']['price']}</td>
	 <td><a href="{$current_location}/wishlist/remove/{$v['wlid']}" class="remove-wl-link">{lng[Delete]}</a></td>
	</tr>
{/foreach}
</table>
<br />
<hr />
<br />
<button type="button" class="clear-wl"<?php if (!$is_ajax) {
    echo ' onclick="self.location=\'wishlist/clear\'"';
} ?>>{lng[Clear wishlist]}</button>
{else}
<br />
{lng[Wishlist is empty]}
<br /><br />
{/if}