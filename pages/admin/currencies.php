<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	extract($_POST);
	if ($mode == 'add') {
		$db->array2insert("currencies", $new_currency);
	} elseif ($mode == "delete" && !empty($to_delete)) {
		foreach ($to_delete as $k=>$v) {
			$db->query("DELETE FROM currencies WHERE id='".addslashes($k)."'");
		}
	} elseif ($mode == "update" && !empty($to_update)) {
		foreach ($to_update as $k=>$v) {
			$v['active'] = $v['active'] ? $v['active'] : '';
			$db->array2update("currencies", $v, "id='".addslashes($k)."'");
		}

		if ($main_currency) {
			$db->query("UPDATE currencies SET main='0'");
			$db->query("UPDATE currencies SET main='1' WHERE id='".addslashes($main_currency)."'");
		}
	}

	redirect("/admin/currencies");
}

$template['location'] .= ' &gt; '.lng('Currencies management');
$currencies = $db->all("SELECT * FROM currencies ORDER BY active DESC, orderby, code");
$template["currencies"] = $currencies;

$template['head_title'] = lng('Currencies management').' :: '.$template['head_title'];

$template['page'] = get_template_contents('admin/pages/currencies.php');
