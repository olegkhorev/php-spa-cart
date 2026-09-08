<h1>Зоныа пунктов назначения <b class="translate"><span class="hidden word">Destination zones</span><span class="hidden translate-phrase">Зоныа пунктов назначения</span>(Edit)</b></h1>

<?php 
if ($zones) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.zonesform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.zonesform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
<?php 
}
?>

<form method="post" name="zonesform">
<input type="hidden" name="mode" value="delete" />

<table cellpadding="3" cellspacing="1" width="100%" class="lines-table">

<tr>
  <th width="10">&nbsp;</th>
  <th width="100%">Название зоны  <b class="translate"><span class="hidden word">Zone name</span><span class="hidden translate-phrase">Название зоны </span>(Edit)</b></th>
</tr>

<tr>
  <td><input type="checkbox" disabled="disabled" /></td>
  <td>Зона по умолчанию <b class="translate"><span class="hidden word">Default zone</span><span class="hidden translate-phrase">Зона по умолчанию</span>(Edit)</b></td>
</tr>

<?php 
if ($zones) {
	foreach ($zones as $z) {
		echo '<tr>
  <td><input type="checkbox" name="to_delete['.$z['zoneid'].']" /></td>
  <td><a href="'.$current_location.'/admin/zones/'.$z['zoneid'].'">'.$z['zone_name'].'</a></td>
		</tr>';
	}
?>
<?php 
}
?>
</table>
<?php if ($zones) {?>
<div class="fixed_save_button">
  <button type="submit">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
<?php } ?>
</form>

<br /><br />

<button onclick="javascript: self.location='<?php echo $current_location;?>/admin/zones/add';" type="button">Добавить новую... <b class="translate"><span class="hidden word">Add new...</span><span class="hidden translate-phrase">Добавить новую...</span>(Edit)</b></button>