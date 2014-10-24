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
	<link rel="stylesheet" type="text/css" href="stylesheets/user-comments.css">
	<script type="text/javascript" src="javascripts/user-comments.js"></script>
</head>
<div class="modal fade" id="myModal-comments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <div class="readonly-comments block-comments active">
		        	<div class="fa fa-pencil-square-o"></div>
		        	<h1>評論區</h1>
		        </div>
		        <div class="edit-comments block-comments">
		        	<div class="fa fa-pencil"></div>
		        	<h1>給予評論</h1>
		        </div>
				<div class="comments-userimg">
					<img src="">
				</div>
		    </div>
		    <div class="modal-body">
		    	<div class="comments-container block-container active">
		    		<div class="comments-imgContainer">
		    			<i class="fa fa-angle-left comments-changeImg"></i>
		    			<i class="fa fa-angle-right comments-changeImg"></i>
		    			<div class="img-outline">
		    				<!--<img class="comments-allImg active" src="images/夏威夷.jpg" alt="">
		    				<img class="comments-allImg" src="images/日本.jpg" alt="">
		    				<img class="comments-allImg" src="images/台灣.jpg" alt="">
		    				<img class="comments-allImg" src="images/美國.jpg" alt="">-->
		    			</div>
		    		</div>
		    		<div class="comments-info">
		    			<div class="comments-title"></div>
		    			<div class="comments-contents">
		    			</div>
		    			<div class="comments-date">
			    			<i class="fa fa-heart show-comments-heart"></i>
			    			<i class="fa fa-heart show-comments-heart"></i>
			    			<i class="fa fa-heart show-comments-heart"></i>
			    			<i class="fa fa-heart show-comments-heart"></i>
			    			<i class="fa fa-heart show-comments-heart"></i>
			    			<div></div>
			    		</div>
		    		</div>
		    	</div>
		      	<div class="edit-container block-container">
		      		<div class="edit-comments-header">
		      			<i class="fa fa-camera active"></i>
		      			<i class="fa fa-file-text-o"></i>
		      		</div>
		      		<div class="edit-comments-body">
		      			<form id="edit-comments-form" class="ajax-fileupload" enctype="multipart/form-data" name="form" method="post" action="account/edit-Comments.php">
		      				<div class="comments-img">
		      					<input id="edit-comments-input" type="file" name="fileToUpload[]" multiple="" accept="image/jpeg,image/JPEG,image/gif,image/png" style="display:none;"/>
			      				<input type="hidden" user="" id="comments-userID" name="commentsUser">
			      				<div class="comments-outerline">
					      			<div class="edit-comments-addimg fa fa-camera" id="edit-comments-addimg">
					      				<img class="comments-addimg">
					      				<i class="fa fa-plus"></i>
					      				<div class="progressbar"></div>
					      			</div>
					      		</div>
				      			<div class="comments-outerline">
					      			<div class="edit-comments-addimg">
					      				<img class="comments-addimg">
					      				<div class="progressbar"></div>
					      			</div>
				      			</div>
				      			<div class="comments-outerline">
					      			<div class="edit-comments-addimg">
					      				<img class="comments-addimg">
					      				<div class="progressbar"></div>
					      			</div>
				      			</div>
				      			<div class="comments-outerline">
					      			<div class="edit-comments-addimg">
					      				<img class="comments-addimg">
					      				<div class="progressbar"></div>
					      			</div>
				      			</div>
				      			<div class="comments-outerline">
					      			<div class="edit-comments-addimg">
					      				<img class="comments-addimg">
					      				<div class="progressbar"></div>
					      			</div>
				      			</div>
				      			<div class="comments-outerline">
					      			<div class="edit-comments-addimg">
					      				<img class="comments-addimg">
					      				<div class="progressbar"></div>
					      			</div>
				      			</div>
		      				</div>
		      				<div class="comments-text">
								<p>
									<span class="fa fa-tag">標題</span>
									<input type="text" class="form-control" name="commentsTitle">
								</p>
								<p>
									<span class="fa fa-file-text-o">評論</span>
									<textarea class="form-control" name="commentsContent"></textarea>
								</p>
								<p>
									<span class="fa fa-heart">評分</span>
									<i class="fa fa-heart comments-heart"></i>
									<i class="fa fa-heart-o comments-heart"></i>
									<i class="fa fa-heart-o comments-heart"></i>
									<i class="fa fa-heart-o comments-heart"></i>
									<i class="fa fa-heart-o comments-heart"></i>
									<input type="hidden" id="comments-heart" value="1" name="commentsStarts">
								</p>
		      				</div>
			      		</form>
		      		</div>
		      	</div>
		    </div>
		    <div class="modal-footer">
		    	<div class="comments-footer block-footer active">
		    		<!--<div class="comments-user active">
		    			<img src="images/日本.jpg" alt="">
		    		</div>
		    		<div class="comments-user">
		    			<img src="images/夏威夷.jpg" alt="">
		    		</div>
		    		<div class="comments-user">
		    			<img src="images/美國.jpg" alt="">
		    		</div>
		    		<div class="comments-user">
		    			<img src="images/台灣.jpg" alt="">
		    		</div>
		    		<div class="comments-user">
		    			<img src="images/日本.jpg" alt="">
		    		</div>
		    		<div class="comments-user">
		    			<img src="images/夏威夷.jpg" alt="">
		    		</div>
		    		<div class="comments-user">
		    			<img src="images/美國.jpg" alt="">
		    		</div>-->
		    	</div>
		    	<div class="edit-footer block-footer">
		    		<h1 id="ajax-message"></h1>
			    	<button class="fa fa-times" id="comments-clear"><h1>取消重填</h1></button>
					<button class="fa fa-pencil" id="comments-submit"><h1>送出評論</h1></button>
		    	</div>
		    </div>
		</div>
	</div>
</div>