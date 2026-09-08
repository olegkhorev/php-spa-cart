<style>
table td {
	vertical-align: middle;
}
</style>
<h3>Поиск отзывов <b class="translate"><span class="hidden word">Search for reviews</span><span class="hidden translate-phrase">Поиск отзывов</span>(Edit)</b></h3>
<form method="POST" href="/admin/reviews?mode=search">
<input type="hidden" name="mode" value="search">
<table width="100%" align="center" cellpadding="2" cellspacing="1">
        <tr>
                <td align="right">Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></td>
                <td><select name="status">
                        <option value="0">На рассмотрении <b class="translate"><span class="hidden word">Pending</span><span class="hidden translate-phrase">На рассмотрении</span>(Edit)</b></option>
                        <option<?php if ($search_data['status'] == "1") {?> selected<?php } ?> value="1">Одобрено <b class="translate"><span class="hidden word">Approved</span><span class="hidden translate-phrase">Одобрено</span>(Edit)</b></option>
                        <option<?php if ($search_data['status'] == "2") {?> selected<?php } ?> value="2">Отклонено <b class="translate"><span class="hidden word">Declined</span><span class="hidden translate-phrase">Отклонено</span>(Edit)</b></option>
                        <option<?php if ($search_data['status'] == "" && $search_data) {?> selected<?php } ?> value="">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
                        </select>
                </td>
        <tr>
                <td width="170" align="right">IP-адрес <b class="translate"><span class="hidden word">IP Address</span><span class="hidden translate-phrase">IP-адрес</span>(Edit)</b></td>
                <td><input type="text" size="32" name="remote_ip" value="<?php echo $search_data['remote_ip'];?>"></td>
        </tr>
        <tr>
                <td align="right">Имя <b class="translate"><span class="hidden word">Name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></td>
                <td><input type="text" size="32" name="name" value="<?php echo $search_data['name'];?>"></td>
        </tr>
        <tr>
                <td align="right">Сообщение <b class="translate"><span class="hidden word">Message</span><span class="hidden translate-phrase">Сообщение</span>(Edit)</b></td>
                <td><input type="text" size=80 name="message" value="<?php echo $search_data['message'];?>"></td>
        </tr>
        <tr>
                <td align="right">ID товара <b class="translate"><span class="hidden word">Product ID</span><span class="hidden translate-phrase">ID товара</span>(Edit)</b></td>
                <td><input type="text" size="32" name="productid" value="<?php echo $search_data['productid'];?>"></td>
        </tr>
        <tr>
                <td align="right">SKU <b class="translate"><span class="hidden word">SKU</span><span class="hidden translate-phrase">SKU</span>(Edit)</b></td>
                <td><input type="text" size="32" name="sku" value="<?php echo $search_data['sku'];?>"></td>
        </tr>
        <tr>
                <td align="right">Рейтинг <b class="translate"><span class="hidden word">Rating</span><span class="hidden translate-phrase">Рейтинг</span>(Edit)</b></td>
                <td>
                                <select name="rating">
                                <option value="">Все <b class="translate"><span class="hidden word">All</span><span class="hidden translate-phrase">Все</span>(Edit)</b></option>
                                <option value="5"<?php if ($search_data['rating'] == "5") {?> selected<?php } ?>>5</option>
                                <option value="4"<?php if ($search_data['rating'] == "4") {?> selected<?php } ?>>4</option>
                                <option value="3"<?php if ($search_data['rating'] == "3") {?> selected<?php } ?>>3</option>
                                <option value="2"<?php if ($search_data['rating'] == "2") {?> selected<?php } ?>>2</option>
                                <option value="1"<?php if ($search_data['rating'] == "1") {?> selected<?php } ?>>1</option>
                                </select>
                </td>
        </tr>
        <tr>
                <td></td>
                <td><button>Поиск <b class="translate"><span class="hidden word">Search</span><span class="hidden translate-phrase">Поиск</span>(Edit)</b></button></td>
        </tr>
</table>
</form>

<?php if ($reviews) {?>
        <br />
<h3>Search results</h3>

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<br />
<?php } ?>

<form action="/admin/reviews" method="post" name="reviewsform">
        <input type="hidden" name="mode" value="edit">
<a href="javascript: void(0);" onclick="javascript: check_all(document.reviewsform, 'to_delete', true);">Отметить все <b class="translate"><span class="hidden word">Check all</span><span class="hidden translate-phrase">Отметить все</span>(Edit)</b></a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.reviewsform, 'to_delete', false);">Отменить выбор для всех <b class="translate"><span class="hidden word">Uncheck all</span><span class="hidden translate-phrase">Отменить выбор для всех</span>(Edit)</b></a>
        <table border="0" cellpadding="5" cellspacing="0" class="lines-table">
                <tr>
                        <th></th>
                        <th>Статус <b class="translate"><span class="hidden word">Status</span><span class="hidden translate-phrase">Статус</span>(Edit)</b></th>
                        <th>Рейтинг <b class="translate"><span class="hidden word">Rating</span><span class="hidden translate-phrase">Рейтинг</span>(Edit)</b></th>
                        <th>IP <b class="translate"><span class="hidden word">IP</span><span class="hidden translate-phrase">IP</span>(Edit)</b></th>
                        <th>Имя <b class="translate"><span class="hidden word">Name</span><span class="hidden translate-phrase">Имя</span>(Edit)</b></th>
                        <th>Сообщение <b class="translate"><span class="hidden word">Message</span><span class="hidden translate-phrase">Сообщение</span>(Edit)</b></th>
                        <th nowrap>ID товара/SKU <b class="translate"><span class="hidden word">Product ID/SKU</span><span class="hidden translate-phrase">ID товара/SKU</span>(Edit)</b></th>
                </tr>
<?php foreach ($reviews as $r) {?>
                <tr>
                        <td valign="top" width="5%"><input type="checkbox" name="to_delete[<?php echo $r['id'];?>]" value="<?php echo $r['id'];?>"></td>
                        <td valign="top" width="5%">
                                <select name="to_update[<?php echo $r['id'];?>][status]">
                                <option value="0" >На рассмотрении <b class="translate"><span class="hidden word">Pending</span><span class="hidden translate-phrase">На рассмотрении</span>(Edit)</b></option>
                                <option value="1" <?php if ($r['status'] == "1") {?>selected<?php } ?>>Одобрено <b class="translate"><span class="hidden word">Approved</span><span class="hidden translate-phrase">Одобрено</span>(Edit)</b></option>
                                <option value="2" <?php if ($r['status'] == "2") {?>selected<?php } ?>>Отклонено <b class="translate"><span class="hidden word">Declined</span><span class="hidden translate-phrase">Отклонено</span>(Edit)</b></option>
                                </select>
                        </td>
                        <td valign="top" width="5%">
                                <select name="to_update[<?php echo $r['id'];?>][rating]">
                                <option value="5"<?php if ($r['rating'] == "5") {?> selected<?php } ?>>5</option>
                                <option value="4"<?php if ($r['rating'] == "4") {?> selected<?php } ?>>4</option>
                                <option value="3"<?php if ($r['rating'] == "3") {?> selected<?php } ?>>3</option>
                                <option value="2"<?php if ($r['rating'] == "2") {?> selected<?php } ?>>2</option>
                                <option value="1"<?php if ($r['rating'] == "1") {?> selected<?php } ?>>1</option>
                                </select>
                        </td>
                        <td valign="top" width="15%"><?php echo $r['remote_ip'];?></td>
                        <td valign="top" width="15%"><?php echo $r['name'];?></td>
                        <td valign="top" width="45%"><textarea cols="40" rows="3" name="to_update[<?php echo $r['id'];?>][message]"><?php echo $r['message'];?></textarea></td>
                        <td valign="top" width="10%"><a href="/admin/products/<?php echo $r['productid'];?>" target="_blank"><?php echo $r['productid'];?>/<?php echo $r['sku'];?></a></td>
                </tr>
<?php } ?>
                <tr>
                        <td colspan="9"><br />
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(document.reviewsform, 'update');">Обновить <b class="translate"><span class="hidden word">Update</span><span class="hidden translate-phrase">Обновить</span>(Edit)</b></button>
<button type="button" onclick="javascript: if (confirmed || confirm('В результате этой операции выбранные отзывы будут удалены. <b class="translate"><span class="hidden word">This operation will delete selected reviews.</span><span class="hidden translate-phrase">В результате этой операции выбранные отзывы будут удалены.</span>(Edit)</b>', $(this))) submitForm(this, 'delete');">Удалить выбранные <b class="translate"><span class="hidden word">Delete selected</span><span class="hidden translate-phrase">Удалить выбранные</span>(Edit)</b></button>
</div>
                        </td>
                </tr>
        </table>
        </form>

<?php if ($total_pages > 2) {?>
<?php include SITE_ROOT."/var/cache/ru/common/navigation.php";?>
<br />
<?php } ?>
<?php } ?>