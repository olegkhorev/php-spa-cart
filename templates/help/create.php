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
{if $config['General']['recaptcha_key']}
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
{/if}
<h1>{lng[Contact us]}</h1>
<br />
<form method="POST" name="help" id="help_form" class="ajax-form">
<input type="hidden" name="mode" value="send">

    <div class="group">
      <input type="text" name="email" required value="{if $saved_contact}{php echo escape($saved_contact['subject'], 2);}{else}{php echo escape($userinfo['email'], 2);}{/if}" onkeyup="javascript: if(this.value) $('#error_mes').hide();" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Your E-mail]}</label>
    </div>

    <div class="group">
      <input type="text" name="subject" required onkeyup="javascript: if(this.value) $('#error_mes').hide();"{if $saved_contact} value="{php echo escape($saved_contact['subject'], 2);}"{/if} />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Subject]}</label>
    </div>

    <div class="group">
      <textarea name="message" required class="help-message" onkeyup="javascript: if(this.value) $('#error_mes').hide();">{if $saved_contact}{$saved_contact['message']}{/if}</textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Message]}</label>
    </div>

<div id="error_mes">{lng[Please, enter your E-mail, subject and message.]}</div>
{if $config['General']['recaptcha_key']}
<br />
<div id="recaptcha_contact" data-sitekey="{$config['General']['recaptcha_key']}"></div><br />
{/if}

<button type="button" class="submit_help">{lng[Send]}</button>
</form>
</div>