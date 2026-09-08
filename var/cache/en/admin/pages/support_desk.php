<?php if (!$tickets) {?>

<br />

<h3>Search for tickets</h3>

<form name="searchform" action="/admin/support_desk/search" method="post" href="/admin/support_desk/?mode=search">

<table cellpadding="4" cellspacing="0" width="100%">

<?php $empty='Y'; $name="posted_data[type]"; $type=$search_prefilled['type'];; ?>
<tr>
        <td align='right'>Type:</td>
        <td width="10">&nbsp;</td>
        <td><?php include SITE_ROOT."/var/cache/en/common/ticket_type.php";?></td>
</tr>

<?php if ($ticket_cats) {?>
<?php $ticket_cat = $search_prefilled['cat1'].'|||'.$search_prefilled['cat2'].'|||'.$search_prefilled['cat3'].'|||'.$search_prefilled['cat4'].'|||'.$search_prefilled['cat5'];; ?>
<tr>
        <td align='right'>Category:</td>
        <td width="10">&nbsp;</td>
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

<?php $empty='Y'; $name="posted_data[priority]"; $value=$search_prefilled['priority'];; ?>
<tr>
        <td align='right'>Priority:</td>
        <td width="10">&nbsp;</td>
        <td><?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?></td>
</tr>

<tr>
        <td align='right'>Customer email:</td>
        <td width="10">&nbsp;</td>
        <td><input type='text' name='posted_data[email]' value="<?php echo escape($search_prefilled['email'], 2);; ?>" size="20"></td>
</tr>

<tr>
        <td align='right'>Subject:</td>
        <td width="10">&nbsp;</td>
        <td><input type='text' name='posted_data[subject]' value="<?php echo escape($search_prefilled['subject'], 2);; ?>" size="80"></td>
</tr>

<tr>
        <td align='right'>Message:</td>
        <td width="10">&nbsp;</td>
        <td><input type='text' name='posted_data[message]' value="<?php echo escape($search_prefilled['message'], 2);; ?>" size="80"></td>
</tr>
<?php $name="posted_data[status]"; $empty='Y'; $status=$search_prefilled['status'];; ?>
<tr>
        <td align='right'>Status:</td>
        <td width="10">&nbsp;</td>
        <td><?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?></td>
</tr>

<tr>
        <td align='right'>Ticket ID:</td>
        <td width="10">&nbsp;</td>
        <td>
<input type='text' name='posted_data[ticketid1]' value='<?php echo $search_prefilled['ticketid1'];?>' size="7">
        </td>
</tr>

<tr>
        <td align='right'>During date period:</td>
        <td width="10">&nbsp;</td>
        <td>
<table cellpadding="0" cellspacing="0">
<tr>
        <td width="5"><input type="radio" id="date_period_A" name="posted_data[date_period]" value="A"<?php if ($search_prefilled['date_period'] == "" or $search_prefilled['date_period'] == "A") {?> checked="checked"<?php } ?> /></td>
        <td class="OptionLabel"><label for="date_period_A">All</label></td>

        <td width="5"><input type="radio" id="date_period_M" name="posted_data[date_period]" value="M"<?php if ($search_prefilled['date_period'] == "M") {?> checked="checked"<?php } ?> /></td>
        <td class="OptionLabel"><label for="date_period_M">This month</label></td>

        <td width="5"><input type="radio" id="date_period_W" name="posted_data[date_period]" value="W"<?php if ($search_prefilled['date_period'] == "W") {?> checked="checked"<?php } ?> /></td>
        <td class="OptionLabel"><label for="date_period_W">This week</label></td>

        <td width="5"><input type="radio" id="date_period_D" name="posted_data[date_period]" value="D"<?php if ($search_prefilled['date_period'] == "D") {?> checked="checked"<?php } ?> /></td>
        <td class="OptionLabel"><label for="date_period_D">Today</label></td>
</tr>
<tr>
        <td width="5"><input type="radio" id="date_period_C" name="posted_data[date_period]" value="C"<?php if ($search_prefilled['date_period'] == "C") {?> checked="checked"<?php } ?> /></td>
        <td colspan="9" class="OptionLabel"><label for="date_period_C">Specify period below</label></td>
</tr>
</table>
        </td>
</tr>

<tr>
        <td align="right" nowrap="nowrap">Search period:</td>
        <td width="10">&nbsp;</td>
        <td><input type="text" id="date_from" name="posted_data[date_from]" value="<?php  echo $search_prefilled['date_from']; ?>" size="7" /> - <input type="text" id="date_to" name="posted_data[date_to]" value="<?php  echo $search_prefilled['date_to']; ?>" size="7" /></td>
</tr>

<tr>
        <td></td>
        <td><input id="unread" type="checkbox" name="posted_data[unread]" value="Y"<?php if ($search_prefilled['unread'] == "Y") {?> checked<?php } ?>></td>
        <td><label for="unread" style='cursor: pointer;'>Unread tickets</label></td>
</tr>

<tr>
        <td colspan='2'</td>
        <td><input type="submit" value="Search" />&nbsp;&nbsp;&nbsp;<input type="button" value="Reset" onclick="javascript: self.location='/admin/support_desk/reset';" /></td>
</tr>

</table>


</form>

<br />

<?php } ?>


<?php if ($_GET['mode'] == "search" && $tickets) {?>

<a name="results"></a>

<?php if ($_GET['mode'] == "search") {?>
<?php if ($total_items > "0") {?>
Results found: <?php echo $total_items;?><br />
Displaying <?php echo $first_item;?>-<?php echo $last_item;?> results
<?php } else  { ?>
No tickets found
<?php } ?>
<?php } ?>

<br /><br />

<h3>Search results</h3>

<div align="right"><a href="/admin/support_desk/">Search again</a></div>

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php 
}
?>

<br /><a href="javascript: void(0);" onclick="javascript: check_all(document.ticketsform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.ticketsform, 'to_delete', false);">Uncheck all</a>

<form action="tickets.php" method="post" name="ticketsform">
<input type="hidden" name="mode" value="" />
<?php if ($navigation_page > 1) {?>
<input type="hidden" name="pagestr" value="&amp;page=<?php echo $navigation_page;?>" />
<?php } ?>


<table cellpadding="2" cellspacing="1" width="100%" class="lines-table">

<tr>
        <th>&nbsp;</th>
        <th>#</th>
        <th>Status</th>
        <th>Type</th>
        <th>Subject</th>
        <th>Customer</th>
        <th>Messages</th>
        <th>Date</th>
        <th>Priority</th>
</tr>

<?php foreach ($tickets as $i) {?>
<tr>
        <td width="5"><input type="checkbox" name="to_delete[<?php echo $i['ticketid'];?>]" /></td>
        <td width='30'><a href="/admin/ticket/<?php echo $i['ticketid'];?>"><?php echo $i['ticketid'];?></a></td>
        <td width="100" align='center'><?php $mode = ''; $name="statuses[".$i['ticketid']."]"; $status=$i['status'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?></td>
        <td width="100" align='center'><?php $mode='static'; $name="types[".$i['ticketid']."]"; $type=$i['type'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_type.php";?></td>
        <td><a href="/admin/ticket/<?php echo $i['ticketid'];?>"><?php echo $i['subject'];?><?php if ($i['admin_read'] == 'N') {?> <font color="red">(Not read)</font><?php } ?></a></td>
        <td width='200' align='center'>
<?php if ($i['userid']) {?>
        <a href="/admin/user/<?php echo $i['userid'];?>"><?php echo $i['customer']['firstname'];?> <?php echo $i['customer']['lastname'];?> (<?php echo $i['email'];?>)</a>
<?php } else  { ?>
<?php echo $i['email'];?>
<?php } ?>
        </td>
        <td width='70' align='center'><?php echo $i['count'];?></td>
        <td width='150' align='center'><a href="/admin/ticket/<?php echo $i['ticketid'];?>"><?php echo date($datetime_format, $i['date']);; ?></a></td>
        <td width="70" align="center"><?php $mode="static"; $value=$i['priority'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?></td>
</tr>
<?php } ?>

<tr>
        <td colspan="9">
<div class="fixed_save_button">
        <input type="button" value="Update" onclick="javascript: submitForm(this, 'update');" />
        <input type="button" value="Delete selected" onclick="if (confirm('Are you sure?', $(this)) || confirmed) submitForm(this, 'delete');" />
</div>
        </td>
</tr>


</table>
</form>

<br />

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php 
}
?>

<?php } ?>

<br />

