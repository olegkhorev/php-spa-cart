<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<div class="news-content">
<h1>{lng[News]}</h1>

<?php if ($news) { ?>

<div class="news">
<div class="date"><?php echo date($date_format, $news["date"]); ?></div>
<h1 class="title"><?php echo $news["title"]; ?></h1>
{if $news['imageid']}
<div class="image">
{news_image image=`$news['image']` new_width=700 new_height=400}
</div>
{/if}
<div class="fulldescr">{$news['fulldescr']}</div>
<div class="back"><a href="/news" class="ajax_link">{lng[Back to News mainpage]}</a></div>
</div>

<?php } else { ?>
<?php
if (!$newss) {
    echo "<br /><br />No news found<br />";
    return;
}
if ($news_substring) {
    echo '<br /><a href="/news?nosearch=1">Reset search condition</a><br /><br />';
}
?>

{if $newss}
<div class="news-list">
<br />
{foreach $newss as $b}
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
{/if}

<?php if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<br />
<?php }} ?>
</div>
<div class="clear"></div>