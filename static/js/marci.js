$(window).on('scroll', function(){
});
$(document).ready(function(){
	// if($('#password').text()!=""){
	// 	$('password-label').addClass('active');
	// }
    //Activate all select
    $('select').not('#createSectionSelect').material_select();
    
    //Fixed divs
    $('nav').pushpin({ top: 88, offset: 0 });
    //$('.subNav').pushpin({ top: 130, offset: 40 });
    $('#sidebar').pushpin({ top: 10, offset: -130 });
    
    $("#semestral-create select").change(function(event) {
    	$("#semestral-create #status").text("");
    });

    //Activate Modal triggers
    $('.modal-trigger').leanModal();
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav({
      menuWidth: 240, // Default is 240
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    });
    // $("#ratings-table").tablesorter();
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
    $filename = $('.table-title-here h6').text();
    $('#ratings-table').TableCSVExport({
        delivery: 'download',
        filename: 'Ratings '+$filename+'.csv',
        //header: ['Teacher','TC Score','EA Score','AP Score','Student Score','Rating']
    })
})

$(document).on('click','#exportThisScores', function(e){
    $filename = $('.table-title-here h6').text();
    $('#ratings-table').TableCSVExport({
        delivery: 'download',
        filename: 'Scores '+$filename+'.csv',
        //header: ['Evaluator','Faculty Evaluated','TC Score','EA Score','AP Score','Student Score','Evaluation Type']
    })
})

$(document).on('click','a.delete-user2', function(e){
    e.stopImmediatePropagation();
    $href = $(this).attr("href");
    $('.delete-ok2').attr("href",$href);
    $('#modal-delete-confirm2').openModal();
    return false;
});

$(document).on('click','a.delete-user1', function(e){
    e.stopImmediatePropagation();
    $href = $(this).attr("href");
    $('.delete-ok1').attr("href",$href);
    $('#modal-delete-confirm1').openModal();
    return false;
});