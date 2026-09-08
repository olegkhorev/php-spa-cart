<?php if ($banners) {?>
<?php /* ?> Page container assign <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>
</div></div>

<div class="banners-homepage">
<?php foreach ($banners as $k=>$v) {?>
<div id="hp_banner_<?php echo $k;?>" class="slide<?php if (!$k) {?> active<?php } ?>">
<?php if ($v['url']) {?>
<a href="<?php echo escape($v['url'], 2);; ?>">
<?php } ?>
<img src="/images/spacer.gif" class="hp-banner" style="background: url('<?php echo $v['image_url'];?>');" alt="<?php echo escape($v['alt'], 2);; ?>" />
<?php if ($v['url']) {?>
</a>
<?php } ?>
</div>
<?php } ?>

    <div class="arrow arrow-left">
    <span></span>
    </div>
    <div class="arrow arrow-right">
    <span></span>
    </div>
</div>

<div class="boxes-homepage-line">
<div class="boxes-homepage">
 <div><h2>Admin area</h2><p>Admin: a@a.com<br />Pass: 01230<br /><a href="https://demo.spa-cart.com/admin" target="_blank">https://demo.spa-cart.com/admin</a></p></div>
 <div><h2>Ajaxfied pages</h2><p>All pages are clean URLs, even in the admin area</p></div>
 <div><h2>Language labels</h2><p>Easy to Update and Translate.</p></div>
 <div><h2>Design versatility</h2><p>This is a framework. Any design can be applied</p></div>
 <div><h2>Test our cart</h2><p>Test credit card<br />4111 1111 1111 1111<br />Paypal test account<br />olegkhorev@gmail.com / 01234567</p></div>
 <div><h2>Mobile version</h2><p>Available automatically from your mobile phone.</p></div>
</div>
</div>
<div class="clear"></div>

<?php if (lng('Site title') || lng('Site description')) {?>
<div class="page-container page-container-afterbanner">
<div class="content">
	<div id="center" class="no_left_menu">
<?php } ?>
<?php } ?>
<div id="dcart"><img src="<?php echo $current_location;?>/images/dcart.png" alt="" /><br />Bewegen Produkt hier</div>
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

<div class="page-container page-container-testimonials">
<div class="content">
	<div id="center" class="no_left_menu">

<div class="testimonial">
<img src="/images/testimonial.jpg" class="test-image" alt="Unsere Referenzen" />
<h2>Erfahrungsberichte</h2>
<div class="message message-box"><?php echo $testimonial['message'];?></div>
<div class="name"><?php echo $testimonial['name'];?></div>
<?php if ($testimonial['url']) {?>
<div class="url"><a rel="nofollow" href="<?php echo $testimonial['url'];?>" target="_blank"><?php echo $testimonial['url'];?></a></div>
<?php } ?>
<div class="test-links">
<a class="all-link link-button" href="/testimonials">Alle testimonials</a>
<a class="leave-link link-button" href="/testimonials/new">Erfahrungsbericht schreiben</a>
</div>
<div class="clear"></div>
</div>
<?php /* ?> End page container <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">Empfohlene Produkte</li>
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
 <?php include SITE_ROOT."/var/cache/de/common/products.php";?>
     </div>
  </div>
</div>

</div>
<?php } ?>

<?php if ($bestsellers) {?>
<?php /* ?> End page container <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">Bestseller</li>
</ul>
</div>

<?php /* ?> Start page container <?php */ ?>
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

 <?php $tag_id = "bestsellers_products"; $products = $bestsellers; $per_row = 4;; ?>
<div class="tab-content" id="tab-2">
<div class="carousel-pr" id="carousel-1">
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

<?php if ($most_viewed) {?>
<?php /* ?> End page container <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">Am meisten angesehen</li>
</ul>
</div>

<?php /* ?> Start page container <?php */ ?>
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

 <?php $tag_id = "most_viewed"; $products = $most_viewed; $per_row = 4;; ?>
<div class="tab-content" id="tab-3">
<div class="carousel-pr" id="carousel-2">
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

<?php if ($new_arrivals) {?>
<?php /* ?> End page container <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">Neuankömmlinge</li>
</ul>
</div>

<?php /* ?> Start page container <?php */ ?>
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

 <?php $tag_id = "new_arrivals"; $products = $new_arrivals; $per_row = 4;; ?>
<div class="tab-content" id="tab-4">
<div class="carousel-pr" id="carousel-3">
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

<?php if ($last_news) {?>
<?php /* ?> Page container assign <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>

<div class="page-container page-container-news">
<div class="content">
	<div id="center" class="no_left_menu">

<div class="news-list">
<h2>Durchsuchen Sie unsere news</h2>
<?php foreach ($last_news as $b) {?>
<div class="news-item">
<?php $url = $current_location.'/news/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['newsid']);; ?>
<?php 
	if ($b['imageid']) {
		echo '<a class="ajax_link" href="'.$url.'">';
		$image = $b;
		$image['new_width'] = 250;
		$image['new_height'] = 200;
		include SITE_ROOT . '/includes/news_image.php';
		echo '</a>';
	}
?>
<a class="ajax_link" href="<?php echo $url;?>"><h5><?php echo $b['title'];?> (<span class="date"><?php  echo date($date_format, $b['date']); ?></span>)</h5></a>
<div class="short-descr message-box"><?php echo $b['descr'];?></div>
<br />
<a class="news-more ajax_link link-button" href="<?php echo $url;?>">Sehen Sie vollen Artikel</a>
</div>
<div class="clear"></div>
<?php } ?>
<a href="/news" class="ajax_link link-button">Alle news</a>
<br /><br />
</div>
<?php } ?>

<?php if ($last_blog) {?>
<?php /* ?> Page container assign <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>

<div class="page-container page-container-blog">
<div class="content">
	<div id="center" class="no_left_menu">

<div class="news-list">
<h2>Durchsuchen Sie unsere blog</h2>
<div class="news-item">
<?php $url = $current_location.'/blog/'.($last_blog['cleanurl'] ? $last_blog['cleanurl'].'.html' : $last_blog['blogid']);; ?>
<?php 
	if ($last_blog['imageid']) {
		echo '<a class="ajax_link" href="'.$url.'">';
		$image = $last_blog;
	$image['new_width'] = 250;
	$image['new_height'] = 200;
	include SITE_ROOT . '/includes/blog_image.php';
		echo '</a>';
	}
?>
<a class="ajax_link" href="<?php echo $url;?>"><h5><?php echo $last_blog['title'];?> (<span class="date"><?php  echo date($date_format, $last_blog['date']); ?></span>)</h5></a>
<div class="short-descr message-box"><?php echo $last_blog['descr'];?></div>
<br />
<a class="news-more ajax_link link-button" href="<?php echo $url;?>">Sehen Sie die vollständigen blog</a>
</div>
<div class="clear"></div>

<a href="/blog" class="ajax_link link-button">Alle blogs</a>
<br /><br />
</div>
<?php } ?>
