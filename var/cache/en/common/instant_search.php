<?php if ($products) {?>
<table>
<?php foreach ($products as $v) {?>
<tr>
 <td class="photo"><a class="ajax_link" href="<?php echo $current_location;?>/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?>.html<?php } else  { ?>product/<?php echo $v['productid'];?><?php } ?>">
<?php if ($v['photo']) {?>
<?php 
$image = $v['photo'];
$image['new_width'] = 40;
$image['class'] = 'product-image';
$image['id'] = 'pid-'.$v['productid'];
$image['new_height'] = 40;
$image['center'] = 1;
include SITE_ROOT . '/includes/image.php';
?>
<?php } ?>
</a>
 </td>
 <td class="res-name"><a class="ajax_link" href="<?php echo $current_location;?>/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?>.html<?php } else  { ?>product/<?php echo $v['productid'];?><?php } ?>"><?php echo $v['name'];?></a>
<p><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?></p>
 </td>
</tr>
<?php } ?>
</table>
<?php if ($total_items > 10) {?>
<div class="more-no-search">And more</div>
<?php } ?>
<?php } else  { ?>
<div class="more-no-search">No products found</div>
<?php } ?>