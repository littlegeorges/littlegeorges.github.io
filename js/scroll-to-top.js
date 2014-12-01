(function() {
	var el_scroll_to_top = document.getElementById('scroll-to-top');
	var el_activator_scroll_to_top = document.getElementById('activator-scroll-to-top');

	var is_showing = false;

	var showScrollElement = function() {
		el_scroll_to_top.classList.add('js-scroll-to-top-shown');
		is_showing = true;
	};

	var hideScrollElement = function() {
		el_scroll_to_top.classList.remove('js-scroll-to-top-shown');
		is_showing = false;
	};

	var top;
	var determineTop = function() {
		var activator_scroll_to_top_rect = el_activator_scroll_to_top.getBoundingClientRect();
		var body_rect = document.body.getBoundingClientRect();
		top = activator_scroll_to_top_rect.top - body_rect.top;
	};

	var check = function() {
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (!top) determineTop();
		if (!is_showing && scrollTop > top) {
			showScrollElement();
		}
		if (is_showing && scrollTop <= top) {
			hideScrollElement();
		}
	};
	window.addEventListener('scroll', check);
})();