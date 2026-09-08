<?php if ($mode == "static") {?>
<?php if ($type == "C") {?>Contact us<?php } else if ($type == "P") {?>Product<?php } else if ($type == "T") {?>Ticket topic<?php } else if ($type == "M") {?>Ticket mailbox<?php } ?>
<?php } else  { ?>
<select name="<?php echo $name;?>" <?php echo $extra;?>>
<?php if ($empty == "Y") {?>
<option value=""<?php if ($type == "") {?> selected<?php } ?>>All</option>
<?php } ?>
<?php /* ?><?php if ($config['Tickets']['tickets_contactus'] == "Y") {?><?php */ ?>
<option value="C"<?php if ($type == "C") {?> selected<?php } ?>>Contact us</option>
<?php /* ?><?php } ?><?php */ ?>
<?php /* ?><?php if ($config.Tickets.tickets_product == "Y") {?><?php */ ?>
<option value="P"<?php if ($type == "P") {?> selected<?php } ?>>Product</option>
<?php /* ?><?php } ?><?php */ ?>
<?php /* ?>
<option value="T"<?php if ($type == "T") {?> selected<?php } ?>><?php echo $lng.lbl_ticket_topic;?></option>
<option value="M"<?php if ($type == "M") {?> selected<?php } ?>><?php echo $lng.lbl_ticket_mailbox;?></option>
<?php */ ?>
</select>
<?php } ?>
