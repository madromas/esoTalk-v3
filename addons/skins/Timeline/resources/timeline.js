jQuery(document).ready(function($){
	var $timeline_block = $('.postList li');

	//hide timeline blocks which are outside the viewport
	$timeline_block.each(function(){
		if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
			$(this).find('.avatar, .postContent').addClass('is-hidden');
		}
	});

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		$timeline_block.each(function(){
			if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.avatar').hasClass('is-hidden') ) {
				$(this).find('.avatar, .postContent').removeClass('is-hidden').addClass('bounce-in');
			}
		});
	});
});