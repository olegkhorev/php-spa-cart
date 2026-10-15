<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $config['General']['recaptcha_key']}
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
{/if}

<form method="POST" onsubmit="javascript: return check_new_testimonial();" name="testimonialform" class="ajax-form">
<h1>{lng[Write testimonial]}</h1>
<br />
 <div class="group">
  <input id="testimonial_name" type="text" size="32" name="name" value="<?php echo escape(
      $preentered["name"],
      2,
  ); ?>" />
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>{lng[Name]}</label>
 </div>

 <div class="group">
  <input type="text" size="32" name="url" value="<?php echo escape(
      $preentered["url"],
      2,
  ); ?>" />
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>{lng[URL]}</label>
 </div>

 <div class="group">
  <textarea id="testimonial_message" name="message" cols="40" rows="10">{$preentered['message']}</textarea>
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>{lng[Testimonial]}</label>
 </div>

{if $config['General']['recaptcha_key']}
<br />
<div id="recaptcha_contact" data-sitekey="{$config['General']['recaptcha_key']}"></div><br />
{/if}
<br />
<button>{lng[Add testimonial]}</button>
</form>
