<h1>Wishlist</h1>
<?php if ($wishlist) {?>
<table width="100%">
<tr>
 <th width="70%" align="left" colspan="2">Product</th>
 <th width="20%">Price</th>
 <td width="10%"></td>
</tr>
<?php foreach ($wishlist as $v) {?>
<?php $url = $v['product']['cleanurl'] ? $v['product']['cleanurl'].'.html' : 'product/'.$v['product']['productid'];; ?>
	<tr>
	 <td class="image"><a href="<?php echo $current_location;?>/<?php echo $url;?>">
	<?php if ($v['product']['photo']) {?>
<?php 
		$image = $v['product']['photo'];
		$image['new_width'] = 100;
		$image['new_height'] = 100;
		include SITE_ROOT . '/includes/image.php';
?>
	<?php } ?>
	 </a></td>
	 <td><a href="<?php echo $current_location;?>/<?php echo $url;?>"><?php echo $v['product']['name'];?></a></td>
	 <td align="center" valign="middle"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['product']['price']); ?></td>
	 <td><a href="<?php echo $current_location;?>/wishlist/remove/<?php echo $v['wlid'];?>" class="remove-wl-link">Delete</a></td>
	</tr>
<?php } ?>
</table>
<br />
<hr />
<br />
<button type="button" class="clear-wl"<?php  if (!$is_ajax) echo ' onclick="self.location=\'wishlist/clear\'"'; ?>>Clear wishlist</button>
</form>
<?php } else  { ?><br />
Wishlist is empty
<br /><br />
<?php } ?>