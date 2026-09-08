<style>
table td {
	vertical-align: middle;
}
</style>
<h3>Search for reviews</h3>
<form method="POST" href="/admin/reviews?mode=search">
<input type="hidden" name="mode" value="search">
<table width="100%" align="center" cellpadding="2" cellspacing="1">
        <tr>
                <td align="right">Status</td>
                <td><select name="status">
                        <option value="0">Pending</option>
                        <option<?php if ($search_data['status'] == "1") {?> selected<?php } ?> value="1">Approved</option>
                        <option<?php if ($search_data['status'] == "2") {?> selected<?php } ?> value="2">Declined</option>
                        <option<?php if ($search_data['status'] == "" && $search_data) {?> selected<?php } ?> value="">All</option>
                        </select>
                </td>
        <tr>
                <td width="170" align="right">IP Address</td>
                <td><input type="text" size="32" name="remote_ip" value="<?php echo $search_data['remote_ip'];?>"></td>
        </tr>
        <tr>
                <td align="right">Name</td>
                <td><input type="text" size="32" name="name" value="<?php echo $search_data['name'];?>"></td>
        </tr>
        <tr>
                <td align="right">Message</td>
                <td><input type="text" size=80 name="message" value="<?php echo $search_data['message'];?>"></td>
        </tr>
        <tr>
                <td align="right">Product ID</td>
                <td><input type="text" size="32" name="productid" value="<?php echo $search_data['productid'];?>"></td>
        </tr>
        <tr>
                <td align="right">SKU</td>
                <td><input type="text" size="32" name="sku" value="<?php echo $search_data['sku'];?>"></td>
        </tr>
        <tr>
                <td align="right">Rating</td>
                <td>
                                <select name="rating">
                                <option value="">All</option>
                                <option value="5"<?php if ($search_data['rating'] == "5") {?> selected<?php } ?>>5</option>
                                <option value="4"<?php if ($search_data['rating'] == "4") {?> selected<?php } ?>>4</option>
                                <option value="3"<?php if ($search_data['rating'] == "3") {?> selected<?php } ?>>3</option>
                                <option value="2"<?php if ($search_data['rating'] == "2") {?> selected<?php } ?>>2</option>
                                <option value="1"<?php if ($search_data['rating'] == "1") {?> selected<?php } ?>>1</option>
                                </select>
                </td>
        </tr>
        <tr>
                <td></td>
                <td><button>Search</button></td>
        </tr>
</table>
</form>

<?php if ($reviews) {?>
        <br />
<h3>Search results</h3>

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php } ?>

<form action="/admin/reviews" method="post" name="reviewsform">
        <input type="hidden" name="mode" value="edit">
<a href="javascript: void(0);" onclick="javascript: check_all(document.reviewsform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.reviewsform, 'to_delete', false);">Uncheck all</a>
        <table border="0" cellpadding="5" cellspacing="0" class="lines-table">
                <tr>
                        <th></th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>IP</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th nowrap>Product ID/SKU</th>
                </tr>
<?php foreach ($reviews as $r) {?>
                <tr>
                        <td valign="top" width="5%"><input type="checkbox" name="to_delete[<?php echo $r['id'];?>]" value="<?php echo $r['id'];?>"></td>
                        <td valign="top" width="5%">
                                <select name="to_update[<?php echo $r['id'];?>][status]">
                                <option value="0" >Pending</option>
                                <option value="1" <?php if ($r['status'] == "1") {?>selected<?php } ?>>Approved</option>
                                <option value="2" <?php if ($r['status'] == "2") {?>selected<?php } ?>>Declined</option>
                                </select>
                        </td>
                        <td valign="top" width="5%">
                                <select name="to_update[<?php echo $r['id'];?>][rating]">
                                <option value="5"<?php if ($r['rating'] == "5") {?> selected<?php } ?>>5</option>
                                <option value="4"<?php if ($r['rating'] == "4") {?> selected<?php } ?>>4</option>
                                <option value="3"<?php if ($r['rating'] == "3") {?> selected<?php } ?>>3</option>
                                <option value="2"<?php if ($r['rating'] == "2") {?> selected<?php } ?>>2</option>
                                <option value="1"<?php if ($r['rating'] == "1") {?> selected<?php } ?>>1</option>
                                </select>
                        </td>
                        <td valign="top" width="15%"><?php echo $r['remote_ip'];?></td>
                        <td valign="top" width="15%"><?php echo $r['name'];?></td>
                        <td valign="top" width="45%"><textarea cols="40" rows="3" name="to_update[<?php echo $r['id'];?>][message]"><?php echo $r['message'];?></textarea></td>
                        <td valign="top" width="10%"><a href="/admin/products/<?php echo $r['productid'];?>" target="_blank"><?php echo $r['productid'];?>/<?php echo $r['sku'];?></a></td>
                </tr>
<?php } ?>
                <tr>
                        <td colspan="9"><br />
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(document.reviewsform, 'update');">Update</button>
<button type="button" onclick="javascript: if (confirmed || confirm('This operation will delete selected reviews.', $(this))) submitForm(this, 'delete');">Delete selected</button>
</div>
                        </td>
                </tr>
        </table>
        </form>

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php } ?>
<?php } ?>