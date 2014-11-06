$(function() {
 	$.get("php/top-frame-home.php", function(data) {
    	$("body").append(data);
    	$.get("php/travel-waterfall.php", function(data) {
			$(".travel-container").append(data);
		});
    	$.get("php/travel-home.php", function(data) {
			$(".travel-container").append(data);
		});
		$.get("php/travel-traveler.php", function(data) {
			$(".travel-container").append(data);
		});
		$.get("php/travelinfo-dialog.php", function(data) {
	      $(".travel-container").append(data);
	    });
		$.get("php/user-comments.php", function(data) {
			$("body").append(data);
		});
		
  	});
	$("#link-travel-home").on("click", function(event) {
	    $(".traveler-container").hide();
	    $(".travelHome-container").fadeIn();
	    $(".travelWaterfall-container").hide();
	});
	$("#link-travel-traveler").on("click", function(event) {
	    $(".traveler-container").fadeIn();
	    $(".travelHome-container").hide();
	    $(".travelWaterfall-container").hide();
	});
	$("#link-travel-waterfall").on("click", function(event) {
	    $(".traveler-container").hide();
	    $(".travelHome-container").hide();
	    $(".travelWaterfall-container").fadeIn();
	});
});
