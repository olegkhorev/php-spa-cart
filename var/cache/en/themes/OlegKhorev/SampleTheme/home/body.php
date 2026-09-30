<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($banners) {?>
<?php /* ?> Page container assign <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>
</div></div>

<center>
<br /><br />
Sample template theme
</center>
<div class="clear"></div>

<?php if (lng('Site title') || lng('Site description')) {?>
<div class="page-container page-container-afterbanner">
<div class="content">
	<div id="center" class="no_left_menu">
<?php } ?>
<?php } ?>
<div id="dcart"><img src="<?php echo $current_location;?>/images/dcart.png" alt="" /><br />Move product here</div>
<?php 
if (lng('Site title'))
	echo "<br /><h1>".lng('Site title')."</h1>";

if (lng('Site description'))
	echo "<br /><p>".lng('Site description')."</p>";
?>

<?php /* ?> Page container assign <?php */ ?>
<?php if (lng('Site title') || lng('Site description')) {?>
</div>
</div>
<div class="clear"></div>
</div>
<?php } ?>

<?php if ($config['Visual']['visual_testimonials'] == 'Y') {?>
<div class="page-container page-container-testimonials">
<div class="content">
	<div id="center" class="no_left_menu">

<div class="testimonial">
<img src="/images/testimonial.jpg" class="test-image" alt="Our testimonials" />
<h2>Testimonials</h2>
<div class="message message-box"><?php echo $testimonial['message'];?></div>
<div class="name"><?php echo $testimonial['name'];?></div>
<?php if ($testimonial['url']) {?>
<div class="url"><a rel="nofollow" href="<?php echo $testimonial['url'];?>" target="_blank"><?php echo $testimonial['url'];?></a></div>
<?php } ?>
<div class="test-links">
<a class="all-link link-button" href="/testimonials">All testimonials</a>
<a class="leave-link link-button" href="/testimonials/new">Write testimonial</a>
</div>
<div class="clear"></div>
</div>
<?php /* ?> End page container <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>
<?php } ?>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">Featured products</li>
</ul>
</div>

<?php /* ?> Start page container <?php */ ?>
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

<?php if ($featured_products) {?>
 <?php $tag_id = "featured_products"; $products = $featured_products; $per_row = 4;; ?>
<div class="tab-content" id="tab-1">
<div class="carousel-pr" id="carousel-0">
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
 <?php include SITE_ROOT."/var/cache/en/common/products.php";?>
     </div>
  </div>
</div>

</div>
<?php } ?>