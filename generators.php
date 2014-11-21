<?php
require_once __DIR__.'/snippets.php';

function generate_from_template($file_name, $template_name, $vars = []) {
	extract($vars);
	ob_start();
	include $template_name;
	file_put_contents($file_name, ob_get_contents());
	ob_end_clean();
}

function generate_landing_page($locations) {
	generate_from_template(STATIC_SITE_FOLDER.'/index.html', 'templates/landing-page.php', compact('locations'));
}

function generate_menu_page($location) {
	$dir_name = STATIC_SITE_FOLDER.'/'.url_slug($location->name);
	mkdir($dir_name);
	generate_from_template($dir_name.'/index.html', 'templates/menu-page.php', compact('location'));
}

?>