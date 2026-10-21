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
{$email_header}

{lng[Hello]},

<p>{$userinfo['firstname']} {$userinfo['lastname']} has been placed a new message.</p>

<p>Ticket #{$ticket['ticketid']}</p>

<p>Priority: {php $mode='static'; $value=$ticket['priority'];}{include="common/ticket_priority.php"}</p>

<p>{lng[Full ticket]}<br />

<a href="{$http_location}/admin/ticket/{$ticket['ticketid']}">{$http_location}/admin/ticket/{$ticket['ticketid']}</a>
</p>

<p>{lng[Ticket subject]}: {$ticket['subject']}</p>

<hr style="border-bottom-width: 0;" />

{lng[Message]}:

<div style="margin: 1em 0;">{$message['message']}

<br /><br />

{$signature}
</div>
{include="mail/footer.php"}