$("document").ready (function(){	
	setProps();
});

function setProps(){
	var currentYear = new Date().getFullYear();
	$("#year").text(currentYear);

	// Show or hide the sticky footer button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('.go-top').fadeIn(200);
        } else {
            $('.go-top').fadeOut(200);
        }
    });
    
    // Animate the scroll to top
    $('.go-top').click(function(event) {
        event.preventDefault();
        
        $('html, body').animate({scrollTop: 0}, 300);
    });

}

function goBack() {
	window.history.back();
}