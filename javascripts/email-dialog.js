var timeoutID;
function showmessages(){
  $('#refreshMessage').submit();
  timeoutID = setTimeout('showmessages()',1500);
}
function refreshAddFriends(){
  $('#refreshAddFriends').submit();
  setTimeout('refreshAddFriends()',1500);
}
function refreshFriendsCircle(){
  $('#refreshFriendsCircle').submit();
  setTimeout('refreshFriendsCircle()',1500);
}
function showCircle(){
  for (var count=0;count<999999;count++){
    if( usercircle[count]!=undefined ){
      $(".messageCircle-photo-container").children('div[name='+usercircle[count]+']').css("display","block"); 
    }
    else{
      break;
    }
  }
}
function remind_shake(temp){
  $(".messageCircle-photo-container").children('div[name='+temp+']').animate({right:-5},100, function() {
    $(".messageCircle-photo-container").children('div[name='+temp+']').animate({right:5},100,function() {
      $(".messageCircle-photo-container").children('div[name='+temp+']').animate({right:-5},100, function() {
        $(".messageCircle-photo-container").children('div[name='+temp+']').animate({right:5},100,function() {
          $(".messageCircle-photo-container").children('div[name='+temp+']').animate({right:-5},100, function() {
            $(".messageCircle-photo-container").children('div[name='+temp+']').animate({right:5},100,function() {
              $(".messageCircle-photo-container").children('div[name='+temp+']').animate({right:-5},100, function() {
                $(".messageCircle-photo-container").children('div[name='+temp+']').animate({right:0},100,function() {
                
                });
              });
            });
          });
        });
      });
    });
  }); 
}
function EnterSubmit(e){
  e = e || window.event;  
  var keynum = e.keyCode || e.which;
  if(keynum === 13){
    $('#chat-form').submit();
    return false;
  }
}
function remindMessage(){
  $('#remindMessage').submit();
  setTimeout('remindMessage()',1500);
}
$(function() {
  $("#chat-click").on("click", function(event) {
    $(".email-container-user").css("display", "none");
    $(".email-container-other").css("display", "none");
    $("#modal-content-email").css("width", "400px");
    $(".email-container-chat").css("display", "block");
  });
  $("#chat-click").click();
  $("#user-click").on("click", function(event) {
    $(".email-container-chat").css("display", "none");
    $(".email-container-other").css("display", "none");
    $("#modal-content-email").css("width", "350px");
    $(".email-container-user").css("display", "block");
  });
  $("#other-click").on("click", function(event) {
    $(".email-container-chat").css("display", "none");
    $(".email-container-user").css("display", "none");
    $(".email-container-other").css("display", "block");
  });



  $("#refreshAddFriends").submit(function() {  
    $(".email-container-user-container").addClass("removeAddFriends");
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        var response = response.substring(72).replace(/^\s*|\s*$/g,"");
        for (var c=0;c<=999999;c++){
          var temp = response.substring(0+13*c,13+13*c);

          if( temp != "" && !($(".email-container-user").children('div[name='+temp+']').length > 0) ){
            $(".email-container-user").append('<div class="email-container-user-container" name="'+temp+'"><div class="email-container-user-photo"><img src="'+username_photo[temp]+'" name="'+temp+'"></div><div class="email-container-user-info"><h1>'+user_account[temp]+'</h1><div class="user-info-button"><div class="user-info-left" name="'+temp+'"><i class="fa fa-user"></i><i class="fa fa-plus-circle"></i></div><div class="user-info-right" name="'+temp+'"><i class="fa fa-times-circle"></i></div></div></div></div>');          
          
            $(".user-info-button").children('.user-info-left[name='+temp+']').click(function(){ 
              var thisElement = $(this).parents('.email-container-user-container');
              var animateTop = (thisElement.position().top-120)+'px';
              $('.email-container-user-container').animate({top: animateTop}, 500, function() {
                thisElement.css("display","none");
                $('.email-container-user-container').css("top","0px");
              }); 
              var other = $(this).attr("name");
              $.get('account/receive-friend.php?other='+other+'', function(responseText) {});
            });

            $(".user-info-button").children('.user-info-right[name='+temp+']').click(function(){ 
              var thisElement = $(this).parents('.email-container-user-container');
              var animateTop = (thisElement.position().top-120)+'px';
              $('.email-container-user-container').animate({top: animateTop}, 500, function() {
                thisElement.css("display","none");
                $('.email-container-user-container').css("top","0px");
              }); 
              var other = $(this).attr("name");
              $.get('account/receive-friend.php?other='+other+'&delete=1', function(responseText) {});
            });

            $(".email-container-user-photo").children('img[name='+temp+']').on('click',function(event){
                SetCookie("profileID",$(this).attr("name"));  
                document.location.href="profile.php";
            });

          }
          else if( temp != "" && $(".email-container-user").children('div[name='+temp+']').length > 0 ){
            $(".email-container-user").children('div[name='+temp+']').removeClass("removeAddFriends");
          }
          else{
            break;
          }
        }  
        $(".email-container-user").children('.removeAddFriends').remove();     
      }
    });
    return false;
  });  
  refreshAddFriends();

  $("#refreshFriendsCircle").submit(function() {  
    $(".email-container-chat-photo").addClass("removeFriendsCircle");
    $(".messageCircle-photo-people").addClass("removeFriendsCircle");
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        var response = response.substring(72).replace(/^\s*|\s*$/g,"");
        for (var c=0;c<=999999;c++){
          var temp = response.substring(0+13*c,13+13*c);
          if( temp != "" && !($(".messageCircle-photo-container").children('div[name='+temp+']').length > 0) ){
            $(".messageCircle-photo-container").append('<div class="messageCircle-photo-people email-container-chat-photo" name="'+temp+'"><img src="'+username_photo[temp]+'"><div class="fa fa-comment-o chat-photo-fa" data-toggle="modal" data-target="#myModal-email" name="'+temp+'"></div><div class="fa fa-times messageCircle-fa-times" name="'+temp+'"></div></div>');
          
            $(".messageCircle-photo-container").children('div[name='+temp+']').hover((function() {
                $(this).children('div').fadeIn();
            }), function() {
                $(this).children('div').fadeOut();
            });

            $(".messageCircle-photo-people").children('.messageCircle-fa-times[name='+temp+']').on("click", function(event) {
              SetCookie("deleteMessage",$(this).parent('.messageCircle-photo-people').attr("name"));
              $(this).parent('.messageCircle-photo-people').css("display","none"); 
              $('#delete-signalMessage').submit();
            });
          }           
          else if( temp != "" && $(".messageCircle-photo-container").children('div[name='+temp+']').length > 0 ){
            $(".messageCircle-photo-container").children('div[name='+temp+']').removeClass("removeFriendsCircle");
          }
          else{
            break;
          }
        }
        $(".messageCircle-photo-container").children('.removeFriendsCircle').remove();  

        for (var c=0;c<=999999;c++){
          var temp = response.substring(0+13*c,13+13*c);
          if( temp != "" && !($(".email-container-chat-container-people").children('div[name='+temp+']').length > 0) ){
            $(".email-container-chat-container-people").append('<div class="email-container-chat-photo" data-toggle="close" name="'+temp+'"><img src="'+username_photo[temp]+'"><div class="fa fa-users" name="'+temp+'"></div><div name="'+temp+'" class="fa fa-comment-o chat-photo-fa"></div></div>');
            


            $(".email-container-chat-container-people").children('div[name='+temp+']').on("click", function(event) {
              if ($(this).attr("data-toggle") == "close") {
                $(".email-container-chat-photo").css("z-index", "1");
                $(".email-container-chat-photo").css("-webkit-transform", "scale(1,1) rotate(0deg)");
                $(".email-container-chat-photo").children(".fa").fadeOut();
                $(this).css("-webkit-transform", "scale(1.5,1.5) rotate(360deg)");
                $(this).children(".fa").fadeIn();
                $(this).css("z-index", "2");
                $(this).css("opacity", "1");
                $(".email-container-chat-photo").attr("data-toggle", "close");
                $(this).attr("data-toggle", "open");
              } else {
                $(".email-container-chat-photo").css("z-index", "1");
                $(".email-container-chat-photo").css("-webkit-transform", "scale(1,1) rotate(0deg)");
                $(".email-container-chat-photo").children(".fa").fadeOut();
                $(this).attr("data-toggle", "close");
              }
            });
            $(".email-container-chat-container-people").children('div[name='+temp+']').hover((function() {
              return $(this).css("opacity", "1");
            }), function() {
              return $(this).css("opacity", ".7");
            });

            $(".email-container-chat-photo").children('.fa-users[name='+temp+']').on("click", function(event) {});
            $(".email-container-chat-photo").children('.chat-photo-fa[name='+temp+']').click(function(){ 
              var chat, people;   
              clearTimeout(timeoutID);
              SetCookie("chatPeople", $(this).attr("name"));
              SetCookie("selfPeoplePhoto", username_photo[session]);
              SetCookie("anotherPeoplePhoto", username_photo[$(this).attr("name")]);
              $('#chat-form').attr('name',$(this).attr("name"));
              $('.chatting-district-right').remove();
              $('.chatting-district-left').remove();
              $('#receiveMessage').submit();

              $('#chatting-district-back').fadeIn();
              people = $(".email-container-chat-container-people");
              chat = $(".email-container-chat-container-chatting");
              $(".email-container-chat").css("overflow", "hidden");
              people.animate({
                left: "-100%"
              }, 500, function() {
                people.hide();
                chat.show();
                $(".chatting-district-input").show();
                chat.animate({
                  left: "0%"
                }, 500, function() {});
              });
            });

          }
          else if( temp != "" && $(".email-container-chat-container-people").children('div[name='+temp+']').length > 0 ){
            $(".email-container-chat-container-people").children('div[name='+temp+']').removeClass("removeFriendsCircle");
          }
          else{
            break;
          }
        }
        $(".email-container-chat-container-people").children('.removeFriendsCircle').remove();  

      }
    });
    return false;
  });  
  refreshFriendsCircle();  
  setTimeout('showCircle()',500);


  $("#delete-signalMessage").submit(function() {
      $.ajax({
          data: $(this).serialize(),
          type: $(this).attr("method"),
          url: $(this).attr("action"),
          success: function(response) {
          }
      });
      return false;
  });
  
  $(".messageCircle-fa-times").on("click", function(event) {
    $(this).parent('.messageCircle-photo-people').fadeOut();
  });
  
  $("#chatting-district-back").on("click", function(event) {
    var chat, people;
    $('#chatting-district-back').fadeOut();
    people = $(".email-container-chat-container-people");
    chat = $(".email-container-chat-container-chatting");
    chat.animate({
      left: "100%"
    }, 500, function() {
      chat.hide();
      people.show();
      $(".chatting-district-input").hide();
      people.animate({
        left: "0%"
      }, 500, function() {
        return $(".email-container-chat").css("overflow", "visible");
      });
    });
  });

  $("#receiveMessage").submit(function() {
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        $(".email-container-chat-container-chatting").append(response); 
        showmessages();
      }
    });
    return false;
  });


  $("#refreshMessage").submit(function() {  
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        var response = response.substring(72).replace(/^\s*|\s*$/g,"");
        if (response!=""){
          $(".email-container-chat-container-chatting").append(response);
        }      
      }
    });
    return false;
  });


  $("#chat-form").submit(function() {  
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        $(".email-container-chat-container-chatting").append(response);
        $(".messageCircle-photo-container").children('div[name='+$("#chat-form").attr("name")+']').show();
        $(".email-container-chat-container-chatting").scrollTop($(".email-container-chat-container-chatting")[0].scrollHeight);
        document.getElementById("chat-textarea").blur();
        document.getElementById("chat-textarea").value = "";
        document.getElementById("chat-textarea").value.replace(/[\n]/i, '');
        document.getElementById("chat-textarea").focus();     
      }
    });

    return false;
  });


  
  $("#remindMessage").submit(function() {
      $.ajax({
          data: $(this).serialize(),
          type: $(this).attr("method"),
          url: $(this).attr("action"),
          success: function(response) {
            var response = response.substring(72).replace(/^\s*|\s*$/g,"");
            for (var c=0;c<=999999;c++){
              var temp = response.substring(0+13*c,13+13*c);
              if( temp != "" ){
                $(".messageCircle-photo-container").children('div[name='+temp+']').show();
                remind_shake(temp);
                $("#remindSound")[0].play();
              }
              else{
                break;
              }
            }
          }
      });
      return false;
  });
  
  remindMessage();

  
});


