$(document).ready(function() {
	$('a').filter(function() {
		return this.hostname && this.hostname !== location.hostname;
	}).addClass('external');
	
	$('a.external').click(function(e) {
		open(this.href);
		e.preventDefault();
	});
});