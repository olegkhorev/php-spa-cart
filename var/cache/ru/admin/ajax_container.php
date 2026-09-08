<div class="admin-location">
<?php if ($login && $userinfo['usertype'] == 'A') {?>
<?php echo $location;?>
<?php } ?>
</div>
<hr />
  <?php 
	if ($alerts) {
		echo '<div class="alerts"><span class="close-alerts"><b>X</b> Close</span>';
		foreach ($alerts as $v) {
			if ($v['type'] == 'e') {
?>
<div class="error">Ошибка:
<?php 
				echo ' '.$v['content'].'</div>';
			} else  {
				echo ' '.$v['content'].'<br>';
			}

			echo '<br>';
		}

		echo '</div>';
	}
  ?>

<br />
<?php echo $page;?>
<div class="clear"></div>