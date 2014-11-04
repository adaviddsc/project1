function bar_shake(animate){
  $(animate).animate({left:38},100, function() {
    $(animate).animate({left:42},100,function() {
      bar_shake(animate);
    });
  });
}
function bar_shake_stop(){
  $(animate).animate({left:38},100, function() {
    $(animate).animate({left:42},100,function() {
      bar_shake(animate);
    });
  });
}

$(function() {
  
  $.get("php/help-add-donate.php", function(data) {
    $("#waterfall-container").append(data);
  });
  $("#waterfall-glyphicon-heart").on("click", function(event) {
    $(".waterfall-columns").fadeOut();
    $(".donate-columns").fadeIn();
  });
  $(".glyphicon-book , #waterfall-glyphicon-book").on("click", function(event) {
    $(".waterfall-columns").fadeIn();
    $(".donate-columns").fadeOut();
  });
  $("#donate-choice-bar li").on("click", function(event) {
    $("#donate-choice-bar li").attr("class", "");
    $(this).attr("class", "active");
  });
  $(".donate").on("click", function(event) {
    $(".donate-columns-content-container").css("display", "block");
  });
  $(".change").on("click", function(event) {
    $(".donate-columns-content-container").css("display", "none");
  });



  $('#twzipcode').twzipcode({});
  $('#twzipcode').children().children('select').addClass("form-control");
  
  $('#twzipcode').children('#district').children('select').change(function() {
    $('.donate-columns-content-div').remove();
    var addressData = $('#twzipcode:first').data('twzipcode');
    if( addressData.wrap.county.val()=="台灣" ){
      for (var count=0;count<d;count++){
        $(".donate-columns-content-container").append('<div class="donate-columns-content-div"><div data-toggle="close" class="addLocation glyphicon glyphicon-map-marker" address="'+donate_address[count]+'" textTitle="'+donate_title[count]+'"><div class="fa fa-plus"></div></div><img data-toggle="modal" data-target="#myModal-donateinfo" src="'+donate_title_photo[donate_title[count]][0]+'" title="'+donate_title[count]+'"><div class="donate-columns-content-div-info"><img name="'+donate_username[count]+'" src="'+username_photo[donate_username[count]]+'"><div class="fa fa-list-ul"></div><h1>'+donate_title[count]+'</h1></div><div class="donate-columns-content-info-container" name="close-info"><div class="info-container-triangle"></div><div class="info-container-top"><i class="fa fa-info-circle"></i>&nbsp物品資訊</div><div class="info-container-text"><div class="info-container-text-container"><span class="glyphicon glyphicon glyphicon-gift"></span><div>'+donate_item[count]+'</div></div><div class="info-container-text-container"><span class="fa fa-map-marker"></span><div>'+donate_address[count]+'</div></div><div class="info-container-text-container"><span class="glyphicon glyphicon-phone-alt"></span><div>手機:'+donate_cellphone[count]+'<br>家用電話:'+donate_telephone[count]+'</div></div><div class="info-container-text-container"><span class="fa fa-pencil-square-o"></span><div>'+donate_detail[count]+'</div></div><div class="info-container-time">'+donate_date[count]+'</div></div></div></div>');
      }
    }
    else if ( addressData.wrap.district.val()=="鄉鎮市區" ){
      for (var count=0;count<d;count++){
        if ( donate_address[count].indexOf(addressData.wrap.county.val())!=-1 ){
          $(".donate-columns-content-container").append('<div class="donate-columns-content-div"><div data-toggle="close" class="addLocation glyphicon glyphicon-map-marker" address="'+donate_address[count]+'" textTitle="'+donate_title[count]+'"><div class="fa fa-plus"></div></div><img data-toggle="modal" data-target="#myModal-donateinfo" src="'+donate_title_photo[donate_title[count]][0]+'" title="'+donate_title[count]+'"><div class="donate-columns-content-div-info"><img name="'+donate_username[count]+'" src="'+username_photo[donate_username[count]]+'"><div class="fa fa-list-ul"></div><h1>'+donate_title[count]+'</h1></div><div class="donate-columns-content-info-container" name="close-info"><div class="info-container-triangle"></div><div class="info-container-top"><i class="fa fa-info-circle"></i>&nbsp物品資訊</div><div class="info-container-text"><div class="info-container-text-container"><span class="glyphicon glyphicon glyphicon-gift"></span><div>'+donate_item[count]+'</div></div><div class="info-container-text-container"><span class="fa fa-map-marker"></span><div>'+donate_address[count]+'</div></div><div class="info-container-text-container"><span class="glyphicon glyphicon-phone-alt"></span><div>手機:'+donate_cellphone[count]+'<br>家用電話:'+donate_telephone[count]+'</div></div><div class="info-container-text-container"><span class="fa fa-pencil-square-o"></span><div>'+donate_detail[count]+'</div></div><div class="info-container-time">'+donate_date[count]+'</div></div></div></div>');
        }
      }
    }
    else{
      for (var count=0;count<d;count++){
        if ( donate_address[count].indexOf(addressData.wrap.county.val())!=-1 && donate_address[count].indexOf(addressData.wrap.district.val())!=-1 ){
          $(".donate-columns-content-container").append('<div class="donate-columns-content-div"><div data-toggle="close" class="addLocation glyphicon glyphicon-map-marker" address="'+donate_address[count]+'" textTitle="'+donate_title[count]+'"><div class="fa fa-plus"></div></div><img data-toggle="modal" data-target="#myModal-donateinfo" src="'+donate_title_photo[donate_title[count]][0]+'" title="'+donate_title[count]+'"><div class="donate-columns-content-div-info"><img name="'+donate_username[count]+'" src="'+username_photo[donate_username[count]]+'"><div class="fa fa-list-ul"></div><h1>'+donate_title[count]+'</h1></div><div class="donate-columns-content-info-container" name="close-info"><div class="info-container-triangle"></div><div class="info-container-top"><i class="fa fa-info-circle"></i>&nbsp物品資訊</div><div class="info-container-text"><div class="info-container-text-container"><span class="glyphicon glyphicon glyphicon-gift"></span><div>'+donate_item[count]+'</div></div><div class="info-container-text-container"><span class="fa fa-map-marker"></span><div>'+donate_address[count]+'</div></div><div class="info-container-text-container"><span class="glyphicon glyphicon-phone-alt"></span><div>手機:'+donate_cellphone[count]+'<br>家用電話:'+donate_telephone[count]+'</div></div><div class="info-container-text-container"><span class="fa fa-pencil-square-o"></span><div>'+donate_detail[count]+'</div></div><div class="info-container-time">'+donate_date[count]+'</div></div></div></div>');
        }
      }
    }

    $(".fa-list-ul").hover(function() {
      bar_shake(this);
      },function() {
        $(this).css("left","40px");
        $(this).stop();
        }
    );
    $(".fa-list-ul").on("click", function(event) {
      var temp;

      temp = void 0;
      temp = $(this).parent().siblings(".donate-columns-content-info-container");
      if (temp.attr("name") === "close-info") {
        temp.css("display", "block");
        temp.attr("name", "open-info");
      } else if (temp.attr("name") === "open-info") {
        temp.css("display", "none");
        temp.attr("name", "close-info");
      }
    });
    $(".donate-columns-content-div-info img").on('click',function(event){
      if ( $(this).attr("name")==session ){
        document.location.href="self.php";
      }
      else{
        SetCookie("profileID",$(this).attr("name"));  
        document.location.href="profile.php";
      }
    });
    $(".addLocation").on('click',function(event){
      if ($(this).attr("data-toggle")=="close"){
        $(this).removeClass("glyphicon-map-marker");
        $(this).children('div').removeClass("fa-plus");
        $(this).addClass("glyphicon-ok");
        $(this).addClass("getAddress");
        $(this).attr("data-toggle","open");
      }
      else{
        $(this).addClass("glyphicon-map-marker");
        $(this).children('div').addClass("fa-plus");
        $(this).removeClass("glyphicon-ok");
        $(this).removeClass("getAddress");
        $(this).attr("data-toggle","close");
      }
      
    }); 
    
    $(".donate-columns-content-div img").on('click',function(event){
      $('#modal-header-info-donate div').remove();
      $('#carousel-indicators-donateinfo li').remove();
      $('#carousel-inner-donateinfo div').remove();
      $('#modal-header-info-donate div').remove();
      $('#modal-header-info-donate').append('<div class="modal-header-title">'+donate_title[$(this).attr("title")]+'</div>');           
      for (var c=1;c<=999999;c++){    
        if (donate_title_photo[$(this).attr("title")][c-1]!=undefined){
          if (c==1){
            $('#carousel-indicators-donateinfo').append('<li data-target="#carousel-example-generic-donate" data-slide-to="0" class="active"></li>');
            $('#carousel-inner-donateinfo').append('<div class="item active"><img src="'+donate_title_photo[$(this).attr("title")][c-1]+'"></div>');
          }
          else{
            var temp = c-1;
            $('#carousel-indicators-donateinfo').append('<li data-target="#carousel-example-generic-donate" data-slide-to="'+temp+'" class=""></li>');
            $('#carousel-inner-donateinfo').append('<div class="item"><img src="'+donate_title_photo[$(this).attr("title")][temp]+'"></div>');
          }
        }
        else{break;}
      }     
    });
  });
  $('#twzipcode').children('#district').children('select').change();




  /*位置搜尋*/
  $(".twzipcode-location").on('click',function(event){
    //$('.googleMap-body').remove();
    //$('.help-container').append('<div class="googleMap-body"><div class="googleMap-outer"></div><div class="googleMap-container"><div class="googleMap" id="googleMap" style="width:640px; height:480px;"></div></div></div>');
    $('.googleMap-body').fadeIn();

    var geocoder,map;
    var marker = new Array();
    var address = new Array();
    var markerLabel = new Array();
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(0,0);
    var mapOptions = {
      zoom: 12,
      center: latlng
    }
    map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

    for (var c=0;c<=999999;c++){  
      if( $('.getAddress:eq('+c+')').attr("address")!=undefined ){
        address[c] = $('.getAddress:eq('+c+')').attr('address');
        markerLabel[c] = new google.maps.InfoWindow({
          content: '標題:&nbsp'+$('.getAddress:eq('+c+')').attr('textTitle')+'<br>地址:&nbsp'+$('.getAddress:eq('+c+')').attr('address'),
          maxWidth: 300
        });
        (function(address,c) {
          geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {

              map.setCenter(results[0].geometry.location);
              marker[c] = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                animation: google.maps.Animation.DROP,
                icon: 'images/mapPin-Pink.png',
                /*labelContent: "asdfsafdsadfasfA",
                labelAnchor: new google.maps.Point(3, 30),
                labelClass: "labels", */
              });

              google.maps.event.addListener(marker[c], "click", function (e) { 
                markerLabel[c].open(map, marker[c]); 
              });

              google.maps.event.addListener(marker[c], 'click', function() {
                map.setCenter(marker[c].getPosition());
                for (var ani=0;ani<=99999;ani++){
                  if( marker[ani]!=undefined ){
                    marker[ani].setAnimation(null);
                  }
                  else{
                    break;
                  }
                }
                marker[c].setAnimation(google.maps.Animation.BOUNCE);
              });
            }
          });
        })(address[c],c);
      }
      else{
        break;
      }
    }


    $(".googleMap-outer").on('click',function(event){
      $('.googleMap-body').fadeOut();
    });

    $(".addLocation").addClass("glyphicon-map-marker");
    $(".addLocation").children('div').addClass("fa-plus");
    $(".addLocation").removeClass("glyphicon-ok");
    $(".addLocation").removeClass("getAddress");  
    $(".addLocation").attr("data-toggle","close");     
  });
  /*路線規劃*/
  $(".twzipcode-road").on('click',function(event){
    $('#dialog-mapHeader').show();
    $('#dialog-mapFooter').show();
    $('.route-planning-input').show();
    $("#dialog-mapContent").css({
      "margin":"150px auto",
      "width":"400px",
      "border-radius":"7px"
    });
  });
  $(".start-routePlanning").on('click',function(event){
    if ( $('#start-address').val()!='' && $('#end-address').val()!='' ){
      $('#myModal-map').modal('hide');
      $('#dialog-mapHeader').hide();
      $('#dialog-mapFooter').hide();
      $('.route-planning-input').hide();

      $("#dialog-mapContent").css({
        "margin":"80px -21px",
        "width":"auto"
      });
      $('.route-planning-input').hide();
      $('.googleMap-body').fadeIn();

      var geocoder,map;
      var marker = new Array();
      var address = new Array();
      var markerLabel = new Array();
      var arrPoint = new Array();
      geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(0,0);
      var mapOptions = {
        zoom: 12,
        center: latlng
      }
      map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

      address[0] = $('#start-address').val();
      address[1] = $('#end-address').val();
      markerLabel[0] = new google.maps.InfoWindow({
        content: '標題:&nbsp起始位置<br>地址:&nbsp'+$('#start-address').val(),
        maxWidth: 300
      });
      markerLabel[1] = new google.maps.InfoWindow({
        content: '標題:&nbsp終點位置<br>地址:&nbsp'+$('#end-address').val(),
        maxWidth: 300
      });
      for (var c=0;c<=999999;c++){  
        var d=c-2;
        if( $('.getAddress:eq('+d+')').attr("address")!=undefined && c>=2 ){
          arrPoint[d] = $('.getAddress:eq('+d+')').attr('address');
          address[c] = $('.getAddress:eq('+d+')').attr('address');
          markerLabel[c] = new google.maps.InfoWindow({
            content: '標題:&nbsp'+$('.getAddress:eq('+d+')').attr('textTitle')+'<br>地址:&nbsp'+$('.getAddress:eq('+d+')').attr('address')
          });
          (function(address,c) {
            geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {

                map.setCenter(results[0].geometry.location);
                marker[c] = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location,
                  animation: google.maps.Animation.DROP,
                  icon: 'images/mapPin-Pink.png',
                  /*labelContent: "asdfsafdsadfasfA",
                  labelAnchor: new google.maps.Point(3, 30),
                  labelClass: "labels", */
                });

                google.maps.event.addListener(marker[c], "click", function (e) { 
                  markerLabel[c].open(map, marker[c]); 
                });

                google.maps.event.addListener(marker[c], 'click', function() {
                  map.setCenter(marker[c].getPosition());
                  for (var ani=0;ani<=99999;ani++){
                    if( marker[ani]!=undefined ){
                      marker[ani].setAnimation(null);
                    }
                    else{
                      break;
                    }
                  }
                  marker[c].setAnimation(google.maps.Animation.BOUNCE);
                });
              }
            });
          })(address[c],c);
        }
        else if ( c<2 ){
          if (c==0){
            var labelIcon = 
            {
              url: 'images/mapPin-Green.png',
              size: new google.maps.Size(50, 50),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(25, 50),
              scaledSize: new google.maps.Size(50, 50)
            }
          }
          else{
            var labelIcon = 
            {
              url: 'images/mapPin-Blue.ico',
              size: new google.maps.Size(50, 50),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(25, 50),
              scaledSize: new google.maps.Size(50, 50)
            }
          }
          (function(address,c,labelIcon) {
            geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {

                map.setCenter(results[0].geometry.location);
                marker[c] = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location,
                  animation: google.maps.Animation.DROP,
                  icon: labelIcon,
                  labelContent: "asdfsafdsadfasfA",
                  labelAnchor: new google.maps.Point(3, 30),
                  labelClass: "labels", 
                });

                google.maps.event.addListener(marker[c], "click", function (e) { 
                  markerLabel[c].open(map, marker[c]); 
                });

                google.maps.event.addListener(marker[c], 'click', function() {
                  map.setCenter(marker[c].getPosition());
                  for (var ani=0;ani<=99999;ani++){
                    if( marker[ani]!=undefined ){
                      marker[ani].setAnimation(null);
                    }
                    else{
                      break;
                    }
                  }
                  marker[c].setAnimation(google.maps.Animation.BOUNCE);
                });
              }
            });
          })(address[c],c,labelIcon);
        }
        else{
          break;
        }
      }


      

      var directionsService = new google.maps.DirectionsService();
      var map;
      var start = $('#start-address').val();
      var end = $('#end-address').val();

      //規畫路徑呈現選項
      var rendererOptions = {
        suppressMarkers: true
      };

      directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
      var startPoint = new google.maps.LatLng(0,0);
      var myOptions = {
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: startPoint
      }
      map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
      directionsDisplay.setMap(map);

      //經過地點
      var waypts = [];
      for (var i = 0; i < arrPoint.length; i++) {
        waypts.push({
          location: arrPoint[i],
          stopover: true
        });
      }


      if( $(".travelmode").children('.fa-car').hasClass('active') ) {
        var travelMode = google.maps.TravelMode.DRIVING;
      }
      else if ( $(".travelmode").children('.fa-male').hasClass('active') ){
        var travelMode = google.maps.TravelMode.WALKING 
      }
      //規畫路徑請求
      var request = {
        origin: start,
        destination: end,
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: travelMode
      };
       
      directionsService.route(request, function(response, status) {
        //規畫路徑回傳結果
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        }
      });


      $(".googleMap-outer").on('click',function(event){
        $('.googleMap-body').fadeOut();
      });
      $(".addLocation").addClass("glyphicon-map-marker");
      $(".addLocation").children('div').addClass("fa-plus");
      $(".addLocation").removeClass("glyphicon-ok");
      $(".addLocation").removeClass("getAddress");  
      $(".addLocation").attr("data-toggle","close");  
    }
    else{
      if( $('#start-address').val()=='' ){
        $('#start-address').focus();
      }
      else if( $('#end-address').val()=='' ){
        $('#end-address').focus();
      }
    }
  });
    





  var count=0;
  while(helpUsername[count]!=undefined && helpTitle[count]!=undefined){
    if (helpUsername[count]!=undefined && helpTitle[count]!=undefined){
      $(".waterfall-columns").append('<div class="waterfall-div"><img data-toggle="modal" data-target="#myModal-helpinfo" name="'+helpUsername[count]+'" title="'+helpTitle[count]+'" src="'+helpImg[helpUsername[count]+helpTitle[count]][0]+'"><div class="waterfall-div-info"><img src="'+username_photo[helpUsername[count]]+'"><h1>'+helpTitle[count]+'</h1></div></div>');
    }
    else{
      break;
    }
    count++;
  }

  $(".waterfall-div-info img").on('click',function(event){
    if ( $(this).attr("name")==session ){
      document.location.href="self.php";
    }
    else{
      SetCookie("profileID",$(this).attr("name"));  
      document.location.href="profile.php";
    }
  });
  $(".waterfall-div img").on('click',function(event){
    $('#modal-header-info div').remove();
    $('#carousel-indicators-helpinfo li').remove();
    $('#carousel-inner-helpinfo div').remove();
    $('#modal-footer-helpinfo div').remove();
    $('#modal-header-info').append('<div class="modal-header-title">'+$(this).attr("title")+'</div>');            
    for (var c=1;c<=999999;c++){    
      if (helpImg[$(this).attr("name")+$(this).attr("title")][c-1]!=undefined){
        if (c==1){
          $('#carousel-indicators-helpinfo').append('<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>');
          $('#carousel-inner-helpinfo').append('<div class="item active"><img src="'+helpImg[$(this).attr("name")+$(this).attr("title")][c-1]+'"></div>');
        }
        else{
          var temp = c-1;
          $('#carousel-indicators-helpinfo').append('<li data-target="#carousel-example-generic" data-slide-to="'+temp+'" class=""></li>');
          $('#carousel-inner-helpinfo').append('<div class="item"><img src="'+helpImg[$(this).attr("name")+$(this).attr("title")][temp]+'"></div>');
        }
      }
      else{break;}
    }
    //$('#modal-footer-helpinfo').append('<div class="modal-footer-text"><div>'+help_text[$(this).attr("title")]+'</div></div>');     
  });

  $(".travelmode i").on('click',function(event){
    $(".travelmode i").removeClass("active");
    $(this).addClass("active");
  });
});

