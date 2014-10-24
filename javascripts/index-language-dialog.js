
var SetCookie;

SetCookie = function(name, value) {
  var Days, exp;

  Days = 1;
  exp = new Date();
  exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
  document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
};

$(function() {
  $(".language-choice-body").on("click", function(event) {
    SetCookie("language", $(this).attr("name"));
    document.location.href = "index.php";
  });
});


