<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Testimonials</h1>

<br />

<form method="post" name="testimonialsform">
<input type="hidden" name="mode" value="update" />

<?php  if ($testimonial) { ?>

<table style="width:100%" class="normal-table">
<tr>
  <td style="width:150px;text-align:right">Name:</td>
  <td><input type="text" size="32" name="to_edit[name]" value="<?php  echo escape(
      $testimonial["name"],
      2,
  ); ?>"></td>
</tr>
<tr>
  <td style="text-align:right">URL:</td>
  <td><input type="text" size="32" name="to_edit[url]" value="<?php  echo escape(
      $testimonial["url"],
      2,
  ); ?>"></td>
</tr>
<tr>
  <td style="text-align:right">Testimonial:</td>
  <td><textarea name="to_edit[message]" cols="40" rows="10" class="border-radius-25"><?php  echo $testimonial[
      "message"
  ]; ?></textarea></td>
</tr>
<tr>
  <td style="text-align:right">Status:</td>
  <td>
<select name="to_edit[status]">
<option value="P">Pending</option>
<option value="A"<?php  if ($testimonial["status"] == "A") {
    echo " selected";
} ?>>Approved</option>
</select>
  </td>
</tr>
</table>

<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(document.testimonialsform, 'edit');">Save</button>
</div>
<?php  } else if ($testimonials) {
    if ($total_pages > 2) { ?>
<br />
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php  } ?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.testimonialsform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.testimonialsform, 'to_delete', false);">Uncheck all</a>

<br /><br />

<table class="lines-table resp-table">
<thead>
<tr>
        <th style="width:10px">&nbsp;</th>
        <th style="width:70px">Status</th>
        <th>Testimonial</th>
        <th style="width:250px">User</th>
        <th style="width:70px">Date</th>
        <th style="width:70px">Action</th>
</tr>
</thead>
<?php  foreach ($testimonials as $t) { ?>
<tr>
        <td class="underline"><input type="checkbox" name="to_delete[<?php  echo $t[
            "tid"
        ]; ?>]" value="Y"></td>
        <td class="underline"><label>Status</label>
<select name="to_update[<?php  echo $t["tid"]; ?>][status]">
<option value="A">Approved</option>
<option value="P"<?php  if ($t["status"] == "P") {
    echo " selected";
} ?>>Pending</option>
</select>
        </td>
        <td class="underline"><label>Testimonial</label><?php  echo $t[
            "message"
        ]; ?></td>
        <td class="underline"><label>User</label><a target="_blank" href="/admin/user/<?php  echo $t[
            "userid"
        ]; ?>"><?php  echo $t["name"] . "(" . $t["email"] . ")"; ?></a></td>
        <td style="text-align:right" class="underline"><label>Date</label><?php  echo date(
            $date_format,
            $t["date"],
        ); ?></td>
        <td style="text-align:right" class="underline"><a href="/admin/testimonials/<?php  echo $t[
            "tid"
        ]; ?>">Modify</a></td>
</tr>
<?php  } ?>
</table>
<div class="fixed_save_button">
        <button type="button" onclick="javascript: submitForm(document.testimonialsform, 'update');">Update</button>
        &nbsp;
        <button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(document.testimonialsform, 'delete');">Delete selected</button>
</div>
<?php 
} else  {
     ?>
<div style="text-align:center">No testimonials</div>
<?php 
} ?>
</form>