<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<select name="{$name}">
<option value="0">{lng[No membership]}</option>
{if $memberships}
{foreach $memberships as $m}
<option value="{$m['membershipid']}"{if $value == $m['membershipid']} selected{/if}>{$m['membership']}</option>
{/foreach}
{/if}
</select>
