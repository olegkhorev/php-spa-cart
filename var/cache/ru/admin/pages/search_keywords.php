Search keywords are helpful if you have specific products to display, so user came directly to your search page from google.<br /><br />
Don't forget to generate Google sitemap to include search keywords and then submit it once again where it is needed. Google parse sitemap automatically.
<br /><br />
<form method="post" enctype="multipart/form-data" name="fpform"<?php /* ?> class="noajax"<?php */ ?>>

<table cellpadding="3" cellspacing="1">

<tr>
 <td colspan="2"><h3>Импортировать ключевые слова для поиска <b class="translate"><span class="hidden word">Import search keywords</span><span class="hidden translate-phrase">Импортировать ключевые слова для поиска</span>(Edit)</b></td>
</tr>

<tr>
  <td width="100"><input type="file" name="file" /></td>
  <td>
  <button type="submit">Импорт <b class="translate"><span class="hidden word">Import</span><span class="hidden translate-phrase">Импорт</span>(Edit)</b></button>
  </td>
</tr>

</table>
</form>
<br />
<h3>What is in database already</h3>
<?php 
if ($search_keywords) {
	foreach ($search_keywords as $v)
		echo $v.'<br />';

} else  {
	echo 'No keywords';
}
?>