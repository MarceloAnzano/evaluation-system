// $(window).on('scroll',function(){
//     if($("nav").is('.pinned')){
//         $('#user-dropdown').css("top","0px");
//     }else{
//         $('#user-dropdown').css("top","90px");
//     }
// });
$("input[name=logid]").on("change.autofill", function () {
    $("[for=password]").addClass("active");
}).click(function() {
    $(this).unbind("change.autofill");
});
$("input[name=createLogid]").on("change.autofill", function () {
    $("[for=eval-create-pass]").addClass("active");
}).click(function() {
    $(this).unbind("change.autofill");
});
$(document).ready(function(){
    //Activate all select
    $('select').not('#createSectionSelect').material_select();
    
    //Fixed divs
    $('nav').pushpin({ top: 88, offset: 0 });
    
    //$('.subNav').pushpin({ top: 130, offset: 40 });
    $('#sidebar').pushpin({ top: 10, offset: -130 });
    
    $("#semestral-create select").change(function(event) {$("#semestral-create #status").text("");});
    $(".dropdown-button").dropdown({
        hover: true,
        belowOrigin: true,
        outDuration: 100,
    });
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav({
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    });

    //Modal Popups
    $('.modal-trigger').leanModal();
    // $('[data-toggle="popover"]').popover();
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
    $('#archive-ok').on('click', function(){
        $('#modal-archive-success').openModal();
    });
    $('#archive-button').on('click', function(){
        $sem1st = $('#faculty-1st-status').text();
        $sem2nd = $('#faculty-2nd-status').text();
        if($sem1st.toLowerCase().indexOf("not") >= 0 && $sem2nd.toLowerCase().indexOf("not")) $('#modal-archive-error').openModal();
        else $('#modal-archive-confirm').openModal();
    });
    $("#delete-eval-button1").on('click', function(){
        $sem1st = $('#faculty-1st-status').text();
        if($sem1st.toLowerCase().indexOf("not") >= 0) $('#modal-archive-error').openModal();
        else $('#modal-eval-delete-confirm1').openModal();
    });
    $("#delete-eval-button2").on('click', function(){
        $sem2nd = $('#faculty-2nd-status').text();
        if($sem2nd.toLowerCase().indexOf("not") >= 0) $('#modal-archive-error').openModal();
        else $('#modal-eval-delete-confirm2').openModal();
    });

    //error check
    $('.evalInputTd input').on('focusout',function(e){
        if($(this).val() > 4 || $(this).val() < 0){ 
            $(this).focus();
            $(this).addClass('invalid');
            $(this).closest('td').popover('show');
        }else{
            $(this).removeClass('invalid');
            $(this).closest('td').popover('hide');
            $(this).closest('td').popover('destroy');
        }
    });
    $("#evalSubmitBtn").on('click',function(e){
        e.stopImmediatePropagation();
        errorCheckEval();
        return false;
    });
    //csv tooltip
    $("#submit-csv-button").on('click', function(e){
        e.stopImmediatePropagation();
        $CSVflag = true;
        if($('#select-csv').val() == null){
            $('#csv-tooltip').popover('show');
            // $("#csv-tooltip.tooltipped").trigger("mouseenter.tooltip").delay(1500).queue(function(nxt){ $(this).trigger("mouseleave.tooltip"); nxt();});
            $CSVflag = false;
        }
        if($("#csv-file").val() == ""){
            $('#csv-file-tooltip').popover('show');
            // $("#csv-file-tooltip.tooltipped").trigger("mouseenter.tooltip").delay(1500).queue(function(nxt){ $(this).trigger("mouseleave.tooltip"); nxt();});
            $CSVflag = false;
        }
        if($CSVflag == false) return false;
        else $('#questionnaireForm').submit();
    });
    $('form #csv-tooltip').on('mouseenter',function(e){
        $('form #csv-tooltip').popover('hide');
        $('form #csv-tooltip').popover('destroy');
    });
    $('form #csv-file-tooltip').on('mouseenter',function(e){
        $('form #csv-file-tooltip').popover('hide');
        $('form #csv-file-tooltip').popover('destroy');
    });

    //image tooltip
    $("#submit-img-button").on('click', function(e){
        e.stopImmediatePropagation();
        $IMGFlag = true;
        if($('#select-img-user').val() == null){
            $('form #img-tooltip').popover('show');
            //$("#img-tooltip.tooltipped").trigger("mouseenter.tooltip").delay(1500).queue(function(nxt){ $(this).trigger("mouseleave.tooltip"); nxt();});
            $IMGFlag = false;
        }
        if($("#img-file").val() == ""){
            console.log("HEY!");
            $('form #img-file-tooltip').popover({show: function () {$(this).fadeIn('slow');}});
            // $("#img-file-tooltip.tooltipped").trigger("mouseenter.tooltip").delay(1500).queue(function(nxt){ $(this).trigger("mouseleave.tooltip"); nxt();});
            $IMGFlag = false;
        }
        if($IMGFlag == false) return false;
        else $('#facultyPhotoForm').submit();
    });
    $('form #img-tooltip').on('mouseenter',function(e){
        $('form #img-tooltip').popover('hide');
        $('form #img-tooltip').popover('destroy');
    });
    $('form #img-file-tooltip').on('mouseenter',function(e){
        $('form #img-file-tooltip').popover('hide');
        $('form #img-file-tooltip').popover('destroy');
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
    })
})

$(document).on('click','#exportThisScores', function(e){
    $filename = $('.table-title-here h6').text();
    $('#ratings-table').TableCSVExport({
        delivery: 'download',
        filename: 'Scores '+$filename+'.csv',
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
function errorCheckEval(){
    var wrongInputFlag = false;
    $('.evalInputTd input').each(function(e){
        if($(this).val() > 4 || $(this).val() < 0){ 
            $(this).focus();
            $(this).addClass('invalid');
            $(this).closest('td').popover('show');
            wrongInputFlag = true;
        }else{
            $(this).removeClass('invalid');
            $(this).closest('td').popover('hide');
            $(this).closest('td').popover('destroy');
        }
    });
    if(wrongInputFlag == false) $('#modal-submit-eval').openModal();
};