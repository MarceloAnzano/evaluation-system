$(window).on('scroll', function(){
	checkScroll = (window.pageYOffset > 88);
		$("nav").toggleClass('fixed',checkScroll);
		// $(".subNav").toggleClass('fixed',checkScroll);
		//$("main").toggleClass('scrollHeight',checkScroll);
});
$(document).ready(function(){
	// $('.scrollHeight').css('heach()eight',$('main').height()-$('subNav').height()+'px');
	$("#eval-card").each(function(){});
	if($('#password').text()!=""){
		$('password-label').addClass('active');
	}
});