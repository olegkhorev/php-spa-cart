<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($v['gift_card']) {?>
<b>Gift Card</b><br />
You will see the Gift Card key phrase on paid invoice
<?php } else  { ?>
	  <a href="<?php echo $current_location;?>/<?php echo $url;?>"><?php echo $v['name'];?></a>
<?php } ?>
<?php if ($v['weight'] && $v['weight'] != '0.00') {?>
<br /><small>Weight: <?php echo price_format($v['weight']).' <span class="weight-symbol">lbs</span>'; ?></small>
<?php } ?>
<?php if ($v['product_options']) {?>
<hr />
<b>Selected options:</b><br />
<table width="100%">
<?php foreach ($v['product_options'] as $o) {?>
<tr>
	<td width="100" valign="top"><?php echo $o['name'];?>:</td>
	<td><?php echo $o['option']['name'];?></td>
</tr>
<?php } ?>
</table>
<?php } ?>