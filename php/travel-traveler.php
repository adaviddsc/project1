<!DOCTYPE HTML>
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
?>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheets/travel-traveler.css">
	<script type="text/javascript" src="javascripts/travel-traveler.js"></script>
</head>

<div class="traveler-container">
	<div class="googleMap-traveler" id="googleMap-traveler"></div>
	<div class="map-selecter-container">
		<div class="fa fa-globe" id="globe-selecter"></div>
		<div class="select-district">
			<div class="traveler-selecter-header">
				<i class="fa fa-check-square-o"></i>
				<h1>地圖選擇器</h1>
			</div>
			<div class="traveler-selecter-content">
				<div class="traveler-country-select">
					<span>
						<div class="fa fa-globe"></div>
						<h1>地區選擇</h1>
					</span>
					<select class="form-control" id="googlemap-selecter">
						<option value="global" selected>全球</option>
						<option value="europe">歐洲</option>
						<option value="africa">非洲</option>
						<option value="asia">亞洲</option>
						<option value="oceania">大洋洲</option>
						<option value="northAmerica">北美洲</option>
						<option value="southAmerica">南美洲</option>
						<option value="antarctica">南極洲</option>
					</select>
					<div id="googlemap-selecter-select">
						<select class="form-control active">
							<option value="global" selected>全球</option>
						</select>
						<select class="form-control">
							<option value="europe">法國</option>
						</select>
						<select class="form-control">
							<option value="africa"></option>
						</select>
						<select class="form-control">
							<option value="asia">台灣</option>
							<option value="asia">日本</option>
						</select>
						<select class="form-control">
							<option value="asia">夏威夷</option>
						</select>
						<select class="form-control">
							<option value="asia">美國</option>
						</select>
						<select class="form-control">
							<option value="asia"></option>
						</select>
						<select class="form-control">
							<option value="asia"></option>
						</select>
					</div>
				</div>
				<div class="traveler-selecter-button" id="traveler-selecter-button">確定</div>
			</div>
		</div>
	</div>
	<div class="map-travel-info">
		<div class="map-travel-title">
			<i class="fa fa-globe"></i>
			<h1 class="globe-title">全球</h1><h2>-住屋提供</h2>
			<i class="fa fa-caret-square-o-down"></i>
			<h3>文章排列</h3>
			<select class="form-control" id="article-selecter1">
				<option value="" selected>依文章時間排列</option>
				<option value="">依人氣度排列</option>
			</select>
			<h3>順序</h3>
			<select class="form-control" id="article-selecter2">
				<option value="" selected>順排</option>
				<option value="">逆排</option>
			</select>
		</div>
		<div class="map-travel-container"></div>
	</div>

	
	<div class="modal fade" id="myModal-travelinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators" id="carousel-indicators-travelinfo">
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" id="carousel-inner-travelinfo">
			    
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			  </a>
			</div>
	      </div>
	      <div class="modal-footer">
	      	<div class="travelinfo-selfimg">
	      		<img src="" alt="">
	      	</div>
	      	<div class="travelinfo-title">
				<h1 id="travelinfo-myModalLabel"></h1>
	      	</div>
	      	<div class="asymptotic-line"></div>

	      	<div class="travelinfo-iconinfo">
	      		<div class="travelinfo-icons">
	      			<span><i class="fa fa-map-marker"></i></span>
					<span><i class="glyphicon glyphicon-phone-alt"></i></span>
					<span><i class="fa fa-users"></i></span>
					<span><i class="fa fa-heart"></i></span> 
					<span class="active"><i class="fa fa-pencil-square-o"></i></span>
	      		</div>
	      		<div class="travelinfo-info-container">
	      			<span></span>
	      			<span>
	      				<div></div>
	      				<div></div>
	      			</span>
	      			<span></span>
	      			<span>
	      				<h2>屋主需求 : </h2>
	      				<h1 class="changehouse"><?php echo $lang->line("changehouse");?></h1>
	      				<h1 class="gift"><?php echo $lang->line("gift");?></h1>
	      				<h1 class="share"><?php echo $lang->line("share");?></h1>
	      				<h1 class="buy"><?php echo $lang->line("buy");?></h1>
	      				<h1 class="other"><?php echo $lang->line("other");?></h1>
	      				<h1 class="nothing"><?php echo $lang->line("nothing");?></h1>
	      			</span>
	      			<span class="active">
	      				<textarea readonly></textarea>
	      			</span>
	      		</div>
	      	</div>
	      	<div class="asymptotic-line"></div>
	      	<div class="comment-container">
	      		<h1 class="comment-title">交流區</h1>
	      		<div class="comment-div">
	      			<!--<div class="people-comment">
	      				<img src="" alt="">
		      			<div class="comment-info">
		      				<h1>交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區交流區</h1>
		      				<div class="comment-icons">
		      					<i class="fa fa-pencil"></i>
		      					<i class="fa fa-times"></i>
		      				</div>
		      			</div>
	      			</div>
	      			<div class="people-comment"></div>
	      			<div class="people-comment"></div>-->
	      		</div>
	      		<div class="comment-input">
	      			<img src="" alt="">
	      			<div>
	      				<form id="comment-form" method="post" action="account/houseComment.php">
	      					<textarea id="comment-textarea" name="commentMessage" class="form-control" onkeypress="return CommentSubmit(event,$('#comment-form'))"></textarea>
	      					<input type="text" id="comment-form-arg1" name="title">
	      					<input type="text" id="comment-form-arg2" name="date">
	      				</form>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
