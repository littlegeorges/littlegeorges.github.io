(function(){
	var el_slides = document.getElementsByClassName('slideshow_slide');

	var num_slides = el_slides.length;
	for (var i = num_slides-1; i >= 0; i--) {
		var el_slide = el_slides[i];
		el_slide.style.backgroundImage = 'url('+el_slide.getAttribute('data-src')+')';
		el_slide.ready_for_transition = true;
	}

	var resetOpacity = function() {
		for (var i = num_slides-1; i >= 0; i--) {
			var el_slide = el_slides[i];
			el_slide.style.opacity = 1;
		}
	};

	var slide_index = num_slides-1;
	var first_slide = el_slides[slide_index];
	var current_slide = first_slide;
	var last_slide = el_slides[0];
	setInterval(function(){
		if (current_slide.ready_for_transition) {
			if (current_slide === last_slide) {
				first_slide.style.opacity = 1;
				setTimeout(resetOpacity, 100);
			} else {
				current_slide.style.opacity = 0;
			}
			slide_index--;
			if (slide_index === -1) {
				slide_index = num_slides-1;
			}
			current_slide = el_slides[slide_index];
		}
	}, 4000);
})();