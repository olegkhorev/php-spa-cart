<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Discount coupons</h1>
<br />
<form method="post">
<input type="hidden" name="mode" value="update" />

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php } ?>

<table class="resp-table coupons-table lines-table">
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th style="width:20%">Coupon code</th>
	<th style="width:35%;text-align:center">Coupon discount</th>
	<th colspan="2" style="width:30%;text-align:center">Times to be used</th>
	<th style="width:15%;white-space:nowrap;text-align:center">Status</th>
</tr>
</thead>
<?php  if ($coupons) {
    foreach ($coupons as $v) { ?>
<tr>
	<td class="coupon-td-1"><input type="checkbox" name="to_delete[<?php  echo $v[
     "coupon"
 ]; ?>]" /></td>
	<td class="coupon-td-2"><label>Coupon code</label><?php  echo $v[
     "coupon"
 ]; ?></td>
	<td class="no-word-break coupon-td-3 td-align-center"><label>Coupon discount</label>
<input type="text" size="5" name="posted_data[<?php  echo $v[
    "coupon"
]; ?>][discount]" value="<?php  echo $v["discount"]; ?>" />
<select name="posted_data[<?php  echo $v["coupon"]; ?>][discount_type]">
<option value="P">%</option>
<option value="A"<?php  if ($v["discount_type"] == "A") {
    echo " selected";
} ?>>$</option>
</select>
	</td>
	<td class="no-word-break td-align-center td-nowrap"><label>Times to be used</label><input type="text" size="5" name="posted_data[<?php  echo $v[
     "coupon"
 ]; ?>][times]" value="<?php  echo $v["times"]; ?>" /> / <?php  echo $v[
    "times_used"
]; ?></td>
	<td class="no-word-break td-align-center td-nowrap"><label></label><label class="resp-visible"><input type="checkbox" name="posted_data[<?php  echo $v[
     "coupon"
 ]; ?>][per_customer]" value="1"<?php  if ($v["per_customer"]) {
    echo " checked";
} ?> /> per customer</label></td>
	<td class="no-word-break td-align-center"><label>Status</label>
<select name="posted_data[<?php  echo $v["coupon"]; ?>][status]">
<option value="Y">Active</option>
<option value="N"<?php  if ($v["status"] == "N") {
    echo " selected";
} ?>>Disabled</option>
</select>
	</td>
</tr>
<?php  } ?>
<tr>
	<td colspan="6" class="background-transparent resp-td-width-100" style="white-space: normal">
	<button>Update</button> &nbsp; <button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete')">Delete selected</button>
	</td>
</tr>
<?php 
} else  {
     ?>

<tr>
	<td colspan="6" class="background-transparent resp-td-width-100 td-align-center"><br />No discount coupons defined</td>
</tr>

<?php 
} ?>

<tr>
	<td colspan="6" class="background-transparent resp-td-width-100 background-transparent"><br /><h3>Add new</h3></td>
</tr>

<tr>
	<td class="background-transparent">&nbsp;</td>
	<td class="background-transparent"><label>Coupon code</label><input type="text" size="20" name="add_coupon[coupon]" /></td>
	<td class="background-transparent no-word-break td-align-center"><label>Coupon discount</label>
<input type="text" size="5" name="add_coupon[discount]" />
<select name="add_coupon[discount_type]">
<option value="P">%</option>
<option value="A">$</option>
</select>
	</td>
	<td class="background-transparent td-align-center"><label>Times to be used</label><input type="text" size="5" name="add_coupon[times]" /></td>
	<td class="background-transparent no-word-break td-align-center"><label></label><label class="resp-visible"><input type="checkbox" name="add_coupon[per_customer]" value="1" /> per customer</label></td>
	<td class="background-transparent no-word-break td-align-center"><label>Status</label>
<select name="add_coupon[status]">
<option value="Y">Active</option>
<option value="N">Disabled</option>
</select>
	</td>
</tr>
<tr>
	<td colspan="6" class="resp-td-width-100 background-transparent"><br /><button type="button" onclick="javascript: submitForm(this, 'add');">Add</button></td>
</tr>
</table>

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php } ?>

</form>
