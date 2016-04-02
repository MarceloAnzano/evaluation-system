$(window).on('scroll', function(){
//	console.log(window.pageYOffset);
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
    $('select').not('#createSectionSelect').material_select();
    $('nav').pushpin({ top: 88, offset: 0 });
    //$('.subNav').pushpin({ top: 130, offset: 40 });
    $('#sidebar').pushpin({ top: 10, offset: -130 });
    $("#semestral-create select").change(function(event) {
    	$("#semestral-create #status").text("");
    });
    $('.modal-trigger').leanModal();
    $('.scrollspy').scrollSpy();
    // $("#maincontent input").attr('autocomplete','off');
    // $('a.delete-user2').click(function(e) {
    //     return deleteUser(this.href);
    // });
    $('.button-collapse').sideNav({
      menuWidth: 240, // Default is 240
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    });
    $("#linkSpace").bind("DOMSubtreeModified", function() {
        attachDeleteUser();
    });
    $('.error-message').bind("DOMSubtreeModified", function() {
        $status = $(this).html();
        if($status.length > 1){
            $('#modal-error-message h5').html($status);
            $('#modal-error-message').openModal();
            $(this).html("");
        }
    });
    $('#submit-eval-yes').on('click', function(){
        $('#evalform').submit();
    });
});
$(document).on('change','#createSectionSelect', function(){
    if($('#createSectionSelect').val() != ""){
        $('label[for="createSectionGradelevel"], label[for="createSectionSection"]').addClass('active');
    }else{
        $('label[for="createSectionGradelevel"], label[for="createSectionSection"]').removeClass('active');
    }
});

$(document).on('click','#exportThisRatings', function(e){
    $('#ratings-table').TableCSVExport({
        delivery: 'download',
        filename: 'Ratings.csv',
        header: ['Teacher','TC Score','EA Score','AP Score','Student Score','Rating']
    })
})

$(document).on('click','#exportThisScores', function(e){
    $('#ratings-table').TableCSVExport({
        delivery: 'download',
        filename: 'Scores.csv',
        header: ['Evaluator','Faculty Evaluated','TC Score','EA Score','AP Score','Student Score','Evaluation Type']
    })
})
function attachDeleteUser(){
    $('a.delete-user2').click(function(e) {
        e.stopImmediatePropagation();
        $href = $(this).attr("href");
        $('.delete-ok2').attr("href",$href);
        $('#modal-delete-confirm2').openModal();
        return false;
    });
    $('a.delete-user1').click(function(e) {
        e.stopImmediatePropagation();
        $href = $(this).attr("href");
        $('.delete-ok1').attr("href",$href);
        $('#modal-delete-confirm1').openModal();
        return false;
    });
}