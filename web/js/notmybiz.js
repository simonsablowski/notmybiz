function loadLibrary(url, callback) {
	var script = document.createElement('script');
	script.src = url;
	
	var head = document.getElementsByTagName('head')[0];
	var done = false;
	
	script.onload = script.onreadystatechange = function() {
		if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
			done = true;
			
			callback();
			
			script.onload = script.onreadystatechange = null;
			head.removeChild(script);
		}
	};
	
	head.appendChild(script);
}

function Gallery() {
	var self = this;
	self.currentSlide = {
		source: null,
		caption: null
	};
	
	self.construct = function() {
		self.startSlideshowFromHash();
		self.bindEvents();
	};
	
	self.startSlideshowFromHash = function() {
		if (document.location.hash) {
			var slide = $('#gallery .thumbnails .thumbnail a')[document.location.hash.slice(1) - 1];
			if (slide) {
				self.startSlideshow(slide);
			}
		}
	};
	
	self.bindEvents = function() {
		var startSlideshow = function(event) {
			self.startSlideshow(this);
			event.preventDefault();
		};
		
		var showPreviousSlide = function(event) {
			self.showPreviousSlide();
			event.preventDefault();
		};
		
		var showNextSlide = function(event) {
			self.showNextSlide();
			event.preventDefault();
		}
		
		var endSlideshow = function(event) {
			self.endSlideshow();
			event.preventDefault();
		};
		
		$('#gallery .thumbnails .thumbnail a').click(startSlideshow);
		$('#slideshow .previous a').click(showPreviousSlide);
		$('#slideshow .next a').click(showNextSlide);
		$('#slideshow .close a').click(endSlideshow);
		
		$(document).keydown(function(event) {
			switch (event.which) {
				case 13:
					startSlideshow(event);
					break;
				case 37:
					showPreviousSlide(event);
					break;
				case 39:
					showNextSlide(event);
					break;
				case 27:
					endSlideshow(event);
					break;
				default:
					return;
			}
		});
	};
	
	self.startSlideshow = function(firstSlide) {
		self.changeSlide(firstSlide);
		$('#slideshow').show();
	};
	
	self.changeSlide = function(slide) {
		self.currentSlide.source = $(slide).attr('href');
		self.currentSlide.caption = $(slide).attr('title');
		var image = $('<img>').attr('src', self.currentSlide.source).attr('title', self.currentSlide.caption).attr('alt', self.currentSlide.caption);
		$('#slideshow .current .image').html(image);
		$('#slideshow .current .caption').html(self.currentSlide.caption);
		self.changeHash($('a[href="' + self.currentSlide.source + '"]').parent('.thumbnail').index() + 1);
	};
	
	self.changeHash = function(hash) {
		if (hash == null) {
			history.pushState('', document.title, window.location.pathname);
		} else {
			document.location.hash = hash;
		}
	};
	
	self.showPreviousSlide = function() {
		var currentSlide = $('#gallery .thumbnails .thumbnail a[href="' + self.currentSlide.source + '"]');
		var previousSlide = currentSlide.parent('.thumbnail').prev().children('a').first();
		if ($(previousSlide).length == 0) {
			previousSlide = currentSlide.parent('.thumbnail').siblings().last().children('a').first();
		}
		self.changeSlide(previousSlide);
	};
	
	self.showNextSlide = function() {
		var currentSlide = $('#gallery .thumbnails .thumbnail a[href="' + self.currentSlide.source + '"]');
		var nextSlide = currentSlide.parent('.thumbnail').next().children('a').first();
		if ($(nextSlide).length == 0) {
			nextSlide = currentSlide.parent('.thumbnail').siblings().first().children('a').first();
		}
		self.changeSlide(nextSlide);
	};
	
	self.endSlideshow = function() {
		$('#slideshow').hide();
		self.changeHash(null);
	};
	
	self.construct();
}

loadLibrary('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', function() {
	$(document).ready(function() {
		var gallery = new Gallery;
	});
});