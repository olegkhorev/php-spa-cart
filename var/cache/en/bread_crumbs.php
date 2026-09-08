<?php if (count($bread_crumbs) > 1) {?>
<div class="bread_crumbs">
<?php foreach ($bread_crumbs as $k=>$v) {?>
 <?php if ($v['0']) {?>
<a href="<?php echo $v['0'];?>"><?php echo $v['1'];?></a>
 <?php } else  { ?>
<span><?php echo $v['1'];?></span>
 <?php } ?>
 <?php if ($k != count($bread_crumbs) - 1) {?> &raquo; <?php } ?>
<?php } ?>
</div>
<?php } ?>