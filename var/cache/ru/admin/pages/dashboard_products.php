<table cellspacing="0">
<?php foreach ($products as $v) {?>
<tr>
 <td class="photo"><a target="_blank" href="/admin/products/<?php echo $v['productid'];?>">
<?php if ($v['photo']) {?>
<?php 
$image = $v['photo'];
$image['new_width'] = 50;
$image['class'] = 'product-image';
$image['id'] = 'pid-'.$v['productid'];
$image['new_height'] = 50;
$image['center'] = 1;
include SITE_ROOT . '/includes/image.php';
?>
<?php } ?>
</a>
 </td>
 <td class="name"><a target="_blank" href="/admin/products/<?php echo $v['productid'];?>"><?php echo $v['name'];?></a><span><?php if ($type == 'B') {?> (<?php echo $v['sales_stats'];?> sales)<?php } else if ($type == 'M') {?> (<?php echo $v['views_stats'];?> views)<?php } ?></span></td>
</tr>
<?php } ?>
</table>