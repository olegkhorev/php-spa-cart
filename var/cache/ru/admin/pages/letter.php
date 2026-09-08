Общее количество подписчиков <b class="translate"><span class="hidden word">Total subscribers</span><span class="hidden translate-phrase">Общее количество подписчиков</span>(Edit)</b>: <?php  echo $subscribers ? $subscribers : '0';?> <a href="/admin/subscribtions/export">Экспорт <b class="translate"><span class="hidden word">Export</span><span class="hidden translate-phrase">Экспорт</span>(Edit)</b></a>
<br /><br />
<script src="<?php  echo $current_location; ?>/ckeditor/ckeditor.js"></script>
<form method="post" name="letterform" enctype="multipart/form-data">
<input type="hidden" name="mode" value="save" />
<input type="hidden" name="id" value="<?php  echo $letter['id']; ?>" />

<?php if (($get['3'] == 'new')) {?>
<h3>Новое письмо <b class="translate"><span class="hidden word">New letter</span><span class="hidden translate-phrase">Новое письмо</span>(Edit)</b></h3>
<?php } else  { ?>
<h3><?php echo $letter['subject'];?></h3>
<?php } ?>

<table cellpadding="3" cellspacing="1" width="90%">
<?php 
if ($letter['date']) {
?>
<tr>
 <td><b>Добавлено <b class="translate"><span class="hidden word">Added</span><span class="hidden translate-phrase">Добавлено</span>(Edit)</b>:</b></td>
 <td><?php  echo date($datetime_format, $letter['date']); ?></td>
</tr>
<?php 
}
?>

<tr>
 <td><b>Тема <b class="translate"><span class="hidden word">Subject</span><span class="hidden translate-phrase">Тема</span>(Edit)</b>:</b></td>
 <td><input type="text" name="subject" size="40" value="<?php  echo escape($letter['subject'], 2); ?>" /></td>
</tr>

<tr>
 <td valign="top"><b>Сообщение <b class="translate"><span class="hidden word">Message</span><span class="hidden translate-phrase">Сообщение</span>(Edit)</b>:</b></td>
 <td>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="message"><?php  echo $letter['message']; ?></textarea>
<br /><br />
 </td>
</tr>

<tr>
 <td></td>
 <td>
<div class="fixed_save_button">
 <button type="submit">Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button> &nbsp; <button type="button" onclick="javascript: if (confirmed || confirm('', $(this))) submitForm(this, 'send');">Отправить <b class="translate"><span class="hidden word">Send</span><span class="hidden translate-phrase">Отправить</span>(Edit)</b></button>
</div>
</td>
</tr>

<tr>
 <td colspan="2"><h3>Тестовое сообщение <b class="translate"><span class="hidden word">Test email</span><span class="hidden translate-phrase">Тестовое сообщение</span>(Edit)</b></h3></td>
 <td></td>
</tr>

<tr>
 <td valign="top"><b>Адрес электронной почты #1 <b class="translate"><span class="hidden word">Email address #1</span><span class="hidden translate-phrase">Адрес электронной почты #1</span>(Edit)</b>:</b></td>
 <td><input type="text" name="email1" value="<?php  echo $company_email; ?>" /></td>
</tr>

<tr>
 <td valign="top"><b>Адрес электронной почты #2 <b class="translate"><span class="hidden word">Email address #2</span><span class="hidden translate-phrase">Адрес электронной почты #2</span>(Edit)</b>:</b></td>
 <td><input type="text" name="email2" /></td>
</tr>

<tr>
 <td valign="top"><b>Адрес электронной почты #3 <b class="translate"><span class="hidden word">Email address #3</span><span class="hidden translate-phrase">Адрес электронной почты #3</span>(Edit)</b>:</b></td>
 <td><input type="text" name="email3" /></td>
</tr>

<tr>
 <td></td>
 <td>
<button type="button" onclick="javascript: submitForm(this, 'test');">Тест <b class="translate"><span class="hidden word">Test</span><span class="hidden translate-phrase">Тест</span>(Edit)</b></button>
</td>
</tr>

</table>
</form>