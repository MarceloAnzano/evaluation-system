$(window).on('scroll', function(){
	console.log(window.pageYOffset);
// 	if(window.pageYOffset < 100){
// 		$('#sidebar').css('top',window.pageYOffset + 90 +"px")
// 	}else{
// 		$('#sidebar').css('top', 90+"px");
// 	}
// 	//checkScroll = (window.pageYOffset > 88);
// 	//checkScrollSide = (window.pageYOffset > 150);
// 		//$("nav").toggleClass('fixed',checkScroll);
// 		//$("#sidebar").toggleClass('fixedSidebar',checkScrollSide);
// 		// $("#maincontent").toggleClass('fixedMainContent',checkScrollSide);
// 		// $(".subNav").toggleClass('fixed',checkScroll);
// 		//$("main").toggleClass('scrollHeight',checkScroll);
});
$(document).ready(function(){
	// $('.scrollHeight').css('heach()eight',$('main').height()-$('subNav').height()+'px');
	$("#eval-card").each(function(){});
	if($('#password').text()!=""){
		$('password-label').addClass('active');
	}
    $('select').material_select();
    $('nav').pushpin({ top: 88, offset: 0 });
    $('.subNav').pushpin({ top: 130, offset: 40 });
    $('#sidebar').pushpin({ top: 5, offset: -100 });
    $("#semestral-create select").change(function(event) {
    	console.log("hey");
    	$("#semestral-create #status").text("");
    });
    $('.modal-trigger').leanModal();
    $('.scrollspy').scrollSpy();
    // $("#maincontent input").attr('autocomplete','off');
});
