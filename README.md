SPA-Cart - e-commerce Single Page Application
https://spa-cart.com/


### 1. Installation

a. Create MySQL database and upload files onto your server.

*System does not support to be located under a folder. It should be another domain or subdomain.*


b. Follow URL, you will get redirected here
https://[URL]/install

Complete steps.


c. Once installed - you can edit settings in includes/settings.php

ImageMagick supported on most popular hostings, like GoDaddy.

PHP GD also supported - open includes/settings.php and set "false" from "true"

$is_image_magick = false;


d. For easier development Local IP is to include local Web Server settings

DEVELOPMENT TRUE means templates are always regenerated.


e. Admin area - a@a.com / 01230
https://[URL]/admin


f. Add the Cron job for every 30 minutes to check not processed Stripe orders and run the Abandoned cart reminder and check currency rates
http://[URL]/cron.php?pswd=01230  (I recommend to change 01230 password in script)


g. Support Desk

To receive replies from emails - add this script to cron for every 10-15 minutes:
http://[URL]/cron_tickets.php?pswd=[PASSWORD]

The password you can define here
http://[URL]/admin/configuration/Tickets

On the same page configure SMTP settings.

Edit this file to set up correct server port and SSL setting
http://[URL]/cron_tickets.php

SSL port is 995. Not SSL port is 110.


h. To disable the Design theme color mode edit settings.php
$design_mode = 0;

e. Predictive search
http://[URL]/cron_fuzzy.php?pswd=01230 (I recommend to change the 01230 password in the script)

It rebuilds the predictive search cache.

### 2. After testing remove all the data and insert yours. You can use Import/Export to insert new values. Only new categories are not imported.


### 3. Helpful scripts

http://[URL]/reset.php?pswd=01230 (I recommend to change the 01230 password in the script)

It rebuilds the templates cache.

To generate the images cache, without parsing full website by users or Google, visit this URL:
http://[URL]/optimize.php?pswd=01230  (I recommend to change the 01230 password in the script)

it will the generate images cache.

-----------

It's free under the MIT license.

I recommend to check this article:
https://spa-cart.com/page/about_spa_cart.html
