<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
<?php echo $email_header;?>
Hello
<br /><br />
<p>Someone interesting in your product</p>
Phone: <?php echo $phone;?><br />
IP: <?php echo $user['REMOTE_ADDR'];?><br />
Product: <a href="<?php echo $current_location;?>/<?php if ($product['cleanurl']) {?><?php echo $product['cleanurl'];?>.html<?php } else  { ?>product/<?php echo $product['productid'];?><?php } ?>"><?php echo $product['name'];?></a>
<br /><br />
<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>