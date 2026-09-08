<center>
<form name="register" method="POST">
<div class="regsec">
<input class="name firstname<?php  if ($user['firstname']) echo ' def'; ?>" maxlength="32" type="text" name="firstname" value="<?php  if ($user['firstname']) echo $user['firstname']; else  {?>First name<?php } ?>" />
<input class="name<?php  if ($user['lastname']) echo ' def'; ?>" maxlength="32" type="text" name="lastname" value="<?php  if ($user['lastname']) echo $user['lastname']; else  {?>Last name<?php } ?>" />
<br />
<input type="text"<?php  if ($user['email']) echo ' class="def"'; ?> name="email" value="<?php  if ($user['email']) echo $user['email']; else  {?>Email<?php } ?>" />
<br />
<input type="<?php  if ($get['0'] == 'register') echo 'text'; else  echo 'password';?>" name="password" placeholder="Password" autocomplete="off" />
<br />
<input type="text"<?php  if ($user['address']) echo ' class="def"'; ?> name="address" value="<?php  if ($user['address']) echo $user['address']; else  {?>Address<?php } ?>" />
<br />
<input type="text"<?php  if ($user['city']) echo ' class="def"'; ?> name="city" value="<?php  if ($user['city']) echo $user['city']; else  {?>City<?php } ?>" />
<br />
<input type="text"<?php  if ($user['zipcode']) echo ' class="def"'; ?> name="zipcode" value="<?php  if ($user['zipcode']) echo $user['zipcode']; else  {?>Zip/Postal code<?php } ?>" />
<br />
<input type="text"<?php  if ($user['phone']) echo ' class="def"'; ?> name="phone" value="<?php  if ($user['phone']) echo $user['phone']; else  {?>Phone<?php } ?>" />
<br /><br />
<button type="button" class="big">Save</button>
</div>
</form>