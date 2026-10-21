<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Languages</h1>
<br />

<form method="post" name="languagesform">
<input type="hidden" name="mode" value="update" />
<?php if ($translate_mode) {?>
<a href="/admin/language?exit_translate_mode=1" class="mdl-button">Exit the "Translate" mode</a>
<?php } else  { ?>
<a href="/admin/language?translate_mode=1" class="mdl-button">Enter the "Translate" mode</a>
<?php } ?>
&nbsp; (Make sure you do it in Development mode - see settings.php)
<br /><br />

<table class="lines-table resp-table">
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th style="width:15%">Code</th>
	<th style="width:10%">Name</th>
	<th style="width:20%">Active</th>
	<th style="width:20%">Pos</th>
	<th style="width:20%">Main</th>
	<th style="width:20%">Manage</th>
</tr>
</thead>
<?php if ($languages) {?>
<?php  foreach ($languages as $b) {
    echo '<tr>
	<td><input type="checkbox" name="to_delete[' .
        $b["id"] .
        ']" value="Y" /></td>
	<td class="td-align-center"><label>Code</label><input type="text" size="3" name="to_update[' .
        $b["id"] .
        '][code]" value="' .
        $b["code"] .
        '" /></td>
	<td class="td-align-center"><label>Name</label><input type="text" size="30" name="to_update[' .
        $b["id"] .
        '][name]" value="' .
        $b["name"] .
        '" /></td>
	<td class="td-align-center"><label>Active</label><input type="checkbox" name="to_update[' .
        $b["id"] .
        '][active]" value="1"' .
        ($b["active"] ? ' checked="checked"' : "") .
        ' /></td>
	<td class="td-align-center"><label>Pos</label><input type="text" size="3" name="to_update[' .
        $b["id"] .
        '][orderby]" value="' .
        $b["orderby"] .
        '" /></td>
	<td class="td-align-center"><label>Main</label><input type="radio" name="main_lang" value="' .
        $b["id"] .
        '"' .
        ($b["main"] ? ' checked="checked"' : "") .
        ' /></td>
	<td class="td-align-center"><a href="/admin/language/' .
        $b["code"] .
        '">Manage</a></td>
</tr>';
} ?>

<tr>
	<td colspan="7" class="var-wh-100 background-transparent">
<button type="button" onclick="javascript: submitForm(this, 'update');">Update</button> &nbsp;
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');">Delete selected</button>
	</td>
</tr>
<?php } ?>

<tr>
	<td colspan="7" class="var-wh-100 background-transparent"><h3>Add new</h3></td>
</tr>
<tr>
	<td class="background-transparent"></td>
	<td class="background-transparent td-align-center"><label>Code</label><input type="text" size="20" name="new_language[code]" value="" /></td>
	<td class="background-transparent td-align-center"><label>Name</label><input type="text" size="20" name="new_language[name]" value="" /></td>
	<td class="background-transparent td-align-center"><label>Active</label><input type="checkbox" name="new_language[active]" value="1" checked="checked" /></td>
	<td class="background-transparent td-align-center"><label>Pos</label><input type="text" size="5" name="new_language[orderby]" value="" /></td>
	<td class="background-transparent" colspan="2"></td>
</tr>

<tr>
	<td colspan="7" class="var-wh-100 background-transparent"><button type="button" onclick="javascript: submitForm(this, 'add');">Add</button></td>
</tr>

</table>
</form>
