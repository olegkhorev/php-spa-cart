<?php if ($mode == "plain") {?>
<?php if ($value == "1") {?>Может подождать <b class="translate"><span class="hidden word">lbl_ticket_priority_1</span><span class="hidden translate-phrase">Может подождать</span>(Edit)</b><?php } else if ($value == "2") {?>Нормальный <b class="translate"><span class="hidden word">lbl_ticket_priority_2</span><span class="hidden translate-phrase">Нормальный</span>(Edit)</b><?php } else if ($value == "3") {?>Высокий <b class="translate"><span class="hidden word">lbl_ticket_priority_3</span><span class="hidden translate-phrase">Высокий</span>(Edit)</b><?php } else if ($value == "4") {?>Экстренный <b class="translate"><span class="hidden word">lbl_ticket_priority_4</span><span class="hidden translate-phrase">Экстренный</span>(Edit)</b><?php } ?>
<?php } else if ($mode == "static") {?>
<?php if ($value == "1") {?>
<font color="blue">Может подождать <b class="translate"><span class="hidden word">lbl_ticket_priority_1</span><span class="hidden translate-phrase">Может подождать</span>(Edit)</b></font>
<?php } else if ($value == "2") {?>
<font color="black">Нормальный <b class="translate"><span class="hidden word">lbl_ticket_priority_2</span><span class="hidden translate-phrase">Нормальный</span>(Edit)</b></font>
<?php } else if ($value == "3") {?>
<font color="red">Высокий <b class="translate"><span class="hidden word">lbl_ticket_priority_3</span><span class="hidden translate-phrase">Высокий</span>(Edit)</b></font>
<?php } else if ($value == "4") {?>
<font color="red"><b>Экстренный <b class="translate"><span class="hidden word">lbl_ticket_priority_4</span><span class="hidden translate-phrase">Экстренный</span>(Edit)</b></b></font>
<?php } ?>
<?php } else  { ?>
<select name="<?php echo $name;?>" <?php echo $extra;?>>
<?php if ($empty == "Y") {?>
<option value=""<?php if ($value == "") {?> selected<?php } ?>>Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
<?php } ?>
<option value="1"<?php if ($value == "1") {?> selected<?php } ?>>Может подождать <b class="translate"><span class="hidden word">lbl_ticket_priority_1</span><span class="hidden translate-phrase">Может подождать</span>(Edit)</b></option>
<option value="2"<?php if ($value == "2" || (!$value && $empty != "Y")) {?> selected<?php } ?>>Нормальный <b class="translate"><span class="hidden word">lbl_ticket_priority_2</span><span class="hidden translate-phrase">Нормальный</span>(Edit)</b></option>
<option value="3"<?php if ($value == "3") {?> selected<?php } ?>>Высокий <b class="translate"><span class="hidden word">lbl_ticket_priority_3</span><span class="hidden translate-phrase">Высокий</span>(Edit)</b></option>
<option value="4"<?php if ($value == "4") {?> selected<?php } ?>>Экстренный <b class="translate"><span class="hidden word">lbl_ticket_priority_4</span><span class="hidden translate-phrase">Экстренный</span>(Edit)</b></option>
</select>
<?php } ?>
