<?php
define('STATIC_SITE_FOLDER', '_site');

require_once __DIR__.'/vendor/autoload.php';
require_once 'generators.php';

function url_slug($name) {
	return urlencode(strtolower(str_replace(' ', '-', $name)));
}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 

function rrmdir($dir) {
	if (!empty($dir)) {
		foreach(glob($dir . '/*') as $file) { 
			if(is_dir($file)) rrmdir($file); else unlink($file); 
		}
		rmdir($dir); 
	}
}

function filter_by_location($items, $location) {
	$filtered_items = [];
	foreach ($items as $item) {
		if (empty($item->locations) || in_array($location, $item->locations)) {
			$item_copy = $item;
			if (!empty($item->menu_items)) {
				$item_copy->menu_items = filter_by_location($item_copy->menu_items, $location);
			}
			$filtered_items[] = $item_copy;
		}
	}
	return $filtered_items;
}

$locations = json_decode(file_get_contents('data/locations.json'));
$menu = json_decode(file_get_contents('data/menu.json'));

if (is_dir(STATIC_SITE_FOLDER)) {
	rrmdir(STATIC_SITE_FOLDER);
}
mkdir(STATIC_SITE_FOLDER);

generate_landing_page($locations);

foreach ($locations as &$location) {
	$location->menu = filter_by_location($menu, $location->name);
	generate_menu_page($location);
}

recurse_copy('css', STATIC_SITE_FOLDER.'/css');
recurse_copy('images', STATIC_SITE_FOLDER.'/images');

?>