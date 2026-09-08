<?php if ($total_pages > 2) {?>
<div class="navigation">
<span class="navigation-title">Pages:</span>

<?php if ($currentPage > 1) {?>
<a class="navigation-larrow" href="<?php echo $navigation_script;?>&page=<?php echo $currentPage - 1;; ?>"><img src="<?php echo $current_location;?>/images/spacer.gif" alt="Previous page" /></a>
<span class="nav-sep"></span>
<?php } ?>


<?php if ($currentPage > $maxPagesToShow - 2) {?>
<a class="nav-page" href="<?php echo $navigation_script;?>&page=1">1</a><span class="nav-sep"></span>
<?php if ($startPage > 1 && $currentPage != 4) {?>
<span class="nav-dots">...</span><span class="nav-sep"></span>
<?php } ?>
<?php } ?>

<?php for ($i = $startPage; $i <= $endPage; $i++) {?>
<?php if ($i == $currentPage) {?>
<span class="current-page"><?php echo $i;?></span>
<?php } else  { ?>
<a class="nav-page" href="<?php echo $navigation_script;?>&page=<?php echo $i;?>"><?php echo $i;?></a>
<?php } ?>
<?php if ($i != $total_pages - 1) {?>
<span class="nav-sep"></span>
<?php } ?>
<?php } ?>

<?php if ($currentPage < ($totalPages - 2) && $totalPages > 4) {?>
<?php if ($currentPage < ($totalPages - 1) && $currentPage != ($totalPages - 3)) {?>
<span class="nav-sep"></span><span class="nav-dots">...</span>
<?php } ?>

<span class="nav-sep"></span><a class="nav-page" href="<?php echo $navigation_script;?>&page=<?php echo $totalPages;?>"><?php echo $totalPages;?></a>
<?php } ?>

<?php if ($currentPage < $totalPages) {?>
<span class="nav-sep"></span>
<a class="navigation-rarrow" href="<?php echo $navigation_script;?>&page=<?php echo $currentPage + 1;; ?>"><img src="<?php echo $current_location;?>/images/spacer.gif" alt="Next page" /></a>
<?php } ?>

</div>
<?php } ?>