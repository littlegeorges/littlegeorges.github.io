<?php page_top('Little George\'s Menu for '.$location->title, [$location], '../', $location->name.'/'); ?>
<div class="md-table container">
	<div
		class="
			stack
			pad-top-mdlg
			pad-h-md
			pad-bottom-md

			sm-pad-h-sm

			md-h-md
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
			<li class="stack lg-jump-menu_item pad-sm">
				<h2 class="cs-4 text-center fs-md pad-bottom-sm">
					DAILY PICK-UP SPECIAL
				</h2>
				<h3 class="fs-mdsm text-center pad-bottom-sm">Any 2 Topping Pizza</h3>
				<div class="tiles">
					<div class="tile w-1-3 text-center fs-mdsm">
						SM<br>
						$7.95
					</div>
					<div class="tile w-1-3 text-center fs-mdsm">
						MD<br>
						$9.95
					</div>
					<div class="tile w-1-3 text-center fs-mdsm">
						LG<br>
						$12.95
					</div>
				</div>

				<h2 class="cs-4 text-center pad-v-sm fs-md">
					Pasta Night Tuesday
				</h2>
				<p class="text-center fs-mdsm">
					Pick-up or Dine-in $7.95
				</p>
			</li>
		</ul>
	</div>
	<div class="stack md-pad-left-md md-table-cell md-w-3-4 tiles tiles-center">
		<?php if (!empty($location->download_menu_file)): ?>
			<div class="tiles tiles-right pad-right-sm sm-pad-right-nil">
				<a class="tile main-content-link" href="<?php echo $location->download_menu_file; ?>">
					Click Here to Download Menu
				</a>
			</div>
		<?php endif ?>

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