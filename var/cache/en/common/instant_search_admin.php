<?php if ($_GET['where'] == '1') {?>
<?php if ($products) {?>
<table>
<?php foreach ($products as $v) {?>
<tr>
 <td class="photo"><a class="ajax_link" href="<?php echo $current_location;?>/admin/products/<?php echo $v['productid'];?>">
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
 <td class="res-name"><a class="ajax_link" href="<?php echo $current_location;?>/admin/products/<?php echo $v['productid'];?>"><?php echo $v['name'];?></a>
<p><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?></p>
 </td>
</tr>
<?php } ?>
</table>
<?php if ($total_items > 30) {?>
<div class="more-no-search">And more</div>
<?php } ?>
<?php } else  { ?>
<div class="more-no-search">No products found</div>
<?php } ?>
<?php } else if ($_GET['where'] == '2') {?>
<?php if ($users) {?>
<table>
<?php foreach ($users as $v) {?>
<tr>
 <td class="res-name"><a class="ajax_link" href="<?php echo $current_location;?>/admin/user/<?php echo $v['id'];?>"><?php echo $v['firstname'];?> <?php echo $v['lastname'];?> (<?php echo $v['email'];?>)</a></td>
</tr>
<?php } ?>
</table>
<?php if ($total_items > 30) {?>
<div class="more-no-search">And more</div>
<?php } ?>
<?php } else  { ?>
<div class="more-no-search">No customers found</div>
<?php } ?>
<?php } else if ($_GET['where'] == '3') {?>
<?php if ($orders) {?>
<table>
<?php foreach ($orders as $v) {?>
<tr>
 <td class="res-name"><a class="ajax_link" href="<?php echo $current_location;?>/admin/invoice/<?php echo $v['orderid'];?>">#<?php echo $v['orderid'];?>, <?php echo $v['firstname'];?> <?php echo $v['lastname'];?> (<?php echo $v['email'];?>)</a></td>
</tr>
<?php } ?>
</table>
<?php if ($total_items > 30) {?>
<div class="more-no-search">And more</div>
<?php } ?>
<?php } else  { ?>
<div class="more-no-search">No orders found</div>
<?php } ?>
<?php } ?>