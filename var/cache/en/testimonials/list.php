<?php if ($_GET['mode'] == 'login') {?>
<script>
login_popup();
</script>
<?php } ?>
<br />
<button onclick="self.location='<?php echo $current_location;?>/testimonials/new';">Write testimonial</button>
<br /><br />
<hr size="1" />
<?php if ($total_pages > 2) {?>
<br />
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php } ?>
<table cellspacing="0" cellpadding="0" class="testimonials-list">
<?php foreach ($testimonials as $t) {?>
<tr>
 <th align="left"><?php echo $t['name'];?><?php if ($t['url']) {?> (<a rel="nofollow" href="<?php echo $t['url'];?>" target="_blank"><?php echo $t['url'];?></a>)<?php } ?></th>
 <th align="right"><?php echo date($date_format, $t['date']);; ?></th>
</tr>
<tr>
 <td colspan="2" class="message" align="left"><div class="message-box"><?php echo $t['message'];?></div></td>
</tr>
<?php } ?>
</table>
<?php if ($total_pages > 2) {?>
<br />
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
<br />
<?php } ?>

<hr size="1" />
<br />
<button onclick="self.location='<?php echo $current_location;?>/testimonials/new';">Write testimonial</button>
<br />