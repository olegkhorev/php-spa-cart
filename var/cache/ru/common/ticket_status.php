<?php if ($mode == "static") {?>

<?php if ($status == "O") {?>
Открытые <b class="translate"><span class="hidden word">Open</span><span class="hidden translate-phrase">Открытые</span>(Edit)</b>
<?php } else if ($status == "C") {?>
Закрытые <b class="translate"><span class="hidden word">Closed</span><span class="hidden translate-phrase">Закрытые</span>(Edit)</b>
<?php } else if ($status == "S") {?>
Запланированные <b class="translate"><span class="hidden word">lbl_ticket_scheduled</span><span class="hidden translate-phrase">Запланированные</span>(Edit)</b>
<?php } else if ($status == "1") {?>
Ожидание консультанта <b class="translate"><span class="hidden word">Waiting for consultant</span><span class="hidden translate-phrase">Ожидание консультанта</span>(Edit)</b>
<?php } else if ($status == "2") {?>
Ожидание клиента <b class="translate"><span class="hidden word">Waiting for client</span><span class="hidden translate-phrase">Ожидание клиента</span>(Edit)</b>
<?php } else if ($status == "3") {?>
Отменен <b class="translate"><span class="hidden word">Cancelled</span><span class="hidden translate-phrase">Отменен</span>(Edit)</b>
<?php } ?>

<?php } else  { ?>

<select name="<?php echo $name;?>" <?php echo $extra;?><?php if ($onchange) {?> onchange="<?php echo $onchange;?>"<?php } ?>>
<?php if ($empty == "Y") {?>
<option value=""<?php if ($status == "") {?> selected<?php } ?>>Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
<?php } ?>
<option value="O"<?php if ($status == "O") {?> selected<?php } ?>>Открытые <b class="translate"><span class="hidden word">Open</span><span class="hidden translate-phrase">Открытые</span>(Edit)</b></option>
<option value="C"<?php if ($status == "C") {?> selected<?php } ?>>Закрытые <b class="translate"><span class="hidden word">Closed</span><span class="hidden translate-phrase">Закрытые</span>(Edit)</b></option>
<?php /* ?>
<option value="S"<?php if ($status == "S") {?> selected<?php } ?>>Запланированные <b class="translate"><span class="hidden word">lbl_ticket_scheduled</span><span class="hidden translate-phrase">Запланированные</span>(Edit)</b></option>
<?php */ ?>
<?php /* ?>
<option value="1"<?php if ($status == "1") {?> selected<?php } ?>>Ожидание консультанта <b class="translate"><span class="hidden word">Waiting for consultant</span><span class="hidden translate-phrase">Ожидание консультанта</span>(Edit)</b></option>
<option value="2"<?php if ($status == "2") {?> selected<?php } ?>>Ожидание клиента <b class="translate"><span class="hidden word">Waiting for client</span><span class="hidden translate-phrase">Ожидание клиента</span>(Edit)</b></option>
<?php */ ?>
<option value="3"<?php if ($status == "3") {?> selected<?php } ?>>Отменен <b class="translate"><span class="hidden word">Cancelled</span><span class="hidden translate-phrase">Отменен</span>(Edit)</b></option>
</select>

<?php } ?>
