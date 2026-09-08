<h1>Support desk</h1>
<div class="support_desk">
<br />

<div<?php if (!$can_post_ticket) {?> class="hidden1"<?php } ?> id="post_ticket" align="right"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='/ticket';">New ticket</button></div>

<?php if ($tickets) {?>

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php 
}
?>

<table cellpadding="10" cellspacing="0" class="support-desk-table">

<tr>
        <th align='center'>#</th>
        <th align="left">&nbsp;Subject</a></th>
        <th width="150" align='center'>Status</th>
        <th width="150" align='center'>Date</th>
        <th width="150" align='center'>Actions</th>
</tr>

<?php foreach ($tickets as $k=>$i) {?>

<tr class="ticket-link<?php if ($k % 2) {?> tl-second<?php } ?>">
        <td width='10'><a href="/ticket/<?php echo $i['ticketid'];?>"><?php echo $i['ticketid'];?></a>&nbsp;</td>
        <td>&nbsp;<a href="/ticket/<?php echo $i['ticketid'];?>"><?php echo $i['subject'];?></a><?php if ($i['read'] == "N" || $i['mread'] == "N") {?> <font color="#00AA00">(new messages)</font><?php } ?></td>
        <td id="ticket-status-<?php echo $i['ticketid'];?>"><?php $mode = "static"; $status=$i['status'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?></td>
        <td width='150' align='center'><?php echo date($datetime_format, $i['date']);; ?></td>
        <td align="right" id="ticket-status-links-<?php echo $i['ticketid'];?>">
        <?php if ($i['status'] != '3' && $i['status'] != 'C') {?>
    	    &nbsp; <a class="close-ticket" href="javascript: void(0);" onclick="javascript: if (confirmed || confirm('Are you sure?', $(this))) close_ticket('<?php echo $i['ticketid'];?>', 1);"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Close</button></a>
<?php /* ?>	        &nbsp; <a class="close-ticket" href="javascript: void(0);" onclick="javascript: if (confirmed || confirm('Are you sure?', $(this))) close_ticket('<?php echo $i['ticketid'];?>', 2);"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Cancel</button></a><?php */ ?>
        <?php } ?>
        </td>
</tr>
<?php } ?>

</table>

<br />

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php 
}
?>

<?php } else  { ?>
You have no tickets.
<?php } ?>

<?php /* ?>
<?php if ($last_order) {?>
<br /><hr /><br />
You are a current subscriber. Your subscription is valid until <?php echo date($date_format, $renew_date);; ?>
<?php if ($userinfo['active_subscription']) {?>
<br /><br />
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button" onclick="javascript: if (confirmed || confirm('Are you sure?', $(this))) self.location='/support_desk/cancel';">Cancel subscription</button> - Your subscription still will be active, but you will not be charged at the end date.
<?php } ?>
<br /><br />

<?php if (!$can_post_ticket && !$userinfo['active_subscription']) {?>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='/subscribe';">Subscribe again</button>
<?php } ?>

<?php } ?>
<?php */ ?>
</div>