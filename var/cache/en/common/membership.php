<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<select name="<?php echo $name;?>">
<option value="0">No membership</option>
<?php if ($memberships) {?>
<?php foreach ($memberships as $m) {?>
<option value="<?php echo $m['membershipid'];?>"<?php if ($value == $m['membershipid']) {?> selected<?php } ?>><?php echo $m['membership'];?></option>
<?php } ?>
<?php } ?>
</select>
