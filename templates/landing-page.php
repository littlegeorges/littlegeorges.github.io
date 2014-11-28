<?php
	$slideshow_images = array_reverse(array_slice(scandir('images/slideshow'), 2));
?>
<?php page_top('Little George\'s', $locations); ?>
<div class="container pad-v-lg pad-h-md">
	<div class="slideshow">
		<?php foreach ($slideshow_images as $slideshow_image): ?>
			<div class="slideshow_slide" data-src="images/slideshow/<?php echo $slideshow_image; ?>"></div>
		<?php endforeach ?>
	</div>
	<p class="text-center fs-xl">
		Choose a Location:
	</p>
	<div class="tiles tiles-center">
		<?php foreach ($locations as $location): ?>
			<div class="tile pad-lg">
				<a href="<?php echo $location->name; ?>" class="stack location-link">
					<h2><?php echo $location->title; ?></h2>
					<p class="fs-sm"><?php echo $location->phone_number; ?></p>
					<p class="fs-sm"><?php echo $location->address; ?></p>
				</a>
			</div>
		<?php endforeach ?>
	</div>
	<div class="readable content h-align-middle">
		<hr>
		<p>Here at Little George’s, we serve a vast array of delectable Mediterranean-style foods like cannelloni, fettuccine, lasagna, spaghetti and more. We also serve tender steaks, juicy burgers, tasty chicken, and the most delicious, fall-off-the-bone ribs in town.</p>
		<p>Are you a salad lover? We have a variety of salads featuring the freshest ingredients, including our Chef’s Salad, Caesar Salad, Teriyaki Chicken Caesar Salad, and more.</p>
		<p>We’re a small, family-owned restaurant serving generous portions, along with a wide variety of beverages (alcoholic and non-alcoholic). That’s why Little George’s restaurant has become a treasured dining spot in Nanaimo where locals love to congregate.</p>
		<p>Offering dine in, take out or delivery, stop by Little George’s for great-tasting food today!</p>
	</div>
</div>
<script type="text/javascript" src="js/slideshow.js"></script>
<?php page_bottom(); ?>