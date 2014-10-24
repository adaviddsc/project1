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
	<link rel="stylesheet" type="text/css" href="stylesheets/help-add-donate.css">
	<script type="text/javascript" src="javascripts/help-add-donate.js"></script>
</head>
<div class="modal fade" id="myModal-donate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
		       	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		    	<div class="donate-header"><h1><?php echo $lang->line("donate");?></h1></div>
		    </div>
		    <div class="modal-body">	
				<div class="item-info">
					<div class="item-info-header"><h1><i class="fa fa-plus-circle"></i>&nbsp<?php echo $lang->line("new item information");?></h1></div>
					<form class="item-info-form" enctype="multipart/form-data" name="form" method="post" action="account/add-donate.php">

						<div class="item-info-images">
							<div class="fa fa-camera-retro"></div>
							<img>
							<input class="item-info-images-input" type="file" name="fileToUpload[]" multiple="" accept="image/jpeg,image/gif,image/png" style="display:none;"/>
						</div>
						

						<div class="item-info-tags">
							<span class="fa fa-tag"></span>
							<span class="glyphicon glyphicon-gift"></span>
							<span class="fa fa-map-marker"></span>
							<span class="glyphicon glyphicon-phone-alt"></span>
							<span class="fa fa-pencil-square-o"></span> 
						</div>
						<div class="item-info-items">
							<div class="item-info-items-div1">
								<input type="text" name="title" class="form-control" placeholder="<?php echo $lang->line("title");?>">
							</div>
							<input type="date" name="date" class="form-control">
							<input type="text" name="items" class="form-control" placeholder="<?php echo $lang->line("items");?>">
							<div id="item-info-twzipcode">								
								<div id="item-info-county" data-role="county" data-style="county" data-value="縣市"></div>
								<div id="item-info-district" data-role="district" data-style="district" data-value="鄉鎮市區"></div> 
								<div id="item-info-zipcode" data-role="zipcode"></div>
							</div>
							<div class="item-info-twzipcode-address">
								<input type="text" name="address" class="form-control" placeholder="<?php echo $lang->line("address");?>">
							</div>
							<div class="item-info-items-div2">
								<input type="text" name="cellphone" class="form-control phone1" placeholder="<?php echo $lang->line("cellphone");?>">
								<input type="text" name="telephone" class="form-control phone2" placeholder="<?php echo $lang->line("telephone");?>">
							</div>
							<textarea class="form-control" name="detail" placeholder="<?php echo $lang->line("items detail");?>"></textarea>
							<input type="submit" class="myButtonDonate" value="<?php echo $lang->line("submit");?>">
						</div>
					</form>
				</div>
		    </div>
		</div>
	</div>
</div>
