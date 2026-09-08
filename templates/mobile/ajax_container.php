<div class="page-container">
{if $alerts}
 <div class="alerts"><span onclick="javascript: $('.alerts').slideUp();"><b>X</b></span>
 {foreach $alerts as $v}
  {if $v['type'] == 'e'}<div class="error">Error: {$v['content']}</div>{else}{$v['content']}<br>{/if}<br>
 {/foreach}
 </div>
{/if}

<div class="content">
<div id="bread_crumbs_container">{$bread_crumbs_html}</div>
<div id="center"{if true || $no_left_menu == 'Y'} class="no_left_menu"{/if}>
{$page}
</div>
 </div>

<div class="clear"></div>
</div>