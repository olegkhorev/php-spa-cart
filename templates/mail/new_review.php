<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{include="mail/header.php"}
{lng[Hello]},<br /><br />
<p>{$name} {lng[posted new review]}</p>
{php $url = $current_location.($product['cleanurl'] ? '/'.$product['cleanurl'].'.html' : '/product/'.$product['productid']);}
<a href="{$url}">{$product['name']}</a><br />
<br />
{php $url = $current_location.'/admin/reviews';}
<a href="{$url}">Manage reviews</a><br />
<hr />
<b>Rating</b>: {$rating}<br /><br />
<b>Message</b>: {php echo func_eol2br($message);}
<br /><br />
{$signature}
{include="mail/footer.php"}