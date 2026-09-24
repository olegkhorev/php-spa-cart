<form method="POST" name="vform">
<input type="hidden" name="section" value="variants">
<input type="hidden" name="mode" value="update">

{lng[Filter variants]}:
<?php
foreach ($option_groups as $g) {?>
 <select name="variants_filter[<?php echo $g['groupid']; ?>]">
 <option value=""><?php echo $g['name']; ?></option>
<?php
	if ($g['options']) {
		foreach ($g['options'] as $o) {
?>
 <option value="<?php echo $o['optionid']; ?>"<?php echo $o['selected'] == 'Y' ? ' selected="selected"' : ''; ?>><?php echo $o['name']; ?></option>
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
<a href="javascript: void(0);" onclick="javascript: check_all(document.vform, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.vform, 'to_delete', false);">{lng[Uncheck all]}</a>
  <table cellspacing="0" class="resp-table resp-table-100 admin-variants-table" style="margin-bottom: 0px;">
   <thead>
    <tr>
      <th></th>
      <th>{lng[Options]}</th>
      <th>{lng[Product title]}</th>
      <th>{lng[SKU]}</th>
      <th>{lng[Price]}</th>
      <th>{lng[Weight]}</th>
{if $warehouse_enabled}
      <th>{lng[Warehouses]}</th>
{else}
      <th>{lng[In Stock]}</th>
{/if}
      <th>{lng[Wholesale]}</th>
      <th>{lng[Default]}</th>
    </tr>
   </thead>
<?php
foreach ($variants as $v) {
?>
    <tr>
      <td align="center"><input type="checkbox" name="to_delete[<?php echo $v['variantid']; ?>]" value="1" /></td>
	  <td class="admin-variants-table-2"><label>{lng[Options]}</label>
<table>
<tr>
<?php
foreach ($v['options'] as $vo) {
	foreach ($option_groups as $g) {		if ($g['groupid'] == $vo['groupid'] && $g['options']) {
?>
 <td><?php echo $g['name']; ?>:</td>
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
      <td><label>{lng[Product title]}</label><input type="text" size="40" name="posted_data[<?php echo $v['variantid']; ?>][title]" value="<?php echo $v['title']; ?>" /></td>
      <td><label>{lng[SKU]}</label><input type="text" name="posted_data[<?php echo $v['variantid']; ?>][sku]" value="<?php echo $v['sku']; ?>" /></td>
      <td><label>{lng[Price]}</label><input type="text" size="10" name="posted_data[<?php echo $v['variantid']; ?>][price]" value="<?php echo $v['price']; ?>" /></td>
      <td><label>{lng[Weight]}</label><input type="text" size="10" name="posted_data[<?php echo $v['variantid']; ?>][weight]" value="<?php echo $v['weight']; ?>" /></td>
{if $warehouse_enabled}
      <td>
      <span class="define-var-wh" data-variantid="{$v['variantid']}">Define</span></td>
{else}
      <td><label>{lng[Avail]}</label><input type="text" size="5" name="posted_data[<?php echo $v['variantid']; ?>][avail]" value="<?php echo $v['avail']; ?>" /></td>
{/if}
      <td onclick="javascript: wholetoggle(<?php echo $v['variantid']; ?>, $(this).find('a'));" class="wplink"><label>{lng[Wholesale]}</label><a href="javascript: void(0);">[+]</a> (<?php echo count($v['wholesale']); ?>)</td>
      <td align="center"><label>{lng[Default]}</label><input type="radio" name="posted_data[<?php echo $v['variantid']; ?>][def]" value="1" <?php echo $v['def'] ? ' checked="checked"' : ''; ?> /></td>
    </tr>
	<tr id="wholesale-<?php echo $v['variantid']; ?>" style="display: none;">
		<td colspan="5" class="mobile-none"></td>
		<td colspan="5" class="var-wh-100">
<table  width="100%"cellspacing="0" cellpadding="3" id="wp_table" class="variants-wholesale-table">
<thead>
<tr>
	<th>{lng[Quantity]}</th>
	<th>{lng[Price]}</th>
	<th>{lng[Membership]}</th>
	<th width="100%"></th>
</tr>
</thead>
<?php
if ($v['wholesale']) {	foreach ($v['wholesale'] as $w) {
?>
<tr id="wp_tr-<?php echo $w['priceid']; ?>">
	<td id="wp_box_1"><label>{lng[Quantity]}</label><input type="text" size="5" name="wprices[<?php echo $v['variantid']; ?>][<?php echo $w['priceid']; ?>][quantity]" value="<?php echo $w['quantity']; ?>" /></td>
	<td id="wp_box_2"><label>{lng[Price]}</label><input type="text" size="7" name="wprices[<?php echo $v['variantid']; ?>][<?php echo $w['priceid']; ?>][price]" value="<?php echo $w['price']; ?>" /></td>
	<td id="wp_box_3" class="no-word-break"><label>{lng[Membership]}</label>
<select name="wprices[<?php echo $v['variantid']; ?>][<?php echo $w['priceid']; ?>][membershipid]">
<option value="0">{lng[All]}</option>
<?php
if ($memberships)
	foreach ($memberships as $m) {		echo '<option value="'.$m['membershipid'].'"'.($m['membershipid'] == $w['membershipid'] ? ' selected="selected"' : '').'>'.$m['membership'].'</option>';	}
?>
</select>
 	</td>
	<td><label>{lng[Remove]}</label><div class="removed"><input type="hidden" name="wprices[<?php echo $v['variantid']; ?>][<?php echo $w['priceid']; ?>][removed]" value="" /><a href="javascript: void(0);" onclick="javascript: remove_wp(<?php echo $w['priceid']; ?>);">-</a> <a href="javascript: void(0);" class="wprem" onclick="javascript: restore_wp(<?php echo $w['priceid']; ?>);">{lng[Restore]}</a></div></td>
</tr>
<?php
	}
}
?>
<tr id="wp_tr_<?php echo $v['variantid']; ?>">
	<td id="wp_box_1"><label>{lng[Quantity]}</label><input type="text" size="5" name="new_wprice[<?php echo $v['variantid']; ?>][0][quantity]" value="1" /></td>
	<td id="wp_box_2"><label>{lng[Price]}</label><input type="text" size="7" name="new_wprice[<?php echo $v['variantid']; ?>][0][price]" value="0.00" /></td>
	<td id="wp_box_3" class="no-word-break"><label>{lng[Membership]}</label>
<select name="new_wprice[<?php echo $v['variantid']; ?>][0][membershipid]">
<option value="0">{lng[All]}</option>
<?php
if ($memberships)
	foreach ($memberships as $m) {
		echo '<option value="'.$m['membershipid'].'">'.$m['membership'].'</option>';
	}
?>
</select>
 	</td>
	<td><a href="javascript: void(0);" onclick="duplicate_row($('#wp_tr_<?php echo $v['variantid']; ?>'), $(this));" class="duplicate_plus">+</a></td>
</tr>
</table>
		</td>
	</tr>
<?php
}
?>

  </table>

<br />
    <button>{lng[Update]}</button>
    <button type="button" onclick="submitForm(this, 'delete');">{lng[Delete selected]}</button>
<br /><br />
<?php
}
?>

<h3>{lng[New variant]}</h3>
<table class="new_variant">
<?php
foreach ($option_groups as $v) {?>
<tr>
 <td width="150" valign="top"><?php echo $v['name'];?></td>
 <td valign="top">
 <select name="new_variants[<?php echo $v['groupid']; ?>][]" multiple size="10" id="po-<?php echo $v['groupid']; ?>">
<?php
if ($v['options']) {	foreach ($v['options'] as $o) {
?>
 <option value="<?php echo $o['optionid']; ?>"><?php echo $o['name']; ?></option>
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
<button type="button" onclick="javascript: submitForm(this, 'add');">{lng[Add]}</button> <button type="button" onclick="javascript: all_possible();">{lng[Create all possible variants]}</button>
 </td>
</tr>
</table>


</form>

{if $warehouse_enabled}
{foreach $variants as $v}
<div class="warehouses" id="warehouses-{$v['variantid']}">
<form method="POST">
<input type="hidden" name="variantid" value="{$v['variantid']}" />
<div class="wh-list">
<table width="100%">
<tr>
 <th>{lng[Warehouse]}</th>
 <th>{lng[Avail]}</th>
</tr>
{foreach $v['warehouses'] as $w}
<tr>
 <td width="100%">{$w['wcode']}</td>
 <td nowrap><input type="text" size="3" name="variant_wh[{$v['variantid']}][{$w['wid']}]" value="{$w['avail']}" /></td>
</tr>
{/foreach}
</table>
</div>
<br />
<button class="save">{lng[Save]}</button>
<button type="button" class="cancel">{lng[Cancel]}</button>
</form>
</div>
{/foreach}
{/if}