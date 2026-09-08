<h1>Login</h1>
<table class="login_table">
<tr>
 <td valign="top">
<form name="login" method="POST" action="/login">

    <div class="group">
      <input class="email" required type="text" name="email" value="<?php if ($_POST['email']) {?><?php echo escape($_POST['email'], 2);; ?><?php } ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Email</label>
    </div>
<div class="register-email-error">Sorry this email address is not a registered user <a href="/register" onclick="return register_popup();" class="register ajax_mobile_link">Create new user</a></div>
    <div class="group">
      <input type="password" required name="password" value="" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Password</label>
    </div>
<div class="register-email-error-2">Sorry password is incorrect. <a href="javascript: void(0);" onclick="return restore_password()">Recover password</a></div>

<button type="button">Login</button> &nbsp; <a href="/register" onclick="return register_popup();" class="main-button register ajax_mobile_link">Register</a>
<br /><br />
<a href="javascript: void(0);" class="main-button nowrap" onclick="return restore_password()">Password recovery</a></td>
</form>
 </td>
</tr>
</table>