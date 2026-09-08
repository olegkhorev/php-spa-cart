<?php
$page = $db->row("SELECT * FROM pages WHERE pageid='".$get['1']."' OR cleanurl='".str_replace('.html', '', $get['1'])."'");
if ($page) {
	$template['head_title'] = $page['title'].'. '.$template['head_title'];
	$template['static_page'] = $page;
} else
	redirect('/');

$template['page'] = get_template_contents('static_pages/body.php');
$template['css'][] = 'static';