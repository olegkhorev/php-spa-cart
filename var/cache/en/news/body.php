<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($news_data) {?>
<div class="news">
<div class="date"><?php  echo date($date_format, $news_data["date"]); ?></div>
<h1 class="title"><?php  echo $news_data["title"]; ?></h1>
<?php if ($news_data['imageid']) {?>
<div class="image">
<?php $image = $news_data; $image['new_width'] = 700; $image['new_height'] = 400; include SITE_ROOT . "/includes/news_image.php"; ?>
</div>
<?php } ?>
<div class="fulldescr"><?php echo $news_data['fulldescr'];?></div>
<div class="back"><a href="/news" class="ajax_link">Back to News mainpage</a></div>
</div>

<?php } else  { ?>

<?php if ($news) {?>
<h1>News</h1>
<br />
<div class="news-list">
<?php foreach ($news as $b) {?>
<?php $url = $current_location.'/news/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['newsid']);; ?>
<a class="ajax_link" href="<?php echo $url;?>"><h5><?php echo $b['title'];?> (<span class="date"><?php  echo date(
    $date_format,
    $b["date"],
); ?></span>)</h5></a>
<div class="news-item">
<?php if ($b['imageid']) {?>
<a class="ajax_link" href="<?php echo $url;?>">
<?php $image = $b; $image['new_width'] = 250; $image['new_height'] = 200; include SITE_ROOT . "/includes/news_image.php"; ?>
</a>
<?php } ?>
<div class="short-descr message-box"><?php echo $b['descr'];?></div>
<br />
<a class="news-more ajax_link link-button" href="<?php echo $url;?>">See full article</a>
</div>
<div class="clear"></div>
<?php } ?>
</div>
<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<?php } ?>
<?php } else  { ?>
No news found
<?php } ?>
<?php } ?>
<div class="clear"></div>