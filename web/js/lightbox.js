var lightbox = {
	last_model_id: '',
	
	initialize: function() {
		var links = $$('a.lightbox');
		
		links.each(function(link, i) {
			link.addEvent('click', function() {
				lightbox.show(link.rel, false);
			});
			
			var close_links = $$('#' + link.rel + ' .close');
			
			close_links.each(function(close_link, j) {
				close_link.addEvent('click', function() {
					lightbox.hide(false);
				});
			});
		});
	},
	
	show: function(model_id, use_overlay, duration, hide_flash) {
		if (use_overlay == null) use_overlay = true;
		if (duration == null) duration = 300;
		if (hide_flash == null) hide_flash = true;
		
		if (hide_flash) {
			var flash_objects = $$('object, embed');
			
			flash_objects.each(function(flash_object, i) {
				flash_object.setStyle('visibility', 'hidden');
			});
		}
		
		var body = $$('body')[0];
		
		if (use_overlay) {
			if (!$('overlay')) {
				var overlay = new Element('div', {
					id: 'overlay'
				});
				body.appendChild(overlay);
			} else {
				var overlay = $('overlay');
			}
			
			overlay.setStyles({
				'position': 'absolute',
				'top': 0,
				'left': 0,
				'width': window.getScrollWidth() + 'px',
				'height': window.getScrollHeight() + 'px'
			});
			
			new Fx.Style(overlay, 'opacity', {
				duration: duration,
				wait: false,
				onStart: function() {
					overlay.setStyle('display', '');
				}
			}).set(0).start(0.75);
		}
		
		if ($('container')) {
			var container = $('container');
			
			if (lightbox.last_model_id != model_id) container.empty();
		} else {
			var container = new Element('div', {
				id: 'container'
			});
			body.appendChild(container);
		}
		
		lightbox.last_model_id = model_id;
		$(model_id).getChildren().injectInside(container);
		
		container.setStyles({
			'position': 'absolute',
			'top': window.getScrollTop() + 'px',
			'left': window.getScrollLeft() + 'px',
			'width': window.getWidth() + 'px',
			'height': window.getHeight() + 'px'
		});
		
		new Fx.Style(container, 'opacity', {
			duration: duration,
			wait: false,
			onStart: function() {
				container.setStyle('display', '');
			}
		}).set(0).start(1);
	},
	
	hide: function(use_overlay, duration) {
		if (use_overlay == null) use_overlay = true;
		if (duration == null) duration = 300;
		
		var flash_objects = $$('object, embed');
		
		flash_objects.each(function(flash_object, i) {
			flash_object.setStyle('visibility', 'visible');
		});
		
		if (use_overlay) {
			var overlay = $('overlay');
			
			new Fx.Style(overlay, 'opacity', {
				duration: duration,
				wait: false,
				onComplete: function() {
					overlay.setStyle('display', 'none');
				}
			}).start(0);
		}
		
		var container = $('container');
		
		new Fx.Style(container, 'opacity', {
			duration: duration,
			wait: false,
			onComplete: function() {
				container.setStyle('display', 'none');
				container.getChildren().injectInside($(lightbox.last_model_id));
			}
		}).start(0);
	}
};

window.addEvent('load', lightbox.initialize);