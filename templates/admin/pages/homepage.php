<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Homepage]}</h1>
<br />
<?php if (empty($_GET["parentid"])) { ?>
<ul class="admin-tabs">
<li<?php if (empty($get["2"])) {
    echo ' class="active"';
} ?>><a href="/admin/homepage">{lng[Details]}</a></li>
<li<?php if ($get["2"] == "banners") {
    echo ' class="active"';
} ?>><a href="/admin/homepage/banners">{lng[Banners]}</a></li>
</ul>
<div class="clear"></div>
<br />
<?php } ?>

<form name="category_form" action="/admin/homepage/<?php echo $get[
    "2"
]; ?>" method="post" enctype="multipart/form-data"{* class="noajax"*}>
<input type="hidden" name="mode" value="" />
<?php if ($get["2"] == "banners") { ?>

<table class="lines-table resp-table">
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th>{lng[Banner]}</th>
	<th>{lng[Link]}</th>
	<th>{lng[Alt]}</th>
	<th style="width:100px">{lng[Pos]}</th>
</tr>
</thead>
<?php if ($banners) {
    foreach ($banners as $b) { ?>
<tr>
	<td><input type="checkbox" name="to_delete[<?php echo $b[
     "bannerid"
 ]; ?>]" /></td>
	<td class="td-align-center"><label>{lng[Banner]}</label><a href="<?php echo $b[
     "image_url"
 ]; ?>" target="_blank"><img src="<?php echo $b[
    "image_url"
]; ?>" width="100" alt="<?php echo escape($b["alt"]); ?>"></a></td>
	<td class="td-align-center"><label>{lng[Link]}</label><input size="30" type="text" name="to_update[<?php echo $b[
     "bannerid"
 ]; ?>][url]" value="<?php echo escape($b["url"]); ?>" /></td>
	<td class="td-align-center"><label>{lng[Alt]}</label><input size="30" type="text" name="to_update[<?php echo $b[
     "bannerid"
 ]; ?>][alt]" value="<?php echo escape($b["alt"]); ?>" /></td>
	<td><label>{lng[Pos]}</label><input size="5" type="text" name="to_update[<?php echo $b[
     "bannerid"
 ]; ?>][pos]" value="<?php echo $b["pos"]; ?>"></td>
</tr>
<?php } ?>
<tr>
	<td colspan="5" class="var-wh-100 background-transparent">
	<button type="button" onclick="javascript: submitForm(this, 'update');">{lng[Update]}</button> &nbsp;	<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');">{lng[Delete selected]}</button>
	</td>
</tr>

<?php
} else {
     ?>
<tr>
 <td colspan="5" class="var-wh-100 background-transparent td-align-center">{lng[No banners for this category]}</td>
</tr>
<?php
} ?>

<tr>
<td colspan="5" class="var-wh-100 background-transparent"><br /><h3>{lng[Add new]}</h3></td>
</tr>

<tr>
	<td class="background-transparent">&nbsp;</td>
	<td class="background-transparent"><label>{lng[Banner]}</label><input type="file" size="10" name="userfile" /></td>
	<td class="background-transparent"><label>{lng[Link]}</label><input size="30" type="text" name="new_url"></td>
	<td class="background-transparent"><label>{lng[Alt]}</label><input size="30" type="text" name="new_alt"></td>
	<td class="background-transparent td-align-center"><label>{lng[Pos]}</label><input type="text" size="5" name="new_pos" /></td>
</tr>

<tr>
	<td colspan="5" class="var-wh-100 background-transparent">
<button type="button" onclick="javascript: submitForm(this, 'add');">{lng[Add]}</button>
	</td>
</tr>

</table>

<?php } else { ?>
<script src="/ckeditor/ckeditor.js"></script>
<table class="category normal-table">
<tr>
	<td style="height:10px;white-space:nowrap">{lng[Title]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<input type="text" name="site_title" maxlength="255" size="80" value="<?php echo escape(
      lng("Site title"),
      2,
  ); ?>" />
	</td>
</tr>

<tr>
 <td class="hide-td-for-mdl"></td>
	<td style="width:10px;height:10px">&nbsp;</td>
 <td><div class="select-title">{lng[Description]}</div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( e ) {
			editor = e.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="site_description"><?php echo lng(
      "Site description",
  ); ?></textarea>
	</td>
</tr>

<tr>
	<td style="height:10px;white-space:nowrap">{lng[Title tag]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<input type="text" size="65" name="meta_title" value="<?php echo escape(
      lng("Homepage meta title"),
      2,
  ); ?>" />
	</td>
</tr>

<tr>
	<td style="height:10px;white-space:nowrap">{lng[Meta keywords]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<textarea cols="65" rows="4" name="meta_keywords"><?php echo lng(
      "Homepage meta keywords",
  ); ?></textarea>
	</td>
</tr>

<tr>
	<td style="height:10px;white-space:nowrap">{lng[Meta description]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<textarea cols="65" rows="4" name="meta_description"><?php echo lng(
      "Homepage meta description",
  ); ?></textarea>
	</td>
</tr>

</table>
<br /><br /><br /><br />
<div class="fixed_save_button">
<button class="button-margin-left" type="submit">{lng[Save]}</button>
</div>

<?php } ?>
</form>