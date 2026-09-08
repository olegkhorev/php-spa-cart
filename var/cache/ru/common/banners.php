<?php if ($get['0'] == 'category') {?>
<br />
<?php } else  { ?>
<div class="banners-container">
<?php } ?>
<div id="banners">
<div class="banners-slider">
<?php foreach ($banners as $k=>$v) {?>
<div id="banner_<?php echo $k;?>">
<?php if ($v['url']) {?>
<a href="<?php echo escape($v['url'], 2);; ?>">
<?php } ?>
<img src="<?php echo $current_location;?>/photos/banners/<?php echo $categoryid;?>/<?php echo $v['bannerid'];?>/<?php echo $v['file'];?>" alt="<?php echo escape($v['alt'], 2);; ?>" />
<?php if ($v['url']) {?>
</a>
<?php } ?>
</div>
<?php } ?>
</div>
<?php if (count($banners) > 1) {?>
<div id="banners_nav">
<?php for ($i = 0; $i < count($banners); $i++) {?>
<img src="<?php echo $current_location;?>/images/spacer.gif" alt="" id="g2b_<?php echo $i;?>"<?php if ($i == 0) {?> class="active"<?php } ?> />
<?php } ?>
</div>
<?php } ?>
</div>
<?php if ($get['0'] != 'category') {?>
</div>
<div class="clear"></div>
<?php } ?>