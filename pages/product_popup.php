<?php
q_load('product');
$product = func_select_product($get['1']);
if (!$product)
	redirect('/');

$db->query("UPDATE products SET views_stats='".($product['views_stats'] + 1)."' WHERE productid='$product[productid]'");
$template['photos'] = $db->all("SELECT * FROM products_photos WHERE productid=".$get['1']." ORDER BY pos, photoid DESC");
$template['product'] = $product;

exit(get_template_contents('common/popup_product.php'));
