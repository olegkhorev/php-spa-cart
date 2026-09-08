<?php
redirect('/admin/user/'.$login);
q_load('user');
if ($get['2'])
	$user_id = $get['2'];
else
	$user_id = $login;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	extract($_POST);
	$update = array(
		'firstname'		=> mb_substr($firstname, 0, 32, 'utf-8'),
		'lastname'		=> mb_substr($lastname, 0, 32, 'utf-8'),
		'address'		=> $address,
		'city'			=> $city,
		'zipcode'		=> $zipcode,
		'phone'			=> $phone
	);

	if (!empty($password) && $password != lng('Password')) {
		$salt = generateSalt();
		$update['salt'] = $salt;
		$update['password'] = md5($password.$salt);
	}

	if ($db->field("SELECT COUNT(*) as cnt FROM users WHERE id<>'".$user_id."' AND email='".addslashes($email)."'"))
		$_SESSION['alerts'][] = array(
			'type'		=> 'e',
			'content'	=> 'This email already registered'
		);
	else {
		$update['email'] = $email;
		$_SESSION['alerts'][] = array(
			'type'		=> 'i',
			'content'	=> 'Changes has been successfully made'
		);
	}

	$db->array2update('users', $update, "id='".$user_id."'");

	redirect('/admin/profile');
}

$template['section'] = $get['1'];

$template['user'] = $db->row("SELECT * FROM users WHERE id='".$user_id."'");

$template['head_title'] = 'Profile :: '.$template['head_title'];
$template['page_profile'] = 'Y';
$template['location'] .= ' &gt; '.lng('Profile');
$template['page'] = get_template_contents('admin/pages/profile.php');
$template['css'][] = 'register';
$template['js'][] = 'register';
