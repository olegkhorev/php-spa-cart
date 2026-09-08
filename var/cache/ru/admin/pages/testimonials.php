<form method="post" name="testimonialsform">
<input type="hidden" name="mode" value="update" />

<?php 
if ($testimonial) {
?>

<table width="100%" cellspacing="1" cellpadding="2" class="normal-table">
<tr>
  <td width="150" align="right">Имя <b class="translate"><span class="hidden word">Name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b>:</td>
  <td><input type="text" size="32" name="to_edit[name]" value="<?php  echo escape($testimonial['name'], 2); ?>"></td>
</tr>
<tr>
  <td align="right">URL <b class="translate"><span class="hidden word">URL</span><span class="hidden translate-phrase">URL</span>(Edit)</b>:</td>
  <td><input type="text" size="32" name="to_edit[url]" value="<?php  echo escape($testimonial['url'], 2); ?>"></td>
</tr>
<tr>
  <td valign="top" align="right">Отзыв <b class="translate"><span class="hidden word">Testimonial</span><span class="hidden translate-phrase">Отзыв</span>(Edit)</b>:</td>
  <td><textarea name="to_edit[message]" cols="40" rows="10"><?php  echo $testimonial['message']; ?></textarea></td>
</tr>
<tr>
  <td align="right">Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b>:</td>
  <td>
<select name="to_edit[status]">
<option value="P">На рассмотрении <b class="translate"><span class="hidden word">Pending</span><span class="hidden translate-phrase">На рассмотрении</span>(Edit)</b></option>
<option value="A"<?php  if ($testimonial['status'] == 'A') echo ' selected'; ?>>Одобрено <b class="translate"><span class="hidden word">Approved</span><span class="hidden translate-phrase">Одобрено</span>(Edit)</b></option>
</select>
  </td>
</tr>
</table>

<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(document.testimonialsform, 'edit');">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
</div>
<?php 
} else if ($testimonials) {

if ($total_pages > 2) {
?>
<br />
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<br />
<?php 
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.testimonialsform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.testimonialsform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<table cellpadding="3" cellspacing="0" width="900" class="lines-table">

<tr>
        <th width="10">&nbsp;</th>
        <th width="70">Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></th>
        <th>Отзыв <b class="translate"><span class="hidden word">Testimonial</span><span class="hidden translate-phrase">Отзыв</span>(Edit)</b></th>
        <th width="250">Пользователь <b class="translate"><span class="hidden word">User</span><span class="hidden translate-phrase">Пользователь</span>(Edit)</b></th>
        <th width="70">Дата <b class="translate"><span class="hidden word">Date</span><span class="hidden translate-phrase">Дата</span>(Edit)</b></th>
        <th width="70">Действия <b class="translate"><span class="hidden word">Action</span><span class="hidden translate-phrase">Действия</span>(Edit)</b></th>
</tr>

<?php 
foreach ($testimonials as $t) {
?>
<tr>
        <td class="underline"><input type="checkbox" name="to_delete[<?php  echo $t['tid']; ?>]" value="Y"></td>
        <td class="underline">
<select name="to_update[<?php  echo $t['tid']; ?>][status]">
<option value="A">Одобрено <b class="translate"><span class="hidden word">Approved</span><span class="hidden translate-phrase">Одобрено</span>(Edit)</b></option>
<option value="P"<?php  if ($t['status'] == 'P') echo ' selected'; ?>>На рассмотрении <b class="translate"><span class="hidden word">Pending</span><span class="hidden translate-phrase">На рассмотрении</span>(Edit)</b></option>
</select>
        </td>
        <td class="underline"><?php  echo $t['message']; ?></td>
        <td class="underline"><a target="_blank" href="/admin/user/<?php  echo $t['userid']; ?>"><?php  echo $t['name'].'('.$t['email'].')'; ?></a></td>
        <td class="underline" align="right"><?php  echo date($date_format, $t['date']); ?></td>
        <td class="underline" align="right"><a href="/admin/testimonials/<?php  echo $t['tid']; ?>">Изменить <b class="translate"><span class="hidden word">Modify</span><span class="hidden translate-phrase">Изменить</span>(Edit)</b></a></td>
</tr>
<?php 
}
?>
</table>
<div class="fixed_save_button">
        <button type="button" onclick="javascript: submitForm(document.testimonialsform, 'update');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
        &nbsp;
        <button type="button" onclick="javascript: submitForm(document.testimonialsform, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
<?php 
} else  {
?>
<center>Нет отзывов <b class="translate"><span class="hidden word">No testimonials</span><span class="hidden translate-phrase">Нет отзывов</span>(Edit)</b></center>
<?php 
}
?>
</form>