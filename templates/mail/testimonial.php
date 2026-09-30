<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{include="mail/header.php"}
{$email_header}
{lng[Hello]},
<br /><br />
<p>{lng[New testimonial is here]}</p>
<br />
<a href="{$http_location}/admin/testimonials">{$http_location}/admin/testimonials</a>
<br /><br />
{$signature};
{include="mail/footer.php"}