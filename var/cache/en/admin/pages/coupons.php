<form method="post">
<input type="hidden" name="mode" value="update" />

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php } ?>

<table cellpadding="3" cellspacing="1" width="900" class="resp-table coupons-table lines-table">
<thead>
<tr>
	<th width="10">&nbsp;</th>
	<th width="20%">Coupon code</th>
	<th width="35%" align="center">Coupon discount</th>
	<th colspan="2" width="30%" align="center">Times to be used</th>
	<th width="15%" nowrap="nowrap" align="center">Status</th>
</tr>
</thead>
<?php 
if ($coupons) {
	foreach ($coupons as $v) {
?>
<tr>
	<td class="coupon-td-1"><input type="checkbox" name="to_delete[<?php  echo $v['coupon']; ?>]" /></td>
	<td class="coupon-td-2"><label>Coupon code</label><?php  echo $v['coupon']; ?></td>
	<td align="center" class="no-word-break coupon-td-3"><label>Coupon discount</label>
<input type="text" size="5" name="posted_data[<?php  echo $v['coupon']; ?>][discount]" value="<?php  echo $v['discount']; ?>" />
<select name="posted_data[<?php  echo $v['coupon']; ?>][discount_type]">
<option value="P">%</option>
<option value="A"<?php  if ($v['discount_type'] == 'A') echo ' selected'; ?>>$</option>
</select>
	</td>
	<td align="center" nowrap class="no-word-break"><label>Times to be used</label><input type="text" size="2" name="posted_data[<?php  echo $v['coupon']; ?>][times]" value="<?php  echo $v['times']; ?>" /> / <?php  echo $v['times_used']; ?></td>
	<td align="center" nowrap class="no-word-break"><label></label><label class="resp-visible"><input type="checkbox" name="posted_data[<?php  echo $v['coupon']; ?>][per_customer]" value="1"<?php  if ($v['per_customer']) echo ' checked'; ?> /> per customer</label></td>
	<td align="center" class="no-word-break"><label>Status</label>
<select name="posted_data[<?php  echo $v['coupon']; ?>][status]">
<option value="Y">Active</option>
<option value="N"<?php  if ($v['status'] == 'N') echo ' selected'; ?>>Disabled</option>
</select>
	</td>
</tr>
<?php 
	}
?>
<tr>
	<td colspan="6" class="resp-td-width-100" style="white-space: normal"s>
	<button>Update</button>
	<button type="button" onclick="submitForm(this, 'delete')">Delete selected</button>
	</td>
</tr>
<?php 
} else  {
?>

<tr>
	<td colspan="6" class="resp-td-width-100" align="center"><br />No discount coupons defined</td>
</tr>

<?php 
}
?>

<tr>
	<td colspan="6" class="resp-td-width-100"><br /><h3>Add new</h3></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><label>Coupon code</label><input type="text" size="20" name="add_coupon[coupon]" /></td>
	<td align="center" class="no-word-break"><label>Coupon discount</label>
<input type="text" size="5" name="add_coupon[discount]" />
<select name="add_coupon[discount_type]">
<option value="P">%</option>
<option value="A">$</option>
</select>
	</td>
	<td align="center"><label>Times to be used</label><input type="text" size="5" name="add_coupon[times]" /></td>
	<td align="center" class="no-word-break"><label></label><label class="resp-visible"><input type="checkbox" name="add_coupon[per_customer]" value="1" /> per customer</label></td>
	<td align="center" class="no-word-break"><label>Status</label>
<select name="add_coupon[status]">
<option value="Y">Active</option>
<option value="N">Disabled</option>
</select>
	</td>
</tr>
<tr>
	<td colspan="6" class="resp-td-width-100"><br /><button type="button" onclick="javascript: submitForm(this, 'add');">Add</button></td>
</tr>
</table>

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php } ?>

</form>