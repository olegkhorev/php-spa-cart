<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if (!$predefined) {?>
<?php $predefined = array();; ?>
<?php } ?>
<?php if ($ticket) {?>
<h1>Ticket #<?php echo $ticket['ticketid'];?> (<span id="ticket-status-<?php echo $ticket['ticketid'];?>"><?php $mode = "static"; $status=$ticket['status'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_status.php";?></span>)</h1>
<br />
<?php } ?>

<?php if (!$ticket) {?>
<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<?php } ?>

<form action="/ticket<?php if ($_GET['productid']) {?>?productid=<?php echo $_GET['productid'];?><?php } ?>" method="POST" name="ticketform" enctype="multipart/form-data" class="ajax-form">
<input type="hidden" name="mode" value="">
<input type="hidden" name="productid" value="<?php echo $product['productid'];?>">

<h1>New ticket</h1>
<br />

<div class="ticket-div">
<?php if (!$login) {?>
 <div class="group">
  <input type="text" name="email" id="ticket_email" value="<?php echo escape($predefined['email'], 2);; ?>">
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>Email</label>
 </div>
<?php } ?>

 <?php $name="priority"; $value=$predefined['priority'];; ?>
 <div class="group group-select">
  <?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?>
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>Ticket priority</label>
 </div>

 <div class="group">
  <input type="text" name="subject" id="ticket_subject" value="<?php echo escape($predefined['subject'], 2);; ?>">
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>Subject</label>
 </div>

 <div class="group">
  <textarea name="message" id="ticket_message"><?php echo $predefined['message'];?></textarea>
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>Message</label>
 </div>

 <div class="group">
  <input size="40" type="file" name="attachments[]">
  <span class="highlight"></span>
  <span class="bar"></span>
 </div>

 <div class="error-cc3300"><b id="error_mes">Please, select all categories, enter your subject and message</b></div>

<?php if ($config['General']['recaptcha_key']) {?>
<br />
<div id="recaptcha_ticket" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div><br />
<?php } ?>

<button type="button" onclick="submit_ticket();">Create ticket</button>

</div>
</form>

<?php } else  { ?>

<a id="messages"></a>

<div style="text-align:right">
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='/support_desk'">Support desk</button>
&nbsp;
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="self.location='/ticket'">Create request</button>
<span id="ticket-status-links-<?php echo $ticket['ticketid'];?>">
        <?php if ($ticket['status'] != '3' && $ticket['status'] != 'C') {?>
    	    &nbsp; <button type="button" class="close-ticket mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="javascript: if (confirmed || confirm('Are you sure?', $(this))) close_ticket('<?php echo $ticket['ticketid'];?>', 1);">Close</button>
	        &nbsp; <button type="button" class="close-ticket mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="javascript: if (confirmed || confirm('Are you sure?', $(this))) close_ticket('<?php echo $ticket['ticketid'];?>', 2);">Cancel</button>
        <?php } ?>
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

<?php if ($messages) {?>
<table style="border-collapse:collapse;width:100%">

<?php foreach ($messages as $i) {?>
<tr>
 <th style="text-align:left"><a id="m<?php echo $i['messageid'];?>"></a>&nbsp;<?php echo $i['firstname'];?> <?php echo $i['lastname'];?></th>
 <th style="text-align:right"><?php echo date($datetime_format, $i['date']);; ?>&nbsp;</th>
</tr>
<tr>
 <td colspan="2" class="ticket-message"><?php echo func_eol2br($i['message']);; ?><br />
<?php if ($i['attachments']) {?>
<i>Attached files:</i>
<?php foreach ($i['attachments'] as $a) {?><a href="<?php echo $current_location;?>/ticket/attachment/<?php echo $a['attachid'];?>"><?php echo $a['file_name'];?></a> &nbsp; <?php } ?>
<br />
<?php } ?>
<br /><span id="message_<?php echo $i['messageid'];?>" class="display-none"><?php echo $i['message'];?></span></td>
</tr>
<?php } ?>

</table>
<?php } ?>
<?php  if ($total_pages > 2) { ?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php  } ?>

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
<table style="width:100%">
 <?php foreach ($ticket['fields'] as $field=>$value) {?>
  <tr>
   <td style="width:200px;vertical-align:top"><u><?php echo $field;?></u>:</td>
   <td style="vertical-align:top"><?php echo $value;?></td>
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
<a id="create_new"></a>
<form method="POST" name="mesform" id="ticketmesform" action="/ticket/<?php echo $ticket['ticketid'];?>" enctype="multipart/form-data" class="ajax-form">
<input type="hidden" name="mode" value="create_new">

<table style="border-collapse:collapse;width:100%">
<tr>
 <td style="width:400px;vertical-align:top"><textarea cols="52" rows="7" name="message" id="post_new_message"></textarea></td>
 <td style="vertical-align:top"><b>Upload file</b><br />
<input size="40" type="file" name="attachments[]">
 </td>
</tr>
<tr>
 <td><div id="error_mes"><b>Please, enter ticket message</b></div></td>
 <td style="text-align:right"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Send message</button>&nbsp;</td>
</tr>
</table>
</form>
<?php } ?>

<?php } ?>
