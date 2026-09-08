<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
Hello,<br /><br />
<p><?php echo $name;?> recommended you this product</p>
<?php $url = $current_location.($product['cleanurl'] ? '/'.$product['cleanurl'].'.html' : '/product/'.$product['productid']);; ?>
<a href="<?php echo $url;?>"><?php echo $product['name'];?></a><br />
<?php echo $url;?>
<?php if ($message) {?>
<hr />
<?php echo func_eol2br($message);; ?>
<?php } ?>
<br /><br />
<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>