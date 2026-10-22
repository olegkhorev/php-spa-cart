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
func_load('modules');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    if ($mode == 'update') {
        if (DEMO)
            return false;

        foreach ($to_update as $k => $v) {
            $to_update = array(
                'pos' => $v['pos'],
                'enabled' => (!empty($v['enabled']) ? 1 : 0)
            );

            $db->array2update("modules", $to_update, "moduleid='".addslashes($k)."'");
        }

        $_SESSION['alerts'][] = array(
            'content'	=> lng('Modules updated')
        );
    } elseif ($_FILES['install_archive']['tmp_name']) {
        echo 'Installing module...<br />';
        if (DEMO)
            exit('You cannot install a new module on demo.');

        $dir = SITE_ROOT . '/var/tmp/install_module';
        mkdir($dir);
        copy($_FILES['install_archive']['tmp_name'], $dir.'/module.zip');
        $zip = new ZipArchive();
        $zip->open($dir.'/module.zip');
        $zip->extractTo($dir);
        $zip->close();

        echo 'Gathering the module data...<br />';
        $data = array_map('trim', file($dir.'/module.data'));
        $array = [];
        foreach ($data as $v) {
            $tmp = explode(':', $v);
            $array[$tmp[0]] = $tmp[1];
        }

        echo 'Checking if module is already installed...<br />';
        $exits = $db->field("SELECT moduleid FROM modules WHERE code='".addslashes($array['code'])."'");
        if ($exits) {
            exit('<b>Module already exists.</b>');
        }

        echo 'Creating the module directory...<br />';
        $dir_module = SITE_ROOT . '/images/modules/'.$array['author'].'/'.$array['module'];
        mkdir($dir_module, 0755, true);
        $file = $dir.'/logo.png';
        copy($file, $dir_module.'/'.basename($file));

        echo 'Copying function...<br />';
        $dir_module = SITE_ROOT . '/includes/func';
        $file = $dir.'/func.'.$array['code'].'.php';
        copy($file, $dir_module.'/'.basename($file));

        echo 'Copying scripts...<br />';
        $dir_module = SITE_ROOT . '/modules/'.$array['author'].'/'.$array['module'];
        mkdir($dir_module, 0755, true);
        foreach (glob($dir.'/pages/*') as $file) {
            copy($file, $dir_module.'/'.basename($file));
        }

        echo 'Copying templates...<br />';
        $dir_module = SITE_ROOT . '/templates/modules/'.$array['author'].'/'.$array['module'];
        mkdir($dir_module, 0755, true);
        foreach (glob($dir.'/templates/*') as $file) {
            copy($file, $dir_module.'/'.basename($file));
        }

        echo 'Copying images...<br />';
        $dir_module = SITE_ROOT . '/images/themes/'.$array['author'].'/'.$array['module'];
        mkdir($dir_module, 0755, true);
        foreach (glob($dir.'/themes/images/*') as $file) {
            copy($file, $dir_module.'/'.basename($file));
        }

        echo 'Copying theme files(if any)...<br />';
        $dir_module = SITE_ROOT . '/templates/themes/'.$array['author'].'/'.$array['module'];
        mkdir($dir_module, 0755, true);
        foreach (glob($dir.'/themes/templates/*') as $file) {
            if (is_dir($file)) {
                func_copy_folder($file, $dir_module.'/'.basename($file));
            } else {
                copy($file, $dir_module.'/'.basename($file));
            }
        }

        echo 'Inserting database record...<br />';
        $to_insert = [
            'code'		=> $array['code'],
            'author'	=> $array['author'],
            'module'	=> $array['module'],
            'comment'	=> $array['comment'],
            'template'	=> $array['template'],
            'pos'		=> $db->field("SELECT MAX(pos) FROM modules") + 10
        ];

        $db->array2insert('modules', $to_insert);
        func_delete_directory(SITE_ROOT . '/var/tmp/install_module');
        exit('<br /><b>Congratulations. The module has been successfully installed.</b><br /><hr /><br /><a href="'.$current_location.'/admin/modules">Go to modules</a>');
    }

    redirect("admin/modules");
}

if ($get['2'] == 'install') {
    $template['location'] .= ' &gt; <a href="'.$current_location.'/admin/modules">'.lng('Modules').'</a> &gt; '.lng('Install new module');
} else {
    $template['location'] .= ' &gt; '.lng('Modules');
    $total_items = $db->field("SELECT COUNT(*) FROM modules ORDER BY pos");
    if ($total_items > 0) {
        $objects_per_page = 20;
        require SITE_ROOT."/includes/navigation.php";
        $template["navigation_script"] = $current_location."/admin/modules";
        $modules = $db->all("SELECT * FROM modules ORDER BY pos LIMIT $first_page, $objects_per_page");
        $template["modules"] = $modules;
    }
}

$template['head_title'] = lng('Modules').' :: '.$template['head_title'];

$template['page'] = get_template_contents('admin/pages/modules.php');
