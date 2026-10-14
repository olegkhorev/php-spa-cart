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
if (!$login) {
    redirect('');
}

if ($_GET['add']) {
    if (!$db->field("SELECT wlid FROM wishlist WHERE productid='".addslashes($_GET['add'])."' AND userid='".$login."'")) {
        $insert = array(
            'userid'	=> $login,
            'productid'	=> $_GET['add'],
            'date'		=> time()
        );

        $db->array2insert('wishlist', $insert);
    }

    exit;
}

if ($get['1'] == 'remove') {
    $db->query("DELETE FROM wishlist WHERE wlid='".addslashes($get['2'])."' AND userid='".$login."'");
    if ($is_ajax) {
        exit;
    } else {
        redirect('wishlist');
    }
} elseif ($get['1'] == 'clear') {
    $db->query("DELETE FROM wishlist WHERE userid='".$login."'");
    if ($is_ajax) {
        exit;
    } else {
        redirect('wishlist');
    }
}

$wishlist = $db->all("SELECT * FROM wishlist WHERE userid='".$login."' ORDER BY date DESC");
if ($wishlist) {
    foreach ($wishlist as $k => $v) {
        $wishlist[$k]['product'] = $db->row("SELECT * FROM products WHERE productid='".$v['productid']."' AND status IN ('1', '3')");
        if ($wishlist[$k]['product']) {
            $wishlist[$k]['product']['photo'] = $db->row("SELECT * FROM products_photos WHERE photoid='".$wishlist[$k]['product']['photoid']."'");
        } else {
            $db->query("DELETE FROM wishlist WHERE productid='".$v['productid']."' AND userid='$login'");
            unset($wishlist[$k]);
        }
    }

    $template['wishlist'] = $wishlist;
}

if ($is_ajax && !$_GET['its_ajax_page']) {
    $template['page'] = get_template_contents('wishlist/body.php');
    $result = array($template['page'], lng('Wishlist'), $template['bread_crumbs_html'], $get['0'], $template['parentid']);
    exit(json_encode($result));
}

$template['page'] = get_template_contents('wishlist/page.php');
