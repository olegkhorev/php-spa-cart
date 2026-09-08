<div id="left_menu">
<div class="mobile-menu-links">
{if $login}
<a href="/profile" class="ajax_link">{lng[Account]}</a>
<a href="/wishlist" class="ajax_link">{lng[Wishlist]}</a>
<a href="/logout">{lng[Logout]}</a>
<a href="/gift_cards" class="ajax_link">{lng[Gift Cards]}</a>
{else}
<a href="/login" class="ajax_link">{lng[Login]}</a>
<a href="/register" class="ajax_link">{lng[Register]}</a>
<a href="/login" class="ajax_link">{lng[Wishlist]}</a>
<a href="/login" class="ajax_link">{lng[Gift Cards]}</a>
{/if}
<hr />
<?php
$categories_menu = $categories_top_menu;
?>
{foreach $categories_menu as $k=>$v}
<?php
		echo '<a class="ajax_link" href="/'.($v['cleanurl'] ? $v['cleanurl'] : $v['categoryid']).'" class="root-link">'.$v['title'].'</a>';
?>
{/foreach}
<hr />
<a class="ajax_link" href="{$current_location}/brands">{lng[Brands]}</a>
<a class="ajax_link" href="{$current_location}/blog">{lng[Blog]}</a>
<a class="ajax_link" href="/page/about.html">{lng[About CMS]}</a>
<a class="ajax_link" href="/help">{lng[Contact]}</a>
</div>
</div>