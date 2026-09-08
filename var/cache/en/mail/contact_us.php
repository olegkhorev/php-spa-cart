<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
<?php echo $email_header;?>
Hello
<br /><br />
<p>Message from <?php echo $email;?></p>
<br /><?php echo func_eol2br($message);; ?>
<br /><br />
<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>