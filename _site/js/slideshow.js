(function(){
	var el_slides = document.getElementsByClassName('slideshow_slide');

	// Go through the list of slides and assign their background image based on their data-src attribute.
	// The images won't load while `.slideshow` is display: none;
	// See http://timkadlec.com/2012/04/media-query-asset-downloading-results/
	var num_slides = el_slides.length;
	for (var i = num_slides-1; i >= 0; i--) {
		var el_slide = el_slides[i];
		var image_src = el_slide.getAttribute('data-src');
		el_slide.style.backgroundImage = 'url('+image_src+')';
	}

	/**
	 * The images are stacked on top of each other. This function starts with the last slide (since it will have the highest z-index) and then sets opacity to 0 to reveal the next slide behind it. This continues on until it reaches the last slide. We don't want to change the opacity of the last slide since there are no slides to reveal behind it. Instead we return the first slide to its full opacity. After the first slide is fully opaque, we can return all slides to opacity=1 and start the process over again.
	 * @return void
	 */
	var runSlideshow = function() {
		var slide_index = num_slides-1;
		var first_slide = el_slides[slide_index];
		var current_slide = first_slide;
		var last_slide = el_slides[0];
		setInterval(function(){
			if (current_slide === last_slide) {
				first_slide.style.opacity = 1;
				setTimeout(resetOpacity, 1000);
			} else {
				current_slide.style.opacity = 0;
			}
			slide_index--;
			if (slide_index === -1) {
				slide_index = num_slides-1;
			}
			current_slide = el_slides[slide_index];
		}, 4000);
	};

	/**
	 * Sets opacity=1 for all of the slides
	 * @return {[type]} [description]
	 */
	var resetOpacity = function() {
		for (var i = num_slides-1; i >= 0; i--) {
			var el_slide = el_slides[i];
			el_slide.style.opacity = 1;
		}
	};

	runSlideshow();
})();