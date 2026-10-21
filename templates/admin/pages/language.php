<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{$language_data['name']}</h1>
<br />

{if $translate_mode}
<a href="/admin/language?exit_translate_mode=1" class="mdl-button">Exit the "Translate" mode</a>
{else}
<a href="/admin/language?translate_mode=1" class="mdl-button">Enter the "Translate" mode</a>
{/if}
&nbsp; (Make sure you do it in Development mode - see settings.php)
<br /><br />
<form method="post" enctype="multipart/form-data" name="fpform" class="noajax">
<table style="width:500px" class="language-edit-table">
<tr>
 <td colspan="2"><h3>{lng[Export language labels]}</h3></td>
</tr>

<tr>
  <td style="width:100%"></td>
  <td>
  <button type="button" onclick="self.location='/admin/language/{$get[2]}?mode=export';">{lng[Export]}</button>
  </td>
</tr>

</table>

<table style="width:500px" class="language-edit-table">

<tr>
 <td colspan="2"><h3>{lng[Import language labels]}</h3></td>
</tr>

<tr>
  <td style="width:100%"><input type="file" name="file" /></td>
  <td>
  <button type="submit">{lng[Import]}</button>
  </td>
</tr>
</table>
</form>