<form method="POST" name="prform">
<input type="hidden" name="section" value="invetory">
<?php if ($warehouses) {?>
<table width="500">
<tr>
 <th width="100%">Warehouse</th>
 <th>Avail</th>
</tr>
<?php foreach ($warehouses as $w) {?>
<tr>
 <td><?php echo $v['title'];?> <?php echo $v['address'];?></td>
 <td><input size="5" type="text" name="posted_data[<?php echo $v['wid'];?>]" value="<?php echo $v['avail'];?>"></td>
</tr>
<?php } ?>
<tr>
 <td colspan="2"><br><button type="submit">Update</button></td>
</tr>
</table>
<?php } else  { ?>
No <a href="/admin/warehouses">warehouses defined</a>.
<?php } ?>
</form>