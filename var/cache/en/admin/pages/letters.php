<a href="<?php  echo $current_location; ?>/admin/subscribtions/<?php  echo $get['2']; ?>/new">Add new</a>
<br /><br />
Total subscribers: <?php  echo $subscribers ? $subscribers : '0';?> <a href="/admin/subscribtions/<?php  echo $get['2']; ?>/export">Export</a>
<br /><br />
<form method="post" name="newsform">
<input type="hidden" name="mode" value="delete" />

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php 
	echo '<br />';
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.newsform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.newsform, 'to_delete', false);">Uncheck all</a>

<table cellpadding="3" cellspacing="1" width="600" class="lines-table">
<tr>
	<th width="10">&nbsp;</th>
	<th width="70%">Subject</th>
	<th width="30%">Date</th>
</tr>

<?php 
foreach ($letters as $l) {
	echo '<tr>
	<td><input type="checkbox" name="to_delete['.$l['id'].']" value="Y" /></td>
	<td><a href="'.$current_location.'/admin/subscribtions/'.$get['2'].'/'.$l['id'].'">'.$l['subject'].'</a></td>
	<td align="center">'.date($datetime_format, $l['date'])."</td>
</tr>";
}
?>

</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: if (confirmed || confirm('This operation will delete selected letters.', $(this))) submitForm(this, 'delete');">Delete selected</button>
</div>
</form>