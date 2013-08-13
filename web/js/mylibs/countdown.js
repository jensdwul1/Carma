$(function(){

$(".countdown").each(function(){
	
	// Variables for year
	var targetYear = 2012;
	var targetMonth = 12;
	var targetDay = 25;
	
	// create new datetime objects
	var d = $(this).attr("datetime");
	
	// split on space
	var array1 = d.split(" ");
	// split on - on date
	var array2 = array1[0].split("-");
	// set target year, month and day
	targetYear = array2[0];
	targetMonth = array2[1];
	targetDay = array2[2];
	
	$(this).countdown({
		// set countdown for this object with target parameters
		until: new Date(targetYear, targetMonth - 1, targetDay),
		format: 'dHM'});
	});
});

$(".countdown_compact").each(function(){
	
	// Variables for year
	var targetYear = 2012;
	var targetMonth = 12;
	var targetDay = 25;
	
	// create new datetime objects
	var d = $(this).attr("datetime");
	
	// split on space
	var array1 = d.split(" ");
	// split on - on date
	var array2 = array1[0].split("-");
	// set target year, month and day
	targetYear = array2[0];
	targetMonth = array2[1];
	targetDay = array2[2];
	
	$(this).countdown({
		// set countdown for this object with target parameters
		until: new Date(targetYear, targetMonth - 1, targetDay),
		compact: true
		});
});

$(".countdown_withseconds").each(function(){
	
	// Variables for year
	var targetYear = 2012;
	var targetMonth = 12;
	var targetDay = 25;
	
	// create new datetime objects
	var d = $(this).attr("datetime");
	
	// split on space
	var array1 = d.split(" ");
	// split on - on date
	var array2 = array1[0].split("-");
	// set target year, month and day
	targetYear = array2[0];
	targetMonth = array2[1];
	targetDay = array2[2];
	
	$(this).countdown({
		// set countdown for this object with target parameters
		until: new Date(targetYear, targetMonth - 1, targetDay)
		});
});