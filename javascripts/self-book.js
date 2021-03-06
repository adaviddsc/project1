var readURL = function(input, img) {
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

  $(".change-photo").on("click", function(event) {
    $("#self-photo-input").click();
  });
  $(".self-top img").on("click", function(event) {
    $("#back-photo-input").click();
  });
  $("#self-photo-input").change(function() {
    readURL(this, "#self-photo");
    $("#self-photo-edit input[type=submit]").click();
  });
  $("#back-photo-input").change(function() {
    readURL(this, ".self-top img");
    $("#back-photo-edit input[type=submit]").click();
  });
  $(".commentsUser-click").on("click", function(event) {
    $("#myModal-comments").attr('user',session);
  });
  $('.article-content').hover(
    function() {
      $(this).children('i').addClass('shake animated');
      $(this).children('h1').addClass('shake animated');
    }, function() {
      $(this).children('i').removeClass('shake animated');
      $(this).children('h1').removeClass('shake animated');
    }
  );
  $('.quater-circle').on("click", function(event) {
    $("#myModal-helpadd").attr('article-index',$(this).index());
  });
  $('.quater-circle').hover(
    function() {
      var index = $(this).index();
      if (index==0){
        $(this).animate({
          'top': '-5px',
          'left': '-5px',
        }, 100, function() {});
      }
      if (index==1){
        $(this).animate({
          'top': '-5px',
          'right': '-5px',
        }, 100, function() {});
      }
      if (index==2){
        $(this).animate({
          'bottom': '-5px',
          'left': '-5px',
        }, 100, function() {});
      }
      if (index==3){
        $(this).animate({
          'bottom': '-5px',
          'right': '-5px',
        }, 100, function() {});
      }
    }, function() {
      var index = $(this).index();
      if (index==0){
        $(this).animate({
          'top': '0px',
          'left': '0px',
        }, 100, function() {});
      }
      if (index==1){
        $(this).animate({
          'top': '0px',
          'right': '0px',
        }, 100, function() {});
      }
      if (index==2){
        $(this).animate({
          'bottom': '0px',
          'left': '0px',
        }, 100, function() {});
      }
      if (index==3){
        $(this).animate({
          'bottom': '0px',
          'right': '0px',
        }, 100, function() {});
      }
    }
  );

  
  $(".new-article").on("click", function(event) {
    if( !$(this).hasClass('active') ){
      $(".add-article").stop();
      $(this).removeClass('fa-pencil').addClass('fa-bars active');
      $(".add-article").show();
      $(".add-article").animate({'height': '370px',}, 500, function() {});
      $(".add-article").css('border','1px dashed #CCC');

    }
    else{
      $(".add-article").stop();
      $(this).addClass('fa-pencil').removeClass('fa-bars active');
      $(".add-article").animate({'height': '0px',}, 500, function() {$(".add-article").hide();});
      $(".add-article").css('border','none');
    }
  });



  $(".ajax-fileupload").submit(function() {
    var formData;

    formData = new FormData($(this)[0]);
    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: formData,
      async: false,
      success: function(data) {},
      cache: false,
      contentType: false,
      processData: false
    });
    return false;
  });
  $("#addfriend-info").click(function() {
    if ($(this).attr("name") === "not-friend") {
      $.get("account/send.php?receiveUser=" + cookie + "&signal=not-friend", function(responseText) {});
      $(this).attr("name", "send-friend");
      $(this).removeClass("fa-plus-circle").addClass("fa-times-circle");
      return $(this).children('h1').text("取消申請");
    } else {
      $.get("account/send.php?receiveUser=" + cookie + "&signal=send-friend", function(responseText) {});
      $(this).attr("name", "not-friend");
      $(this).removeClass("fa-times-circle").addClass("fa-plus-circle");
      return $(this).children('h1').text("好友申請");
    }
  });

  $(".article-content").click(function() {
    if (travelTitle[0]!=undefined && $(this).index()==0){
      $(".self-article-div").remove();
      var count_i = 0;
      $("#append_mark").html('<div class="left-bookmark active" value="all">全部</div>');
      while (dis_Bookmark[count_i]!=undefined){
        $("#append_mark").append('<div class="left-bookmark" value='+dis_Bookmark[count_i]+'>'+dis_Bookmark_lan[count_i]+'</div>');
        count_i++;
      }
      var bookmark = "all";
      $(".left-bookmark").unbind('click').on("click", function(event) {
        $(".left-bookmark").removeClass('active');
        $(this).addClass('active');
        bookmark = $(this).attr('value');
        con_z_index = 0;
        for (var i=0; i<$(".self-article-div").length; i++){
          $(".self-article-div").eq(i).css('z-index','5');
          if ($(".self-article-div").eq(i).hasClass(bookmark)){
            if (con_z_index==0){
              con_z_index++;
              $(".self-article-div").eq(i).css('z-index','6');
            }
            $(".self-article-div").eq(i).css('visibility','visible');
          }
          else{
            $(".self-article-div").eq(i).css('visibility','hidden');
          }
        }
      });
      $(".change-page").unbind('click').on("click", function(event) {
        for (var i=0; i<$(".self-article-div").length; i++){
          $(".self-article-div").eq(i).css('z-index','5');
        }
        var get_active = 0;
        for (var i=0; i<$("."+bookmark).length; i++){
          if ($("."+bookmark).eq(i).hasClass('active')){
            get_active = i;
          }
        }
        if ($(this).index() == 0 && get_active!=0) {
          $("."+bookmark).eq(get_active).hide();
          $("."+bookmark).eq(get_active-1).addClass('active');
          $("."+bookmark).eq(get_active-1).css('z-index','6');
          setTimeout(function () {
            $("."+bookmark).eq(get_active).removeClass('active').show();
          }, 600);
        }
        if ($(this).index() == 1 && (get_active+1)!=$("."+bookmark).length) {
          $("."+bookmark).eq(get_active).hide();
          $("."+bookmark).eq(get_active+1).addClass('active');
          $("."+bookmark).eq(get_active+1).css('z-index','6');
          setTimeout(function () {
            $("."+bookmark).eq(get_active).removeClass('active').show();
          }, 600);
        }
        
      });

      var title = 0;
      while (travelTitle[title]!=undefined){
        $(".book-right").append('<div class="all self-article-div '+travelBookmark[title]+'"><div class="article-img-container"><div class="img-hidden"></div><div class="filp-img"><i class="fa fa-arrows-h open-flip"><div></div></i><i class="fa fa-long-arrow-left flip-arrow"></i><i class="fa fa-long-arrow-right flip-arrow"></i></div></div><div class="article-content-container"><div class="left-container"><div class="fa fa-tag"><h1>'+travelTitle[title]+'</h1></div><div class="fa fa-clock-o"><h1>'+travelTime[title]+'</h1></div><div class="fa fa-umbrella"><h1><i class="fa fa-smile-o article-mood" value="smile"></i><i class="fa fa-meh-o article-mood" value="soso"></i><i class="fa fa-frown-o article-mood" value="down"></i></h1></div><div class="fa fa-location-arrow"><h2>'+travelPosition[title]+'</h2></div><div class="article-date">'+travelDate[title]+'</div></div><div class="right-container"><span class="fa fa-pencil">記事</span><div class="article-text">'+travelText[title]+'</div></div></div></div>');
        $(".self-article-div").eq(title).find('.article-mood[value='+travelMood[title]+']').css('display','block');
        for (var i=0; i<=99999999; i++){
          if ( travelImg[travelTitle[title]][i]!=undefined ){
            $(".img-hidden").eq(title).append('<div class="article-img"><img src='+travelImg[travelTitle[title]][i]+' style="height:315px;"></div>');
          }
          else{
            break;
          }
        }
        title++;
      }
      $(".self-article-div").eq(0).addClass('active');
      for (var j=0; j<$(".self-article-div").length; j++){
        for (var i=0; i<$(".self-article-div").eq(j).find(".article-img").length; i++){
          (function(index,article,length) {
            $(".self-article-div").eq(article).find(".article-img").eq(index).children('img').load(function(){
              var cache = 0;
              if ($(this).width()==0){var cache = 1}
              $(this).attr('realWidth',$(this).width());
              $(this).addClass('loadOver');
              var test = 0;
              for (var x=0; x<length; x++){
                if( $(".self-article-div").eq(article).find(".article-img").eq(x).children('img').hasClass('loadOver') ){
                  test++;
                }
                else{break;}
              }
              if (test==length){
                if(cache==0){
                  var div_all_width = 0;
                  for (var x=0; x<length; x++){
                    div_all_width = parseInt($(".self-article-div").eq(article).find(".article-img").eq(x).children('img').attr('realWidth')) + div_all_width + 17;
                  }
                  $(".self-article-div").eq(article).find(".img-hidden").css('width',div_all_width+'px');
                }
              }
            });
          })(i,j,$(".self-article-div").eq(j).find(".article-img").length);
        }
      }


      $(".open-flip").unbind('click').on("click", function(event) {
        if (!$(this).hasClass('active')){
          $(this).addClass('active');
          $(this).parent('.filp-img').animate({'left': '0px'}, 250, function() {});
        }
        else{
          $(this).removeClass('active');
          $(this).parent('.filp-img').animate({'left': '91px'}, 250, function() {});
        }
      });

      var img_hidden_left;
      $(".flip-arrow").unbind('click').on("click", function(event) {
        var this_select = $(this).parents('.article-img-container');
        var flip_width = this_select.width();
        var max_width = -(this_select.children('.img-hidden').width() - flip_width);
        img_hidden_left = parseInt(this_select.children('.img-hidden').css('left'));
        if ($(this).index() == 1) {
          img_hidden_left = img_hidden_left + flip_width/2;
          if(img_hidden_left>0){
            this_select.children('.img-hidden').animate({'left': '0px'}, 250, function() {});
          }
          else{
            this_select.children('.img-hidden').animate({'left': img_hidden_left+'px'}, 250, function() {});
          }
        }
        if ($(this).index() == 2) {
          img_hidden_left = img_hidden_left - flip_width/2;
          if(img_hidden_left<max_width){
            this_select.children('.img-hidden').animate({'left': max_width+'px'}, 250, function() {});
          }
          else{
            this_select.children('.img-hidden').animate({'left': img_hidden_left+'px'}, 250, function() {});
          }
        }
      });

      $(".article-text").mCustomScrollbar({
        theme:"rounded-dark",
        scrollButtons:{
          enable:true
        }
      });
    }
    if (helpTitle[0]!=undefined && $(this).index()==1){
      $(".self-article-div").remove();
      var count_i = 0;
      $("#append_mark").html('<div class="left-bookmark active" value="all">全部</div><div class="left-bookmark" value="resource">物資</div><div class="left-bookmark" value="labor">勞力</div><div class="left-bookmark" value="other">其他</div>');
      /*while (dis_Bookmark[count_i]!=undefined){
        $("#append_mark").append('<div class="left-bookmark" value='+dis_Bookmark[count_i]+'>'+dis_Bookmark_lan[count_i]+'</div>');
        count_i++;
      }*/
      var bookmark = "all";
      $(".left-bookmark").unbind('click').on("click", function(event) {
        $(".left-bookmark").removeClass('active');
        $(this).addClass('active');
        bookmark = $(this).attr('value');
        con_z_index = 0;
        for (var i=0; i<$(".self-article-div").length; i++){
          $(".self-article-div").eq(i).css('z-index','5');
          if ($(".self-article-div").eq(i).hasClass(bookmark)){
            if (con_z_index==0){
              con_z_index++;
              $(".self-article-div").eq(i).css('z-index','6');
            }
            $(".self-article-div").eq(i).css('visibility','visible');
          }
          else{
            $(".self-article-div").eq(i).css('visibility','hidden');
          }
        }
      });
      $(".change-page").unbind('click').on("click", function(event) {
        for (var i=0; i<$(".self-article-div").length; i++){
          $(".self-article-div").eq(i).css('z-index','5');
        }
        var get_active = 0;
        for (var i=0; i<$("."+bookmark).length; i++){
          if ($("."+bookmark).eq(i).hasClass('active')){
            get_active = i;
          }
        }
        if ($(this).index() == 0 && get_active!=0) {
          $("."+bookmark).eq(get_active).hide();
          $("."+bookmark).eq(get_active-1).addClass('active');
          $("."+bookmark).eq(get_active-1).css('z-index','6');
          setTimeout(function () {
            $("."+bookmark).eq(get_active).removeClass('active').show();
          }, 600);
        }
        if ($(this).index() == 1 && (get_active+1)!=$("."+bookmark).length) {
          $("."+bookmark).eq(get_active).hide();
          $("."+bookmark).eq(get_active+1).addClass('active');
          $("."+bookmark).eq(get_active+1).css('z-index','6');
          setTimeout(function () {
            $("."+bookmark).eq(get_active).removeClass('active').show();
          }, 600);
        }
        
      });

      var title = 0;
      while (helpTitle[title]!=undefined){
        $(".book-right").append('<div class="all self-article-div '+helpBookmark[title]+'"><div class="article-img-container"><div class="img-hidden"></div><div class="filp-img"><i class="fa fa-arrows-h open-flip"><div></div></i><i class="fa fa-long-arrow-left flip-arrow"></i><i class="fa fa-long-arrow-right flip-arrow"></i></div></div><div class="article-content-container"><div class="left-container"><div class="fa fa-tag"><h1>'+helpTitle[title]+'</h1></div><div class="fa fa-clock-o"><h1>'+helpTime[title]+'</h1></div><div class="fa fa-umbrella"><h1><i class="fa fa-smile-o article-mood" value="smile"></i><i class="fa fa-meh-o article-mood" value="soso"></i><i class="fa fa-frown-o article-mood" value="down"></i></h1></div><div class="fa fa-location-arrow"><h2>'+helpPosition[title]+'</h2></div><div class="article-date">'+helpDate[title]+'</div></div><div class="right-container"><span class="fa fa-pencil">記事</span><div class="article-text">'+helpText[title]+'</div></div></div></div>');
        $(".self-article-div").eq(title).find('.article-mood[value='+helpMood[title]+']').css('display','block');
        for (var i=0; i<=99999999; i++){
          if ( helpImg[helpTitle[title]][i]!=undefined ){
            $(".img-hidden").eq(title).append('<div class="article-img"><img src='+helpImg[helpTitle[title]][i]+' style="height:315px;"></div>');
          }
          else{
            break;
          }
        }
        title++;
      }
      $(".self-article-div").eq(0).addClass('active');
      for (var j=0; j<$(".self-article-div").length; j++){
        for (var i=0; i<$(".self-article-div").eq(j).find(".article-img").length; i++){
          (function(index,article,length) {
            $(".self-article-div").eq(article).find(".article-img").eq(index).children('img').load(function(){
              var cache = 0;
              if ($(this).width()==0){var cache = 1}
              $(this).attr('realWidth',$(this).width());
              $(this).addClass('loadOver');
              var test = 0;
              for (var x=0; x<length; x++){
                if( $(".self-article-div").eq(article).find(".article-img").eq(x).children('img').hasClass('loadOver') ){
                  test++;
                }
                else{break;}
              }
              if (test==length){
                if(cache==0){
                  var div_all_width = 0;
                  for (var x=0; x<length; x++){
                    div_all_width = parseInt($(".self-article-div").eq(article).find(".article-img").eq(x).children('img').attr('realWidth')) + div_all_width + 17;
                  }
                  $(".self-article-div").eq(article).find(".img-hidden").css('width',div_all_width+'px');
                }
              }
            });
          })(i,j,$(".self-article-div").eq(j).find(".article-img").length);
        }
      }


      $(".open-flip").unbind('click').on("click", function(event) {
        if (!$(this).hasClass('active')){
          $(this).addClass('active');
          $(this).parent('.filp-img').animate({'left': '0px'}, 250, function() {});
        }
        else{
          $(this).removeClass('active');
          $(this).parent('.filp-img').animate({'left': '91px'}, 250, function() {});
        }
      });

      var img_hidden_left;
      $(".flip-arrow").unbind('click').on("click", function(event) {
        var this_select = $(this).parents('.article-img-container');
        var flip_width = this_select.width();
        var max_width = -(this_select.children('.img-hidden').width() - flip_width);
        img_hidden_left = parseInt(this_select.children('.img-hidden').css('left'));
        if ($(this).index() == 1) {
          img_hidden_left = img_hidden_left + flip_width/2;
          if(img_hidden_left>0){
            this_select.children('.img-hidden').animate({'left': '0px'}, 250, function() {});
          }
          else{
            this_select.children('.img-hidden').animate({'left': img_hidden_left+'px'}, 250, function() {});
          }
        }
        if ($(this).index() == 2) {
          img_hidden_left = img_hidden_left - flip_width/2;
          if(img_hidden_left<max_width){
            this_select.children('.img-hidden').animate({'left': max_width+'px'}, 250, function() {});
          }
          else{
            this_select.children('.img-hidden').animate({'left': img_hidden_left+'px'}, 250, function() {});
          }
        }
      });

      $(".article-text").mCustomScrollbar({
        theme:"rounded-dark",
        scrollButtons:{
          enable:true
        }
      });
    }
    if (selfTitle[0]!=undefined && $(this).index()==2){
      $(".self-article-div").remove();
      var selfMark = 0;
      $("#append_mark").html('<div class="left-bookmark active" value="all">全部</div>');
      while (dis_selfBookmark[selfMark]!=undefined){
        $("#append_mark").append('<div class="left-bookmark" value='+dis_selfBookmark[selfMark]+'>'+dis_selfBookmark_lan[selfMark]+'</div>');
        selfMark++;
      }
      var bookmark = "all";
      $(".left-bookmark").unbind('click').on("click", function(event) {
        $(".left-bookmark").removeClass('active');
        $(this).addClass('active');
        bookmark = $(this).attr('value');
        con_z_index = 0;
        for (var i=0; i<$(".self-article-div").length; i++){
          $(".self-article-div").eq(i).css('z-index','5');
          if ($(".self-article-div").eq(i).hasClass(bookmark)){
            if (con_z_index==0){
              con_z_index++;
              $(".self-article-div").eq(i).css('z-index','6');
            }
            $(".self-article-div").eq(i).css('visibility','visible');
          }
          else{
            $(".self-article-div").eq(i).css('visibility','hidden');
          }
        }
      });
      $(".change-page").unbind('click').on("click", function(event) {
        for (var i=0; i<$(".self-article-div").length; i++){
          $(".self-article-div").eq(i).css('z-index','5');
        }
        var get_active = 0;
        for (var i=0; i<$("."+bookmark).length; i++){
          if ($("."+bookmark).eq(i).hasClass('active')){
            get_active = i;
          }
        }
        if ($(this).index() == 0 && get_active!=0) {
          $("."+bookmark).eq(get_active).hide();
          $("."+bookmark).eq(get_active-1).addClass('active');
          $("."+bookmark).eq(get_active-1).css('z-index','6');
          setTimeout(function () {
            $("."+bookmark).eq(get_active).removeClass('active').show();
          }, 600);
        }
        if ($(this).index() == 1 && (get_active+1)!=$("."+bookmark).length) {
          $("."+bookmark).eq(get_active).hide();
          $("."+bookmark).eq(get_active+1).addClass('active');
          $("."+bookmark).eq(get_active+1).css('z-index','6');
          setTimeout(function () {
            $("."+bookmark).eq(get_active).removeClass('active').show();
          }, 600);
        }
        
      });

      var title = 0;
      while (selfTitle[title]!=undefined){
        $(".book-right").append('<div class="all self-article-div '+selfBookmark[title]+'"><div class="article-img-container"><div class="img-hidden"></div><div class="filp-img"><i class="fa fa-arrows-h open-flip"><div></div></i><i class="fa fa-long-arrow-left flip-arrow"></i><i class="fa fa-long-arrow-right flip-arrow"></i></div></div><div class="article-content-container"><div class="left-container"><div class="fa fa-tag"><h1>'+selfTitle[title]+'</h1></div><div class="fa fa-clock-o"><h1>'+selfTime[title]+'</h1></div><div class="fa fa-umbrella"><h1><i class="fa fa-smile-o article-mood" value="smile"></i><i class="fa fa-meh-o article-mood" value="soso"></i><i class="fa fa-frown-o article-mood" value="down"></i></h1></div><div class="fa fa-location-arrow"><h2>'+selfPosition[title]+'</h2></div><div class="article-date">'+selfDate[title]+'</div></div><div class="right-container"><span class="fa fa-pencil">記事</span><div class="article-text">'+selfText[title]+'</div></div></div></div>');
        $(".self-article-div").eq(title).find('.article-mood[value='+selfMood[title]+']').css('display','block');
        for (var i=0; i<=99999999; i++){
          if ( selfImg[selfTitle[title]][i]!=undefined ){
            $(".img-hidden").eq(title).append('<div class="article-img"><img src='+selfImg[selfTitle[title]][i]+' style="height:315px;"></div>');
          }
          else{
            break;
          }
        }
        title++;
      }
      $(".self-article-div").eq(0).addClass('active');



      for (var j=0; j<$(".self-article-div").length; j++){
        for (var i=0; i<$(".self-article-div").eq(j).find(".article-img").length; i++){
          (function(index,article,length) {
            $(".self-article-div").eq(article).find(".article-img").eq(index).children('img').load(function(){
              var cache = 0;
              if ($(this).width()==0){var cache = 1}
              $(this).attr('realWidth',$(this).width());
              $(this).addClass('loadOver');
              var test = 0;
              for (var x=0; x<length; x++){
                if( $(".self-article-div").eq(article).find(".article-img").eq(x).children('img').hasClass('loadOver') ){
                  test++;
                }
                else{break;}
              }
              if (test==length){
                if(cache==0){
                  var div_all_width = 0;
                  for (var x=0; x<length; x++){
                    div_all_width = parseInt($(".self-article-div").eq(article).find(".article-img").eq(x).children('img').attr('realWidth')) + div_all_width + 17;
                  }
                  $(".self-article-div").eq(article).find(".img-hidden").css('width',div_all_width+'px');
                }
              }
            });
          })(i,j,$(".self-article-div").eq(j).find(".article-img").length);
        }
      }


      $(".open-flip").unbind('click').on("click", function(event) {
        if (!$(this).hasClass('active')){
          $(this).addClass('active');
          $(this).parent('.filp-img').animate({'left': '0px'}, 250, function() {});
        }
        else{
          $(this).removeClass('active');
          $(this).parent('.filp-img').animate({'left': '91px'}, 250, function() {});
        }
      });

      var img_hidden_left;
      $(".flip-arrow").unbind('click').on("click", function(event) {
        var this_select = $(this).parents('.article-img-container');
        var flip_width = this_select.width();
        var max_width = -(this_select.children('.img-hidden').width() - flip_width);
        img_hidden_left = parseInt(this_select.children('.img-hidden').css('left'));
        if ($(this).index() == 1) {
          img_hidden_left = img_hidden_left + flip_width/2;
          if(img_hidden_left>0){
            this_select.children('.img-hidden').animate({'left': '0px'}, 250, function() {});
          }
          else{
            this_select.children('.img-hidden').animate({'left': img_hidden_left+'px'}, 250, function() {});
          }
        }
        if ($(this).index() == 2) {
          img_hidden_left = img_hidden_left - flip_width/2;
          if(img_hidden_left<max_width){
            this_select.children('.img-hidden').animate({'left': max_width+'px'}, 250, function() {});
          }
          else{
            this_select.children('.img-hidden').animate({'left': img_hidden_left+'px'}, 250, function() {});
          }
        }
      });

      $(".article-text").mCustomScrollbar({
        theme:"rounded-dark",
        scrollButtons:{
          enable:true
        }
      });
    }
  });
  $(".article-content").eq(2).click();

});
