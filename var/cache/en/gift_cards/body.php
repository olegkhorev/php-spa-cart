<div class="padding-page gift_cards">
<h1>Gift Cards</h1>

<h3>Purchase a new gift card</h3>
<input type="text" name="gift_card" id="gift_card" placeholder="Enter Gift Card amount $" />
<button>Add to cart</button>
<?php if ($gift_cards) {?>

<h3>Earlier purchased gift cards</h3>
<table>
<tr>
 <th>Card number</th>
 <th>Amount</th>
 <th>Amount left</th>
</tr>
<?php foreach ($gift_cards as $k=>$v) {?>
<tr>
 <td><?php echo $v['gcid'];?></td>
 <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount']); ?></td>
 <td><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount_left']); ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>
