<form method="post" name="roleform">
<input type="hidden" name="mode" value="<?php if ($role) {?>save<?php } else  { ?>add<?php } ?>" />
<?php 
if ($get['2'] == 'new') {
?>
	<h3>New role <b class="translate"><span class="hidden word">New role</span><span class="hidden translate-phrase">New role</span>(Edit)</b></h3>
<?php 
}
?>

<table cellpadding="3" cellspacing="1" width="90%" class="normal-table">

<tr>
 <td><b>Заголовок <b class="translate"><span class="hidden word">Title</span><span class="hidden translate-phrase">Заголовок</span>(Edit)</b></b></td>
 <td><input type="text" name="title" size="40" value="<?php  echo escape($role['title'], 2); ?>" /></td>
</tr>

<tr>
 <td><b>Позиция <b class="translate"><span class="hidden word">Position</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></b></td>
 <td><input type="text" name="pos" size="10" value="<?php  echo escape($role['pos'], 2); ?>" /></td>
</tr>

<tr>
 <td><b>Permissions <b class="translate"><span class="hidden word">Permissions</span><span class="hidden translate-phrase">Permissions</span>(Edit)</b></b></td>
 <td>
<select name="pages[]" multiple size="15">
<option value="root"<?php foreach ($role['pages'] as $v) {?><?php if ('root' == $v) {?> selected<?php } ?><?php } ?>>Root admin <b class="translate"><span class="hidden word">Root admin</span><span class="hidden translate-phrase">Root admin</span>(Edit)</b></option>
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
<button type="submit"><?php  if ($get['2'] == 'new') { ?>Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b><?php  } else  { ?>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b><?php  } ?></button>
</div>
</form>
