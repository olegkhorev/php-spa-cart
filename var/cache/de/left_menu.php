<div id="left_menu">
<div class="mobile-menu-links">
<?php if ($languages) {?>
<div class="language_select mobile_languages_select">
Language:
<select>
<?php foreach ($languages as $c) {?>
<option value="<?php echo $c['id'];?>"<?php if ($current_language['id'] == $c['id'] || (!$current_language['id'] && $c['main'])) {?> selected<?php } ?>><?php echo $c['name'];?></option>
<?php } ?>
</select>
</div>
<?php } ?>

<?php if ($currencies) {?>
<div class="currency_select mobile_currency_select">
Währung:
<select>
<?php foreach ($currencies as $c) {?>
<option value="<?php echo $c['id'];?>"<?php if ($current_currency['id'] == $c['id'] || (!$current_currency['id'] && $c['main'])) {?> selected<?php } ?>><?php echo $c['code'];?></option>
<?php } ?>
</select>
</div>
<?php } ?>

<?php if ($currencies || $languages) {?>
<div class="clear"></div>
<hr />
<?php } ?>


<?php if ($login) {?>
<a href="/profile" class="ajax_link">Konto</a>
<a href="/profile/orders" class="ajax_link">Auftragshistorie</a>
<a href="/wishlist" class="ajax_link">Wunschzettel</a>
<a href="/logout">Logout</a>
<a href="/gift_cards" class="ajax_link">Geschenkkarten</a>
<?php } else  { ?>
<a href="/login" class="ajax_link">Login</a>
<a href="/register" class="ajax_link">Registrieren</a>
<a href="/login" class="ajax_link">Wunschzettel</a>
<a href="/login" class="ajax_link">Geschenkkarten</a>
<?php } ?>
<hr />
<?php 
$categories_menu = $categories_top_menu;
?>
<?php foreach ($categories_menu as $k=>$v) {?>
<?php 
		echo '<a class="ajax_link" href="/'.($v['cleanurl'] ? $v['cleanurl'] : $v['categoryid']).'" class="root-link">'.$v['title'].'</a>';
?>
<?php } ?>
<hr />
<a class="ajax_link" href="<?php echo $current_location;?>/brands">Marken</a>
<a class="ajax_link" href="<?php echo $current_location;?>/blog">Blog</a>
<a class="ajax_link" href="/page/about.html">Über CMS</a>
<a class="ajax_link" href="<?php if ($config['Tickets']['use_tickets']) {?>/support_desk<?php } else  { ?>/help<?php } ?>">Kontakt</a>
</div>
</div>