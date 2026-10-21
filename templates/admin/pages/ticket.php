<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $ticket}
<h1>{lng[Ticket]} #{$ticket['ticketid']}</h1>
{else}
<h1>{lng[New estimate request]}</h1>
{/if}

{if $ticket}
<h3>{$ticket['subject']}</h3>
{else}
<h3>{lng[Ticket info]}</h3>
{/if}

<div style="text-align:right"><a href="/admin/support_desk?mode=search">{lng[Back to search results]}</a></div>

<form method="POST" name="ticketform" enctype="multipart/form-data"{* class="noajax"*}>
<input type="hidden" name="mode" value="">
<table style="width:100%" class="search_table search_table-support-desk">

{if $ticket}
<tr>
 <td class="td-align-right">{lng[Admin notes]}:</td>
 <td class="td-spacer" style="width:10px">&nbsp;</td>
 <td><textarea name="ticket[notes]" rows="10" cols="80" class="border-radius-25">{$ticket['notes']}</textarea></td>
</tr>
{php $name="ticket[type]"; $type=$ticket['type'];}
<tr>
        <td class="td-align-right">Type:</td>
        <td class="td-spacer" style="width:10px">&nbsp;</td>
        <td>{include="common/ticket_type.php"}
{if $product}
<a href="/admin/products/{$product['productid']}" target="_blank">{$product['name']}</a>
{/if}
        </td>
</tr>

{*
<tr>
	<td class="td-align-right">Ticket info:</td>
	<td class="td-spacer" style="width:10px">&nbsp;</td>
	<td>
{if $ticket_cats}
{php $ticket_cat = $ticket['cat1'].'|||'.$ticket['cat2'].'|||'.$ticket['cat3'].'|||'.$ticket['cat4'].'|||'.$ticket['cat5'];}
<select name="ticket_category">
{foreach $ticket_cats as $k=>$v}
<option value="{$k}"{if $k == $ticket_cat} selected{/if}>{$v}</option>
{/foreach}
</select>
<br />
{/if}
{if $ticket['fields']}
 {foreach $ticket['fields'] as $field=>$value}
 <br />
  {$field}: {$value}<br />
 {/foreach}
<br />
{/if}
	</td>
</tr>
*}
<tr>
        <td class="td-align-right">Date:</td>
        <td class="td-spacer" style="width:10px">&nbsp;</td>
        <td>{php echo date($datetime_format, $ticket['date']);}</td>
</tr>
{/if}
<tr>
        <td class="td-align-right">Priority:</td>
        <td class="td-spacer" style="width:10px">&nbsp;</td>
        <td>
        {php $name="ticket[priority]"; $value=$ticket['priority'];}
		{include="common/ticket_priority.php"}
        </td>
</tr>

<tr>
 <td class="td-align-right">{lng[Customer]}:</td>
 <td class="td-spacer" style="width:10px">&nbsp;</td>
 <td>
{if $ticket['userid']}
<a href="/admin/user/{$ticket['userid']}">{$ticket['customer']['firstname']} {$ticket['customer']['lastname']} ({$ticket['email']})</a>
{else}
{$ticket['email']}
{/if}
 </td>
</tr>

<tr>
 <td class="td-align-right">{lng[Ticket subject]}:</td>
 <td class="td-spacer" style="width:10px">&nbsp;</td>
 <td><input type="text" id="ticket_subject" name="ticket[subject]" size="85" value="{php echo escape($ticket['subject'], 2);}"></td>
</tr>


<tr>
 <td class="td-align-right">{lng[Ticket message]}:</td>
 <td class="td-spacer" style="width:10px">&nbsp;</td>
 <td><textarea name="ticket[message]" id="ticket_message" cols="85" rows="5" class="border-radius-25">{$ticket['message']}</textarea></td>
</tr>

<tr>
 <td class="td-align-right">{lng[Status]}:</td>
 <td class="td-spacer" style="width:10px">&nbsp;</td>
 <td>
{php $name="ticket[status]"; $status=$ticket['status'];}
{include="common/ticket_status.php"}
 </td>
</tr>

{if $ticket}
{if $ticket['attachments']}
<tr>
 <td class="td-align-right">{lng[Attached files]}:</td>
 <td class="td-spacer" style="width:10px">&nbsp;</td>
 <td>
{foreach $ticket['attachments'] as $a}<a href="{$current_location}/ticket/attachment/{$a['attachid']}">{$a['file_name']}</a> &nbsp; {/foreach}
<br />
 </td>
</tr>
{/if}
{else}
<tr>
 <td class="td-align-right">{lng[Attach files]}:</td>
 <td class="td-spacer" style="width:10px">&nbsp;</td>
 <td>
<table id="wp_table">
<tr id="f_tr">
        <td id="f_box_1"><input type="file" name="attachments[]"></td>
        <td>{include file="buttons/multirow_add.tpl" mark="f"}</td>
</tr>
</table>
 </td>
</tr>
{/if}

<tr>
 <td colspan="2"></td>
 <td>
<br />
<input type='button' value='{if !$ticket}{lng[Add|escape]}{else}{lng[Save|escape]}{/if}' onclick="javascript: submitForm(this, '');">
{if $ticket}
&nbsp;
<input type='button' value='{lng[Delete]}' onclick="if (confirm('{lng[Are you sure?]}', $(this)) || confirmed) submitForm(this, 'delete');">
{if $messages}
&nbsp;
<input type='button' value='{lng[Delete all messages]}' onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete_messages');">
{/if}
{/if}
 </td>
</tr>
</table>

</form>

<br /><br />
{if $tickets && $ticket}
<b>Move all messages to another ticket(will remove the current ticket):</b>
<select id="move_to">
<option value="">&nbsp;</option>
{foreach $tickets as $i}
<option value="{$i['ticketid']}">{$i['ticketid']} - {$i['subject']}</option>
{/foreach}
</select>
<button onclick="if (!$('#move_to').val()) return false; if (confirm('{lng[Are you sure?]}', $(this)) || confirmed) self.location='/admin/ticket/{$ticket['ticketid']}?mode=move&to='+$('#move_to').val();">Move</button>
{/if}

{if $ticket}
<br />
<a id="messages"></a>
<h3>{lng[Ticket messages]}</h3>

{if $messages}
<script>
function edit_message(id) {
        document.mesform.message.value=document.getElementById('message_'+id).innerHTML;
        document.mesform.messageid.value=id;
        document.mesform.mode.value='update_message';
        document.getElementById('update_message').disabled=false;
}
</script>

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<br />
<?php } ?>

<table style="width:100%" class="resp-table">
{foreach $messages as $i}
<tr>
 <td style="text-align:left"><label>{lng[Customer]}</label><a id="m{$i['messageid']}"></a>&nbsp;<a href="/admin/user/{$i['userid']}">{$i['firstname']} {$i['lastname']} ({$i['email']})</a>{if $i['ip']} (IP: {$i['ip']}){/if}</td>
 <td style="width:150px;text-align:right"><label>{lng[Date]}</label>{php echo date($datetime_format, $i['date']);}</td>
 <td style="width:200px;text-align:right"><a href="#add_new" onclick="javascript: edit_message('{$i['messageid']}')">Edit</a> / <a href="javascript: void(0);" onclick="javascript: confirm('{lng[Delete this message?]}', $(this), '/admin/ticket/{$ticket['ticketid']}?mode=delete_message&messageid={$i['messageid']}');">Delete</a>&nbsp;</td>
</tr>
<tr>
 <td><hr /><label>{lng[Message]}</label>{php echo func_eol2br($i['message']);}

<br />

{if $i['attachments']}
<br />
{foreach $i['attachments'] as $a}<a href="{$current_location}/ticket/attachment/{$a['attachid']}">{$a['file_name']}</a> &nbsp; {/foreach}
<br />
{/if}
 <br /><span id="message_{$i['messageid']}" class="display-none">{$i['message']}</span></td>
 <td colspan="2">
{if $tickets && $ticket}
Clone message to:
<select class="ticket_clone_to" id="move_to_{$i['messageid']}">
<option value="">&nbsp;</option>
{foreach $tickets as $t}
<option value="{$t['ticketid']}">{$t['ticketid']} - {$t['subject']}</option>
{/foreach}
</select>
<button onclick="if (!$('#move_to_{$i['messageid']}').val()) return false; if (confirm('{lng[Are you sure?]}', $(this)) || confirmed) self.location='/admin/ticket/{$ticket['ticketid']}?messageid={$i['messageid']}&mode=clone_message&to='+$('#move_to_{$i['messageid']}').val();">Clone</button>
{/if}
 </td>
</tr>
{/foreach}
</table>
{/if}

<h3>{lng[Add/Edit]}</h3>
<a id="add_new"></a>
<form method="POST" name="mesform" enctype="multipart/form-data"{* class="noajax"*}>
<input type="hidden" name="mode" value="add_message">
<input type="hidden" name="messageid">
<table style="width:600px" class="new-ticket-message-table">
<tr>
 <td><textarea cols="80" rows="10" name="message" class="border-radius-25"></textarea></td>
 <td>
<b>{lng[Upload files]}</b><br />
<input type="file" name="attachments[]"><br />
<input type="file" name="attachments[]"><br />
<input type="file" name="attachments[]">
 </td>
</tr>
<tr>
 <td style="text-align:right">
<input type="button" value="{lng[Save]}" onclick="javascript: submitForm(this, 'update_message');" id="update_message" disabled>&nbsp;
<input type="button" value="{lng[Add]}" onclick="javascript: submitForm(this, 'add_message');">&nbsp;
 </td>
 <td></td>
</tr>
</table>
</form>

{/if}
