<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Membership levels]}</h1>
<br />
<form method="post">
<input type="hidden" name="mode" value="update" />

<table cellpadding="3" cellspacing="1" width="600" class="lines-table lines-table resp-table">
<thead>
<tr>
	<th width="10">&nbsp;</th>
	<th width="50%">{lng[Membership]}</th>
	<th width="15%" align="center">{lng[Active]}</th>
	<th width="15%" align="center">{lng[Pos]}</th>
	<th width="20%" nowrap="nowrap" align="center">{lng[Assigned users]}</th>
</tr>
</thead>
<?php if ($memberships) {
    foreach ($memberships as $v) { ?>
<tr>
	<td><input type="checkbox" name="to_delete[]" value="<?php echo $v[
     "membershipid"
 ]; ?>" /></td>
	<td><label>{lng[Membership]}</label><input type="text" size="30" name="posted_data[<?php echo $v[
     "membershipid"
 ]; ?>][membership]" value="<?php echo escape($v["membership"]); ?>" /></td>
	<td align="center"><label>{lng[Active]}</label><input type="checkbox" name="posted_data[<?php echo $v[
     "membershipid"
 ]; ?>][active]" value="Y"<?php echo $v["active"] == "Y"
    ? ' checked="checked"'
    : ""; ?> /></td>
	<td align="center"><label>{lng[Pos]}</label><input type="text" size="5" name="posted_data[<?php echo $v[
     "membershipid"
 ]; ?>][orderby]" value="<?php echo $v["orderby"]; ?>" /></td>
	<td align="center"><label>{lng[Assigned users]}</label><?php echo $v["users"]
     ? $v["users"]
     : "0"; ?></td>
</tr>
<?php } ?>
<tr>
	<td colspan="5" class="var-wh-100 background-transparent">
<br />
	<button>{lng[Update]}</button>
	<button type="button" onclick="submitForm(this, 'delete')">{lng[Delete selected]}</button>
	</td>
</tr>
<?php
} else {
     ?>

<tr>
	<td colspan="5" align="center" class="var-wh-100 background-transparent"><br />{lng[No memberships defined]}</td>
</tr>

<?php
} ?>

<tr>
	<td colspan="5" class="var-wh-100 background-transparent"><br /><h3>{lng[Add new]}</h3></td>
</tr>

<tr>
	<td class="background-transparent">&nbsp;</td>
	<td class="background-transparent"><label>{lng[Membership]}</label><input type="text" size="30" name="add[membership]" /></td>
	<td class="background-transparent" align="center"><label>{lng[Active]}</label><input type="checkbox" name="add[active]" value="Y" checked="checked" /></td>
	<td class="background-transparent" align="center"><label>{lng[Pos]}</label><input type="text" size="5" name="add[orderby]" value="" /></td>
	<td class="background-transparent"><label>&nbsp;</label><button type="button" onclick="javascript: submitForm(this, 'add');">{lng[Add]}</button></td>
</tr>

</table>

</form>