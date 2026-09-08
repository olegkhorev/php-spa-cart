<div class="foot">
<?php /* ?>
 <a href="<?php if ($config['Tickets']['use_tickets']) {?>/support_desk<?php } else  { ?>/help<?php } ?>">Contact us</a> &nbsp; <a href="/page/about.html">About</a> &nbsp; <a href="/page/terms-n-conditions.html">Terms & Conditions</a>
 <span>Copyright &copy;<?php if ($config['Company']['start_year'] && $config['Company']['start_year'] != date('Y')) {?><?php echo $config['Company']['start_year'];?> - <?php } ?><?php echo date('Y');; ?>. Developed by <a href="http://upwork.com/fl/ecommerce" class="no-ajax" target="_blank">Oleg Khorev</a></span>
<?php */ ?>
 <ul class="foot-ul-1">
  <li>Get in touch with us</li>
  <li>Phone: <?php echo $config['Company']['company_phone'];?></li>
<?php if ($config['Company']['company_phone_2']) {?>
  <li>Phone #2: <?php echo $config['Company']['company_phone_2'];?></li>
<?php } ?>
<?php if ($config['Company']['company_fax']) {?>
  <li>Fax: <?php echo $config['Company']['company_fax'];?></li>
<?php } ?>
  <li><a href="<?php if ($config['Tickets']['use_tickets']) {?>/support_desk<?php } else  { ?>/help<?php } ?>">Email us</a></li>
 </ul>
 <ul class="foot-ul-2">
  <li>Quick links</li>
  <li><a href="/">Home page</a></li>
  <li><a href="/brands">Brands</a></li>
  <li><a href="/news">News</a></li>
  <li><a href="/blog">Blog</a></li>
  <li><a href="/testimonials">Testimonials</a></li>
 </ul>

<?php if ($categories_top_menu) {?>
 <ul class="foot-ul-3">
  <li>Categories</li>
 <?php foreach ($categories_top_menu as $k=>$v) {?>
 <li><a class="ajax_link" href="<?php echo $current_location;?>/<?php if ($v['cleanurl']) {?><?php echo $v['cleanurl'];?><?php } else  { ?><?php echo $v['categoryid'];?><?php } ?>"><?php echo $v['title'];?></a></li>
 <?php } ?>
 </ul>
<?php } ?>
<img src="/images/logo_new_foot.png" alt="" class="foot-logo" />
<div class="social-icons"><img src="/images/social.png" alt="" /></div>

<div class="clear"></div>
<hr />
 <img src="/images/payment_methods.png" class="foot-pm" alt="Payment methods" />
<span class="copyright">&copy; <?php if ($config['Company']['start_year'] && $config['Company']['start_year'] != date('Y')) {?><?php echo $config['Company']['start_year'];?> - <?php } ?><?php echo date('Y');; ?>. Developed by <a href="http://upwork.com/fl/ecommerce" class="no-ajax" target="_blank">Oleg Khorev</a></span>
</div>