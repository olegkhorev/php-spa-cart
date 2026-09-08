<ul class="admin-tabs">
<li><a href="<?php echo $current_location;?>/admin/shipping">Shipping methods</a></li>
<li class="active"><a href="<?php echo $current_location;?>/admin/shipping?mode=add_realtime_methods">Manage realtime shipping methods</a></li>
<li><a href="<?php echo $current_location;?>/admin/shipping_options">Shipping options</a></li>
<li><a href="<?php echo $current_location;?>/admin/shipping_charges">Shipping charges</a></li>
</ul>
<br />
<h1>Manage realtime shipping methods</h1>

<?php 
if ($config['Shipping']['enable_shipping'] != 'Y') {
?>
<b>Shipping is disabled. You can manage it <a href="configuration/Shipping">here</a>.</b>
<?php 
} else  {
?>

<form method="post" name="shippingmethodsform">
<input type="hidden" name="carrier" value="<?php  echo $carrier; ?>" />
<input type="hidden" name="mode" value="add_realtime_methods" />

<script type="text/javascript">//<![CDATA[
var expands = new Array(<?php  foreach ($carriers as $v) echo "'".$v['code']."',"; ?>'');
function expand_all(flag) {
  var x;
  for (x = 0; x < expands.length; x++) {
    if (expands[x].length == 0)
      continue;

    var elm = document.getElementById("box"+expands[x]);
    if (!elm)
      continue;

    if (!flag)
      elm.style.display = "none";
    else 
      elm.style.display = "";
  }
}
//]]></script>

<table cellpadding="2" cellspacing="1" width="100%">

<tr>
  <td>
  <div align="right" style="line-height:170%"><a href="javascript:expand_all(true);">Expand all</a> / <a href="javascript:expand_all(false);">Collapse all</a></div>
  </td>
</tr>

<?php 
	foreach ($carriers as $c) {
		echo '<tr>
  <td style="background: #efefef; padding: 10px;">
    <a href="javascript: void(0);" onclick="$(\'#box'.$c['code'].'\').show();">'.$c['shipping'].'</a>
  </td>
</tr>
<tr id="box'.$c['code'].'" class="hidden">
  <td>

<table cellpadding="2" cellspacing="1" width="100%">
<tr>
  <th width="50" style="cursor: pointer; text-decoration: underline;" onclick="javascript: change_state(\'.methods_'.$c['code'].'\');">Active</th>
  <th>Shipping method</th>
  <th>Destination</th>
</tr>';
		foreach ($shipping as $s) {
			if ($s['code'] == $c['code'] && $s['is_new'] != 'Y') {
				echo '<tr>
  <td align="center"><input class="methods_'.$c['code'].'" type="checkbox" name="data['.$s['shippingid'].'][active]" value="Y"'.($s['active'] == 'Y' ? ' checked="checked"' : '').' /></td>
  <td>'.func_trademark($s['shipping']).'</td>
  <td align="center">'.($s['destination'] == 'N' ? "National" : "International").'</td>
</tr>';
			}
		}

		echo '</table>
<br />
  </td>
</tr>';
	}
?>

<tr>
  <td>&nbsp;</td>
</tr>

<tr>
  <td>
      <button type="submit">Save</button>
  </td>
</tr>

</table>

</form>

<br /><br />

<?php 
}
?>
