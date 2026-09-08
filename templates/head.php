<div class="head-line">
{if $languages}
<div class="language_select">
<div>
{foreach $languages as $c}
{if $current_language['id'] == $c['id'] || (!$current_language['id'] && $c['main'])}
<img src="/images/flags/{$c['code']}.png" alt="" /> {$c['name']}
{/if}
{/foreach}
<ul>
{foreach $languages as $c}
<li><a href="javascript: void(0);" data-id="{$c['id']}"><img src="/images/flags/{$c['code']}.png" alt="" /> {$c['name']}</a></li>
{/foreach}
</ul>
</div>
{*
<select>
{foreach $languages as $c}
<option value="{$c['id']}"{if $current_language['id'] == $c['id'] || (!$current_language['id'] && $c['main'])} selected{/if}>{$c['name']}</option>
{/foreach}
</select>
*}
</div>
{/if}

{if $currencies}
<div class="currency_select">
<div>{foreach $currencies as $c}{if $current_currency['id'] == $c['id'] || (!$current_currency['id'] && $c['main'])}{$c['code']}{/if}{/foreach}
<ul>
{foreach $currencies as $c}
<li><a href="javascript: void(0);" data-id="{$c['id']}">{$c['code']}</a></li>
{/foreach}
</ul>
</div>
{*
<select>
{foreach $currencies as $c}
<option value="{$c['id']}"{if $current_currency['id'] == $c['id'] || (!$current_currency['id'] && $c['main'])} selected{/if}>{$c['code']}</option>
{/foreach}
</select>
*}
</div>
{/if}

<div class="head-line-links">
{if $login}
<a href="/profile" onclick="javascript: return profile_popup(1);">{lng[Account]}</a>
<a href="/wishlist" class="wishlist-link">{lng[Wishlist]}</a>
<a href="/logout">{lng[Log out]}</a>
<a href="/gift_cards" class="ajax_link">{lng[Gift Cards]}</a>
{else}
<a href="/login" onclick="javascript: return login_popup();">{lng[Login]}</a>
<a href="/register" onclick="javascript: return register_popup();">{lng[Register]}</a>
<a href="/login" onclick="javascript: return login_popup();">{lng[Wishlist]}</a>
<a href="/login" onclick="javascript: return login_popup();">{lng[Gift Cards]}</a>
{/if}
<a class="parent-link ajax_link" href="{$current_location}/blog">{lng[Blog]}</a>
<a class="parent-link ajax_link" href="/news">{lng[News]}</a>
<a class="header-email ajax_link" class="parent-link" href="{if $config['Tickets']['use_tickets']}/support_desk{else}/help{/if}"><svg><use xlink:href="/images/sprite.svg#email"></use></svg>{*<img src="/images/icons/email.png" alt="{lng[Email us|escape]}" />*} {lng[Email us]}</a>
<div>
<a class="parent-link ajax_link" href="/page/about.html">{lng[About CMS]}</a>
<ul>
 <li><a class="ajax_link" href="{$current_location}/page/scripts-structure.html">Scripts structure</a></li>
 <li><a class="ajax_link" href="{$current_location}/page/templages-engine.html">Templates engine</a></li>
 <li><a class="ajax_link" href="{$current_location}/page/MySQL-standards.html">MySQL standards</a></li>
</ul>
</div>

<div class="top-line-brands">
<a class="parent-link ajax_link" href="{$current_location}/brands">{lng[Brands]}</a>
{if $brands_menu}
<ul>
 {foreach $brands_menu as $v}
 <li><a class="ajax_link" href="{$current_location}/brands/{if $v['cleanurl']}{$v['cleanurl']}{else}{$v['brandid']}{/if}">{$v['name']}</a></li>
 {/foreach}
</ul>
{/if}
</div>
</div>

</div>


<div class="header desktop_head">
{*
<div class="top-line">
<div class="free-shipping">
<svg><use xlink:href="/images/sprite.svg#delivery"></use></svg>
 {lng[Free shipping on orders over $100 (US only)]}</div>
<div class="social-icons">
<a href="http://facebook.com" target="_blank"><svg><use xlink:href="/images/sprite.svg#facebook"></use></svg></a>
<a href="http://twitter.com" target="_blank"><svg><use xlink:href="/images/sprite.svg#twitter"></use></svg></a>
<a href="http://facebook.com" target="_blank"><svg><use xlink:href="/images/sprite.svg#pin"></use></svg></a>
</div>
<div class="links">
</div>
</div>
*}

<a href="/" class="logo-link"><img src="/images/logo_new.png" alt="" /></a>
{if $mobile_link}
<a class="mobile-version" href="{$mobile_link}">Mobile version</a>
{/if}
<div class="menu-container">
<ul id="menu">
{if $categories_top_menu}
 {foreach $categories_top_menu as $k=>$v}
 <li id="menu-{$v['categoryid']}" class="{if $v['subcategories']}with-drop-down {/if}{if $v['categoryid'] == $parentid} active{/if}"><a class="parent-link" href="{$current_location}/{if $v['cleanurl']}{$v['cleanurl']}{else}{$v['categoryid']}{/if}">{$v['title']}</a>
  {if $v['subcategories']}
{*<div class="submenu-fade"></div>*}
  <ul>
{*	<li class="top-part"></li>*}
   {foreach $v['subcategories'] as $s}
   <li><a href="{$current_location}/{if $s['cleanurl']}{$s['cleanurl']}{else}{$s['categoryid']}{/if}">{$s['title']}</a>
	{if $s['subcategories']}<div>
	 {foreach $s['subcategories'] as $s2}
<a href="{$current_location}/{if $s2['cleanurl']}{$s2['cleanurl']}{else}{$s2['categoryid']}{/if}">{$s2['title']}</a>
	 {/foreach}
	 </div>
	{/if}
   </li>
   {/foreach}
  </ul>
  {/if}
 </li>
 {/foreach}
{/if}
  <li id="menu-brands" class="{if $brands_menu}with-drop-down {/if}{if $get['0'] == 'brands'} active{/if}"><a class="parent-link" href="{$current_location}/brands">{lng[Brands]}</a>
{if $brands_menu}
<ul>
 {foreach $brands_menu as $v}
 <li><a href="{$current_location}/brands/{if $v['cleanurl']}{$v['cleanurl']}{else}{$v['brandid']}{/if}">{$v['name']}</a></li>
 {/foreach}
</ul>
{/if}
  </li>
{*
  <li id="menu-blog"{if $get['0'] == 'blog'} class="active"{/if}><a class="parent-link" href="{$current_location}/blog">{lng[Blog]}</a></li>
  <li id="menu-page"{if $get['0'] == 'page'} class="active"{/if}><a class="parent-link" href="/page/about.html">{lng[About CMS]}</a>
<ul>
 <li><a href="{$current_location}/page/scripts-structure.html">Scripts structure</a></li>
 <li><a href="{$current_location}/page/templages-engine.html">Templates engine</a></li>
 <li><a href="{$current_location}/page/MySQL-standards.html">MySQL standards</a></li>
</ul>
  </li>
  <li id="menu-news"{if $get['0'] == 'news'} class="active"{/if}><a class="parent-link" href="/news">{lng[News]}</a>
*}
  <li class="search-dd"><svg><use xlink:href="/images/sprite.svg#search"></use></svg>
<form method="POST" action="/search" class="searchform searchform_desktop">
<div class="search">
<input type="text" name="substring" value="{if $substring}{php echo escape($substring, 2);}{/if}" placeholder="{lng[Search|escape]}" autocomplete="off" />
<button type="submit"><svg><use xlink:href="/images/sprite.svg#search"></use></svg></button>
<div class="instant-search"><div class='enter-3-chars'>{lng[Enter at least 2 characters]}</div></div>
</div>
</form>
  </li>
</ul>
</div>

<div class="menu_right_part">
<div class="mrp-row">
<div class="mrp-rounded-box"><svg><use xlink:href="/images/sprite.svg#phone"></use></svg></div>
<div class="mrp-title">{lng[Call Us]}</div>
<div class="mrp-subtitle">{$config['Company']['company_phone']}</div>
<div class="mrp-subtitle-2">{lng[Free call]}</div>
</div>

<div class="mrp-row mrp-row-cart">
<div class="mrp-rounded-box"><svg><use xlink:href="/images/sprite.svg#cart"></use></svg></div>
<div id="minicart">
{$minicart}
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
<h4>{lng[FREE SHIPPING & RETURN]}</h4>
<span>{lng[Free shipping on all orders over $99]}</span>
 </td>
 <td>
<div class="sh-rounded-box">
<svg><use xlink:href="/images/sprite.svg#money"></use></svg>
</div>
<h4>{lng[MONEY BACK GUARANTEE]}</h4>
<span>{lng[For all orders created in below 30 days]}</span>
 </td>
 <td>
<div class="sh-rounded-box">
<svg><use xlink:href="/images/sprite.svg#ring_phone"></use></svg>
</div>
<h4>{lng[ONLINE SUPPORT 24/7]}</h4>
<span>{lng[Any time any place]}: {$config['Company']['company_phone']}</span>
 </td>
</tr>
</table>
</div>

<div id="head_mobile">
{*<div class="header-phone">{lng[Call Us]} {$config['Company']['company_phone']}</div>*}
<div id="minicart">
{$minicart}
</div>

<div class="navigation-toggle"><div class="toggle-box"><div class="toggle-inner"></div></div></div>


<a href="/" class="logo-link"><img src="/images/logo_new.png" alt="" /></a>

<form method="POST" action="/search" class="searchform searchform_mobile">
<div class="search">
<input type="text" name="substring" value="{if $substring}{php echo escape($substring, 2);}{/if}" placeholder="{lng[Search|escape]}" autocomplete="off" />
<button type="submit"><svg><use xlink:href="/images/sprite.svg#search"></use></svg></button>
<div class="instant-search"><div class='enter-3-chars'>{lng[Enter at least 2 characters]}</div></div>
</div>
</form>

</div>