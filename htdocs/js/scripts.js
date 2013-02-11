jQuery(document).ready(function() {    
	$(".signin").click(function() {
        $("div#show-login").fadeIn();
        $("#Login").focus();
        $(".signin").toggleClass("menu-open");
		return false;
    });

    $("div#show-login").mouseup(function() {
        return false
    });
    $(document).mouseup(function(e) {
        if($(e.target).parent(".signin").length==0) {
            $(".signin").removeClass("menu-open");
            $("div#show-login").fadeOut();
        }
    });
	$(".closebtn").click(function() { 
	   $(".signin").removeClass("menu-open");
	   $("div#show-login").fadeOut();
	});
});