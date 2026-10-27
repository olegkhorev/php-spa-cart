<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<div class="admin-location">
<?php if ($login && $userinfo['usertype'] == 'A') {?>
<?php echo $location;?>
<?php } ?>
</div>
<hr />
<?php if ($alerts) {?>
 <div class="alerts admin-alerts"><span class="close-alerts"><b>X</b> Close</span>
 <?php $already = array();; ?>
 <?php foreach ($alerts as $v) {?>
	 <?php if (!in_array($v['content'], $already)) {?>
  <?php if ($v['type'] == 'e') {?><div class="error"><?php if ($lng == 'en') {?>Error<?php } ?>: <?php echo $v['content'];?></div><?php } else  { ?><?php echo $v['content'];?><br /><?php } ?><br />
		<?php $already[] = $v['content'];; ?>
		<?php } ?>
	<?php } ?>
 </div>
<?php } ?>
<br />
<?php echo $page;?>
<div class="clear"></div>