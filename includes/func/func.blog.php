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
function blog_new_comment_parse_html($html)
{
    $allowed_tags = '<b><i><u><a><div><p><br>';
    $html = strip_tags($html, $allowed_tags);
    /*
        # Parse links for nofollow tag
        $pattern = '/(https?:\/\/[^\s]+)/';
        $replacement = '<a href="$1" rel="nofollow" target="_blank">$1</a>';
        $html = preg_replace($pattern, $replacement, $html);
        exit($html.'-');
    */
    $html = preg_replace('#(( ){0,}<br( {0,})(/{0,1})>){1,}$#i', '', $html);
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'); // require mb_string
    $dom = new DOMDocument();

    $dom->loadHTML($html);
    $nodes = $dom->getElementsByTagName('*'); //just get all nodes,
    foreach ($nodes as $node) {
        if ($node->nodeName == 'a') {
            $rel = ['nofollow'];
            $node->setAttribute('rel', implode(' ', $rel));
            #			echo '<pre>';
            #			exit(print_R($node));
        }

        if ($node->hasAttribute('onmouseover')) {
            $node->removeAttribute('onmouseover');
        }

        if ($node->hasAttribute('onmouseout')) {
            $node->removeAttribute('onmouseout');
        }

        if ($node->hasAttribute('mouseenter')) {
            $node->removeAttribute('mouseenter');
        }

        if ($node->hasAttribute('mouseleave')) {
            $node->removeAttribute('mouseleave');
        }

        if ($node->hasAttribute('onload')) {
            $node->removeAttribute('onload');
        }

        if ($node->hasAttribute('onclick')) {
            $node->removeAttribute('onclick');
        }

        if ($node->hasAttribute('onchange')) {
            $node->removeAttribute('onchange');
        }

        if ($node->hasAttribute('onkeydown')) {
            $node->removeAttribute('onkeydown');
        }
    }

    $dom->removeChild($dom->doctype);
    $html = $dom->saveHTML();
    $html = str_replace('<html><body>', '', $html);
    $html = str_replace('</body></html>', '', $html);
    $html = $decoded = mb_convert_encoding($html, 'UTF-8', 'HTML-ENTITIES');

    return $html;
}
