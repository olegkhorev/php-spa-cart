<?php if (!$tickets) {?>

<br />

<h3>Поиск тикетов <b class="translate"><span class="hidden word">Search for tickets</span><span class="hidden translate-phrase">Поиск тикетов</span>(Edit)</b></h3>

<form name="searchform" action="/admin/support_desk/search" method="post" href="/admin/support_desk/?mode=search">

<table cellpadding="4" cellspacing="0" width="100%">

<?php $empty='Y'; $name="posted_data[type]"; $type=$search_prefilled['type'];; ?>
<tr>
        <td align='right'>Type:</td>
        <td width="10">&nbsp;</td>
        <td><?php include SITE_ROOT."/var/cache/ru/common/ticket_type.php";?></td>
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
        <td><?php include SITE_ROOT."/var/cache/ru/common/ticket_priority.php";?></td>
</tr>

<tr>
        <td align='right'>Электронная почта клиента <b class="translate"><span class="hidden word">Customer email</span><span class="hidden translate-phrase">Электронная почта клиента</span>(Edit)</b>:</td>
        <td width="10">&nbsp;</td>
        <td><input type='text' name='posted_data[email]' value="<?php echo escape($search_prefilled['email'], 2);; ?>" size="20"></td>
</tr>

<tr>
        <td align='right'>Тема <b class="translate"><span class="hidden word">Subject</span><span class="hidden translate-phrase">Тема</span>(Edit)</b>:</td>
        <td width="10">&nbsp;</td>
        <td><input type='text' name='posted_data[subject]' value="<?php echo escape($search_prefilled['subject'], 2);; ?>" size="80"></td>
</tr>

<tr>
        <td align='right'>Сообщение <b class="translate"><span class="hidden word">Message</span><span class="hidden translate-phrase">Сообщение</span>(Edit)</b>:</td>
        <td width="10">&nbsp;</td>
        <td><input type='text' name='posted_data[message]' value="<?php echo escape($search_prefilled['message'], 2);; ?>" size="80"></td>
</tr>
<?php $name="posted_data[status]"; $empty='Y'; $status=$search_prefilled['status'];; ?>
<tr>
        <td align='right'>Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b>:</td>
        <td width="10">&nbsp;</td>
        <td><?php include SITE_ROOT."/var/cache/ru/common/ticket_status.php";?></td>
</tr>

<tr>
        <td align='right'>ID тикета <b class="translate"><span class="hidden word">Ticket ID</span><span class="hidden translate-phrase">ID тикета</span>(Edit)</b>:</td>
        <td width="10">&nbsp;</td>
        <td>
<input type='text' name='posted_data[ticketid1]' value='<?php echo $search_prefilled['ticketid1'];?>' size="7">
        </td>
</tr>

<tr>
        <td align='right'>В течение периода времени <b class="translate"><span class="hidden word">During date period</span><span class="hidden translate-phrase">В течение периода времени</span>(Edit)</b>:</td>
        <td width="10">&nbsp;</td>
        <td>
<table cellpadding="0" cellspacing="0">
<tr>
        <td width="5"><input type="radio" id="date_period_A" name="posted_data[date_period]" value="A"<?php if ($search_prefilled['date_period'] == "" or $search_prefilled['date_period'] == "A") {?> checked="checked"<?php } ?> /></td>
        <td class="OptionLabel"><label for="date_period_A">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></label></td>

        <td width="5"><input type="radio" id="date_period_M" name="posted_data[date_period]" value="M"<?php if ($search_prefilled['date_period'] == "M") {?> checked="checked"<?php } ?> /></td>
        <td class="OptionLabel"><label for="date_period_M">За месяц <b class="translate"><span class="hidden word">This month</span><span class="hidden translate-phrase">За месяц</span>(Edit)</b></label></td>

        <td width="5"><input type="radio" id="date_period_W" name="posted_data[date_period]" value="W"<?php if ($search_prefilled['date_period'] == "W") {?> checked="checked"<?php } ?> /></td>
        <td class="OptionLabel"><label for="date_period_W">За неделю <b class="translate"><span class="hidden word">This week</span><span class="hidden translate-phrase">За неделю</span>(Edit)</b></label></td>

        <td width="5"><input type="radio" id="date_period_D" name="posted_data[date_period]" value="D"<?php if ($search_prefilled['date_period'] == "D") {?> checked="checked"<?php } ?> /></td>
        <td class="OptionLabel"><label for="date_period_D">За сегодня <b class="translate"><span class="hidden word">Today</span><span class="hidden translate-phrase">За сегодня</span>(Edit)</b></label></td>
</tr>
<tr>
        <td width="5"><input type="radio" id="date_period_C" name="posted_data[date_period]" value="C"<?php if ($search_prefilled['date_period'] == "C") {?> checked="checked"<?php } ?> /></td>
        <td colspan="9" class="OptionLabel"><label for="date_period_C">Укажите период ниже <b class="translate"><span class="hidden word">Specify period below</span><span class="hidden translate-phrase">Укажите период ниже</span>(Edit)</b></label></td>
</tr>
</table>
        </td>
</tr>

<tr>
        <td align="right" nowrap="nowrap">Искать период <b class="translate"><span class="hidden word">Search period</span><span class="hidden translate-phrase">Искать период</span>(Edit)</b>:</td>
        <td width="10">&nbsp;</td>
        <td><input type="text" id="date_from" name="posted_data[date_from]" value="<?php  echo $search_prefilled['date_from']; ?>" size="7" /> - <input type="text" id="date_to" name="posted_data[date_to]" value="<?php  echo $search_prefilled['date_to']; ?>" size="7" /></td>
</tr>

<tr>
        <td></td>
        <td><input id="unread" type="checkbox" name="posted_data[unread]" value="Y"<?php if ($search_prefilled['unread'] == "Y") {?> checked<?php } ?>></td>
        <td><label for="unread" style='cursor: pointer;'>Непрочитанные тикеты <b class="translate"><span class="hidden word">Unread tickets</span><span class="hidden translate-phrase">Непрочитанные тикеты</span>(Edit)</b></label></td>
</tr>

<tr>
        <td colspan='2'</td>
        <td><input type="submit" value="Поиск <b class="translate"><span class="hidden word">Search</span><span class="hidden translate-phrase">Поиск</span>(Edit)</b>" />&nbsp;&nbsp;&nbsp;<input type="button" value="Сбросить <b class="translate"><span class="hidden word">Reset</span><span class="hidden translate-phrase">Сбросить</span>(Edit)</b>" onclick="javascript: self.location='/admin/support_desk/reset';" /></td>
</tr>

</table>


</form>

<br />

<?php } ?>


<?php if ($_GET['mode'] == "search" && $tickets) {?>

<a name="results"></a>

<?php if ($_GET['mode'] == "search") {?>
<?php if ($total_items > "0") {?>
Результаты найдены <b class="translate"><span class="hidden word">Results found</span><span class="hidden translate-phrase">Результаты найдены</span>(Edit)</b>: <?php echo $total_items;?><br />
Отображение <b class="translate"><span class="hidden word">Displaying</span><span class="hidden translate-phrase">Отображение</span>(Edit)</b> <?php echo $first_item;?>-<?php echo $last_item;?> результатов <b class="translate"><span class="hidden word">results</span><span class="hidden translate-phrase">результатов</span>(Edit)</b>
<?php } else  { ?>
Тикеты не найдены <b class="translate"><span class="hidden word">No tickets found</span><span class="hidden translate-phrase">Тикеты не найдены</span>(Edit)</b>
<?php } ?>
<?php } ?>

<br /><br />

<h3>Результаты поиска <b class="translate"><span class="hidden word">Search results</span><span class="hidden translate-phrase">Результаты поиска</span>(Edit)</b></h3>

<div align="right"><a href="/admin/support_desk/">Повторный поиск <b class="translate"><span class="hidden word">Search again</span><span class="hidden translate-phrase">Повторный поиск</span>(Edit)</b></a></div>

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<br />
<?php 
}
?>

<br /><a href="javascript: void(0);" onclick="javascript: check_all(document.ticketsform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.ticketsform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>

<form action="tickets.php" method="post" name="ticketsform">
<input type="hidden" name="mode" value="" />
<?php if ($navigation_page > 1) {?>
<input type="hidden" name="pagestr" value="&amp;page=<?php echo $navigation_page;?>" />
<?php } ?>


<table cellpadding="2" cellspacing="1" width="100%" class="lines-table">

<tr>
        <th>&nbsp;</th>
        <th>#</th>
        <th>Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></th>
        <th>Тип <b class="translate"><span class="hidden word">Type</span><span class="hidden translate-phrase">Тип</span>(Edit)</b></th>
        <th>Тема <b class="translate"><span class="hidden word">Subject</span><span class="hidden translate-phrase">Тема</span>(Edit)</b></th>
        <th>Клиент <b class="translate"><span class="hidden word">Customer</span><span class="hidden translate-phrase">Клиент</span>(Edit)</b></th>
        <th>Сообщения <b class="translate"><span class="hidden word">Messages</span><span class="hidden translate-phrase">Сообщения</span>(Edit)</b></th>
        <th>Дата <b class="translate"><span class="hidden word">Date</span><span class="hidden translate-phrase">Дата</span>(Edit)</b></th>
        <th>Priority <b class="translate"><span class="hidden word">Priority</span><span class="hidden translate-phrase">Priority</span>(Edit)</b></th>
</tr>

<?php foreach ($tickets as $i) {?>
<tr>
        <td width="5"><input type="checkbox" name="to_delete[<?php echo $i['ticketid'];?>]" /></td>
        <td width='30'><a href="/admin/ticket/<?php echo $i['ticketid'];?>"><?php echo $i['ticketid'];?></a></td>
        <td width="100" align='center'><?php $mode = ''; $name="statuses[".$i['ticketid']."]"; $status=$i['status'];; ?><?php include SITE_ROOT."/var/cache/ru/common/ticket_status.php";?></td>
        <td width="100" align='center'><?php $mode='static'; $name="types[".$i['ticketid']."]"; $type=$i['type'];; ?><?php include SITE_ROOT."/var/cache/ru/common/ticket_type.php";?></td>
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
        <td width="70" align="center"><?php $mode="static"; $value=$i['priority'];; ?><?php include SITE_ROOT."/var/cache/ru/common/ticket_priority.php";?></td>
</tr>
<?php } ?>

<tr>
        <td colspan="9">
<div class="fixed_save_button">
        <input type="button" value="Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b>" onclick="javascript: submitForm(this, 'update');" />
        <input type="button" value="Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b>" onclick="if (confirm('Are you sure?', $(this)) || confirmed) submitForm(this, 'delete');" />
</div>
        </td>
</tr>


</table>
</form>

<br />

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<br />
<?php 
}
?>

<?php } ?>

<br />

