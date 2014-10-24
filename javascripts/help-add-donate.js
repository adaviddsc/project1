
var readURL;
readURL = function(input, img) {
  var reader;

  if (input.files && input.files[0]) {
    reader = new FileReader();
    reader.onload = function(e) {
      $(img).attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
};

$(function() {
  $(".item-info-images-input").change(function() {
    readURL(this, ".item-info-images img");
    $(".fa-camera-retro").remove();
    $(".item-info-images img").css("width", "350px");
  });
  $(".fa-camera-retro").on("click", function(event) {
    $(".item-info-images-input").click();
  });
  $(".item-info-images img").on("click", function(event) {
    $(".item-info-images-input").click();
  });

  $('#item-info-twzipcode').twzipcode({
    countyName: 'addr_county',
    districtName: 'addr_area'
  });
  $('#item-info-twzipcode').children().children('select').addClass("form-control");
});


