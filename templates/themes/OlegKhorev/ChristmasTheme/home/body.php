<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{* Page container assign *}
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
 <li class="tab-1 active" data-tab="1">{lng[Featured products]}</li>
</ul>
</div>

{* Start page container *}
<div class="page-container page-container-2">
<div class="content">
	<div class="center-column no_left_menu">

{if $featured_products}
 {php $tag_id = "featured_products"; $products = $featured_products; $per_row = 4;}
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
 {include="common/products.php"}
     </div>
  </div>
</div>

</div>
{/if}

{if $config['Visual']['visual_news'] == 'Y' && $last_news}
{* Page container assign *}
</div>
</div>
<div class="clear"></div>
</div>

<div class="page-container page-container-news">
<div class="content">
	<div class="center-column no_left_menu">

<div class="news-list">
<h2>{lng[Browse our news]}</h2>
{foreach $last_news as $b}
<div class="news-item">
{php $url = $current_location.'/news/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['newsid']);}
{if $b['imageid']}
<a class="ajax_link" href="{$url}">
{news_image image=`$b` new_width=250 new_height=200}
</a>
{/if}
<a class="ajax_link" href="{$url}"><h5>{$b['title']} <span class="date"><?php echo date(
    $date_format,
    $b["date"],
); ?></span></h5></a>
<div class="short-descr message-box">{$b['descr']}</div>
<br />
<a class="news-more ajax_link link-button" href="{$url}">{lng[See full article]}</a>
</div>
<div class="clear"></div>
{/foreach}
<a href="/news" class="ajax_link link-button">{lng[All news]}</a>
<br /><br />
</div>
{/if}
