<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<div class="admin-location">
{if $login && $userinfo['usertype'] == 'A'}
{$location}
{/if}
</div>
<hr />
{if $alerts}
 <div class="alerts admin-alerts"><span class="close-alerts"><b>X</b> Close</span>
 {php $already = array();}
 {foreach $alerts as $v}
	 {if !in_array($v['content'], $already)}
  {if $v['type'] == 'e'}<div class="error">{if $lng == 'en'}{lng[Error]}{/if}: {$v['content']}</div>{else}{$v['content']}<br>{/if}<br>
		{php $already[] = $v['content'];}
		{/if}
	{/foreach}
 </div>
{/if}
<br />
{$page}
<div class="clear"></div>