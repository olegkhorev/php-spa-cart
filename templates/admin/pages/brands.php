<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($brands) { ?>
<h1 class="products-title-h3">{lng[Brands]} <a class="ajax_link link-button" href="/admin/brands/new">{lng[Add new brand]}</a></h1>
<br />

<form method="post" name="brandsform">
<input type="hidden" name="mode" value="update" />

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<?php echo "<br />";} ?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.brandsform, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.brandsform, 'to_delete', false);">{lng[Uncheck all]}</a>

<br /><br />

<table class="lines-table resp-table">
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th style="width:60%">{lng[Name]}</th>
	<th style="width:20%">{lng[Active]}</th>
	<th style="width:20%">{lng[Pos]}</th>
</tr>
</thead>
<?php foreach ($brands as $b) {
    echo '<tr>
	<td><input type="checkbox" name="to_delete[' .
        $b["brandid"] .
        ']" value="Y" /></td>
	<td><label>{lng[Name]}</label><a href="' .
        $current_location .
        "/admin/brands/" .
        $b["brandid"] .
        '">' .
        $b["name"] .
        '</a></td>
	<td style="text-align:center"><label>{lng[Active]}</label><input type="checkbox" name="to_update[' .
        $b["brandid"] .
        '][active]" value="Y"' .
        ($b["active"] == "Y" ? ' checked="checked"' : "") .
        ' /></td>
	<td style="text-align:center"><label>{lng[Pos]}</label><input type="text" size="5" name="to_update[' .
        $b["brandid"] .
        '][orderby]" value="' .
        $b["orderby"] .
        '" /></td>
</tr>';
} ?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'update');">{lng[Update]}</button> &nbsp;
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');">{lng[Delete selected]}</button>
</div>
</form>

<?php } else { ?>
{if ($get['2'] == 'new')}
<h1>{lng[New brand]}</h1>
{else}
<h1>{$brand['name']}</h1>
{/if}

<script src="{$current_location}/ckeditor/ckeditor.js"></script>
<form method="post" name="brandform" enctype="multipart/form-data">

<table style="width:90%" class="normal-table">
<tr>
 <td class="hide-td-for-mdl"></td>
 <td><div class="select-title">{lng[Image]}</div>
{if $brand['image']}
{brand_image image=`$brand['image']` new_width=400 new_height=100 link="Y" blank="Y"}
<br />
 <a href="<?php echo $current_location .
     "/admin/brands/" .
     $brand["brandid"] .
     "/?mode=delete_image"; ?>">{lng[Delete image]}</a><br />
{/if}
<input type="file" name="userfile" />
 </td>
</tr>

<tr>
 <td><b>{lng[Name]}</b></td>
 <td><input type="text" name="name" size="40" value="<?php echo escape(
     $brand["name"],
     2,
 ); ?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" /></td>
</tr>

<tr>
 <td><b>{lng[Clean URL]}</b></td>
 <td><input type="text" name="cleanurl" size="40" value="<?php echo escape(
     $brand["cleanurl"],
     2,
 ); ?>" /></td>
</tr>

<tr>
 <td class="hide-td-for-mdl"></td>
 <td><div class="select-title">{lng[Description]}</div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="descr"><?php echo $brand[
      "descr"
  ]; ?></textarea>
 </td>
</tr>

<tr>
 <td><b>{lng[Meta title]}</b></td>
 <td><input type="text" size="80" name="meta_title" value="<?php echo $brand[
     "meta_title"
 ]; ?>" /></td>
</tr>
{*
<tr>
 <td><b>{lng[Meta keywords]}</b></td>
 <td><textarea cols="80" rows="5" name="meta_keywords"><?php echo $brand[
     "meta_keywords"
 ]; ?></textarea></td>
</tr>
*}
<tr>
 <td><b>{lng[Meta description]}</b></td>
 <td><textarea cols="80" rows="5" name="meta_descr"><?php echo $brand[
     "meta_descr"
 ]; ?></textarea></td>
</tr>

<tr>
 <td>{lng[Active]}</td>
 <td><input type="checkbox" name="active" value="Y"<?php echo !$brand ||
 $brand["active"] == "Y"
     ? ' checked="checked"'
     : ""; ?> /></td>
</tr>

<tr>
 <td><b>{lng[Position]}</b></td>
 <td><input type="text" size="5" name="orderby" value="<?php echo $brand[
     "orderby"
 ]; ?>" /></td>
</tr>

</table>
<div class="fixed_save_button">
<button type="button" onclick="submitBrand()"><?php if (
    $get["2"] == "new"
) { ?>{lng[Add|escape]}<?php } else { ?>{lng[Save|escape]}<?php } ?></button>
</div>
</form>
<?php } ?>
