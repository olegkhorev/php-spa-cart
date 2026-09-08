<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
Hello,<br /><br />
<p><?php echo $name;?> posted new review</p>
<?php $url = $current_location.($product['cleanurl'] ? '/'.$product['cleanurl'].'.html' : '/product/'.$product['productid']);; ?>
<a href="<?php echo $url;?>"><?php echo $product['name'];?></a><br />
<br />
<?php $url = $current_location.'/admin/reviews';; ?>
<a href="<?php echo $url;?>">Manage reviews</a><br />
<hr />
<b>Rating</b>: <?php echo $rating;?><br /><br />
<b>Message</b>: <?php echo func_eol2br($message);; ?>
<br /><br />
<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>