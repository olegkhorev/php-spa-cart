<div class="padding-page gift_cards">
<h3>Добавить подарочную карту <b class="translate"><span class="hidden word">Add a new gift card</span><span class="hidden translate-phrase">Добавить подарочную карту</span>(Edit)</b></h3>
<form method="POST">
<input type="text" name="amount" placeholder="Enter Gift Card amount $" />
<button>Создать <b class="translate"><span class="hidden word">Create</span><span class="hidden translate-phrase">Создать</span>(Edit)</b></button>
</form>

<?php if ($gift_cards) {?>
<form method="POST">
<h3>Ранее приобретенные подарочные карты <b class="translate"><span class="hidden word">Earlier purchased gift cards</span><span class="hidden translate-phrase">Ранее приобретенные подарочные карты</span>(Edit)</b></h3>
<table cellspacing="1" class="lines-table">
<tr>
 <th></th>
 <th>Номер карты <b class="translate"><span class="hidden word">Card number</span><span class="hidden translate-phrase">Номер карты</span>(Edit)</b></th>
 <th>Сумма <b class="translate"><span class="hidden word">Amount</span><span class="hidden translate-phrase">Сумма</span>(Edit)</b></th>
 <th>Осталось <b class="translate"><span class="hidden word">Amount left</span><span class="hidden translate-phrase">Осталось</span>(Edit)</b></th>
 <th>Пользователь <b class="translate"><span class="hidden word">User purchased</span><span class="hidden translate-phrase">Пользователь</span>(Edit)</b></th>
</tr>
<?php foreach ($gift_cards as $k=>$v) {?>
<tr>
 <td><input type="checkbox" name="to_delete[<?php echo $v['gcid'];?>]" value="1" /></td>
 <td><?php echo $v['gcid'];?></td>
 <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount']); ?></td>
 <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount_left']); ?></td>
 <td>
<?php if ($v['user']) {?>
<a href="<?php echo $current_location;?>/admin/user/<?php echo $v['userid'];?>" target="_blank"><?php echo $v['user']['firstname'];?> <?php echo $v['user']['lastname'];?> (<?php echo $v['user']['email'];?>)</a>
<?php } ?>
 </td>
</tr>
<?php } ?>
</table>
<button type="button" onclick="javascript: if (confirmed || confirm('', $(this))) submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</form>
<?php } ?>
