<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($modules) { ?>
<h1 class="products-title-h3">{lng[Modules]} <a class="ajax_link link-button" href="/admin/modules/install">{lng[Install new]}</a></h1>
<br />
<form method="post" name="modulesform">
<input type="hidden" name="mode" value="update" />
<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<?php echo "<br />";} ?>

<table class="lines-table resp-table">
<thead>
<tr>
	<th style="width:10%">{lng[Logo]}</th>
	<th style="width:10%">{lng[Code]}</th>
	<th style="width:10%">{lng[Author]}</th>
	<th style="width:10%">{lng[Name]}</th>
	<th style="width:20%">{lng[Comment]}</th>
	<th style="width:20%">{lng[Pos]}</th>
	<th style="width:20%">{lng[Enabled]}</th>
</tr>
</thead>
{foreach $modules as $v}
<tr>
	<td class="td-align-center"><label>{lng[Logo]}</label><img src="/images/modules/{$v['author']}/{$v['module']}/logo.png" alt="" /></td>
	<td><label>{lng[Code]}</label>{$v['code']}</td>
	<td><label>{lng[Author]}</label>{$v['author']}</td>
	<td><label>{lng[Name]}</label>{$v['module']}</td>
	<td><label>{lng[Comment]}</label>{$v['comment']}</td>
	<td class="td-align-center"><label>{lng[Pos]}</label><input type="text" name="to_update[{$v['moduleid']}][pos]" size="3" value="{$v['pos']}" /></td>
	<td class="td-align-center"><label>{lng[Enabled]}</label><input type="checkbox" name="to_update[{$v['moduleid']}][enabled]" value="1"{if $v['enabled']} checked{/if} /></td>
</tr>
{/foreach}
</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'update');">{lng[Update]}</button> &nbsp;
</div>
</form>

<?php } else { ?>
<h1>{lng[Install new module]}</h1>
<br />
<form method="post" class="noajax" name="blogform" enctype="multipart/form-data">
<input type="file" name="install_archive" accept=".zip, application/zip, application/x-zip-compressed" />
<button type="submit" name="btn">{lng[Install]}</button>
<br /><br />
<h3>{lng[Installation instructions]}:</h3>
You need to upload the ZIP archive with the following files and folders:<br />
<b>"func.[code].php"</b> - functions file<br />
"pages/*.php"<br />
"templates/*.php", "templates/styles.css", "templates/scripts.js"<br />
"themes/images/*", "themes/templates/*"<br />
"logo.png"<br />
<br />
<b>module.data</b> should contains:<br />
code:new_module<br />
author:OlegKhorev<br />
module:NewModule<br />
comment:Module installation example<br />
template:new_module<br /><br />
You can review the module archive here: <a href="{$current_location}/files/new_module.zip" target="_blank">{$current_location}/files/new_module.zip</a>
</form>
<?php } ?>