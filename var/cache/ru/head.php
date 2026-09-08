<div class="head-line">
<?php if ($languages) {?>
<div class="language_select">
<div>
<?php foreach ($languages as $c) {?>
<?php if ($current_language['id'] == $c['id'] || (!$current_language['id'] && $c['main'])) {?>
<img src="/images/flags/<?php echo $c['code'];?>.png" alt="" /> <?php echo $c['name'];?>
<?php } ?>
<?php } ?>
<ul>
<?php foreach ($languages as $c) {?>
<li><a href="javascript: void(0);" data-id="<?php echo $c['id'];?>"><img src="/images/flags/<?php echo $c['code'];?>.png" alt="" /> <?php echo $c['name'];?></a></li>
<?php } ?>
</ul>
</div>
<?php /* ?>
<select>
<?php foreach ($languages as $c) {?>
<option value="<?php echo $c['id'];?>"<?php if ($current_language['id'] == $c['id'] || (!$current_language['id'] && $c['main'])) {?> selected<?php } ?>><?php echo $c['name'];?></option>
<?php } ?>
</select>
<?php */ ?>
</div>
<?php } ?>

<?php if ($currencies) {?>
<div class="currency_select">
<div><?php foreach ($currencies as $c) {?><?php if ($current_currency['id'] == $c['id'] || (!$current_currency['id'] && $c['main'])) {?><?php echo $c['code'];?><?php } ?><?php } ?>
<ul>
<?php foreach ($currencies as $c) {?>
<li><a href="javascript: void(0);" data-id="<?php echo $c['id'];?>"><?php echo $c['code'];?></a></li>
<?php } ?>
</ul>
</div>
<?php /* ?>
<select>
<?php foreach ($currencies as $c) {?>
<option value="<?php echo $c['id'];?>"<?php if ($current_currency['id'] == $c['id'] || (!$current_currency['id'] && $c['main'])) {?> selected<?php } ?>><?php echo $c['code'];?></option>
<?php } ?>
</select>
<?php */ ?>
</div>
<?php } ?>

<div class="head-line-links">
<?php if ($login) {?>
<a href="/profile" onclick="javascript: return profile_popup(1);">Аккаунт</a>
<a href="/wishlist" class="wishlist-link">Хотелки</a>
<a href="/logout">Выход</a>
<a href="/gift_cards" class="ajax_link">Подарочные карты</a>
<?php } else  { ?>
<a href="/login" onclick="javascript: return login_popup();">Вход</a>
<a href="/register" onclick="javascript: return register_popup();">Регистрация</a>
<a href="/login" onclick="javascript: return login_popup();">Хотелки</a>
<a href="/login" onclick="javascript: return login_popup();">Подарочные карты</a>
<?php } ?>
<a class="parent-link ajax_link" href="<?php echo $current_location;?>/blog">Блог</a>
<a class="parent-link ajax_link" href="/news">Новости</a>
<a class="header-email ajax_link" class="parent-link" href="<?php if ($config['Tickets']['use_tickets']) {?>/support_desk<?php } else  { ?>/help<?php } ?>"><svg><use xlink:href="/images/sprite.svg#email"></use></svg><?php /* ?><img src="/images/icons/email.png" alt="Помощь" /><?php */ ?> Помощь</a>
<div>
<a class="parent-link ajax_link" href="/page/about.html">CMS</a>
<ul>
 <li><a class="ajax_link" href="<?php echo $current_location;?>/page/scripts-structure.html">Scripts structure</a></li>
 <li><a class="ajax_link" href="<?php echo $current_location;?>/page/templages-engine.html">Templates engine</a></li>
 <li><a class="ajax_link" href="<?php echo $current_location;?>/page/MySQL-standards.html">MySQL standards</a></li>
</ul>
</div>

<div class="top-line-brands">
<a class="parent-link ajax_link" href="<?php echo $current_location;?>/brands">Бренды</a>
<?php if ($brands_menu) {?>
<ul>
 <?php foreach ($brands_menu as $v) {?>
 <li><a class="ajax_link" href="<?php echo $current_location;?>/brands/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?><?php } else  { ?><?php echo $v['brandid'];?><?php } ?>"><?php echo $v['name'];?></a></li>
 <?php } ?>
</ul>
<?php } ?>
</div>
</div>

</div>


<div class="header desktop_head">
<?php /* ?>
<div class="top-line">
<div class="free-shipping">
<svg><use xlink:href="/images/sprite.svg#delivery"></use></svg>
 Бесплатная доставка на заказы свыше $100 (только для США)</div>
<div class="social-icons">
<a href="http://facebook.com" target="_blank"><svg><use xlink:href="/images/sprite.svg#facebook"></use></svg></a>
<a href="http://twitter.com" target="_blank"><svg><use xlink:href="/images/sprite.svg#twitter"></use></svg></a>
<a href="http://facebook.com" target="_blank"><svg><use xlink:href="/images/sprite.svg#pin"></use></svg></a>
</div>
<div class="links">
</div>
</div>
<?php */ ?>

<a href="/" class="logo-link"><img src="/images/logo_new.png" alt="" /></a>
<?php if ($mobile_link) {?>
<a class="mobile-version" href="<?php echo $mobile_link;?>">Mobile version</a>
<?php } ?>
<div class="menu-container">
<ul id="menu">
<?php if ($categories_top_menu) {?>
 <?php foreach ($categories_top_menu as $k=>$v) {?>
 <li id="menu-<?php echo $v['categoryid'];?>" class="<?php if ($v['subcategories']) {?>with-drop-down <?php } ?><?php if ($v['categoryid'] == $parentid) {?> active<?php } ?>"><a class="parent-link" href="<?php echo $current_location;?>/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?><?php } else  { ?><?php echo $v['categoryid'];?><?php } ?>"><?php echo $v['title'];?></a>
  <?php if ($v['subcategories']) {?>
<?php /* ?><div class="submenu-fade"></div><?php */ ?>
  <ul>
<?php /* ?>	<li class="top-part"></li><?php */ ?>
   <?php foreach ($v['subcategories'] as $s) {?>
   <li><a href="<?php echo $current_location;?>/<?php if ($s['cleanurl']) {?><?php echo $s['cleanurl'];?><?php } else  { ?><?php echo $s['categoryid'];?><?php } ?>"><?php echo $s['title'];?></a>
	<?php if ($s['subcategories']) {?><div>
	 <?php foreach ($s['subcategories'] as $s2) {?>
<a href="<?php echo $current_location;?>/<?php if ($s2['cleanurl']) {?><?php echo $s2['cleanurl'];?><?php } else  { ?><?php echo $s2['categoryid'];?><?php } ?>"><?php echo $s2['title'];?></a>
	 <?php } ?>
	 </div>
	<?php } ?>
   </li>
   <?php } ?>
  </ul>
  <?php } ?>
 </li>
 <?php } ?>
<?php } ?>
  <li id="menu-brands" class="<?php if ($brands_menu) {?>with-drop-down <?php } ?><?php if ($get['0'] == 'brands') {?> active<?php } ?>"><a class="parent-link" href="<?php echo $current_location;?>/brands">Бренды</a>
<?php if ($brands_menu) {?>
<ul>
 <?php foreach ($brands_menu as $v) {?>
 <li><a href="<?php echo $current_location;?>/brands/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?><?php } else  { ?><?php echo $v['brandid'];?><?php } ?>"><?php echo $v['name'];?></a></li>
 <?php } ?>
</ul>
<?php } ?>
  </li>
<?php /* ?>
  <li id="menu-blog"<?php if ($get['0'] == 'blog') {?> class="active"<?php } ?>><a class="parent-link" href="<?php echo $current_location;?>/blog">Блог</a></li>
  <li id="menu-page"<?php if ($get['0'] == 'page') {?> class="active"<?php } ?>><a class="parent-link" href="/page/about.html">CMS</a>
<ul>
 <li><a href="<?php echo $current_location;?>/page/scripts-structure.html">Scripts structure</a></li>
 <li><a href="<?php echo $current_location;?>/page/templages-engine.html">Templates engine</a></li>
 <li><a href="<?php echo $current_location;?>/page/MySQL-standards.html">MySQL standards</a></li>
</ul>
  </li>
  <li id="menu-news"<?php if ($get['0'] == 'news') {?> class="active"<?php } ?>><a class="parent-link" href="/news">Новости</a>
<?php */ ?>
  <li class="search-dd"><svg><use xlink:href="/images/sprite.svg#search"></use></svg>
<form method="POST" action="/search" class="searchform searchform_desktop">
<div class="search">
<input type="text" name="substring" value="<?php if ($substring) {?><?php echo escape($substring, 2);; ?><?php } ?>" placeholder="Поиск" autocomplete="off" />
<button type="submit"><svg><use xlink:href="/images/sprite.svg#search"></use></svg></button>
<div class="instant-search"><div class='enter-3-chars'>Введите не менее 2 символов</div></div>
</div>
</form>
  </li>
</ul>
</div>

<div class="menu_right_part">
<div class="mrp-row">
<div class="mrp-rounded-box"><svg><use xlink:href="/images/sprite.svg#phone"></use></svg></div>
<div class="mrp-title">Свяжитесь с нами</div>
<div class="mrp-subtitle"><?php echo $config['Company']['company_phone'];?></div>
<div class="mrp-subtitle-2">Бесплатный звонок</div>
</div>

<div class="mrp-row mrp-row-cart">
<div class="mrp-rounded-box"><svg><use xlink:href="/images/sprite.svg#cart"></use></svg></div>
<div id="minicart">
<?php echo $minicart;?>
</div>
</div>

</div>
</div>

<div class="subheader">
<table>
<tr>
 <td>
<div class="sh-rounded-box">
<svg><use xlink:href="/images/sprite.svg#delivery"></use></svg>
</div>
<h4>БЕСПЛАТНАЯ ДОСТАВКА И ВОЗВРАТ</h4>
<span>Бесплатная доставка на заказы от $99</span>
 </td>
 <td>
<div class="sh-rounded-box">
<svg><use xlink:href="/images/sprite.svg#money"></use></svg>
</div>
<h4>ГАРАНТИЯ ВОЗВРАТА СРЕДСТВ</h4>
<span>Для заказов, созданных менее чем за 30</span>
 </td>
 <td>
<div class="sh-rounded-box">
<svg><use xlink:href="/images/sprite.svg#ring_phone"></use></svg>
</div>
<h4>ОНЛАЙН ПОДДЕРЖКА 24/7</h4>
<span>В любое время в любом месте: <?php echo $config['Company']['company_phone'];?></span>
 </td>
</tr>
</table>
</div>

<div id="head_mobile">
<?php /* ?><div class="header-phone">Свяжитесь с нами <?php echo $config['Company']['company_phone'];?></div><?php */ ?>
<div id="minicart">
<?php echo $minicart;?>
</div>

<div class="navigation-toggle"><div class="toggle-box"><div class="toggle-inner"></div></div></div>


<a href="/" class="logo-link"><img src="/images/logo_new.png" alt="" /></a>

<form method="POST" action="/search" class="searchform searchform_mobile">
<div class="search">
<input type="text" name="substring" value="<?php if ($substring) {?><?php echo escape($substring, 2);; ?><?php } ?>" placeholder="Поиск" autocomplete="off" />
<button type="submit"><svg><use xlink:href="/images/sprite.svg#search"></use></svg></button>
<div class="instant-search"><div class='enter-3-chars'>Введите не менее 2 символов</div></div>
</div>
</form>

</div>