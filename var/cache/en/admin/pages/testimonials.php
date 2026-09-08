<form method="post" name="testimonialsform">
<input type="hidden" name="mode" value="update" />

<?php 
if ($testimonial) {
?>

<table width="100%" cellspacing="1" cellpadding="2" class="normal-table">
<tr>
  <td width="150" align="right">Name:</td>
  <td><input type="text" size="32" name="to_edit[name]" value="<?php  echo escape($testimonial['name'], 2); ?>"></td>
</tr>
<tr>
  <td align="right">URL:</td>
  <td><input type="text" size="32" name="to_edit[url]" value="<?php  echo escape($testimonial['url'], 2); ?>"></td>
</tr>
<tr>
  <td valign="top" align="right">Testimonial:</td>
  <td><textarea name="to_edit[message]" cols="40" rows="10"><?php  echo $testimonial['message']; ?></textarea></td>
</tr>
<tr>
  <td align="right">Status:</td>
  <td>
<select name="to_edit[status]">
<option value="P">Pending</option>
<option value="A"<?php  if ($testimonial['status'] == 'A') echo ' selected'; ?>>Approved</option>
</select>
  </td>
</tr>
</table>

<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(document.testimonialsform, 'edit');">Save</button>
</div>
<?php 
} else if ($testimonials) {

if ($total_pages > 2) {
?>
<br />
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php 
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.testimonialsform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.testimonialsform, 'to_delete', false);">Uncheck all</a>
<table cellpadding="3" cellspacing="0" width="900" class="lines-table">

<tr>
        <th width="10">&nbsp;</th>
        <th width="70">Status</th>
        <th>Testimonial</th>
        <th width="250">User</th>
        <th width="70">Date</th>
        <th width="70">Action</th>
</tr>

<?php 
foreach ($testimonials as $t) {
?>
<tr>
        <td class="underline"><input type="checkbox" name="to_delete[<?php  echo $t['tid']; ?>]" value="Y"></td>
        <td class="underline">
<select name="to_update[<?php  echo $t['tid']; ?>][status]">
<option value="A">Approved</option>
<option value="P"<?php  if ($t['status'] == 'P') echo ' selected'; ?>>Pending</option>
</select>
        </td>
        <td class="underline"><?php  echo $t['message']; ?></td>
        <td class="underline"><a target="_blank" href="/admin/user/<?php  echo $t['userid']; ?>"><?php  echo $t['name'].'('.$t['email'].')'; ?></a></td>
        <td class="underline" align="right"><?php  echo date($date_format, $t['date']); ?></td>
        <td class="underline" align="right"><a href="/admin/testimonials/<?php  echo $t['tid']; ?>">Modify</a></td>
</tr>
<?php 
}
?>
</table>
<div class="fixed_save_button">
        <button type="button" onclick="javascript: submitForm(document.testimonialsform, 'update');">Update</button>
        &nbsp;
        <button type="button" onclick="javascript: submitForm(document.testimonialsform, 'delete');">Delete selected</button>
</div>
<?php 
} else  {
?>
<center>No testimonials</center>
<?php 
}
?>
</form>