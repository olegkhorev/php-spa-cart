<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php } ?>
<h1>Contact us</h1>
<br />
<form method="POST" name="help" onsubmit="javascript: if(!document.help.subject.value || !document.help.message.value || !document.help.email.value) { $('#error_mes').show(); return false; } else  $('#error_mes').hide();">
<input type="hidden" name="mode" value="">

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
      <textarea name="message" required style="width: 350px; height: 100px;" onkeyup="javascript: if(this.value) $('#error_mes').hide();"></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Message</label>
    </div>

<div id="error_mes">Please, enter your E-mail, subject and message.</div>
<?php if ($config['General']['recaptcha_key']) {?>
<div class="g-recaptcha" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div><br />
<?php } ?>

<button>Send</button>
<?php /* ?>
<table class="create help_create">
<tr>
 <td align="right">Your E-mail:</td>
 <td><input type="text" name="email" style="width: 350px;" value="<?php echo escape($userinfo['email'], 2);; ?>" onkeyup="javascript: if(this.value) $('#error_mes').hide();"></td>
</tr>

<tr>
 <td align="right">Subject:</td>
 <td><input type="text" name="subject" style="width: 350px;" onkeyup="javascript: if(this.value) $('#error_mes').hide();"></td>
</tr>

<tr>
 <td valign="top" align="right">Message:</td>
 <td><textarea name="message" style="width: 350px; height: 100px;" onkeyup="javascript: if(this.value) $('#error_mes').hide();"></textarea></td>
</tr>

<tbody id="error_mes">
<tr>
 <td></td>
 <td>Please, enter your E-mail, subject and message.</td>
</tr>
</tbody>
<?php if ($config['General']['recaptcha_key']) {?>
<tr>
 <td colspan="2"><div class="g-recaptcha" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div></td>
</tr>
<?php } ?>
<tr>
 <td></td>
 <td><button>Send</button></td>
</tr>
</table>
<?php */ ?>
</form>
<div class="similar">
</div>
<br>