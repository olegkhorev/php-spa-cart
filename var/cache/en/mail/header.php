<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php if ($config['Company']['company_name']) {?><?php echo $config['Company']['company_name'];?><?php } else  { ?>E-mail<?php } ?></title>
</head>
<body>
<table style="width: 600px; max-width: 100%; border: 1px solid #7da2a1;">
<tr>
 <td style="background-color: #fff; text-align: center; padding: 20px;"><a href="<?php echo $http_location;?>"><img src="<?php echo $http_location;?>/images/logo_new.png" alt="" /></a></td>
</tr>
<tr>
 <td style="padding: 20px;">