<div class="padding-page">
<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<?php } ?>
<h1>Contact us</h1>
<br />
<form method="POST" name="help" id="help_form" onsubmit="javascript: if(!document.help.subject.value || !document.help.message.value || !document.help.email.value) { $('#error_mes').show(); return false; } else  $('#error_mes').hide();">
<input type="hidden" name="mode" value="send">

    <div class="group">
      <input type="text" name="email" required value="<?php echo escape($userinfo['email'], 2);; ?>" onkeyup="javascript: if(this.value) $('#error_mes').hide();">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Your E-mail</label>
    </div>

    <div class="group">
      <input type="text" name="subject" required onkeyup="javascript: if(this.value) $('#error_mes').hide();">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Subject</label>
    </div>

    <div class="group">
      <textarea name="message" required class="help-message" onkeyup="javascript: if(this.value) $('#error_mes').hide();"></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Message</label>
    </div>

<div id="error_mes">Please, enter your E-mail, subject and message.</div>
<?php if ($config['General']['recaptcha_key']) {?>
<div id="recaptcha_contact" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div><br />
<?php } ?>

<button type="button" class="submit_help">Send</button>
</form>
</div>
<br>