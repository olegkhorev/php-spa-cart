<div class="page-container">
<?php if ($alerts) {?>
 <div class="alerts"><span onclick="javascript: $('.alerts').slideUp();"><b>X</b></span>
 <?php foreach ($alerts as $v) {?>
  <?php if ($v['type'] == 'e') {?><div class="error">Error: <?php echo $v['content'];?></div><?php } else  { ?><?php echo $v['content'];?><br><?php } ?><br>
 <?php } ?>
 </div>
<?php } ?>

<div class="content">
<div id="bread_crumbs_container"><?php echo $bread_crumbs_html;?></div>
<div id="center"<?php if (true || $no_left_menu == 'Y') {?> class="no_left_menu"<?php } ?>>
<?php echo $page;?>
</div>
 </div>

<div class="clear"></div>
</div>