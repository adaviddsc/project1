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
echo "<script>"; 
echo "var Change_Story_Photo = '".$lang->line("change story photo")."';";
echo "</script>"; 

if ( isset( $_SESSION['username'] ) ){
	$idSelf = $_SESSION['username'];
	echo "<script>"; 
	echo "selfTitle = new Array();";
	echo "selfDate = new Array();";
	echo "selfBookmark = new Array();";
	echo "selfTime = new Array();";
	echo "selfPosition = new Array();";
	echo "selfMood = new Array();";
	echo "selfText = new Array();";
	echo "selfImg = new Array();";
	echo "</script>";

	$sql = "SELECT DISTINCT selfTitle,selfDate,selfBookmark,selfTime,selfPosition,selfMood,selfText FROM selfarticle WHERE username = '$idSelf'";
	$result = mysql_query($sql);

	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$str_array = array();
		$str_Time = "";
		$str_array = explode(",",$row[3]);
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
		echo "	if(selfTitle[d]==undefined){";
		echo "		selfTitle[d] = '".$row[0]."';";
		echo "		selfDate[d] = '".$row[1]."';";
		echo "		selfBookmark[d] = '".$row[2]."';";
		echo "		selfTime[d] = '".$str_Time."';";
		echo "		selfPosition[d] = '".$row[4]."';";
		echo "		selfMood[d] = '".$row[5]."';";
		echo "		selfText[d] = '".$row[6]."';";
		echo "		selfImg['".$row[0]."'] = new Array();";
		echo "		break;";
		echo "	}";
		echo "}";
		echo "</script>"; 
	}

	$sql = "SELECT selfTitle,selfImg FROM selfarticle WHERE username = '$idSelf'";
	$result = mysql_query($sql);

	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		echo "<script>"; 
		echo "for(var d=0;d<=99999;d++){";
		echo "	if(selfImg['".$row[0]."'][d]==undefined){";
		echo "		selfImg['".$row[0]."'][d] = '".$row[1]."';";
		echo "		break;";
		echo "	}";
		echo "}";
		echo "</script>"; 
	}


	echo "<script>"; 
	echo "travelTitle = new Array();";
	echo "travelDate = new Array();";
	echo "travelBookmark = new Array();";
	echo "travelTime = new Array();";
	echo "travelPosition = new Array();";
	echo "travelMood = new Array();";
	echo "travelText = new Array();";
	echo "travelImg = new Array();";
	echo "</script>";

	$sql = "SELECT DISTINCT travelTitle,travelDate,travelBookmark,travelTime,travelPosition,travelMood,travelText FROM travel_article WHERE username = '$idSelf'";
	$result = mysql_query($sql);

	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$str_array = array();
		$str_Time = "";
		$str_array = explode(",",$row[3]);
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
		echo "	if(travelTitle[d]==undefined){";
		echo "		travelTitle[d] = '".$row[0]."';";
		echo "		travelDate[d] = '".$row[1]."';";
		echo "		travelBookmark[d] = '".$row[2]."';";
		echo "		travelTime[d] = '".$str_Time."';";
		echo "		travelPosition[d] = '".$row[4]."';";
		echo "		travelMood[d] = '".$row[5]."';";
		echo "		travelText[d] = '".$row[6]."';";
		echo "		travelImg['".$row[0]."'] = new Array();";
		echo "		break;";
		echo "	}";
		echo "}";
		echo "</script>"; 
	}

	$sql = "SELECT travelTitle,travelImg FROM travel_article WHERE username = '$idSelf'";
	$result = mysql_query($sql);

	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		echo "<script>"; 
		echo "for(var d=0;d<=99999;d++){";
		echo "	if(travelImg['".$row[0]."'][d]==undefined){";
		echo "		travelImg['".$row[0]."'][d] = '".$row[1]."';";
		echo "		break;";
		echo "	}";
		echo "}";
		echo "</script>"; 
	}
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
?>
<html>
	<head>
		<meta charset="utf-8">		
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>	
		<script type="text/javascript" src="javascripts/cookies.js"></script>
		<script type="text/javascript">
			delCookie('profileID');
		</script>
		<script type="text/javascript" src="javascripts/self.js"></script>	

		<!--external-->
		<link rel="stylesheet" href="external/bootstrap-theme.min.css">
		<link rel="stylesheet" href="external/bootstrap.min.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
		<script src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
		<!--external-->
	</head>
	<body>

	</body>
	<!--external-->
	<script src="external/bootstrap.min.js"></script>
	<!--external-->
</html>