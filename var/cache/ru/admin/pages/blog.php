<?php 
if ($blogs) {
?>
<a href="<?php echo $current_location;?>/admin/blog/new">Добавить новое <b class="translate"><span class="hidden word">Add new</span><span class="hidden translate-phrase">Добавить новое</span>(Edit)</b></a>
<br /><br />
<form method="post" name="blogsform">
<input type="hidden" name="mode" value="update" />

<?php 
if ($total_pages > 2) {
?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<?php 
	echo '<br />';
}
?>

<a href="javascript: void(0);" onclick="javascript: check_all(document.blogsform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.blogsform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>

<table cellpadding="3" cellspacing="1" width="600" class="lines-table">
<tr>
	<th width="10">&nbsp;</th>
	<th width="60%">Заголовок <b class="translate"><span class="hidden word">Title</span><span class="hidden translate-phrase">Заголовок</span>(Edit)</b></th>
	<th width="5%">Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></th>
	<th width="35%">Комментарии <b class="translate"><span class="hidden word">Comments</span><span class="hidden translate-phrase">Комментарии</span>(Edit)</b></th>
</tr>

<?php 
foreach ($blogs as $b) {
	echo '<tr>
	<td><input type="checkbox" name="to_delete['.$b['blogid'].']" value="Y" /></td>
	<td><a href="'.$current_location.'/admin/blog/'.$b['blogid'].'">'.$b['title'].'</a></td>
	<td><input type="checkbox" name="to_update['.$b['blogid'].'][active]" value="Y"'.($b['active'] == 'Y' ? ' checked="checked"' : '').' /></td>
	<td align="center"><a href="'.$current_location.'/admin/blog/'.$b['blogid'].'">'.$b['comments']."</a></td>
</tr>";
}
?>
</table>
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(this, 'update');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button> &nbsp;
<button type="button" onclick="javascript: if (confirmed || confirm('Эта операция удалит выбранные блоги со всеми сообщениями. <b class="translate"><span class="hidden word">This operation will delete selected blogs with all messages.</span><span class="hidden translate-phrase">Эта операция удалит выбранные блоги со всеми сообщениями.</span>(Edit)</b>', $(this))) submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
</form>

<h3>Авторы <b class="translate"><span class="hidden word">Authors</span><span class="hidden translate-phrase">Авторы</span>(Edit)</b></h3>
<?php 
	foreach ($authors as $id=>$v)
		echo '<a href="'.$current_location.'/admin/blog/?author='.$id.'">'.$v['1'].'('.$v['0'].')</a><br />';
} else  {
?>
<script src="<?php echo $current_location;?>/ckeditor/ckeditor.js"></script>
<form method="post" name="blogform" enctype="multipart/form-data">

<?php if ($get['2'] == 'new') {?>
<h3>Новый блог <b class="translate"><span class="hidden word">New blog</span><span class="hidden translate-phrase">Новый блог</span>(Edit)</b></h3>
<?php } else  { ?>
<h3><?php echo $blog['title'];?></h3>
<?php } ?>

<table cellpadding="3" cellspacing="1" width="90%" class="normal-table">
<?php 
if ($blog['date']) {
?>
<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Автор <b class="translate"><span class="hidden word">Author</span><span class="hidden translate-phrase">Автор</span>(Edit)</b></div>
<a href="<?php  echo $current_location.'/admin/user/'.$blog['author']; ?>"><?php  echo $blog['firstname'].' '.$blog['lastname']; ?></a></td>
</tr>
<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Добавлено <b class="translate"><span class="hidden word">Added</span><span class="hidden translate-phrase">Добавлено</span>(Edit)</b></div>
<?php  echo date($date_format, $blog['date']); ?></td>
</tr>
<?php 
}
?>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Изображение <b class="translate"><span class="hidden word">Image</span><span class="hidden translate-phrase">Изображение</span>(Edit)</b></div>
<?php 
if ($blog['image']) {
	$image = $blog['image'];
	$image['new_width'] = 400;
	$image['new_height'] = 100;
	$image['link'] = 'Y';
	$image['blank'] = 'Y';
	include SITE_ROOT . '/includes/blog_image.php';
?>
<br />
 <a href="<?php  echo $current_location.'/admin/blog/'.$blog['blogid'].'/?mode=delete_image'; ?>">Удалить изображение <b class="translate"><span class="hidden word">Delete image</span><span class="hidden translate-phrase">Удалить изображение</span>(Edit)</b></a><br />
<?php 
}
?>
<input type="file" name="userfile" />
 </td>
</tr>

<tr>
 <td><b>Заголовок <b class="translate"><span class="hidden word">Title</span><span class="hidden translate-phrase">Заголовок</span>(Edit)</b></b></td>
 <td><input type="text" name="title" size="40" value="<?php  echo escape($blog['title'], 2); ?>" onchange="javascript: if (this.form.cleanurl.value == '') copy_clean_url(this, this.form.cleanurl);" /></td>
</tr>

<tr>
 <td><b>Чистый URL <b class="translate"><span class="hidden word">Clean URL</span><span class="hidden translate-phrase">Чистый URL</span>(Edit)</b></b></td>
 <td><input type="text" name="cleanurl" size="40" value="<?php  echo escape($blog['cleanurl'], 2); ?>" /></td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Краткое описание <b class="translate"><span class="hidden word">Short description</span><span class="hidden translate-phrase">Краткое описание</span>(Edit)</b></div>
		<textarea class="ckeditor" id="ck_editor" cols="65" rows="7" name="descr"><?php  echo $blog['descr']; ?></textarea>
 </td>
</tr>

<tr>
 <td valign="top" class="hide-td-for-mdl"></td>
 <td><div class="select-title">Подробное описание <b class="translate"><span class="hidden word">Detailed description</span><span class="hidden translate-phrase">Подробное описание</span>(Edit)</b></div>
	<script>
		var editor;
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		    $('*').removeAttr("title");
		});
	</script>
		<textarea class="ckeditor" id="ck_editor_2" cols="65" rows="7" name="fulldescr"><?php  echo $blog['fulldescr']; ?></textarea>
 </td>
</tr>

<tr>
 <td valign="top"><b>Мета-тег title <b class="translate"><span class="hidden word">Meta title</span><span class="hidden translate-phrase">Мета-тег title</span>(Edit)</b></b></td>
 <td><input type="text" size="80" name="meta_title" value="<?php  echo $blog['meta_title']; ?>" /></td>
</tr>

<tr>
 <td valign="top"><b>Мета-тег keywords <b class="translate"><span class="hidden word">Meta keywords</span><span class="hidden translate-phrase">Мета-тег keywords</span>(Edit)</b></b></td>
 <td><textarea cols="80" rows="5" name="meta_keywords"><?php  echo $blog['meta_keywords']; ?></textarea></td>
</tr>

<tr>
 <td valign="top"><b>Мета-описание <b class="translate"><span class="hidden word">Meta description</span><span class="hidden translate-phrase">Мета-описание</span>(Edit)</b></b></td>
 <td><textarea cols="80" rows="5" name="meta_descr"><?php  echo $blog['meta_descr']; ?></textarea></td>
</tr>

<tr>
 <td><b>Активна <b class="translate"><span class="hidden word">Active</span><span class="hidden translate-phrase">Активна</span>(Edit)</b></b></td>
 <td><input type="checkbox" name="active" value="Y"<?php  echo ((!$blog || $blog['active'] == 'Y') ? ' checked="checked"' : ''); ?> /></td>
</tr>

</table>
<div class="fixed_save_button">
<button type="submit"><?php  if ($get['2'] == 'new') { ?>Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b><?php  } else  { ?>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b><?php  } ?></button>
</div>
<?php 
if ($blog) {
?>
<br />
<h3>Комментарии в блоге <b class="translate"><span class="hidden word">Blog comments</span><span class="hidden translate-phrase">Комментарии в блоге</span>(Edit)</b></h3>

<?php 
if ($comments) {
?>

<input type="hidden" name="commentid" value="" />

<?php include SITE_ROOT."/var/cache/ru/admin/common/navigation.php";?>

<table cellpadding="3" cellspacing="1" width="100%">
<?php 
	foreach ($comments as $i) {
		echo '<tr>
  <td>
<div class="float-right">
<a href="javascript: void(0);" onclick="javascript: if (confirm(\'Удалить этот комментарий? <b class="translate"><span class="hidden word">Delete this comment?</span><span class="hidden translate-phrase">Удалить этот комментарий?</span>(Edit)</b>\', \'\', \''.$current_location.'/admin/blog/'.$get['2'].'/?deleteid='.$i['commentid'].'\'));">Удалить <b class="translate"><span class="hidden word">Delete</span><span class="hidden translate-phrase">Удалить</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: edit_comment(\''.$i['commentid'].'\');">Редактировать <b class="translate"><span class="hidden word">Edit</span><span class="hidden translate-phrase">Редактировать</span>(Edit)</b></a> / ';
	if ($i['active'] == "Y")
		echo '<a class="color-red" href="'.$current_location.'/admin/blog/'.$get['2'].'/?declineid='.$i['commentid'].'">Отклонить <b class="translate"><span class="hidden word">Decline</span><span class="hidden translate-phrase">Отклонить</span>(Edit)</b></a>';
	else 
		echo '<a class="blog-color-2" href="'.$current_location.'/admin/blog/'.$get['2'].'/?approveid='.$i['commentid'].'">Утвердить <b class="translate"><span class="hidden word">Approve</span><span class="hidden translate-phrase">Утвердить</span>(Edit)</b></a>';
	echo '&nbsp;&nbsp;
</div>
<div class="blog-comment">
<div class="float-right">
'.date($datetime_format, $i['date']).' / '.$i['ip'].'
&nbsp;
</div>
&nbsp;'.($i['name'] != '' ? $i['name'] : '<a href="'.$current_location.'/admin/user/'.$i['userid'].'">'.$i['firstname'].' '.$i['lastname'].'</a>').'
</div>
<span id="comment_'.$i['commentid'].'" class="hidden">'.$i['message'].'</span>
'.$i['bb_message'].'
  </td>
</tr>';
	}

	echo '</table>';
} else  {
?>
<br /><center>В блоге пока нет комментариев  <b class="translate"><span class="hidden word">No blog comments yet</span><span class="hidden translate-phrase">В блоге пока нет комментариев </span>(Edit)</b></center>
<?php 
}
?>

<br /><br />
<h3>Добавлять новые/редактировать <b class="translate"><span class="hidden word">Add new/edit</span><span class="hidden translate-phrase">Добавлять новые/редактировать</span>(Edit)</b></h3>
<a onmouseover="javascript: bbhelp('b');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[b]','[/b]');"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/b.png" tabindex="-1"></a>
<a onmouseover="javascript: bbhelp('i');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[i]','[/i]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/i.png" tabindex="-2"></a>
<a onmouseover="javascript: bbhelp('u');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[u]','[/u]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/u.png" tabindex="-3"></a>
<a onmouseover="javascript: bbhelp('s');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[s]','[/s]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/s.png" tabindex="-3"></a>
<a onmouseover="javascript: bbhelp('url');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[url]','[/url]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/url.png" tabindex="-4"></a>
<a onmouseover="javascript: bbhelp('email');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[email]','[/email]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/email.png" tabindex="-5"></a>
<a onmouseover="javascript: bbhelp('img');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[img]','[/img]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/img.png" tabindex="-6"></a>
<a onmouseover="javascript: bbhelp('list');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[list][*]','[/*][/list]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/list.png" tabindex="-7"></a>
<a onmouseover="javascript: bbhelp('li');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[*]','[/*]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/li.png" tabindex="-8"></a>
<a onmouseover="javascript: bbhelp('quote');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[quote]','[/quote]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/quote.png" tabindex="-9"></a>
<a onmouseover="javascript: bbhelp('code');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[code]','[/code]')"><img alt="" src="<?php  echo $current_location.'/images'; ?>/bbcodes/code.png" tabindex="-10"></a>

&nbsp;
<input size="40" id="helptext" readonly>
<br />

<textarea name="comment" cols="80" rows="15"></textarea>
<br /><br />
<button type="submit" name="btn">Добавить <b class="translate"><span class="hidden word">Add</span><span class="hidden translate-phrase">Добавить</span>(Edit)</b></button>
<br /><br />

<?php 
}
?>

</form>

<script>
function edit_comment(id) {
	var text = document.getElementById('comment_'+id).innerHTML;
	document.blogform.btn.value="Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b>";
	document.blogform.commentid.value = id;

	text = str_replace("&gt;", ">", text);
	text = str_replace("&lt;", "<", text);

	document.blogform.comment.value = text;
}
</script>
<?php 
}
?>