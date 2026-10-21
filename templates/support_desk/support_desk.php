<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Support Desk]}</h1>
<div class="support_desk">
<br />

<div{if !$can_post_ticket} class="hidden1"{/if} id="post_ticket" style="text-align:right"><button class="button_ajax_link" href="/ticket">{lng[New ticket]}</button></div>

{if $tickets}

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<br />
<?php } ?>

<table style="border-spacing:0" class="support-desk-table">

<tr>
        <th style="padding:10px;text-align:center">#</th>
        <th style="padding:10px;text-align:left">&nbsp;{lng[Subject]}</th>
        <th style="padding:10px;width:150px;text-align:center">{lng[Status]}</th>
        <th style="padding:10px;width:150px;text-align:center">{lng[Date]}</th>
        <th style="padding:10px;width:150px;text-align:center">{lng[Actions]}</th>
</tr>

{foreach $tickets as $k=>$i}

<tr class="ticket-link{if $k % 2} tl-second{/if}">
        <td style="padding:10px;width:10px"><a href="/ticket/{$i['ticketid']}">{$i['ticketid']}</a>&nbsp;</td>
        <td style="padding:10px">&nbsp;<a href="/ticket/{$i['ticketid']}">{$i['subject']}</a>{if $i['read'] == "N" || $i['mread'] == "N"} <span style="color:#00AA00">({lng[new messages]})</span>{/if}</td>
        <td style="padding:10px" id="ticket-status-{$i['ticketid']}">{php $mode = "static"; $status=$i['status'];}{include="common/ticket_status.php"}</td>
        <td style="padding:10px;width:150px;text-align:center">{php echo date($datetime_format, $i['date']);}</td>
        <td style="padding:10px;text-align:right" id="ticket-status-links-{$i['ticketid']}">
        {if $i['status'] != '3' && $i['status'] != 'C'}
    	    &nbsp; <button type="button" class="close-ticket mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="javascript: if (confirmed || confirm('{lng[Are you sure?|escape]}', $(this))) close_ticket('{$i['ticketid']}', 1);">{lng[Close]}</button>
{*	        &nbsp; <a class="close-ticket" href="javascript: void(0);" onclick="javascript: if (confirmed || confirm('{lng[Are you sure?|escape]}', $(this))) close_ticket('{$i['ticketid']}', 2);"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">{lng[Cancel]}</button></a>*}
        {/if}
        </td>
</tr>
{/foreach}

</table>

<br />

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<br />
<?php } ?>

{else}
{lng[You have no tickets]}
{/if}

{*
{if $last_order}
<br /><hr /><br />
You are a current subscriber. Your subscription is valid until {php echo date($date_format, $renew_date);}
{if $userinfo['active_subscription']}
<br /><br />
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button" onclick="javascript: if (confirmed || confirm('{lng[Are you sure?|escape]}', $(this))) self.location='/support_desk/cancel';">{lng[Cancel subscription]}</button> - Your subscription still will be active, but you will not be charged at the end date.
{/if}
<br /><br />

{if !$can_post_ticket && !$userinfo['active_subscription']}
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='/subscribe';">{lng[Subscribe again]}</button>
{/if}

{/if}
*}
</div>