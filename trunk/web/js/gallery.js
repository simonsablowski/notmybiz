$(document).ready(function($) {
	var onMouseOutOpacity = 0.5;
	$('#gallery ul.thumbs li').opacityrollover({
		mouseOutOpacity: onMouseOutOpacity,
		mouseOverOpacity: 1.0,
		fadeSpeed: 'fast',
		exemptionSelector: '.selected'
	});
	
	var gallery = $('#gallery').galleriffic({
		numThumbs: 10,
		preloadAhead: 10,
		enableBottomPager: false,
		imageContainerSel: '#slideshow',
		loadingContainerSel: '#loading',
		enableHistory: true,
		onSlideChange: function(prevIndex, nextIndex) {
			this.find('ul.thumbs').children()
				.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
				.eq(nextIndex).fadeTo('fast', 1.0);
		},
		onPageTransitionOut: function(callback) {
			this.fadeTo('fast', 0.0, callback);
		},
		onPageTransitionIn: function() {
			var prevPageLink = this.find('a.previous').css('visibility', 'hidden');
			var nextPageLink = this.find('a.next').css('visibility', 'hidden');
			
			if (this.displayedPage > 0)
				prevPageLink.css('visibility', 'visible');
			
			var lastPage = this.getNumPages() - 1;
			if (this.displayedPage < lastPage)
				nextPageLink.css('visibility', 'visible');
			
			this.fadeTo('fast', 1.0);
		}
	});
	
	gallery.find('a.previous').click(function(e) {
		gallery.previousPage();
		e.preventDefault();
	});
	
	gallery.find('a.next').click(function(e) {
		gallery.nextPage();
		e.preventDefault();
	});
	
	$.historyInit(function(hash) {
		if (hash) {
			$.galleriffic.gotoImage(hash);
		} else {
			gallery.gotoIndex(0);
		}
	}, 'advanced.html');
	
	$('a[rel="history"]').live('click', function(e) {
		if (e.button != 0) return true;
		
		var hash = this.href;
		hash = hash.replace(/^.*#/, '');
		
		$.historyLoad(hash);
		
		return false;
	});
});