<ul class="admin-tabs">
<li><a href="<?php echo $current_location;?>/admin/shipping">Shipping methods</a></li>
<li><a href="<?php echo $current_location;?>/admin/shipping?mode=add_realtime_methods">Manage realtime shipping methods</a></li>
<li class="active"><a href="javascript: void(0);">Shipping options</a></li>
<li><a href="<?php echo $current_location;?>/admin/shipping_charges">Shipping charges</a></li>
</ul>
<br />

<h1>Shipping options</h1>

Select service:
<?php 
foreach ($carriers as $c) {
	if ($c['0'] == $carrier)
		echo '<b>'.$c['1'].'</b> &nbsp;  &nbsp; ';
	else 
		echo '<a href="'.$current_location.'/admin/shipping_options?carrier='.$c['0'].'">'.$c['1'].'</a>  &nbsp;  &nbsp; ';
}
?>
<br /><br />

<?php 
if ($carrier == "FDX") {
	if ($config['Shipping']['FEDEX_account_number'] != '' && $config['Shipping']['FEDEX_meter_number'] != '') {
?>
<br />
<br />

Specify the options that will be used for getting shipping rates from FedEx:

<br />
<br />

<form method="post">
<input type="hidden" name="carrier" value="FDX" />

<table cellpadding="3" cellspacing="1" width="100%">

<tr>
  <td width="30%"><b>Carrier type:</b></td>
  <td width="70%">
    <select name="carrier_codes[]" multiple="multiple">
      <option value="FDXE"<?php  if ($shipping_options['fdx']['carrier_codes']['FDXE']) echo 'selected="selected"'; ?>>FedEx Express (FDXE)</option>
      <option value="FDXG"<?php  if ($shipping_options['fdx']['carrier_codes']['FDXG']) echo 'selected="selected"'; ?>>FedEx Ground (FDXG)</option>
      <option value="FXSP"<?php  if ($shipping_options['fdx']['carrier_codes']['FXSP']) echo 'selected="selected"'; ?>>FedEx SmartPost (FXSP)</option>
    </select>
  </td>
</tr>

<tr>
  <td><b>Packaging:</b></td>
  <td>
  <select name="packaging">
    <option value="FEDEX_ENVELOPE"<?php  if ($shipping_options['fdx']['packaging'] == "FEDEX_ENVELOPE") echo 'selected="selected"'; ?>>FedEx Envelope</option>
    <option value="FEDEX_PAK"<?php  if ($shipping_options['fdx']['packaging'] == "FEDEX_PAK") echo 'selected="selected"'; ?>>FedEx Pak</option>
    <option value="FEDEX_BOX"<?php  if ($shipping_options['fdx']['packaging'] == "FEDEX_BOX") echo 'selected="selected"'; ?>>FedEx Box</option>
    <option value="FEDEX_TUBE"<?php  if ($shipping_options['fdx']['packaging'] == "FEDEX_TUBE") echo 'selected="selected"'; ?>>FedEx Tube</option>
    <option value="FEDEX_10KG_BOX"<?php  if ($shipping_options['fdx']['packaging'] == "FEDEX_10KG_BOX") echo 'selected="selected"'; ?>>FedEx 10Kg Box</option>
    <option value="FEDEX_25KG_BOX"<?php  if ($shipping_options['fdx']['packaging'] == "FEDEX_25KG_BOX") echo 'selected="selected"'; ?>>FedEx 25Kg Box</option>
    <option value="YOUR_PACKAGING"<?php  if ($shipping_options['fdx']['packaging'] == "YOUR_PACKAGING") echo 'selected="selected"'; ?>>My packaging</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Dropoff type:</b></td>
  <td>
  <select name="dropoff_type">
    <option value="REGULAR_PICKUP"<?php  if ($shipping_options['fdx']['dropoff_type'] == "REGULAR_PICKUP") echo 'selected="selected"'; ?>>Regular pickup</option>
    <option value="REQUEST_COURIER"<?php  if ($shipping_options['fdx']['dropoff_type'] == "REQUEST_COURIER") echo 'selected="selected"'; ?>>Request courier</option>
    <option value="DROP_BOX"<?php  if ($shipping_options['fdx']['dropoff_type'] == "DROP_BOX") echo 'selected="selected"'; ?>>Drop box</option>
    <option value="BUSINESS_SERVICE_CENTER"<?php  if ($shipping_options['fdx']['dropoff_type'] == "BUSINESS_SERVICE_CENTER") echo 'selected="selected"'; ?>>Business Service Center</option>
    <option value="STATION"<?php  if ($shipping_options['fdx']['dropoff_type'] == "STATION") echo 'selected="selected"'; ?>>Station</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Ship date (days):</b></td>
  <td>
  <select name="ship_date">
<?php 
	for ($i = 0; $i < 11; $i++)
		echo '<option value="'.$i.'"'.($i == $shipping_options['fdx']['ship_date'] ? ' selected="selected"' : '').'>'.$i.'</option>';
?>
    {/section}
  </select>
  </td>
</tr>

<tr>
    <td><b>Currency:</b></td>
    <td>
        <select name="currency_code">
          <option value="USD"<?php  if ($shipping_options['fdx']['currency_code'] == "USD") echo 'selected="selected"'; ?>>U.S. Dollars (USD)</option>
          <option value="CAD"<?php  if ($shipping_options['fdx']['currency_code'] == "CAD") echo 'selected="selected"'; ?>>Canadian Dollars (CAD)</option>
          <option value="EUR"<?php  if ($shipping_options['fdx']['currency_code'] == "EUR") echo 'selected="selected"'; ?>>European Currency Unit (EUR)</option>
          <option value="JYE"<?php  if ($shipping_options['fdx']['currency_code'] == "JYE") echo 'selected="selected"'; ?>>Japanese Yen (JYE)</option>
          <option value="UKL"<?php  if ($shipping_options['fdx']['currency_code'] == "UKL") echo 'selected="selected"'; ?>>British Pounds (UKL)</option>
          <option value="NOK"<?php  if ($shipping_options['fdx']['currency_code'] == "NOK") echo 'selected="selected"'; ?>>Norwegian Kronen (NOK)</option>
          <option value="AUD"<?php  if ($shipping_options['fdx']['currency_code'] == "AUD") echo 'selected="selected"'; ?>>Australian Dollars (AUD)</option>
          <option value="HKD"<?php  if ($shipping_options['fdx']['currency_code'] == "HKD") echo 'selected="selected"'; ?>>Hong Kong Dollars (HKD)</option>
          <option value="NTD"<?php  if ($shipping_options['fdx']['currency_code'] == "NTD") echo 'selected="selected"'; ?>>New Taiwan Dollars (NTD)</option>
          <option value="SID"<?php  if ($shipping_options['fdx']['currency_code'] == "SID") echo 'selected="selected"'; ?>>Singapore Dollars (SID)</option>
          <option value="ANG"<?php  if ($shipping_options['fdx']['currency_code'] == "ANG") echo 'selected="selected"'; ?>>Antilles Guilder (ANG)</option>
          <option value="RDD"<?php  if ($shipping_options['fdx']['currency_code'] == "RDD") echo 'selected="selected"'; ?>>Dominican Peso (RDD)</option>
          <option value="ARN"<?php  if ($shipping_options['fdx']['currency_code'] == "ARN") echo 'selected="selected"'; ?>>Argentina Peso (ARN)</option>
          <option value="ECD"<?php  if ($shipping_options['fdx']['currency_code'] == "ECD") echo 'selected="selected"'; ?>>E. Caribbean Dollars (ECD)</option>
          <option value="PKR"<?php  if ($shipping_options['fdx']['currency_code'] == "PKR") echo 'selected="selected"'; ?>>Pakistan Rupee (PKR)</option>
          <option value="AWG"<?php  if ($shipping_options['fdx']['currency_code'] == "AWG") echo 'selected="selected"'; ?>>Aruban Florins (AWG)</option>
          <option value="EGP"<?php  if ($shipping_options['fdx']['currency_code'] == "EGP") echo 'selected="selected"'; ?>>Egyptian Pound (EGP)</option>
          <option value="PHP"<?php  if ($shipping_options['fdx']['currency_code'] == "PHP") echo 'selected="selected"'; ?>>Philippine Pesos (PHP)</option>
          <option value="SAR"<?php  if ($shipping_options['fdx']['currency_code'] == "SAR") echo 'selected="selected"'; ?>>Saudi Arabian Riyals (SAR)</option>
          <option value="BHD"<?php  if ($shipping_options['fdx']['currency_code'] == "BHD") echo 'selected="selected"'; ?>>Bahraini Dinars (BHD)</option>
          <option value="BBD"<?php  if ($shipping_options['fdx']['currency_code'] == "BBD") echo 'selected="selected"'; ?>>Barbados Dollars (BBD)</option>
          <option value="INR"<?php  if ($shipping_options['fdx']['currency_code'] == "INR") echo 'selected="selected"'; ?>>Indian Rupees (INR)</option>
          <option value="WON"<?php  if ($shipping_options['fdx']['currency_code'] == "WON") echo 'selected="selected"'; ?>>South Korea Won (WON)</option>
          <option value="BMD"<?php  if ($shipping_options['fdx']['currency_code'] == "BMD") echo 'selected="selected"'; ?>>Bermuda Dollars (BMD)</option>
          <option value="JAD"<?php  if ($shipping_options['fdx']['currency_code'] == "JAD") echo 'selected="selected"'; ?>>Jamaican Dollars (JAD)</option>
          <option value="SEK"<?php  if ($shipping_options['fdx']['currency_code'] == "SEK") echo 'selected="selected"'; ?>>Swedish Krona (SEK)</option>
          <option value="BRL"<?php  if ($shipping_options['fdx']['currency_code'] == "BRL") echo 'selected="selected"'; ?>>Brazil Real (BRL)</option>
          <option value="SFR"<?php  if ($shipping_options['fdx']['currency_code'] == "SFR") echo 'selected="selected"'; ?>>Swiss Francs (SFR)</option>
          <option value="KUD"<?php  if ($shipping_options['fdx']['currency_code'] == "KUD") echo 'selected="selected"'; ?>>Kuwaiti Dinars (KUD)</option>
          <option value="THB"<?php  if ($shipping_options['fdx']['currency_code'] == "THB") echo 'selected="selected"'; ?>>Thailand Baht (THB)</option>
          <option value="BND"<?php  if ($shipping_options['fdx']['currency_code'] == "BND") echo 'selected="selected"'; ?>>Brunei Dollar (BND)</option>
          <option value="MOP"<?php  if ($shipping_options['fdx']['currency_code'] == "MOP") echo 'selected="selected"'; ?>>Macau Patacas (MOP)</option>
          <option value="TTD"<?php  if ($shipping_options['fdx']['currency_code'] == "TTD") echo 'selected="selected"'; ?>>Trinidad &amp; Tobago Dollars (TTD)</option>
          <option value="MYR"<?php  if ($shipping_options['fdx']['currency_code'] == "MYR") echo 'selected="selected"'; ?>>Malaysian Ringgits (MYR)</option>
          <option value="TRY"<?php  if ($shipping_options['fdx']['currency_code'] == "TRY") echo 'selected="selected"'; ?>>Turkish Lira (TRY)</option>
          <option value="CHP"<?php  if ($shipping_options['fdx']['currency_code'] == "CHP") echo 'selected="selected"'; ?>>Chilean Pesos (CHP)</option>
          <option value="UAE"<?php  if ($shipping_options['fdx']['currency_code'] == "UAE") echo 'selected="selected"'; ?>>Mexican Pesos	NMP (UAE)</option>
          <option value="DHS"<?php  if ($shipping_options['fdx']['currency_code'] == "DHS") echo 'selected="selected"'; ?>>Dirhams (DHS)</option>
          <option value="CNY"<?php  if ($shipping_options['fdx']['currency_code'] == "CNY") echo 'selected="selected"'; ?>>Chinese Renminbi (CNY)</option>
          <option value="DKK"<?php  if ($shipping_options['fdx']['currency_code'] == "DKK") echo 'selected="selected"'; ?>>Denmark Krone (DKK)</option>
          <option value="NZD"<?php  if ($shipping_options['fdx']['currency_code'] == "NZD") echo 'selected="selected"'; ?>>New Zealand Dollars (NZD)</option>
          <option value="VEF"<?php  if ($shipping_options['fdx']['currency_code'] == "VEF") echo 'selected="selected"'; ?>>Venezuela Bolivar (VEF)</option>
        </select>
    </td>
</tr>

<tr>
    <td colspan="2"><br /><h3>Package limits</h3></td>
</tr>

<tr>
    <td colspan="2">The settings "Maximum package weight" and "Maximum package dimensions" define the maximum weight and size of the shipping package that you do not wish to be exceeded when products are shipped to customers. If the total weight and/or volume of the products ordered by a customer exceed the limitations defined by these settings, and the checkbox "Split the shipment into multiple packages" is selected, the shipment is split into several packages. <br />
Please note that the maximum package weight and maximum package dimensions that you set on this page must not exceed the actual limitations imposed by FedEx service. <br />
If you set the maximum package weight or any of the maximum package dimension values to zero, X-Cart will use the default limitations established by FedEx.</td>
</tr>

<tr>
  <td>
    <b>Maximum package weight (<?php  echo $config['General']['weight_symbol']; ?>):</b>
  </td>
  <td nowrap="nowrap">
    <input type="text" name="max_weight" value="<?php  echo $shipping_options['fdx']['max_weight']; ?>" size="7" />
  </td>
</tr>

<tr>
  <td><b>Maximum package dimensions (<?php  echo $config['General']['dimensions_symbol']; ?>):</b></td>
  <td nowrap="nowrap">
    <table cellpadding="0" cellspacing="1" border="0">
    <tr>
      <td>Length</td>
      <td></td>
      <td>Width</td>
      <td></td>
      <td>Height</td>
    </tr>
    <tr>
      <td><input type="text" name="dim_length" value="<?php  echo $shipping_options['fdx']['dim_length']; ?>" size="6" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="dim_width" value="<?php  echo $shipping_options['fdx']['dim_width']; ?>" size="6" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="dim_height" value="<?php  echo $shipping_options['fdx']['dim_height']; ?>" size="6" /></td>
    </tr>
    </table>
  </td>
</tr>

<tr>
  <td><label for="param01"><b>Split the shipment into multiple packages if its weight/dimensions exceed the limitations:</b></label></td>
  <td><input type="checkbox" name="param01" id="param01" value="Y"<?php  if ($shipping_options['fdx']['param01'] == "Y" or !$shipping_options.fdx) echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td><label for="param02"><b>Always use the same package dimensions as specified in the "Maximum package dimensions" fields:</b></label></td>
  <td><input type="checkbox" name="param02" id="param02" value="Y"<?php  if ($shipping_options['fdx']['param02'] == "Y") echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
    <td colspan="2"><br /><h3>COD</h3></td>
</tr>

<tr>
    <td><b>COD value (<?php  echo $shipping_options['fdx']['currency_code'] ? $shipping_options['fdx']['currency_code'] : 'USD'; ?>):</b></td>
    <td>
        <input type="text" name="cod_value" value="<?php  echo $shipping_options['fdx']['cod_value'] ? $shipping_options['fdx']['cod_value'] : '0.00'; ?>" />
    </td>
</tr>

<tr>
    <td><b>COD type:</b></td>
    <td>
        <select name="cod_type">
      <option value="ANY"<?php  if ($shipping_options['fdx']['cod_type'] == "ANY") echo 'selected="selected"'; ?>>Any</option>
      <option value="GUARANTEED_FUNDS"<?php  if ($shipping_options['fdx']['cod_type'] == "GUARANTEED_FUNDS") echo 'selected="selected"'; ?>>Guaranteed funds</option>
      <option value="CASH"<?php  if ($shipping_options['fdx']['cod_type'] == "CASH") echo 'selected="selected"'; ?>>Cash</option>
        </select>
    </td>
</tr>

<tr>
    <td colspan="2"><br /><h3>Special services</h3></td>
</tr>

<tr>
  <td><b>Dangerous Goods/Accessibility:</b></td>
  <td>
  <select name="dg_accessibility">
    <option value=""<?php  if ($shipping_options['fdx']['dg_accessibility'] == "") echo 'selected="selected"'; ?>>&nbsp;</option>
    <option value="ACCESSIBLE"<?php  if ($shipping_options['fdx']['dg_accessibility'] == "ACCESSIBLE") echo 'selected="selected"'; ?>>Accessible dangerous goods</option>
    <option value="INACCESSIBLE"<?php  if ($shipping_options['fdx']['dg_accessibility'] == "INACCESSIBLE") echo 'selected="selected"'; ?>>Inaccessible dangerous goods</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Signature option:</b></td>
  <td>
  <select name="signature">
    <option value=""<?php  if ($shipping_options['fdx']['signature'] == "") echo 'selected="selected"'; ?>>&nbsp;</option>
    <option value="NO_SIGNATURE_REQUIRED"<?php  if ($shipping_options['fdx']['signature'] == "NO_SIGNATURE_REQUIRED") echo 'selected="selected"'; ?>>No signature</option>
    <option value="INDIRECT"<?php  if ($shipping_options['fdx']['signature'] == "INDIRECT") echo 'selected="selected"'; ?>>Indirect signature required</option>
    <option value="DIRECT"<?php  if ($shipping_options['fdx']['signature'] == "DIRECT") echo 'selected="selected"'; ?>>Direct signature required</option>
    <option value="ADULT"<?php  if ($shipping_options['fdx']['signature'] == "ADULT") echo 'selected="selected"'; ?>>Adult signature required</option>
  </select>
  </td>
</tr>

<tr>
  <td colspan="2">

  <table cellpadding="3" cellspacing="1">

  <tr>
    <td width="10"><input type="checkbox" name="dry_ice" id="dry_ice" value="Y"<?php  if ($shipping_options['fdx']['dry_ice'] == "Y") echo ' checked="checked"'; ?> /></td>
    <td width="50%"><b><label for="dry_ice">Shipment contains dry ice</label></b></td>
    <td width="20">&nbsp;</td>
    <td width="10"><input type="checkbox" name="hold_at_location" id="hold_at_location" value="Y"<?php  if ($shipping_options['fdx']['hold_at_location'] == "Y") echo ' checked="checked"'; ?> /></td>
    <td width="50%"><b><label for="hold_at_location">Shipment is Hold at Location</label></b></td>
  </tr>

  <tr>
    <td><input type="checkbox" name="inside_pickup" id="inside_pickup" value="Y"<?php  if ($shipping_options['fdx']['inside_pickup'] == "Y") echo ' checked="checked"'; ?> /></td>
    <td><b><label for="inside_pickup">Shipment is Inside Pickup</label></b></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="inside_delivery" id="inside_delivery" value="Y"<?php  if ($shipping_options['fdx']['inside_delivery'] == "Y") echo ' checked="checked"'; ?> /></td>
    <td><b><label for="inside_delivery">Shipment is Inside Delivery</label></b></td>
  </tr>

  <tr>
    <td><input type="checkbox" name="saturday_pickup" id="saturday_pickup" value="Y"<?php  if ($shipping_options['fdx']['saturday_pickup'] == "Y") echo ' checked="checked"'; ?> /></td>
    <td><b><label for="saturday_pickup">Shipment is scheduled for Saturday pickup</label></b></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="saturday_delivery" id="saturday_delivery" value="Y"<?php  if ($shipping_options['fdx']['saturday_delivery'] == "Y") echo ' checked="checked"'; ?> /></td>
    <td><b><label for="saturday_delivery">Shipment is scheduled for Saturday delivery</label></b></td>
  </tr>

  <tr>
    <td valign="top"><input type="checkbox" name="residential_delivery" id="residential_delivery" value="Y"<?php  if ($shipping_options['fdx']['residential_delivery'] == "Y") echo ' checked="checked"'; ?> /></td>
    <td><b><label for="residential_delivery">Shipment is Residential Delivery</label></b>
    </td>
    <td>&nbsp;</td>
    <td valign="top"><input type="checkbox" name="nonstandard_container" id="nonstandard_container" value="Y"<?php  if ($shipping_options['fdx']['nonstandard_container'] == "Y") echo ' checked="checked"'; ?> /></td>
    <td valign="top"><b><label for="nonstandard_container">Nonstandard container is used for a shipment</label></b></td>
  </tr>

  </table>

  </td>
</tr>

<tr>
    <td colspan="2"><br /><h3>Additional charges</td>
</tr>

<tr>
  <td><label for="send_insured_value"><b>Send package cost to calculate insurance:</b></label></td>
  <td><input type="checkbox" name="send_insured_value" id="send_insured_value" value="Y"<?php  if ($shipping_options['fdx']['send_insured_value'] == "Y" || !$shipping_options['fdx']) echo ' checked="checked"'; ?> />
</td>
</tr>

<tr>
  <td><b>Handling charge amount:</b></td>
  <td>
  <input type="text" size="10" maxlength="10" name="handling_charges_amount" value="<?php  echo $shipping_options['fdx']['handling_charges_amount'] ? $shipping_options['fdx']['handling_charges_amount'] : '0.00'; ?>" />
  <select name="handling_charges_type">
    <option value="FIXED_AMOUNT"<?php  if ($shipping_options['fdx']['handling_charges_type'] == "FIXED_AMOUNT") echo 'selected="selected"'; ?>><?php  echo $shipping_options['fdx']['currency_code'] ? $shipping_options['fdx']['currency_code'] : 'USD'; ?></option>
    <option value="PERCENTAGE_OF_NET_FREIGHT"<?php  if ($shipping_options['fdx']['handling_charges_type'] == "PERCENTAGE_OF_NET_FREIGHT") echo 'selected="selected"'; ?>>% of base</option>
    <option value="PERCENTAGE_OF_NET_CHARGE"<?php  if ($shipping_options['fdx']['handling_charges_type'] == "PERCENTAGE_OF_NET_CHARGE") echo 'selected="selected"'; ?>>% of net</option>
    <option value="PERCENTAGE_OF_NET_CHARGE_EXCLUDING_TAXES"<?php  if ($shipping_options['fdx']['handling_charges_type'] == "PERCENTAGE_OF_NET_CHARGE_EXCLUDING_TAXES") echo 'selected="selected"'; ?>>% of net (excluding taxes)</option>
  </select>
  </td>
</tr>

<tr>
    <td colspan="2"><br /><h3>SmartPost Shipping settings</h3></td>
</tr>

<tr>
  <td><label for="add_smartpost_detail"><b>Add SmartPost Shipping data to request:</b></label></td>
  <td><input type="checkbox" name="add_smartpost_detail" id="add_smartpost_detail" value="Y"<?php  if ($shipping_options['fdx']['add_smartpost_detail'] == "Y") echo ' checked="checked"'; ?> onclick="javascript:  $('.smartpost_block').css('display', (this.checked ? '': 'none')); "/>
</td>
</tr>

<tr <?php  if ($shipping_options['fdx']['add_smartpost_detail'] != "Y") echo ' style="display: none;"'; ?> class="smartpost_block">
  <td><b>Specify the indicia type:</b></td>
  <td>
  <select name="smartpost_indicia">
    <option value="MEDIA_MAIL"<?php  if ($shipping_options['fdx']['smartpost_indicia'] == "MEDIA_MAIL") echo 'selected="selected"'; ?>>MEDIA_MAIL</option>
    <option value="PARCEL_RETURN"<?php  if ($shipping_options['fdx']['smartpost_indicia'] == "PARCEL_RETURN") echo 'selected="selected"'; ?>>PARCEL_RETURN</option>
    <option value="PARCEL_SELECT"<?php  if ($shipping_options['fdx']['smartpost_indicia'] == "PARCEL_SELECT") echo 'selected="selected"'; ?>>PARCEL_SELECT</option>
    <option value="PRESORTED_BOUND_PRINTED_MATTER"<?php  if ($shipping_options['fdx']['smartpost_indicia'] == "PRESORTED_BOUND_PRINTED_MATTER") echo 'selected="selected"'; ?>>PRESORTED_BOUND_PRINTED_MATTER</option>
    <option value="PRESORTED_STANDARD"<?php  if ($shipping_options['fdx']['smartpost_indicia'] == "PRESORTED_STANDARD") echo 'selected="selected"'; ?>>PRESORTED_STANDARD</option>
  </select>
  </td>
</tr>

<tr <?php  if ($shipping_options['fdx']['add_smartpost_detail'] != "Y") echo ' style="display: none;"'; ?> class="smartpost_block">
  <td><b>Specify an endorsement type:</b></td>
  <td>
  <select name="smartpost_ancillaryendorsement">
    <option value=""<?php  if ($shipping_options['fdx']['smartpost_ancillaryendorsement'] == "") echo 'selected="selected"'; ?>>&nbsp;</option>
    <option value="ADDRESS_CORRECTION"<?php  if ($shipping_options['fdx']['smartpost_ancillaryendorsement'] == "ADDRESS_CORRECTION") echo 'selected="selected"'; ?>>ADDRESS_CORRECTION</option>
    <option value="CARRIER_LEAVE_IF_NO_RESPONSE"<?php  if ($shipping_options['fdx']['smartpost_ancillaryendorsement'] == "CARRIER_LEAVE_IF_NO_RESPONSE") echo 'selected="selected"'; ?>>CARRIER_LEAVE_IF_NO_RESPONSE</option>
    <option value="CHANGE_SERVICE"<?php  if ($shipping_options['fdx']['smartpost_ancillaryendorsement'] == "CHANGE_SERVICE") echo 'selected="selected"'; ?>>CHANGE_SERVICE</option>
    <option value="FORWARDING_SERVICE"<?php  if ($shipping_options['fdx']['smartpost_ancillaryendorsement'] == "FORWARDING_SERVICE") echo 'selected="selected"'; ?>>FORWARDING_SERVICE</option>
    <option value="RETURN_SERVICE"<?php  if ($shipping_options['fdx']['smartpost_ancillaryendorsement'] == "RETURN_SERVICE") echo 'selected="selected"'; ?>>RETURN_SERVICE</option>
  </select>
  </td>
</tr>

<tr<?php  if ($shipping_options['fdx']['add_smartpost_detail'] != "Y") echo ' style="display: none;"';?> class="smartpost_block">
  <td><b>Specify the HubID:</b></td>
  <td>
  <select name="smartpost_hubid">
    <option value="5303"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5303") echo 'selected="selected"'; ?>>Atlanta ATGA (5303)</option>
    <option value="5281"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5281") echo 'selected="selected"'; ?>>Charlotte CHNC (5281)</option>
    <option value="5602"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5602") echo 'selected="selected"'; ?>>Chicago CIIL (5602)</option>
    <option value="5929"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5929") echo 'selected="selected"'; ?>>Chino COCA (5929)</option>
    <option value="5751"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5751") echo 'selected="selected"'; ?>>Dallas DLTX (5751)</option>
    <option value="5802"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5802") echo 'selected="selected"'; ?>>Denver DNCO (5802)</option>
    <option value="5481"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5481") echo 'selected="selected"'; ?>>Detroit DTMI (5481)</option>
    <option value="5087"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5087") echo 'selected="selected"'; ?>>Edison EDNJ (5087)</option>
    <option value="5431"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5431") echo 'selected="selected"'; ?>>Grove City GCOH (5431)</option>
    <option value="5771"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5771") echo 'selected="selected"'; ?>>Houston HOTX (5771)</option>
    <option value="5465"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5465") echo 'selected="selected"'; ?>>Indianapolis ININ (5465)</option>
    <option value="5648"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5648") echo 'selected="selected"'; ?>>Kansas City KCKS (5648)</option>
    <option value="5902"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5902") echo 'selected="selected"'; ?>>Los Angeles LACA (5902)</option>
    <option value="5254"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5254") echo 'selected="selected"'; ?>>Martinsburg MAWV (5254)</option>
    <option value="5379"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5379") echo 'selected="selected"'; ?>>Memphis METN (5379)</option>
    <option value="5552"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5552") echo 'selected="selected"'; ?>>Minneapolis MPMN (5552)</option>
    <option value="5531"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5531") echo 'selected="selected"'; ?>>New Berlin NBWI (5531)</option>
    <option value="5110"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5110") echo 'selected="selected"'; ?>>Newburgh NENY (5110)</option>
    <option value="5015"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5015") echo 'selected="selected"'; ?>>Northborough NOMA (5015)</option>
    <option value="5327"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5327") echo 'selected="selected"'; ?>>Orlando ORFL (5327)</option>
    <option value="5194"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5194") echo 'selected="selected"'; ?>>Philadelphia PHPA (5194)</option>
    <option value="5854"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5854") echo 'selected="selected"'; ?>>Phoenix PHAZ (5854)</option>
    <option value="5150"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5150") echo 'selected="selected"'; ?>>Pittsburgh PTPA (5150)</option>
    <option value="5958"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5958") echo 'selected="selected"'; ?>>Sacramento SACA (5958)</option>
    <option value="5843"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5843") echo 'selected="selected"'; ?>>Salt Lake City SCUT (5843)</option>
    <option value="5983"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5983") echo 'selected="selected"'; ?>>Seattle SEWA (5983)</option>
    <option value="5631"<?php  if ($shipping_options['fdx']['smartpost_hubid'] == "5631") echo 'selected="selected"'; ?>>St. Louis STMO (5631)</option>
  </select>
  </td>
</tr>

</table>

<br />
<br />

<button type="submit" name="update_options"><?php echo $lng.lbl_apply|escape;?></button>

</form>

<?php 
	} else  {
?>
<a href="<?php echo $current_location;?>/admin/configuration/Shipping">Fedex is not enabled</a>

<br />
<br />

<?php 
	}
}

if ($carrier == "USPS") {
?>

<form method="post">
<input type="hidden" name="carrier" value="USPS" />

<table cellpadding="3" cellspacing="1" width="100%">

<!-- Package limits -->

<tr>
    <td colspan="2"><br /><h3>Package limits</h3></td>
</tr>

<tr>
  <td><label for="param11"><b>Split the shipment into multiple packages if its weight/dimensions exceed the limitations:</b></label></td>
  <td><input type="checkbox" name="param11" id="param11" value="Y"<?php  if ($shipper_options['usps']['param11'] == "Y" || !$shipper_options['usps']['param11']) echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td><b>Maximum package weight (<?php  echo $config['General']['weight_symbol']; ?>)*:</b></td>
  <td>
    <input type="text" name="max_weight" size="6" value="<?php  echo $shipper_options['usps']['param08']; ?>"/>
   </td>
</tr>

<tr>
  <td><b>Maximum package dimensions (<?php  echo $config['General']['dimensions_symbol']; ?>)*:</b></td>
  <td nowrap="nowrap">
    <table cellpadding="0" cellspacing="1" border="0">
    <tr>
      <td>Length</td>
      <td></td>
      <td>Width</td>
      <td></td>
      <td>Height</td>
    </tr>
    <tr>
      <td><input type="text" name="dim_length" size="6" value="<?php  echo $shipper_options['usps']['dim_length']; ?>"/></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="dim_width" size="6" value="<?php  echo $shipper_options['usps']['dim_width']; ?>" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="dim_height" size="6" value="<?php  echo $shipper_options['usps']['dim_height']; ?>"/></td>
    </tr>
    </table>
  </td>
</tr>

<tr>
  <td><label for="use_maximum_dimensions"><b>Always use the same package dimensions as specified in the "Maximum package dimensions" fields:</b></label></td>
  <td><input type="checkbox" name="use_maximum_dimensions" id="use_maximum_dimensions" value="Y"<?php  if ($shipper_options['usps']['param09'] == "Y") echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td colspan="2"><b>*</b> The settings "Maximum package weight" and "Maximum package dimensions" define the maximum weight and size of the shipping package that you do not wish to be exceeded when products are shipped to customers. If the total weight and/or volume of the products ordered by a customer exceed the limitations defined by these settings, and the checkbox "Split the shipment into multiple packages" is selected, the shipment is split into several packages. <br />
Please note that the maximum package weight and maximum package dimensions that you set on this page must not exceed the actual limitations imposed by <?php  echo $shipper; ?> service. <br />
If you set the maximum package weight or any of the maximum package dimension values to zero, X-Cart will use the default limitations established by <?php  echo $shipper; ?>.</td>
</tr>
<!-- End package limits -->
<tr>
  <td><b>Girth (required for non-rectangular Priority Mail large pieces) (<?php  echo $config['General']['dimensions_symbol']; ?>):</b></td>
  <td nowrap="nowrap">
<input type="text" name="dim_girth" value="<?php  echo escape($shipping_options['usps']['dim_girth'], 2); ?>" size="7" />
  </td>
</tr>

<tr>
  <td colspan="2"><hr /></td>
</tr>

<tr>
  <td><label for="status_new_method"><b>Automatically enable new shipping methods from shipping server response:</b></label></td>
  <td><input type="checkbox" name="status_new_method" id="status_new_method" value="new_method_is_enabled"<?php  if ($shipping_options['usps']['param01'] == "new_method_is_enabled") echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td><b>Shipping cost conversion rate:</b><br />
  <small>The shipping cost is always returned in US Dollars. So you need to specify the conversion rate to convert the shipping cost returned by shipping service into the necessary currency.</small>
  </td>
  <td valign="top"><input type="text" name="currency_rate" size="10" value="<?php  echo escape($shipping_options['usps']['currency_rate'], 2); ?>" /></td>
</tr>

<tr>
  <td colspan="2"><hr /></td>
</tr>

<tr>
  <td colspan="2"><h3>International U.S.P.S.</h3></td>
</tr>

<tr>
  <td width="50%"><b>Type of mail:</b></td>
  <td>
  <select name="mailtype">
    <option value="All"<?php  if ($shipping_options['usps']['mailtype'] == "All") echo 'selected="selected"'; ?>>All</option>
    <option value="Package"<?php  if ($shipping_options['usps']['mailtype'] == "Package") echo 'selected="selected"'; ?>>Package</option>
    <option value="Postcards or aerogrammes"<?php  if ($shipping_options['usps']['mailtype'] == "Postcards or aerogrammes") echo 'selected="selected"'; ?>>Postcards or Aerogrammes</option>
    <option value="Envelope"<?php  if ($shipping_options['usps']['mailtype'] == "Envelope") echo 'selected="selected"'; ?>>Envelope</option>
    <option value="LargeEnvelope"<?php  if ($shipping_options['usps']['mailtype'] == "LargeEnvelope") echo 'selected="selected"'; ?>>Large Envelope</option>
    <option value="FlatRate"<?php  if ($shipping_options['usps']['mailtype'] == "FlatRate") echo 'selected="selected"'; ?>>Flat Rate</option>
  </select>
  </td>
</tr>

<!-- Value of contents -->
<script type="text/javascript">
$(document).ready( function() {
  $('#value_of_content_type').bind("change", function(event){
    $('#value_of_content_fixed').toggle(this.value == 'fixed_value');
  })
});
</script>

<tr>
  <td width="50%"><b><?php echo $lng_label;?>:</b></td>
  <td>
  <select name="value_of_content_type" id="value_of_content_type">
    <option value="150%"{if $shipper_options.usps.param07 == "150%") echo 'selected="selected"'; ?>>150% of order total150</option>
    <option value="140%"{if $shipper_options.usps.param07 == "140%") echo 'selected="selected"'; ?>>140% of order total140</option>
    <option value="130%"{if $shipper_options.usps.param07 == "130%") echo 'selected="selected"'; ?>>130% of order total130</option>
    <option value="120%"{if $shipper_options.usps.param07 == "120%") echo 'selected="selected"'; ?>>120% of order total120</option>
    <option value="110%"{if $shipper_options.usps.param07 == "110%") echo 'selected="selected"'; ?>>110% of order total110</option>
    <option value="100%"{if $shipper_options.usps.param07 == "100%") echo 'selected="selected"'; ?>>100% of order total100</option>
    <option value="90%"{if $shipper_options.usps.param07 == "90%") echo 'selected="selected"'; ?>>90% of order total90</option>
    <option value="80%"{if $shipper_options.usps.param07 == "80%") echo 'selected="selected"'; ?>>80% of order total80</option>
    <option value="70%"{if $shipper_options.usps.param07 == "70%") echo 'selected="selected"'; ?>>70% of order total70</option>
    <option value="60%"{if $shipper_options.usps.param07 == "60%") echo 'selected="selected"'; ?>>60% of order total60</option>
    <option value="50%"{if $shipper_options.usps.param07 == "50%") echo 'selected="selected"'; ?>>50% of order total50</option>
    <option value="40%"{if $shipper_options.usps.param07 == "40%") echo 'selected="selected"'; ?>>40% of order total40</option>
    <option value="30%"{if $shipper_options.usps.param07 == "30%") echo 'selected="selected"'; ?>>30% of order total30</option>
    <option value="20%"{if $shipper_options.usps.param07 == "20%") echo 'selected="selected"'; ?>>20% of order total20</option>
    <option value="10%"{if $shipper_options.usps.param07 == "10%") echo 'selected="selected"'; ?>>10% of order total</option>
    <option value="disabled"<?php if ($shipper_options.usps.param07 == "disabled" or !$shipper_options.usps.param07) echo 'selected="selected"'; ?>>{lng[Disabled]) {?></option>
    <option value="fixed_value"<?php if ($shipper_options.usps.fixed_value == "Y") echo 'selected="selected"'; ?>>{lng[Fixed value]) {?></option>
  </select>
    <input type="text" name="value_of_content_fixed" id="value_of_content_fixed" size="10"<?php  if ($shipper_options['usps']['fixed_value'] != "Y") { echo ' value="0" style="display: none;"'; } else  { ?> value="<?php  echo ($shipper_options['usps']['param07'] ? $shipper_options['usps']['param07'] : '0'); ?>" <?php  } ?>/>
  </td>
</tr>
<!-- End value of contents -->

<tr>
  <td><b>Container (International Rates):</b></td>
  <td>
  <select name="container_intl">
    <option value="RECTANGULAR"<?php  if ($shipping_options['usps']['param10'] == "RECTANGULAR") echo 'selected="selected"'; ?>>Rectangular</option>
    <option value="NONRECTANGULAR"<?php  if ($shipping_options['usps']['param10'] == "NONRECTANGULAR") echo 'selected="selected"'; ?>>Non Rectangular</option>
  </select>
  </td>
</tr>

<tr>
  <td colspan="2"><hr /></td>
</tr>

<tr>
  <td colspan="2"><h3>Domestic U.S.P.S.</h3></td>
</tr>

<tr>
  <td><b>Services:</b></td>
  <td><div style="line-height: 170%;"><a href="javascript: void(0);" onclick="$('#selected_services option').prop('selected', true);">Select all</a></div>
  <select name="selected_services[]" id="selected_services" multiple="multiple" size="<?php  echo count($all_usps_services); ?>">
<?php 
	foreach ($all_usps_services as $sn) {
      echo '<option value="'.$sn.'"'.($shipping_options['usps']['selected_services'][$sn] ? ' selected="selected"' : '').'>'.$sn.'</option>';
	}
?>
  </select>
  </td>
</tr>

<tr>
  <td><b>"Ground Only" indicator for "Standard Post" service:</b></td>
  <td>
  <select name="ground_only">
    <option value="true"<?php  if ($shipping_options['usps']['ground_only'] == "true") echo 'selected="selected"'; ?>>Ground transportation required</option>
    <option value="false"<?php  if ($shipping_options['usps']['ground_only'] == "false") echo 'selected="selected"'; ?>>Ground transportation not required</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Machinable:</b></td>
  <td>
  <select name="machinable">
    <option value="FALSE"<?php  if ($shipping_options['usps']['param02'] == "FALSE") echo 'selected="selected"'; ?>>No</option>
    <option value="TRUE"<?php  if ($shipping_options['usps']['param02'] == "TRUE") echo 'selected="selected"'; ?>>Yes</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Container (Express Mail):</b></td>
  <td>
  <select name="container_express">
    <option value="None">None</option>
    <option value="Flat Rate Box"<?php  if ($shipping_options['usps']['param03'] == "Flat Rate Box") echo 'selected="selected"'; ?>>Express Mail Flat Rate Boxes, 13-5/8" x 11-7/8" x 3-3/8", 11" x 8-1/2" x 5-1/2"</option>
    <option value="Flat Rate Envelope"<?php  if ($shipping_options['usps']['param03'] == "Flat Rate Envelope") echo 'selected="selected"'; ?>>Express Mail Flat Rate Envelope, 12.5 x 9.5</option>
    <option value="Legal Flat Rate Envelope"<?php  if ($shipping_options['usps']['param03'] == "Legal Flat Rate Envelope") echo 'selected="selected"'; ?>>Express Mail Legal Flat Rate Envelope, 15 x 9.5</option>
    <option value="RECTANGULAR"<?php  if ($shipping_options['usps']['param03'] == "RECTANGULAR") echo 'selected="selected"'; ?>>Rectangular (Express Mail Large)</option>
    <option value="NONRECTANGULAR"<?php  if ($shipping_options['usps']['param03'] == "NONRECTANGULAR") echo 'selected="selected"'; ?>>Non Rectangular (Express Mail Large)</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Container (Priority Mail):</b></td>
  <td>
  <select name="container_priority">
    <option value="None">None</option>
    <option value="Flat Rate Envelope"<?php  if ($shipping_options['usps']['param04'] == "Flat Rate Envelope") echo 'selected="selected"'; ?>>Priority Mail Flat Rate Envelope, 12.5 x 9.5</option>
    <option value="Legal Flat Rate Envelope"<?php  if ($shipping_options['usps']['param04'] == "Legal Flat Rate Envelope") echo 'selected="selected"'; ?>>Priority Mail Legal Flat Rate Envelope, 15 x 9.5</option>
    <option value="Padded Flat Rate Envelope"<?php  if ($shipping_options['usps']['param04'] == "Padded Flat Rate Envelope") echo 'selected="selected"'; ?>>Priority Mail Padded Flat Rate Envelope, 12.5 x 9.5</option>
    <option value="GIFT CARD FLAT RATE ENVELOPE"<?php  if ($shipping_options['usps']['param04'] == "GIFT CARD FLAT RATE ENVELOPE") echo 'selected="selected"'; ?>>Priority Mail Gift Card Flat Rate, 10" x 7"</option>
    <option value="SM FLAT RATE ENVELOPE"<?php  if ($shipping_options['usps']['param04'] == "SM FLAT RATE ENVELOPE") echo 'selected="selected"'; ?>>Priority Mail Small Flat Rate Envelope, 10" x 6"</option>
    <option value="WINDOW FLAT RATE ENVELOPE"<?php  if ($shipping_options['usps']['param04'] == "WINDOW FLAT RATE ENVELOPE") echo 'selected="selected"'; ?>>Priority Mail Window Flat Rate Envelope, 10" x 5"</option>
    <option value="SM FLAT RATE BOX"<?php  if ($shipping_options['usps']['param04'] == "SM FLAT RATE BOX") echo 'selected="selected"'; ?>>Priority Mail Small Flat Rate Box, 8-5/8" x 5-3/8" x 1-5/8"</option>
    <option value="MD FLAT RATE BOX"<?php  if ($shipping_options['usps']['param04'] == "MD FLAT RATE BOX") echo 'selected="selected"'; ?>>Priority Mail Medium Flat Rate Boxes, 11" x 8-1/2" x 5-1/2", 13-5/8" x 11-7/8" x 3-3/8"</option>
    <option value="LG FLAT RATE BOX"<?php  if ($shipping_options['usps']['param04'] == "LG FLAT RATE BOX") echo 'selected="selected"'; ?>>Priority Mail Large Flat Rate Boxes, 12" x 12" x 5-1/2", 23-11/16" x 11-3/4" x 3"</option>
    <option value="REGIONALRATEBOXA"<?php  if ($shipping_options['usps']['param04'] == "REGIONALRATEBOXA") echo 'selected="selected"'; ?>>Priority Mail Regional Box A: weight limit 15 lbs.12-13/16"x10-15/16"x2-3/8",10"x7"x4-3/4"</option>
    <option value="REGIONALRATEBOXB"<?php  if ($shipping_options['usps']['param04'] == "REGIONALRATEBOXB") echo 'selected="selected"'; ?>>Priority Mail Regional Box B: weight limit 20 lbs.15-7/8"x14-3/8"x2-7/8",12"x10-1/4"x5"</option>
    <option value="REGIONALRATEBOXC"<?php  if ($shipping_options['usps']['param04'] == "REGIONALRATEBOXC") echo 'selected="selected"'; ?>>Priority Mail Regional Box C: weight limit 25 lbs.14-3/4" x 11-3/4" x 11-1/2"</option>
    <option value="RECTANGULAR"<?php  if ($shipping_options['usps']['param04'] == "RECTANGULAR") echo 'selected="selected"'; ?>>Rectangular (Priority Mail Large)</option>
    <option value="NONRECTANGULAR"<?php  if ($shipping_options['usps']['param04'] == "NONRECTANGULAR") echo 'selected="selected"'; ?>>Non Rectangular (Priority Mail Large)</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>First Class Mail Type:</b></td>
  <td>
  <select name="firstclassmailtype">
    <option value="LETTER"<?php  if ($shipping_options['usps']['param05'] == "LETTER") echo 'selected="selected"'; ?>>Letter</option>
    <option value="FLAT"<?php  if ($shipping_options['usps']['param05'] == "FLAT") echo 'selected="selected"'; ?>>Flat</option>
    <option value="PARCEL"<?php  if ($shipping_options['usps']['param05'] == "PARCEL") echo 'selected="selected"'; ?>>Parcel</option>
    <option value="POSTCARD"<?php  if ($shipping_options['usps']['param05'] == "POSTCARD") echo 'selected="selected"'; ?>>PostCard</option>
    <option value="PACKAGE SERVICE"<?php  if ($shipping_options['usps']['param05'] == "PACKAGE SERVICE") echo 'selected="selected"'; ?>>Package Service</option>
  </select>
  </td>
</tr>

<tr>
  <td colspan="2"><button type="submit">Apply</button></td>
</tr>

</table>
</form>

<?php 
}

if ($carrier == "Intershipper") {
?>

<form method="post">
<input type="hidden" name="carrier" value="Intershipper" />

<table cellpadding="3" cellspacing="1" width="100%">

<tr>
  <td width="40%"><b>Type of delivery:</b></td>
  <td>
  <select name="delivery">
    <option value="COM"<?php  if ($shipping_options['intershipper']['param00'] == "COM") echo 'selected="selected"'; ?>>Commercial delivery</option>
    <option value="RES"<?php  if ($shipping_options['intershipper']['param00'] == "RES") echo 'selected="selected"'; ?>>Residential delivery</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Type of pickup:</b></td>
  <td>
  <select name="shipmethod">
    <option value="DRP"<?php  if ($shipping_options['intershipper']['param01'] == "DRP") echo ' selected="selected"'; ?>>Drop of at carrier location</option>
    <option value="SCD"<?php  if ($shipping_options['intershipper']['param01'] == "SCD") echo ' selected="selected"'; ?>>Regularly Scheduled Pickup</option>
    <option value="PCK"<?php  if ($shipping_options['intershipper']['param01'] == "PCK") echo ' selected="selected"'; ?>>Schedule A Special Pickup</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Package type:</b></td>
  <td>
  <select name="packaging">
    <option value="BOX"<?php  if ($shipping_options['intershipper']['param06'] == "BOX") echo 'selected="selected"'; ?>>Customer-supplied Box</option>
    <option value="CBX"<?php  if ($shipping_options['intershipper']['param06'] == "CBX") echo 'selected="selected"'; ?>>Carrier Box</option>
    <option value="CPK"<?php  if ($shipping_options['intershipper']['param06'] == "CPK") echo 'selected="selected"'; ?>>Carrier Pak</option>
    <option value="ENV"<?php  if ($shipping_options['intershipper']['param06'] == "ENV") echo 'selected="selected"'; ?>>Carrier Envelope</option>
    <option value="MEM"<?php  if ($shipping_options['intershipper']['param06'] == "MEM") echo 'selected="selected"'; ?>>Media Mail</option>
    <option value="TUB"<?php  if ($shipping_options['intershipper']['param06'] == "TUB") echo 'selected="selected"'; ?>>Carrier Tube</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Nature of Shipment Contents:</b></td>
  <td>
  <select name="contents">
    <option value="OTR"<?php  if ($shipping_options['intershipper']['param07'] == "OTR") echo 'selected="selected"'; ?>>Other: Most shipments will use this code</option>
    <option value="LQD"<?php  if ($shipping_options['intershipper']['param07'] == "LQD") echo 'selected="selected"'; ?>>Liquid</option>
    <option value="AHM"<?php  if ($shipping_options['intershipper']['param07'] == "AHM") echo 'selected="selected"'; ?>>Accessible HazMat</option>
    <option value="IHM"<?php  if ($shipping_options['intershipper']['param07'] == "IHM") echo 'selected="selected"'; ?>>Inaccessible HazMat</option>
  </select>
  </td>
</tr>

<tr>
  <td><b>Package CODValue in cents:</b></td>
  <td><input type="text" name="codvalue" size="10" value="<?php  echo escape($shipping_options['intershipper']['param08'], 2); ?>" /></td>
</tr>

<tr>
  <td><b>Optional services:</b></td>
  <td>
    <input type="checkbox" name="options[]" value="ADP" <?php  if ($shipping_options['intershipper']['options']['ADP'] != "") echo ' checked="checked"'; ?>/>Additional Handling<br/>
    <input type="checkbox" name="options[]" value="SDP" <?php  if ($shipping_options['intershipper']['options']['SDP'] != "") echo ' checked="checked"'; ?>/>Saturday Delivery <br/>
    <input type="checkbox" name="options[]" value="PDP" <?php  if ($shipping_options['intershipper']['options']['PDP'] != "") echo ' checked="checked"'; ?>/>Proof of Delivery<br/>
  </td>
</tr>

<tr>
  <td>
    <b>Maximum package weight (<?php  echo $config['General']['weight_symbol']; ?>)*:</b>
  </td>
  <td>
    <input type="text" name="weight" size="6" value="<?php  echo $shipping_options['intershipper']['param09']; ?>"/> (Should not exceed <?php  echo $max_intershipper_weight.' '.$config['General']['weight_symbol']; ?>)
  </td>
</tr>

<tr>
  <td><b>Maximum package dimensions (<?php  echo $config['General']['dimensions_symbol']; ?>)*:</b></td>
  <td>
    <table cellpadding="0" cellspacing="1" border="0">
    <tr>
      <td>Length</td>
      <td></td>
      <td>Width</td>
      <td></td>
      <td>Height</td>
    </tr>
    <tr>
      <td><input type="text" name="length" size="6" value="<?php  echo $shipping_options['intershipper']['param02']; ?>"/></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="width" size="6" value="<?php  echo $shipping_options['intershipper']['param03']; ?>" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="height" size="6" value="<?php  echo $shipping_options['intershipper']['param04']; ?>"/></td>
    </tr>
    </table>
  </td>
</tr>

<tr>
  <td><label for="use_maximum_dimensions"><b>Always use the same package dimensions as specified in the "Maximum package dimensions" fields:</b></label></td>
  <td><input type="checkbox" name="use_maximum_dimensions" id="use_maximum_dimensions" value="Y"<?php  if ($shipping_options['intershipper']['param10'] == "Y") echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td colspan="2"><b>*</b> The settings "Maximum package weight" and "Maximum package dimensions" define the maximum weight and size of the shipping package that you do not wish to be exceeded when products are shipped to customers. If the total weight and/or volume of the products ordered by a customer exceed the limitations defined by these settings, the shipment is split into several packages.<br />
Please note that the maximum package weight and maximum package dimensions that you set on this page must not exceed the actual limitations imposed by InterShipper (currently 150 lbs). <br/>
If you set the maximum package weight to zero, X-Cart will consider the maximum package weight for your store equal to the maximum weight limit for packages established by InterShipper. If you set any of the maximum package dimension values to zero, X-Cart will treat the respective package dimension as unlimited. Although you may use unlimited dimensions for your packages, doing so is not recommended, because in this case X-Cart may form so large a package that it will not be accepted by InterShipper.</td>
</tr>

<tr>
  <td colspan="2"><button type="submit">Apply</button></td>
</tr>

</table>
</form>

<?php 
}

if ($carrier == "CPC") {
?>

<form method="post">
<input type="hidden" name="carrier" value="CPC" />

<table cellpadding="3" cellspacing="1" width="100%">

<tr>
  <td><label for="customer_number"><b>Your Canada Post commercial customer number:</b></label></td>
  <td><input type="text" name="customer_number" id="customer_number" size="20" value="<?php  echo escape($shipping_options['cpc']['param03'], 2); ?>" /></td>
</tr>

<tr>
  <td><label for="contract_id"><b>Your contract number (This must be provided for commercial (contracted) rates, if exists. Leave empty for non-contract rates):</b></label></td>
  <td><input type="text" name="contract_id" id="contract_id" size="20" value="<?php  echo escape($shipping_options['cpc']['param04'], 2); ?>" /></td>
</tr>

<tr>
  <td><label for="quote_type"><b><a href="https://www.canadapost.ca/cpo/mc/business/productsservices/developers/services/rating/getrates/default.jsf" target="_blank">Quote type</a>:</b></label></td>
  <td><select name="quote_type" id="quote_type">
    <option value="commercial"<?php  if ($shipping_options['cpc']['param05'] == "commercial") echo 'selected="selected"'; ?>>commercial</option>
    <option value="counter"<?php  if ($shipping_options['cpc']['param05'] == "counter") echo 'selected="selected"'; ?>>counter</option>
  </select></td>
</tr>

<!-- Package limits -->

<tr>
    <td colspan="2"><br /><h3>Package limits</h3></td>
</tr>

<tr>
  <td><label for="param11"><b>Split the shipment into multiple packages if its weight/dimensions exceed the limitations:</b></label></td>
  <td><input type="checkbox" name="param11" id="param11" value="Y"<?php  if ($shipper_options['cpc']['param11'] == "Y" || !$shipper_options['cpc']['param11']) echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td><b>Maximum package weight (<?php  echo $config['General']['weight_symbol']; ?>)*:</b></td>
  <td>
    <input type="text" name="max_weight" size="6" value="<?php  echo $shipper_options['cpc']['param08']; ?>"/>
   </td>
</tr>

<tr>
  <td><b>Maximum package dimensions (<?php  echo $config['General']['dimensions_symbol']; ?>)*:</b></td>
  <td nowrap="nowrap">
    <table cellpadding="0" cellspacing="1" border="0">
    <tr>
      <td>Length</td>
      <td></td>
      <td>Width</td>
      <td></td>
      <td>Height</td>
    </tr>
    <tr>
      <td><input type="text" name="dim_length" size="6" value="<?php  echo $shipper_options['cpc']['dim_length']; ?>"/></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="dim_width" size="6" value="<?php  echo $shipper_options['cpc']['dim_width']; ?>" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="dim_height" size="6" value="<?php  echo $shipper_options['cpc']['dim_height']; ?>"/></td>
    </tr>
    </table>
  </td>
</tr>

<tr>
  <td><label for="use_maximum_dimensions"><b>Always use the same package dimensions as specified in the "Maximum package dimensions" fields:</b></label></td>
  <td><input type="checkbox" name="use_maximum_dimensions" id="use_maximum_dimensions" value="Y"<?php  if ($shipper_options['cpc']['param09'] == "Y") echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td colspan="2"><b>*</b> The settings "Maximum package weight" and "Maximum package dimensions" define the maximum weight and size of the shipping package that you do not wish to be exceeded when products are shipped to customers. If the total weight and/or volume of the products ordered by a customer exceed the limitations defined by these settings, and the checkbox "Split the shipment into multiple packages" is selected, the shipment is split into several packages. <br />
Please note that the maximum package weight and maximum package dimensions that you set on this page must not exceed the actual limitations imposed by <?php  echo $shipper; ?> service. <br />
If you set the maximum package weight or any of the maximum package dimension values to zero, X-Cart will use the default limitations established by <?php  echo $shipper; ?>.</td>
</tr>
<!-- End package limits -->

<tr>
  <td colspan="2"><hr /></td>
</tr>

<tr>
  <td><label for="status_new_method"><b>Automatically enable new shipping methods from shipping server response:</b></label></td>
  <td><input type="checkbox" name="status_new_method" id="status_new_method" value="new_method_is_enabled"<?php  if ($shipping_options['cpc']['param01'] == "new_method_is_enabled") echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td><b>Shipping cost convertion rate:</b><br />
  <small>The shipping cost is always returned in US Dollars. So you need to specify the conversion rate to convert the shipping cost returned by shipping service into the necessary currency.</small>
  </td>
  <td valign="top"><input type="text" name="currency_rate" size="10" value="<?php  echo escape($shipping_options['cpc']['currency_rate'], 2); ?>" /></td>
</tr>

<tr>
    <td colspan="2"><br /><h3>Package options</h3></td>
</tr>

<tr>
  <td width="30%"><b>Options:</b></td>
  <td width="70%">
    <select name="options[]" multiple="multiple" size="6">
      <option value="SO"<?php  if ($shipping_options['cpc']['options']['SO']) echo 'selected="selected"'; ?>>Singnature</option>
      <option value="PA18"<?php  if ($shipping_options['cpc']['options']['PA18']) echo 'selected="selected"'; ?>>Proof of Age Required - 18</option>
      <option value="PA19"<?php  if ($shipping_options['cpc']['options']['PA19']) echo 'selected="selected"'; ?>>Proof of Age Required - 19</option>
      <option value="HFP"<?php  if ($shipping_options['cpc']['options']['HFP']) echo 'selected="selected"'; ?>>Card for pickup</option>
      <option value="DNS"<?php  if ($shipping_options['cpc']['options']['DNS']) echo 'selected="selected"'; ?>>Do not safe drop</option>
      <option value="LAD"<?php  if ($shipping_options['cpc']['options']['LAD']) echo 'selected="selected"'; ?>>Leave at door - do not card</option>
    </select>
  </td>
</tr>

<!-- Value of contents -->
<script type="text/javascript">
$(document).ready( function() {
  $('#coverage_type').bind("change", function(event) {
    $('#coverage_fixed').toggle(this.value == 'fixed_value');
  })
});
</script>

<tr>
  <td width="50%"><b>Coverage:</b></td>
  <td>
  <select name="coverage_type" id="coverage_type">
    <option value="150%"<?php  if ($shipper_options['cpc']['param07'] == "150%") echo ' selected="selected"'; ?>>150% of order total</option>
    <option value="140%"<?php  if ($shipper_options['cpc']['param07'] == "140%") echo ' selected="selected"'; ?>>140% of order total</option>
    <option value="130%"<?php  if ($shipper_options['cpc']['param07'] == "130%") echo ' selected="selected"'; ?>>130% of order total</option>
    <option value="120%"<?php  if ($shipper_options['cpc']['param07'] == "120%") echo ' selected="selected"'; ?>>120% of order total</option>
    <option value="110%"<?php  if ($shipper_options['cpc']['param07'] == "110%") echo ' selected="selected"'; ?>>110% of order total</option>
    <option value="100%"<?php  if ($shipper_options['cpc']['param07'] == "100%") echo ' selected="selected"'; ?>>100% of order total</option>
    <option value="90%"<?php  if ($shipper_options['cpc']['param07'] == "90%") echo ' selected="selected"'; ?>>90% of order total</option>
    <option value="80%"<?php  if ($shipper_options['cpc']['param07'] == "80%") echo ' selected="selected"'; ?>>80% of order total</option>
    <option value="70%"<?php  if ($shipper_options['cpc']['param07'] == "70%") echo ' selected="selected"'; ?>>70% of order total</option>
    <option value="60%"<?php  if ($shipper_options['cpc']['param07'] == "60%") echo ' selected="selected"'; ?>>60% of order total</option>
    <option value="50%"<?php  if ($shipper_options['cpc']['param07'] == "50%") echo ' selected="selected"'; ?>>50% of order total</option>
    <option value="40%"<?php  if ($shipper_options['cpc']['param07'] == "40%") echo ' selected="selected"'; ?>>40% of order total</option>
    <option value="30%"<?php  if ($shipper_options['cpc']['param07'] == "30%") echo ' selected="selected"'; ?>>30% of order total</option>
    <option value="20%"<?php  if ($shipper_options['cpc']['param07'] == "20%") echo ' selected="selected"'; ?>>20% of order total</option>
    <option value="10%"<?php  if ($shipper_options['cpc']['param07'] == "10%") echo ' selected="selected"'; ?>>10% of order total</option>
    <option value="disabled"<?php  if ($shipper_options['cpc']['param07'] == "disabled" || !$shipper_options['cpc']['param07']) echo ' selected="selected"'; ?>>Disabled </option>
    <option value="fixed_value"<?php  if ($shipper_options['cpc']['coverage_fixed_value'] == "Y") echo ' selected="selected"'; ?>>Fixed value</option>
  </select>
    <input type="text" name="coverage_fixed" id="coverage_fixed" size="10"<?php  if ($shipper_options['cpc']['coverage_fixed_value'] != "Y") echo ' value="0" style="display: none;"'; else  echo ' value="'.($shipper_options['cpc']['param07'] ? $shipper_options['cpc']['param07'] : '0').'"'; ?> />
  </td>
</tr>
<!-- End value of contents -->

<!-- Value of contents -->
<script type="text/javascript">
$(document).ready( function() {
  $('#cod_type').bind("change", function(event) {
    $('#cod_fixed').toggle(this.value == 'fixed_value');
  })
});
</script>

<tr>
  <td width="50%"><b>COD:</b></td>
  <td>
  <select name="cod_type" id="cod_type">
    <option value="150%"<?php  if ($shipper_options['cpc']['param02'] == "150%") echo ' selected="selected"'; ?>>150% of order total</option>
    <option value="140%"<?php  if ($shipper_options['cpc']['param02'] == "140%") echo ' selected="selected"'; ?>>140% of order total</option>
    <option value="130%"<?php  if ($shipper_options['cpc']['param02'] == "130%") echo ' selected="selected"'; ?>>130% of order total</option>
    <option value="120%"<?php  if ($shipper_options['cpc']['param02'] == "120%") echo ' selected="selected"'; ?>>120% of order total</option>
    <option value="110%"<?php  if ($shipper_options['cpc']['param02'] == "110%") echo ' selected="selected"'; ?>>110% of order total</option>
    <option value="100%"<?php  if ($shipper_options['cpc']['param02'] == "100%") echo ' selected="selected"'; ?>>100% of order total</option>
    <option value="90%"<?php  if ($shipper_options['cpc']['param02'] == "90%") echo ' selected="selected"'; ?>>90% of order total</option>
    <option value="80%"<?php  if ($shipper_options['cpc']['param02'] == "80%") echo ' selected="selected"'; ?>>80% of order total</option>
    <option value="70%"<?php  if ($shipper_options['cpc']['param02'] == "70%") echo ' selected="selected"'; ?>>70% of order total</option>
    <option value="60%"<?php  if ($shipper_options['cpc']['param02'] == "60%") echo ' selected="selected"'; ?>>60% of order total</option>
    <option value="50%"<?php  if ($shipper_options['cpc']['param02'] == "50%") echo ' selected="selected"'; ?>>50% of order total</option>
    <option value="40%"<?php  if ($shipper_options['cpc']['param02'] == "40%") echo ' selected="selected"'; ?>>40% of order total</option>
    <option value="30%"<?php  if ($shipper_options['cpc']['param02'] == "30%") echo ' selected="selected"'; ?>>30% of order total</option>
    <option value="20%"<?php  if ($shipper_options['cpc']['param02'] == "20%") echo ' selected="selected"'; ?>>20% of order total</option>
    <option value="10%"<?php  if ($shipper_options['cpc']['param02'] == "10%") echo ' selected="selected"'; ?>>10% of order total</option>
    <option value="disabled"<?php  if ($shipper_options['cpc']['param02'] == "disabled" || !$shipper_options['cpc']['param02']) echo ' selected="selected"'; ?>>Disabled </option>
    <option value="fixed_value"<?php  if ($shipper_options['cpc']['cod_fixed_value'] == "Y") echo ' selected="selected"'; ?>>Fixed value</option>
  </select>
    <input type="text" name="cod_fixed" id="cod_fixed" size="10"<?php  if ($shipper_options['cpc']['cod_fixed_value'] != "Y") echo ' value="0" style="display: none;"'; else  echo ' value="'.($shipper_options['cpc']['param02'] ? $shipper_options['cpc']['param02'] : '0').'"'; ?> />
  </td>
</tr>
<!-- End value of contents -->
<tr>
  <td colspan="2"><button type="submit">Apply</button></td>
</tr>

</table>
</form>

<?php 
}

if ($carrier == "ARB") {
?>

<form method="post">
<input type="hidden" name="carrier" value="ARB" />

<table width="100%">

<tr>
  <td width="50%"><b>Packaging type:</b></td>
  <td width="50%">
  <select name="param00">
    <option value="P"<?php  if ($shipping_options['arb']['param00'] == "P") echo ' selected="selected"'; ?>>Package</option>
    <option value="L"<?php  if ($shipping_options['arb']['param00'] == "L") echo ' selected="selected"'; ?>>Letter</option>
  </select>
  </td>
</tr>

<tr>
  <td width="50%"><b>Ship in a specified number of days:</b></td>
  <td><input type="text" name="param01" size="10" value="<?php  echo escape($shipping_options['arb']['param01'], 2); ?>" /></td>
</tr>

<tr>
  <td><b>Shipping cost conversion rate:</b><br />
  <small>The shipping cost is always returned in US Dollars. So you need to specify the conversion rate to convert the shipping cost returned by shipping service into the necessary currency.</small>
  </td>
  <td valign="top"><input type="text" name="currency_rate" size="10" value="<?php  echo escape($shipping_options['arb']['currency_rate'], 2); ?>" /></td>
</tr>

<tr valign="top">
  <td width="50%"><b>Additional protection type:</b></td>
  <td width="50%">
  <select name="param05">
    <option value="NR"<?php  if ($shipping_options['arb']['param05'] == "NR") echo ' selected="selected"'; ?>>Not required</option>
    <option value="AP"<?php  if ($shipping_options['arb']['param05'] == "AP") echo ' selected="selected"'; ?>>Asset Protection</option>
  </select>
  </td>
</tr>

<tr>
  <td width="50%"><b>Additional protection value in $:</b></td>
  <td><input type="text" name="param06" size="10" value="<?php  echo escape($shipping_options['arb']['param06'], 2); ?>" /></td>
</tr>

<tr>
  <td width="50%"><b>Hazardous Materials:</b></td>
  <td><input type="checkbox" name="opt_haz" value="Y"<?php  if ($shipping_options['arb']['opt_haz'] == "Y") echo ' checked="checked"';?> /></td>
</tr>

<tr>
  <td width="50%"><b>COD payment:</b></td>
  <td>
  <select name="param08">
    <option value="M"<?php  if ($shipping_options['arb']['param08'] == "M") echo ' selected="selected"'; ?>>Cashier's Check or Money Order</option>
    <option value="P"<?php  if ($shipping_options['arb']['param08'] == "P") echo ' selected="selected"'; ?>>Personal or Company Check</option>
  </select>
  </td>
</tr>

<tr>
  <td width="50%"><b>COD value in $:</b></td>
  <td><input type="text" name="param09" size="10" value="<?php  echo $shipping_options['arb']['param09']; ?>" /></td>
</tr>

<tr>
  <td width="50%"><b>Maximum package weight (<?php  echo $config['General']['weight_symbol']; ?>)*:</b></td>
  <td><input type="text" name="param10" size="10" value="<?php  echo $shipping_options['arb']['param10']; ?>" />(Should not exceed <?php  echo $max_arb_weight.' '.$config['General']['weight_symbol']; ?>)</td>
</tr>

<tr>
  <td><b>Maximum package dimensions (<?php  echo $config['General']['dimensions_symbol']; ?>)*:</b></td>
  <td>
    <table cellpadding="0" cellspacing="1" border="0">
    <tr>
      <td>Length</td>
      <td></td>
      <td>Width</td>
      <td></td>
      <td>Height</td>
    </tr>
    <tr>
      <td><input type="text" name="param02" size="6" value="<?php  echo $shipping_options['arb']['param02']; ?>" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="param03" size="6" value="<?php  echo $shipping_options['arb']['param03']; ?>" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="param04" size="6" value="<?php  echo $shipping_options['arb']['param04']; ?>" /></td>
    </tr>
    </table>
  </td>
</tr>

<tr>
  <td><label for="param11"><b>Always use the same package dimensions as specified in the "Maximum package dimensions" fields:</b></label></td>
  <td><input type="checkbox" name="param11" id="param11" value="Y"<?php  if ($shipping_options['arb']['param11'] == "Y") echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td colspan="2"><button type="submit">Apply</button></td>
</tr>

</table>
</form>
<?php 
}

if ($carrier == "APOST") {
?>

<form method="post">
<input type="hidden" name="carrier" value="APOST" />

<table width="100%">

<tr>
  <td>
    <b>Maximum package weight (<?php  echo $config['General']['weight_symbol']; ?>}):</b>
  </td>
  <td>
    <input type="text" name="param04" size="6" value="<?php  echo $shipping_options['apost']['param04']; ?>" /></td>
</tr>

<tr>
  <td><b>Shipping cost convertion rate:</b>
  </td>
  <td valign="top"><input type="text" name="currency_rate" size="10" value="<?php  echo escape($shipping_options['apost']['currency_rate'], 2); ?>" /></td>
</tr>

<tr>
  <td><b>Maximum package dimensions (<?php  echo $config['General']['dimensions_symbol']; ?>):</b></td>
  <td>
    <table cellpadding="0" cellspacing="1" border="0">
    <tr>
      <td>Length</td>
      <td></td>
      <td>Width</td>
      <td></td>
      <td>Height</td>
    </tr>
    <tr>
      <td><input type="text" name="param00" size="6" value="<?php  echo $shipping_options['apost']['param00']; ?>" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="param01" size="6" value="<?php  echo $shipping_options['apost']['param01']; ?>" /></td>
      <td>&nbsp;x&nbsp;</td>
      <td><input type="text" name="param02" size="6" value="<?php  echo $shipping_options['apost']['param02']; ?>" /></td>
    </tr>
    </table>
  </td>
</tr>

<tr>
  <td width="50%"><b><?php echo $lng.lbl_apost_pkg_no_use;?>:</b></td>
  <td><input type="checkbox" name="param03" value="Y"<?php  if ($shipping_options['apost']['param03'] == "Y" || !$shipping_options['apost']) echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td><label for="param05"><b>Always use the same package dimensions as specified in the "Maximum package dimensions" fields:</b></label></td>
  <td><input type="checkbox" name="param05" id="param05" value="Y"<?php  if ($shipping_options['apost']['param05'] == "Y") echo ' checked="checked"'; ?> /></td>
</tr>

<tr>
  <td colspan="2"><button type="submit">Apply</button></td>
</tr>
</table>
</form>

<?php 
}

if ($carrier == "1800C") {
?>

<table>
<tr>
  <td><b>Warehouse name:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['company_name']; ?></td>
  <td>&nbsp;&nbsp;<a href="<?php echo $current_location;?>/admin/configuration/Shipping#anchor_1800c_username">Change info</a></td>
</tr>
<tr>
  <td><b>City:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['city']; ?></td>
</tr>
<tr>
  <td><b>State:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['state']; ?></td>
</tr>
<tr>
  <td><b>Country:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['country']; ?></td>
</tr>
<tr>
  <td><b>Zip code:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['zipcode']; ?></td>
</tr>
<tr>
  <td><b>Address:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['address']; ?></td>
</tr>
<tr>
  <td><b>Phone:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['phone']; ?></td>
</tr>
<tr>
  <td><b>Business hours:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['business_hours']; ?></td>
</tr>
<tr>
  <td><b>Operation days:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['operation_days']; ?></td>
</tr>
<tr>
  <td><b>Username:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['username']; ?></td>
</tr>
<tr>
  <td><b>Ready time:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['readytime']; ?></td>
</tr>
<tr>
  <td><b>Subsidizing rate:</b></td>
  <td>&nbsp;</td>
  <td><?php  echo $seller_address['subsidize']; ?></td>
</tr>
</table>
<?php 
	if ($send_is_avail) {
?>
<form method="post" action="shipping_options.php" name='send_to_1800c'>
<input type="hidden" name="carrier" value="1800C" />
<input type="hidden" name="mode" value="send_info" />
</form>
<br />
<button type="button" <?php if ($send_is_avail) {?> onclick="forms.send_to_1800c.submit()"<?php } else  { ?> disabled="disabled"<?php } ?> /><?php echo $lng.lbl_1800c_send_info|escape;?></button>
<?php 
	} else  {
?>
<br />
<a href="<?php echo $current_location;?>/admin/configuration/Shipping">1-800Courier options are empty</a>
<?php 
	}
}