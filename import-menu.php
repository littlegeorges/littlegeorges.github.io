<?php
function split_field($field_value) {
	return array_map('trim', explode(',',$field_value));
}

function url_slug($name) {
	return strtolower(str_replace(' ', '-', $name));
}

$exported_menu = json_decode(file_get_contents('cms-export.json'));

$menu_sections = [];
$current_section_name = null;

foreach ($exported_menu->menu as $record) {
	$entry = $record->entry;
	if ($entry->title !== $current_section_name) {
		if ($current_section_name) {
			$menu_sections[] = $menu_section;
		}
		$current_section_name = $entry->title;
		$menu_section = [
			'title'=>$entry->title,
			'section_notes'=>$entry->{'Section Notes'},
			'end_notes'=>$entry->{'End Notes'},
			'display_format'=>$entry->{'Display Format'},
			'locations'=>array_map('url_slug', split_field($entry->{'Section Available At'})),
			'menu_items'=>[]
		];
	}
	$menu_item = [
		'title'=>$entry->{'Item Title'},
		'description'=>$entry->{'Description'},
		'price'=>split_field($entry->{'Price'}),
		'locations'=>array_map('url_slug', split_field($entry->{'Item Available At'}))
	];
	$menu_section['menu_items'][] = $menu_item;
}
$menu_sections[] = $menu_section;

file_put_contents('menu.json', json_encode($menu_sections, JSON_PRETTY_PRINT));