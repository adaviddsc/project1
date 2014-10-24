
readURL = function(input, img) {
  if (input.files && input.files[0]) {
    for (var c=0;c<=99999;c++){
      if (input.files[c]!=undefined){
        var reader;
        reader = new FileReader();
        reader.onloadstart = function(e) {
          var index=0;
          while( $(img).eq(index).parent('.edit-comments-addimg').children('.progressbar').hasClass('fa fa-spinner fa-spin') ){
            index++;
          }
          $(img).eq(index).parent('.edit-comments-addimg').children('.progressbar').addClass('fa fa-spinner fa-spin');
        };
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
clearForm = function() {
  $(".over-div").remove();
  $(".comments-addimg").attr('src','');
  $(".progressbar").removeClass('fa fa-spinner fa-spin');
  $('#edit-comments-form')[0].reset();
}
new_comments = function(user,c,imgStr) {
  $('.comments-allImg').remove();
  for (var d=0;d<=999999;d++){
    if(comments_commentsImg[imgStr][d]!=undefined){
      if (d==0){
        $('.img-outline').append('<img class="comments-allImg active" src='+comments_commentsImg[imgStr][d]+' alt="">');
      }
      else{
        $('.img-outline').append('<img class="comments-allImg" src='+comments_commentsImg[imgStr][d]+' alt="">');
      }
    }
    else{
      break;
    }
  }
  $('.comments-info').children('.comments-title').text(comments_commentsTitle[user][c]);
  $('.comments-info').children('.comments-contents').html('<h1>'+comments_commentsContent[user][c]+'</h1>');
  $(".comments-contents").children('h1').mCustomScrollbar({
    theme:"rounded-dark",
    scrollButtons:{
      enable:true
    }
  });
  $('.comments-info').children('.comments-date').children('div').text(comments_commentsDate[user][c]);
  $('.show-comments-heart').hide();
  for (var d=0;d<comments_commentsStarts[user][c];d++){
    $('.show-comments-heart').eq(d).fadeIn();
  }
}
$(function() {
 
  $('#myModal-comments').on('show.bs.modal', function (e) {
    var oldIndex,newLeft;
    var user = $(this).attr('user');
    $('.block-comments').eq(0).click();
    $('.comments-userimg').children('img').attr('src',username_photo[user]);
    $('#comments-userID').attr('value',user);
    $('.comments-user').remove();
    $('.comments-allImg').remove();
    $('.comments-contents').children('h1').remove();
    $('.show-comments-heart').hide();
    $('.comments-title').text('');
    $('.comments-date').children('div').text('');

    if (comments_commentsTitle[user]!=undefined){
      for (var c=0;c<=999999;c++){
        if (comments_commentsTitle[user][c]!=undefined){
          if(c==0){
            var imgStr = comments_username[user][0]+user+comments_commentsTitle[user][0]+comments_commentsDate[user][0]+comments_commentsContent[user][0]+comments_commentsStarts[user][0];
            new_comments(user,0,imgStr);
            $('.comments-footer').append('<div class="comments-user active" arrayC='+c+'><img src='+username_photo[comments_username[user][c]]+' alt=""></div>');
          }
          else{
            $('.comments-footer').append('<div class="comments-user" arrayC='+c+'><img src='+username_photo[comments_username[user][c]]+' alt=""></div>');
          }
        }
        else{
          break;
        }
      }
      
      $('.comments-user').unbind('click').on("click", function() {
        if ( !$(this).hasClass('active') ){
          var getC = $(this).attr('arrayC');
          var userImgStr = comments_username[user][getC]+user+comments_commentsTitle[user][getC]+comments_commentsDate[user][getC]+comments_commentsContent[user][getC]+comments_commentsStarts[user][getC];
          new_comments(user,getC,userImgStr);
          $('.comments-user').removeClass('active');
          $(this).addClass('active');

          if (oldIndex==undefined){
            oldIndex = $(this).index();
            newIndex = $(this).index();
          }
          else{
            newIndex = $(this).index() - oldIndex;
            oldIndex = $(this).index();
          }
          newLeft = parseInt($('.comments-user').css('left'));
          var newPos = newLeft - newIndex*76;
          newPos = newPos+'px';
          $('.comments-user').animate({'left': newPos}, 500, function() {});

        }
      })
    }
    
  })
  $('.block-comments').on('click', function (e) {
    if ( !$(this).hasClass('active') ){
      $('.block-container').removeClass('active');
      $('.block-footer').removeClass('active');
      $('.block-comments').removeClass('active');
      $(this).addClass('active');
      if( $(this).hasClass('readonly-comments') ){
        $('.comments-footer').addClass('active');
        $('.comments-container').addClass('active');
      }
      else{
        $('.edit-comments-header').children('.fa').removeClass('active');
        $('.edit-comments-header').children('.fa').eq(0).addClass('active');
        $('.edit-footer').addClass('active');
        $('.edit-container').addClass('active');
      }
    }

  })
  $('.edit-comments-header').children('i').hover(
    function() {
      long_animate($(this),'tada animated',1000);
    }, function() {
      clearTimeout(stop_animate_1);
      clearTimeout(stop_animate_2);
      $(this).removeClass('tada animated');
    }
  );
  $('#edit-comments-addimg').on('click', function (e) {
    $('#edit-comments-input').click();
  })
  $('#edit-comments-input').change(function() {
    $(".over-div").remove();
    var filecount = this.files.length;
    if (filecount>6){
      $(".comments-outerline").eq(3).css('border-bottom','1px solid #E7E7E7');
      $(".comments-outerline").eq(4).css('border-bottom','1px solid #E7E7E7');
      $(".comments-outerline").eq(5).css('border-bottom','1px solid #E7E7E7');
      for (var i=0;i<filecount-6;i++){
        $(".comments-img").append('<div class="comments-outerline over-div"><div class="edit-comments-addimg"><img class="comments-addimg"><div class="progressbar"></div></div></div>');
        if ((i+1)%3==1 && i>0){
          $(".over-div").eq(i-3).css('border-bottom','1px solid #E7E7E7');
          $(".over-div").eq(i-2).css('border-bottom','1px solid #E7E7E7');
          $(".over-div").eq(i-1).css('border-bottom','1px solid #E7E7E7');
        }
        if ((i+1)%3!=0){
          $(".over-div").eq(i).css('border-right','1px solid #E7E7E7');
        }
      }
    }
    $(".comments-addimg").attr('src','');
    $(".progressbar").removeClass('fa fa-spinner fa-spin');
    readURL(this, ".comments-addimg");
  });
  
  $('#comments-submit').on('click', function () {
    $("#edit-comments-form").submit();
  });
  $('#comments-clear').on('click', function () {
    clearForm();
  });
  $('.edit-comments-header').children('i').on('click', function () {
    if ( !$(this).hasClass('active') ){
      $('.edit-comments-header').children('i').removeClass('active');
      $(this).addClass('active');

      if ( $(this).hasClass('fa-camera') ){
        $(this).parents('.modal-body').animate({'height': '35px'}, 400, function() {
          $('.comments-text').hide();
          $('.comments-img').show();
          $(this).animate({'height': '436px'}, 400, function() {
            $(this).css('height','auto');
          });
        });
      }
      if ( $(this).hasClass('fa-file-text-o') ){
        $(this).parents('.modal-body').animate({'height': '35px'}, 400, function() {
          $('.comments-img').hide();
          $('.comments-text').show();
          $(this).animate({'height': '395px'}, 400, function() {
            $(this).css('height','auto');
          });
        });
      }
    }
  });
  $('.comments-heart').on('click', function () {
    $('.comments-heart').removeClass('fa-heart').addClass('fa-heart-o');
    var index = $(this).index()
    $('#comments-heart').attr('value',index);
    $('.comments-heart').each(function(){
      if( $(this).index()<=index ){
        $(this).removeClass('fa-heart-o').addClass('fa-heart');
      }
    });
  });
  $('.comments-changeImg').on('click', function () {
    var c;
    var images = $('.comments-allImg').length;
    for(c=0;c<images;c++){
      if ($('.comments-allImg').eq(c).hasClass('active')){
        $('.comments-allImg').eq(c).hasClass('active');
        break;
      }
    }
    $('.comments-allImg').removeClass('active').removeClass('zoomIn animated');
    if ( $(this).hasClass('fa-angle-left') ){
      if(c==0){
        $('.comments-allImg').eq(images-1).addClass('active zoomIn animated');
      }
      else{
        $('.comments-allImg').eq(c-1).addClass('active zoomIn animated');
      }
    }
    else{
      if(c==images-1){
        $('.comments-allImg').eq(0).addClass('active zoomIn animated');
      }
      else{
        $('.comments-allImg').eq(c+1).addClass('active zoomIn animated');
      }
    }
  });


  $("#edit-comments-form").submit(function() {
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
        if(data[0].data=='error'){
          $("#ajax-message").text(data[0].message);
        }
        if(data[0].data=='success'){
          clearForm();
          $("#ajax-message").text(data[0].message);
          var userStr = data[0].username+data[0].commentsUser+data[0].commentsTitle+data[0].commentsDate+data[0].commentsContent+data[0].commentsStarts;
          comments_commentsImg[userStr] = new Array();
          if (comments_commentsTitle[data[0].commentsUser]==undefined){
            comments_username[data[0].commentsUser] = new Array();
            comments_commentsTitle[data[0].commentsUser] = new Array();
            comments_commentsDate[data[0].commentsUser] = new Array();
            comments_commentsContent[data[0].commentsUser] = new Array();
            comments_commentsStarts[data[0].commentsUser] = new Array();
          }
          var find_data_c;
          for (find_data_c=0;find_data_c<=999999;find_data_c++){
            if (comments_commentsTitle[data[0].commentsUser][find_data_c]==undefined){
              comments_username[data[0].commentsUser][find_data_c] = data[0].username;
              comments_commentsTitle[data[0].commentsUser][find_data_c] = data[0].commentsTitle;
              comments_commentsDate[data[0].commentsUser][find_data_c] = data[0].commentsDate;
              comments_commentsContent[data[0].commentsUser][find_data_c] = data[0].commentsContent;
              comments_commentsStarts[data[0].commentsUser][find_data_c] = data[0].commentsStarts;
              for (var img=0;img<=10;img++){
                if (data[img].commentsPhoto!='undefined'){
                  comments_commentsImg[userStr][img] = data[img].commentsPhoto;
                }
                else{
                  break;
                }
              }
              break;
            }
          }
          $('#myModal-comments').modal('hide');
        }
      },
      error: function( req, status, err ) {
        console.log( 'something went wrong:', status, err );
        alert('something went wrong:'+ status + err);
      }
    });
    return false;
  });
});
