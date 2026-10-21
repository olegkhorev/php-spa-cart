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

Hello,

<p><?php echo $userinfo['firstname'];?> <?php echo $userinfo['lastname'];?> has been placed a new message.</p>

<p>Ticket #<?php echo $ticket['ticketid'];?></p>

<p>Priority: <?php $mode='static'; $value=$ticket['priority'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?></p>

<p>Full ticket<br />

<a href="<?php echo $http_location;?>/admin/ticket/<?php echo $ticket['ticketid'];?>"><?php echo $http_location;?>/admin/ticket/<?php echo $ticket['ticketid'];?></a>
</p>

<p>Ticket subject: <?php echo $ticket['subject'];?></p>

<hr style="border-bottom-width: 0;" />

Message:

<div style="margin: 1em 0;"><?php echo $message['message'];?>

<br /><br />

<?php echo $signature;?>
</div>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>