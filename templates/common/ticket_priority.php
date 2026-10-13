<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $mode == "plain"}
{if $value == "1"}{lng[Low]}{elseif $value == "2"}{lng[Medium]}{elseif $value == "3"}{lng[Normal]}{elseif $value == "4"}{lng[High]}{/if}
{elseif $mode == "static"}
{if $value == "1"}
<font color="blue">{lng[Low]}</font>
{elseif $value == "2"}
<font color="black">{lng[Medium]}</font>
{elseif $value == "3"}
<font color="red">{lng[Normal]}</font>
{elseif $value == "4"}
<font color="red"><b>{lng[High]}</b></font>
{/if}
{else}
<select name="{$name}" {$extra}>
{if $empty == "Y"}
<option value=""{if $value == ""} selected{/if}>{lng[Select priority]}</option>
{/if}
<option value="1"{if $value == "1"} selected{/if}>{lng[Low]}</option>
<option value="2"{if $value == "2" || (!$value && $empty != "Y")} selected{/if}>{lng[Medium]}</option>
<option value="3"{if $value == "3"} selected{/if}>{lng[Normal]}</option>
<option value="4"{if $value == "4"} selected{/if}>{lng[High]}</option>
</select>
{/if}
