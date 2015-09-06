$(document).ready(function(){

/* ------------------------------------------------------------------------ */
/* BACK TO TOP BUTTON ACTION */
/* ------------------------------------------------------------------------ */	

	var btn = $('.back-to-top-btn');

	btn.hide();
	btn.on('click', function(e){
		$('html, body').animate({
			scrollTop: 0
		}, 500);
		e.preventDefault();
	});


	$(window).on('scroll', function(){
		var self = $(this),				//store current window position
			height = self.height(),		//store current window height
			top = self.scrollTop();		//store height of the window

		if(top > height){
			if(!btn.is(':visible')){
				btn.fadeIn();
			}
		}else{
			btn.hide();
		}	

	});

});//End Document	