
var SetCookie, delCookie, getCookie;

SetCookie = function(name, value) {
  var Days, exp;

  Days = 1;
  exp = new Date();
  exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
  return document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
};

getCookie = function(name) {
  var arr;

  arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
  if (arr != null) {
    return unescape(arr[2]);
  }
  return null;
};

delCookie = function(name) {
  var cval, exp;

  exp = new Date();
  exp.setTime(exp.getTime() - 1);
  cval = getCookie(name);
  if (cval != null) {
    return document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
  }
};

$(function() {
  $.get("php/email-dialog.php", function(data) {
    $("body").append(data);
  });
  $(".door-logo").on("click", function(event) {
    $.get("account/logout.php", function(responseText) {
      document.location.href = "index.php";
    });
  });
  $(".self-logo").on("click", function(event) {
    document.location.href = "self.php";
  });
  $(".help-logo").on("click", function(event) {
    document.location.href = "help.php";
  });
  $(".travel-logo").on("click", function(event) {
    document.location.href = "travel.php";
  });
  $("#menu1-search li").on("click", function(event) {
    $(".glyphicon-search").on("click", function(event) {
      delCookie("search");
      SetCookie("search", $(".form-control").val());
      document.location.href = "search.php";
    });
    $(".form-control").attr("disabled", false);
    $(".dropdown-icon-display").css("display", "inline-block");
    SetCookie("searchBy", $(this).attr("title"));
    $('.dropdown-li').removeClass("active");
    $(this).addClass("active");
    $('.dropdown-icon-display i').removeClass().addClass($(this).children('i').attr("class"));
  });
  $("#chatting-users").on("click", function(event) {
    if ($(this).attr("name") === "close-chatting") {
      $(".messageCircle-photo-container").animate({
        right: -100
      }, 250);
      $(this).attr("name", "open-chatting");
      $(this).removeClass("fa-users");
      $(this).addClass("fa-chevron-left");
    } else {
      $(".messageCircle-photo-container").animate({
        right: 5
      }, 250);
      $(this).attr("name", "close-chatting");
      $(this).removeClass("fa-chevron-left");
      $(this).addClass("fa-users");
    }
  });
});

