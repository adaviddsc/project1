
var readURL;
readURL = function(input, img) {
  if (input.files && input.files[0]) {
    for (var c=0;c<=99999;c++){
      if (input.files[c]!=undefined){
        var reader;
        reader = new FileReader();
        reader.onload = function(e) {
          var index=0;
          while($(img).eq(index).attr("src")!=''){
            index++;
          }
          $(img).eq(index).attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[c]);
      }
      else{
        break;
      }
    }
  }
};

$(function() {
  $(".bookmark").on("click", function(event) {
    if (!$(this).hasClass('active')){
      $(".bookmark").removeClass('active');
      $(this).addClass('active');
      $("#bookmark-input").attr('value',$(this).attr('value'));
    }
  });
  $(".mood").children('i').on("click", function(event) {
    if (!$(this).hasClass('active')){
      $(".mood").children('i').removeClass('active');
      $(this).addClass('active');
      $("#mood-input").attr('value',$(this).attr('value'));
    }
  });
  $(".self-article-images").children('.article-images-div').on("click", function(event) {
    $("#self-article-images").click();
  });
  $("#self-article-images").on("change", function(event) {
    $('.add-article-div').remove();
    var filecount = this.files.length;
    for (var i=0;i<filecount;i++){
      $(".self-article-images").append('<div class="add-article-div"><i class="fa fa-spinner fa-spin"></i><img src="" class="multi-article-img"></div>');
    }
    readURL(this, ".multi-article-img");
  });
  $(".article-images-div").hover(function() {
      $(".add-img-camera").css('color','#222');
    },function() {
      $(".add-img-camera").css('color','#9e9e9e');
    }
  );
  $("#self-article-clear").on("click", function(event) {
    $('#self-article-edit')[0].reset();
    $('.add-article-div').remove();
    $(".mood").children('i').removeClass('active');
    $(".mood").children('i').eq(0).addClass('active');
  });
  $("#self-article-submit").on("click", function(event) {
    $('#self-article-edit').submit();
  });
  $("#self-article-edit").submit(function() {
    var formData;
    formData = new FormData($(this)[0]);
    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(data) {
        if (data[0].data=="success"){
          $('#self-article-ajaxMessage').text(data[0].message);
          window.location.reload();
        }
        else{
          $('#self-article-ajaxMessage').text(data[0].message);
        }
      },
      /*error: function( req, status, err ) {
        alert('123');
      }*/
    });
    return false;
  });
});

