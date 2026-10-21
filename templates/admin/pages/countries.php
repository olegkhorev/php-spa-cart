<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Countries]}</h1>
<br />

<table class="lines-table resp-table">
<thead>
<tr>
  <th style="width:50px">{lng[Code]}</th>
  <th>{lng[Country]}</th>
  <th style="width:150px">{lng[States]}</th>
</tr>
</thead>
<?php foreach ($countries as $v) {
    echo '<tr>
  <td class="td-align-center"><label>{lng[Code]}</label>' .
        $v["code"] .
        '</td>
  <td><label>{lng[Country]}</label>' .
        $v["country"] .
        '</td>
  <td class="td-align-center"><label>{lng[States]}</label><a href="/admin/countries/' .
        $v["code"] .
        '">{lng[Manage]}</a> ' .
        ($v["states"] ? "(" . $v["states"] . ")" : "") .
        '</td>
</tr>';
} ?>

</table>