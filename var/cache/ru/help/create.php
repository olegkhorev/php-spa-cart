<div class="padding-page">
<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<?php } ?>
<h1>Свяжитесь с нами <b class="translate"><span class="hidden word">Contact us</span><span class="hidden translate-phrase">Свяжитесь с нами</span>(Edit)</b></h1>
<br />
<form method="POST" name="help" id="help_form" onsubmit="javascript: if(!document.help.subject.value || !document.help.message.value || !document.help.email.value) { $('#error_mes').show(); return false; } else  $('#error_mes').hide();">
<input type="hidden" name="mode" value="send">

    <div class="group">
      <input type="text" name="email" required value="<?php echo escape($userinfo['email'], 2);; ?>" onkeyup="javascript: if(this.value) $('#error_mes').hide();">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Ваш E-mail <b class="translate"><span class="hidden word">Your E-mail</span><span class="hidden translate-phrase">Ваш E-mail</span>(Edit)</b></label>
    </div>

    <div class="group">
      <input type="text" name="subject" required onkeyup="javascript: if(this.value) $('#error_mes').hide();">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Тема <b class="translate"><span class="hidden word">Subject</span><span class="hidden translate-phrase">Тема</span>(Edit)</b></label>
    </div>

    <div class="group">
      <textarea name="message" required class="help-message" onkeyup="javascript: if(this.value) $('#error_mes').hide();"></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Сообщение <b class="translate"><span class="hidden word">Message</span><span class="hidden translate-phrase">Сообщение</span>(Edit)</b></label>
    </div>

<div id="error_mes">Пожалуйста, введите ваш E-mail, тему и сообщение. <b class="translate"><span class="hidden word">Please, enter your E-mail, subject and message.</span><span class="hidden translate-phrase">Пожалуйста, введите ваш E-mail, тему и сообщение.</span>(Edit)</b></div>
<?php if ($config['General']['recaptcha_key']) {?>
<div id="recaptcha_contact" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div><br />
<?php } ?>

<button type="button" class="submit_help">Отправить <b class="translate"><span class="hidden word">Send</span><span class="hidden translate-phrase">Отправить</span>(Edit)</b></button>
</form>
</div>
<br>