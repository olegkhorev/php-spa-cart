<div class="padding-page gift_cards">
<h1>Подарочные Карты <b class="translate"><span class="hidden word">Gift Cards</span><span class="hidden translate-phrase">Подарочные Карты</span>(Edit)</b></h1>

<h3>Купить новую подарочную карту <b class="translate"><span class="hidden word">Purchase a new gift card</span><span class="hidden translate-phrase">Купить новую подарочную карту</span>(Edit)</b></h3>
<input type="text" name="gift_card" id="gift_card" placeholder="Введите сумму <b class="translate"><span class="hidden word">Enter Gift Card amount $</span><span class="hidden translate-phrase">Введите сумму</span>(Edit)</b>" />
<button>Купить <b class="translate"><span class="hidden word">Add to cart</span><span class="hidden translate-phrase">Купить</span>(Edit)</b></button>
<?php if ($gift_cards) {?>

<h3>Ранее приобретенные подарочные карты <b class="translate"><span class="hidden word">Earlier purchased gift cards</span><span class="hidden translate-phrase">Ранее приобретенные подарочные карты</span>(Edit)</b></h3>
<table>
<tr>
 <th>Номер карты <b class="translate"><span class="hidden word">Card number</span><span class="hidden translate-phrase">Номер карты</span>(Edit)</b></th>
 <th>Сумма <b class="translate"><span class="hidden word">Amount</span><span class="hidden translate-phrase">Сумма</span>(Edit)</b></th>
 <th>Осталось <b class="translate"><span class="hidden word">Amount left</span><span class="hidden translate-phrase">Осталось</span>(Edit)</b></th>
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
