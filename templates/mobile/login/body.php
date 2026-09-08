<h1>{lng[Login]}</h1>
<br />
<table class="login_table">
<tr>
 <td valign="top">
<form name="login" method="POST" action="/login">

    <div class="group">
      <input class="email" required type="text" name="email" value="{if $_POST['email']}{php echo escape($_POST['email'], 2);}{/if}" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Email]}</label>
    </div>
    <div class="group">
      <input type="password" required name="password" value="" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>{lng[Password]}</label>
    </div>

<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">{lng[Login]}</button> &nbsp; <a href="/register" class="main-button register">{lng[Register]}</a>

<br /><br />
<a href="javascript: void(0);" class="main-button" onclick="return restore_password()">{lng[Password recovery]}</a>
{*
<table class="login-table">
<tr>
 <td class="name">{lng[Email]}:</td>
 <td><input class="email" type="text" name="email" value="{if $_POST['email']}{php echo escape($_POST['email'], 2);}{/if}" />
</tr>
<tr>
 <td class="name">{lng[Password]}:</td>
 <td><input type="password" name="password" value="" /></td>
</tr>

<tr>
 <td class="name"></td>
 <td><br /><button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">{lng[Login]}</button> &nbsp; <a href="/register" class="register">{lng[Register]}</a></td>
</tr>

<tr>
 <td></td>
 <td><br /><a href="#" onclick="return restore_password()">{lng[Password recovery]}</a></td>
</tr>
</table>
*}
</form>
 </td>
</tr>
</table>