$( document ).ready(function() {
	$('.dropdown').on('click', function(e) {
		$(this).find('.submenu').toggleClass('active');	
	});
});