<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
Hello <?php echo $userinfo['firstname'];?> <?php echo $userinfo['lastname'];?>,<br /><br />
<p>You has been successfully registered on our site</p>
<a href="<?php echo $http_location;?>"><?php echo $http_location;?></a>
<br /><br />
<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>