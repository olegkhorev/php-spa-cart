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
<?php echo $email_header;?>
Dear <?php echo $user['firstname'];?>,
<br>
<br>
To set new password, <a href="<?php echo $http_location;?>/password/<?php echo $user['id'];?>/<?php echo $key;?>">click here</a>
<br /><br />
<?php echo $signature;?>;
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>