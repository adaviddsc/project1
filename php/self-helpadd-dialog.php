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
	<link rel="stylesheet" type="text/css" href="stylesheets/self-helpadd-dialog.css">
	<script type="text/javascript" src="javascripts/self-helpadd-dialog.js"></script>
	<script src="jquery.mCustomScrollbar.concat.min.js"></script>
	<link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
</head>
<div class="modal fade" id="myModal-helpadd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="love-add-modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <div class="h1-login-register fa fa-coffee"><h1>心情雜記</h1></div>
		    </div>
		    <div class="modal-body" id="love-add-modal-body">
			    <form id="self-article-edit" enctype="multipart/form-data" name="form" method="post" action="account/edit-helpstory.php">
			    	<div class="self-article-title">
			    		<i class="fa fa-tag"><h1>輸入文章標題</h1></i>
			    		<input type="text" class="form-control" placeholder="標題" name="title">
			    		<input type="date" class="form-control" name="date">
			    	</div>
			    	<div class="self-article-bookmark">
			    		<i class="fa fa-bookmark"><h1>選擇書籤</h1></i>
			    		<div class="bookmark-container">
			    			<div class="bookmark" value="food">美食</div>
				    		<div class="bookmark" value="music">音樂</div>
				    		<div class="bookmark" value="photograph">攝影</div>
				    		<div class="bookmark" value="movie">電影</div>
				    		<div class="bookmark" value="animal">動物</div>
				    		<div class="bookmark" value="design">設計</div>
				    		<div class="bookmark" value="sport">運動</div>
				    		<div class="bookmark" value="book">書籍</div>
				    		<div class="bookmark" value="science">科技</div>
				    		<div class="bookmark" value="activity">活動</div>
				    		<div class="bookmark" value="architecture">建築</div>
				    		<div class="bookmark" value="religion">宗教</div>
				    		<div class="bookmark" value="love">愛情</div>
				    		<div class="bookmark" value="fashion">時尚</div>
				    		<div class="bookmark active" value="other">其他</div>
			    		</div>
			    		<input type="hidden" name="bookmark" id="bookmark-input" value="other">
			    	</div>
			    	<div class="self-article-content">
			    		<i class="fa fa-pencil-square-o"><h1>文章內容</h1></i>
			    		<span class="fa fa-clock-o">
			    			<h1>時間:</h1>
			    			<input type="checkbox" name="time[]" id="checkboxG1" class="css-checkbox" value="daybreak"/><label for="checkboxG1" class="css-label">凌晨</label>
			    			<input type="checkbox" name="time[]" id="checkboxG2" class="css-checkbox" value="morning"/><label for="checkboxG2" class="css-label">早上</label>
			    			<input type="checkbox" name="time[]" id="checkboxG3" class="css-checkbox" value="afternoon"/><label for="checkboxG3" class="css-label">下午</label>
			    			<input type="checkbox" name="time[]" id="checkboxG4" class="css-checkbox" value="night"/><label for="checkboxG4" class="css-label">晚上</label>
			    		</span>
			    		<span class="fa fa-location-arrow">
			    			<h1>地點:</h1>
			    			<input type="text" class="form-control atricle-location" name="position">
			    		</span>
			    		<span class="fa fa-umbrella">
			    			<h1>心情:</h1>
			    			<div class="mood">
			    				<i class="fa fa-smile-o active" value="smile"></i>
				    			<i class="fa fa-meh-o" value="soso"></i>
				    			<i class="fa fa-frown-o" value="down"></i>
			    			</div>
			    			<input type="hidden" name="mood" value="smile" id="mood-input">
			    		</span>
			    		<span class="fa fa-picture-o">
			    			<h1>照片:</h1>
			    			<div class="self-article-images">
			    				<div class="fa fa-camera add-img-camera"><h1>新增照片</h1></div>
			    				<div class="article-images-div">
			    					<img src="" alt="">
			    				</div>
			    			</div>
			    			<input id="self-article-images" type="file" name="fileToUpload[]" multiple="" accept="image/jpeg,image/gif,image/png" style="display:none;"/>
			    		</span>
			    		<span class="fa fa-pencil">
			    			<h1>記事:</h1>
			    			<textarea name="text" class="form-control"></textarea>
			    		</span>
			    	</div>
				</form>
			</div>
		    <div class="modal-footer">
		    	<h2 id="self-article-ajaxMessage"></h2>
		    	<button class="fa fa-times" id="self-article-clear"><h1>取消重填</h1></button>
				<button class="fa fa-pencil" id="self-article-submit"><h1>張貼文章</h1></button>
		    </div>
		</div>
	</div>
</div>