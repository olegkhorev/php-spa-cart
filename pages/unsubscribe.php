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
$db->query("DELETE FROM subscribers WHERE email='".addslashes($get['1'])."'");
$_SESSION['alerts'][] = array(
	'type'	=> 'i',
	'content'	=> lng('You have been unsubscribed')
);

redirect('/');