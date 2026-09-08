<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
<?php echo $email_header;?>

Hello,

<p /><?php echo $userinfo['firstname'];?> <?php echo $userinfo['lastname'];?> has been placed a new message.

<p />Ticket #<?php echo $ticket['ticketid'];?>

<p />Priority: <?php $mode='static'; $value=$ticket['priority'];; ?><?php include SITE_ROOT."/var/cache/en/common/ticket_priority.php";?>

<p />To see full ticket, please, follow here<br />

<a href="<?php echo $http_location;?>/admin/ticket/<?php echo $ticket['ticketid'];?>"><?php echo $http_location;?>/admin/ticket/<?php echo $ticket['ticketid'];?></a>

<p />Subject: <?php echo $ticket['subject'];?>

<hr size='1' />

Message:

<p /><?php echo $message['message'];?>

<br /><br />

<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>