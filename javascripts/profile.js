
$(function() {
  $.get("php/top-frame-home.php", function(data) {
    $("body").append(data);
  });
  $.get("php/self-book.php", function(data) {
    $("body").append(data);
  });
  $.get("php/self-info-dialog.php", function(data) {
    $("body").append(data);
  });
  $.get("php/helpinfo-dialog.php", function(data) {
    $("body").append(data);
  });
});
