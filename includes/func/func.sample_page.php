<?php
function func_module_admin_post_update($data) {
    global $db, $_SESSION;
    extract($data);

	$_SESSION['alerts'][] = array(
		'type'		=> 'i',
		'content'	=> 'Form has been successfully submitted'
	);

    return 'test';
}

function func_module_admin_post_insert($data) {
    global $db;
    extract($data);

    return 'test';
}

function init_module_admin_before() {
}

function init_module_admin_after() {
    global $db, $template;
    $template['location'] .= ' &gt; Manage form';
}