<?php  echo $category_location; ?>

<br /><br />

<a href="/admin/category/<?php  echo $category['categoryid']; ?>">Изменить категорию <b class="translate"><span class="hidden word">Modify category</span><span class="hidden translate-phrase">Изменить категорию</span>(Edit)</b></a>

<br /><br />

<form action="/admin/category/<?php  echo $category['categoryid']; ?>" method="post">
<input type="hidden" name="mode" value="category_products" />

<?php 
if (!isset($_GET['direction']) || $_GET['direction'])
	$direction = "&direction=0";
else 
	$direction = "&direction=1";
?>

<h3>Товары категории <b class="translate"><span class="hidden word">Category products</span><span class="hidden translate-phrase">Товары категории</span>(Edit)</b></h3>
<?php 
if ($products) {
?>

<table width="100%" class="lines-table">
<tr>
 <th>SKU <b class="translate"><span class="hidden word">SKU</span><span class="hidden translate-phrase">SKU</span>(Edit)</b></th>
 <th>Название товара <b class="translate"><span class="hidden word">Product name</span><span class="hidden translate-phrase">Название товара</span>(Edit)</b></th>
 <th>Позиция <b class="translate"><span class="hidden word">Position</span><span class="hidden translate-phrase">Позиция</span>(Edit)</b></th>
</tr>
<?php 
	foreach ($products as $v) {
		echo '
<tr>
 <td nowrap><a href="/admin/products/'.$v['productid'].'">'.$v['sku'].'</a></td>
 <td><a href="/admin/products/'.$v['productid'].'">'.$v['name'].'</a></td>
 <td><input type="text" size="10" name="posted_data['.$v['productid'].'][orderby]" value="'.$v['orderby'].'"></td>
</tr>
		';
	}
?>
</table>
<br />
<button>Сохранить <b class="translate"><span class="hidden word">Save</span><span class="hidden translate-phrase">Сохранить</span>(Edit)</b></button>
</form>
<?php 
} else  {?>
<center>Нет товаров в этой категории <b class="translate"><span class="hidden word">No products in this category</span><span class="hidden translate-phrase">Нет товаров в этой категории</span>(Edit)</b></center>
<?php }
?>
