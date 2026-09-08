<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
Hello,<br /><br />
<p>New blog comment has been posted</p>
<a href="<?php echo $current_location;?>/admin/blog/<?php echo $blog['blogid'];?>"><?php echo $current_location;?>/admin/blog/<?php echo $blog['blogid'];?></a>
<br /><br />
<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>