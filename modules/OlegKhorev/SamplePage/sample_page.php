<?php
$template_dir = 'modules/'.$module['author'].'/'.$module['module'].'/';
$template['head_title'] = lng('Sample page').'. '.$template['head_title'];
$template['page'] = get_template_contents($template_dir.$get['2'].'.php');