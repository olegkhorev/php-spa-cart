<?php if ($v['gift_card']) {?>
<b>Подарочная Карта <b class="translate"><span class="hidden word">Gift Card</span><span class="hidden translate-phrase">Подарочная Карта</span>(Edit)</b></b><br />
Вы увидите фразу-пароль для подарочной карты в оплаченной счет-фактуре <b class="translate"><span class="hidden word">You will see the Gift Card key phrase on paid invoice</span><span class="hidden translate-phrase">Вы увидите фразу-пароль для подарочной карты в оплаченной счет-фактуре</span>(Edit)</b>
<?php } else  { ?>
	  <a href="<?php echo $current_location;?>/<?php echo $url;?>"><?php echo $v['name'];?></a>
<?php } ?>
<?php if ($v['weight']) {?>
<br /><small>Вес <b class="translate"><span class="hidden word">Weight</span><span class="hidden translate-phrase">Вес</span>(Edit)</b>: <?php echo price_format($v['weight']).' <span class="weight-symbol">lbs</span>'; ?></small>
<?php } ?>
<?php if ($v['product_options']) {?>
<hr />
<b>Выбранные параметры <b class="translate"><span class="hidden word">Selected options</span><span class="hidden translate-phrase">Выбранные параметры</span>(Edit)</b>:</b><br />
<table width="100%">
<?php foreach ($v['product_options'] as $o) {?>
<tr>
	<td width="100" valign="top"><?php echo $o['name'];?>:</td>
	<td><?php echo $o['option']['name'];?></td>
</tr>
<?php } ?>
</table>
<?php } ?>