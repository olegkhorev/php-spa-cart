<?php if ($ticket) {?>
<h1>Тикет <b class="translate"><span class="hidden word">Ticket</span><span class="hidden translate-phrase">Тикет</span>(Edit)</b> #<?php echo $ticket['ticketid'];?></h1>
<?php } else  { ?>
<h1>Новый запрос на расчет сметы <b class="translate"><span class="hidden word">New estimate request</span><span class="hidden translate-phrase">Новый запрос на расчет сметы</span>(Edit)</b></h1>
<?php } ?>

<?php if ($ticket) {?>
<h3><?php echo $ticket['subject'];?></h3>
<?php } else  { ?>
<h3>Информация о тикете <b class="translate"><span class="hidden word">Ticket info</span><span class="hidden translate-phrase">Информация о тикете</span>(Edit)</b></h3>
<?php } ?>

<div align="right"><a href="/admin/support_desk?mode=search">Вернуться к результатам поиска <b class="translate"><span class="hidden word">Back to search results</span><span class="hidden translate-phrase">Вернуться к результатам поиска</span>(Edit)</b></a></div>

<form method="POST" name="ticketform" enctype="multipart/form-data"<?php /* ?> class="noajax"<?php */ ?>>
<input type="hidden" name="mode" value="">
<table cellspacing='1' cellpadding='2' width='100%'>

<?php if ($ticket) {?>
<tr>
 <td valign="top" align='right'>Заметки администратора <b class="translate"><span class="hidden word">Admin notes</span><span class="hidden translate-phrase">Заметки администратора</span>(Edit)</b>:</td>
 <td width='10'>&nbsp;</td>
 <td><textarea name="ticket[notes]" rows="10" cols="80"><?php echo $ticket['notes'];?></textarea></td>
</tr>
<?php $name="ticket[type]"; $type=$ticket['type'];; ?>
<tr>
        <td align='right'>Type:</td>
        <td width="10">&nbsp;</td>
        <td><?php include SITE_ROOT."/var/cache/ru/common/ticket_type.php";?>
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
		<?php include SITE_ROOT."/var/cache/ru/common/ticket_priority.php";?>
        </td>
</tr>

<tr>
 <td align='right'>Клиент <b class="translate"><span class="hidden word">Customer</span><span class="hidden translate-phrase">Клиент</span>(Edit)</b>:</td>
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
 <td align='right'>Тема тикета <b class="translate"><span class="hidden word">Ticket subject</span><span class="hidden translate-phrase">Тема тикета</span>(Edit)</b>:</td>
 <td width='10'>&nbsp;</td>
 <td><input type="text" id="ticket_subject" name="ticket[subject]" size="85" value="<?php echo escape($ticket['subject'], 2);; ?>"></td>
</tr>


<tr>
 <td valign='top' align='right'>Сообщение тикета <b class="translate"><span class="hidden word">Ticket message</span><span class="hidden translate-phrase">Сообщение тикета</span>(Edit)</b>:</td>
 <td width='10'>&nbsp;</td>
 <td><textarea name="ticket[message]" id="ticket_message" cols="85" rows="5"><?php echo $ticket['message'];?></textarea></td>
</tr>

<tr>
 <td align='right'>Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b>:</td>
 <td width='10'>&nbsp;</td>
 <td>
<?php $name="ticket[status]"; $status=$ticket['status'];; ?>
<?php include SITE_ROOT."/var/cache/ru/common/ticket_status.php";?>
 </td>
</tr>

<?php if ($ticket) {?>
<?php if ($ticket['attachments']) {?>
<tr>
 <td valign='top' align='right'>Прикрепленные файлы <b class="translate"><span class="hidden word">Attached files</span><span class="hidden translate-phrase">Прикрепленные файлы</span>(Edit)</b>:</td>
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
<input type='button' value='<?php if (!$ticket) {?>Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b><?php } else  { ?>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b><?php } ?>' onclick="javascript: submitForm(this, '');">
<?php if ($ticket) {?>
&nbsp;
<input type='button' value='Удалить <b class="translate"><span class="hidden word">Delete</span><span class="hidden translate-phrase">Удалить</span>(Edit)</b>' onclick="if (confirm('Are you sure?', $(this)) || confirmed) submitForm(this, 'delete');">
<?php if ($messages) {?>
&nbsp;
<input type='button' value='Удалить все сообщения <b class="translate"><span class="hidden word">Delete all messages</span><span class="hidden translate-phrase">Удалить все сообщения</span>(Edit)</b>' onclick="if (confirm('Are you sure?', $(this)) || confirmed) submitForm(this, 'delete_messages');">
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
<h3>Сообщения тикета <b class="translate"><span class="hidden word">Ticket messages</span><span class="hidden translate-phrase">Сообщения тикета</span>(Edit)</b></h3>

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
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
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

<h3>Добавить/редактировать <b class="translate"><span class="hidden word">Add/Edit</span><span class="hidden translate-phrase">Добавить/редактировать</span>(Edit)</b></h3>
<a name="add_new"></a>
<form method="POST" name="mesform" enctype="multipart/form-data"<?php /* ?> class="noajax"<?php */ ?>>
<input type="hidden" name="mode" value="add_message">
<input type="hidden" name="messageid">
<table cellspacing='0' cellpadding'0' width="600">
<tr>
 <td valign="top"><textarea cols="80" rows="10" name="message"></textarea></td>
 <td valign="top">
<b>Загрузить файлы <b class="translate"><span class="hidden word">Upload files</span><span class="hidden translate-phrase">Загрузить файлы</span>(Edit)</b></b><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]"><br />
<input size="40" type="file" name="attachments[]">
 </td>
</tr>
<tr>
 <td align='right'>
<input type="button" value="Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b>" onclick="javascript: submitForm(this, 'update_message');" id="update_message" disabled>&nbsp;
<input type="button" value="Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b>" onclick="javascript: submitForm(this, 'add_message');">&nbsp;
 </td>
 <td></td>
</tr>
</table>
</form>

<?php } ?>
