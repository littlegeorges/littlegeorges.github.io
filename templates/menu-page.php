<?php page_top('Menu - Little George\'s', [$location], '../'); ?>
<div class="md-table container">
	<div class="stack md-table-cell md-w-1-4 pad-left-md sidebar-background">
		<ul id="lg-jump-menu" class="stack lg-jump-menu">
			<?php foreach ($location->menu as $i => $menu_section): ?>
				<li class="stack lg-jump-menu_item fs-mdsm lg-fs-md">
					<a
						class="lg-jump-menu_link"
						href="#<?php echo url_slug($menu_section->title); ?>"
					>
						<?php echo $menu_section->title; ?>
					</a>
				</li>
			<?php endforeach ?>
			<li class="stack lg-jump-menu_item pad-v-sm">
				<h2 class="cs-4 pad-bottom-sm text-center fs-mdsm">
					DAILY PICK-UP SPECIALS
				</h2>
				<div class="tiles">
					<div class="tile w-1-3 text-center fs-mdsm">
						SMALL<br>
						$7.95<br>
						<span class="fs-sm">2 Toppings</span>
					</div>
					<div class="tile w-1-3 text-center fs-mdsm">
						MEDIUM<br>
						$9.95<br>
						<span class="fs-sm">2 Toppings</span>
					</div>
					<div class="tile w-1-3 text-center fs-mdsm">
						LARGE<br>
						$12.95<br>
						<span class="fs-sm">2 Toppings</span>
					</div>
				</div>

				<h2 class="cs-4 text-center pad-top-sm fs-mdsm">
					Tuesday Night is Pasta Night
				</h2>
				<p class="text-center fs-mdsm">
					Pick-up or Dine-in $7.95
				</p>
			</li>
		</ul>
	</div>
	<div class="stack md-pad-left-md md-table-cell md-w-3-4 tiles tiles-center">
		<?php
		foreach ($location->menu as $menu_section) {
			switch ($menu_section->display_format) {
				case 'pizza':
					pizza_menu_section($menu_section);
					break;
				
				case 'mini':
					mini_menu_section($menu_section);
					break;

				case 'table':
					table_menu_section($menu_section);
					break;

				default:
					standard_menu_section($menu_section);
					break;
			}
		}
		?>
	</div>
</div>
<script type="text/javascript" src="../js/lg-jump-menu.js"></script>
<?php page_bottom(); ?>