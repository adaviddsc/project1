$(function() {
	var count=0;
	while(travelUsername[count]!=undefined && travelTitle[count]!=undefined){
	    $(".waterfall-columns").append('<div class="waterfall-div"><img data-toggle="modal" data-target="#myModal-helpinfo" count="'+count+'" src="'+travelImg[travelUsername[count]+travelTitle[count]][0]+'"><div class="waterfall-div-info"><img src="'+username_photo[travelUsername[count]]+'"><h1>'+travelTitle[count]+'</h1></div></div>');
	    count++;
	}
	$(".waterfall-div img").on('click',function(event){
	    $('#modal-header-info div').remove();
	    $('#carousel-indicators-helpinfo li').remove();
	    $('#carousel-inner-helpinfo div').remove();
	    $('#modal-footer-helpinfo div').remove();
	    $('#modal-header-info').append('<div class="modal-header-title">'+travelTitle[$(this).attr("count")]+'</div>');            
	    for (var c=1;c<=999999;c++){    
	      if (travelImg[travelUsername[$(this).attr("count")]+travelTitle[$(this).attr("count")]][c-1]!=undefined){
	        if (c==1){
	          $('#carousel-indicators-helpinfo').append('<li data-target="#carousel-example-generic-travelinfo" data-slide-to="0" class="active"></li>');
	          $('#carousel-inner-helpinfo').append('<div class="item active"><img src="'+travelImg[travelUsername[$(this).attr("count")]+travelTitle[$(this).attr("count")]][c-1]+'"></div>');
	        }
	        else{
	          var temp = c-1;
	          $('#carousel-indicators-helpinfo').append('<li data-target="#carousel-example-generic-travelinfo" data-slide-to="'+temp+'" class=""></li>');
	          $('#carousel-inner-helpinfo').append('<div class="item"><img src="'+travelImg[travelUsername[$(this).attr("count")]+travelTitle[$(this).attr("count")]][temp]+'"></div>');
	        }
	      }
	      else{break;}
	    }
	    $('#modal-footer-helpinfo').append('<div class="article-content-container"><div class="left-container"><div class="fa fa-tag"><h1>'+travelTitle[$(this).attr("count")]+'</h1></div><div class="fa fa-clock-o"><h1>'+travelTime[$(this).attr("count")]+'</h1></div><div class="fa fa-umbrella"><h1><i class="fa fa-smile-o article-mood" value="smile"></i><i class="fa fa-meh-o article-mood" value="soso"></i><i class="fa fa-frown-o article-mood" value="down"></i></h1></div><div class="fa fa-location-arrow"><h1>'+travelPosition[$(this).attr("count")]+'</h1></div><div class="article-date">'+travelDate[$(this).attr("count")]+'</div></div><div class="right-container"><span class="fa fa-pencil">記事</span><div class="article-text">'+travelText[$(this).attr("count")]+'</div></div></div>');     
	    $("#modal-footer-helpinfo").find('.article-mood[value='+travelMood[$(this).attr("count")]+']').css('display','block');
	    $(".article-text").mCustomScrollbar({
	      theme:"rounded-dark",
	      scrollButtons:{
	        enable:true
	      }
	    });
	});
});