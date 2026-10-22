<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Set your password</h1><br />
<form method="POST" name="cpform">
 <div class="logsec cpsec">
 <div class="group">
  <input type="password" required name="new_pswd" value="" />
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>New password</label>
 </div>

 <div class="group">
  <input type="password" required name="con_pswd" />
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>Confirm password</label>
 </div>

<div class="er">Passwords mismatch</div>
<br />
<button type="button">Change</button>
</div>
</form>