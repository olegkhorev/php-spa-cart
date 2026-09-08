<select name="<?php echo $name;?>">
<option value="0">No membership</option>
<?php if ($memberships) {?>
<?php foreach ($memberships as $m) {?>
<option value="<?php echo $m['membershipid'];?>"<?php if ($value == $m['membershipid']) {?> selected<?php } ?>><?php echo $m['membership'];?></option>
<?php } ?>
<?php } ?>
</select>
