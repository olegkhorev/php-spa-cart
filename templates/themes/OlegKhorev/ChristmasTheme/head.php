    <!-- Top Bar -->
    <div id="top-bar" class="bg-xmasGreen text-white py-2">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
            <div class="flex gap-4">
                <font href="file:///Users/olegkhorev/Downloads/01-JollyGifts%20-%20Home.html#" class="hover:text-xmasGold transition-colors"><i class="mr-1" data-fa-i2svg=""><svg class="svg-inline--fa fa-truck-fast" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="truck-fast" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"></path></svg></i> Free Shipping on orders over $99</font>
            </div>
            <div class="flex gap-4">
{if $login}
<a href="/profile" onclick="javascript: return profile_popup(1);" class="hover:text-xmasGold transition-colors ajax_link_mobile">{lng[Account]}</a>
<a href="/profile/orders" onclick="javascript: return profile_popup('/orders');" class="hover:text-xmasGold transition-colors ajax_link_mobile">{lng[Orders]}</a>
<a href="/wishlist" class="wishlist-link hover:text-xmasGold transition-colors ajax_link_mobile">{lng[Wishlist]}</a>
<a href="/logout" class="hover:text-xmasGold transition-colors">{lng[Log out]}</a>
{else}
<a href="/login" onclick="javascript: return login_popup();" class="hover:text-xmasGold transition-colors ajax_link_mobile">{lng[Login]}</a>
<a href="/register" onclick="javascript: return register_popup();"" class="hover:text-xmasGold transition-colors ajax_link_mobile">{lng[Register]}</a>
<a href="/login" onclick="javascript: return login_popup();"" class="hover:text-xmasGold transition-colors ajax_link_mobile">{lng[Orders]}</a>
<a href="/login" onclick="javascript: return login_popup();"" class="hover:text-xmasGold transition-colors ajax_link_mobile">{lng[Wishlist]}</a>
{/if}
<a class="ajax_link hover:text-xmasGold transition-colors" href="{if $config['Tickets']['use_tickets']}/support_desk{else}/help{/if}">{lng[Email us]}</a>
            </div>
        </div>
    </div>

    <!-- Header & Navigation -->
    <header id="header" class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4">
            <!-- Main Header Row -->
            <div class="flex justify-between items-center py-4 gap-4">
                <!-- Logo -->
                <a href="/" class="ajax_link">
                <div class="flex items-center gap-3 shrink-0">
                    <img src="/images/themes/OlegKhorev/ChristmasTheme/gen_4fddb70a19_d87eb00a07a20c64.png" alt="Santa Logo" class="w-10 h-10 md:w-12 md:h-12 object-contain">
                    <span class="font-serif text-xl md:text-2xl font-bold text-xmasRed">Christmas</span>
                </div>
                </a>

                <!-- Search -->
                <div class="hidden md:flex flex-1 max-w-xl searchform_mobile">
                    <div class="relative w-full">
                        <input type="text" placeholder="Search for the perfect gift..." class="w-full bg-gray-50 border border-gray-200 rounded-full py-2 px-6 focus:outline-none focus:ring-2 focus:ring-xmasRed/20 focus:border-xmasRed transition-all" readonly>
                            <i data-fa-i2svg=""><svg class="svg-inline--fa fa-magnifying-glass" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path></svg></i>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 md:gap-6 shrink-0">
                    <a href="/cart" class="hover:text-xmasRed transition-colors flex flex-col items-center relative ajax_link" id="minicart">
{$minicart}
                    </a>
                </div>
            </div>

            <!-- Menu Bar -->
            <nav id="menu-bar" class="flex items-center justify-center gap-6 md:gap-8 py-3 text-[10px] md:text-sm font-semibold uppercase tracking-wider overflow-x-auto whitespace-nowrap scrollbar-hide">
{if $categories_top_menu}
<div class="menu-container">
<ul id="menu">
 {foreach $categories_top_menu as $k=>$v}
 <li id="menu-{$v['categoryid']}" class="{if $v['subcategories']}with-drop-down {/if}{if $v['categoryid'] == $parentid} active{/if}"><a class="parent-link" href="{$current_location}/{if $v['cleanurl']}{$v['cleanurl']}{else}{$v['categoryid']}{/if}">{$v['title']}</a>
  {if $v['subcategories']}
  <ul>
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
</ul>
{/if}
            </nav>
        </div>
    </header>