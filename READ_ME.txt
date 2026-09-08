1. Installation

a. Create MySQL database and upload files into some folder on your server.

b. Follow installation script, for example
https://demo.spa-cart.com/install

Complete steps.

c. Once installed - you can edit settings in includes/settings.php

# Use MySQLi
$is_mysqli = true;

# Use warehouse false or true - beta mode
$warehouse_enabled = false;

# ImageMagick better to be installed and "convert" tool must be executable from any place. You can get ImageMagick for free from here
http://www.imagemagick.org/script/binary-releases.php

It resizes images to needed dimension with Photoshop quality and keep same size as if it was with PHP GD.

PHP GD also supported - open includes/settings.php and set "false" from "true"

$is_image_magick = false;


d. For easier development Local IP is to include local Web Server settings

DEVELOPMENT TRUE mean templates are always regenerated.

DEMO TRUE mean some params are not editable.

e. System does not support to be located under folder. It should be another domain or subdomain.

f. Admin area - a@a.com / 01230

g. Run
http://[YourDomain.com]/optimize.php?pswd=01230

it will generate images cache.


h. Use API in beta testing mode now
http://demo.spa-cart.com/api?key=556677

i. Add Cron job for every 30 minutes to check not processed Stripe orders and run the Abandoned cart reminder and check currency rates
http://demo.spa-cart.com/cron.php?pswd=01230

j. Support Desk

To receive replies from emails - add this script to cron for every 10-15 minutes:
http://demo.spa-cart.com/cron_tickets.php?pswd=[PASSWORD]

Password  you can define here
http://demo.spa-cart.com/admin/configuration/Tickets

On same page configure POP3 settings.

Edit this file to set up correct server port and SSL setting
http://demo.spa-cart.com/cron_tickets.php

SSL port is 995. Not SSL port is 110.

k. To disable Design theme color mode edit settings.php
# Design theme color editor
# 1 - on
# 0 - off
$design_mode = 1;

2. After testing remove all the data and insert yours. You can use Import/Export to insert new values. Only new categories are not imported.

Please, also remove the Discount coupon and Gift Cards.

3. To use HTTPS(SSL) always - open index.php and uncomment
<?php
/*
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off") {
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: ' . $redirect);
    exit();
}
*/

4. Helpful scripts

http://[YourDomain.com]/reset.php?pswd=01230

It rebuilds templates cache.

http://[YourDomain.com]/optimize.php?pswd=01230

It rebuild photos cache. Some hosting accounts will process images generation slow so better to do it yourself after you complete uploading images. Because otherwise if not you - your customer will wait it. But you can process all at once.

Once your developer create custom images sizes, this script should be customized for them.


5. Templates engine

Supported tags are

a. Any template variable can be {$var} - it's <?php echo $var; ?>. If it's array or object - use same way as PHP, for example {$var['var']}

b.
{foreach $array as $k=>$v}

{/foreach}

will be

<?php
foreach ($array as $k=>$v) {
}
?>

You still can insert {$v} tag

c. {if $tmp == '1' or $var == '2'} {/if}

will be

<?php
if ($tmp == '1' or $var == '2') {
}
?>

Same is

{elseif [CODE]}

and

{else}

d.
{php $var = 1+2;}

It's just to wrap <?php ?> to the inside content.

e. {price $var}

It will ouput currency symbol and price with .00 at the end.

f. {weight $var}

It will ouput weight symbol and weight with .00 at the end.

g. {include="TEMPALTE PATH"} - for example {include="common/products.php"}

h. {lng[Hello world]} - language variable. Useful if you translate or use multi-lingual site.

All tags and {lng..} stored in cache and not processed on every page load.

{lng[Hello|lower]} - lowcase.
{lng[Hello|js]} - replace line breaks and " character with \".
{lng[Hello|escape]} - replace " character with \".

You can also use {lng} in JavaScript - they are processed as well. JavaScrpt already do all the work so it does not support additonal modifiers like "lower".

i. Easier than {php } for assignments
{assign $var=1+2}

Output
<?php
$var = 1+2;
?>


