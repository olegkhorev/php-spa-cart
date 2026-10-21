<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if !$predefined}
{php $predefined = array();}
{/if}
{if $ticket}
<h1>{lng[Ticket]} #{$ticket['ticketid']} (<span id="ticket-status-{$ticket['ticketid']}">{php $mode = "static"; $status=$ticket['status'];}{include="common/ticket_status.php"}</span>)</h1>
<br />
{/if}

{if !$ticket}
{if $config['General']['recaptcha_key']}
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
{/if}

<form action="/ticket{if $_GET['productid']}?productid={$_GET['productid']}{/if}" method="POST" name="ticketform" enctype="multipart/form-data" class="ajax-form">
<input type="hidden" name="mode" value="">
<input type="hidden" name="productid" value="{$product['productid']}">

<h1>{lng[New ticket]}</h1>
<br />

<div class="ticket-div">
{if !$login}
 <div class="group">
  <input type="text" name="email" id="ticket_email" value="{php echo escape($predefined['email'], 2);}">
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>{lng[Email]}</label>
 </div>
{/if}

 {php $name="priority"; $value=$predefined['priority'];}
 <div class="group group-select">
  {include="common/ticket_priority.php"}
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>{lng[Ticket priority]}</label>
 </div>

 <div class="group">
  <input type="text" name="subject" id="ticket_subject" value="{php echo escape($predefined['subject'], 2);}">
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>{lng[Subject]}</label>
 </div>

 <div class="group">
  <textarea name="message" id="ticket_message">{$predefined['message']}</textarea>
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>{lng[Message]}</label>
 </div>

 <div class="group">
  <input size="40" type="file" name="attachments[]">
  <span class="highlight"></span>
  <span class="bar"></span>
 </div>

 <div class="error-cc3300"><b id="error_mes">{lng[Please, select all categories, enter your subject and message]}</b></div>

{if $config['General']['recaptcha_key']}
<br />
<div id="recaptcha_ticket" data-sitekey="{$config['General']['recaptcha_key']}"></div><br />
{/if}

<button type="button" onclick="submit_ticket();">{lng[Create ticket]}</button>

</div>
</form>

{else}

<a id="messages"></a>

<div style="text-align:right">
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='/support_desk'">{lng[Support Desk]}</button>
&nbsp;
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='/ticket'">{lng[Create request]}</button>
<span id="ticket-status-links-{$ticket['ticketid']}">
        {if $ticket['status'] != '3' && $ticket['status'] != 'C'}
    	    &nbsp; <button type="button" class="close-ticket mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="javascript: if (confirmed || confirm('{lng[Are you sure?|escape]}', $(this))) close_ticket('{$ticket['ticketid']}', 1);">{lng[Close]}</button>
	        &nbsp; <button type="button" class="close-ticket mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="javascript: if (confirmed || confirm('{lng[Are you sure?|escape]}', $(this))) close_ticket('{$ticket['ticketid']}', 2);">{lng[Cancel]}</button>
        {/if}
</span>
</div>

<script>
<!--
function original_message(id) {
	var elm = document.getElementById('original_message');
	if (elm.style.display == 'none')
		elm.style.display = 'block';
	else
		elm.style.display = 'none';
}
-->
</script>
<br />

{if $messages}
<table style="border-collapse:collapse;width:100%">

{foreach $messages as $i}
<tr>
 <th style="text-align:left"><a id="m{$i['messageid']}"></a>&nbsp;{$i['firstname']} {$i['lastname']}</th>
 <th style="text-align:right">{php echo date($datetime_format, $i['date']);}&nbsp;</th>
</tr>
<tr>
 <td colspan="2" class="ticket-message">{php echo func_eol2br($i['message']);}<br />
{if $i['attachments']}
<i>{lng[Attached files]}:</i>
{foreach $i['attachments'] as $a}<a href="{$current_location}/ticket/attachment/{$a['attachid']}">{$a['file_name']}</a> &nbsp; {/foreach}
<br />
{/if}
<br /><span id="message_{$i['messageid']}" class="display-none">{$i['message']}</span></td>
</tr>
{/foreach}

</table>
{/if}
<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<br />
<?php } ?>

<div id="original_message">
<h3>{lng[Request information]}</h3>
<br />
{if $ticket['cat1']}Category: {$ticket['cat1']}{/if}
{if $ticket['cat2']} &gt; {$ticket['cat2']}{/if}
{if $ticket['cat3']} &gt; {$ticket['cat3']}{/if}
{if $ticket['cat4']} &gt; {$ticket['cat4']}{/if}
{if $ticket['cat5']} &gt; {$ticket['cat5']}{/if}
<br />
{if $ticket['fields']}
<br />
<table style="width:100%">
 {foreach $ticket['fields'] as $field=>$value}
  <tr>
   <td style="width:200px;vertical-align:top"><u>{$field}</u>:</td>
   <td style="vertical-align:top">{$value}</td>
  </tr>
 {/foreach}

</table>
{/if}

Subject: {$ticket['subject']}<br />
Priority: {php $mode="static"; $name="priority"; $value=$ticket['priority'];}{include="common/ticket_priority.php"}<br />
<br />
Message:<br />
{php echo func_eol2br($ticket['message']);}<br />

<br />
{if $ticket['attachments']}<i>{lng[Attached files]}:</i>
{foreach $ticket['attachments'] as $a}<a href="{$current_location}/ticket/attachment/{$a['attachid']}">{$a['file_name']}</a> &nbsp; {/foreach}
<br />
{/if}
</div>

{if $ticket['status'] != '3' && $ticket['status'] != 'C'}
<br />
<h3>{lng[Post new message]}</h3>
<a id="create_new"></a>
<form method="POST" name="mesform" id="ticketmesform" action="/ticket/{$ticket['ticketid']}" enctype="multipart/form-data" class="ajax-form">
<input type="hidden" name="mode" value="create_new">

<table style="border-collapse:collapse;width:100%">
<tr>
 <td style="width:400px;vertical-align:top"><textarea cols="52" rows="7" name="message" id="post_new_message"></textarea></td>
 <td style="vertical-align:top"><b>{lng[Upload file]}</b><br />
<input size="40" type="file" name="attachments[]">
 </td>
</tr>
<tr>
 <td><div id="error_mes"><b>{lng[Please, enter ticket message]}</b></div></td>
 <td style="text-align:right"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">{lng[Send message]}</button>&nbsp;</td>
</tr>
</table>
</form>
{/if}

{/if}
