<?php
if ($login) {
	if ($is_ajax)
		exit(lng('You are already logged in. Please, refresh the page'));

	redirect('/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	extract($_POST);
	$user = $db->row("SELECT * FROM users WHERE email='".addslashes($email)."' AND status=1");
	if (!$user && $is_ajax)
		exit('E');

	if (md5($password.$user['salt']) != $user['password'])
		$user = array();

	if ($user) {
		func_login($user['id']);
		if ($is_ajax)
			exit('G');

		redirect($_SERVER['HTTP_REFERER'], 1);
	} else {
		if ($is_ajax)
			exit('P');

		$_SESSION['alerts'][] = array(
			'type'		=> 'e',
			'content'	=> lng('login_incorrect')
		);
		redirect('/login');
	}
}

if ($is_ajax && !$_GET['its_ajax_page']) {
	exit(get_template_contents('login/body.php'));
} else {
	$template['page'] = get_template_contents('login/body.php');
	$template['is_login_page'] = true;
}