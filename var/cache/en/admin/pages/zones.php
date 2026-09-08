<h1>Destination zones</h1>

<?php 
if ($zones) {
?>
<a href="javascript: void(0);" onclick="javascript: check_all(document.zonesform, 'to_delete', true);">Check all</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.zonesform, 'to_delete', false);">Uncheck all</a>
<?php 
}
?>

<form method="post" name="zonesform">
<input type="hidden" name="mode" value="delete" />

<table cellpadding="3" cellspacing="1" width="100%" class="lines-table">

<tr>
  <th width="10">&nbsp;</th>
  <th width="100%">Zone name</th>
</tr>

<tr>
  <td><input type="checkbox" disabled="disabled" /></td>
  <td>Default zone</td>
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
  <button type="submit">Delete selected</button>
</div>
<?php } ?>
</form>

<br /><br />

<button onclick="javascript: self.location='<?php echo $current_location;?>/admin/zones/add';" type="button">Add new...</button>