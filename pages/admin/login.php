<?php
if ($login && $userinfo['usertype'] == 'A') {
	redirect('/admin');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	extract($_POST);
	if ($_SESSION['token'] != $token) {
		$_SESSION['alerts'][] = array(
			'type'		=> 'e',
			'content'	=> lng('Invalid form token. Please, try once again.')
		);

		redirect('/admin/login');
	}

	$user = $db->row("SELECT * FROM users WHERE email='".addslashes($email)."' AND status=1");
	if (md5($password.$user['salt']) != $user['password'])
		$user = array();

	if ($user) {
		func_login($user['id']);
		if ($login_redirect)
			redirect($login_redirect);
		else
			redirect('/admin');
	} else {
		$_SESSION['alerts'][] = array(
			'type'		=> 'e',
			'content'	=> lng('login_incorrect')
		);
		redirect('/admin');
	}
}

$template['js'][] = 'admin_login';
$template['css'][] = 'admin_login';
$template['token'] = $_SESSION['token'] = md5(time().rand(0,10000));
$template['page'] = get_template_contents('admin/pages/login.php');