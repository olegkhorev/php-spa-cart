<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<form name="pform" action="{$current_location}/admin/pages/<?php echo $get[
    "2"
]; ?>" method="post"{*{if !$pages && !$page['id']} class="noajax"{/if}*}>
<input type="hidden" name="mode" value="" />
{if !$get['2']}

<h1 class="products-title-h3">{lng[Pages]} <a class="ajax_link link-button" href="/admin/pages/new">{lng[Add new]}</a></h1>
<br />

<table class="lines-table resp-table">
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th style="width:100%">{lng[Page]}</th>
	<th style="width:100px">{lng[Pos]}</th>
</tr>
</thead>
<?php if ($pages) {
    foreach ($pages as $p) { ?>
<tr>
	<td><input type="checkbox" name="to_delete[<?php echo $p["pageid"]; ?>]" /></td>
	<td><label>{lng[Page]}</label><a href="<?php echo $current_location .
     "/admin/pages/" .
     $p["pageid"]; ?>"><?php echo $p["title"]; ?></a></td>
	<td><label>{lng[Pos]}</label><input size="5" type="text" name="to_update[<?php echo $p[
     "pageid"
 ]; ?>][orderby]" value="<?php echo $p["orderby"]; ?>"></td>
</tr>
<?php } ?>
{else}
<tr><td colspan="3">{lng[No pages found]}</td></tr>
{/if}
</table>
{if $pages}
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'update');">{lng[Update]}</button>
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');">{lng[Delete selected]}</button>
</div>
{/if}
{else}

{if $get['2'] == 'new'}
<h1>{lng[Add page]}</h1>
{else}
<h1>{$page['title']}</h1>
{/if}

<script src="/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.config.protectedSource.push( /<\?[\s\S]*?\?>/g );   // PHP Code
</script>
<table class="category normal-table">
<tr>
	<td style="height:10px;white-space:nowrap">{lng[Page title]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<input type="text" name="title" maxlength="255" size="80" value="<?php echo escape(
      $page["title"],
      2,
  ); ?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" />
	</td>
</tr>

<tr>
	<td style="height:10px;white-space:nowrap">{lng[Clean URL]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<input type="text" name="cleanurl" maxlength="255" size="80" value="<?php echo escape(
      $page["cleanurl"],
      2,
  ); ?>" />
	</td>
</tr>

<tr>
 <td class="hide-td-for-mdl"></td>
	<td style="width:10px;height:10px">&nbsp;</td>
 <td><div class="select-title">{lng[Page content]}</div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( e ) {
			editor = e.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="content"><?php echo $page[
      "content"
  ]; ?></textarea>
	</td>
</tr>

<tr>
	<td style="height:10px;white-space:nowrap">{lng[Title tag]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<input type="text" size="65" name="meta_title" value="<?php echo escape(
      $page["meta_title"],
      2,
  ); ?>" />
	</td>
</tr>

<tr>
	<td style="height:10px;white-space:nowrap">{lng[Meta keywords]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<textarea cols="65" rows="4" name="meta_keywords"><?php echo $page[
      "meta_keywords"
  ]; ?></textarea>
	</td>
</tr>

<tr>
	<td style="height:10px;white-space:nowrap">{lng[Meta description]}</td>
	<td style="width:10px;height:10px"></td>
	<td style="height:10px">
		<textarea cols="65" rows="4" name="meta_description"><?php echo $page[
      "meta_description"
  ]; ?></textarea>
	</td>
</tr>

</table>

<div class="fixed_save_button">
<button class="button-margin-left" type="submit">{lng[Save]}</button>
</div>

{/if}
</form>