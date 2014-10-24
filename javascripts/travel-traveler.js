var countryID = new Array();
countryID['台灣'] = 'taiwan';
countryID['日本'] = 'japan';
countryID['法國'] = 'france';
countryID['美國'] = 'america ';
countryID['夏威夷'] = 'hawaii';
countryID['全球'] = 'global';

var longPollingID = 0;
function isInfoWindowOpen(infoWindow){
    var map = infoWindow.getMap();
    return (map !== null && typeof map !== "undefined");
}
function CommentSubmit(e,selecter){
  e = e || window.event;  
  var keynum = e.keyCode || e.which;
  if(keynum === 13){
    selecter.submit();
    return false;
  }
}
function Edit_housecomment(id,comment,action){
  $.ajax({
    data: "id="+id+"&comment="+comment+"&action="+action+"",
    type: 'post',
    url: 'account/houseEdit.php'
  });
}
function travel_img_updown(selecter1,selecter2,px){
  $(selecter1+',.travel-previousimg,.travel-nextimg,.corner').hover(
    function() {
      getThis = $(this).parents('.map-travel-img');
      getThis.children('.corner').css('z-index','1');
      getThis.children('.corner').animate({
         width: '60px'
      }, { duration: 400, queue: false });
      getThis.children('.corner').animate({
         height: '60px'
      }, { duration: 400, queue: false });
      getThis.children('.fa-angle-up,.fa-angle-down').show();
      getThis.children(selecter2).children('img').css('opacity','.9');
    }, function() {
      getThis = $(this).parents('.map-travel-img');
      getThis.children('.corner').animate({
         width: '0px'
      }, { duration: 400, queue: false });
      getThis.children('.corner').animate({
         height: '0px'
      }, { duration: 400, queue: false });
      getThis.children('.fa-angle-up,.fa-angle-down').hide();
      getThis.children(selecter2).children('img').css('opacity','1');
    }
  );
  $(".travel-previousimg").on("click", function(event) {
    var elementLength = $(this).siblings(selecter2).children('img').length;
    var position = (elementLength-1)*(-px);

    var imgTop = $(this).siblings(selecter2).children('img').position().top;
    var changeTop = imgTop + px;
    if ( changeTop > 0 ){
        $(this).siblings(selecter2).children('img').animate({'top': position+'px'}, 400, function() {});
    }
    else{
        $(this).siblings(selecter2).children('img').animate({'top': changeTop+'px'}, 400, function() {});
    }
  });
  $(".travel-nextimg").on("click", function(event) {
    var elementLength = $(this).siblings(selecter2).children('img').length;
    var position = (elementLength-1)*(-px);

    var imgTop = $(this).siblings(selecter2).children('img').position().top;
    var changeTop = imgTop - px;
    if ( changeTop < position ){
        $(this).siblings(selecter2).children('img').animate({'top': '0px'}, 400, function() {});
    }
    else{
        $(this).siblings(selecter2).children('img').animate({'top': changeTop+'px'}, 400, function() {});
    }

  });
}
function travel_img(selecter){
  $(selecter).unbind('click').on("click", function(event) {
    $('#travelinfo-myModalLabel').text($(this).attr('title'));
    $('#carousel-indicators-travelinfo li').remove();
    $('#carousel-inner-travelinfo div').remove();
    for (var c=1;c<=999999;c++){    
      if (houseprovide_title_photo[$(this).attr("title")][c-1]!=undefined){
          if (c==1){
              $('#carousel-indicators-travelinfo').append('<li data-target="#carousel-example-generic-donate" data-slide-to="0" class="active"></li>');
              $('#carousel-inner-travelinfo').append('<div class="item active"><img src="'+houseprovide_title_photo[$(this).attr("title")][c-1]+'"></div>');
          }
          else{
              var temp = c-1;
              $('#carousel-indicators-travelinfo').append('<li data-target="#carousel-example-generic-donate" data-slide-to="'+temp+'" class=""></li>');
              $('#carousel-inner-travelinfo').append('<div class="item"><img src="'+houseprovide_title_photo[$(this).attr("title")][temp]+'"></div>');
          }
      }
      else{break;}
    }
    var arrayString = houseprovide_help[$(this).attr("number")].split(',');
    $(".travelinfo-selfimg").children('img').attr('src',username_photo[houseprovide_username[$(this).attr("number")]]);
    $(".travelinfo-info-container").children('span').eq(0).text('地址 : '+houseprovide_address[$(this).attr("number")]);
    $(".travelinfo-info-container").children('span').eq(1).children('div').eq(0).text('手機號碼 : '+houseprovide_cellphone[$(this).attr("number")]);
    $(".travelinfo-info-container").children('span').eq(1).children('div').eq(1).text('家電號碼 : '+houseprovide_telephone[$(this).attr("number")]);
    $(".travelinfo-info-container").children('span').eq(2).text('最多人數限制 : '+houseprovide_persons[$(this).attr("number")]);
    $(".comment-input").children('img').attr('src',username_photo[session]);
    for (var c=0;c<=5;c++){
        if (arrayString[c]!=undefined && $(".travelinfo-info-container").children('span').eq(3).children('h1').hasClass(arrayString[c]) ){
            $(".travelinfo-info-container").children('span').eq(3).children('.'+arrayString[c]).css('display','inline-block');
        }
        else{
            break;
        }
    }
    var vals = houseprovide_detail[$(this).attr("number")];
    vals = vals.replace(/<br>/g,"\n");
    vals = vals.replace(/&nbsp/g," ");
    $(".travelinfo-info-container").children('span').eq(4).children('textarea').text(vals);

    var title = houseprovide_title[$(this).attr("number")];
    var date = houseprovide_date[$(this).attr("number")];
    $(".people-comment").children('img').attr('src',username_photo[session]);
    $("#comment-form-arg1").val(title);
    $("#comment-form-arg2").val(date);

    $(".comment-div div").remove();
    LongPolling(title,date,-1,longPollingID++);
  });
}
function LongPolling(title,date,maxID,pollingID){
  $.ajax({
    url: "account/housepolling.php",
    asyn: false,
    data: "title="+title+"&date="+date+"&maxID="+maxID+"",
    type: "post",
    dataType: "json",
    success: function(response) {
      /*alert(pollingID);
      alert(longPollingID-1);*/
      if (pollingID==longPollingID-1){
        var i;
        for(i=0;i<=999999;i++){
          var houseid = response[i].id;
          var housephoto = username_photo[response[i].username];
          var housecomment = response[i].comment;
          if ( response[i].username != 'undefined' && response[i].comment != 'undefined' ){
            if ( response[i].username==session )
              $(".comment-div").append('<div class="people-comment" id='+houseid+'><img src='+housephoto+' alt=""><div class="comment-info"><h1>'+housecomment+'</h1><h2></h2><div class="comment-icons"><i class="fa fa-pencil edit-housecomment"></i><i class="fa fa-times cancel-housecomment"></i></div></div></div>');
            else
              $(".comment-div").append('<div class="people-comment"><img src='+housephoto+' alt=""><div class="comment-info"><h1>'+housecomment+'</h1></div></div>');
          }
          else{
            break;
          }
        }
        $(".cancel-housecomment").unbind('click').click(function() {
          $(this).parents('.people-comment').remove();
          Edit_housecomment($(this).parents('.people-comment').attr('id'),'cancel','cancel');
        });
        $(".edit-housecomment").unbind('click').click(function() {
          if ( !$(this).hasClass('active') ){
            $(this).addClass('active');
            $(this).parents('.comment-info').children('h2').children('form').remove();
            $(this).parents('.comment-info').children('h2').show().append('<form id="editComment-form" method="post" action="account/houseEdit.php"><textarea id="editComment-textarea" name="comment" class="form-control"></textarea><input type="hidden" name="id"><input type="hidden" name="action" value="edit"></form>');
            $("#editComment-textarea").siblings('input').eq(0).val($("#editComment-textarea").parents('.people-comment').attr('id'));
            $("#editComment-form").unbind('submit').submit(function() {
              $.ajax({
                data: $(this).serialize(),
                type: $(this).attr("method"),
                url: $(this).attr("action")
              });
              return false;
            });

            var vals = $(this).parents('.comment-info').children('h1').html();
            vals = vals.replace(/<br>/g,"\n");
            vals = vals.replace(/&nbsp;/g," ");
            $("#editComment-textarea").text(vals);
            $(this).parents('.comment-info').children('h1').hide();
            $( "#editComment-textarea" ).keypress(function(e) {
              e = e || window.event;  
              var keynum = e.keyCode || e.which;
              if(keynum === 13){
                $( "#editComment-form" ).submit();
                var vals = document.getElementById("editComment-textarea").value;
                vals = vals.replace(/\n/g,"<br>");
                vals = vals.replace(/ /g,"&nbsp");
                $(this).parents('.comment-info').children('h1').html(vals);
                $(this).parents('.comment-info').children('h1').show();
                $(this).parents('.comment-info').children('h2').hide();
                $(this).parents('.comment-info').find('.edit-housecomment').removeClass('active');
                return false;
              }
            });
          }
          else{
            $(this).removeClass('active');
            $(this).parents('.comment-info').children('h1').show();
            $(this).parents('.comment-info').children('h2').hide();
          }
        });
        var nowmaxID = response[i].id;
        setTimeout(function() {
          LongPolling(title,date,nowmaxID,pollingID);
        }, 1000);
      }
    },
    error: function( req, status, err ) {
      /*console.log( 'something went wrong:', status, err );
      alert('something went wrong:'+ status + err);*/
      if (pollingID==longPollingID-1){
        setTimeout(function() {
          LongPolling(title,date,'error',pollingID);
        }, 1000);
      }
    }
  });
}
function closeMarker(marker,markerLabel,action){
  for (var c=0;c<=99999;c++){
    if( marker[c]!=undefined ){
      if( action=='animation' && markerLabel==undefined ){
        marker[c].setAnimation(null);
      }
      if( action=='label' && markerLabel!=undefined ){
        markerLabel[c].close();
      }
    }
    else{
      break;
    }
  }
}
var stop_animate_1,stop_animate_2;
function long_animate(selecter,animate,time){
  selecter.addClass(animate);
  stop_animate_1 = setTimeout(function() {
    selecter.removeClass(animate);
  },time-200);
  stop_animate_2 = setTimeout(function() {
    long_animate(selecter,animate,time);
  },time);
}
$(function() {
  var map;
  var marker = new Array();
  var address = new Array();
  var markerLabel = new Array();
  var InfoBoxContent = new Array();
  var geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(23.69781, 120.96051499999999); /*台灣座標*/
  var mapOptions = {
    zoom: 8,
    center: latlng
  };
  map = new google.maps.Map(document.getElementById('googleMap-traveler'), mapOptions);


  for (var c=0;c<=999999;c++){
    if ( houseprovide_title[c]!=undefined ){
      var tempDIV = '';
      var tempID = 'infobox-'+c;
      for (var d=0;d<=999999;d++){
        if (houseprovide_title_photo[houseprovide_title[c]][d]!=undefined){
          tempDIV = tempDIV + '<img src='+houseprovide_title_photo[houseprovide_title[c]][d]+' class="map-travel-titleimg">';
        }
        else{
          break;
        }
      }
      InfoBoxContent[c] = '<div class="infobox" id='+tempID+'><p>標題:&nbsp'+houseprovide_title[c]+'</p><p>地址:&nbsp'+houseprovide_country[c]+houseprovide_address[c]+'</p><div class="map-travel-district" markerID='+c+'><div class="map-travel-img"><div class="travel-previousimg fa fa-angle-up"></div><div class="travel-nextimg fa fa-angle-down"></div><div class="travel-selfimg-outerline"><img src='+username_photo[houseprovide_username[c]]+' class="map-travel-selfimg"></div><div class="travel-titleimg-mapdiv" number='+c+' data-toggle="modal" data-target="#myModal-travelinfo" title='+houseprovide_title[c]+'>'+tempDIV+'</div></div></div></div>';
    }
    else{
      break;
    }
  }

  for (var c=0;c<=999999;c++){  
    if( houseprovide_address[c]!=undefined ){
      markerLabel[c] = new google.maps.InfoWindow({
        content: InfoBoxContent[c],
        maxWidth: 330
      });
      (function(country,address,c) {
        geocoder.geocode( { 'address': country+address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            //map.setCenter(results[0].geometry.location);
            marker[c] = new google.maps.Marker({
              ID: c,
              country: country,
              map: map,
              position: results[0].geometry.location,
              animation: google.maps.Animation.DROP,
              icon: 'images/map_pin_35px.png',
            });

            google.maps.event.addListener(marker[c], 'click', function() {
              closeMarker(marker,undefined,'animation');
              if ( isInfoWindowOpen(markerLabel[c]) ){
                markerLabel[c].close();
              }
              else{
                closeMarker(marker,markerLabel,'label');
                markerLabel[c].open(map, marker[c]);
                marker[c].setAnimation(google.maps.Animation.BOUNCE);
              }
              google.maps.event.addListener(markerLabel[c], 'domready', function(){
                $(".gm-style-iw").css({
                  'width':'373px',
                  'left':'0px',
                  'padding':'0px 8px'
                });
                $(".gm-style-iw").next("div").hide();
              });
              map.setCenter(marker[c].getPosition());
              travel_img_updown(".map-travel-titleimg",".travel-titleimg-mapdiv",190);
              travel_img(".travel-titleimg-mapdiv");
            });
          }
        });
      })(houseprovide_country[c],houseprovide_address[c],c);
    }
    else{
      break;
    }
  }

  for (var c=0;c<=999999;c++){
    if ( houseprovide_title[c]!=undefined ){
      if (commentsCounts[houseprovide_username[c]]==undefined){
        commentsCounts[houseprovide_username[c]] = 0;
      }
      $('.map-travel-container').append('<div class="map-travel-district" markerID='+c+'><div class="map-travel-img"><div class="travel-previousimg fa fa-angle-up"></div><div class="travel-nextimg fa fa-angle-down"></div><div class="travel-selfimg-outerline hover-location" user='+houseprovide_username[c]+'><img src='+username_photo[houseprovide_username[c]]+' class="map-travel-selfimg"><div class="find-location"><div class="comment-and-love commentsUser-click" data-toggle="modal" data-target="#myModal-comments"><p class="fa fa-pencil-square-o"></p><p>'+commentsCounts[houseprovide_username[c]]+'</p></div><div class="comment-and-love like-hover"><p class="glyphicon glyphicon-heart"></p><p>9554854</p></div></div></div><div class="corner"><div><i class="fa fa-map-marker"></i></div></div><div class="travel-titleimg-div" number='+c+' data-toggle="modal" data-target="#myModal-travelinfo" title='+houseprovide_title[c]+'></div></div></div>');
      $(".map-travel-district").eq(c).addClass(countryID[houseprovide_country[c]]);
      for (var d=0;d<=999999;d++){
        if (houseprovide_title_photo[houseprovide_title[c]][d]!=undefined){
          $(".travel-titleimg-div").eq(c).append('<img src='+houseprovide_title_photo[houseprovide_title[c]][d]+' class="map-travel-titleimg">');
        }
        else{
          break;
        }
      }
    }
    else{
      break;
    }
  }
  $(".hover-location").hover(
    function() {
      $(this).stop();
      $(this).children('img').stop();
      $(this).children('img').animate({
        'opacity': '0'
      }, 200, function() {
        $(this).hide();
        $(this).parent('.travel-selfimg-outerline').animate({'width': '250px'}, 300, function() {
          $(this).find('.comment-and-love').show();
        });
      });
    }, function() {
      $(this).children('img').stop();
      $('.travel-selfimg-outerline').stop();
      $(this).find('.comment-and-love').hide();
      $(this).animate({
        'width': '70px'
      }, 300, function() {
        $(this).children('img').show();
        $(this).children('img').animate({'opacity': '1'}, 200, function() {});
      });
    }
  );
  
  $(".like-hover").hover(
    function() {
      $(this).children('p').eq(1).hide();
      $(this).children('p').eq(0).fadeIn();
      long_animate($(this).children('p').eq(0),'tada animated',1200);
    }, function() {
      $(this).children('p').eq(0).hide();
      $(this).children('p').eq(1).fadeIn();
      clearTimeout(stop_animate_1);
      clearTimeout(stop_animate_2);
    }
  );
  $("#globe-selecter").hover(
    function() {
      $(this).addClass('animated shake');
    }, function() {
      $(this).removeClass('animated shake');
    }
  );
  
  $("#globe-selecter").on("click", function(event) {
      $('.map-selecter-container').animate({'margin-left': '-200px'}, 500, function() {});
      $(this).addClass('active').fadeOut();
  });
  $("#traveler-selecter-button").on("click", function(event) {
    closeMarker(marker,markerLabel,'label');
    closeMarker(marker,undefined,'animation');
    $('.map-selecter-container').animate({'margin-left': '0px'}, 500, function() {});
    $("#globe-selecter").removeClass('active').fadeIn();
    var country = $("#googlemap-selecter-select").children('.active').find("option:selected").text();
    $(".map-travel-title").children('.globe-title').text(country);
    if ( countryID[country]!='global' ){
      geocoder.geocode( { 'address': country}, function(results, status) {
        map.panTo(results[0].geometry.location);
      });
      $(".map-travel-container").children('div').hide();
      $(".map-travel-container").children('.'+countryID[country]).fadeIn();
    }
    else{
      $(".map-travel-container").children('div').fadeIn();
    }
    for (var c=0;c<=99999;c++){
      if ( marker[c]==undefined ){
        break;
      }
      if (marker[c].country==country || countryID[country]=='global'){
        marker[c].setVisible(true);
      }
      else{
        marker[c].setVisible(false);
      }
    }
  });
  $("#googlemap-selecter").change(function(){
    var index = $(this).find("option:selected").index();
    $("#googlemap-selecter-select").children('select').removeClass('active').hide();
    $("#googlemap-selecter-select").children('select').eq(index).addClass('active').show();
  });


  travel_img_updown(".map-travel-titleimg",".travel-titleimg-div",270);
  travel_img(".travel-titleimg-div");


  $(".travelinfo-icons").children('span').on("click", function(event) {
      $(".travelinfo-icons").children('span').removeClass('active');
      $(".travelinfo-info-container").children('span').removeClass('active');
      $(this).addClass('active');
      $(".travelinfo-info-container").children('span').eq($(this).index()).addClass('active');
  });


  $("#comment-form").submit(function() {
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        document.getElementById("comment-textarea").blur();
        document.getElementById("comment-textarea").value = "";
        document.getElementById("comment-textarea").value.replace(/[\n]/i, '');
        document.getElementById("comment-textarea").focus();
      },
      error: function( req, status, err ) {
        alert('error');
      }
    });

    return false;
  });
  $(".corner").hover(
    function() {
      long_animate($(this).find('i'),'bounceIn animated',1000);
    }, function() {
      clearTimeout(stop_animate_1);
      clearTimeout(stop_animate_2);
      $(this).find('i').removeClass('bounceIn animated');
    }
  );
  $(".corner").on("click", function(event) {
    $("body").animate({scrollTop:0}, '1000');
    var markerID = $(this).parents('.map-travel-district').attr('markerID');
    if ( !isInfoWindowOpen(markerLabel[markerID]) ){
      google.maps.event.trigger(marker[markerID], 'click', {});
    }
    else{
      map.setCenter(marker[markerID].getPosition());
    }
  });

  $(".commentsUser-click").on("click", function(event) {
    var user = $(this).parents('.travel-selfimg-outerline').attr('user');
    $("#myModal-comments").attr('user',user);
  });
});
