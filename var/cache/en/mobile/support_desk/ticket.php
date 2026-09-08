<?php if ($ticket) {?>
<h1>Ticket #<?php echo $ticket['ticketid'];?> (<span id="ticket-status-<?php echo $ticket['ticketid'];?>"><?php $mode = "static"; $status=$ticket['status'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?></span>)</h1>
<?php } else  { ?>
<h1>New ticket</h1>
<?php } ?>

<?php if (!$ticket) {?>
<?php /* ?>
<script>
<?php foreach ($ticket_cats as $k=>$c) {?>
ticket_cats[<?php echo $k;?>] = ["<?php echo escape($c['cat1'], 2);; ?>", "<?php echo escape($c['cat2'], 2);; ?>", "<?php echo escape($c['cat3'], 2);; ?>", "<?php echo escape($c['cat4'], 2);; ?>", "<?php echo escape($c['cat5'], 2);; ?>", [], "<?php echo escape($c['label'], 2);; ?>", "<?php echo escape($c['tooltip'], 2);; ?>"];
 <?php if ($c['fields']) {?>
  <?php foreach ($c['fields'] as $k2=>$f) {?>
ticket_cats[<?php echo $k;?>][5][<?php echo $k2;?>] = ["<?php echo escape($f['field'], 2);; ?>", "<?php echo $f['required'];?>"];
  <?php } ?>
 <?php } ?>
<?php } ?>
</script>
<?php */ ?>
<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<?php } ?>

<form method="POST" name="ticketform" enctype="multipart/form-data">
<input type="hidden" name="mode" value="">

<div class="ticket-div" style="margin-bottom: 60px;">
<table cellspacing="1" cellpadding="2" width="" class="tickettable">
<tr>
 <td valign="top" style="width: 50%;">
 <table width="100%">
 <?php /* ?>
<tr>
 <td valign="top" class='data-name' align="right"></td>
 <td valign="top" class="star">*</td>
 <td><label class="drop-down">Select version:</label><div id="ticket_category">Loading...</div></td>
</tr>
<?php */ ?>
<?php if (!$login) {?>
<tr>
 <td class='data-name' align="right">Email:</td>
 <td class="star">*</td>
 <td><input type="text" name="email" id="ticket_email" style="width: 350px;" value="<?php echo escape($predefined['email'], 2);; ?>" onkeyup="javascript: if(this.value && document.getElementById('error_mes').style.display == 'block') document.getElementById('error_mes').style.display='none';"></td>
</tr>
<?php } ?>

<tr>
 <td class='data-name' align="right">Ticket priority:</td>
 <td>&nbsp;</td>
<?php $name="priority"; $value=$predefined['priority'];; ?>
 <td><?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?></td>
</tr>

<tr>
 <td class='data-name' align="right">Subject:</td>
 <td class="star">*</td>
 <td><input type="text" name="subject" id="ticket_subject" style="width: 350px;" value="<?php echo escape($predefined['subject'], 2);; ?>" onkeyup="javascript: if(this.value && document.getElementById('error_mes').style.display == 'block') document.getElementById('error_mes').style.display='none';"></td>
</tr>

<tr>
 <td class='data-name' valign="top" align="right">Message:</td>
 <td class="star">*</td>
 <td><textarea name="message" id="ticket_message" style="width: 350px; height: 100px;" onkeyup="javascript: if(this.value && document.getElementById('error_mes').style.display == 'block') document.getElementById('error_mes').style.display='none';"><?php echo $predefined['message'];?></textarea></td>
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
 <td colspan="2"></td>
 <td style="color: #CC3300"><b id="error_mes" style="display: none;">Please, select all categories, enter your subject and message</b></td>
</tr>

<tr>
 <td colspan="2"></td>
 <td>
<?php if ($config['General']['recaptcha_key']) {?>
<div id="recaptcha_ticket" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div><br />
<?php } ?>
 </td>
</tr>

<tr>
 <td colspan="2"></td>
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
<span id="message_<?php echo $i['messageid'];?>" style="display: none;"><?php echo $i['message'];?></span>
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

<div id="original_message" style="margin: 5px; padding: 10px; border: 1px solid #CCC; background-color: #f3f3f3;">
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
<form method="POST" name="mesform" action="/ticket/<?php echo $ticket['ticketid'];?>" enctype="multipart/form-data" onsubmit="javascript: if(document.mesform.message.value == '') { document.getElementById('error_mes').style.display='block'; return false; } else  { document.getElementById('error_mes').style.display='none'; this.disabled=true; submitForm(this, 'create_new'); }">
<input type="hidden" name="mode" value="create_new">

<table cellspacing="0" cellpadding="0" width="100%">
<tr>
 <td width="400" valign="top"><textarea cols="52" rows="7" name="message" onkeyup="javascript: if(this.value && document.getElementById('error_mes').style.display == 'block') document.getElementById('error_mes').style.display='none';"></textarea></td>
 <td valign="top"><b>Upload files</b><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]">
 </td>
</tr>
<tr>
 <td><div id="error_mes" style="display: none; color: #cc3300"><b>Please, enter your message.</b></div></td>
 <td align="right"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Send message</button>&nbsp;</td>
</tr>
</table>
</form>
<?php } ?>

<?php } ?>
