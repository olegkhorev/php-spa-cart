<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<form method="POST">
{if $get['2'] == 'General'}
<h1>General settings</h1>
{elseif $get['2'] == 'Company'}
<h1>Company information</h1>
{elseif $get['2'] == 'Blog'}
<h1>Blog settings</h1>
{elseif $get['2'] == 'Visual'}
<h1>Visual settings</h1>
{elseif $get['2'] == 'Tickets'}
<h1>Support desk settings</h1>
{/if}
<br />

 <table class="configuration normal-table">
<script>
var states = {ldelim}{rdelim};
	user_state = "<?php if ($get["2"] == "Company") {
     echo escape($config["Company"]["location_state"], 2);
 } else {
     echo escape($config["General"]["default_state"], 2);
 } ?>";
<?php foreach ($countries as $v) {
    if (!empty($v["states"])) {
        echo "states." . $v["code"] . " = {states: []};" . "\n";
        foreach ($v["states"] as $k => $s) {
            echo "states." .
                $v["code"] .
                ".states[" .
                $k .
                '] = {code: "' .
                escape($s["code"], 2) .
                '", state: "' .
                escape($s["state"], 2) .
                '"};' .
                "\n";
        }
    }
} ?>
</script>
{foreach $conf as $v}
{include="common/config_common.php"}
{/foreach}
</table>

<div class="fixed_save_button">
 <button>{lng[Save]}</button>
</div>

</form>