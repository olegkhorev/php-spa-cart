<form method="POST" name="prform">
<input type="hidden" name="section" value="inventory">
<?php if ($warehouses) {?>
<table width="500" class="lines-table">
<tr>
 <th width="100%">Склад <b class="translate"><span class="hidden word">Warehouse</span><span class="hidden translate-phrase">Склад</span>(Edit)</b></th>
 <th>В наличии <b class="translate"><span class="hidden word">Avail</span><span class="hidden translate-phrase">В наличии</span>(Edit)</b></th>
</tr>
<?php foreach ($warehouses as $w) {?>
<tr>
 <td>#<?php echo $w['wcode'];?>, <?php echo $w['title'];?><br /><?php echo $w['address'];?></td>
 <td><input size="5" type="text" name="posted_data[<?php echo $w['wid'];?>]" value="<?php echo $w['avail'];?>"></td>
</tr>
<?php } ?>
<tr>
 <td colspan="2"><br><button type="submit">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button></td>
</tr>
</table>
<?php } else  { ?>
No <a href="/admin/warehouses">warehouses defined</a>.
<?php } ?>
</form>