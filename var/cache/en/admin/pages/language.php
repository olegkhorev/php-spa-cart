<?php if ($translate_mode) {?>
<a href="/admin/language?exit_translate_mode=1" class="mdl-button">Exit "Translate" mode</a>
<?php } else  { ?>
<a href="/admin/language?translate_mode=1" class="mdl-button">Enter "Translate" mode</a>
<?php } ?>
&nbsp; (Make sure you do it in Development mode - see settings.php)
<br /><br />
<form method="post" enctype="multipart/form-data" name="fpform" class="noajax">
<table width="800">
<tr>
 <td width="50%">
<table width="400" cellpadding="3" cellspacing="1">
<tr>
 <td colspan="2"><h3>Export language labels</td>
</tr>

<tr>
  <td width="100%"></td>
  <td>
  <button type="button" onclick="self.location='/admin/language/<?php echo $get[2];?>?mode=export';">Export</button>
  </td>
</tr>

</table>
 </td>
 <td>
<table width="400" cellpadding="3" cellspacing="1">

<tr>
 <td colspan="2"><h3>Import language labels</td>
</tr>

<tr>
  <td width="100%"><input type="file" name="file" /></td>
  <td>
  <button type="submit">Import</button>
  </td>
</tr>
</table>
 </td>
</tr>
</table>
</form>