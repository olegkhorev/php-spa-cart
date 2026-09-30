<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Set your password]}</h1><br />
<form method="POST" name="cpform">
<div class="logsec cpsec">
<input type="text" name="new_pswd" value="{lng[New password|escape]}" /><br /><br />
<input type="text" name="con_pswd" value="{lng[Confirm password|escape]}" /><br />
<div class="er">{lng[Passwords mismatch]}</div>
<br />
<button type="button">{lng[Change]}</button>
</div>
</form>