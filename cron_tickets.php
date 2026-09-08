<?php
ini_set('log_errors','On');
ini_set('display_errors','Off');
extract($_GET);
ini_set('memory_limit', '224288000');
set_time_limit(36000);

include 'includes/boot.php';

session_write_close();

if (php_sapi_name() != 'cli' && $pswd != $config['Tickets']['tickets_cron_password']) {
	header("Location: /");
	exit;
}

#
# Settings
#
$tls = 1; # Is SSL
$port = 995; # server port

#
# Process SMTP
#

include SITE_ROOT . '/includes/tickets_smtp.php';

q_load('ticket');

function writelog($str) {
	$logfile = SITE_ROOT."/var/log/tickets_cron.txt";
	if (!file_exists($logfile))
		$fp = fopen($logfile, 'w');
	else
		$fp = fopen($logfile, 'a+');

	if (!$fp) return false;

	fwrite($fp, $str."\n");
	fclose($fp);

	return true;
}
	$pop3 = new pop3_class;
	$pop3->hostname = $config['Tickets']['tickets_smtp_host'];
	$pop3->port = $port;
	$pop3->tls = $tls;
	$user = $config['Tickets']['tickets_smtp_username'];
	$password = $config['Tickets']['tickets_smtp_password'];
	$pop3->realm = ""; /* Authentication realm or domain      */
	$pop3->workstation = "";   /* Workstation for NTLM authentication */
	$apop = 0; /* Use APOP authentication     */
	$pop3->authentication_mechanism = "USER";  /* SASL authentication mechanism       */
	$pop3->debug = 0;  /* Output debug information    */
	$pop3->html_debug = 1;     /* Debug information is in HTML*/
	$pop3->join_continuation_header_lines = 1; /* Concatenate headers split in multiple lines */

	$messages = array();

	if (($error = $pop3->Open()) == "") {
		if (($error = $pop3->Login($user,$password,$apop)) == "") {
			if (($error = $pop3->Statistics($letters, $size)) == "") {
				$result = $pop3->ListMessages("",0);
				if (GetType($result) == "array") {
					$result = $pop3->ListMessages("",1);
					if (GetType($result) == "array") {
						for (Reset($result), $message = 0; $message < count($result); Next($result), $message++) {
							$messages[Key($result)] = array('id' => $result[Key($result)]);
						}

						if (!empty($messages)) {
							foreach ($messages as $k=>$v) {

								$pop3->RetrieveMessage($k, $headers, $body, 100000000);
								foreach ($headers as $k2=>$v2) {
									$messages[$k]['headers'] .= $v2."\n";
								}

								foreach ($body as $k2=>$v2) {
									$messages[$k]['body'] .= $v2."\n";
								}
							}
						}
					} else
							$error = $result;
				} else
					$error = $result;
			}
		}
	}

	$mime=new mime_parser_class;

	/*
	 * Set to 0 for not decoding the message bodies
	 */
	$mime->decode_bodies = 1;

	if (!empty($error))
		echo "<H2>Error: ",HtmlSpecialChars($error),"</H2>";

	if (empty($messages)) {
		$pop3->Close();
	} else {
		$languages = $db->all("SELECT * FROM languages_codes");
		foreach ($messages as $k=>$v) {
			if (!$db->field("SELECT message_id FROM tickets_smtp WHERE message_id='$v[id]'")) {
				$success=$mime->Decode(array('Data'=>$v['headers']."\n".$v['body']), $decoded);
				$results = array();

				if(!$success) {
					writelog('MIME message decoding error: '.HtmlSpecialChars($mime->error));
				} else {
					if($mime->Analyze($decoded[0], $results)) {
					} else  {
						writelog('MIME message analyse error: '.$mime->error);
					}
				}

				if ($results['Type'] == 'html' && !empty($results['Alternative'])) {
					$message = $results['Alternative']['0']['Data'];
				} elseif ($results['Type'] == 'text') {
					$message = $results['Data'];
				} elseif ($results['Type'] == 'html') {
					$message = $results['Data'];
				}

				$subject = $results['Subject'];
				$from = $results['From']['0']['address'];
				$_from = $from;
				$attachments = $results['Attachments'];
				if (!empty($message) && !empty($from) && !empty($subject)) {
					$tmp = explode("[#", $subject);
					$ticketid = str_replace(']', '', trim($tmp['1']));
					$message = str_replace('<div>', '', $message);
					$message = str_replace('</div>', "<br>", $message);
					$message = strip_tags($message, '<br>');
					$tmp = array();
					foreach ($languages as $language) {
						$separate_line_lbl = $db->field("SELECT translation FROM languages WHERE lng='".$language['code']."' AND word='lbl_reply_above_here'");
						$tmp = explode($separate_line_lbl, $message);
						if (!empty($tmp['0']) && strstr($message, $separate_line_lbl)) {
							break;
						}
					}

					$new_message = '';
					if (!empty($tmp['0'])) {
						$new_message = $tmp['0'];
					}

					$message = trim($new_message);

					$ticket = $db->row("SELECT * FROM tickets WHERE ticketid='$ticketid' AND email='$_from'");
					if (!empty($ticket) && !empty($message)) {
							$db->query("UPDATE tickets SET status='O' WHERE ticketid='$ticketid'");
							$message = array(
								   'read' => 'Y',
								   'admin_read' => 'N',
								   'message' => $message,
								   'userid' => $ticket['userid'],
								   'email'	=> $ticket['email'],
								   'date' => time(),
								   'ticketid' => $ticketid
							);

							func_create_message($message, $attachments, 123, 'Y');
						}
				}

				$db->query("INSERT INTO tickets_smtp SET message_id='$v[id]', date='".time()."'");
			}

			$pop3->DeleteMessage($k);
		}
		$pop3->Close();
	}

?>