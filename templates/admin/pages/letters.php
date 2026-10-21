<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>

<h1 class="products-title-h3">{lng[Subscriptions]} <a class="ajax_link link-button" href="/admin/subscribtions/new">{lng[Add new]}</a></h1>
<br />

{lng[Total subscribers]}: <?php echo $subscribers
    ? $subscribers
    : "0"; ?> <a href="/admin/subscribtions/<?php echo $get[
     "2"
 ]; ?>/export">{lng[Export]}</a>
<br /><br />
<form method="post" name="newsform">
<input type="hidden" name="mode" value="delete" />

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<?php echo "<br />";} ?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.newsform, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.newsform, 'to_delete', false);">{lng[Uncheck all]}</a>

<table class="lines-table resp-table">
<thead>
<tr>
	<th style="width:10px">&nbsp;</th>
	<th style="width:70%">{lng[Subject]}</th>
	<th style="width:30%">{lng[Date]}</th>
</tr>
</thead>
<?php foreach ($letters as $l) {
    echo '<tr>
	<td><input type="checkbox" name="to_delete[' .
        $l["id"] .
        ']" value="Y" /></td>
	<td><label>{lng[Subject]}</label><a href="' .
        $current_location .
        "/admin/subscribtions/" .
        $get["2"] .
        "/" .
        $l["id"] .
        '">' .
        $l["subject"] .
        '</a></td>
	<td class="td-align-center"><label>{lng[Date]}</label>' .
        date($datetime_format, $l["date"]) .
        "</td>
</tr>";
} ?>

</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: if (confirmed || confirm('', $(this))) submitForm(this, 'delete');">{lng[Delete selected]}</button>
</div>
</form>