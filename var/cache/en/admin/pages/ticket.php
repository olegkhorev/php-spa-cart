<?php if ($ticket) {?>
<h1>Ticket #<?php echo $ticket['ticketid'];?></h1>
<?php } else  { ?>
<h1>New estimate request</h1>
<?php } ?>

<?php if ($ticket) {?>
<h3><?php echo $ticket['subject'];?></h3>
<?php } else  { ?>
<h3>Ticket info</h3>
<?php } ?>

<div align="right"><a href="/admin/support_desk?mode=search">Back to search results</a></div>

<form method="POST" name="ticketform" enctype="multipart/form-data"<?php /* ?> class="noajax"<?php */ ?>>
<input type="hidden" name="mode" value="">
<table cellspacing='1' cellpadding='2' width='100%'>

<?php if ($ticket) {?>
<tr>
 <td valign="top" align='right'>Admin notes:</td>
 <td width='10'>&nbsp;</td>
 <td><textarea name="ticket[notes]" rows="10" cols="80"><?php echo $ticket['notes'];?></textarea></td>
</tr>
<?php $name="ticket[type]"; $type=$ticket['type'];; ?>
<tr>
        <td align='right'>Type:</td>
        <td width="10">&nbsp;</td>
        <td><?php include SITE_ROOT."/var/cache/en/common/ticket_type.php";?>
<?php if ($product) {?>
<a href="/admin/products/<?php echo $product['productid'];?>" target="_blank"><?php echo $product['name'];?></a>
<?php } ?>
        </td>
</tr>

<?php /* ?>
<tr>
	<td valign="top" align='right'>Ticket info:</td>
	<td width="10">&nbsp;</td>
	<td>
<?php if ($ticket_cats) {?>
<?php $ticket_cat = $ticket['cat1'].'|||'.$ticket['cat2'].'|||'.$ticket['cat3'].'|||'.$ticket['cat4'].'|||'.$ticket['cat5'];; ?>
<select name="ticket_category">
<?php foreach ($ticket_cats as $k=>$v) {?>
<option value="<?php echo $k;?>"<?php if ($k == $ticket_cat) {?> selected<?php } ?>><?php echo $v;?></option>
<?php } ?>
</select>
<br />
<?php } ?>
<?php if ($ticket['fields']) {?>
 <?php foreach ($ticket['fields'] as $field=>$value) {?>
 <br />
  <?php echo $field;?>: <?php echo $value;?><br />
 <?php } ?>
<br />
<?php } ?>
	</td>
</tr>
<?php */ ?>
<tr>
        <td align='right'>Date:</td>
        <td width="10">&nbsp;</td>
        <td><?php echo date($datetime_format, $ticket['date']);; ?></td>
</tr>
<?php } ?>
<tr>
        <td align='right'>Priority:</td>
        <td width="10">&nbsp;</td>
        <td>
        <?php $name="ticket[priority]"; $value=$ticket['priority'];; ?>
		<?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?>
        </td>
</tr>

<tr>
 <td align='right'>Customer:</td>
 <td width='10'>&nbsp;</td>
 <td>
<?php if ($ticket['userid']) {?>
<a href="/admin/user/<?php echo $ticket['userid'];?>"><?php echo $ticket['customer']['firstname'];?> <?php echo $ticket['customer']['lastname'];?> (<?php echo $ticket['email'];?>)</a>
<?php } else  { ?>
<?php echo $ticket['email'];?>
<?php } ?>
 </td>
</tr>

<tr>
 <td align='right'>Ticket subject:</td>
 <td width='10'>&nbsp;</td>
 <td><input type="text" id="ticket_subject" name="ticket[subject]" size="85" value="<?php echo escape($ticket['subject'], 2);; ?>"></td>
</tr>


<tr>
 <td valign='top' align='right'>Ticket message:</td>
 <td width='10'>&nbsp;</td>
 <td><textarea name="ticket[message]" id="ticket_message" cols="85" rows="5"><?php echo $ticket['message'];?></textarea></td>
</tr>

<tr>
 <td align='right'>Status:</td>
 <td width='10'>&nbsp;</td>
 <td>
<?php $name="ticket[status]"; $status=$ticket['status'];; ?>
<?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?>
 </td>
</tr>

<?php if ($ticket) {?>
<?php if ($ticket['attachments']) {?>
<tr>
 <td valign='top' align='right'>Attached files:</td>
 <td width='10'>&nbsp;</td>
 <td>
<?php foreach ($ticket['attachments'] as $a) {?><a href="<?php echo $current_location;?>/ticket/attachment/<?php echo $a['attachid'];?>"><?php echo $a['file_name'];?></a> &nbsp; <?php } ?>
<br />
 </td>
</tr>
<?php } ?>
<?php } else  { ?>
<tr>
 <td valign='top' align='right'>{lng[lbl_attach_files}:</td>
 <td width='10'>&nbsp;</td>
 <td>
<table cellspacing="1" cellpadding="2" id="wp_table">
<tr id="f_tr">
        <td id="f_box_1"><input type="file" name="attachments[]" size="40"></td>
        <td>{include file="buttons/multirow_add.tpl" mark="f"}</td>
</tr>
</table>
 </td>
</tr>
<?php } ?>

<tr>
 <td colspan="2"></td>
 <td>
<br />
<input type='button' value='<?php if (!$ticket) {?>Add<?php } else  { ?>Save<?php } ?>' onclick="javascript: submitForm(this, '');">
<?php if ($ticket) {?>
&nbsp;
<input type='button' value='Delete' onclick="if (confirm('Are you sure?', $(this)) || confirmed) submitForm(this, 'delete');">
<?php if ($messages) {?>
&nbsp;
<input type='button' value='Delete all messages' onclick="if (confirm('Are you sure?', $(this)) || confirmed) submitForm(this, 'delete_messages');">
<?php } ?>
<?php } ?>
 </td>
</tr>
</table>

</form>

<br /><br />
<?php if ($tickets && $ticket) {?>
<b>Move all messages to another ticket(will remove the current ticket):</b>
<select id="move_to">
<option value=""></option>
<?php foreach ($tickets as $i) {?>
<option value="<?php echo $i['ticketid'];?>"><?php echo $i['ticketid'];?> - <?php echo $i['subject'];?></option>
<?php } ?>
</select>
<button onclick="if (!$('#move_to').val()) return false; if (confirm('Are you sure?', $(this)) || confirmed) self.location='/admin/ticket/<?php echo $ticket['ticketid'];?>?mode=move&to='+$('#move_to').val();">Move</button>
<?php } ?>

<?php if ($ticket) {?>
<br />
<a name="messages"></a>
<h3>Ticket messages</h3>

<?php if ($messages) {?>
<script>
function edit_message(id) {
        document.mesform.message.value=document.getElementById('message_'+id).innerHTML;
        document.mesform.messageid.value=id;
        document.mesform.mode.value='update_message';
        document.getElementById('update_message').disabled=false;
}
</script>

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php 
}
?>

<table cellspacing='0' cellpadding'0' width='100%'>
<?php foreach ($messages as $i) {?>
<tr>
 <td align='left'><a name="m<?php echo $i['messageid'];?>"></a>&nbsp;<a href="/admin/user/<?php echo $i['userid'];?>"><?php echo $i['firstname'];?> <?php echo $i['lastname'];?> (<?php echo $i['email'];?>)</a><?php if ($i['ip']) {?> (IP: <?php echo $i['ip'];?>)<?php } ?></td>
 <td align='right' width="150"><?php echo date($datetime_format, $i['date']);; ?></td>
 <td align='right' width='200'><a href="#add_new" onclick="javascript: edit_message('<?php echo $i['messageid'];?>')">Edit</a> / <a href="javascript: void(0);" onclick="javascript: if (confirm('Delete this message?')) self.location='/admin/ticket/<?php echo $ticket['ticketid'];?>?mode=delete_message&messageid=<?php echo $i['messageid'];?>';">Delete</a>&nbsp;</td>
</tr>
<tr>
 <td><hr /><?php echo func_eol2br($i['message']);; ?>

<br />

<?php if ($i['attachments']) {?>
<br />
<?php foreach ($i['attachments'] as $a) {?><a href="<?php echo $current_location;?>/ticket/attachment/<?php echo $a['attachid'];?>"><?php echo $a['file_name'];?></a> &nbsp; <?php } ?>
<br />
<?php } ?>
 <br /></td>
 <td colspan="2">
<?php if ($tickets && $ticket) {?>
Clone message to:
<select class="ticket_clone_to" id="move_to_<?php echo $i['messageid'];?>">
<option value=""></option>
<?php foreach ($tickets as $t) {?>
<option value="<?php echo $t['ticketid'];?>"><?php echo $t['ticketid'];?> - <?php echo $t['subject'];?></option>
<?php } ?>
</select>
<button onclick="if (!$('#move_to_<?php echo $i['messageid'];?>').val()) return false; if (confirm('Are you sure?', $(this)) || confirmed) self.location='/admin/ticket/<?php echo $ticket['ticketid'];?>?messageid=<?php echo $i['messageid'];?>&mode=clone_message&to='+$('#move_to_<?php echo $i['messageid'];?>').val();">Clone</button>
<?php } ?>
 </td>
</tr>
<span id="message_<?php echo $i['messageid'];?>" class="display-none"><?php echo $i['message'];?></span>
<?php } ?>
</table>
<?php } ?>

<h3>Add/Edit</h3>
<a name="add_new"></a>
<form method="POST" name="mesform" enctype="multipart/form-data"<?php /* ?> class="noajax"<?php */ ?>>
<input type="hidden" name="mode" value="add_message">
<input type="hidden" name="messageid">
<table cellspacing='0' cellpadding'0' width="600">
<tr>
 <td valign="top"><textarea cols="80" rows="10" name="message"></textarea></td>
 <td valign="top">
<b>Upload files</b><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]">
 </td>
</tr>
<tr>
 <td align='right'>
<input type="button" value="Save" onclick="javascript: submitForm(this, 'update_message');" id="update_message" disabled>&nbsp;
<input type="button" value="Add" onclick="javascript: submitForm(this, 'add_message');">&nbsp;
 </td>
 <td></td>
</tr>
</table>
</form>

<?php } ?>
