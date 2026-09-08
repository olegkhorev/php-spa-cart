<form method="POST" name="vform">
<input type="hidden" name="section" value="variants">
<input type="hidden" name="mode" value="update">

Фильтр вариантов <b class="translate"><span class="hidden word">Filter variants</span><span class="hidden translate-phrase">Фильтр вариантов</span>(Edit)</b>:
<?php 
foreach ($option_groups as $g) {?>
 <select name="variants_filter[<?php  echo $g['groupid']; ?>]">
 <option value=""><?php  echo $g['name']; ?></option>
<?php 
	if ($g['options']) {
		foreach ($g['options'] as $o) {
?>
 <option value="<?php  echo $o['optionid']; ?>"<?php  echo $o['selected'] == 'Y' ? ' selected="selected"' : ''; ?>><?php  echo $o['name']; ?></option>
<?php 
		}
	}
?>
 </select>
&nbsp;
<?php 
}
?>
<button type="button" onclick="javascript: submitForm(this, 'filter');">Submit</button>
<button type="button" onclick="javascript: submitForm(this, 'reset_filter');">Reset</button>
<br />
<?php 
if ($variants) {
?>
<br />
<a href="javascript: void(0);" onclick="javascript: check_all(document.vform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.vform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
  <table cellspacing="0">
    <tr>
      <th></th>
      <th>Опции <b class="translate"><span class="hidden word">Options</span><span class="hidden translate-phrase">Опции</span>(Edit)</b></th>
      <th>Название товара <b class="translate"><span class="hidden word">Product title</span><span class="hidden translate-phrase">Название товара</span>(Edit)</b></th>
      <th>SKU <b class="translate"><span class="hidden word">SKU</span><span class="hidden translate-phrase">SKU</span>(Edit)</b></th>
<?php /* ?>
      <th><label>Код поставщика <b class="translate"><span class="hidden word">Supplier Code</span><span class="hidden translate-phrase">Код поставщика</span>(Edit)</b><input type="checkbox" name="show_supplier_code" value="1"{if:product.getShowSupplierCode()} checked{end:} /></label></th>
<?php */ ?>
      <th>Цена <b class="translate"><span class="hidden word">Price</span><span class="hidden translate-phrase">Цена</span>(Edit)</b></th>
      <th>Вес <b class="translate"><span class="hidden word">Weight</span><span class="hidden translate-phrase">Вес</span>(Edit)</b></th>
<?php if ($warehouse_enabled) {?>
      <th>Склады <b class="translate"><span class="hidden word">Warehouses</span><span class="hidden translate-phrase">Склады</span>(Edit)</b></th>
<?php } else  { ?>
      <th>В наличии <b class="translate"><span class="hidden word">In Stock</span><span class="hidden translate-phrase">В наличии</span>(Edit)</b></th>
<?php } ?>
<?php /* ?>
      <th><label>Количество в коробке <b class="translate"><span class="hidden word">Quantity per box</span><span class="hidden translate-phrase">Количество в коробке</span>(Edit)</b><input type="checkbox" name="show_qty_per_box" value="1"{if:product.getShowQtyPerBox()} checked{end:} /></label></th>
      <th><label>Поставляется как <b class="translate"><span class="hidden word">Supplied As</span><span class="hidden translate-phrase">Поставляется как</span>(Edit)</b><input type="checkbox" name="show_supplied_as" value="1"{if:product.getShowSuppliedAs()} checked{end:} /></label></th>
<?php */ ?>
      <th>Оптовая продажа <b class="translate"><span class="hidden word">Wholesale</span><span class="hidden translate-phrase">Оптовая продажа</span>(Edit)</b></th>
      <th>По умолчанию <b class="translate"><span class="hidden word">Default</span><span class="hidden translate-phrase">По умолчанию</span>(Edit)</b></th>
    </tr>
<?php 
foreach ($variants as $v) {
?>
    <tr>
      <td align="center"><input type="checkbox" name="to_delete[<?php  echo $v['variantid']; ?>]" value="1" /></td>
	  <td>
<table>
<tr>
<?php 
foreach ($v['options'] as $vo) {
	foreach ($option_groups as $g) {		if ($g['groupid'] == $vo['groupid'] && $g['options']) {
?>
 <td><?php  echo $g['name']; ?>:</td>
 <td>
<?php 
			foreach ($g['options'] as $o) {				if ($vo['optionid'] == $o['optionid']) {
					echo $o['name'];
				}
			}
?>
 </td>
<?php 
		}
	}
}
?>
</tr>
</table>
	  </td>
      <td><input type="text" size="40" name="posted_data[<?php  echo $v['variantid']; ?>][title]" value="<?php  echo $v['title']; ?>" /></td>
      <td><input type="text" name="posted_data[<?php  echo $v['variantid']; ?>][sku]" value="<?php  echo $v['sku']; ?>" /></td>
<?php /* ?>
      <td><input type="text" name="posted_data[<?php  echo $v['variantid']; ?>][supplier_code]" value="<?php  echo $v['supplier_code']; ?>" /></td>
<?php */ ?>
      <td><input type="text" size="10" name="posted_data[<?php  echo $v['variantid']; ?>][price]" value="<?php  echo $v['price']; ?>" /></td>
      <td><input type="text" size="10" name="posted_data[<?php  echo $v['variantid']; ?>][weight]" value="<?php  echo $v['weight']; ?>" /></td>
<?php if ($warehouse_enabled) {?>
      <td>
      <span class="define-var-wh" data-variantid="<?php echo $v['variantid'];?>">Define</span></td>
<?php } else  { ?>
      <td><input type="text" size="5" name="posted_data[<?php  echo $v['variantid']; ?>][avail]" value="<?php  echo $v['avail']; ?>" /></td>
<?php } ?>
<?php /* ?>
      <td><input type="text" size="5" name="posted_data[<?php  echo $v['variantid']; ?>][qty_per_box]" value="<?php  echo $v['quantity_per_box']; ?>" /></td>
      <td><input type="text" size="10" name="posted_data[<?php  echo $v['variantid']; ?>][supplied_as]" value="<?php  echo $v['supplied_as']; ?>" /></td>
<?php */ ?>
      <td onclick="javascript: wholetoggle(<?php  echo $v['variantid']; ?>, $(this).find('a'));" class="wplink"><a href="javascript: void(0);">[+]</a> (<?php  echo count($v['wholesale']); ?>)</td>
      <td align="center"><input type="radio" name="posted_data[<?php  echo $v['variantid']; ?>][def]" value="1" <?php  echo $v['def'] ? ' checked="checked"' : ''; ?> /></td>
    </tr>

	<tr id="wholesale-<?php  echo $v['variantid']; ?>" style="display: none;">
		<td colspan="5"></td>
		<td colspan="5">
<table  width="100%"cellspacing="0" cellpadding="3" id="wp_table">
<tr>
	<th>Количество <b class="translate"><span class="hidden word">Quantity</span><span class="hidden translate-phrase">Количество</span>(Edit)</b></th>
	<th>Цена <b class="translate"><span class="hidden word">Price</span><span class="hidden translate-phrase">Цена</span>(Edit)</b></th>
	<th>Подписка <b class="translate"><span class="hidden word">Membership</span><span class="hidden translate-phrase">Подписка</span>(Edit)</b></th>
	<th width="100%"></th>
</tr>
<?php 
if ($v['wholesale']) {	foreach ($v['wholesale'] as $w) {
?>
<tr id="wp_tr-<?php  echo $w['priceid']; ?>">
	<td id="wp_box_1"><input type="text" size="5" name="wprices[<?php  echo $v['variantid']; ?>][<?php  echo $w['priceid']; ?>][quantity]" value="<?php  echo $w['quantity']; ?>" /></td>
	<td id="wp_box_2"><input type="text" size="7" name="wprices[<?php  echo $v['variantid']; ?>][<?php  echo $w['priceid']; ?>][price]" value="<?php  echo $w['price']; ?>" /></td>
	<td id="wp_box_3">
<select name="wprices[<?php  echo $v['variantid']; ?>][<?php  echo $w['priceid']; ?>][membershipid]">
<option value="0">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
<?php 
if ($memberships)
	foreach ($memberships as $m) {		echo '<option value="'.$m['membershipid'].'"'.($m['membershipid'] == $w['membershipid'] ? ' selected="selected"' : '').'>'.$m['membership'].'</option>';	}
?>
</select>
 	</td>
	<td><div class="removed"><input type="hidden" name="wprices[<?php  echo $v['variantid']; ?>][<?php  echo $w['priceid']; ?>][removed]" value="" /><a href="javascript: void(0);" onclick="javascript: remove_wp(<?php  echo $w['priceid']; ?>);">-</a> <a href="javascript: void(0);" class="wprem" onclick="javascript: restore_wp(<?php  echo $w['priceid']; ?>);">Восстановить <b class="translate"><span class="hidden word">Restore</span><span class="hidden translate-phrase">Восстановить</span>(Edit)</b></a></div></td>
</tr>
<?php 
	}
}
?>
<tr id="wp_tr_<?php  echo $v['variantid']; ?>">
	<td id="wp_box_1"><input type="text" size="5" name="new_wprice[<?php  echo $v['variantid']; ?>][0][quantity]" value="1" /></td>
	<td id="wp_box_2"><input type="text" size="7" name="new_wprice[<?php  echo $v['variantid']; ?>][0][price]" value="0.00" /></td>
	<td id="wp_box_3">
<select name="new_wprice[<?php  echo $v['variantid']; ?>][0][membershipid]">
<option value="0">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
<?php 
if ($memberships)
	foreach ($memberships as $m) {
		echo '<option value="'.$m['membershipid'].'">'.$m['membership'].'</option>';
	}
?>
</select>
 	</td>
	<td><a href="javascript: void(0);" onclick="duplicate_row($('#wp_tr_<?php  echo $v['variantid']; ?>'), $(this));" class="duplicate_plus">+</a></td>
</tr>
</table>
		</td>
	</tr>
<?php 
}
?>

  </table>

<br />
    <button>Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
    <button type="button" onclick="submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
<br /><br />
<?php 
}
?>

<h3>Новый вариант <b class="translate"><span class="hidden word">New variant</span><span class="hidden translate-phrase">Новый вариант</span>(Edit)</b></h3>
<table class="new_variant">
<?php 
foreach ($option_groups as $v) {?>
<tr>
 <td width="150" valign="top"><?php  echo $v['name'];?></td>
 <td valign="top">
 <select name="new_variants[<?php  echo $v['groupid']; ?>][]" multiple size="10" id="po-<?php  echo $v['groupid']; ?>">
<?php 
if ($v['options']) {	foreach ($v['options'] as $o) {
?>
 <option value="<?php  echo $o['optionid']; ?>"><?php  echo $o['name']; ?></option>
<?php 
	}
}
?>
 </select>
 </td>
</tr>
<?php 
}
?>
<tr>
 <td colspan="2">
<button type="button" onclick="javascript: submitForm(this, 'add');">Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b></button> <button type="button" onclick="javascript: all_possible();">Создать все возможные варианты <b class="translate"><span class="hidden word">Create all possible variants</span><span class="hidden translate-phrase">Создать все возможные варианты</span>(Edit)</b></button>
 </td>
</tr>
</table>


</form>

<?php if ($warehouse_enabled) {?>
<?php foreach ($variants as $v) {?>
<div class="warehouses" id="warehouses-<?php echo $v['variantid'];?>">
<form method="POST">
<input type="hidden" name="variantid" value="<?php echo $v['variantid'];?>" />
<div class="wh-list">
<table width="100%">
<tr>
 <th>Склад <b class="translate"><span class="hidden word">Warehouse</span><span class="hidden translate-phrase">Склад</span>(Edit)</b></th>
 <th>В наличии <b class="translate"><span class="hidden word">Avail</span><span class="hidden translate-phrase">В наличии</span>(Edit)</b></th>
</tr>
<?php foreach ($v['warehouses'] as $w) {?>
<tr>
 <td width="100%"><?php echo $w['wcode'];?></td>
 <td nowrap><input type="text" size="3" name="variant_wh[<?php echo $v['variantid'];?>][<?php echo $w['wid'];?>]" value="<?php echo $w['avail'];?>" /></td>
</tr>
<?php } ?>
</table>
</div>
<br />
<button class="save">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
<button type="button" class="cancel">Отменить <b class="translate"><span class="hidden word">Cancel</span><span class="hidden translate-phrase">Отменить</span>(Edit)</b></button>
</form>
</div>
<?php } ?>
<?php } ?>