<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_FILES['file']) {
		copy($_FILES['file']['tmp_name'], SITE_ROOT.'/search_keywords.txt');
	}

	$_SESSION['alerts'][] = array(
		'type'		=> 'i',
		'content'	=> lng('Successful')
	);

	redirect('/admin/search_keywords');
}

$template['location'] .= ' &gt; '.lng('Search keywords');
$template['head_title'] = lng('Search keywords').' :: '.$template['head_title'];

$search_keywords = file(SITE_ROOT.'/search_keywords.txt');

$template['search_keywords'] = $search_keywords;

$template['page'] = get_template_contents('admin/pages/search_keywords.php');
