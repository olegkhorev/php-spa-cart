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
{lng[Reply above here]}<br /><br />

{$email_header}

{lng[Hello]},

{if $product}
<p>Recently you asked a question about product {$product['sku']}<br />
<a href="{$current_location}/{if $product['cleanurl']}{$product['cleanurl']}.html{else}product/{$product['productid']}{/if}">{$product['name']}</a>
</p>
{/if}

<p>A new message on your ticket #{$ticket['ticketid']}</p>

{*{if $ticket['userid']}*}
<p>{lng[Full ticket]}<br />
<a href="{$http_location}/ticket/{$ticket['ticketid']}?authkey={$ticket['authkey']}">{$http_location}/ticket/{$ticket['ticketid']}?authkey={$ticket['authkey']}</a>
{*{/if}*}
</p>

<p>{lng[Ticket subject]}: {$ticket['subject']}</p>

<hr style="border-bottom-width: 0;" />

{if $product}
{lng[Our answer]}:
{else}
{lng[Replied Message]}:
{/if}

<div style="margin: 1em 0;">{$message['message']}

<br /><br />

{$signature}
</div>
{include="mail/footer.php"}