
var dialog_login_register;

dialog_login_register = function(animate, hide1, hide2, show1, show2, move1, move2) {
  $(animate).animate({
    top: move1
  }, 500, function() {
    $(hide1).hide();
    $(hide2).hide();
    $(show1).show();
    $(show2).show();
    $(animate).animate({
      top: move2
    }, 500, function() {});
  });
};

$(function() {
  $("#login-back").on("click", function(event) {
    dialog_login_register(".dialog-form", "#login-form", "#h1-Login", "#register-form", "#h1-Register", "-300px", "0px");
  });
  $("#register-back").on("click", function(event) {
    dialog_login_register(".dialog-form", "#register-form", "#h1-Register", "#login-form", "#h1-Login", "-300px", "0px");
  });
  $("#login-form").submit(function() {
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        $("#alert-L h2").html(response);
      }
    });
    return false;
  });
  $("#register-form").submit(function() {
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        $("#alert-R h2").html(response);
      }
    });
    return false;
  });
});
