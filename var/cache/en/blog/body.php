<?php if ($blog) {?>

<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php } ?>

<div class="blog">
<div class="actions">
<?php if ($comments) {?>
<img src="<?php echo $current_location;?>/images/comments.gif" alt="" /> <a href="<?php echo $_REQUEST_URI;?>#comments">Go to comments</a>&nbsp;
<?php } ?>
<img src="<?php echo $current_location;?>/images/leave_comment.gif" alt="" /> <a href="<?php echo $REQUEST_URI;?>#leave_comment">Leave a comment</a>
</div>
<h1><?php echo $blog['title'];?></h1>
<br />
<img src="<?php echo $current_location;?>/images/blog_date.gif" alt="" /> <?php echo date($datetime_format, $blog['date']);; ?>
<?php if ($blog['imageid']) {?>
<div class="image">
<?php 
	$image = $blog;
	$image['new_width'] = 750;
	$image['new_height'] = 400;
	include SITE_ROOT . '/includes/blog_image.php';
?>
</div>
<?php } ?>
<div class="fulldescr"><?php echo $blog['fulldescr'];?></div>

<?php 
	if ($comments) {
?>
<a name="comments"></a>
<h3><?php  echo $blog['comments'] ? $blog['comments'] : "0"; ?> Blog comments</h3>

<div align="right"><?php include SITE_ROOT."/var/cache/en/common/navigation.php";?></div>

<div class="blog_comments">
<?php foreach ($comments as $k=>$v) {?>
<div class="author">
<div class="quote">
<img src="<?php echo $current_location;?>/images/quote.gif" alt="" /> <a href="javascript: void(0);" onclick="javascript: quote_comment('<?php echo $v['commentid'];?>', '<?php $name = $v['name'] ? $v['name'] : $v['firstname'].' '.$v['lastname']; $name = escape($name, 1); echo escape($name, 2);; ?>');">Quote</a>
</div>
Comment from <b><?php echo $v['name'] ? $v['name'] : $v['firstname'].' '.$v['lastname'];; ?></b>. Commented on <?php echo date($datetime_format, $v['date']);; ?>.
</div>
<span id="comment_<?php echo $v['commentid'];?>" class="hidden"><?php echo $v['message'];?></span>
<div class="comment">
<?php echo $v['bb_message'];?>
</div>
<?php } ?>
</div>
<?php } else  { ?>
<br /><center>No comments yet</center><br /><br />
<?php } ?>

<a name="leave_comment"></a>
<h3>Leave a comment</h3>

<?php if (!$login && $config['Blog']['blog_guests'] != "Y") {?>
<br />
<center>You should be a registered user to leave a comment.</center>
<br /><br />
<?php } else  { ?>
<form method="post" name="blogform">
<input type="hidden" name="blogid" value="<?php  echo $blog['blogid']; ?>">
<a onmouseover="javascript: bbhelp('b');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[b]','[/b]');"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/b.png" tabindex="-1"></a>
<a onmouseover="javascript: bbhelp('i');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[i]','[/i]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/i.png" tabindex="-2"></a>
<a onmouseover="javascript: bbhelp('u');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[u]','[/u]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/u.png" tabindex="-3"></a>
<a onmouseover="javascript: bbhelp('s');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[s]','[/s]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/s.png" tabindex="-3"></a>
<a onmouseover="javascript: bbhelp('url');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[url]','[/url]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/url.png" tabindex="-4"></a>
<a onmouseover="javascript: bbhelp('email');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[email]','[/email]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/email.png" tabindex="-5"></a>
<a onmouseover="javascript: bbhelp('img');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[img]','[/img]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/img.png" tabindex="-6"></a>
<a onmouseover="javascript: bbhelp('list');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[list][*]','[/*][/list]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/list.png" tabindex="-7"></a>
<a onmouseover="javascript: bbhelp('li');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[*]','[/*]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/li.png" tabindex="-8"></a>
<a onmouseover="javascript: bbhelp('quote');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[quote]','[/quote]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/quote.png" tabindex="-9"></a>
<a onmouseover="javascript: bbhelp('code');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[code]','[/code]')"><img alt="" src="<?php echo $current_location;?>/images/bbcodes/code.png" tabindex="-10"></a>

&nbsp;
<input size="40" id="helptext" readonly>
<br />

<textarea name="comment" cols="80" rows="15"><?php echo $new_comment['comment'];?></textarea>
<br /><br />

<?php if (!$login) {?>
Name <font color='#880000'>*</font>: <input type="text" size="30" name="new_name" value="<?php echo escape($new_comment['new_name'], 2);; ?>">
<br />
<?php if ($config['General']['recaptcha_key']) {?>
<br />
<div class="g-recaptcha" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div>
<?php } ?>
<br />
<?php } ?>

<button type="button" onclick="javascript: new_comment();">Add</button>
<br /><br />
</form>
<?php 
	}
?>
<?php } else if ($blogs) {?>
<h1>Our blog</h1><br />
<?php if ($total_pages > 2) {?>
<div align="right"><?php include SITE_ROOT."/var/cache/en/common/navigation.php";?></div>
<br />
<?php } ?>
<div class="blogs news-item news-item-page">
<?php foreach ($blogs as $b) {?>
<?php $url = $current_location.'/blog/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['blogid']);; ?>
<div class="author">
<i><?php echo $b['firstname'];?> <?php echo $b['lastname'];?>, <?php echo $b['comments'] ? $b['comments'] : '0';; ?> Comments</i>
<h2><a href="<?php echo $url;?>" class="ajax_link simple-button"><?php  echo $b['title']; ?></a></h2>
</div>
<div class="image">
<?php if ($b['imageid']) {?>
<a href="<?php echo $url;?>" class="ajax_link">
<?php 
		$image = $b;
		$image['new_width'] = 250;
		$image['new_height'] = 250;
		include SITE_ROOT . '/includes/blog_image.php';
?>
</a>
<?php } ?>
</div>
<div class="descr">
<div class="message-box"><?php echo $b['descr'];?></div>
<div align="right">
<a class="ajax_link link-button" href="<?php echo $url;?>">Read blog</a>&nbsp;
<a href="<?php echo $url;?>#leave_comment" class="link-button">Leave a comment</a>
</div>
</div>
<div class="clear"></div>
<br />
<?php } ?>
</div>
<?php if ($total_pages > 2) {?>
<div align="right"><?php include SITE_ROOT."/var/cache/en/common/navigation.php";?></div>
<br />
<?php } ?>
<?php } else  { ?>
<br />
<center>No topics yet</center>
<?php } ?>
