<?php include SITE_ROOT."/var/cache/en/mail/header.php";?>
Hello<?php if ($user['firstname']) {?> <?php echo $user['firstname'];?><?php } ?>,<br /><br />
<p>Recently you left products in your cart on our site <a href="<?php echo $current_location;?>?<?php echo $link_add;?>"><?php echo $config['Company']['company_name'];?></a>.</p>

<table>
<?php foreach ($cart['products'] as $p) {?>
<?php $url = $current_location.($p['cleanurl'] ? '/'.$p['cleanurl'].'.html' : '/product/'.$p['productid']);; ?>
<tr>
 <td valign="top">
<?php if ($p['photo']) {?>
<?php 
$image = $p['photo'];
$image['new_width'] = 100;
$image['new_height'] = 100;
include SITE_ROOT . '/includes/image.php';
?>
<?php } ?>
 </td>
 <td valign="top"><a href="<?php echo $url;?>?<?php echo $link_add;?>"><?php echo $p['name'];?></a></td>
</tr>
<?php } ?>
</table>
<br />
<a href="<?php echo $current_location;?>?<?php echo $link_add;?>">View your cart</a><br />

<br /><br />
<?php echo $signature;?>
<?php include SITE_ROOT."/var/cache/en/mail/footer.php";?>