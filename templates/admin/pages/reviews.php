<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<style>
@scope {
table td {
	vertical-align: middle;
}
}
</style>
<h1>{lng[Reviews]}</h1>
<br />
<form method="POST" href="/admin/reviews/search">
<input type="hidden" name="mode" value="search">
<table style="width:100%;margin-left:auto;margin-right:auto" class="search_table reviews_search_table">
        <tr>
                <td class="td-align-right">{lng[Status]}</td>
                <td><select name="status">
                        <option value="0">{lng[Pending]}</option>
                        <option{if $search_data['status'] == "1"} selected{/if} value="1">{lng[Approved]}</option>
                        <option{if $search_data['status'] == "2"} selected{/if} value="2">{lng[Declined]}</option>
                        <option{if $search_data['status'] == "" && $search_data} selected{/if} value="">{lng[All]}</option>
                        </select>
                </td>
        </tr>
        <tr>
                <td class="td-align-right" style="width:170px">{lng[IP Address]}</td>
                <td><input type="text" size="32" name="remote_ip" value="{$search_data['remote_ip']}"></td>
        </tr>
        <tr>
                <td class="td-align-right">{lng[Name]}</td>
                <td><input type="text" size="32" name="name" value="{$search_data['name']}"></td>
        </tr>
        <tr>
                <td class="td-align-right">{lng[Message]}</td>
                <td><input type="text" size=80 name="message" value="{$search_data['message']}"></td>
        </tr>
        <tr>
                <td class="td-align-right">{lng[Product ID]}</td>
                <td><input type="text" size="32" name="productid" value="{$search_data['productid']}"></td>
        </tr>
        <tr>
                <td class="td-align-right">{lng[SKU]}</td>
                <td><input type="text" size="32" name="sku" value="{$search_data['sku']}"></td>
        </tr>
        <tr>
                <td class="td-align-right">{lng[Rating]}</td>
                <td>
                                <select name="rating">
                                <option value="">{lng[All]}</option>
                                <option value="5"{if $search_data['rating'] == "5"} selected{/if}>5</option>
                                <option value="4"{if $search_data['rating'] == "4"} selected{/if}>4</option>
                                <option value="3"{if $search_data['rating'] == "3"} selected{/if}>3</option>
                                <option value="2"{if $search_data['rating'] == "2"} selected{/if}>2</option>
                                <option value="1"{if $search_data['rating'] == "1"} selected{/if}>1</option>
                                </select>
                </td>
        </tr>
        <tr>
                <td></td>
                <td><button>{lng[Search]}</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a class="ajax_link" href="{$current_location}/admin/reviews/reset">{lng[Reset]}</a></td>
        </tr>
</table>
</form>

{if $reviews}
<br />
<h3 class="scroll_to_reviews">{lng[Review search results]}</h3>

{if $total_pages > 2}
{include="common/navigation.php"}
<br />
{/if}

<form action="/admin/reviews" method="post" name="reviewsform">
<input type="hidden" name="mode" value="edit">

<a href="javascript: void(0);" onclick="javascript: check_all(document.reviewsform, 'to_delete', true);">{lng[Check all]}</a> / <a href="javascript: void(0);" onclick="javascript: check_all(document.reviewsform, 'to_delete', false);">{lng[Uncheck all]}</a>

<br /><br />

<table class="lines-table resp-table">
<thead>
                <tr>
                        <th style="width:5%"></th>
                        <th style="width:5%">{lng[Status]}</th>
                        <th style="width:5%">{lng[Rating]}</th>
                        <th style="width:15%">{lng[IP]}</th>
                        <th style="width:15%">{lng[Name]}</th>
                        <th style="width:45%">{lng[Message]}</th>
                        <th style="width:10%;white-space:nowrap">{lng[Product ID/SKU]}</th>
                </tr>
</thead>
{foreach $reviews as $r}
                <tr>
                        <td><input type="checkbox" name="to_delete[{$r['id']}]" value="{$r['id']}"></td>
                        <td class="no-word-break"><label>{lng[Status]}</label>
                                <select name="to_update[{$r['id']}][status]">
                                <option value="0" >{lng[Pending]}</option>
                                <option value="1" {if $r['status'] == "1"}selected{/if}>{lng[Approved]}</option>
                                <option value="2" {if $r['status'] == "2"}selected{/if}>{lng[Declined]}</option>
                                </select>
                        </td>
                        <td class="no-word-break"><label>{lng[Rating]}</label>
                                <select name="to_update[{$r['id']}][rating]">
                                <option value="5"{if $r['rating'] == "5"} selected{/if}>5</option>
                                <option value="4"{if $r['rating'] == "4"} selected{/if}>4</option>
                                <option value="3"{if $r['rating'] == "3"} selected{/if}>3</option>
                                <option value="2"{if $r['rating'] == "2"} selected{/if}>2</option>
                                <option value="1"{if $r['rating'] == "1"} selected{/if}>1</option>
                                </select>
                        </td>
                        <td><label>{lng[IP]}</label>{$r['remote_ip']}</td>
                        <td><label>{lng[Name]}</label>{$r['name']}</td>
                        <td><label>{lng[Message]}</label><textarea cols="40" rows="5" name="to_update[{$r['id']}][message]" class="border-radius-25">{$r['message']}</textarea></td>
                        <td><label>{lng[Product ID/SKU]}</label><a href="/admin/products/{$r['productid']}" target="_blank">{$r['productid']}/{$r['sku']}</a></td>
                </tr>
{/foreach}
                <tr>
                        <td colspan="7"><br />
<div class="fixed_save_button">
<button type="button" onclick="javascript: submitForm(document.reviewsform, 'update');">{lng[Update]}</button>
&nbsp;
<button type="button" onclick="javascript: if (confirmed || confirm('{lng[This operation will delete selected reviews.|escape]}', $(this))) submitForm(this, 'delete');">{lng[Delete selected]}</button>
</div>
                        </td>
                </tr>
        </table>
        </form>

{if $total_pages > 2}
{include="common/navigation.php"}
<br />
{/if}

{if $search_data}
<script>
$([document.documentElement, document.body]).animate({
    scrollTop: $('.scroll_to_reviews').offset().top + 21
}, 500);
</script>
{/if}

{elseif $get['2'] == 'search'}
<br />
{lng[No reviews found]}
{/if}