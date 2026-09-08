<div class="drag">
<center><div class="pbar"><img src="/images/spacer.gif" /></div></center>
<form name="upload" method="POST" enctype='multipart/form-data' class="noajax">
<input type="hidden" name="albumid" value="<?php  echo $album['albumid']; ?>" />
<div class="upsec">
<div class="fileButton">
Перетащите сюда файлы для загрузки.<br><br>или выберите <b class="translate"><span class="hidden word">Drop files here to upload.<br><br>Or click to select</span><span class="hidden translate-phrase">Перетащите сюда файлы для загрузки.<br><br>или выберите</span>(Edit)</b>
<input type="file" name="file" multiple accept="image/*" />
</div>
</div>
</form>
</div>
<div class="product-images">
<?php 
if ($photos) {
	foreach ($photos as $v) {		echo '<div data-id="'.$v['photoid'].'"><img src="/images/close.gif" class="remove" alt="" />';		$image = $v;		$image['new_width'] = 100;
		$image['new_height'] = 100;
		$image['center'] = 1;
		$image['is_admin'] = 1;

		include 'includes/image.php';
		echo '</div>';
	}
}
?>


<?php /* ?>
<form method="POST" enctype='multipart/form-data'>
<input type="hidden" name="section" value="images">
<table width="800">
<?php 
if ($photos) {
?>
<tr>
 <td class="name">Фотографии <b class="translate"><span class="hidden word">Photos</span><span class="hidden translate-phrase">Фотографии</span>(Edit)</b></td>
 <td class="value">
<table>
<tr>
 <th>Удалить <b class="translate"><span class="hidden word">Delete</span><span class="hidden translate-phrase">Удалить</span>(Edit)</b></th>
 <th>Фото <b class="translate"><span class="hidden word">Photo</span><span class="hidden translate-phrase">Фото</span>(Edit)</b></th>
 <th>Позиция <b class="translate"><span class="hidden word">Position</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
</tr>
<?php 
foreach ($photos as $v) {
	echo '
<tr>
 <td><input type="checkbox" name="to_delete_photos['.$v['photoid'].']"></td>
 <td><a href="/photos/product/'.$product['productid'].'/'.$v['photoid'].'/'.$v['file'].'" target="_blank"><img src="/photos/product/'.$product['productid'].'/'.$v['photoid'].'/'.$v['file'].'" height="100"></a></td>
 <td><input size="5" type="text" name="update_photos['.$v['photoid'].']" value="'.$v['pos'].'"></td>
</tr>
	';
}
?>
</table>
 </td>
</tr>
<?php 
}
?>
<tr>
 <td class="name">Загрузить новое <b class="translate"><span class="hidden word">Upload new</span><span class="hidden translate-phrase">Загрузить новое</span>(Edit)</b></td>
 <td>
<input type="file" name="file1"><br>
<input type="file" name="file2"><br>
<input type="file" name="file3"><br>
<input type="file" name="file4"><br>
<input type="file" name="file5">
 </td>
</tr>
<tr>
 <td colspan="2"><br><button>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button></td>
</tr>
</table>
</form>
<?php */ ?>