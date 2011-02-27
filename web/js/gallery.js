var gallery = {
	images: [],
	current_image: {},
	timer: null,
	
	initialize: function() {
		var links = $$('.gallery a');
		
		links.each(function(link, i) {
			var images = $$('.gallery img');
			var img = images.length > 0 ? $$('.gallery img')[i] : null;
			
			gallery.images[i] = {
				position: i,
				source: link.href,
				title: img ? img.title : link.title,
				description: img ? img.alt : link.rel
			};
			
			if (img) {
				img.addEvent('click', function() {
					gallery.current_image = gallery.images[i];
					gallery.show();
				});
				
				img.injectAfter(link);
			} else {
				gallery.current_image = gallery.images[0];
			}
			
			link.remove();
		});
		
		if ($('first_link')) $('first_link').addEvent('click', gallery.first);
		if ($('previous_link')) $('previous_link').addEvent('click', gallery.previous);
		if ($('next_link')) $('next_link').addEvent('click', gallery.next);
		if ($('last_link')) $('last_link').addEvent('click', gallery.last);
		if ($('play_link')) $('play_link').addEvent('click', gallery.play);
		if ($('stop_link')) $('stop_link').addEvent('click', gallery.stop);
		if ($('hide_link')) $('hide_link').addEvent('click', gallery.hide);
		if ($('current_image')) $('current_image').addEvent('click', gallery.hide);
	},
	
	show: function() {
		if (gallery.images.length < 1) return;
		
		gallery.update();
		lightbox.show('gallery');
	},
	
	hide: function() {
		gallery.stop();
		lightbox.hide();
		
		$('current_image').src = '';
		$('current_title').innerHTML = '';
		$('current_description').innerHTML = '';
	},
	
	update: function() {
		$('current_image').src = gallery.current_image.source;
		$('current_title').innerHTML = gallery.current_image.title;
		$('current_description').innerHTML = gallery.current_image.description;
		
		gallery.preload();
	},
	
	blend: function(update, stop) {
		if (stop == null) stop = true;
		if (stop) gallery.stop();
		
		var container = $('container');
		
		new Fx.Style(container, 'opacity', {
			duration: 200,
			wait: false,
			onComplete: function() {
				update();
				gallery.update();
				
				new Fx.Style(container, 'opacity', {
					duration: 200,
					wait: false
				}).start(1);
			}
		}).start(0.25);
	},
	
	preload: function() {
		var previous_position = (gallery.current_image.position - 1) % gallery.images.length;
		previous_position = previous_position >= 0 ? previous_position : gallery.images.length - 1;
		
		new Image().src = gallery.images[previous_position].source;
		new Image().src = gallery.images[(gallery.current_image.position + 1) % gallery.images.length].source;
	},
	
	first: function() {
		gallery.blend(function() {
			gallery.current_image = gallery.images[0];
		});
	},
	
	previous: function() {
		gallery.blend(function() {
			var previous_position = (gallery.current_image.position - 1) % gallery.images.length;
			previous_position = previous_position >= 0 ? previous_position : gallery.images.length - 1;
			gallery.current_image = gallery.images[previous_position];
		});
	},
	
	next: function() {
		gallery.blend(function() {
			gallery.current_image = gallery.images[(gallery.current_image.position + 1) % gallery.images.length];
		});
	},
	
	last: function() {
		gallery.blend(function() {
			gallery.current_image = gallery.images[gallery.images.length - 1];
		});
	},
	
	play: function() {
		var ch = new Chain();
		
		gallery.images.each(function(image, i) {
			ch.chain(function() {
				if (i < gallery.images.length - 1) {
					gallery.blend(function() {
						gallery.current_image = gallery.images[(gallery.current_image.position + 1) % gallery.images.length];
					}, false);
				}
			});
		});
		
		var rn = function() {
			ch.callChain();
			
			if (ch.chains.length == 0) gallery.stop();
		};
		
		gallery.timer = rn.periodical(4000);
		
		if ($('play_link') && $('stop_link')) {
			$('play_link').setStyle('display', 'none');
			$('stop_link').setStyle('display', '');
		}
	},
	
	stop: function() {
		$clear(gallery.timer);
		
		if ($('stop_link') && $('play_link')) {
			$('stop_link').setStyle('display', 'none');
			$('play_link').setStyle('display', '');
		}
	}
};

window.addEvent('load', gallery.initialize);