<div class="hidden filter-url"><?php echo $filter_url;?></div>
<?php if ($get['0'] != 'brands') {?>
<?php if ($filter['brandid']) {?>
<h4>Brands</h4>
<div class="selected-filter" data-id="<?php echo $filter['brandid'];?>" data-what="brand"><?php echo $filter['brand']['name'];?> (x)</div>
<?php } else if ($brands) {?>
<h4 class="pointer">Brands</h4>
<ul data-what="brand">
<?php foreach ($brands as $b) {?>
 <li data-id="<?php echo $b['id'];?>"><?php echo $b['name'];?> (<?php echo $b['cnt'];?>)</li>
<?php } ?>
</ul>
<?php } ?>
<?php } ?>

<?php if ($filter['price']) {?>
<h4>Price</h4>
<div class="selected-filter" data-id="<?php echo $filter['price'];?>" data-what="price"><?php echo $filter['price'];?> (x)</div>
<?php } else if ($prices) {?>
<h4 class="pointer">Price</h4>
<ul data-what="price">
<?php foreach ($prices as $k=>$v) {?>
 <li data-id="<?php echo $k;?>"><?php echo $k;?> (<?php echo $v;?>)</li>
<?php } ?>
</ul>
<?php } ?>

<?php if ($options) {?>
<?php foreach ($options as $c=>$o) {?>
<?php if (false && $filter['attr'][$c]) {?>
<h4><?php echo $c;?></h4>
<div class="selected-filter" data-id="<?php echo escape($c, 2);; ?>" data-oid="<?php echo escape($filter['attr'][$c], 2);; ?>" data-what="attr"><?php echo $filter['attr'][$c];?> (x)</div>
<?php } else  { ?>
<h4 class="pointer<?php if ($filter['attr'][$c]) {?> opened<?php } ?>"><?php echo $c;?></h4>
<ul data-what="attr" groupid="<?php echo func_filter_id($c);; ?>" class="filter-attr filter-box-<?php echo func_filter_id($c);; ?><?php if ($filter['attr'][$c]) {?> opened<?php } ?>">
<?php foreach ($o as $k=>$v) {?>
 <li data-id="<?php echo escape($c, 2);; ?>" data-oid="<?php echo escape($k, 2);; ?>"><label><input type="checkbox"<?php foreach ($filter['attr'][$c] as $selected) {?><?php if ($selected == $k) {?> checked<?php } ?><?php } ?> /><?php echo $k;?> (<?php echo $v['cnt'];?>)</label></li>
<?php } ?>
</ul>
<?php } ?>

<?php } ?>
<?php } ?>
<?php if ($_GET['filter']) {?>
<a href="javascript: void(0);" class="reset_filter">Reset filter</a>
<a href="<?php echo $reset_filter_url;?>" class="ajax_link reset_filter_url hidden"></a>
<?php } ?>
<?php /* ?>
<h4>Price range</h4>
<div class="filter-price">
<input type="text" id="min_price" value="<?php echo floor($min_price);; ?>" readonly /> - <input type="text" id="max_price" value="<?php echo ceil($max_price);; ?>" readonly />
<div id="slider-range"></div>
</div>
<?php */ ?>