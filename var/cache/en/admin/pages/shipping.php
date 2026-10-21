<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Shipping methods</h1>
<br />
<?php  if ($config["Shipping"]["enable_shipping"] != "Y") { ?>

<br />

<b>Shipping is disabled. You can manage it <a href="configuration/Shipping">here</a>.</b>

<br />

<?php  } else  { ?>

<form method="post" name="shippingmethodsform">
<input type="hidden" name="carrier" value="<?php  echo escape(
    $carrier,
    2,
); ?>" />

<script>//<![CDATA[
var expands = new Array(<?php  foreach ($carriers as $v) {
    echo "'" . $v["code"] . "',";
} ?>'');
function expand_all(flag) {
  var x;
  for (x = 0; x < expands.length; x++) {
    if (expands[x].length == 0)
      continue;

    if (!flag)
      $("#box"+expands[x]).hide();
    else 
      $("#box"+expands[x]).show();
  }
}
//]]></script>

<table class="lines-table resp-table">
<thead>
<tr>
  <th>Shipping method</th>
  <th>Delivery time</th>
  <th>Destination</th>
  <th>Pos</th>
  <th>Active</th>
  <th></th>
</tr>
</thead>
<?php  foreach ($shipping as $s) {
    if ($s["code"] == "") {
        echo '
<tr>
  <td><label>Shipping method</label><input type="text" name="data[' .
            $s["shippingid"] .
            '][shipping]" size="27" value="' .
            escape($s["shipping"], 2) .
            '" /></td>
  <td class="td-align-center"><label>Delivery time</label><input type="text" name="data[' .
            $s["shippingid"] .
            '][shipping_time]" size="8" value="' .
            escape($s["shipping_time"], 2) .
            '" /></td>
  <td class="no-word-break td-align-center"><label>Destination</label><select name="data[' .
            $s["shippingid"] .
            '][destination]">
    <option value="I"' .
            ($s["destination"] == "I" ? ' selected="selected"' : "") .
            '>International</option>
    <option value="N"' .
            ($s["destination"] == "N" ? ' selected="selected"' : "") .
            '>National</option>
  </select></td>
  <td class="td-align-center"><label>Pos</label><input type="text" name="data[' .
            $s["shippingid"] .
            '][orderby]" size="4" value="' .
            $s["orderby"] .
            '" /></td>
  <td class="td-nowrap td-align-center"><label>Active</label><input type="checkbox" name="data[' .
            $s["shippingid"] .
            '][active]" value="Y"' .
            ($s["active"] == "Y" ? ' checked="checked"' : "") .
            ' /></td>
  <td class="td-align-center"><button type="button" onclick="self.location=\'' .
            $current_location .
            "/admin/shipping/?mode=delete&amp;shippingid=" .
            $s["shippingid"] .
            '\'">Delete</button></td>
</tr>';
    }
} ?>

<tr>
  <td colspan="6" class="var-wh-100 background-transparent"><br /><h3>Add shipping method</h3></td>
</tr>

<tr>
  <td class="background-transparent"><label>Shipping method</label><input type="text" name="add[shipping]" size="27" /></td>
  <td class="background-transparent td-align-center"><label>Delivery time</label><input type="text" name="add[shipping_time]" size="10" /></td>
  <td class="background-transparent no-word-break td-align-center"><label>Destination</label><select name="add[destination]">
    <option value="I">International</option>
    <option value="N">National</option>
  </select></td>
  <td class="background-transparent td-align-center"><label>Pos</label><input type="text" name="add[orderby]" size="4" value="0" /></td>
  <td class="background-transparent td-align-center"><label>Active</label><input type="checkbox" name="add[active]" value="Y" checked="checked" /></td>
  <td class="background-transparent"></td>
</tr>

</table>

<div class="fixed_save_button">
    <button type="submit">Apply changes</button>
</div>

</form>

<br /><br />

<?php  }
?>
