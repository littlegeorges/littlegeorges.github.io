/*! @source http://purl.eligrey.com/github/classList.js/blob/master/classList.js*/
;if("document" in self&&!("classList" in document.createElement("_"))){(function(j){"use strict";if(!("Element" in j)){return}var a="classList",f="prototype",m=j.Element[f],b=Object,k=String[f].trim||function(){return this.replace(/^\s+|\s+$/g,"")},c=Array[f].indexOf||function(q){var p=0,o=this.length;for(;p<o;p++){if(p in this&&this[p]===q){return p}}return -1},n=function(o,p){this.name=o;this.code=DOMException[o];this.message=p},g=function(p,o){if(o===""){throw new n("SYNTAX_ERR","An invalid or illegal string was specified")}if(/\s/.test(o)){throw new n("INVALID_CHARACTER_ERR","String contains an invalid character")}return c.call(p,o)},d=function(s){var r=k.call(s.getAttribute("class")||""),q=r?r.split(/\s+/):[],p=0,o=q.length;for(;p<o;p++){this.push(q[p])}this._updateClassName=function(){s.setAttribute("class",this.toString())}},e=d[f]=[],i=function(){return new d(this)};n[f]=Error[f];e.item=function(o){return this[o]||null};e.contains=function(o){o+="";return g(this,o)!==-1};e.add=function(){var s=arguments,r=0,p=s.length,q,o=false;do{q=s[r]+"";if(g(this,q)===-1){this.push(q);o=true}}while(++r<p);if(o){this._updateClassName()}};e.remove=function(){var t=arguments,s=0,p=t.length,r,o=false;do{r=t[s]+"";var q=g(this,r);if(q!==-1){this.splice(q,1);o=true}}while(++s<p);if(o){this._updateClassName()}};e.toggle=function(p,q){p+="";var o=this.contains(p),r=o?q!==true&&"remove":q!==false&&"add";if(r){this[r](p)}return !o};e.toString=function(){return this.join(" ")};if(b.defineProperty){var l={get:i,enumerable:true,configurable:true};try{b.defineProperty(m,a,l)}catch(h){if(h.number===-2146823252){l.enumerable=false;b.defineProperty(m,a,l)}}}else{if(b[f].__defineGetter__){m.__defineGetter__(a,i)}}}(self))};
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
	var scrollToTop = function() {
		window.scrollTo(0,0);
	};
	el_scroll_to_top.addEventListener('click',scrollToTop);
})();