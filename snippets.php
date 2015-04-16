<?php

use \Michelf\Markdown;

function page_top($title, $locations, $path_to_root = './', $path = '') {
	?>
<!DOCTYPE html>
<html class="cs-0">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-38264618-1', 'auto');
	  ga('send', 'pageview');
	</script>
	<link rel="shortcut icon" href="<?php echo $path_to_root; ?>images/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
	<meta name="format-detection" content="telephone=no">
	<link rel="canonical" href="<?php echo SITE_URL; ?>/<?php echo $path; ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo $path_to_root; ?>css/style.css">
</head>
<body>
	<div id="little-georges-organization" itemprop="branchOf" itemscope itemtype="http://schema.org/Organization" class="stack cs-1 pad-md">
		<meta itemprop="name" content="Little George's Restaurant">
		<meta itemprop="url" content="<?php echo SITE_URL; ?>">
		<div class="container tiles tiles-center sm-tiles-justify">
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
						itemprop="logo"
						src="<?php echo $path_to_root ?>images/logo.png"
						alt="Little George's Logo"
						width="219"
						height="114"
						class="float-left"
					>
				</a>
			</div>
			<div class="tile tiles">
				<div class="tile">
					<p class="text-right">
						<strong>CITY WIDE DELIVERY</strong><br>
						<small class="fs-sm">Delivery Charge Applies</small>
					</p>
					<?php foreach ($locations as $location): ?>
						<div class="pad-top-sm" itemscope itemtype="http://schema.org/Restaurant" itemref="little-georges-organization">
							<meta itemprop="name" content="Little George's - <?php echo $location->title; ?>">
							<meta itemprop="url" content="<?php echo SITE_URL; ?>/<?php echo $location->name; ?>">
							<meta itemprop="menu" content="<?php echo SITE_URL; ?>/<?php echo $location->name; ?>">
							<meta itemprop="servesCuisine" content="greek, italian, pizza, pasta, salad, steak">
							<meta itemprop="openingHours" content="Mo-Th 16:00-0:00">
							<meta itemprop="openingHours" content="Fr,Sa 16:00-1:00">
							<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								<meta itemprop="streetAddress" content="<?php echo $location->address->streetAddress; ?>">
								<meta itemprop="addressLocality" content="<?php echo $location->address->addressLocality; ?>">
								<meta itemprop="addressRegion" content="<?php echo $location->address->addressRegion; ?>">
							</div>
							<p class="text-right">
								<?php echo str_replace('<br>', ' ', $location->title); ?>
							</p>
							<p class="text-right">
								<a itemprop="telephone" class="fs-lg tel-link" href="tel:<?php echo $location->phone_number; ?>">
									<?php echo $location->phone_number; ?>
								</a>
							</p>
						</div>
					<?php endforeach ?>
				</div>
				<div class="tile pad-left-md pad-top-sm sm-pad-top-nil">
					<h2 class="hide">Hours</h2>
					<dl>
						<dt>Sunday to Thursday</dt>
							<dd>4pm - 12am</dd>
						<dt class="pad-top-sm">Friday and Saturday</dt>
							<dd>4pm - 1am</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
	<div class="cs-3 h-1 fx-in-shadow">
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
	<h3 itemprop="name" class="tile fs-mdlg">
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
		<div
			id="<?php echo url_slug($menu_section->title); ?>"
			<?php if (!empty($menu_section->image)): ?>
				style="background-image: url(../images/<?php echo $menu_section->image; ?>);"
			<?php endif ?>
			class="section-title text-on-img text-center fx-popout fs-xl sm-fs-xxl pad-md"
			>
			<?php echo $menu_section->title; ?>
		</div>
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
				<div
					itemscope
					itemtype="http://schema.org/Product"
					class="
						sm-tile
						sm-w-1-2
						pad-md
						tiles
						tiles-justify
						<?php if (!empty($menu_item->image)): ?>
							text-on-img
							fx-popout
						<?php endif ?>
					"
					<?php if (!empty($menu_item->image)): ?>
						style="background-image: url(../images/<?php echo $menu_item->image; ?>)"
					<?php endif ?>
				>
					<div class="tile max-w-3-4 pad-right-sm">
						<?php item_title($menu_item->title); ?>
					</div>
					<div class="tile">
						<?php item_price($menu_item->price); ?>
					</div>
					<!-- the above two tiles won't justify unless this is also a `.tile` -->
					<div itemprop="description" class="tile w-fill pad-top-md">
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
				<div
					itemscope
					itemtype="http://schema.org/Product"
					class="
						sm-tile
						sm-w-1-2
						pad-md
						<?php if (!empty($menu_item->image)): ?>
							text-on-img
							fx-popout
						<?php endif ?>
					"
					<?php if (!empty($menu_item->image)): ?>
						style="background-image: url(../images/<?php echo $menu_item->image; ?>)"
					<?php endif ?>
				>
					<?php item_title($menu_item->title); ?>
					<div itemprop="description" class="fs-mdsm">
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
			<div itemscope itemtype="http://schema.org/Product" class="tiles tiles-justify pad-top-md">
				<div class="tile max-w-3-4">
					<?php item_title($menu_item->title); ?>
				</div>
				<div class="tile">
					<?php item_price($menu_item->price); ?>
				</div>
				<div itemprop="description" class="tile w-fill pad-top-md">
					<?php echo Markdown::defaultTransform($menu_item->description); ?>
				</div>
			</div>
		<?php endforeach ?>
		<?php if (!empty($menu_section->end_notes)): ?>
			<div class="text-center pad-sm">
				<?php echo Markdown::defaultTransform($menu_section->end_notes); ?>
			</div>
		<?php endif ?>
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