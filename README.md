SPA-Cart - e-commerce Single Page Application
https://spa-cart.com/

1. Installation

a. Create MySQL database and upload files into some folder on your server.

b. Follow installation script, for example
https://demo.spa-cart.com/install

Complete steps.

c. Once installed - you can edit settings in includes/settings.php

ImageMagick better to be installed and "convert" tool must be executable from any place. You can get ImageMagick for free from here
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
http://[YourDomain.com]/optimize.php?pswd=01230  (I recommend to change 01230 password in script)

it will generate images cache.


h. Use API in beta testing mode now
http://demo.spa-cart.com/api?key=556677

i. Add Cron job for every 30 minutes to check not processed Stripe orders and run the Abandoned cart reminder and check currency rates
http://demo.spa-cart.com/cron.php?pswd=01230  (I recommend to change 01230 password in script)

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

http://[YourDomain.com]/reset.php?pswd=01230 (I recommend to change 01230 password in script)

It rebuilds templates cache.

http://[YourDomain.com]/optimize.php?pswd=01230 (I recommend to change 01230 password in script)

It rebuild photos cache. Some hosting accounts will process images generation slow so better to do it yourself after you complete uploading images. Because otherwise if not you - your customer will wait it. But you can process all at once.

Once your developer create custom images sizes, this script should be customized for them.

-----------

I recommend to check this article:
https://spa-cart.com/page/about_spa_cart.html
