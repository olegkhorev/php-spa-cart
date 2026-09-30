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
$module = $db->row("SELECT * FROM modules WHERE code='".$get['2']."'");
if (!file_exists(SITE_ROOT . '/includes/func/func.'.$module['code'].'.php')) {
	$_SESSION['alerts'][] = array(
		'type'		=> 'e',
		'content'	=> lng('This module does not have functions file')
	);

	redirect('admin');
}

func_load($module['code']);
init_module_admin_before();
$template["module"] = $module;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$mode = $_POST['mode'];
	if ($mode == 'update') {
		$redirect_url = func_module_admin_post_update($_POST);
	} elseif ($mode == 'insert') {
		$redirect_url = func_module_admin_post_insert($_POST);
	}

	redirect('admin/module_manage/'.$get['2'].($redirect_url ? '/'.$redirect_url : ''));
}

$template['location'] .= ' &gt; <a href="'.$current_location.'/admin/module_manage/'.$module['code'].'">'.$module['module'].'</a>';
init_module_admin_after();
$template['head_title'] = $module['module'].' :: '.$template['head_title'];
$template['page'] = get_template_contents('modules/'.$module['author'].'/'.$module['module'].'/admin.php');