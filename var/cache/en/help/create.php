<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<div class="padding-page">
<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<?php } ?>
<h1>Contact us</h1>
<br />
<form method="POST" name="help" id="help_form" class="ajax-form">
<input type="hidden" name="mode" value="send">

    <div class="group">
      <input type="text" name="email" required value="<?php if ($saved_contact) {?><?php echo escape($saved_contact['subject'], 2);; ?><?php } else  { ?><?php echo escape($userinfo['email'], 2);; ?><?php } ?>" onkeyup="javascript: if(this.value) $('#error_mes').hide();" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Your E-mail</label>
    </div>

    <div class="group">
      <input type="text" name="subject" required onkeyup="javascript: if(this.value) $('#error_mes').hide();"<?php if ($saved_contact) {?> value="<?php echo escape($saved_contact['subject'], 2);; ?>"<?php } ?> />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Subject</label>
    </div>

    <div class="group">
      <textarea name="message" required class="help-message" onkeyup="javascript: if(this.value) $('#error_mes').hide();"><?php if ($saved_contact) {?><?php echo $saved_contact['message'];?><?php } ?></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Message</label>
    </div>

<div id="error_mes">Please, enter your E-mail, subject and message.</div>
<?php if ($config['General']['recaptcha_key']) {?>
<br />
<div id="recaptcha_contact" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div><br />
<?php } ?>

<button type="button" class="submit_help">Send</button>
</form>
</div>