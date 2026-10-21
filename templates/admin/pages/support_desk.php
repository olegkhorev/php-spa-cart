<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $_GET['mode'] == "search" && $tickets}
<h1 class="products-title-h3">{lng[Support desk]} <a class="ajax_link link-button" href="/admin/support_desk">{lng[Search again]}</a></h1>
{else}
<h1>{lng[Support desk]}</h1>
{/if}

{if !$tickets}
<form name="searchform" action="/admin/support_desk/search" method="post" href="/admin/support_desk/?mode=search">

{php $empty='Y'; $name="posted_data[type]"; $type=$search_prefilled['type'];}
<table style="width:100%" class="search_table search_table-support-desk">
<tr>
        <td class="td-align-right">{lng[Ticket type]}</td>
        <td>{include="common/ticket_type.php"}</td>
</tr>
{if $ticket_cats}
<tr>
        <td class="td-align-right">{php $ticket_cat = $search_prefilled['cat1'].'|||'.$search_prefilled['cat2'].'|||'.$search_prefilled['cat3'].'|||'.$search_prefilled['cat4'].'|||'.$search_prefilled['cat5'];}Category:</td>
        <td>
<select name="posted_data[ticket_category]">
<option value="">All</option>
{foreach $ticket_cats as $k=>$v}
<option value="{$k}"{if $k == $ticket_cat} selected{/if}>{$v}</option>
{/foreach}
</select>
        </td>
</tr>
{/if}

<tr>
        <td class="td-align-right">{lng[Priority]}</td>
        <td>{php $empty='Y'; $name="posted_data[priority]"; $value=$search_prefilled['priority'];}{include="common/ticket_priority.php"}</td>
</tr>

<tr>
        <td class="td-align-right">{lng[Customer email]}</td>
        <td><input type='text' name='posted_data[email]' value="{php echo escape($search_prefilled['email'], 2);}" size="20"></td>
</tr>

<tr>
        <td class="td-align-right">{lng[Subject]}</td>
        <td><input type='text' name='posted_data[subject]' value="{php echo escape($search_prefilled['subject'], 2);}" size="80"></td>
</tr>

<tr>
        <td class="td-align-right">{lng[Message]}</td>
        <td><input type='text' name='posted_data[message]' value="{php echo escape($search_prefilled['message'], 2);}" size="80"></td>
</tr>
<tr>
        <td class="td-align-right">{lng[Status]}</td>
        <td>{php $name="posted_data[status]"; $empty='Y'; $status=$search_prefilled['status'];}{include="common/ticket_status.php"}</td>
</tr>

<tr>
        <td class="td-align-right">{lng[Ticket ID]}</td>
        <td>
<input type='text' name='posted_data[ticketid1]' value='{$search_prefilled['ticketid1']}' />
        </td>
</tr>

<tr>
        <td class="search_table_date_lbl td-align-right">{lng[Search by date]}</td>
        <td class="search_table_date_period">
<table style="border-collapse:collapse">
<tr>
        <td style="width:5px"><input type="radio" id="date_period_A" name="posted_data[date_period]" value="A"{if $search_prefilled['date_period'] == "" or $search_prefilled['date_period'] == "A"} checked="checked"{/if} /></td>
        <td><label for="date_period_A">{lng[All]}</label></td>
</tr>
<tr>
        <td style="width:5px"><input type="radio" id="date_period_M" name="posted_data[date_period]" value="M"{if $search_prefilled['date_period'] == "M"} checked="checked"{/if} /></td>
        <td><label for="date_period_M">{lng[This month]}</label></td>
</tr>
<tr>
        <td style="width:5px"><input type="radio" id="date_period_W" name="posted_data[date_period]" value="W"{if $search_prefilled['date_period'] == "W"} checked="checked"{/if} /></td>
        <td><label for="date_period_W">{lng[This week]}</label></td>
</tr>
<tr>
        <td style="width:5px"><input type="radio" id="date_period_D" name="posted_data[date_period]" value="D"{if $search_prefilled['date_period'] == "D"} checked="checked"{/if} /></td>
        <td><label for="date_period_D">{lng[Today]}</label></td>
</tr>
<tr>
        <td style="width:5px"><input type="radio" id="date_period_C" name="posted_data[date_period]" value="C"{if $search_prefilled['date_period'] == "C"} checked="checked"{/if} /></td>
        <td><label for="date_period_C">{lng[Specify period below]}</label></td>
</tr>
</table>
        </td>
</tr>

<tr>
        <td class="td-align-right" style="white-space:nowrap"></td>
        <td><input type="text" id="date_from" name="posted_data[date_from]" value="<?php echo $search_prefilled[
            "date_from"
        ]; ?>" autocomplete="off" />
<div class="date_from_to"> - </div>
        <input type="text" id="date_to" name="posted_data[date_to]" value="<?php echo $search_prefilled[
    "date_to"
]; ?>" autocomplete="off" /></td>
</tr>

<tr>
        <td></td>
        <td><label for="unread" style='cursor: pointer;'><input id="unread" type="checkbox" name="posted_data[unread]" value="Y"{if $search_prefilled['unread'] == "Y"} checked{/if}> &nbsp; {lng[Unread tickets]}</label></td>
</tr>

<tr>
        <td></td>
        <td><button type="submit">{lng[Search]}</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="/admin/support_desk/reset">Reset</a></td>
</tr>

</table>


</form>

<br />

{/if}


{if $_GET['mode'] == "search" && $tickets}

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<br />
<?php } ?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.ticketsform, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.ticketsform, 'to_delete', false);">{lng[Uncheck all]}</a>

<br /><br />

<form action="tickets.php" method="post" name="ticketsform">
<input type="hidden" name="mode" value="" />
{if $navigation_page > 1}
<input type="hidden" name="pagestr" value="&amp;page={$navigation_page}" />
{/if}


<table class="lines-table resp-table resp-table-no-margin">
<thead>
<tr>
        <th style="width:5px">&nbsp;</th>
        <th style="width:30px">#</th>
        <th style="width:100px">{lng[Status]}</th>
        <th style="width:100px">{lng[Type]}</th>
        <th>{lng[Subject]}</th>
        <th style="width:200px">{lng[Customer]}</th>
        <th style="width:70px">{lng[Messages]}</th>
        <th style="width:150px">{lng[Date]}</th>
        <th style="width:70px">{lng[Priority]}</th>
</tr>
</thead>
{foreach $tickets as $i}
<tr>
        <td><input type="checkbox" name="to_delete[{$i['ticketid']}]" /></td>
        <td><label>#</label><a href="/admin/ticket/{$i['ticketid']}">{$i['ticketid']}</a></td>
        <td class="no-word-break td-align-center"><label>{lng[Status]}</label>{php $mode = ''; $name="statuses[".$i['ticketid']."]"; $status=$i['status'];}{include="common/ticket_status.php"}</td>
        <td class="td-align-center"><label>{lng[Type]}</label>{php $mode='static'; $name="types[".$i['ticketid']."]"; $type=$i['type'];}{include="common/ticket_type.php"}</td>
        <td><label>{lng[Subject]}</label><a href="/admin/ticket/{$i['ticketid']}">{$i['subject']}{if $i['admin_read'] == 'N'} <span style="color:red">(Not read)</span>{/if}</a></td>
        <td class="td-align-center"><label>{lng[Customer]}</label>
{if $i['userid']}
        <a href="/admin/user/{$i['userid']}">{$i['customer']['firstname']} {$i['customer']['lastname']} ({$i['email']})</a>
{else}
{$i['email']}
{/if}
        </td>
        <td class="td-align-center"><label>{lng[Messages]}</label>{$i['count']}</td>
        <td class="td-align-center"><label>{lng[Date]}</label><a href="/admin/ticket/{$i['ticketid']}">{php echo date($datetime_format, $i['date']);}</a></td>
        <td class="td-align-center"><label>{lng[Priority]}</label>{php $mode="static"; $value=$i['priority'];}{include="common/ticket_priority.php"}</td>
</tr>
{/foreach}
</table>
<div class="fixed_save_button">
<input type="button" value="{lng[Update]}" onclick="javascript: submitForm(this, 'update');" /> <input type="button" value="{lng[Delete selected]}" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');" />
</div>
</form>

<br />

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<br />
<?php } ?>

{/if}

<br />

