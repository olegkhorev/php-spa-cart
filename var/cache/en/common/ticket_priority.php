<?php if ($mode == "plain") {?>
<?php if ($value == "1") {?>Can wait<?php } else if ($value == "2") {?>Normal<?php } else if ($value == "3") {?>High<?php } else if ($value == "4") {?>Hot Rush<?php } ?>
<?php } else if ($mode == "static") {?>
<?php if ($value == "1") {?>
<font color="blue">Can wait</font>
<?php } else if ($value == "2") {?>
<font color="black">Normal</font>
<?php } else if ($value == "3") {?>
<font color="red">High</font>
<?php } else if ($value == "4") {?>
<font color="red"><b>Hot Rush</b></font>
<?php } ?>
<?php } else  { ?>
<select name="<?php echo $name;?>" <?php echo $extra;?>>
<?php if ($empty == "Y") {?>
<option value=""<?php if ($value == "") {?> selected<?php } ?>>All</option>
<?php } ?>
<option value="1"<?php if ($value == "1") {?> selected<?php } ?>>Can wait</option>
<option value="2"<?php if ($value == "2" || (!$value && $empty != "Y")) {?> selected<?php } ?>>Normal</option>
<option value="3"<?php if ($value == "3") {?> selected<?php } ?>>High</option>
<option value="4"<?php if ($value == "4") {?> selected<?php } ?>>Hot Rush</option>
</select>
<?php } ?>
