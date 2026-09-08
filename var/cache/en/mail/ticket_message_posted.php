<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
:: Reply ABOVE THIS LINE to post a comment to the ticket ::<br /><br />

<?php echo $email_header;?>

Hello,

<?php if ($product) {?>
<p>Recently you asked a question about product <?php echo $product['sku'];?><br />
<a href="<?php echo $current_location;?>/<?php if ($product['cleanurl']) {?><?php echo $product['cleanurl'];?>.html<?php } else  { ?>product/<?php echo $product['productid'];?><?php } ?>"><?php echo $product['name'];?></a>
</p>
<?php } ?>

<p />A new message on your ticket #<?php echo $ticket['ticketid'];?>

<?php /* ?><?php if ($ticket['userid']) {?><?php */ ?>
<p />To see full ticket, please, follow here<br />
<a href="<?php echo $http_location;?>/ticket/<?php echo $ticket['ticketid'];?>?authkey=<?php echo $ticket['authkey'];?>"><?php echo $http_location;?>/ticket/<?php echo $ticket['ticketid'];?>?authkey=<?php echo $ticket['authkey'];?></a>
<?php /* ?><?php } ?><?php */ ?>

<p />Subject: <?php echo $ticket['subject'];?>

<hr size='1' />

<?php if ($product) {?>
Our answer:
<?php } else  { ?>
Replied Message:
<?php } ?>

<p /><?php echo $message['message'];?>

<br /><br />

<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>