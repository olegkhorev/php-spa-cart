<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<?php } ?>

<h1>Register</h1>
<center>
<table class="login_table">
<tr>
 <td valign="top">
<form name="register" method="POST" action="/<?php if ($get['0'] == 'register') {?>register<?php } else  { ?>profile<?php } ?>">
    <div class="group">
      <input class="firstname" maxlength="32" required type="text" name="firstname" value="<?php echo escape($userinfo['firstname'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>First name</label>
    </div>

    <div class="group">
      <input maxlength="32" type="text" required name="lastname" value="<?php echo escape($userinfo['lastname'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Last name</label>
    </div>

    <div class="group">
      <input type="text" name="email" required value="<?php echo escape($userinfo['email'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Email</label>
    </div>
<div class="register-email-error">Sorry this email address is already a registered user <a href="/login" onclick="return login_popup();" class="ajax_mobile_link login-link">Login</a></div>

    <div class="group">
      <input type="password" required name="password" value="" autocomplete="off" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Password</label>
    </div>

<?php if ($memberships) {?>
<?php $name="pending_membershipid"; $value = 0;; ?>
    <div class="group group-select">
 <label>Sign up for membership:</label>
<?php include SITE_ROOT."/var/cache/en/common/membership.php";?>
    </div>
<?php } ?>

<?php if ($config['General']['recaptcha_key']) {?>
<div id="recaptcha_register" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div>
<?php } ?>

<div align="center"><button type="button">Register</button> &nbsp; <a href="/login" onclick="return login_popup();" class="ajax_mobile_link main-button login-link">Login</a></div>

<?php /* ?>
<table class="login-table">
<tr>
 <td class="name">Fisrtname:</td>
 <td><input class="firstname" maxlength="32" type="text" name="firstname" value="<?php echo escape($userinfo['firstname'], 2);; ?>" /></td>
</tr>
<tr>
 <td class="name">Lastname:</td>
 <td><input maxlength="32" type="text" name="lastname" value="<?php echo escape($userinfo['lastname'], 2);; ?>" /></td>
</tr>
<tr>
 <td class="name">Email:</td>
 <td><input type="text" name="email" value="<?php echo escape($userinfo['email'], 2);; ?>" /></td>
</tr>
<tr>
 <td class="name">Password:</td>
 <td><input type="password" name="password" value="" autocomplete="off" /></td>
</tr>
<?php if ($memberships) {?>
<?php $name="pending_membershipid"; $value = 0;; ?>
<tr>
 <td class="name">Sign up for membership:</td>
 <td><?php include SITE_ROOT."/var/cache/en/common/membership.php";?></td>
</tr>
<?php } ?>
<tr>
 <td></td>
 <td><br /><button type="button">Register</button> &nbsp; <a href="/login" onclick="javascript: return login_popup();" class="main-button login-link">Login</a></td>
</tr>
</table>
<?php */ ?>
</form>
 </td>
</tr>
</table>

</center>