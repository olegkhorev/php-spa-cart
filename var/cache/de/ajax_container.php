<div class="page-container">
<div class="withleftmenu">
<div class="left_filter">
<h2>Schmale Auswahl</h2>
<div id="left_filter">
<div class="cssload-container"><div class="cssload-speeding-wheel"></div></div>

</div>
</div>

<div class="main-container">
<div class="filter_switcher"><svg><use xlink:href="/images/sprite.svg?1#filter_opener"></use></svg></div>
<div id="bread_crumbs_container"><?php echo $bread_crumbs_html;?></div>

<div class="content" align="left">
<?php if (false && !$no_left_menu) {?>
<?php echo $left_menu;;?>
<?php } ?>
	<div id="center"<?php if (true || $no_left_menu == 'Y') {?> class="no_left_menu"<?php } ?>>
<?php echo $page;?>

<?php if ($recently && $get['0'] != 'checkout') {?>
<?php if ($get['0'] != 'product' && $get['0'] != 'home') {?>
</div></div>
<?php } ?>
</div>
</div>
<div class="clear"></div>
</div>
<br /><br />
<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">Recently viewed</li>
</ul>
</div>

<?php /* ?> Start page container <?php */ ?>
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

 <?php $tag_id = "featured_products"; $products = $recently; $per_row = 4;; ?>
<div id="tab-7">
<div class="carousel-pr" id="carousel-5">
  <div class="controls">
    <div class="button-left">
      <div class="icon">
        <span></span>
      </div>
    </div>
    <div class="button-right">
      <div class="icon">
        <span></span>
      </div>
    </div>
  </div>
  <div class="carousel-wrapper">
    <div class="content-pr">
 <?php include SITE_ROOT."/var/cache/de/common/products.php";?>
     </div>
  </div>
</div>

</div>
<?php } ?>

	</div>
</div>

<div class="clear"></div>
</div>
</div>
</div>
</div>
<?php if ($alerts) {?>
 <div class="alerts"><span onclick="javascript: $('.alerts').slideUp();"><b>X</b></span>
 <?php foreach ($alerts as $v) {?>
  <?php if ($v['type'] == 'e') {?><div class="error">Error: <?php echo $v['content'];?></div><?php } else  { ?><?php echo $v['content'];?><br><?php } ?><br>
 <?php } ?>
 </div>
<?php } ?>
<div class="clear"></div>
