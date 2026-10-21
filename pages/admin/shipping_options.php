<?php
extract($_GET);
extract($_POST);
$carriers = func_get_carriers();
$carrier_valid = false;
foreach ($carriers as $k => $v)
	if ($v[0] == $carrier) {
		$carrier_valid = true;
		break;
	}

$carrier = $carrier_valid ? $carrier : '';
if ($carrier_valid && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$topMessage = '';
	$suffix = '';
	$shippingOptions = array();
	if ($carrier == 'FDX') {
		if (isset($update_options)) {
			$carrier_codes = isset($carrier_codes) && !empty($carrier_codes) ? implode('|', $carrier_codes) : '';
			$rate_request_types = isset($rate_request_types) ? $rate_request_types : 'ACCOUNT';
			$fedex_options = array(
				'carrier_codes' => $carrier_codes,
				'packaging' => $packaging,
				'dropoff_type' => $dropoff_type,
				'ship_date' => intval($ship_date),
				'dim_length' => sprintf("%.2f", $dim_length),
				'dim_width' => sprintf("%.2f", $dim_width),
				'dim_height' => sprintf("%.2f", $dim_height),
				'max_weight' => abs(doubleval($max_weight)),
				'cod_value' => sprintf("%.2f", $cod_value),
				'cod_type' => $cod_type,
				'alcohol' => (empty($alcohol) ? 'N' : 'Y'),
				'hold_at_location' => (empty($hold_at_location) ? 'N' : 'Y'),
				'dry_ice' => (empty($dry_ice) ? 'N' : 'Y'),
				'nonstandard_container' => (empty($nonstandard_container) ? 'N' : 'Y'),
				'inside_pickup' => (empty($inside_pickup) ? 'N' : 'Y'),
				'inside_delivery' => (empty($inside_delivery) ? 'N' : 'Y'),
				'saturday_pickup' => (empty($saturday_pickup) ? 'N' : 'Y'),
				'saturday_delivery' => (empty($saturday_delivery) ? 'N' : 'Y'),
				'residential_delivery' => (empty($residential_delivery) ? 'N' : 'Y'),
				'dg_accessibility' => $dg_accessibility,
				'signature' => $signature,
				'handling_charges_amount' => sprintf("%.2f", $handling_charges_amount),
				'handling_charges_type' => $handling_charges_type,
				'currency_code' => $currency_code,
				'param01' => @$param01,
				'param02' => @$param02,
				'add_smartpost_detail' => @$add_smartpost_detail,
				'smartpost_indicia' => $smartpost_indicia,
				'smartpost_ancillaryendorsement' => $smartpost_ancillaryendorsement,
				'smartpost_hubid' => $smartpost_hubid,
				'send_insured_value' => @$send_insured_value,
				'rate_request_types' => $rate_request_types,
			);

			$shippingOptions['param00'] = addslashes(serialize($fedex_options));
		}
	} elseif ($carrier == 'USPS') {
		$dim = abs(doubleval($dim_length)) . ':' . abs(doubleval($dim_width)) . ':' . abs(doubleval($dim_height)) . ':' . abs(doubleval($dim_girth));
		if ($value_of_content_type == 'fixed_value')
			$value_of_content_type = abs(round($value_of_content_fixed, 2));

		settype($use_maximum_dimensions, 'string');
		settype($status_new_method, 'string');
		settype($param11, 'string');
		settype($selected_services, 'array');
		$_param00 = array(
			'mailtype' => $mailtype,
			'ground_only' => $ground_only,
			'selected_services' => $selected_services
		);
		$shippingOptions = array(
			'param00' => addslashes(serialize($_param00)),
			'param01' => $status_new_method,
			'param02' => $machinable,
			'param03' => $container_express,
			'param04' => $container_priority,
			'param05' => $firstclassmailtype,
			'param06' => $dim,//common
			'param07' => $value_of_content_type,
			'param08' => abs(doubleval($max_weight)),//common
			'param09' => ('Y' !== $use_maximum_dimensions) ? 'N' : $use_maximum_dimensions,//common
			'param10' => $container_intl,
			'param11' => empty($param11) ? 'N' : $param11,//common: Split the shipment into multiple packages if...
		);
	} elseif ($carrier == 'CPC') {
		$dim = abs(doubleval($dim_length)) . ':' . abs(doubleval($dim_width)) . ':' . abs(doubleval($dim_height));
		if ($coverage_type == 'fixed_value')
			$coverage_type = abs(round($coverage_fixed, 2));

		if ($cod_type == 'fixed_value')
			$cod_type = abs(round($cod_fixed, 2));

		settype($use_maximum_dimensions, 'string');
		settype($customer_number, 'string');
		settype($status_new_method, 'string');
		settype($param11, 'string');
		$customer_number = ltrim($customer_number, '0');
		$shippingOptions = array(
			'param00' => (!empty($options) ? implode('|', $options) : ''),
			'param01' => $status_new_method,
			'param02' => $cod_type,
			'param03' => $customer_number,
			'param04' => $contract_id,
			'param05' => $quote_type,
			'param06' => $dim,//common
			'param07' => $coverage_type,
			'param08' => abs(doubleval($max_weight)),// common
			'param09' => ('Y' !== $use_maximum_dimensions) ? 'N' : $use_maximum_dimensions,//common
			'param10' => '',
			'param11' => empty($param11) ? 'N' : $param11,//common: Split the shipment into multiple packages if...
		);
	} elseif ($carrier == 'Intershipper')
		$shippingOptions = array(
			'param00' => $delivery,
			'param01' => $shipmethod,
			'param02' => abs(doubleval($length)),
			'param03' => abs(doubleval($width)),
			'param04' => abs(doubleval($height)),
			'param05' => is_array($options) ? implode('|', $options) : '',
			'param06' => $packaging,
			'param07' => $contents,
			'param08' => abs(doubleval($codvalue)),
			'param09' => abs(doubleval($weight)),
			'param10' => ('Y' !== $use_maximum_dimensions) ? 'N' : $use_maximum_dimensions,
		);
	elseif ($carrier == 'ARB')
		$shippingOptions = array(
			'param00' => $param00,
			'param01' => intval($param01),
			'param02' => intval($param02),
			'param03' => intval($param03),
			'param04' => intval($param04),
			'param05' => (intval($param06) < 1) ? 'NR' : $param05,
			'param06' => intval($param06),
			'param07' => $opt_haz . ',',
			'param08' => !in_array($param08, array('M', 'P')) ? 'M' : $param08,
			'param09' => intval($param09),
			'param10' => abs(doubleval($param10)),
			'param11' => isset($param11) ? $param11 : 'N',
		);
	elseif ($carrier == 'APOST')
		$shippingOptions = array(
			'param00' => abs(doubleval($param00)),
			'param01' => abs(doubleval($param01)),
			'param02' => abs(doubleval($param02)),
			'param03' => isset($param03) ? $param03 : 'N',
			'param04' => abs(doubleval($param04)),
			'param05' => isset($param05) ? $param05 : 'N',
		);
	elseif ($carrier == '1800C')
		include $xcart_dir . '/include/1800C_registration.php';

	if (!empty($shippingOptions)) {
		$shippingOptions['currency_rate'] = isset($currency_rate) ? abs(doubleval($currency_rate)) : 1;
		$shippingOptions['carrier'] = $carrier;
		$db->array2insert(
			'shipping_options',
			$shippingOptions,
			true
		);
	}

	redirect('/admin/shipping_options?carrier=' . $carrier . $suffix);
}

$shipping_options = array ();
$shipping_options[strtolower($carrier)] = $db->row("SELECT * FROM shipping_options WHERE carrier='".$carrier."'");
if ($carrier == '1800C') {
	$default_seller_address = array(
		'city'	  => $config['Company']['location_city'],
		'state'	 => $config['Company']['location_state'],
		'country'   => $config['Company']['location_country'],
		'zipcode'   => $config['Company']['location_zipcode'],
		'address'   => $config['Company']['location_address'],
		'phone'	 => $config['Company']['company_phone'],
	);

	$seller_address['company_name'] = $config['Company']['company_name'];
	$seller_address['username'] = $config['Shipping']['1800c_username'];
	$seller_address['readytime'] = $config['Shipping']['1800c_readytime'];
	$seller_address['subsidize'] = $config['Shipping']['1800c_subsidize'];
	$seller_address['business_hours'] = $config['Shipping']['1800c_business_hours'];
	$seller_address['operation_days'] = $config['Shipping']['1800c_operation_days'];

	include SITE_ROOT . '/includes/1800C_registration';
	$seller_address = func_get_warehouse_info($seller_address);
	$template['seller_address'] = $seller_address;
	$template['send_is_avail'] = (!empty($config['Shipping']['1800c_username']) && !empty($config['Shipping']['1800c_password']));
}

if ($carrier == 'FDX') {
	$prepared_user_data = array();
	$prepared_user_data['person_name'] = $userinfo['firstname'] . ' ' . $userinfo['lastname'];
	$prepared_user_data['company_name'] = $config['Company']['company_name'];
	$prepared_user_data['phone_number'] = preg_replace("/[^\d]/", "", $config['Company']['company_phone']);
	$prepared_user_data['email'] = $config['Company']['site_administrator'];
	$prepared_user_data['address_1'] = $config['Company']['location_address'];
	$prepared_user_data['city'] = $config['Company']['location_city'];
	$prepared_user_data['state'] = $config['Company']['location_state'];
	$prepared_user_data['zipcode'] = $config['Company']['location_zipcode'];
	$prepared_user_data['country'] = $config['Company']['location_country'];
	$template['prepared_user_data'] = $prepared_user_data;
	$fedex_options = $shipping_options['fdx']['param00'];
	$shipping_options['fdx'] = @unserialize($fedex_options);
}

if ($carrier == 'Intershipper') {
	$options = explode('|', $shipping_options["intershipper"]["param05"]);
	foreach ($options as $option)
		$shipping_options['intershipper']['options'][$option] = 'Y';

	$template['max_intershipper_weight'] = round(150 * 453.59237 / $config['General']['weight_symbol_grams'], 4);
}

if ($carrier == 'ARB') {
	$_data = explode(',',$shipping_options["arb"]["param07"]);
	$shipping_options['arb']['opt_haz'] = @$_data[0];
	$shipping_options['arb']['opt_own_account'] = @$_data[1];
	$template['max_arb_weight'] = round(149 * 453.59237 / $config['General']['weight_symbol_grams'], 4);
}

if ($carrier == 'USPS') {
	$lower_carrier = strtolower($carrier);
	$_dim = explode(':', $shipping_options[$lower_carrier]['param06']);
	if (func_array_empty($_dim))
		$_dim = array_fill(0, 4, 0);

	$shipping_options[$lower_carrier]['dim_length'] = $_dim[0];
	$shipping_options[$lower_carrier]['dim_width'] = $_dim[1];
	$shipping_options[$lower_carrier]['dim_height'] = $_dim[2];
	$shipping_options[$lower_carrier]['dim_girth'] = $_dim[3];
	if (is_numeric($shipping_options[$lower_carrier]['param07']))
		$shipping_options[$lower_carrier]['fixed_value'] = 'Y';

	$all_usps_services = array(
		'FIRST CLASS',
		'FIRST CLASS METERED',
		'FIRST CLASS COMMERCIAL',
		'FIRST CLASS HFP COMMERCIAL',
		'PRIORITY',
		'PRIORITY COMMERCIAL',
		'PRIORITY CPP',
		'PRIORITY HFP COMMERCIAL',
		'PRIORITY HFP CPP',
		'PRIORITY EXPRESS',
		'PRIORITY EXPRESS COMMERCIAL',
		'PRIORITY EXPRESS CPP',
		'PRIORITY EXPRESS SH',
		'PRIORITY EXPRESS SH COMMERCIAL',
		'PRIORITY EXPRESS HFP',
		'PRIORITY EXPRESS HFP COMMERCIAL',
		'PRIORITY EXPRESS HFP CPP',
		'STANDARD POST',
		'MEDIA',
		'LIBRARY',
	);

	$template['all_usps_services'] = $all_usps_services;
	$_params = @unserialize($shipping_options[$lower_carrier]['param00']);
	if (!empty($_params)) {
		$shipping_options[$lower_carrier]['mailtype'] = $_params['mailtype'];
		$shipping_options[$lower_carrier]['ground_only'] = $_params['ground_only'];
		if (!empty($_params['selected_services']))
			$shipping_options[$lower_carrier]['selected_services'] = array_combine($_params['selected_services'], array_fill(0, count($_params['selected_services']), TRUE));
	} else
		$shipping_options[$lower_carrier]['selected_services'] = array();
}

if ($carrier == 'CPC') {
	$_dim = explode(':', $shipping_options[strtolower($carrier)]["param06"]);
	if (func_array_empty($_dim))
		$_dim = array_fill(0, 3, 0);

	$shipping_options[strtolower($carrier)]['dim_length'] = $_dim[0];
	$shipping_options[strtolower($carrier)]['dim_width'] = $_dim[1];
	$shipping_options[strtolower($carrier)]['dim_height'] = $_dim[2];
	$shipping_options['cpc']['options'] = array();
	if (!empty($shipping_options['cpc']['param00'])) {
		$ccodes = explode('|', $shipping_options["cpc"]["param00"]);
		foreach ($ccodes as $code)
			$shipping_options['cpc']['options'][$code] = 1;
	}

	if (is_numeric($shipping_options[strtolower($carrier)]["param07"]))
		$shipping_options[strtolower($carrier)]['coverage_fixed_value'] = 'Y';

	if (is_numeric($shipping_options[strtolower($carrier)]["param02"]))
		$shipping_options[strtolower($carrier)]['cod_fixed_value'] = 'Y';
}

if ($carrier == 'FDX') {
	if (!empty($shipping_options['fdx']['carrier_codes'])) {
		$ccodes = explode('|', $shipping_options["fdx"]["carrier_codes"]);
		$shipping_options['fdx']['carrier_codes'] = array();
		foreach ($ccodes as $code)
			$shipping_options['fdx']['carrier_codes'][$code] = 1;
	}
}

$template['carriers'] = $carriers;
$template['carrier'] = $carrier;

$template['head_title'] = lng('Shipping options').' :: '.$template['head_title'];
$template['location'] .= ' &gt; <a href="'.$current_location.'/admin/shipping">'.lng('Shipping methods').'</a> &gt; '.lng('Shipping methods configuration');
$template['shipping_options'] = $shipping_options;

$template['page'] = get_template_contents('admin/pages/shipping_options.php');
$template['css'][] = 'admin_shipping';
$template['js'][] = 'admin_shipping';