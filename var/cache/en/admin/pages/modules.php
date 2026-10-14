<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php  if ($modules) { ?>
<h1 class="products-title-h3">Modules <a class="ajax_link link-button" href="/admin/modules/install">Install new</a></h1>
<br />
<form method="post" name="modulesform">
<input type="hidden" name="mode" value="update" />
<?php  if ($total_pages > 2) { ?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php  echo "<br />";} ?>

<table cellpadding="3" cellspacing="1" width="600" class="lines-table resp-table">
<thead>
<tr>
	<th width="10%">Logo</th>
	<th width="10%">Code</th>
	<th width="10%">Author</th>
	<th width="10%">Name</th>
	<th width="20%">Comment</th>
	<th width="20%">Pos</th>
	<th width="20%">Enabled</th>
</tr>
</thead>
<?php foreach ($modules as $v) {?>
<tr>
	<td class="td-align-center"><label>Logo</label><img src="/images/modules/<?php echo $v['author'];?>/<?php echo $v['module'];?>/logo.png" alt="" /></td>
	<td><label>Code</label><?php echo $v['code'];?></td>
	<td><label>Author</label><?php echo $v['author'];?></td>
	<td><label>Name</label><?php echo $v['module'];?></td>
	<td><label>Comment</label><?php echo $v['comment'];?></td>
	<td class="td-align-center"><label>Pos</label><input type="text" name="to_update[<?php echo $v['moduleid'];?>][pos]" size="3" value="<?php echo $v['pos'];?>" /></td>
	<td class="td-align-center"><label>Enabled</label><input type="checkbox" name="to_update[<?php echo $v['moduleid'];?>][enabled]" value="1"<?php if ($v['enabled']) {?> checked<?php } ?> /></td>
</tr>
<?php } ?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'update');">Update</button> &nbsp;
</div>
</form>

<?php  } else  { ?>
<h1>Install new module</h1>
<br />
<form method="post" class="noajax" name="blogform" enctype="multipart/form-data">
<input type="file" name="install_archive" accept=".zip, application/zip, application/x-zip-compressed" />
<button type="submit" name="btn">Install</button>
<br /><br />
<h3>Installation instructions:</h3>
You need to upload the ZIP archive with the following files and folders:<br />
<b>func.[code].php"</b> - functions file<br />
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
You can review the module archive here: <a href="<?php echo $current_location;?>/files/new_module.zip" target="_blank"><?php echo $current_location;?>/files/new_module.zip</a>
</form>
<?php  } ?>