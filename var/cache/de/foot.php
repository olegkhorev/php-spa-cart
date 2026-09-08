<div class="foot">
<?php /* ?>
 <a href="<?php if ($config['Tickets']['use_tickets']) {?>/support_desk<?php } else  { ?>/help<?php } ?>">Kontaktieren Sie uns</a> &nbsp; <a href="/page/about.html">Über</a> &nbsp; <a href="/page/terms-n-conditions.html">Bedingungen & Bedingungen</a>
 <span>Copyright &copy;<?php if ($config['Company']['start_year'] && $config['Company']['start_year'] != date('Y')) {?><?php echo $config['Company']['start_year'];?> - <?php } ?><?php echo date('Y');; ?>. Developed by <a href="http://upwork.com/fl/ecommerce" class="no-ajax" target="_blank">Oleg Khorev</a></span>
<?php */ ?>
 <ul class="foot-ul-1">
  <li>Holen Sie sich mit uns in Verbindung</li>
  <li>Telefon: <?php echo $config['Company']['company_phone'];?></li>
<?php if ($config['Company']['company_phone_2']) {?>
  <li>Telefon #2: <?php echo $config['Company']['company_phone_2'];?></li>
<?php } ?>
<?php if ($config['Company']['company_fax']) {?>
  <li>Fax: <?php echo $config['Company']['company_fax'];?></li>
<?php } ?>
  <li><a href="<?php if ($config['Tickets']['use_tickets']) {?>/support_desk<?php } else  { ?>/help<?php } ?>">E-Mail uns</a></li>
 </ul>
 <ul class="foot-ul-2">
  <li>Quick-links</li>
  <li><a href="/">Startseite</a></li>
  <li><a href="/brands">Marken</a></li>
  <li><a href="/news">News</a></li>
  <li><a href="/blog">Blog</a></li>
  <li><a href="/testimonials">Erfahrungsberichte</a></li>
 </ul>

<?php if ($categories_top_menu) {?>
 <ul class="foot-ul-3">
  <li>Kategorien</li>
 <?php foreach ($categories_top_menu as $k=>$v) {?>
 <li><a class="ajax_link" href="<?php echo $current_location;?>/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?><?php } else  { ?><?php echo $v['categoryid'];?><?php } ?>"><?php echo $v['title'];?></a></li>
 <?php } ?>
 </ul>
<?php } ?>
<img src="/images/logo_new_foot.png" alt="" class="foot-logo" />
<div class="social-icons"><img src="/images/social.png" alt="" /></div>

<div class="clear"></div>
<hr />
 <img src="/images/payment_methods.png" class="foot-pm" alt="Zahlungsmethoden" />
<span class="copyright">&copy; <?php if ($config['Company']['start_year'] && $config['Company']['start_year'] != date('Y')) {?><?php echo $config['Company']['start_year'];?> - <?php } ?><?php echo date('Y');; ?>. Developed by <a href="http://upwork.com/fl/ecommerce" class="no-ajax" target="_blank">Oleg Khorev</a></span>
</div>