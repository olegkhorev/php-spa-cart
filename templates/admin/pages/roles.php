<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Roles]}</h1>
<br />
<form method="post">
<input type="hidden" name="mode" value="update" />

<a href="/admin/roles/new" class="ajax_link link-button">{lng[New role]}</a><br /><br />

<table class="lines-table resp-table">
<?php if ($roles) { ?>
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th style="width:80%">{lng[Title]}</th>
	<th style="width:15%;text-align:center">{lng[Pos]}</th>
</tr>
</thead>
<?php foreach ($roles as $v) { ?>
<tr>
	<td><input type="checkbox" name="to_delete[]" value="<?php echo $v[
     "roleid"
 ]; ?>" /></td>
	<td><label>{lng[Title]}</label><a href="/admin/roles/{$v['roleid']}" class="ajax_link">{$v['title']}</a></td>
	<td class="td-align-center"><label>{lng[Pos]}</label><input type="text" size="5" name="posted_data[<?php echo $v[
     "roleid"
 ]; ?>][pos]" value="<?php echo $v["pos"]; ?>" /></td>
</tr>
<?php } ?>
<?php } else { ?>

<tr>
	<td colspan="3" class="td-align-center"><br />{lng[No Roles defined]}</td>
</tr>

<?php } ?>

</table>

{if $roles}
<div class="fixed_save_button">
	<button>{lng[Update]}</button>
	<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete')">{lng[Delete selected]}</button>
</div>
{/if}
</form>