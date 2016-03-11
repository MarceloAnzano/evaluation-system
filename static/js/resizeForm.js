var $element = $(".card");
// var lastHeight = $(".card").css('height');
function checkForChanges()
{
    if ($element.height() != $cardLastHeight)
    {
    	console.log("Hello");
        alert('xxx');
        // $lastHeight = $element.css('height'); 
    }

    setTimeout(checkForChanges, 500);
}