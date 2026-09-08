<form method="post" name="roleform">
<input type="hidden" name="mode" value="<?php if ($role) {?>save<?php } else  { ?>add<?php } ?>" />
<?php 
if ($get['2'] == 'new') {
?>
	<h3>New role</h3>
<?php 
}
?>

<table cellpadding="3" cellspacing="1" width="90%" class="normal-table">

<tr>
 <td><b>Title</b></td>
 <td><input type="text" name="title" size="40" value="<?php  echo escape($role['title'], 2); ?>" /></td>
</tr>

<tr>
 <td><b>Position</b></td>
 <td><input type="text" name="pos" size="10" value="<?php  echo escape($role['pos'], 2); ?>" /></td>
</tr>

<tr>
 <td><b>Permissions</b></td>
 <td>
<select name="pages[]" multiple size="15">
<option value="root"<?php foreach ($role['pages'] as $v) {?><?php if ('root' == $v) {?> selected<?php } ?><?php } ?>>Root admin</option>
<?php foreach ($role_pages as $p) {?>
<optgroup label="<?php echo $p['title'];?>">
<?php if ($p['pages']) {?>
<?php foreach ($p['pages'] as $s) {?>
<option value="<?php echo $s['id'];?>"<?php foreach ($role['pages'] as $v) {?><?php if ($s['id'] == $v) {?> selected<?php } ?><?php } ?>><?php echo $s['title'];?></option>
<?php } ?>
<?php } ?>
</optgroup>
<?php } ?>
</select>
 </td>
</tr>

</table>
<br />
<div class="fixed_save_button">
<button type="submit"><?php  if ($get['2'] == 'new') { ?>Add<?php  } else  { ?>Save<?php  } ?></button>
</div>
</form>
