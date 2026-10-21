<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Membership levels</h1>
<br />
<form method="post">
<input type="hidden" name="mode" value="update" />

<table class="lines-table resp-table">
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th style="width:50%">Membership</th>
	<th style="width:15%;text-align:center">Active</th>
	<th style="width:15%;text-align:center">Pos</th>
	<th style="width:20%;white-space:nowrap;text-align:center">Assigned users</th>
</tr>
</thead>
<?php  if ($memberships) {
    foreach ($memberships as $v) { ?>
<tr>
	<td><input type="checkbox" name="to_delete[]" value="<?php  echo $v[
     "membershipid"
 ]; ?>" /></td>
	<td><label>Membership</label><input type="text" size="30" name="posted_data[<?php  echo $v[
     "membershipid"
 ]; ?>][membership]" value="<?php  echo escape($v["membership"]); ?>" /></td>
	<td class="td-align-center"><label>Active</label><input type="checkbox" name="posted_data[<?php  echo $v[
     "membershipid"
 ]; ?>][active]" value="Y"<?php  echo $v["active"] == "Y"
    ? ' checked="checked"'
    : ""; ?> /></td>
	<td class="td-align-center"><label>Pos</label><input type="text" size="5" name="posted_data[<?php  echo $v[
     "membershipid"
 ]; ?>][orderby]" value="<?php  echo $v["orderby"]; ?>" /></td>
	<td class="td-align-center"><label>Assigned users</label><?php  echo $v["users"]
     ? $v["users"]
     : "0"; ?></td>
</tr>
<?php  } ?>
<tr>
	<td colspan="5" class="var-wh-100 background-transparent">
<br />
	<button>Update</button> &nbsp; <button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete')">Delete selected</button>
	</td>
</tr>
<?php 
} else  {
     ?>

<tr>
	<td colspan="5" class="var-wh-100 background-transparent td-align-center"><br />No memberships defined</td>
</tr>

<?php 
} ?>

<tr>
	<td colspan="5" class="var-wh-100 background-transparent"><br /><h3>Add new</h3></td>
</tr>

<tr>
	<td class="background-transparent">&nbsp;</td>
	<td class="background-transparent"><label>Membership</label><input type="text" size="30" name="add[membership]" /></td>
	<td class="background-transparent td-align-center"><label>Active</label><input type="checkbox" name="add[active]" value="Y" checked="checked" /></td>
	<td class="background-transparent td-align-center"><label>Pos</label><input type="text" size="5" name="add[orderby]" value="" /></td>
	<td class="background-transparent"><label>&nbsp;</label><button type="button" onclick="javascript: submitForm(this, 'add');">Add</button></td>
</tr>

</table>

</form>