<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $news_data}
<div class="news">
<div class="date"><?php echo date($date_format, $news_data["date"]); ?></div>
<h1 class="title"><?php echo $news_data["title"]; ?></h1>
{if $news_data['imageid']}
<div class="image">
{news_image image=`$news_data` new_width=700 new_height=400}
</div>
{/if}
<div class="fulldescr">{$news_data['fulldescr']}</div>
<div class="back"><a href="/news" class="ajax_link">{lng[Back to News mainpage]}</a></div>
</div>

{else}

{if $news}
<h1>{lng[News]}</h1>
<br />
<div class="news-list">
{foreach $news as $b}
{php $url = $current_location.'/news/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['newsid']);}
<a class="ajax_link" href="{$url}"><h5>{$b['title']} (<span class="date"><?php echo date(
    $date_format,
    $b["date"],
); ?></span>)</h5></a>
<div class="news-item">
{if $b['imageid']}
<a class="ajax_link" href="{$url}">
{news_image image=`$b` new_width=250 new_height=200}
</a>
{/if}
<div class="short-descr message-box">{$b['descr']}</div>
<br />
<a class="news-more ajax_link link-button" href="{$url}">{lng[See full article]}</a>
</div>
<div class="clear"></div>
{/foreach}
</div>
{if $total_pages > 2}
{include="common/navigation.php"}
{/if}
{else}
{lng[No news found]}
{/if}
{/if}
<div class="clear"></div>