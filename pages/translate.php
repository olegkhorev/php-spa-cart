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
if (!$login || $userinfo['usertype'] != 'A' || !$translate_mode)
	redirect('/');

$_GET['lbl'] = str_replace('&amp;', '&', $_GET['lbl']);
$db->query("UPDATE languages SET translation='".addslashes($_GET['translate'])."' WHERE lng='".$lng."' AND word='".addslashes($_GET['lbl'])."'");
exit;
