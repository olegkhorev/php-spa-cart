<?php if (!$predefined) {?>
<?php $predefined = array();; ?>
<?php } ?>
<?php if ($ticket) {?>
<h1>Ticket #<?php echo $ticket['ticketid'];?> (<span id="ticket-status-<?php echo $ticket['ticketid'];?>"><?php $mode = "static"; $status=$ticket['status'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?></span>)</h1>
<?php } else  { ?>
<h1>New ticket</h1>
<?php } ?>
<br />
<?php if (!$ticket) {?>
<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<?php } ?>

<form action="/ticket<?php if ($_GET['productid']) {?>?productid=<?php echo $_GET['productid'];?><?php } ?>" method="POST" name="ticketform" enctype="multipart/form-data">
<input type="hidden" name="mode" value="">
<input type="hidden" name="productid" value="<?php echo $product['productid'];?>">

<div class="ticket-div">
<table cellspacing="1" cellpadding="2" width="" class="tickettable">
<tr>
 <td valign="top" class="width-50p">
 <table width="100%">
<?php if (!$login) {?>
<tr>
 <td class='data-name' align="right">Email:</td>
 <td class="star">*</td>
 <td>
<div class="its4mobile">Email</div>
 <input type="text" name="email" id="ticket_email" value="<?php echo escape($predefined['email'], 2);; ?>"></td>
</tr>
<?php } ?>

<tr>
 <td class='data-name' align="right">Ticket priority:</td>
 <td>&nbsp;</td>
<?php $name="priority"; $value=$predefined['priority'];; ?>
 <td>
<div class="its4mobile">Ticket priority</div>
 <?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?></td>
</tr>

<tr>
 <td class='data-name' align="right">Subject:</td>
 <td class="star">*</td>
 <td>
<div class="its4mobile">Subject</div>
 <input type="text" name="subject" id="ticket_subject" value="<?php echo escape($predefined['subject'], 2);; ?>"></td>
</tr>

<tr>
 <td class='data-name' valign="top" align="right">Message:</td>
 <td class="star">*</td>
 <td>
<div class="its4mobile">Message</div>
 <textarea name="message" id="ticket_message"><?php echo $predefined['message'];?></textarea></td>
</tr>

<tr>
 <td class="data-name" valign="top" align="right"></td>
 <td>&nbsp;</td>
 <td>
<label class="drop-down">Upload files:</label><br /><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]">
 </td>
</tr>

<tr>
 <td class="data-name" valign="top" align="right"></td>
 <td>&nbsp;</td>
 <td class="error-cc3300"><b id="error_mes">Please, select all categories, enter your subject and message</b></td>
</tr>

<tr>
 <td class="data-name" valign="top" align="right"></td>
 <td>&nbsp;</td>
 <td>
<?php if ($config['General']['recaptcha_key']) {?>
<div id="recaptcha_ticket" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div><br />
<?php } ?>
 </td>
</tr>

<tr>
 <td class="data-name" valign="top" align="right"></td>
 <td>&nbsp;</td>
 <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button" onclick="submit_ticket();">Create ticket</button></td>
</tr>
</table>
 </td>
</tr>
</table>
</div>
</form>

<?php } else  { ?>

<a name="messages"></a>

<div align="right">
<a href="/support_desk"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Support desk</button></a>
&nbsp;
<a href="/ticket"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Create request</button></a>
<span id="ticket-status-links-<?php echo $ticket['ticketid'];?>">
        <?php if ($ticket['status'] != '3' && $ticket['status'] != 'C') {?>
    	    &nbsp; <a class="close-ticket" href="javascript: void(0);" onclick="javascript: if (confirmed || confirm('Are you sure?', $(this))) close_ticket('<?php echo $ticket['ticketid'];?>', 1);"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Close</button></a>
	        &nbsp; <a class="close-ticket" href="javascript: void(0);" onclick="javascript: if (confirmed || confirm('Are you sure?', $(this))) close_ticket('<?php echo $ticket['ticketid'];?>', 2);"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Cancel</button></a>
        <?php } ?>
</span>
</div>

<script language="JavaScript" type="text/javascript">
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

<?php if ($messages) {?>
<table cellspacing="0" cellpadding="0" width="100%">

<?php foreach ($messages as $i) {?>
<tr>
 <th align="left"><a name="m<?php echo $i['messageid'];?>"></a>&nbsp;<?php echo $i['firstname'];?> <?php echo $i['lastname'];?></th>
 <th align="right"><?php echo date($datetime_format, $i['date']);; ?>&nbsp;</th>
</tr>
<tr>
 <td colspan="2" class="ticket-message"><?php echo func_eol2br($i['message']);; ?><br />
<?php if ($i['attachments']) {?>
<i>Attached files:</i>
<?php foreach ($i['attachments'] as $a) {?><a href="<?php echo $current_location;?>/ticket/attachment/<?php echo $a['attachid'];?>"><?php echo $a['file_name'];?></a> &nbsp; <?php } ?>
<br />
<?php } ?>
<br /></td>
</tr>
<span id="message_<?php echo $i['messageid'];?>" class="display-none"><?php echo $i['message'];?></span>
<?php } ?>

</table>
<?php } ?>
<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php 
}
?>

<div id="original_message">
<h3>Request information</h3>
<br />
<?php if ($ticket['cat1']) {?>Category: <?php echo $ticket['cat1'];?><?php } ?>
<?php if ($ticket['cat2']) {?> &gt; <?php echo $ticket['cat2'];?><?php } ?>
<?php if ($ticket['cat3']) {?> &gt; <?php echo $ticket['cat3'];?><?php } ?>
<?php if ($ticket['cat4']) {?> &gt; <?php echo $ticket['cat4'];?><?php } ?>
<?php if ($ticket['cat5']) {?> &gt; <?php echo $ticket['cat5'];?><?php } ?>
<br />
<?php if ($ticket['fields']) {?>
<br />
<table width="100%">
 <?php foreach ($ticket['fields'] as $field=>$value) {?>
  <tr>
   <td width="200" valign="top"><u><?php echo $field;?></u>:</td>
   <td valign="top"><?php echo $value;?></td>
  </tr>
 <?php } ?>

</table>
<?php } ?>

Subject: <?php echo $ticket['subject'];?><br />
Priority: <?php $mode="static"; $name="priority"; $value=$ticket['priority'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?><br />
<br />
Message:<br />
<?php echo func_eol2br($ticket['message']);; ?><br />

<br />
<?php if ($ticket['attachments']) {?><i>Attached files:</i>
<?php foreach ($ticket['attachments'] as $a) {?><a href="<?php echo $current_location;?>/ticket/attachment/<?php echo $a['attachid'];?>"><?php echo $a['file_name'];?></a> &nbsp; <?php } ?>
<br />
<?php } ?>
</div>

<?php if ($ticket['status'] != '3' && $ticket['status'] != 'C') {?>
<br />
<h3>Post new message</h3>
<a name="create_new"></a>
<form method="POST" name="mesform" id="ticketmesform" action="/ticket/<?php echo $ticket['ticketid'];?>" enctype="multipart/form-data">
<input type="hidden" name="mode" value="create_new">

<table cellspacing="0" cellpadding="0" width="100%">
<tr>
 <td width="400" valign="top"><textarea cols="52" rows="7" name="message" id="post_new_message"></textarea></td>
 <td valign="top"><b>Upload files</b><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]">
 </td>
</tr>
<tr>
 <td><div id="error_mes"><b>Please, enter your message.</b></div></td>
 <td align="right"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Send message</button>&nbsp;</td>
</tr>
</table>
</form>
<?php } ?>

<?php } ?>
