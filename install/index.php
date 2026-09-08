<?php
error_reporting(0);
header("Content-type: text/html;charset=utf-8");
define('SITE_ROOT', dirname(__FILE__));
if (file_exists(SITE_ROOT . '/../includes/settings.php')) {
    header('Location: /');
    exit;
}
#echo '<pre>';
#exit(print_R($_SERVER));
#exit(substr($_SERVER['REQUEST_URI'], 0, 8));
if (substr($_SERVER['REQUEST_URI'], 0, 8) != '/install')
 exit('SPA-Cart can be installed under own domain or subdomain only.');

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!$_SESSION['sql']['imported']) {
        $_SESSION['sql'] = $_POST;
		$mysqli = mysqli_connect($_POST['sql_server'], $_POST['sql_user'], $_POST['sql_password'], $_POST['sql_database']);
		if (!$mysqli) {
		    echo "<pre>Error: cannot connect with MySQL." . PHP_EOL;
		    echo "Error code: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Error text: " . mysqli_connect_error() . PHP_EOL;
	    	exit('<a href="./">Refresh</a>');
		}

		if ($mysqli->connect_error) {
		    die('Cannot connect to MySQL server.');
		}

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file(SITE_ROOT.'/dump.sql');
echo '<center>';
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    $mysqli->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($mysqli) . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";
echo '</center>';
        $_SESSION['sql']['imported'] = '1';
    } else {
        $file_contents = file_get_contents(SITE_ROOT . '/../includes/settings.default.php');
        extract($_POST);
        $new_file = str_replace('{{sql_server}}', $_SESSION['sql']['sql_server'], $file_contents);
        $new_file = str_replace('{{sql_user}}', $_SESSION['sql']['sql_user'], $new_file);
        $new_file = str_replace('{{sql_password}}', $_SESSION['sql']['sql_password'], $new_file);
        $new_file = str_replace('{{sql_database}}', $_SESSION['sql']['sql_database'], $new_file);
        $new_file = str_replace('{{http_host}}', $http_host, $new_file);
        if ($https_enabled) {
            $new_file = str_replace('{{parent_host}}', 'https://'.$http_host, $new_file);
        } else
            $new_file = str_replace('{{parent_host}}', 'http://'.$http_host, $new_file);

        $new_file = str_replace('{{web_dir}}', $web_dir, $new_file);
        $new_file = str_replace('{{parent_page}}', $parent_page, $new_file);
        if ($is_image_magick)
            $new_file = str_replace('{{is_image_magick}}', '1', $new_file);
        else
            $new_file = str_replace('{{is_image_magick}}', '', $new_file);

        if ($design_mode)
            $new_file = str_replace('{{design_mode}}', '1', $new_file);
        else
            $new_file = str_replace('{{design_mode}}', '', $new_file);

        $new_file = str_replace('{{payment_currency}}', $payment_currency, $new_file);
        $fp = fopen(SITE_ROOT . '/../includes/settings.php', 'w+');
        fputs($fp, $new_file);
        fclose($fp);
        exit('Admin area access info: a@a.com / 01230 . Don\'t forget to change this password. <a href="/">Visit site</a>');
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:g="http://base.google.com/ns/1.0" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="area-c">
<head>
<title>SPA Cart Installation</title>
<link rel="shortcut icon" href="/favicon.png" type="image/vnd.microsoft.icon" />
<meta charset="utf-8" />
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="//code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/ui/1.14.1/jquery-ui.min.js" integrity="sha256-AlTido85uXPlSyyaZNsjJXeCs07eSv3r43kyCVc8ChI=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css" type="text/css" />

<link rel="stylesheet" href="style.css">
</head>
<body>
	<section>
		<div class="color"></div>
		<div class="color"></div>
		<div class="color"></div>
		<div class="box">
			<div class="square" style="--i:0"></div>
			<div class="square" style="--i:1"></div>
			<div class="square" style="--i:2"></div>
			<div class="square" style="--i:3"></div>
			<div class="square" style="--i:4"></div>
			<div class="container">
				<div class="form">
<center><img src="/images/logo.png" alt="" /></center>
<div class="install-step">
<h1>SPA Cart Installation</h1>
<?php
if (!$_SESSION['sql']['imported']) {
?>
<h2>Important:</h2>
<a href="/READ_ME.txt" target="_blank">Read Me after installation</a><br />
<a href="/READ_ME_manual_installation.txt" target="_blank">Read Me for manual installation</a>
<h2>Requipemnts:</h2>
<table class="req" cellspacing="0">
 <tr>
  <th><b>1. PHP Version</b></th>
  <th>Required</th>
  <th>Status</th>
 </tr>

<?php
$php_version_required = "8.0.0";
$current_php_version = PHP_VERSION;
if (version_compare($current_php_version, $php_version_required) >= 0) {
    $php_version_success = true;
}
?>
<tr>
  <td><?php echo $current_php_version; ?></td>
  <td><?php echo $php_version_required; ?></td>
  <td>
<?php
if ($php_version_success) {
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Bad</font>';
}
?>
  </td>
</tr>

 <tr>
  <th colspan="2"><b>2. Extension</b></th>
  <th>Status</th>
 </tr>

<tr>
  <td colspan="2">mbstring</td>
  <td>
<?php
if(extension_loaded('mbstring') && function_exists('mb_get_info')){
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Bad</font>';
}
?>
  </td>
</tr>

<tr>
  <td colspan="2">allow_url_fopen</td>
  <td>
<?php
if (ini_get('allow_url_fopen')) {
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Bad</font>';
}
?>
  </td>
</tr>

<tr>
  <td colspan="2">GD</td>
  <td>
<?php
if (extension_loaded('gd') && function_exists('gd_info')) {
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Optional</font>';
}
?>
  </td>
</tr>

<tr>
  <td colspan="2">ZIP</td>
  <td>
<?php
if (extension_loaded('zip')){
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Optional</font>';
}
?>
  </td>
</tr>

<tr>
  <th colspan="2"><b>3. Permissions</b></th>
  <th>Status</th>
</tr>

<tr>
  <td colspan="2">/files/</td>
  <td>
<?php
if (is_writeable(SITE_ROOT.'/../files')) {
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Bad</font>';
}
?>
  </td>
</tr>

<tr>
  <td colspan="2">/includes/</td>
  <td>
<?php
if (is_writeable(SITE_ROOT.'/../includes')) {
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Bad</font>';
}
?>
  </td>
</tr>

<tr>
  <td colspan="2">/photos/</td>
  <td>
<?php
if (is_writeable(SITE_ROOT.'/../photos')) {
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Bad</font>';
}
?>
  </td>
</tr>

<tr>
  <td colspan="2">/var/</td>
  <td>
<?php
if (is_writeable(SITE_ROOT.'/../var')) {
 echo '<font color="green">Good</font>';
} else {
 echo '<font color="red">Bad</font>';
}
?>
  </td>
</tr>

</table>

<h2 style="color: #000;">MySQL database installation:</h2>

<?php
}
?>

<form method="POST">
<?php
if ($_SESSION['sql']['imported']) {
$http_host = $_SERVER['HTTP_HOST'];
$web_dir = explode('install', $_SERVER['REQUEST_URI']);
$web_dir = $web_dir[0];
$web_dir = substr($web_dir, 0, strlen($web_dir) - 1);
?>
<br />
<table class="mysql-details-table">
<tr>
<td>SSL/HTTPS:</td>
<td><label><input type="checkbox" name="https_enabled" value="1" checked /> enabled</label></td>
</tr>
<tr>
<td>Site domain:</td>
<td><input type="text" name="http_host" value="<?php echo $http_host; ?>" /></td>
</tr>
<tr>
<td>Payment currency:</td>
<td><input type="text" name="payment_currency" value="USD" /></td>
</tr>
<tr>
<td>ImageMagick:</td>
<td><label><input type="checkbox" name="is_image_magick" value="1" checked /> enabled</label></td>
</tr>
<tr>
<td>Design Mode:</td>
<td><label><input type="checkbox" name="design_mode" value="1" checked /> enabled</label><br /><small>You can switch it in settings.php later</small></td>
</tr>
<tr>
<td colspan="2" align="center">
						<div class="inputBox">
							<div class="btn" onclick="$(this).closest('form').submit();$(this).hide()"><a href="javascript: void(0);">Complete</a></div>
<div class="clear"></div>
						</div>
</td>
</tr>
</table>
<?php } else { ?>
<table class="mysql-details-table">
<tr>
<td>MySQL host:</td>
<td><input type="text" name="sql_server" value="<?php if ($_SESSION['sql']['sql_server']) echo $_SESSION['sql']['sql_server']; else echo '127.0.0.1';?>" /></td>
</tr>
<tr>
<td>MySQL user:</td>
<td><input type="text" name="sql_user" value="<?php echo str_replace('"', '&quot;', $_SESSION['sql']['sql_user']); ?>" /></td>
</tr>
<tr>
<td>MySQL password:</td>
<td><input type="password" name="sql_password" value="<?php echo str_replace('"', '&quot;', $_SESSION['sql']['sql_password']); ?>" /></td>
</tr>
<tr>
<td>MySQL database:</td>
<td><input type="text" name="sql_database" value="<?php echo str_replace('"', '&quot;', $_SESSION['sql']['sql_database']); ?>" /></td>
</tr>
<tr>
<td colspan="2" align="center">
						<div class="inputBox">
							<div class="btn" onclick="$(this).closest('form').submit();$(this).hide()"><a href="javascript: void(0);">Continue</a></div>
<div class="clear"></div>
						</div>
</td>
</tr>
</table>

</form>
</div>
    </div>
			</div>
		</div>
	</section>
<?php } ?>

</body>
</html>