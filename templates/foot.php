<div class="foot">
{*
 <a href="{if $config['Tickets']['use_tickets']}/support_desk{else}/help{/if}">{lng[Contact us]}</a> &nbsp; <a href="/page/about.html">{lng[About]}</a> &nbsp; <a href="/page/terms-n-conditions.html">{lng[Terms & Conditions]}</a>
 <span>Copyright &copy;{if $config['Company']['start_year'] && $config['Company']['start_year'] != date('Y')}{$config['Company']['start_year']} - {/if}{php echo date('Y');}. Developed by <a href="http://upwork.com/fl/ecommerce" class="no-ajax" target="_blank">Oleg Khorev</a></span>
*}
 <ul class="foot-ul-1">
  <li>{lng[Get in touch with us]}</li>
  <li>{lng[Phone]}: {$config['Company']['company_phone']}</li>
{if $config['Company']['company_phone_2']}
  <li>{lng[Phone #2]}: {$config['Company']['company_phone_2']}</li>
{/if}
{if $config['Company']['company_fax']}
  <li>{lng[Fax]}: {$config['Company']['company_fax']}</li>
{/if}
  <li><a href="{if $config['Tickets']['use_tickets']}/support_desk{else}/help{/if}">{lng[Email us]}</a></li>
 </ul>
 <ul class="foot-ul-2">
  <li>{lng[Quick links]}</li>
  <li><a href="/">{lng[Home page]}</a></li>
  <li><a href="/brands">{lng[Brands]}</a></li>
  <li><a href="/news">{lng[News]}</a></li>
  <li><a href="/blog">{lng[Blog]}</a></li>
  <li><a href="/testimonials">{lng[Testimonials]}</a></li>
 </ul>

{if $categories_top_menu}
 <ul class="foot-ul-3">
  <li>{lng[Categories]}</li>
 {foreach $categories_top_menu as $k=>$v}
 <li><a class="ajax_link" href="{$current_location}/{if $v['cleanurl']}{$v['cleanurl']}{else}{$v['categoryid']}{/if}">{$v['title']}</a></li>
 {/foreach}
 </ul>
{/if}
<img src="/images/logo_new_foot.png" alt="" class="foot-logo" />
<div class="social-icons"><img src="/images/social.png" alt="" /></div>

<div class="clear"></div>
<hr />
 <img src="/images/payment_methods.png" class="foot-pm" alt="{lng[Payment methods]}" />
<span class="copyright">&copy; {if $config['Company']['start_year'] && $config['Company']['start_year'] != date('Y')}{$config['Company']['start_year']} - {/if}{php echo date('Y');}. Developed by <a href="http://upwork.com/fl/ecommerce" class="no-ajax" target="_blank">Oleg Khorev</a></span>
</div>