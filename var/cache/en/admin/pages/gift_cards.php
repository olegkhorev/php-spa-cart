<div class="padding-page gift_cards">
<h3>Add a new gift card</h3>
<form method="POST">
<input type="text" name="amount" placeholder="Enter Gift Card amount $" />
<button>Create</button>
</form>

<?php if ($gift_cards) {?>
<form method="POST">
<h3>Earlier purchased gift cards</h3>
<table cellspacing="1" class="lines-table">
<tr>
 <th></th>
 <th>Card number</th>
 <th>Amount</th>
 <th>Amount left</th>
 <th>User purchased</th>
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
<button type="button" onclick="javascript: if (confirmed || confirm('', $(this))) submitForm(this, 'delete');">Delete selected</button>
</form>
<?php } ?>
