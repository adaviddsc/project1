<!DOCTYPE HTML>
<?php
session_start();
include("account/connect.php");
include("language.php");
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

$sql = "SELECT * FROM houseprovidephoto";
$result = mysql_query($sql);
echo "<script>"; 
echo "houseprovide_title_photo = new Array();";
echo "</script>"; 
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "houseprovide_title_photo['".$row[2]."'] = new Array();";
	echo "</script>"; 
}
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "for(var d=0;d<=9999;d++){";
	echo "	if(houseprovide_title_photo['".$row[2]."'][d]==null){";
	echo "		houseprovide_title_photo['".$row[2]."'][d] = '".$row[4]."';";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}

$sql = "SELECT * FROM houseprovide ORDER BY id DESC";
$result = mysql_query($sql);
echo "<script>"; 
echo "houseprovide_username = new Array();";
echo "houseprovide_title = new Array();";
echo "houseprovide_date = new Array();";
echo "houseprovide_country = new Array();";
echo "houseprovide_address = new Array();";
echo "houseprovide_cellphone = new Array();";
echo "houseprovide_telephone = new Array();";
echo "houseprovide_persons = new Array();";
echo "houseprovide_help = new Array();";
echo "houseprovide_detail = new Array();";

echo "var d=0;";
echo "</script>"; 
$d = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	if (isset($row[0])){
    	echo "<script>"; 
		echo "houseprovide_username[".$d."] = '".$row[1]."';";
		echo "houseprovide_title[".$d."] = '".$row[2]."';";
		echo "houseprovide_date[".$d."] = '".$row[3]."';";
		echo "houseprovide_country[".$d."] = '".$row[4]."';";	
		echo "houseprovide_address[".$d."] = '".$row[5]."';";
		echo "houseprovide_cellphone[".$d."] = '".$row[6]."';";
		echo "houseprovide_telephone[".$d."] = '".$row[7]."';";
		echo "houseprovide_persons[".$d."] = ".$row[8].";";
		echo "houseprovide_help[".$d."] = '".$row[9]."';";
		echo "houseprovide_detail[".$d++."] = '".$row[10]."';";

		echo "houseprovide_title['".$row[2]."'] = '".$row[2]."';";
		echo "d = ".$d.";";
		echo "</script>"; 
    }
}

$sql = "SELECT * FROM houseprovidecomment";
$result = mysql_query($sql);
echo "<script>"; 
echo "housecomment_username = new Array();";
echo "housecomment_comment = new Array();";
echo "</script>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "housecomment_username['".$row[2].$row[3]."'] = new Array();";
	echo "housecomment_comment['".$row[2].$row[3]."'] = new Array();";
	echo "</script>"; 
}
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "for(var d=0;d<=99999;d++){";
	echo "	if(housecomment_username['".$row[2].$row[3]."'][d]==null && housecomment_comment['".$row[2].$row[3]."'][d]==null){";
	echo "		housecomment_username['".$row[2].$row[3]."'][d] = '".$row[1]."';";
	echo "		housecomment_comment['".$row[2].$row[3]."'][d] = '".$row[4]."';";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}



$sql = "SELECT DISTINCT commentsUser FROM comments";
$result = mysql_query($sql);
echo "<script>"; 
echo "comments_username = new Array();";
echo "comments_commentsUser = new Array();";
echo "comments_commentsTitle = new Array();";
echo "comments_commentsDate = new Array();";
echo "comments_commentsContent = new Array();";
echo "comments_commentsStarts = new Array();";
echo "comments_commentsImg = new Array();";
echo "commentsCounts = new Array();";
echo "</script>";
$e = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "comments_commentsUser[".$e++."] = '".$row[0]."';";

	echo "comments_username['".$row[0]."'] = new Array();";
	echo "comments_commentsTitle['".$row[0]."'] = new Array();";
	echo "comments_commentsDate['".$row[0]."'] = new Array();";
	echo "comments_commentsContent['".$row[0]."'] = new Array();";
	echo "comments_commentsStarts['".$row[0]."'] = new Array();";
	echo "</script>"; 
}

$sql = "SELECT DISTINCT username,commentsUser,commentsTitle,commentsDate,commentsContent,commentsStarts FROM comments";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "for(var d=0;d<=99999;d++){";
	echo "	if(comments_commentsTitle['".$row[1]."'][d]==undefined){";
	echo "		comments_username['".$row[1]."'][d] = '".$row[0]."';";
	echo "		comments_commentsTitle['".$row[1]."'][d] = '".$row[2]."';";
	echo "		comments_commentsDate['".$row[1]."'][d] = '".$row[3]."';";
	echo "		comments_commentsContent['".$row[1]."'][d] = '".$row[4]."';";
	echo "		comments_commentsStarts['".$row[1]."'][d] = '".$row[5]."';";
	echo "		commentsCounts['".$row[1]."'] = d+1;";
	echo "		comments_commentsImg['".$row[0].$row[1].$row[2].$row[3].$row[4].$row[5]."'] = new Array();";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}

$sql = "SELECT * FROM comments";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "for(var d=0;d<=99999;d++){";
	echo "	if(comments_commentsImg['".$row[1].$row[2].$row[3].$row[4].$row[5].$row[7]."'][d]==undefined){";
	echo "		comments_commentsImg['".$row[1].$row[2].$row[3].$row[4].$row[5].$row[7]."'][d] = '".$row[6]."';";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}

echo "<script>"; 
echo "travelUsername = new Array();";
echo "travelTitle = new Array();";
echo "travelDate = new Array();";
echo "travelBookmark = new Array();";
echo "travelBookmark_lan = new Array();";
echo "travelTime = new Array();";
echo "travelPosition = new Array();";
echo "travelMood = new Array();";
echo "travelText = new Array();";
echo "travelImg = new Array();";
echo "</script>";

$sql = "SELECT DISTINCT username,travelTitle,travelDate,travelBookmark,travelTime,travelPosition,travelMood,travelText FROM travel_article";
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
	echo "	if(travelUsername[d]==undefined && travelTitle[d]==undefined){";
	echo "		travelUsername[d] = '".$row[0]."';";
	echo "		travelTitle[d] = '".$row[1]."';";
	echo "		travelDate[d] = '".$row[2]."';";
	echo "		travelBookmark[d] = '".$row[3]."';";
	//echo "		helpBookmark_lan[d] = '".$lang->line($row[2])."';";
	echo "		travelTime[d] = '".$str_Time."';";
	echo "		travelPosition[d] = '".$row[5]."';";
	echo "		travelMood[d] = '".$row[6]."';";
	echo "		travelText[d] = '".$row[7]."';";
	echo "		travelImg['".$row[0].$row[1]."'] = new Array();";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}

$sql = "SELECT username,travelTitle,travelImg FROM travel_article";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo "<script>"; 
	echo "for(var d=0;d<=99999;d++){";
	echo "	if(travelImg['".$row[0].$row[1]."'][d]==undefined){";
	echo "		travelImg['".$row[0].$row[1]."'][d] = '".$row[2]."';";
	echo "		break;";
	echo "	}";
	echo "}";
	echo "</script>"; 
}
?>
<html>
	<head>
		<meta charset="utf-8">		
		<meta name="viewport" content="width=device-width initial-scale=1.0" />
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAO84sQWjSC19_vifH_aynYtbgYzbws4M8&sensor=FALSE&language=zh-tw"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>	
		<script type="text/javascript" src="javascripts/travel.js"></script>	
		<link rel="stylesheet" type="text/css" href="stylesheets/travel.css">
		
		<!--external-->
		<link rel="stylesheet" href="external/bootstrap-theme.min.css">
		<link rel="stylesheet" href="external/bootstrap.min.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
		<script src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
		<!--external-->
	</head>
	<body style="overflow-x: hidden">
		<div class="travel-container">
			<div class="travelPage-nav">
				<div id="link-travel-waterfall">
					<i class="fa fa-plane"></i>
					<i class="glyphicon glyphicon-book"></i>
				</div>
				<div class="fa fa-home" id="link-travel-home"></div>
				<div class="fa fa-paper-plane" id="link-travel-traveler"></div>
			</div>
		</div>
	</body>
	<!--external-->
	<script src="external/bootstrap.min.js"></script>
	<!--external-->
</html>