
$(function() {
	$.get("php/top-frame-home.php", function(data) {
		$("body").append(data);
		$.get("php/search-result.php", function(data) {
		    $("body").append(data);
		});
	});
});


