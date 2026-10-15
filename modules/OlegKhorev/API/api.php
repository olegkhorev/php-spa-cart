<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $array = [
        'mode'  => $_POST['mode'],
        'sku'   => $_POST['sku'],
        'price' => $_POST['price'],
        'date'  => time()
    ];

    $fp = fopen(SITE_ROOT . '/var/tmp/api_module_logs.txt', 'a+');
    fputs($fp, json_encode($array)."\n");
    fclose($fp);
    exit("Record added");
}

$template_dir = 'modules/'.$module['author'].'/'.$module['module'].'/';

$template['head_title'] = lng('API').'. '.$template['head_title'];
$template['page'] = get_template_contents($template_dir.$get['2'].'.php');