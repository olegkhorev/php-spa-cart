<div class="exec_admin_page_js hidden">init_admin_sample_page();</div>
<form method="POST">
<input type="hidden" name="mode" value="update" />
<h1>API configuration</h1>
<table class="configuration normal-table">
{foreach $config_module as $v}
 {include="common/config_common.php"}
{/foreach}
</table>

<div class="fixed_save_button">
<button>{lng[Save]}</button>
</div>

</form>

<p>API request URL:</p>
<a href="{$current_location}/module/api/api?api_auth_key={$config['api']['api_auth_key']}" target="_blank">{$current_location}/module/api/api?api_auth_key={$config['api']['api_auth_key']}</a>

<br /><br />

<p>Send POST request like:</p>
*mode=add<br />
*sku=test<br />
*price=10.00<br />
<br />
<h3>Example</h3>
<form method="POST" class="noajax" action="{$current_location}/module/api/api?api_auth_key={$config['api']['api_auth_key']}">
<table class="normal-table">
    <tr>
        <td>Mode:</td>
        <td><input type="text" name="mode" value="add" /><td>
    </tr>
    <tr>
        <td>SKU:</td>
        <td><input type="text" name="sku" value="test" /><td>
    </tr>
    <tr>
        <td>Price:</td>
        <td><input type="text" name="price" value="10.00" /><td>
    </tr>
</table>
<button>Make API request</button>
</form>
<br /><br />     
<h3>Previos requests logs</h3>
<table cellspacing="1">
<tr>
    <th>Mode</th>
	<th>SKU</th>
	<th>Price</th>
    <th>Date</th>
</tr>
{foreach $api_requests_logs as $v}
<tr>
    <td>{$v['mode']}</td>
    <td>{$v['sku']}</td>
    <td>{price $v['price']}</td>
    <td>{php echo date($datetime_format, $v['date'])}</td>
</tr>
{/foreach}
</table>
