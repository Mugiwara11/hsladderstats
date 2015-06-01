$( document ).ready(function() {
	var url = window.location.href;
	console.log(url);
	if(url.indexOf('rogue') > -1){
		console.log('rogue');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadarogue.jpg');
	}
	if (url.indexOf('warrior') > -1){
		console.log('warrior');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadawarrior.jpg');
	}
	if (url.indexOf('warlock') > -1){
		console.log('warlock');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadawarlock.jpg');
	}
	if (url.indexOf('hunter') > -1){
		console.log('hunter');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadahunter.jpg');
	}
	if (url.indexOf('druid') > -1){
		console.log('druid');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadadruid.jpg');
	}
	if (url.indexOf('shaman') > -1){
		console.log('shaman');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadashaman.jpg');
	}
	if (url.indexOf('paladin') > -1){
		console.log('paladin');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadapaladin.jpg');
	}
	if (url.indexOf('mage') > -1){
		console.log('mage');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadamage.jpg');
	}
	if (url.indexOf('priest') > -1){
		console.log('priest');
		$('.imagen-portada').attr('src','../src/App/Templates/img/hsportadapriest.jpg');
	}
	$('.dropdown').on('click', function(e) {
		$(this).find('.submenu').toggleClass('active');	
	});
});