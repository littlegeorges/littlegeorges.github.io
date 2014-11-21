<?php page_top('Little George\'s', $locations); ?>
<div class="tiles tiles-justify">
	<?php foreach ($locations as $location): ?>
		<a href="<?php echo $location->name; ?>" class="tile">
			<h2><?php echo $location->title; ?></h2>
			<p><?php echo $location->phone_number; ?></p>
		</a>
	<?php endforeach ?>
</div>
<?php page_bottom(); ?>