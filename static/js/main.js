// $(window).on('scroll',function(){
//     if($("nav").is('.pinned')){
//         $('#user-dropdown').css("top","0px");
//     }else{
//         $('#user-dropdown').css("top","90px");
//     }
// });
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

    //csv tooltip
    $("#submit-csv-button").on('click', function(e){
        e.stopImmediatePropagation();
        $CSVflag = true;
        if($('#select-csv').val() == null){
            $('#csv-tooltip').addClass('tooltipped');
            $('#csv-tooltip.tooltipped').tooltip({delay: 50});
            $("#csv-tooltip.tooltipped").trigger("mouseenter.tooltip").delay(1500).queue(function(nxt){ $(this).trigger("mouseleave.tooltip"); nxt();});
            $CSVflag = false;
        }
        if($("#csv-file").val() == ""){
            $('#csv-file-tooltip').addClass('tooltipped');
            $('#csv-file-tooltip.tooltipped').tooltip({delay: 50});
            $("#csv-file-tooltip.tooltipped").trigger("mouseenter.tooltip").delay(1500).queue(function(nxt){ $(this).trigger("mouseleave.tooltip"); nxt();});
            $CSVflag = false;
        }
        if($CSVflag == false) return false;
        else $('#questionnaireForm').submit();
    });
    $('#csv-tooltip').on('mouseenter',function(e){
        $('#csv-tooltip').removeClass('tooltipped');
        $('#csv-tooltip').tooltip('remove');
    });
    $('#csv-file-tooltip').on('mouseenter',function(e){
        $('#csv-file-tooltip').removeClass('tooltipped');
        $('#csv-file-tooltip').tooltip('remove');
    });

    //image tooltip
    $("#submit-img-button").on('click', function(e){
        e.stopImmediatePropagation();
        $IMGFlag = true;
        if($('#select-img-user').val() == null){
            $('#img-tooltip').addClass('tooltipped');
            $('#img-tooltip.tooltipped').tooltip({delay: 50});
            $("#img-tooltip.tooltipped").trigger("mouseenter.tooltip").delay(1500).queue(function(nxt){ $(this).trigger("mouseleave.tooltip"); nxt();});
            $IMGFlag = false;
        }
        if($("#img-file").val() == ""){
            $('#img-file-tooltip').addClass('tooltipped');
            $('#img-file-tooltip.tooltipped').tooltip({delay: 50});
            $("#img-file-tooltip.tooltipped").trigger("mouseenter.tooltip").delay(1500).queue(function(nxt){ $(this).trigger("mouseleave.tooltip"); nxt();});
            $IMGFlag = false;
        }
        if($IMGFlag == false) return false;
        else $('#facultyPhotoForm').submit();
    });
    $('#img-tooltip').on('mouseenter',function(e){
        $('#img-tooltip').removeClass('tooltipped');
        $('#img-tooltip').tooltip('remove');
    });
    $('#img-file-tooltip').on('mouseenter',function(e){
        $('#img-file-tooltip').removeClass('tooltipped');
        $('#img-file-tooltip').tooltip('remove');
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