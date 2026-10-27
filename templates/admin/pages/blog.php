<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($blogs) { ?>
<h1 class="products-title-h3">{lng[Blog]} <a class="ajax_link link-button" href="/admin/blog/new">{lng[Add new post]}</a></h1>
<br />

<form method="post" name="blogsform">
<input type="hidden" name="mode" value="update" />

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<?php echo "<br />";} ?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.blogsform, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.blogsform, 'to_delete', false);">{lng[Uncheck all]}</a>

<br /><br />

<table class="lines-table resp-table">
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th style="width:60%">{lng[Title]}</th>
	<th style="width:5%">{lng[Active]}</th>
	<th style="width:35%">{lng[Comments]}</th>
</tr>
</thead>
<?php foreach ($blogs as $b) {
    echo '<tr>
	<td><input type="checkbox" name="to_delete[' .
        $b["blogid"] .
        ']" value="Y" /></td>
	<td><label>{lng[Title]}</label><a href="' .
        $current_location .
        "/admin/blog/" .
        $b["blogid"] .
        '">' .
        $b["title"] .
        '</a></td>
	<td class="td-align-center"><label>{lng[Active]}</label><input type="checkbox" name="to_update[' .
        $b["blogid"] .
        '][active]" value="Y"' .
        ($b["active"] == "Y" ? ' checked="checked"' : "") .
        ' /></td>
	<td style="text-align:center"><label>{lng[Comments]}</label><a href="' .
        $current_location .
        "/admin/blog/" .
        $b["blogid"] .
        '">' .
        $b["comments"] .
        "</a></td>
</tr>";
} ?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'update');">{lng[Update]}</button> &nbsp;
<button type="button" onclick="javascript: if (confirmed || confirm('', $(this))) submitForm(this, 'delete');">{lng[Delete selected]}</button>
</div>
</form>

<br />

<h3>{lng[Authors]}</h3>
<?php foreach ($authors as $id => $v) {
    echo '<a href="' .
        $current_location .
        "/admin/blog/?author=" .
        $id .
        '">' .
        $v["1"] .
        "(" .
        $v["0"] .
        ")</a><br />";
}} else { ?>
<script src="{$current_location}/ckeditor/ckeditor.js"></script>
<form method="post" name="blogform" enctype="multipart/form-data">

{if $get['2'] == 'new'}
<h1>{lng[New blog|escape]}</h1>
{else}
<h1>{$blog['title']}</h1>
{/if}

<table style="width:90%" class="normal-table">
<?php if ($blog["date"]) { ?>
<tr>
 <td class="hide-td-for-mdl"></td>
 <td><div class="select-title">{lng[Author]}</div>
<a href="<?php echo $current_location .
    "/admin/user/" .
    $blog["author"]; ?>"><?php echo $blog["firstname"] .
    " " .
    $blog["lastname"]; ?></a></td>
</tr>
<tr>
 <td class="hide-td-for-mdl"></td>
 <td><div class="select-title">{lng[Added]}</div>
<?php echo date($date_format, $blog["date"]); ?></td>
</tr>
<?php } ?>

<tr>
 <td class="hide-td-for-mdl"></td>
 <td><div class="select-title">{lng[Image]}</div>
{if $blog['image']}
{blog_image image=`$blog['image']` new_width=400 new_height=100 link="Y" blank="Y"}
<br />
 <a href="<?php echo $current_location .
     "/admin/blog/" .
     $blog["blogid"] .
     "/?mode=delete_image"; ?>">{lng[Delete image]}</a><br />
{/if}
<input type="file" name="userfile" />
 </td>
</tr>

<tr>
 <td><b>{lng[Title]}</b></td>
 <td><input type="text" name="title" size="40" value="<?php echo escape(
     $blog["title"],
     2,
 ); ?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" /></td>
</tr>

<tr>
 <td><b>{lng[Clean URL]}</b></td>
 <td><input type="text" name="cleanurl" size="40" value="<?php echo escape(
     $blog["cleanurl"],
     2,
 ); ?>" /></td>
</tr>

<tr>
 <td class="hide-td-for-mdl"></td>
 <td><div class="select-title">{lng[Short description]}</div>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="descr"><?php echo $blog[
      "descr"
  ]; ?></textarea>
 </td>
</tr>

<tr>
 <td class="hide-td-for-mdl"></td>
 <td><div class="select-title">{lng[Detailed description]}</div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor_2" cols="65" rows="7" name="fulldescr"><?php echo $blog[
      "fulldescr"
  ]; ?></textarea>
 </td>
</tr>

<tr>
 <td><b>{lng[Meta title]}</b></td>
 <td><input type="text" size="80" name="meta_title" value="<?php echo $blog[
     "meta_title"
 ]; ?>" /></td>
</tr>
{*
<tr>
 <td><b>{lng[Meta keywords]}</b></td>
 <td><textarea cols="80" rows="5" name="meta_keywords"><?php echo $blog[
     "meta_keywords"
 ]; ?></textarea></td>
</tr>
*}
<tr>
 <td><b>{lng[Meta description]}</b></td>
 <td><textarea cols="80" rows="5" name="meta_descr"><?php echo $blog[
     "meta_descr"
 ]; ?></textarea></td>
</tr>

<tr>
 <td>{lng[Active]}</td>
 <td><input type="checkbox" name="active" value="Y"<?php echo !$blog ||
 $blog["active"] == "Y"
     ? ' checked="checked"'
     : ""; ?> /></td>
</tr>

</table>
<div class="fixed_save_button">
<button type="submit"><?php if (
    $get["2"] == "new"
) { ?>{lng[Add|escape]}<?php } else { ?>{lng[Save|escape]}<?php } ?></button>
</div>
<?php if ($blog) { ?>
<br />
<h3>{lng[Blog comments]}</h3>

<?php if ($comments) { ?>

<input type="hidden" name="commentid" value="" />

{include="admin/common/navigation.php"}

<table style="width:100%" class="blog_post_comments">
<?php
foreach ($comments as $i) {
    echo '<tr>
  <td>
<div class="float-right">
<a href="javascript: void(0);" onclick="javascript: if (confirm(\'{lng[Delete this comment?]}\', \'\', \'' .
        $current_location .
        "/admin/blog/" .
        $get["2"] .
        "/?deleteid=" .
        $i["commentid"] .
        '\'));">{lng[Delete]}</a> / <a href="javascript: void(0);" onclick="javascript: edit_comment(\'' .
        $i["commentid"] .
        '\');">{lng[Edit]}</a> / ';
    if ($i["active"] == "Y") {
        echo '<a class="color-red" href="' .
            $current_location .
            "/admin/blog/" .
            $get["2"] .
            "/?declineid=" .
            $i["commentid"] .
            '">{lng[Decline]}</a>';
    } else {
        echo '<a class="blog-color-2" href="' .
            $current_location .
            "/admin/blog/" .
            $get["2"] .
            "/?approveid=" .
            $i["commentid"] .
            '">{lng[Approve]}</a>';
    }
    echo '&nbsp;&nbsp;
</div>
<div class="blog-comment">
<div class="float-right">
' .
        date($datetime_format, $i["date"]) .
        " / " .
        $i["ip"] .
        '
&nbsp;
</div>
&nbsp;' .
        ($i["name"] != ""
            ? $i["name"]
            : '<a href="' .
                $current_location .
                "/admin/user/" .
                $i["userid"] .
                '">' .
                $i["firstname"] .
                " " .
                $i["lastname"] .
                "</a>") .
        '
</div>
<span id="comment_' .
        $i["commentid"] .
        '" class="hidden">' .
        $i["message"] .
        '</span>
' .
        $i["message"] .
        '
  </td>
</tr>';
}
echo "</table>";
} else { ?>
<br /><div style="text-align:center">{lng[No blog comments yet]}</div>
<?php } ?>

<br /><br />
<h3>{lng[Add new/edit]}</h3>
<table id="blog_bb_buttons">
<tbody>
<tr>
 <td><button type="button" onclick="javascript: iBold();"><b>B</b></button></td>
 <td><button type="button" onclick="javascript: iItalic();"><i>I</i></button></td>
 <td><button type="button" onclick="javascript: iUnderline();"><u>U</u></button></td>
 <td><button type="button" id="iLinkClickA" onclick="javascript: iLinkClick();">&nbsp;&#128279;&nbsp;</button></td>
</tr>
</tbody>
</table>

<div id="newrecord" contenteditable="true"></div>

<textarea name="comment" cols="80" rows="15" class="border-radius-25"></textarea>
<br /><br />
<button type="submit" name="btn">{lng[Add]}</button>
<br /><br />

<?php } ?>

</form>

<script>
function edit_comment(id) {
	$('#newrecord').html($('#comment_'+id).html());
	$('html, body').animate({
		scrollTop: $('#blog_bb_buttons').offset().top
	}, 500);

	moveCursorToEnd($('#newrecord')[0]);
}
</script>
<?php } ?>
