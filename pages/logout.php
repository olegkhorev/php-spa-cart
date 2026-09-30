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
$_SESSION['login'] = $_SESSION['userinfo'] = '';
func_setcookie('remember', '');
redirect($_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '/', 1);