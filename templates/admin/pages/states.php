<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[States]}</h1>
<br />

<form action="{$current_location}/admin/countries/<?php echo $country[
    "code"
]; ?>" method="post" name="states_form">
<input type="hidden" name="mode" value="" />

<a href="javascript: void(0);" onclick="javascript: check_all(document.states_form, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.states_form, 'to_delete', false);">{lng[Uncheck all]}</a>
<table class="states lines-table resp-table">
<thead>
<tr>
  <th style="width:1%">&nbsp;</th>
  <th style="width:5%">{lng[Code]}</th>
  <th>{lng[States]}</th>
</tr>
</thead>
<?php if ($states) {
    foreach ($states as $v) {
        echo '<tr>
  <td class="td-align-center"><input type="checkbox" name="to_delete[' .
            $v["code"] .
            ']" /></td>
  <td class="td-align-center"><label>{lng[Code]}</label><input type="text" name="posted_data[' .
            $v["code"] .
            '][code]" size="10" value="' .
            escape($v["code"]) .
            '" /></td>
  <td class="td-align-center"><label>{lng[States]}</label><input type="text" name="posted_data[' .
            $v["code"] .
            '][state]" size="35" value="' .
            escape($v["state"]) .
            '" /></td>
</tr>';
    }
} else {
     ?>
 <tr>
  <td colspan="3" class="var-wh-100 background-transparent td-align-center">{lng[No states defined in this country]}</td>
 </tr>
<?php
} ?>

<tr>
 <td colspan="3" class="var-wh-100 background-transparent"><h3>{lng[Add new]}</h3></td>
</tr>

<tr>
  <td class="background-transparent">&nbsp;</td>
  <td class="background-transparent td-align-center"><label>{lng[Code]}</label><input type="text" name="new_state[code]" size="10" /></td>
  <td class="background-transparent td-align-center"><label>{lng[States]}</label><input type="text" name="new_state[state]" size="35" /></td>
</tr>

</table>

<div class="fixed_save_button">
<button type="submit">{lng[Update]}</button>
&nbsp;
<button type="button" onclick="javascript: if (confirm('', $(this)) || confirmed) submitForm(this, 'delete');">{lng[Delete selected]}</button>
</div>

</form>