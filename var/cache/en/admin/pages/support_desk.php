<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($_GET['mode'] == "search" && $tickets) {?>
<h1 class="products-title-h3">Support desk <a class="ajax_link link-button" href="/admin/support_desk">Search again</a></h1>
<?php } else  { ?>
<h1>Support desk</h1>
<?php } ?>

<?php if (!$tickets) {?>
<form name="searchform" action="/admin/support_desk/search" method="post" href="/admin/support_desk/?mode=search">

<?php $empty='Y'; $name="posted_data[type]"; $type=$search_prefilled['type'];; ?>
<table style="width:100%" class="search_table search_table-support-desk">
<tr>
        <td class="td-align-right">Ticket type</td>
        <td><?php include SITE_ROOT."/var/cache/en/common/ticket_type.php";?></td>
</tr>
<?php if ($ticket_cats) {?>
<tr>
        <td class="td-align-right"><?php $ticket_cat = $search_prefilled['cat1'].'|||'.$search_prefilled['cat2'].'|||'.$search_prefilled['cat3'].'|||'.$search_prefilled['cat4'].'|||'.$search_prefilled['cat5'];; ?>Category:</td>
        <td>
<select name="posted_data[ticket_category]">
<option value="">All</option>
<?php foreach ($ticket_cats as $k=>$v) {?>
<option value="<?php echo $k;?>"<?php if ($k == $ticket_cat) {?> selected<?php } ?>><?php echo $v;?></option>
<?php } ?>
</select>
        </td>
</tr>
<?php } ?>

<tr>
        <td class="td-align-right">Priority</td>
        <td><?php $empty='Y'; $name="posted_data[priority]"; $value=$search_prefilled['priority'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?></td>
</tr>

<tr>
        <td class="td-align-right">Customer email</td>
        <td><input type='text' name='posted_data[email]' value="<?php echo escape($search_prefilled['email'], 2);; ?>" size="20"></td>
</tr>

<tr>
        <td class="td-align-right">Subject</td>
        <td><input type='text' name='posted_data[subject]' value="<?php echo escape($search_prefilled['subject'], 2);; ?>" size="80"></td>
</tr>

<tr>
        <td class="td-align-right">Message</td>
        <td><input type='text' name='posted_data[message]' value="<?php echo escape($search_prefilled['message'], 2);; ?>" size="80"></td>
</tr>
<tr>
        <td class="td-align-right">Status</td>
        <td><?php $name="posted_data[status]"; $empty='Y'; $status=$search_prefilled['status'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?></td>
</tr>

<tr>
        <td class="td-align-right">Ticket ID</td>
        <td>
<input type='text' name='posted_data[ticketid1]' value='<?php echo $search_prefilled['ticketid1'];?>' />
        </td>
</tr>

<tr>
        <td class="search_table_date_lbl td-align-right">Search by date</td>
        <td class="search_table_date_period">
<table style="border-collapse:collapse">
<tr>
        <td style="width:5px"><input type="radio" id="date_period_A" name="posted_data[date_period]" value="A"<?php if ($search_prefilled['date_period'] == "" or $search_prefilled['date_period'] == "A") {?> checked="checked"<?php } ?> /></td>
        <td><label for="date_period_A">All</label></td>
</tr>
<tr>
        <td style="width:5px"><input type="radio" id="date_period_M" name="posted_data[date_period]" value="M"<?php if ($search_prefilled['date_period'] == "M") {?> checked="checked"<?php } ?> /></td>
        <td><label for="date_period_M">This month</label></td>
</tr>
<tr>
        <td style="width:5px"><input type="radio" id="date_period_W" name="posted_data[date_period]" value="W"<?php if ($search_prefilled['date_period'] == "W") {?> checked="checked"<?php } ?> /></td>
        <td><label for="date_period_W">This week</label></td>
</tr>
<tr>
        <td style="width:5px"><input type="radio" id="date_period_D" name="posted_data[date_period]" value="D"<?php if ($search_prefilled['date_period'] == "D") {?> checked="checked"<?php } ?> /></td>
        <td><label for="date_period_D">Today</label></td>
</tr>
<tr>
        <td style="width:5px"><input type="radio" id="date_period_C" name="posted_data[date_period]" value="C"<?php if ($search_prefilled['date_period'] == "C") {?> checked="checked"<?php } ?> /></td>
        <td><label for="date_period_C">Specify period below</label></td>
</tr>
</table>
        </td>
</tr>

<tr>
        <td class="td-align-right" style="white-space:nowrap"></td>
        <td><input type="text" id="date_from" name="posted_data[date_from]" value="<?php  echo $search_prefilled[
            "date_from"
        ]; ?>" autocomplete="off" />
<div class="date_from_to"> - </div>
        <input type="text" id="date_to" name="posted_data[date_to]" value="<?php  echo $search_prefilled[
    "date_to"
]; ?>" autocomplete="off" /></td>
</tr>

<tr>
        <td></td>
        <td><label for="unread" style='cursor: pointer;'><input id="unread" type="checkbox" name="posted_data[unread]" value="Y"<?php if ($search_prefilled['unread'] == "Y") {?> checked<?php } ?>> &nbsp; Unread tickets</label></td>
</tr>

<tr>
        <td></td>
        <td><button type="submit">Search</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="/admin/support_desk/reset">Reset</a></td>
</tr>

</table>


</form>

<br />

<?php } ?>


<?php if ($_GET['mode'] == "search" && $tickets) {?>

<?php  if ($total_pages > 2) { ?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php  } ?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.ticketsform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.ticketsform, 'to_delete', false);">Uncheck all</a>

<br /><br />

<form action="tickets.php" method="post" name="ticketsform">
<input type="hidden" name="mode" value="" />
<?php if ($navigation_page > 1) {?>
<input type="hidden" name="pagestr" value="&amp;page=<?php echo $navigation_page;?>" />
<?php } ?>


<table class="lines-table resp-table resp-table-no-margin">
<thead>
<tr>
        <th style="width:5px">&nbsp;</th>
        <th style="width:30px">#</th>
        <th style="width:100px">Status</th>
        <th style="width:100px">Type</th>
        <th>Subject</th>
        <th style="width:200px">Customer</th>
        <th style="width:70px">Messages</th>
        <th style="width:150px">Date</th>
        <th style="width:70px">Priority</th>
</tr>
</thead>
<?php foreach ($tickets as $i) {?>
<tr>
        <td><input type="checkbox" name="to_delete[<?php echo $i['ticketid'];?>]" /></td>
        <td><label>#</label><a href="/admin/ticket/<?php echo $i['ticketid'];?>"><?php echo $i['ticketid'];?></a></td>
        <td class="no-word-break td-align-center"><label>Status</label><?php $mode = ''; $name="statuses[".$i['ticketid']."]"; $status=$i['status'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?></td>
        <td class="td-align-center"><label>Type</label><?php $mode='static'; $name="types[".$i['ticketid']."]"; $type=$i['type'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_type.php";?></td>
        <td><label>Subject</label><a href="/admin/ticket/<?php echo $i['ticketid'];?>"><?php echo $i['subject'];?><?php if ($i['admin_read'] == 'N') {?> <span style="color:red">(Not read)</span><?php } ?></a></td>
        <td class="td-align-center"><label>Customer</label>
<?php if ($i['userid']) {?>
        <a href="/admin/user/<?php echo $i['userid'];?>"><?php echo $i['customer']['firstname'];?> <?php echo $i['customer']['lastname'];?> (<?php echo $i['email'];?>)</a>
<?php } else  { ?>
<?php echo $i['email'];?>
<?php } ?>
        </td>
        <td class="td-align-center"><label>Messages</label><?php echo $i['count'];?></td>
        <td class="td-align-center"><label>Date</label><a href="/admin/ticket/<?php echo $i['ticketid'];?>"><?php echo date($datetime_format, $i['date']);; ?></a></td>
        <td class="td-align-center"><label>Priority</label><?php $mode="static"; $value=$i['priority'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?></td>
</tr>
<?php } ?>
</table>
<div class="fixed_save_button">
<input type="button" value="Update" onclick="javascript: submitForm(this, 'update');" /> <input type="button" value="Delete selected" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');" />
</div>
</form>

<br />

<?php  if ($total_pages > 2) { ?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php  } ?>

<?php } ?>

<br />

