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

if ( isset( $_SESSION['username'] ) ){
	$idSelf = $_SESSION['username'];
	echo "<script>"; 
	echo "session = '".$_SESSION['username']."';";
	echo "</script>"; 
}

$sql = "SELECT * FROM account";
$result = mysql_query($sql);
echo "<script>"; 
echo "var username_photo = new Array();";
echo "</script>"; 
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "username_photo['".$row[1]."'] = '".$row[5]."';";
	echo "</script>"; 
}


echo "<script>"; 
echo "helpUsername = new Array();";
echo "helpTitle = new Array();";
echo "helpDate = new Array();";
echo "helpBookmark = new Array();";
echo "helpBookmark_lan = new Array();";
echo "helpTime = new Array();";
echo "helpPosition = new Array();";
echo "helpMood = new Array();";
echo "helpText = new Array();";
echo "helpImg = new Array();";
echo "</script>";

$sql = "SELECT DISTINCT username,helpTitle,helpDate,helpBookmark,helpTime,helpPosition,helpMood,helpText FROM help_article";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$str_array = array();
	$str_Time = "";
	$str_array = explode(",",$row[4]);
	for ($i=0; $i<4; $i++){
		if ( isset($str_array[$i]) && $i!=0){
			$str_Time = $str_Time.'/'.$lang->line($str_array[$i]);
		}
		if ( isset($str_array[$i]) && $i==0){
			$str_Time = $str_Time.$lang->line($str_array[$i]);
		}
	}
	echo "<script>"; 
	echo "for(var d=0;d<=99999;d++){";
	echo "	if(helpUsername[d]==undefined && helpTitle[d]==undefined){";
	echo "		helpUsername[d] = '".$row[0]."';";
	echo "		helpTitle[d] = '".$row[1]."';";
	echo "		helpDate[d] = '".$row[2]."';";
	echo "		helpBookmark[d] = '".$row[3]."';";
	//echo "		helpBookmark_lan[d] = '".$lang->line($row[2])."';";
	echo "		helpTime[d] = '".$str_Time."';";
	echo "		helpPosition[d] = '".$row[5]."';";
	echo "		helpMood[d] = '".$row[6]."';";
	echo "		helpText[d] = '".$row[7]."';";
	echo "		helpImg['".$row[0].$row[1]."'] = new Array();";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}

$sql = "SELECT username,helpTitle,helpImg FROM help_article";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "for(var d=0;d<=99999;d++){";
	echo "	if(helpImg['".$row[0].$row[1]."'][d]==undefined){";
	echo "		helpImg['".$row[0].$row[1]."'][d] = '".$row[2]."';";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}
/*$sql = "SELECT * FROM helpstoryphoto";
$result = mysql_query($sql);
echo "<script>"; 
echo "help_title_photo = new Array();";
echo "</script>"; 
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "help_title_photo['".$row[2]."'] = new Array();";
	echo "</script>"; 
}
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "for(var c=0;c<=9999;c++){";
	echo "	if(help_title_photo['".$row[2]."'][c]==null){";
	echo "		help_title_photo['".$row[2]."'][c] = '".$row[3]."';";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}

$sql = "SELECT * FROM helpstory ORDER BY id DESC";
$result = mysql_query($sql);
echo "<script>"; 
echo "help_username = new Array();";
echo "help_index_photo = new Array();";
echo "help_title = new Array();";
echo "help_text = new Array();";
echo "help_date = new Array();";

echo "var c=0;";
echo "var help_title_indexPhoto = new Array();";
echo "var help_indexPhoto = new Array();";
echo "</script>"; 
$c = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	if (isset($row[0])){
		echo "<script>"; 
		echo "help_username[".$c."] = '".$row[1]."';";
		echo "help_title[".$c."] = '".$row[2]."';";
		echo "help_text[".$c."] = '".$row[3]."';";
		echo "help_date[".$c."] = '".$row[4]."';";	
		echo "help_title['".$row[2]."'] = '".$row[2]."';";
		echo "help_text['".$row[2]."'] = '".$row[3]."';";
		echo "help_date['".$row[2]."'] = '".$row[4]."';";
		echo "help_index_photo['".$row[2]."'] = '".$row[5]."';";

		echo "help_title_indexPhoto[".$c."] = '".$row[2]."';";
		echo "help_indexPhoto[".$c++."] = '".$row[5]."';";
		echo "c = ".$c.";";
		echo "</script>"; 
    }	
}
*/
$sql = "SELECT * FROM donateeventphoto";
$result = mysql_query($sql);
echo "<script>"; 
echo "donate_title_photo = new Array();";
echo "</script>"; 
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "donate_title_photo['".$row[2]."'] = new Array();";
	echo "</script>"; 
}
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "for(var d=0;d<=9999;d++){";
	echo "	if(donate_title_photo['".$row[2]."'][d]==null){";
	echo "		donate_title_photo['".$row[2]."'][d] = '".$row[4]."';";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}

$sql = "SELECT * FROM donateevent ORDER BY id DESC";
$result = mysql_query($sql);
echo "<script>"; 
echo "donate_username = new Array();";
echo "donate_title = new Array();";
echo "donate_date = new Array();";
echo "donate_item = new Array();";
echo "donate_address = new Array();";
echo "donate_cellphone = new Array();";
echo "donate_telephone = new Array();";
echo "donate_detail = new Array();";

echo "var d=0;";
echo "</script>"; 
$d = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	if (isset($row[0])){
    	echo "<script>"; 
		echo "donate_username[".$d."] = '".$row[1]."';";
		echo "donate_title[".$d."] = '".$row[2]."';";
		echo "donate_date[".$d."] = '".$row[3]."';";
		echo "donate_item[".$d."] = '".$row[4]."';";	
		echo "donate_address[".$d."] = '".$row[5]."';";
		echo "donate_cellphone[".$d."] = '".$row[6]."';";
		echo "donate_telephone[".$d."] = '".$row[7]."';";
		echo "donate_detail[".$d++."] = '".$row[8]."';";

		echo "donate_title['".$row[2]."'] = '".$row[2]."';";
		echo "d = ".$d.";";
		echo "</script>"; 
    }
}


?>
<head>
	<script type="text/javascript" src="javascripts/jquery.twzipcode.js"></script>
	<link rel="stylesheet" type="text/css" href="stylesheets/help-waterfall.css">
	<script type="text/javascript" src="javascripts/help-waterfall.js"></script>
	<script type="text/javascript" src="javascripts/cookies.js"></script>

</head>
<div class="modal fade" id="myModal-map" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="dialog-mapContent">
			<div class="modal-header" id="dialog-mapHeader">
				<div class="fa fa-road"><h1>&nbsp路線規劃</h1></div>
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>		        
		    </div>
		    <div class="modal-body" id="dialog-mapBody" >
		    	

					<div class="route-planning-input">
					<div>
						<img src="images/mapPin-Green.png">
						<span>
							<input id="start-address" type="text" class="form-control" placeholder="請輸入起始位置">
						</span>
					</div>
					<div>
						<img src="images/mapPin-Blue.ico">
						<span>
							<input id="end-address" type="text" class="form-control" placeholder="請輸入終點位置">
						</span>
					</div>
					</div>
		    </div>
		    <div class="modal-footer" id="dialog-mapFooter">
		   		<div class="start-routePlanning"><h1>開始規劃</h1></div>
		    	<div class="travelmode">
		    		<i class="fa fa-car active"></i>
					<i class="fa fa-male"></i>
		    	</div>	    	
		    </div>
		</div>
	</div>
</div>

<div class="help-container">

	<div class="googleMap-body">
		<div class="googleMap-outer"></div>
		<div class="googleMap-container">
			<div class="googleMap" id="googleMap" style="width:640px; height:480px;"></div>
		</div>
	</div>

	<div id="waterfall-container" class="container">
	
		<div class="change-page">
			<span>
				<i class="glyphicon glyphicon-book"></i>
				<i class="glyphicon glyphicon-heart" id="waterfall-glyphicon-book"></i>
			</span>
			<span class="glyphicon glyphicon-heart" id="waterfall-glyphicon-heart"></span>
			<span class="fa fa-plus" data-toggle="modal" data-target="#myModal-donate"></span>
		</div>
		<div class="waterfall-columns">
			<!--<div class="waterfall-div"><img data-toggle="modal" data-target="#myModal-helpinfo" title="hi" src="images/台灣.jpg"><div class="waterfall-div-info"><img name="99" title="22" src="images/日本.jpg"><h1>我是標題</h1></div></div>-->
		</div>

		<div class="donate-columns">
			<div id="carousel-example-generic-headgallery" class="carousel slide donate-columns-header" data-ride="carousel">
		      	<ol class="carousel-indicators">
		        	<li data-target="#carousel-example-generic-headgallery" data-slide-to="0" class="active"></li>
		        	<li data-target="#carousel-example-generic-headgallery" data-slide-to="1" class=""></li>
		        	<li data-target="#carousel-example-generic-headgallery" data-slide-to="2" class=""></li>
		      	</ol>
		      	<div class="carousel-inner" role="listbox" id="carousel-inner-donate">
		        	<div class="item active">
		          		<img src="advertisement-images/Show_Image1.jpg">
		        	</div>
		        	<div class="item">
		         		<img src="advertisement-images/Show_Image2.jpg">
		        	</div>
		        	<div class="item">
		          		<img src="advertisement-images/Show_Image3.jpg">
		        	</div>
		      	</div>
		      	<a class="left carousel-control" href="#carousel-example-generic-headgallery" role="button" data-slide="prev">
		        	<span class="glyphicon glyphicon-chevron-left"></span>
		        	<span class="sr-only">Previous</span>
		      	</a>
		      	<a class="right carousel-control" href="#carousel-example-generic-headgallery" role="button" data-slide="next">
		        	<span class="glyphicon glyphicon-chevron-right"></span>
		        	<span class="sr-only">Next</span>
		      	</a>
		    </div>

			<div class="donate-columns-content">
				<ul class="nav nav-tabs" role="tablist" id="donate-choice-bar">
				  	<li class="donate active">
				  		<a href="#"><i class="fa fa-gift"></i>&nbsp<?php echo $lang->line("donate");?>&nbsp</a>
				  	</li>
				  	<li class="change">
				  		<a href="#"><i class="fa fa-exchange"></i>&nbsp<?php echo $lang->line("change");?>&nbsp</a>
				  	</li>
				</ul>
				<div class="donate-columns-content-choice">
					<div id="twzipcode">
						<div id="county" data-role="county" data-style="county" data-value="台灣"></div> 
						<div id="district" data-role="district" data-style="district" data-value="鄉鎮市區"></div> 
						<div data-role="zipcode" data-style="zipcode"></div> 
						<div class="fa fa-map-marker twzipcode-location"><h1>&nbsp<?php echo $lang->line("location search");?></h1></div>
						<div data-toggle="modal" data-target="#myModal-map" class="fa fa-road twzipcode-road"><h1>&nbsp<?php echo $lang->line("route planning");?></h1></div>
					</div>	
				</div>
				<div class="donate-columns-content-container">

					<!--<div class="donate-columns-content-div">
						<div class="addLocation data-toggle="close" glyphicon glyphicon-map-marker"><div class="fa fa-plus"></div></div>						
						<img data-toggle="modal" title="1222" data-target="#myModal-donateinfo" src="upload/123/30.jpg">
						<div class="donate-columns-content-div-info">
							<img src="images/camera.jpg">
							<div class="fa fa-list-ul"></div>
							<h1>破舊衣物破</h1>
							
						</div>
						<div class="donate-columns-content-info-container" name="close-info">
							<div class="info-container-triangle"></div>
							<div class="info-container-top"><i class="fa fa-info-circle"></i>&nbsp物品資訊</div>
							<div class="info-container-text">
								<div class="info-container-text-container"><span class="glyphicon glyphicon glyphicon-gift"></span><div>我是物品名稱唷唷</div></div>
								<div class="info-container-text-container"><span class="fa fa-map-marker"></span><div>我是地址.......名稱唷唷</div></div>
								<div class="info-container-text-container"><span class="glyphicon glyphicon-phone-alt"></span><div>我是手機號碼唷!!!~~~~我是手機號碼唷!!!我是手機號碼唷!!!</div></div>
								<div class="info-container-text-container"><span class="fa fa-pencil-square-o"></span><div>我是詳細資料捏捏捏捏</div></div>
								<div class="info-container-time">2014/09/08</div>
							</div>
						</div>
					</div>-->

				</div>
			</div>
		</div>
	</div>
</div>

