<a href="<?php  echo $current_location; ?>/admin/subscribtions/<?php  echo $get['2']; ?>/new">Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></a>
<br /><br />
Общее количество подписчиков <b class="translate"><span class="hidden word">Total subscribers</span><span class="hidden translate-phrase">Общее количество подписчиков</span>(Edit)</b>: <?php  echo $subscribers ? $subscribers : '0';?> <a href="/admin/subscribtions/<?php  echo $get['2']; ?>/export">Экспорт <b class="translate"><span class="hidden word">Export</span><span class="hidden translate-phrase">Экспорт</span>(Edit)</b></a>
<br /><br />
<form method="post" name="newsform">
<input type="hidden" name="mode" value="delete" />

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<?php 
	echo '<br />';
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.newsform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.newsform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>

<table cellpadding="3" cellspacing="1" width="600" class="lines-table">
<tr>
	<th width="10">&nbsp;</th>
	<th width="70%">Тема <b class="translate"><span class="hidden word">Subject</span><span class="hidden translate-phrase">Тема</span>(Edit)</b></th>
	<th width="30%">Дата <b class="translate"><span class="hidden word">Date</span><span class="hidden translate-phrase">Дата</span>(Edit)</b></th>
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
<button type="button" onclick="javascript: if (confirmed || confirm('Эта команда удалит выбранные письма. <b class="translate"><span class="hidden word">This operation will delete selected letters.</span><span class="hidden translate-phrase">Эта команда удалит выбранные письма.</span>(Edit)</b>', $(this))) submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
</form>