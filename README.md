SPA-Cart - e-commerce Single Page Application
https://spa-cart.com/


# 1. Installation

a. Create MySQL database and upload files onto your server.

*System does not support to be located under a folder. It should be another domain or subdomain.*


b. Follow URL, you will get redirected here
https://demo.spa-cart.com/install

Complete steps.


c. Once installed - you can edit settings in includes/settings.php

ImageMagick supported on most popular hostings, like GoDaddy.

PHP GD also supported - open includes/settings.php and set "false" from "true"

$is_image_magick = false;


d. For easier development Local IP is to include local Web Server settings

DEVELOPMENT TRUE means templates are always regenerated.


e. Admin area - a@a.com / 01230
https://demo.spa-cart.com/admin


f. Add Cron job for every 30 minutes to check not processed Stripe orders and run the Abandoned cart reminder and check currency rates
http://demo.spa-cart.com/cron.php?pswd=01230  (I recommend to change 01230 password in script)


g. Support Desk

To receive replies from emails - add this script to cron for every 10-15 minutes:
http://demo.spa-cart.com/cron_tickets.php?pswd=[PASSWORD]

Password  you can define here
http://demo.spa-cart.com/admin/configuration/Tickets

On same page configure POP3 settings.

Edit this file to set up correct server port and SSL setting
http://demo.spa-cart.com/cron_tickets.php

SSL port is 995. Not SSL port is 110.


h. To disable Design theme color mode edit settings.php
$design_mode = 0;


# 2. After testing remove all the data and insert yours. You can use Import/Export to insert new values. Only new categories are not imported.

Please, also remove the Discount coupon and Gift Cards.


# 3. Helpful scripts

http://[YourDomain.com]/reset.php?pswd=01230 (I recommend to change 01230 password in script)

It rebuilds templates cache.

To generate images cache, without parsing full website by users or Google, visit this URL:
http://[YourDomain.com]/optimize.php?pswd=01230  (I recommend to change 01230 password in script)

it will generate images cache.

-----------

I recommend to check this article:
https://spa-cart.com/page/about_spa_cart.html
