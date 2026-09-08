<?php
$max_input_vars = ini_get('max_input_vars');
if (empty($max_input_vars)) {
    $max_input_vars = 1000;
}

extract($_POST);
extract($_GET);

$intershipper_cond = $config['Shipping']['use_intershipper'] == 'Y'
    ? " AND (intershipper_code!='' OR code='') "
    : "";

$carriers = $db->all("SELECT code, shipping, COUNT(*) as total_methods FROM shipping WHERE code!='' $intershipper_cond  GROUP BY code ORDER BY code");

$carrier_valid = false;

if (!empty($carriers)) {
    $carrier_names = array (
        'CPC' => "Canada Post",
        'USPS' => 'U.S.P.S.',
        'APOST' => "Australia Post",
    );

    foreach ($carriers as $k=>$v) {
        if ($v['code'] == $carrier)
            $carrier_valid = true;

        $_carrier_total_enabled = $db->field("SELECT COUNT(*) FROM shipping WHERE code='$v[code]' AND active='Y' $intershipper_cond ");

        if (!empty($carrier_names[$v['code']]))
            $_carrier_name = $carrier_names[$v['code']];
        else
            $_carrier_name = preg_replace("/^([^ ]+).*$/", "\\1", $v['shipping']);

        $carriers[$k]['shipping'] = $_carrier_name;
        $carriers[$k]['total_enabled'] = $_carrier_total_enabled;
    }
}

if (!$carrier_valid)
    $carrier = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($mode == 'add_realtime_methods') {
        $db->query("UPDATE shipping SET active = 'N' WHERE code != ''");
    }

    if (!empty($data)) {
        foreach ($data as $id => $arr) {
            if ($mode == 'add_realtime_methods' || isset($arr['shipping']))
                $arr['active'] = isset($arr['active']) ? 'Y' : 'N';
            else
                $arr['active'] = 'Y';

            $arr['is_cod'] = isset($arr['is_cod']) ? 'Y' : 'N';
            if (empty($arr['weight_min']))
                $arr['weight_min'] = 0;

            if (empty($arr['weight_limit']))
                $arr['weight_limit'] = 0;

            $arr['weight_min'] = $arr['weight_min'];
            $arr['weight_limit'] = $arr['weight_limit'];
            $db->array2update('shipping', $arr, "shippingid = '$id'");
        }
    }

    if (!empty($add['shipping'])) {
        $add['active'] = isset($add['active']) ? 'Y' : 'N';
        $add['is_cod'] = isset($add['is_cod']) ? 'Y' : 'N';
        if (empty($add['weight_min']))
            $add['weight_min'] = 0;

        if (empty($add['weight_limit']))
            $add['weight_limit'] = 0;

        $add['weight_min'] = $add['weight_min'];
        $add['weight_limit'] = $add['weight_limit'];
        $db->array2insert('shipping', $add);
    }

    redirect('/admin/shipping/'.(!empty($carrier) ? "?carrier=$carrier" : ''));
}

if ($mode == 'delete') {
    $db->query("DELETE FROM shipping WHERE shippingid='$shippingid'");
    $db->query("DELETE FROM shipping_rates WHERE shippingid='$shippingid'");

    redirect('/admin/shipping');
}

$condition = '';

$template['head_title'] = lng('Shipping methods').' :: '.$template['head_title'];
if ($mode == 'add_realtime_methods') {
	$template['location'] .= ' &gt; <a href="'.$current_location.'/admin/shipping">'.lng('Shipping methods').'</a> &gt; '.lng('Manage realtime shipping methods');
} else {
	$template['location'] .= ' &gt; '.lng('Shipping methods');
    $condition .= " AND (code = '' OR active = 'Y')";
}

$shipping = $db->all("SELECT * FROM shipping WHERE 1 $condition $intershipper_cond ORDER BY orderby, shipping");
$new_shipping = '';
$active_shipping_vars = 0;

if (!empty($shipping)) {
    foreach ($shipping as $v) {
        if (empty($new_shipping) && $v['is_new'] == 'Y') {
            $new_shipping = 'Y';
        }

        if ($v['active'] == 'Y' || $v['code'] == '') {
            $active_shipping_vars = $active_shipping_vars + 4;
            if ($v['code'] == '') {
                $active_shipping_vars = $active_shipping_vars + 3;
            }
        }
    }
}

if ($active_shipping_vars >= $max_input_vars && $_GET['alert'] != 'Y') {
    $_SESSION['alerts'][] = array(
   		'type'		=> 'e',
   		'content'	=> 'PHP variable max_input_vars is '.$max_input_vars.' when shipping methods are '.$active_shipping_vars
    );

    redirect($_SERVER['REQUET_URI'].'?&alert=Y');
}

$template['shipping'] = $shipping;
$template['new_shipping'] = $new_shipping;
$template['carriers'] = $carriers;
$template['carrier'] = $carrier;

if ($mode == 'add_realtime_methods')
	$template['page'] = get_template_contents('admin/pages/add_realtime_methods.php');
else
	$template['page'] = get_template_contents('admin/pages/shipping.php');

$template['css'][] = 'admin_shipping';
$template['js'][] = 'admin_shipping';
