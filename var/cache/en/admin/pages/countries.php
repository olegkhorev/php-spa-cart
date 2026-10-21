<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Countries</h1>
<br />

<table class="lines-table resp-table">
<thead>
<tr>
  <th style="width:50px">Code</th>
  <th>Country</th>
  <th style="width:150px">States</th>
</tr>
</thead>
<?php  foreach ($countries as $v) {
    echo '<tr>
  <td class="td-align-center"><label>Code</label>' .
        $v["code"] .
        '</td>
  <td><label>Country</label>' .
        $v["country"] .
        '</td>
  <td class="td-align-center"><label>States</label><a href="/admin/countries/' .
        $v["code"] .
        '">Manage</a> ' .
        ($v["states"] ? "(" . $v["states"] . ")" : "") .
        '</td>
</tr>';
} ?>

</table>