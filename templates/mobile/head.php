<div class="header">
<div class="head-box">
<a href="/" class="logo-link"><img src="/images/new/logo_new.png" alt="" /></a>
<div class="header-phone">{lng[Call Us]} {$config['Company']['company_phone']}</div>
<a href="{$mobile_link}" class="full-version">Full version</a>
<div id="minicart">
{$minicart}
</div>

<div class="mobile-menu">
<a href="javascript: mobile_menu_open();" class="mobile_menu_opener"><img src="/images/mobile/mobile_menu.png" alt="" /></a>
<form method="POST" action="/search" id="searchform">
<div class="homepage-search mobile-search search">
<input type="text" name="substring" value="{if $substring}{$substring}{/if}" placeholder="Search here..." autocomplete="off" />
<input type="image" src="{$current_location}/images/mobile/search_mobile.png"/>
<div class="instant-search"></div>
</div>
</form>
</div>
</div>
</div>