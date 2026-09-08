<?php if ($mode == "static") {?>

<?php if ($status == "O") {?>
Open
<?php } else if ($status == "C") {?>
Closed
<?php } else if ($status == "S") {?>
Scheduled
<?php } else if ($status == "1") {?>
Waiting for consultant
<?php } else if ($status == "2") {?>
Waiting for client
<?php } else if ($status == "3") {?>
Cancelled
<?php } ?>

<?php } else  { ?>

<select name="<?php echo $name;?>" <?php echo $extra;?><?php if ($onchange) {?> onchange="<?php echo $onchange;?>"<?php } ?>>
<?php if ($empty == "Y") {?>
<option value=""<?php if ($status == "") {?> selected<?php } ?>>All</option>
<?php } ?>
<option value="O"<?php if ($status == "O") {?> selected<?php } ?>>Open</option>
<option value="C"<?php if ($status == "C") {?> selected<?php } ?>>Closed</option>
<?php /* ?>
<option value="S"<?php if ($status == "S") {?> selected<?php } ?>>Scheduled</option>
<?php */ ?>
<?php /* ?>
<option value="1"<?php if ($status == "1") {?> selected<?php } ?>>Waiting for consultant</option>
<option value="2"<?php if ($status == "2") {?> selected<?php } ?>>Waiting for client</option>
<?php */ ?>
<option value="3"<?php if ($status == "3") {?> selected<?php } ?>>Cancelled</option>
</select>

<?php } ?>
