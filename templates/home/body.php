{if $banners}
{* Page container assign *}
</div>
</div>
<div class="clear"></div>
</div>
</div></div>

<div class="banners-homepage">
{foreach $banners as $k=>$v}
<div id="hp_banner_{$k}" class="slide{if !$k} active{/if}">
{if $v['url']}
<a href="{php echo escape($v['url'], 2);}">
{/if}
<img src="/images/spacer.gif" class="hp-banner" style="background: url('{$v['image_url']}');" alt="{php echo escape($v['alt'], 2);}" />
{if $v['url']}
</a>
{/if}
</div>
{/foreach}

    <div class="arrow arrow-left">
    <span></span>
    </div>
    <div class="arrow arrow-right">
    <span></span>
    </div>
</div>

<div class="boxes-homepage-line">
<div class="boxes-homepage">
 <div><h2>{lng[Admin area]}</h2><p>Admin: a@a.com<br />Pass: 01230<br /><a href="https://demo.spa-cart.com/admin" target="_blank">https://demo.spa-cart.com/admin</a></p></div>
 <div><h2>{lng[Ajaxfied pages]}</h2><p>{lng[All pages are clean URLs, even in the admin area]}</p></div>
 <div><h2>{lng[Language labels]}</h2><p>{lng[Easy to Update and Translate. Translate mode for easy and quick translation.]}</p></div>
 <div><h2>{lng[Design versatility]}</h2><p>{lng[This is a framework. Any design can be applied]}</p></div>
 <div><h2>{lng[Test our cart]}</h2><p>Test credit card<br />4111 1111 1111 1111<br />Paypal test account<br />olegkhorev@gmail.com / 01234567</p></div>
 <div><h2>{lng[Mobile version]}</h2><p>{lng[Available automatically from your mobile phone.]}</p></div>
</div>
</div>
<div class="clear"></div>

{if lng('Site title') || lng('Site description')}
<div class="page-container page-container-afterbanner">
<div class="content">
	<div id="center" class="no_left_menu">
{/if}
{/if}
<div id="dcart"><img src="{$current_location}/images/dcart.png" alt="" /><br />{lng[Move product here]}</div>
<?php
if (lng('Site title'))
	echo "<br /><h1>".lng('Site title')."</h1>";

if (lng('Site description'))
	echo "<br /><p>".lng('Site description')."</p>";
?>

{* Page container assign *}
{if lng('Site title') || lng('Site description')}
</div>
</div>
<div class="clear"></div>
</div>
{/if}

<div class="page-container page-container-testimonials">
<div class="content">
	<div id="center" class="no_left_menu">

<div class="testimonial">
<img src="/images/testimonial.jpg" class="test-image" alt="{lng[Our testimonials|escape]}" />
<h2>{lng[Testimonials]}</h2>
<div class="message message-box">{$testimonial['message']}</div>
<div class="name">{$testimonial['name']}</div>
{if $testimonial['url']}
<div class="url"><a rel="nofollow" href="{$testimonial['url']}" target="_blank">{$testimonial['url']}</a></div>
{/if}
<div class="test-links">
<a class="all-link link-button" href="/testimonials">{lng[All testimonials]}</a>
<a class="leave-link link-button" href="/testimonials/new">{lng[Write testimonial]}</a>
</div>
<div class="clear"></div>
</div>
{* End page container *}
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">{lng[Featured products]}</li>
</ul>
</div>

{* Start page container *}
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

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

{if $bestsellers}
{* End page container *}
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">{lng[Bestsellers]}</li>
</ul>
</div>

{* Start page container *}
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

 {php $tag_id = "bestsellers_products"; $products = $bestsellers; $per_row = 4;}
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
 {include="common/products.php"}
     </div>
  </div>
</div>
</div>
{/if}

{if $most_viewed}
{* End page container *}
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">{lng[Most viewed]}</li>
</ul>
</div>

{* Start page container *}
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

 {php $tag_id = "most_viewed"; $products = $most_viewed; $per_row = 4;}
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
 {include="common/products.php"}
     </div>
  </div>
</div>
</div>
{/if}

{if $new_arrivals}
{* End page container *}
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">{lng[New arrivals]}</li>
</ul>
</div>

{* Start page container *}
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">

 {php $tag_id = "new_arrivals"; $products = $new_arrivals; $per_row = 4;}
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
 {include="common/products.php"}
     </div>
  </div>
</div>
</div>
{/if}

{if $last_news}
{* Page container assign *}
</div>
</div>
<div class="clear"></div>
</div>

<div class="page-container page-container-news">
<div class="content">
	<div id="center" class="no_left_menu">

<div class="news-list">
<h2>{lng[Browse our news]}</h2>
{foreach $last_news as $b}
<div class="news-item">
{php $url = $current_location.'/news/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['newsid']);}
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
<a class="ajax_link" href="{$url}"><h5>{$b['title']} (<span class="date"><?php echo date($date_format, $b['date']); ?></span>)</h5></a>
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

{if $last_blog}
{* Page container assign *}
</div>
</div>
<div class="clear"></div>
</div>

<div class="page-container page-container-blog">
<div class="content">
	<div id="center" class="no_left_menu">

<div class="news-list">
<h2>{lng[Browse our blog]}</h2>
<div class="news-item">
{php $url = $current_location.'/blog/'.($last_blog['cleanurl'] ? $last_blog['cleanurl'].'.html' : $last_blog['blogid']);}
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
<a class="ajax_link" href="{$url}"><h5>{$last_blog['title']} (<span class="date"><?php echo date($date_format, $last_blog['date']); ?></span>)</h5></a>
<div class="short-descr message-box">{$last_blog['descr']}</div>
<br />
<a class="news-more ajax_link link-button" href="{$url}">{lng[See full blog]}</a>
</div>
<div class="clear"></div>

<a href="/blog" class="ajax_link link-button">{lng[All blogs]}</a>
<br /><br />
</div>
{/if}
