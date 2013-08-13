$(function(){

	// Menu

	$("#mobile_nav a").click(function(e){
		// Toggle navigation
		$("#global_nav").slideToggle(200);
		// Do not navigate to #
		return false;
		// Prevent default navigation to #
		e.PreventDefault();
	});
	
	// Timeago
	
	jQuery("time.timeago").timeago();

});