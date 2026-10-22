<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php if ($blog) {?>

<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php } ?>

<div class="blog">
<div class="actions">
<?php if ($comments) {?>
<svg><use xlink:href="/images/sprite_3.svg#go_to_comments"></use></svg> <a href="javascript: void(0);" onclick="javascript: go_to_comments();">Go to comments</a>&nbsp;
<?php } ?>
<svg><use xlink:href="/images/sprite_3.svg#leave_comment"></use></svg> <a href="javascript: void(0);" onclick="javascript: leave_comments();">Leave a comment</a>
</div>
<h1><?php echo $blog['title'];?></h1>
<br />
<svg class="post_date_icon"><use xlink:href="/images/sprite_3.svg#calendar"></use></svg> &nbsp; <?php echo date($datetime_format, $blog['date']);; ?>
<?php if ($blog['imageid']) {?>
<div class="image">
<?php $image = $blog; $image['new_width'] = 750; $image['new_height'] = 400; include SITE_ROOT . "/includes/blog_image.php"; ?>
</div>
<?php } ?>
<div class="fulldescr"><?php echo $blog['fulldescr'];?></div>

<?php  if ($comments) { ?>
<h3 id="blog_comments_section"><?php  echo $blog["comments"]
    ? $blog["comments"]
    : "0"; ?> Blog comments</h3>

<div style="text-align:right"><?php include SITE_ROOT."/var/cache/en/common/navigation.php";?></div>

<div class="blog_comments">
<?php foreach ($comments as $k=>$v) {?>
<div class="author">
<div class="quote">
<svg><use xlink:href="/images/sprite_3.svg#quote"></use></svg> <a href="javascript: void(0);" onclick="javascript: quote_comment_html('<?php echo $v['commentid'];?>', '<?php $name = $v['name'] ? $v['name'] : $v['firstname'].' '.$v['lastname']; $name = escape($name, 1); echo escape($name, 2);; ?>');">Quote</a>
</div>
Comment from <b><?php echo $v['name'] ? $v['name'] : $v['firstname'].' '.$v['lastname'];; ?></b>. Commented on <?php echo date($datetime_format, $v['date']);; ?>.
</div>
<span id="comment_<?php echo $v['commentid'];?>" class="hidden"><?php echo $v['message'];?></span>
<div class="comment">
<?php echo $v['message'];?>
</div>
<?php } ?>
</div>
<?php } else  { ?>
<br /><div style="text-align:center">No comments yet</div><br /><br />
<?php } ?>

<a id="leave_comment"></a>
<h3>Leave a comment</h3>

<?php if (!$login && $config['Blog']['blog_guests'] != "Y") {?>
<br />
<div style="text-align:center">You should be a registered user to leave a comment.</div>
<br /><br />
<?php } else  { ?>
<form method="post" name="blogform">
<input type="hidden" name="blogid" value="<?php  echo $blog["blogid"]; ?>">
<table id="blog_bb_buttons">
<tbody>
<tr>
 <td><button type="button" onclick="javascript: iBold();"><b>B</b></button></td>
 <td><button type="button" onclick="javascript: iItalic();"><i>I</i></button></td>
 <td><button type="button" onclick="javascript: iUnderline();"><u>U</u></button></td>
 <td><button type="button" id="iLinkClickA" onclick="javascript: iLinkClick();">&nbsp;&#128279;&nbsp;</button></td>
</tr>
</tbody>
</table>

<div id="newrecord" contenteditable="true"></div>
<textarea name="comment" cols="80" rows="15"><?php if ($new_comment) {?><?php echo $new_comment['comment'];?><?php } ?></textarea>

<?php if ($login) {?>
<br />
<?php } else  { ?>
<div class="group">
  <input type="text" size="30" name="new_name"<?php if ($new_comment) {?> value="<?php echo escape($new_comment['new_name'], 2);; ?>"<?php } ?>>
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>Your name</label>
</div>
<?php if ($config['General']['recaptcha_key']) {?>
<div class="g-recaptcha" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div>
<?php } ?>
<br />
<?php } ?>

<button type="button" onclick="javascript: new_comment();">Add</button>
<br /><br />
</form>
<?php  } ?>
<?php } else if ($blogs) {?>
<h1>Blog</h1><br />
<?php if ($total_pages > 2) {?>
<div style="text-align:right"><?php include SITE_ROOT."/var/cache/en/common/navigation.php";?></div>
<br />
<?php } ?>
<div class="blogs news-item news-item-page">
<?php foreach ($blogs as $b) {?>
<?php $url = $current_location.'/blog/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['blogid']);; ?>
<div class="image">
<?php if ($b['imageid']) {?>
<a href="<?php echo $url;?>" class="ajax_link">
<?php $image = $b; $image['new_width'] = 250; $image['new_height'] = 250; include SITE_ROOT . "/includes/blog_image.php"; ?>
</a>
<?php } ?>
</div>
<div class="descr">
 <h2>
<span class="date"><?php  echo date(
    $date_format,
    $b["date"],
); ?></span> 
 <a href="<?php echo $url;?>" class="ajax_link simple-button"><?php echo $b['title'];?></a></h2>
 <div class="message-box"><?php echo $b['descr'];?></div>
 <div style="text-align:right"><a class="ajax_link link-button" href="<?php echo $url;?>">See full post</a>&nbsp;</div>
</div>
<div class="clear"></div>
<br />
<?php } ?>
</div>
<?php if ($total_pages > 2) {?>
<div style="text-align:right"><?php include SITE_ROOT."/var/cache/en/common/navigation.php";?></div>
<br />
<?php } ?>
<?php } else  { ?>
<br />
<div style="text-align:center">No topics yet</div>
<?php } ?>