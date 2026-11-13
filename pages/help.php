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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rc_key = $config['General']['recaptcha_key'];
    $rc_skey = $config['General']['recaptcha_skey'];
    if ($rc_key && $rc_skey) {
/*
        $result = false;
	    if ($_POST['g-recaptcha-response']) {
        	$ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                'secret'	=> $rc_skey,
                'response'	=> $_POST['g-recaptcha-response'],
                'remoteip'	=> $_SERVER['REMOTE_ADDR'] ?? ''
            )));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $result = curl_exec($ch);
            curl_close($ch);

            if (is_string($result)) {
                $data = json_decode($result, true);
                $result = is_array($data) && isset($data['success']) && $data['success'] === true;
            }
        }

        if (!$result) {
            $_SESSION['saved_contact'] = $_POST;
            $_SESSION['alerts'][] = array(
                'type'		=> 'e',
                'content'	=> lng('Captcha is incorrect.')
            );

            redirect('help');
        }
*/
        $postdata = http_build_query(
            array(
                'secret' => $rc_skey,
                'response' => $_POST['g-recaptcha-response']
            )
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);
        $result = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $data   = $result !== false ? json_decode($result, true) : null;
        $ok = is_array($data)
            && !empty($data['success'])
            && ($data['hostname'] ?? '') === $https_domain;  // optional but recommended

        if (!$ok || !$_POST['g-recaptcha-response']) {
            $_SESSION['saved_contact'] = $_POST;
            $_SESSION['alerts'][] = array(
                'type'		=> 'e',
                'content'	=> lng('Captcha is incorrect.')
            );

            redirect('help');
        }
    }

    extract($_POST);
    $template['email'] = $email;
    $template['message'] = $message;
    $message = get_template_contents('mail/contact_us.php');
    $subject = $config['Company']['company_name'].': '.lng('Contact form').': '.$subject;
    $email_replyto = $email;
    func_mail($config['Company']['company_name'], $config['Company']['support_department'], '', $subject, $message, $email);

    $_SESSION['saved_contact'] = [];
    $_SESSION['alerts'][] = array(
        'content'	=> lng('Your letter has been sent. We will contact you as soon as possible.')
    );

    redirect('help');
}

$template['head_title'] = lng('Contact us').'. '.$template['head_title'];
$template['page'] = get_template_contents('help/create.php');
$template['css'][] = 'help';