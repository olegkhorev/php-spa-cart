<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $banners}
{* Page container assign *}
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

{if $config['Visual']['visual_testimonials'] == 'Y'}
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
{/if}

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