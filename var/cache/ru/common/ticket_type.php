<?php if ($mode == "static") {?>
<?php if ($type == "C") {?>Свяжитесь с нами <b class="translate"><span class="hidden word">Contact us</span><span class="hidden translate-phrase">Свяжитесь с нами</span>(Edit)</b><?php } else if ($type == "P") {?>товар <b class="translate"><span class="hidden word">Product</span><span class="hidden translate-phrase">товар</span>(Edit)</b><?php } else if ($type == "T") {?>Тема тикета <b class="translate"><span class="hidden word">Ticket topic</span><span class="hidden translate-phrase">Тема тикета</span>(Edit)</b><?php } else if ($type == "M") {?>Почтовый ящик для тикетов <b class="translate"><span class="hidden word">Ticket mailbox</span><span class="hidden translate-phrase">Почтовый ящик для тикетов</span>(Edit)</b><?php } ?>
<?php } else  { ?>
<select name="<?php echo $name;?>" <?php echo $extra;?>>
<?php if ($empty == "Y") {?>
<option value=""<?php if ($type == "") {?> selected<?php } ?>>Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
<?php } ?>
<?php /* ?><?php if ($config['Tickets']['tickets_contactus'] == "Y") {?><?php */ ?>
<option value="C"<?php if ($type == "C") {?> selected<?php } ?>>Свяжитесь с нами <b class="translate"><span class="hidden word">Contact us</span><span class="hidden translate-phrase">Свяжитесь с нами</span>(Edit)</b></option>
<?php /* ?><?php } ?><?php */ ?>
<?php /* ?><?php if ($config.Tickets.tickets_product == "Y") {?><?php */ ?>
<option value="P"<?php if ($type == "P") {?> selected<?php } ?>>товар <b class="translate"><span class="hidden word">Product</span><span class="hidden translate-phrase">товар</span>(Edit)</b></option>
<?php /* ?><?php } ?><?php */ ?>
<?php /* ?>
<option value="T"<?php if ($type == "T") {?> selected<?php } ?>><?php echo $lng.lbl_ticket_topic;?></option>
<option value="M"<?php if ($type == "M") {?> selected<?php } ?>><?php echo $lng.lbl_ticket_mailbox;?></option>
<?php */ ?>
</select>
<?php } ?>
