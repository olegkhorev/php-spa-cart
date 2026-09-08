<select name="<?php echo $name;?>">
<option value="0">Нет членства <b class="translate"><span class="hidden word">No membership</span><span class="hidden translate-phrase">Нет членства</span>(Edit)</b></option>
<?php if ($memberships) {?>
<?php foreach ($memberships as $m) {?>
<option value="<?php echo $m['membershipid'];?>"<?php if ($value == $m['membershipid']) {?> selected<?php } ?>><?php echo $m['membership'];?></option>
<?php } ?>
<?php } ?>
</select>
