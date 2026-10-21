<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($mode == "plain") {?>
<?php if ($value == "1") {?>Low<?php } else if ($value == "2") {?>Medium<?php } else if ($value == "3") {?>Normal<?php } else if ($value == "4") {?>High<?php } ?>
<?php } else if ($mode == "static") {?>
<?php if ($value == "1") {?>
<span style="color: blue;">Low</span>
<?php } else if ($value == "2") {?>
<span style="color: black;">Medium</span>
<?php } else if ($value == "3") {?>
<span style="color: red;">Normal</span>
<?php } else if ($value == "4") {?>
<span style="color: red;"><b>High</b></span>
<?php } ?>
<?php } else  { ?>
<select name="<?php echo $name;?>" <?php echo $extra;?>>
<?php if ($empty == "Y") {?>
<option value=""<?php if ($value == "") {?> selected<?php } ?>>All</option>
<?php } ?>
<option value="1"<?php if ($value == "1") {?> selected<?php } ?>>Low</option>
<option value="2"<?php if ($value == "2" || (!$value && $empty != "Y")) {?> selected<?php } ?>>Medium</option>
<option value="3"<?php if ($value == "3") {?> selected<?php } ?>>Normal</option>
<option value="4"<?php if ($value == "4") {?> selected<?php } ?>>High</option>
</select>
<?php } ?>
