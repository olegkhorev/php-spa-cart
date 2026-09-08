<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
<?php echo $email_header;?>
Hello,
<br /><br />
<p>New testimonial is here</p>
<br />
<a href="<?php echo $http_location;?>/admin/testimonials"><?php echo $http_location;?>/admin/testimonials</a>
<br /><br />
<?php echo $signature;?>;
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>