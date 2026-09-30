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
if ($get['1'] == 'force_theme' && $get['2'] != 'default') {
	$module = $db->row("SELECT * FROM modules WHERE code='".$get['2']."'");
	$_SESSION['current_theme'] = $module;
	redirect('');
} elseif ($get['1'] == 'force_theme') {
	$_SESSION['current_theme'] = [];
	redirect('');
} else {
	$module = $db->row("SELECT * FROM modules WHERE code='".$get['1']."' AND enabled='1'");
}

if (!$module)
	redirect('/');

$template['module'] = $module;

$module_dir = SITE_ROOT . '/modules/'.$module['author'].'/'.$module['module'].'/';
$script = $module_dir.$get['2'].'.php';
if (file_exists($script))
	include $script;
else
	redirect('/');