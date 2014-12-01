(function() {
	var el_lg_jump_menu = document.getElementById('lg-jump-menu');
	var top;

	var determineTopAndWidth = function() {
		el_lg_jump_menu.classList.remove('js-lg-jump-menu-fixed');
		el_lg_jump_menu.style.width = null;
		var original_width = window.getComputedStyle(el_lg_jump_menu).width;
		el_lg_jump_menu.style.width = original_width;
		var jump_menu_rect = el_lg_jump_menu.getBoundingClientRect();
		var body_rect = document.body.getBoundingClientRect();
		top = jump_menu_rect.top - body_rect.top;
		onscroll();
	};

	// Assuming that any custom fonts will have loaded
	// within half a second. This is an unreliable way
	// of doing it, but since this is not an important
	// feature, it's not a big deal if it breaks.
	// The only difference is that the sidebar will
	// "stick" a little earlier than intended.
	setTimeout(determineTopAndWidth, 500);

	window.addEventListener('resize', determineTopAndWidth);

	var onscroll = function(e) {
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (scrollTop >= top) {
			el_lg_jump_menu.classList.add('js-lg-jump-menu-fixed');
		} else
		if (scrollTop < top) {
			el_lg_jump_menu.classList.remove('js-lg-jump-menu-fixed');		
		}
	};
	window.addEventListener('scroll', onscroll);
})();
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