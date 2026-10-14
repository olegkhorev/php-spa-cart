<?php
function func_config_module($module_code) {
    global $db;

    $config_module = $db->all("SELECT * FROM config WHERE module_code='api' ORDER BY orderby");
    if ($config_module) {
        foreach ($config_module as $k => $v) {
            if ($v['type'] == 'selector') {
                $tmp = explode("\n", $v['variants']);
                $tmp2 = array();
                $found = false;
                foreach ($tmp as $l) {
                    if (strstr($l, ':')) {
                        $found = true;
                    }

                    if ($found) {
                        $tmp3 = explode(':', $l);
                        if ($tmp3['1']) {
                            $tmp2[] = array($tmp3[0], $tmp3[1]);
                        }
                    } else {
                        $tmp2[] = array($l, $l);
                    }
                }

                $config_module[$k]['variants'] = $tmp2;
            }
        }
    }

    return $config_module;
}

function func_config_module_save($module_code, $data) {
    global $config, $db, $_SESSION;

    foreach ($config[$module_code] as $k => $v) {
        if (!$data[$k]) {
            $data[$k] = '';
        }
    }

    if ($posted_data['state']) {
        if ($get['2'] == 'Company' && $posted_data['state']) {
            $data['location_state'] = $posted_data['state'];
        } elseif ($posted_data['state']) {
            $data['default_state'] = $posted_data['state'];
        }
    }

    foreach ($data as $k => $v) {
        if (is_array($v)) {
            continue;
        }

        $db->query("UPDATE config SET value='".addslashes($v)."' WHERE name='".addslashes($k)."'");
    }

    $_SESSION['alerts'][] = array(
        'type'		=> 'i',
        'content'	=> 'Module settings have been successfully saved'
    );
}