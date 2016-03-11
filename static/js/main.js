function onReady(callback) {
    var intervalID = window.setInterval(checkReady, 500);
    function checkReady() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
}

onReady(function(){
	//$('.loading').css("display","none");
	$('.loading').fadeOut("fast")
});

$(document).ready(function(e){
	$displayHeight = $(window).height();
	
	try{
		$subNav = $(".subNav").height();
	}
	catch (err){
		$subNav = 1;
	}

	$(".avatarHead").css("height",$subNav*0.7+"px");
	$(".avatarHead").css("width",$subNav*0.7+"px");
	$(".avatarHead").css("margin",$subNav*0.15+"px");
	$(".avatarHead").css("margin-right","0px");
	console.log($subNav)
	//$("footer").css("top",$displayHeight-50+"px");
	$totalHead = $("header").height() + $("nav").height();
	$availableDisplay = $displayHeight - $totalHead;
	$(".navbar-fixed").css("height",$totalHead+"px");
	$(".navImg").css("height",$totalHead+"px");
	$totalFoot = ($("footer").height()+parseInt($("footer").css("margin-top"))+parseInt($("footer").css("padding-top")));
	$contentHeight = $(".pageContent").height() + $totalFoot;
	console.log($availableDisplay);
	console.log($contentHeight);
	if($contentHeight < $availableDisplay){
		$contentHeight = $availableDisplay;
	}
	console.log($contentHeight);
	$(".pageContent").css("height",$contentHeight-$totalFoot- $subNav+"px");
	console.log($contentHeight-$totalHead)
	$(".contentWidth").css("width",$(window).width()+"px");
	// $forgotMarginBtm = parseInt($(".forgot").css("margin-bottom"));
	// $forgotMarginTop = parseInt($(".forgot").css("margin-top"));
	// $(".forgot").css("margin-top",$forgotMarginTop+$forgotMarginBtm+"px");
	// $(".forgot").css("margin-bottom","0px");

	$("input#partialbtn").css("height", $("i.btn").height()+"px");
});


//1 m6 push-m3