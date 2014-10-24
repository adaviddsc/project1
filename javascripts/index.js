
$(function() {
  $.get("php/top-frame-login.php", function(data) {
    $("body").append(data);
  });
  $.get("php/index-login_register-dialog.php", function(data) {
    $("body").append(data);
  });
  $.get("php/index-language-dialog.php", function(data) {
    $("body").append(data);
  });
});


