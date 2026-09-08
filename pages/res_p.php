<?php
if (isset($_GET['e'])) {
	$user = $db->row("SELECT firstname, lastname FROM users WHERE email='".addslashes($_GET['e'])."'");
	if ($user)
		echo $user['firstname'].' '.$user['lastname'].' <button>'.lng('Restore').'</button>';

	exit;
}

if (isset($_GET['r'])) {
	$email = addslashes($_GET['r']);
	$user = $db->row("SELECT id, firstname, lastname FROM users WHERE email='".$email."'");
	if ($user) {
		$salt = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCD!@#^&&*%*($)*@#($%*#%)-=.,;\'][EFGHIJKLMNOPQRSTUVWXYZ0123456789' ), 0, 8);
		$key = md5($salt.$id.$_SERVER['REMOTE_ADDR'].$salt.time().rand(0,100).$salt);
		$db->query("UPDATE users SET password_key='".$key."' WHERE id=".$user['id']);
		$subject = lng('Your password');
		$template['user'] = $user;
		$template['key'] = $key;
		$message = get_template_contents('mail/restore_password.php');
		func_mail($user['firstname'].' '.$user['lastname'], $email, '', $subject, $message);
	}

	exit;
}