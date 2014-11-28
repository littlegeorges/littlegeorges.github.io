<?php

use \Michelf\Markdown;

function page_top($title, $locations, $path_to_root = './') {
	?>
<!DOCTYPE html>
<html class="cs-0">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo $path_to_root; ?>css/style.css">
</head>
<body>
	<div class="stack cs-1">
		<div class="container tiles tiles-center sm-tiles-justify pad-v-md">
			<div class="tile">
				<a class="stack tiles" href="http://www.facebook.com/pages/Little-Georges-Restaurant/131565550199983">
					<span class="tile tile-middle icon-facebook"></span>
					<span class="tile tile-middle pad-left-sm cs-4">
						Join us on<br>
						Facebook!
					</span>
				</a>
				<a title="home" href="<?php echo $path_to_root; ?>" class="stack pad-top-md logo-link">
					<img
						src="<?php echo $path_to_root ?>/images/logo.png"
						alt="Little George's Logo"
						width="219"
						height="114"
						class="float-left"
					>
				</a>
			</div>
			<div class="tile">
				<p>
					<strong>CITY WIDE DELIVERY</strong><br>
					<small>Delivery Charge Applies</small>
				</p>

				<?php foreach ($locations as $location): ?>
					<p class="text-right">
						<?php echo $location->address; ?>
					</p>
					<p class="text-right">
						<?php echo $location->phone_number; ?>
					</p>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<div class="cs-3 h-1 fx-popout">
	</div>
	<?php
}

function page_bottom() {
	?>
</body>
</html>
	<?php
}

function item_title($title) {
	?>
	<h3 class="tile fs-mdlg">
		<?php echo $title; ?>
	</h3>
	<?php
}

function item_price($prices) {
	if (!is_array($prices)) {
		$prices = [$prices];
	}
	$prices = array_map(function($price){return str_replace(' ', '&nbsp;', $price);}, $prices);
	echo implode('<br>',$prices);
}

function section_header($menu_section) {
	?>
	<h2
		id="<?php echo url_slug($menu_section->title); ?>"
		class="fs-xl text-center section-title"
	>
		<?php echo $menu_section->title; ?>
	</h2>
	<?php if (!empty($menu_section->section_notes)): ?>
		<div class="text-center pad-sm">
			<?php echo Markdown::defaultTransform($menu_section->section_notes); ?>
		</div>
	<?php endif ?>
	<?php
}

function standard_menu_section($menu_section) {
	?>
	<div class="stack pad-md-top pad-md-bottom">
		<?php section_header($menu_section); ?>
		<div class="tiles">
			<?php foreach ($menu_section->menu_items as $menu_item): ?>
				<div class="sm-tile sm-w-1-2 pad-md tiles tiles-justify">
					<div class="tile max-w-3-4 pad-right-sm">
						<?php item_title($menu_item->title); ?>
					</div>
					<div class="tile">
						<?php item_price($menu_item->price); ?>
					</div>
					<!-- the above two tiles won't justify unless this is also a `.tile` -->
					<div class="tile w-fill pad-top-md">
						<?php echo Markdown::defaultTransform($menu_item->description); ?>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<?php
}

function pizza_menu_section($menu_section) {
	?>
	<div class="stack pad-top-md pad-bottom-md">
		<?php section_header($menu_section); ?>
		<div class="tiles">
			<?php foreach ($menu_section->menu_items as $menu_item): ?>
				<div class="sm-tile sm-w-1-2 pad-md">
					<?php item_title($menu_item->title); ?>
					<div class="fs-mdsm">
						<?php echo Markdown::defaultTransform($menu_item->description); ?>
					</div>
					<div class="tiles tiles-justify pad-v-sm pad-h-sm lg-pad-h-lg">
						<div class="tile text-center">
							<strong class="stack">Sm.</strong>
							<?php echo $menu_item->price[0]; ?>
						</div>
						<div class="tile text-center">
							<strong class="stack">Md.</strong>
							<?php echo $menu_item->price[1]; ?>
						</div>
						<div class="tile text-center">
							<strong class="stack">Lg.</strong>
							<?php echo $menu_item->price[2]; ?>
						</div>
					</div>
				</div>	
			<?php endforeach ?>
		</div>
	</div>
	<?php
}

function mini_menu_section($menu_section) {
	?>
	<div class="sm-tile sm-w-1-2 pad-md">
		<?php section_header($menu_section); ?>
		<?php foreach ($menu_section->menu_items as $menu_item): ?>
			<div class="tiles tiles-justify pad-top-md">
				<div class="tile max-w-3-4">
					<?php item_title($menu_item->title); ?>
				</div>
				<div class="tile">
					<?php item_price($menu_item->price); ?>
				</div>
				<div class="tile w-fill pad-top-md">
					<?php echo Markdown::defaultTransform($menu_item->description); ?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<?php
}

function table_menu_section($menu_section) {
	$price_names = ['Sm.','Md.','Lg.'];
	?>
	<div class="stack pad-md">
		<?php section_header($menu_section); ?>
		<div class="tiles">
			<div class="hide sm-tile sm-w-1-2">
				&nbsp;
			</div>
			<?php foreach ($price_names as $price_name): ?>
				<strong class="hide sm-tile sm-w-1-6">
					<?php echo $price_name; ?>
				</strong>
			<?php endforeach ?>
			<?php foreach ($menu_section->menu_items as $menu_item): ?>
				<div class="tile pad-top-sm w-fill sm-w-1-2 sm-pad-top-nil">
					<?php echo $menu_item->title; ?>
				</div>
				<?php foreach ($menu_item->price as $i=>$price): ?>
					<div class="tile w-1-3 sm-w-1-6">
						<strong class="stack sm-hide">
							<?php echo $price_names[$i]; ?>
						</strong>
						<?php echo $price; ?>
					</div>
				<?php endforeach ?>
			<?php endforeach ?>
		</div>
	</div>
	<?php
}

?>