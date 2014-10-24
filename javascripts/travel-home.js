Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

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
  $("#select-continent").change(function() {
    var selected = document.getElementById('select-continent').value;
    $(".country-index").children('.country-img').hide();
    if ( selected!="global"){
      $(".country-index").children('.'+selected).fadeIn();
    }
    else{
      $(".country-index").children('.country-img').fadeIn();
    }
  });
  $( ".country-img" ).hover(
    function() {
      $(this).children('.country-name').animate({left: "0px"}, 200);
    }, function() {
      $(this).children('.country-name').animate({left: "-290px"}, 200);
    }
  );
  $(".country-name").children('h1').on("click", function(event) {
    var country = $(this).text();
    $('#travelHome-info-date').val(new Date().toDateInputValue());
    $('#travelHome-info-country').val(country);

  });
  $(".travelHome-info-radio h1").on("click", function(event) {
    if ( $(this).children('input').is(":checked") ){
      $(this).children('input').prop("checked", false);
      $(this).removeClass('active');

    }else{
      if ( $(this).children('input').hasClass('nothing') ){
        $(".travelHome-info-radio h1").children('input').prop("checked", false);
        $(".travelHome-info-radio h1").removeClass('active');
      }
      else{
        $(".travelHome-info-radio h1").children('.nothing').prop("checked", false).removeClass('active');
        $(".travelHome-info-radio h1").children('.nothing').parent().removeClass('active');
      }
      $(this).children('input').prop("checked", true);
      $(this).addClass('active');
      
    }
  });
  $(".travelHome-info-radio h1 input").on("click", function(event) {
    if ($(this).is(":checked")){
      $(this).prop("checked", false);
      $(this).parent().removeClass('active');
    }else{
      $(this).prop("checked", true);
      $(this).parent().addClass('active');
    }
  });
  
  $(".travelHome-info-images-input").change(function() {
    readURL(this, ".travelHome-info-images img");
    $(".fa-camera-retro").remove();
    $(".travelHome-info-images img").css("width", "350px");
  });
  $(".fa-camera-retro").on("click", function(event) {
    $(".travelHome-info-images-input").click();
  });
  $(".travelHome-info-images img").on("click", function(event) {
    $(".travelHome-info-images-input").click();
  });
});


