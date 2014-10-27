
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
  $('#myModal-helpadd').on('show.bs.modal', function (e) {
    var index = $(this).attr('article-index');
    $('#article-choice').attr('value',index);
    if(index==0){
      $('.article-title-icon').removeClass('fa fa-heart fa-coffee fa-plane').addClass('fa fa-plane');
      $('.article-title-icon h1').text('旅遊記事');
      $('#article-bookmark').html('<div class="bookmark plus-mark" id="plus-mark"><i class="fa fa-plus"></i><select class="form-control"><option value="taiwan" selected>台灣</option><option value="japan">日本</option><option value="franch">法國</option><option value="america">美國</option><option value="hawaii">夏威夷</option></select></i></div>');
      $(".bookmark").unbind('click').on("click", function(event) {
        if (!$(this).hasClass('active')){
          $('#bookmark-input').attr('value',$("#plus-mark").children('select').val());
          $(".bookmark").removeClass('active');
          $(this).addClass('active');
          $("#bookmark-input").attr('value',$(this).attr('value'));
          if ($(this).hasClass('plus-mark')){
            $(this).css('width','125px');
            $(this).addClass('active');
            $(this).children('i').hide();
            $(this).children('select').show();
            $(this).children('select').unbind('change').on("change", function(event) {
              $('#bookmark-input').attr('value',$(this).val());
            });
          }
          else{
            $('#plus-mark').removeClass('active');
            $('#plus-mark').css('width','70px');
            $('#plus-mark').children('i').show();
            $('#plus-mark').children('select').hide();
          }
        }
      });
    }
    if(index==1){
      $('.article-title-icon').removeClass('fa fa-heart fa-coffee fa-plane').addClass('fa fa-heart');
      $('.article-title-icon h1').text('慈善心得');

    }
    if(index==2){
      $('.article-title-icon').removeClass('fa fa-heart fa-coffee fa-plane').addClass('fa fa-coffee');
      $('.article-title-icon h1').text('心情雜記');
      $('#article-bookmark').html('<div class="bookmark" value="food">美食</div><div class="bookmark" value="music">音樂</div><div class="bookmark" value="photograph">攝影</div><div class="bookmark" value="movie">電影</div><div class="bookmark" value="animal">動物</div><div class="bookmark" value="design">設計</div><div class="bookmark" value="sport">運動</div><div class="bookmark" value="book">書籍</div><div class="bookmark" value="science">科技</div><div class="bookmark" value="activity">活動</div><div class="bookmark" value="architecture">建築</div><div class="bookmark" value="religion">宗教</div><div class="bookmark" value="love">愛情</div><div class="bookmark" value="fashion">時尚</div><div class="bookmark active" value="other">其他</div>');
      $(".bookmark").unbind('click').on("click", function(event) {
        if (!$(this).hasClass('active')){
          $(".bookmark").removeClass('active');
          $(this).addClass('active');
          $("#bookmark-input").attr('value',$(this).attr('value'));
        }
      });
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

