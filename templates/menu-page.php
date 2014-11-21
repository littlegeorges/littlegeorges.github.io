<?php page_top('Menu - Little George\'s', [$location], '../'); ?>
<div class="md-table container">
	<div class="cs-1 stack md-table-cell md-w-1-4 pad-left-md">
		<ul class="stack lg-jump-menu">
			<?php foreach ($location->menu as $i => $menu_section): ?>
				<li class="stack lg-jump-menu_item">
					<a
						class="lg-jump-menu_link"
						href="#<?php echo url_slug($menu_section->title); ?>"
					>
						<?php echo $menu_section->title; ?>
					</a>
				</li>
			<?php endforeach ?>
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
<?php page_bottom(); ?>