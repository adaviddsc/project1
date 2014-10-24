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
	<link rel="stylesheet" type="text/css" href="stylesheets/travel-home.css">
	<script type="text/javascript" src="javascripts/travel-home.js"></script>
</head>

<div class="travelHome-container">
	<div class="travelHome-header">
		<span>住</span>
		<span>屋</span>
		<span>提</span>
		<span>供</span>
	</div>

	<div class="country-index">
		<div class="country-search">
			<select class="form-control" id="select-continent">
				<option value="global">全球</option>
				<option value="europe">歐洲</option>
				<option value="africa">非洲</option>
				<option value="asia">亞洲</option>
				<option value="oceania">大洋洲</option>
				<option value="northAmerica">北美洲</option>
				<option value="southAmerica">南美洲</option>
				<option value="antarctica">南極洲</option>
			</select>
			<select class="form-control">
			</select>
		</div>
		<div class="country-img asia">
			<div class="country-name">
				<div></div>
				<h1 data-target="#myModal-travelHome" data-toggle="modal">台灣</h1>
			</div>
			<img src="images/台灣.jpg" alt="">
		</div>

		<div class="country-img asia">
			<div class="country-name">
				<div></div>
				<h1 data-target="#myModal-travelHome" data-toggle="modal">日本</h1>
			</div>
			<img src="images/日本.jpg" alt="">
		</div>

		<div class="country-img europe">
			<div class="country-name">
				<div></div>
				<h1 data-target="#myModal-travelHome" data-toggle="modal">法國</h1>
			</div>
			<img src="images/法國.jpg" alt="">
		</div>

		<div class="country-img northAmerica">
			<div class="country-name">
				<div></div>
				<h1 data-target="#myModal-travelHome" data-toggle="modal">美國</h1>
			</div>
			<img src="images/美國.jpg" alt="">
		</div>

		<div class="country-img oceania">
			<div class="country-name">
				<div></div>
				<h1 data-target="#myModal-travelHome" data-toggle="modal">夏威夷</h1>
			</div>
			<img src="images/夏威夷.jpg" alt="">
		</div>
	</div>

	<div class="modal fade" id="myModal-travelHome" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h1 class="modal-title">住屋提供</h1>
		    </div>
		    <div class="modal-body">
				<div class="travelHome-info">
					<div class="travelHome-info-header"><h1><i class="fa fa-plus-circle"></i>&nbsp<?php echo $lang->line("new house information");?></h1></div>
					<form class="travelHome-info-form" enctype="multipart/form-data" name="form" method="post" action="account/add-home.php">

						<div class="travelHome-info-images">
							<div class="fa fa-camera-retro"></div>
							<img>
							<input class="travelHome-info-images-input" type="file" name="fileToUpload[]" multiple="" accept="image/jpeg,image/gif,image/png" style="display:none;"/>
						</div>


						<div class="travelHome-info-tags">
							<span class="fa fa-tag"></span>
							<span class="fa fa-map-marker"></span>
							<span class="glyphicon glyphicon-phone-alt"></span>
							<span class="fa fa-users"></span>
							<span class="fa fa-heart"></span> 
							<span class="fa fa-pencil-square-o"></span> 
						</div>
						<div class="travelHome-info-items">
							<div class="travelHome-info-items-div1">
								<input type="text" name="title" class="form-control" placeholder="<?php echo $lang->line("title");?>">
							</div>
							<input id="travelHome-info-date" type="date" name="date" class="form-control" readonly>

							<div class="travelHome-info-twzipcode-address">
								<input id="travelHome-info-country" type="text" class="form-control" name="country" readonly>
								<div><input type="text" name="address" class="form-control" placeholder="<?php echo $lang->line("address");?>"></div>
							</div>
							<div class="travelHome-info-items-div2">
								<input type="text" name="cellphone" class="form-control phone1" placeholder="<?php echo $lang->line("cellphone");?>">
								<input type="text" name="telephone" class="form-control phone2" placeholder="<?php echo $lang->line("telephone");?>">
							</div>
							
							<div class="persons-count">
								<h2>最多人數限制 :</h2>
								<select class="form-control"name="persons">
								  	<option value="1">1</option>
								  	<option value="2">2</option>
								  	<option value="3">3</option>
								  	<option value="4">4</option>
								  	<option value="5">5</option>
								  	<option value="6">6</option>
								  	<option value="7">7</option>
								  	<option value="8">8</option>
								  	<option value="9">9</option>
								  	<option value="10">10</option>
								  	<option value="20">20</option>
								  	<option value="30">30</option>
								  	<option value="40">40</option>
								  	<option value="50">50</option>
								  	<option value="99">99</option>
								</select>
							</div>
							<div class="travelHome-info-radio">
								<h1><input type="checkbox" name="help[]" value="changehouse">交換住宿</h1>
								<h1><input type="checkbox" name="help[]" value="gift">運送捐贈物</h1>
								<h1><input type="checkbox" name="help[]" value="share">分享旅遊心得</h1>
								<h1><input type="checkbox" name="help[]" value="buy">委帶物品</h1>
								<h1><input type="checkbox" name="help[]" value="other">其他</h1>
								<h1 class="active"><input class="nothing" checked type="checkbox" name="help[]" value="nothing">無</h1>
								<h2>＊以上勾選為提供住宿者希望與旅遊者交換的利益，可複選，詳細情形請寫在下方的任何其他資訊，或是以電話方式做聯絡</h2>
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
</div>

