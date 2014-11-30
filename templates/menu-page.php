<?php page_top('Little George\'s Menu for '.$location->title, [$location], '../', $location->name.'/'); ?>
<div class="md-table container">
	<div
		class="
			stack
			pad-top-mdlg
			pad-h-md
			pad-bottom-md

			md-pad-right-nil
			md-table-cell
			md-w-1-4

			sidebar-background
		"
	>
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
		<!-- A fixed position link to return us to the top of the page when we are scrolled down -->
		<a
			id="scroll-to-top"
			class="scroll-to-top pad-sm fs-sm"
			href="#">
				<img src="../images/up-arrow.svg" alt="back to top" title="back to top">
		</a>
		<!--
			When scroll past #activator-scroll-to-top we add/remove a class from #scroll-to-top.
			It is essentially a marker for when we want to show/hide #scroll-to-top
		-->
		<span id="activator-scroll-to-top"></span>
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
<script type="text/javascript" src="../js/menu-page.js"></script>
<?php page_bottom(); ?>