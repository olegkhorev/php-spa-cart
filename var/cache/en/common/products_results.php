<table class="products-nav">
<tr>
<?php if ($total_pages > 2) {?>
 <td class="first"><?php include SITE_ROOT."/var/cache/en/common/navigation.php";?></td>
<?php } ?>
<?php if ($device == 'mobile') {?>
</tr>
<tr>
<?php } ?>
 <td class="second sort-by">
<?php if ($sort_by) {?> <?php foreach ($sort_by as $k=>$v) {?>  <?php if ($k == $_GET['sort']) {?>
<a class="active direction-<?php if ($_GET['direction'] == '1') {?>2<?php } else  { ?>1<?php } ?>" href="<?php echo $sort_by_script;?>sort=<?php echo $k;?>&direction=<?php if ($_GET['direction'] == '1') {?>2<?php } else  { ?>1<?php } ?>"><?php echo lng($v);; ?></a>
  <?php } else  { ?><a href="<?php echo $sort_by_script;?>sort=<?php echo $k;?>&direction=1"><?php echo lng($v);; ?></a>
  <?php } ?> <?php } ?>
<?php } ?>
 </td>
</tr>
</table>

<?php if (!isset($_GET['direction']) || $_GET['direction']) {?>
 <?php $direction = "&direction=0";; ?>
<?php } else  { ?>
 <?php $direction = "&direction=1";; ?>
<?php } ?>
<?php include SITE_ROOT."/var/cache/en/common/products.php";?>


<?php if ($total_pages > 2) {?>
<br />
<div class="bottom-pagination">
<?php include SITE_ROOT."/var/cache/en/common/navigation.php";?>
</div>
<br />
<?php } ?>