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
if ($get["2"] != 'recent') { ?>
<h1>{lng[Orders]}</h1>
<form method="POST" action="/admin/orders">
<input type="hidden" name="mode" value="search" />
<table class="orders_search search_table">
<tr>
 <td class="td-align-right">{lng[Order #ID]}</td>
 <td><input type="text" name="orderid" value="<?php echo $search_orders[
     "orderid"
 ]; ?>" /></td>
</tr>
<tr>
 <td class="td-align-right">{lng[Email]}</td>
 <td><input type="text" name="email" value="<?php echo $search_orders[
     "email"
 ]; ?>" /></td>
</tr>
<tr>
 <td class="td-align-right">{lng[Customer name]}</td>
 <td><input type="text" name="customer" value="<?php echo $search_orders[
     "customer"
 ]; ?>" /></td>
</tr>
<tr>
 <td class="td-align-right">{lng[Status]}</td>
 <td><select name="status"><option value="">{lng[All]}</option>
<?php foreach ($order_statuses as $k2 => $v2) {
    echo '<option value="' .
        $k2 .
        '"' .
        ($k2 == $search_orders["status"] ? " selected" : "") .
        ">" .
        $v2 .
        "</option>";
} ?>
</select>
 </td>
</tr>
<tr>
 <td class="search_table_date_lbl td-align-right" style="width:170px">{lng[Search by date]}</td>
 <td class="search_table_date_period">
<label><input type="radio" name="date_period" value="0"<?php if (
    !$search_orders["date_period"]
) {
    echo ' checked="checked"';
} ?> /> {lng[All dates]}</label>
<label><input type="radio" name="date_period" value="1"<?php if (
    $search_orders["date_period"] == "1"
) {
    echo ' checked="checked"';
} ?> /> {lng[Today]}</label>
<label><input type="radio" name="date_period" value="2"<?php if (
    $search_orders["date_period"] == "2"
) {
    echo ' checked="checked"';
} ?> /> {lng[This week]}</label>
<label><input type="radio" name="date_period" value="3"<?php if (
    $search_orders["date_period"] == "3"
) {
    echo ' checked="checked"';
} ?> /> {lng[This month]}</label>
<label><input type="radio" name="date_period" value="4"<?php if (
    $search_orders["date_period"] == "4"
) {
    echo ' checked="checked"';
} ?> /> {lng[Date period]}:</label>
<input type="text" id="date_from" name="date_from" value="<?php echo $search_orders[
    "date_from"
]; ?>" size="7" autocomplete="off" /><div class="date_from_to"> - </div><input type="text" id="date_to" name="date_to" value="<?php echo $search_orders[
    "date_to"
]; ?>" size="7" autocomplete="off" />
 </td>
</tr>
<tr>
 <td></td>
 <td><br /><button>{lng[Search]}</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a class="ajax_link" href="{$current_location}/admin/orders/reset">{lng[Reset]}</a></td>
</tr>
</table>
</form>
<h3 class="scroll_to_orders">{lng[Search results]}</h3>
<?php } else { ?>
<h1>{lng[Recent orders]}</h1>
<br />
<?php }
if ($total_pages > 2) { ?>
{include="common/navigation.php"}
<?php echo "<br />";}
?>

<form method="POST">
<?php if ($orders) { ?>
<table class="lines-table resp-table">
<thead>
<tr>
 <th>#</th>
 <th>{lng[Status]}</th>
 <th>{lng[Customer]}</th>
 <th>{lng[Date]}</th>
 <th>{lng[Total]}</th>
</tr>
</thead>
<?php
$total = 0;
$total_paid = 0;
foreach ($orders as $k => $v) {
    if ($v["status"] == "2" || $v["status"] == "3" || $v["status"] == "6") {
        $total_paid += $v["total"];
    }
    $total += $v["total"];
    echo '
		<tr>
			<td class="td-w-10 td-align-center"><label>#</label><a href="/admin/invoice/' .
        $v["orderid"] .
        '">#' .
        $v["orderid"] .
        '</a></td>
			<td class="td-w-100 no-word-break"><label>{lng[Status]}</label>
				<select name="status[' .
        $v["orderid"] .
        ']">';
    foreach ($order_statuses as $k2 => $v2) {
        echo '<option value="' .
            $k2 .
            '"' .
            ($k2 == $v["status"] ? " selected" : "") .
            ">" .
            $v2 .
            "</option>";
    }
    echo "</select>";
    if ($v["gift_card"]) {
        echo "<b>{lng[Paid with GC]}</b>";
    } #echo '<pre>';
    #exit(print_R($v));
    echo '</td>
			<td class="td-nowrap"><label>{lng[Customer]}</label><a href="/admin/user/' .
        $v["userid"] .
        '">' .
        $v["firstname"] .
        " " .
        $v["lastname"] .
        " (" .
        $v["email"] .
        ')</a></td>
			<td class="td-w-130 td-nowrap td-align-center"><label>{lng[Date]}</label><a href="/admin/invoice/' .
        $v["orderid"] .
        '">' .
        date($datetime_format, $v["date"]) .
        '</a></td>
			<td class="td-align-center"><label>{lng[Total]}</label><a href="/admin/invoice/' .
        $v["orderid"] .
        '">$' .
        $v["total"] .
        '</a></td>
		</tr>
		';
}
echo '<tr class="resp-width-100"><td colspan="5" style="text-align:right" class="background-transparent"><br />{lng[Total]}: $' .
    $total .
    "</td></tr>";
echo '<tr class="resp-width-100"><td colspan="5" style="text-align:right" class="background-transparent"><b>{lng[Total Paid]}: $' .
    $total_paid .
    "</b></td></tr>";
echo "</table>";
?>
<div class="fixed_save_button">
<button>{lng[Save]}</button>
</div>

{if $search_orders && $get["2"] != 'recent'}
<script>
$([document.documentElement, document.body]).animate({
    scrollTop: $('.scroll_to_orders').offset().top + 21
}, 500);
</script>
{/if}

<?php } else {echo "No orders found.";} ?>
</form>
