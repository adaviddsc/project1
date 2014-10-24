
$(function() {
  $.get("php/top-frame-home.php", function(data) {
    $("body").append(data);
    $.get("php/help-waterfall.php", function(data) {
      $("body").append(data);
    });   
    $.get("php/helpinfo-dialog.php", function(data) {
      $(".help-body-container").append(data);
    });
    $.get("php/donateinfo-dialog.php", function(data) {
      $(".donate-body-container").append(data);
    });
  });
});
