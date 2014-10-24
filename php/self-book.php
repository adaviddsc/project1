<?php
session_start();
include("../account/connect.php");
include("../language.php");
if ( isset( $_COOKIE['language'] ) ){
	$language = $_COOKIE['language'];
}
else{
	$language = "zh-tw";
}

$lang = new Language();
$lang->load($language);

$idSelf = $_SESSION['username'];
echo "<script>"; 
echo "var signalAddFriend = '';";
echo "var cookie = '';";
echo "var session;";
echo "var alreadyFriend = '';";
echo "</script>";
if ( isset( $_COOKIE['profileID'] ) || isset( $_SESSION['username'] ) ){
	if ( isset( $_COOKIE['profileID'] ) && $_COOKIE['profileID']!=$_SESSION['username'] ){
		echo "<script>"; 
		echo "var cookie = '".$_COOKIE['profileID']."';";
		echo "</script>"; 
		$profileID = $_COOKIE['profileID'];	
		$sqlSelf = "SELECT * FROM addfriend WHERE sendUser = '$idSelf' AND receiveUser = '$profileID'";
		$resultSelf = mysql_query($sqlSelf);
		$rowSelf = @mysql_fetch_row($resultSelf);		
		if ( isset($rowSelf[0]) ){
			echo "<script>"; 
			echo "var signalAddFriend = 'send-friend';";
			echo "</script>"; 
			$friend = $lang->line("cancel add friend");
		}
		else{
			$friend = $lang->line("add friend");
		}

		$sqlSelf = "SELECT * FROM friends WHERE username = '$idSelf' AND friends = '$profileID'";
		$resultSelf = mysql_query($sqlSelf);
		$rowSelf = @mysql_fetch_row($resultSelf);
		if ( isset($rowSelf[0]) ){
			echo "<script>"; 
			echo "var alreadyFriend = true;";
			echo "</script>"; 
		}
		else{
			echo "<script>"; 
			echo "var alreadyFriend = false;";
			echo "</script>"; 
		}

		$sqlSelf = "SELECT * FROM account WHERE username = '$profileID'";
	}
	else if ( isset( $_SESSION['username'] ) ){		
		$sqlSelf = "SELECT * FROM account WHERE username = '$idSelf'";
		echo "<script>"; 
		echo "session = '".$idSelf."';";
		echo "</script>"; 
	}

	$resultSelf = mysql_query($sqlSelf);
	$rowSelf = @mysql_fetch_row($resultSelf);
	$photoSelf = $rowSelf[5];
	if( $rowSelf[6]==null ){
		$photoBack = "images/startBack.jpg";
	}
	else{
		$photoBack = $rowSelf[6];
	}
}
?>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheets/self-book.css">
	<script type="text/javascript" src="javascripts/self-book.js"></script>
</head>

<div class="selfbook-container">
	<div class="selfbook-header">
		<form id="back-photo-edit" class="ajax-fileupload" enctype="multipart/form-data" name="form" method="post" action="account/edit-BackPhoto.php">
			<input id="back-photo-input" type="file" name="fileToUpload" accept="image/jpeg,image/gif,image/png" style="display:none;"/>
			<div class="self-top"><img src="<?php echo $photoBack;?>"></div>
			<input type="submit" style="display: none;">
		</form>
		<form id="self-photo-edit" class="ajax-fileupload" enctype="multipart/form-data" name="form" method="post" action="account/edit-SelfPhoto.php">
			<input id="self-photo-input" type="file" name="fileToUpload" accept="image/jpeg,image/gif,image/png" style="display:none;"/>									
			<div class="self-photo"><img id="self-photo" src="<?php echo $photoSelf;?>"></div>
			<div class="self-photo" id="self-photo-back"><i class="change-photo fa fa-camera"></i></div>
			<input type="submit" style="display: none;">
		</form>
		<div id="self-top-choice-out">
			<div id="choice-info" class="self-top-choice-info fa fa-info-circle float-left" data-toggle="modal" data-target="#myModal-info"><h1><?php echo $lang->line("information");?></h1></div>
			<span class="vertical-line float-left"></span>
			<div id="group-info" class="self-top-choice-info fa fa-users float-left"><h1><?php echo $lang->line("friend list");?></h1></div>
			<span class="vertical-line float-left"></span>
			<div class="commentsUser-click fa fa-pencil-square-o float-left" data-toggle="modal" data-target="#myModal-comments"><h1>個人評論</h1></div>

			<!--<div id="addfriend-info" name="not-friend" class="self-top-choice-info fa fa-plus-circle"><h1><?php echo $friend;?></h1></div>-->

			<div class="new-article fa fa-pencil float-right"><h1>新增文章</h1></div>
			<span class="vertical-line float-right"></span>
		</div>
	</div>
	<div class="add-article">
		<div class="add-article-circle">
			<div class="quater-circle">
				<i class="fa fa-plane"></i>
				<h1>旅遊記事</h1>
			</div>
			<div class="quater-circle">
				<i class="fa fa-heart"></i>
				<h1>慈善心得</h1>
			</div>
			<div class="quater-circle" data-toggle="modal" data-target="#myModal-helpadd">
				<i class="fa fa-coffee"></i>
				<h1>心情雜記</h1>
			</div>
			<div class="quater-circle">

			</div>
			<div class="circle-addicon">
				<i class="fa fa-pencil"></i>
				<h1>新增</h1>
			</div>
		</div>
	</div>
	<div class="article-container">
		<div class="article-header">
			<div class="article-content">
				<i class="fa fa-plane"></i>
				<h1>旅遊記事</h1>
			</div>
			<div class="article-content">
				<i class="fa fa-heart"></i>
				<h1>慈善心得</h1>
			</div>
			<div class="article-content">
				<i class="fa fa-coffee"></i>
				<h1>心情雜記</h1>
			</div>
		</div>

		<div class="article-body">
			<div class="bookmark-container">
				<div class="left-bookmark active" value="all">全部</div>
				<div class="left-bookmark" value="food">美食</div>
	    		<div class="left-bookmark" value="music">音樂</div>
	    		<div class="left-bookmark" value="photograph">攝影</div>
	    		<div class="left-bookmark" value="movie">電影</div>
	    		<div class="left-bookmark" value="animal">動物</div>
	    		<div class="left-bookmark" value="design">設計</div>
	    		<div class="left-bookmark" value="sport">運動</div>
	    		<div class="left-bookmark" value="book">書籍</div>
	    		<div class="left-bookmark" value="science">科技</div>
	    		<div class="left-bookmark" value="activity">活動</div>
	    		<div class="left-bookmark" value="architecture">建築</div>
	    		<div class="left-bookmark" value="religion">宗教</div>
	    		<div class="left-bookmark" value="love">愛情</div>
	    		<div class="left-bookmark" value="fashion">時尚</div>
	    		<div class="left-bookmark" value="other">其他</div>
			</div>
			<div class="book-left"></div>
			<div class="book-right">
				<div class="fa fa-angle-left change-page"></div>
				<div class="fa fa-angle-right change-page"></div>

				<!--<div class="self-article-div">
					<div class="article-img-container">
						<div class="img-hidden"></div>
						<div class="filp-img">
							<i class="fa fa-arrows-h" id="open-flip">
								<div></div>
							</i>
							<i class="fa fa-long-arrow-left flip-arrow"></i>
							<i class="fa fa-long-arrow-right flip-arrow"></i>
						</div>
					</div>
					<div class="article-content-container">
						<div class="left-container">
							<div class="fa fa-tag">
								<h1>我是標題</h1>
							</div>
							<div class="fa fa-clock-o">
								<h1>我是時間</h1>
							</div>
							<div class="fa fa-umbrella">
								<h1>心情</h1>
							</div>
							<div class="fa fa-location-arrow">
								<h1>地點</h1>
							</div>
						</div>
						<div class="right-container">

						</div>
					</div>
				</div>-->
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
/*
	if (signalAddFriend != ''){
		$("#addfriend-info").attr("name","send-friend");
		$("#addfriend-info").removeClass("fa-plus-circle").addClass("fa-times-circle");
	}
	if (cookie=='' || alreadyFriend==true){
		$("#addfriend-info").css("display","none");
	}
	
	var Page = (function() {
		var config = {
			$bookBlock : $( '#bb-bookblock' ),
			$navNext : $( '#bb-nav-next' ),
			$navPrev : $( '#bb-nav-prev' ),
			$navFirst : $( '#bb-nav-first' ),
			$navLast : $( '#bb-nav-last' )
		},
		init = function() {
			config.$bookBlock.bookblock({
				speed : 1000,
				shadowSides : 0.8,
				shadowFlip : 0.4
			});
			initEvents();
		},
		initEvents = function() {						
			var $slides = config.$bookBlock.children();
			config.$navNext.on( 'click touchstart', function() {
				config.$bookBlock.bookblock( 'next' );
				return false;
			});
			config.$navPrev.on( 'click touchstart', function() {
				config.$bookBlock.bookblock( 'prev' );
				return false;
			});
			config.$navFirst.on( 'click touchstart', function() {
				config.$bookBlock.bookblock( 'first' );
				return false;
			});
			config.$navLast.on( 'click touchstart', function() {
				config.$bookBlock.bookblock( 'last' );
				return false;
			});	

			$(".story").on('click',function(){
				
				if (cookie==""){
					if (help_title[0]!=undefined){
						$("#secon-page").append('<div class="bb-custom-side bb-custom-side-right"><div class="page-contain"><div class="help-img"><img title="'+help_title[0]+'" src="'+help_index_photo[help_title[0]]+'"></div><div class="book-pen" title="'+help_title[0]+'" data-toggle="modal" data-target="#myModal-helpinfo"><img src="images/bookpen.png"></div><div class="help-img-title">'+help_title[0]+'</div></div></div>');
					}
					for (var c=1;c<=999999;c=c+2){
						var temp = ((c+1)/2)+2;
						if (help_title[c]!=undefined && help_title[c+1]!=undefined){
							$("#bb-bookblock").append('<div class="bb-item"> <div class="bb-custom-side"> <div class="page-contain" name="'+temp+'"> <div class="help-img"><img title="'+help_title[c]+'" src="'+help_index_photo[help_title[c]]+'"></div> <div class="book-pen" title="'+help_title[c]+'" data-toggle="modal" data-target="#myModal-helpinfo"><img src="images/bookpen.png"></div><div class="help-img-title">'+help_title[c]+'</div> </div> </div> <div class="bb-custom-side bb-custom-side-right"> <div class="page-contain"> <div class="help-img"><img title="'+help_title[c+1]+'" src="'+help_index_photo[help_title[c+1]]+'"></div> <div class="book-pen" title="'+help_title[c+1]+'" data-toggle="modal" data-target="#myModal-helpinfo"><img src="images/bookpen.png"></div><div class="help-img-title">'+help_title[c+1]+'</div> </div> </div> </div>');
						}
						else if(help_title[c]!=undefined && help_title[c+1]==undefined){
							$("#bb-bookblock").append('<div class="bb-item"><div class="bb-custom-side"><div class="page-contain" name="'+temp+'"><div class="help-img"><img title="'+help_title[c]+'" src="'+help_index_photo[help_title[c]]+'"></div><div class="book-pen" title="'+help_title[c]+'" data-toggle="modal" data-target="#myModal-helpinfo"><img src="images/bookpen.png"></div><div class="help-img-title">'+help_title[c]+'</div></div></div></div>');
						}
						else
							break;
					}
				}
				else{
					$('#secon-page').remove();
					for (var c=0;c<=999999;c=c+2){
						var temp = (c/2)+2;
						if (help_title[c]!=undefined && help_title[c+1]!=undefined){
							$("#bb-bookblock").append('<div class="bb-item"> <div class="bb-custom-side"> <div class="page-contain" name="'+temp+'"> <div class="help-img"><img title="'+help_title[c]+'" src="'+help_index_photo[help_title[c]]+'"></div> <div class="book-pen" title="'+help_title[c]+'" data-toggle="modal" data-target="#myModal-helpinfo"><img src="images/bookpen.png"></div><div class="help-img-title">'+help_title[c]+'</div> </div> </div> <div class="bb-custom-side bb-custom-side-right"> <div class="page-contain"> <div class="help-img"><img title="'+help_title[c+1]+'" src="'+help_index_photo[help_title[c+1]]+'"></div> <div class="book-pen" title="'+help_title[c+1]+'" data-toggle="modal" data-target="#myModal-helpinfo"><img src="images/bookpen.png"></div><div class="help-img-title">'+help_title[c+1]+'</div> </div> </div> </div>');
						}
						else if(help_title[c]!=undefined && help_title[c+1]==undefined){
							$("#bb-bookblock").append('<div class="bb-item"><div class="bb-custom-side"><div class="page-contain" name="'+temp+'"><div class="help-img"><img title="'+help_title[c]+'" src="'+help_index_photo[help_title[c]]+'"></div><div class="book-pen" title="'+help_title[c]+'" data-toggle="modal" data-target="#myModal-helpinfo"><img src="images/bookpen.png"></div><div class="help-img-title">'+help_title[c]+'</div></div></div></div>');
						}
						else
							break;
					}
				}
				$(".book-pen").hover(function() {
						$(this).css("opacity",".5");
					},function() {
						$(this).css("opacity","0");
					}
				);
				 $(".arrow").hover(function() {
						$(this).css("-webkit-filter","drop-shadow(1px 1px 2px rgba(0,0,0,1))");
						$(this).css("opacity","1");
					},function() {
						$(this).css("-webkit-filter","drop-shadow(0px 0px 0px rgba(0,0,0,1))");
						$(this).css("opacity",".5");
					}
				);
			   
				$("#arrow-right").fadeIn();
				Page.init();
				config.$bookBlock.bookblock( 'next' );
				$(".book-pen").on('click',function(event){	

					$('#modal-header-info div').remove();
					$('#carousel-indicators-helpinfo li').remove();
				    $('#carousel-inner-helpinfo div').remove();
					$('#modal-footer-helpinfo div').remove();
					$('#modal-header-info').append('<div class="modal-header-title">'+help_title[$(this).attr("title")]+'</div>');						
				    for (var c=1;c<=999999;c++){		
						if (help_title_photo[$(this).attr("title")][c-1]!=undefined){
							if (c==1){
								$('#carousel-indicators-helpinfo').append('<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>');
								$('#carousel-inner-helpinfo').append('<div class="item active"><img src="'+help_title_photo[$(this).attr("title")][c-1]+'"><button title="'+$(this).attr("title")+'" name="'+help_title_photo[$(this).attr("title")][c-1]+'">'+Change_Story_Photo+'</button></div>');
							}
							else{
								var temp = c-1;
								$('#carousel-indicators-helpinfo').append('<li data-target="#carousel-example-generic" data-slide-to="'+temp+'" class=""></li>');
								$('#carousel-inner-helpinfo').append('<div class="item"><img src="'+help_title_photo[$(this).attr("title")][temp]+'"><button title="'+$(this).attr("title")+'" name="'+help_title_photo[$(this).attr("title")][temp]+'">'+Change_Story_Photo+'</button></div>');
							}
						}
						else{break;}
					}
					$('#modal-footer-helpinfo').append('<div class="modal-footer-text"><div>'+help_text[$(this).attr("title")]+'</div></div>');
					$("#carousel-inner-helpinfo button").hover(function() {
							$(this).css("background-color","white");
							$(this).css("color","black");
						},function() {
							$(this).css("background-color","black");
							$(this).css("color","white");
						}
					);
					$("#carousel-inner-helpinfo button").on('click',function(){
						$.get('account/StoryPhoto.php?title='+$(this).attr("title")+'&photo='+$(this).attr("name")+'', function(responseText) {
			    			var testString = responseText.slice(143);
			    			var title = testString.substring(0,testString.indexOf(","));
			    			var photo = testString.substring(testString.indexOf(",")+1);
			    			$('.help-img img[title='+title+']').attr("src",photo);
						});
					});
					if ( cookie!="" )
						$('#carousel-inner-helpinfo button').css('display', 'none');
				});
			});	
		};
		return { init : init };
	})();
	Page.init();
*/
</script>
