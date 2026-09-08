<?php if ($total_pages > 2) {?>
<div class="navigation">
<span class="navigation-title">Страницы:</span>

<?php if ($nav_arrow_left) {?>
<a class="navigation-larrow" href="<?php echo $navigation_script;?>&page=<?php echo $nav_arrow_left;?>"><img src="<?php echo $current_location;?>/images/spacer.gif" alt="Предыдущая страница" /></a>
<span class="nav-sep"></span>
<?php } ?>

<?php if ($start_page > 1) {?>
<a class="nav-page" href="<?php echo $navigation_script;?>&page=1">1</a><span class="nav-sep"></span>
<?php if ($start_page > 2) {?>
<span class="nav-dots">...</span><span class="nav-sep"></span>
<?php } ?>
<?php } ?>

<?php for ($i = $start_page; $i < $total_pages; $i++) {?>
 <?php if ($i == $navigation_page) {?>
<span class="current-page"><?php echo $i;?></span>
 <?php } else  { ?>
<a class="nav-page" href="<?php echo $navigation_script;?>&page=<?php echo $i;?>"><?php echo $i;?></a>
 <?php } ?>

 <?php if ($i != $total_pages - 1) {?>
<span class="nav-sep"></span>
 <?php } ?>
<?php } ?>

<?php if ($total_pages <= $total_all_pages) {?>
 <?php if ($total_pages < $total_all_pages) {?>
<span class="nav-sep"></span><span class="nav-dots">...</span>
 <?php } ?>
<span class="nav-sep"></span><a class="nav-page" href="<?php echo $navigation_script;?>&page=<?php echo $total_all_pages;?>"><?php echo $total_all_pages;?></a>
<?php } ?>

<?php if ($nav_arrow_right) {?>
<span class="nav-sep"></span>
<a class="navigation-rarrow" href="<?php echo $navigation_script;?>&page=<?php echo $nav_arrow_right;?>"><img src="<?php echo $current_location;?>/images/spacer.gif" alt="Следующая страница" /></a>
<?php } ?>
</div>
<?php } ?>