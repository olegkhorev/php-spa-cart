<div class="responsive-columns products"<?php if ($tag_id) {?> id="<?php echo $tag_id;?>"<?php } ?>>
<?php foreach ($products as $v) {?>
<div class="res-item">
<div class="res-zoom">
<?php /* ?>
<div data-productid="<?php echo $v['productid'];?>" class="quick-look main-button">Быстрый просмотр</div>
<?php */ ?>
</div>
<div class="photo">
<?php if ($v['list_price'] > $v['price']) {?>
<span class="discount">
<?php 
$percent = (($v['list_price'] - $v['price'])*100) / $v['list_price'];
echo '-'.round($percent).'%';
 ?>
</span>
<?php } ?>

<a class="save2wl" onclick="javascript: return <?php if ($login) {?>add_wishlist(<?php echo $v['productid'];?>);<?php } else  { ?>login_popup('W');<?php } ?>" href="javascript: void(0);"><svg><use xlink:href="/images/sprite.svg#favorite"></use></svg></a>

<a class="ajax_link"<?php /* ?><?php if ($device != 'mobile') {?> title="Move product to cart to add it"<?php } ?><?php */ ?> href="<?php echo $current_location;?>/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?>.html<?php } else  { ?>product/<?php echo $v['productid'];?><?php } ?>">
<?php if ($v['photo']) {?>
<?php 
$image = $v['photo'];
$image['new_width'] = 234;
$image['class'] = 'product-image';
$image['id'] = 'pid-'.$v['productid'];
$image['new_height'] = 200;
$image['center'] = 1;
include SITE_ROOT . '/includes/image.php';
?>
<?php } ?>
</a>
<?php /* ?>
<?php if ($device != 'mobile') {?>
<span class="move2cart">Добавь меня в корзину</span>
<?php } ?>
<?php */ ?>
</div>
 <div class="res-name"><a class="ajax_link" href="<?php echo $current_location;?>/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?>.html<?php } else  { ?>product/<?php echo $v['productid'];?><?php } ?>"><?php echo $v['name'];?></a></div>
 <div class="res-price">
 <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['price']); ?>
<?php if ($v['list_price']) {?><s><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['list_price']); ?></s><?php } ?>
 </div>
 <div class="res-rating">
 <div class="rating-votes"><div style="width: <?php func_average_rating($v); ?>%;"></div></div>
 </div>
 <div class="res-buttons">
<?php if ($v['avail'] > 0) {?>
<button id="pid<?php echo $v['productid'];?>">Купить<span><svg><use xlink:href="/images/sprite.svg#cart"></use></svg></span></button>
<?php } else  { ?>
<div class="out-of-stock">
Out of stock
</div>
<?php } ?>
<?php /* ?>
<br />
<a class="main-button" onclick="javascript: return <?php if ($login) {?>add_wishlist(<?php echo $v['productid'];?>);<?php } else  { ?>login_popup();<?php } ?>" href="javascript: void(0);">Добавить в список желаний</a>
<?php */ ?>
 </div>
</div>
<?php } ?>
</div>
<div class="clear"></div>