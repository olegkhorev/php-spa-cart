<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php /* ?> Page container assign <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>
</div></div>

    <!-- Banner -->
    <section id="hero-banner" class="w-full h-[400px] relative overflow-hidden bg-xmasGreen">
        <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 30px 30px;"></div>
        <img src="/images/themes/OlegKhorev/ChristmasTheme/gen_5dbc04da29_e0788e3b8ec0b5a6.png" alt="Christmas Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/30 flex items-center justify-center text-center px-4">
            <div class="max-w-2xl">
                <h1 class="font-serif text-5xl md:text-6xl text-white mb-6 drop-shadow-lg">Spread the Holiday Joy</h1>
                <p class="text-white text-xl mb-8 drop-shadow-md">Discover the most magical gifts for everyone on your list.</p>
                <div class="flex gap-4 justify-center">
                    <a href="/all-products" class="bg-xmasRed text-white px-8 py-3 rounded-full font-bold hover:bg-red-700 transition-all shadow-lg ajax_link">Shop Now</a>
                    <a href="/Clothing" class="bg-white text-xmasRed px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition-all shadow-lg ajax_link">View Catalog</a>
                </div>
            </div>
        </div>
    </section>
<br />
<div class="home-tabs-wrap">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">Featured products</li>
</ul>
</div>

<?php /* ?> Start page container <?php */ ?>
<div class="page-container page-container-2">
<div class="content">
	<div class="center-column no_left_menu">

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
 <?php get_template_contents("common/products.php", false, true); include SITE_ROOT."/var/cache/en/common/products.php";?>
     </div>
  </div>
</div>

</div>
<?php } ?>

<?php if ($config['Visual']['visual_news'] == 'Y' && $last_news) {?>
<?php /* ?> Page container assign <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div>

<div class="page-container page-container-news">
<div class="content">
	<div class="center-column no_left_menu">

<div class="news-list">
<h2>Browse our news</h2>
<?php foreach ($last_news as $b) {?>
<div class="news-item">
<?php $url = $current_location.'/news/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['newsid']);; ?>
<?php if ($b['imageid']) {?>
<a class="ajax_link" href="<?php echo $url;?>">
<?php $image = $b; $image['new_width'] = 250; $image['new_height'] = 200; include SITE_ROOT . "/includes/news_image.php"; ?>
</a>
<?php } ?>
<a class="ajax_link" href="<?php echo $url;?>"><h5><?php echo $b['title'];?> <span class="date"><?php  echo date(
    $date_format,
    $b["date"],
); ?></span></h5></a>
<div class="short-descr message-box"><?php echo $b['descr'];?></div>
<br />
<a class="news-more ajax_link link-button" href="<?php echo $url;?>">See full article</a>
</div>
<div class="clear"></div>
<?php } ?>
<a href="/news" class="ajax_link link-button">All news</a>
<br /><br />
</div>
<?php } ?>
