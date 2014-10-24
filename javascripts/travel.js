$(function() {
 	$.get("php/top-frame-home.php", function(data) {
    	$("body").append(data);
    	
    	$.get("php/travel-home.php", function(data) {
			$(".travel-container").append(data);
		});
		$.get("php/travel-traveler.php", function(data) {
			$(".travel-container").append(data);
		});
		$.get("php/user-comments.php", function(data) {
			$("body").append(data);
		});
  	});
	$("#link-travel-home").on("click", function(event) {
	    $(".traveler-container").hide();
	    $(".travelHome-container").fadeIn();
	});
	$("#link-travel-traveler").on("click", function(event) {
	    $(".traveler-container").fadeIn();
	    $(".travelHome-container").hide();
	});
});
