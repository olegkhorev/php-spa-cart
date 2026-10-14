<?php
function func_module_admin_post_update($data)
{
    global $db, $_SESSION;

    func_config_module_save('api', $data);

    return '';
}

function func_module_admin_post_insert($data)
{
    global $db;

    extract($data);

    return '';
}

function init_module_admin_before()
{
    global $db, $template, $config_moduleig;

    $config_module = func_config_module('api');
    $template['config_module'] = $config_module;
}

function init_module_admin_after()
{
    global $db, $template;
    $template['location'] .= ' &gt; Manage form';

    $result = [];
    $logs = file(SITE_ROOT . '/var/tmp/api_module_logs.txt');
    foreach ($logs as $line) {
        $tmp = json_decode($line, true);
        $result[] = $tmp;
    }

    krsort($result);
    $template['api_requests_logs'] = $result;
}