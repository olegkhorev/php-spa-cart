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
Reply above here<br /><br />

<?php echo $email_header;?>

Hello,

<?php if ($product) {?>
<p>Recently you asked a question about product <?php echo $product['sku'];?><br />
<a href="<?php echo $current_location;?>/<?php if ($product['cleanurl']) {?><?php echo $product['cleanurl'];?>.html<?php } else  { ?>product/<?php echo $product['productid'];?><?php } ?>"><?php echo $product['name'];?></a>
</p>
<?php } ?>

<p>A new message on your ticket #<?php echo $ticket['ticketid'];?></p>

<?php /* ?><?php if ($ticket['userid']) {?><?php */ ?>
<p>Full ticket<br />
<a href="<?php echo $http_location;?>/ticket/<?php echo $ticket['ticketid'];?>?authkey=<?php echo $ticket['authkey'];?>"><?php echo $http_location;?>/ticket/<?php echo $ticket['ticketid'];?>?authkey=<?php echo $ticket['authkey'];?></a>
<?php /* ?><?php } ?><?php */ ?>
</p>

<p>Ticket subject: <?php echo $ticket['subject'];?></p>

<hr style="border-bottom-width: 0;" />

<?php if ($product) {?>
Our answer:
<?php } else  { ?>
Replied Message:
<?php } ?>

<div style="margin: 1em 0;"><?php echo $message['message'];?>

<br /><br />

<?php echo $signature;?>
</div>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>