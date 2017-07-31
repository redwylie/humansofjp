$("document").ready (function(){	
	setProps();
});

function setProps(){
	var currentYear = new Date().getFullYear();
	$("#year").text(currentYear);

	// DIGITILER SPECIFIC
	$('.hidden-info').hide();
	$('.show-info').click(function() {
		$('.hidden-info').toggle();
	});

	var width = $(window).width();
	width = width - 30;
  	$('#openseadragon').css({'width' : width});

	var height = $(window).height();
	height = height - 80;
	$('#openseadragon').css({'height' : height});
	// END DIGITILER SPECIFIC
}

function goBack() {
	window.history.back();
}