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
$idSelf = $_SESSION['username'];

if ( isset( $_COOKIE['profileID'] ) ){
	$profileID = $_COOKIE['profileID'];
	$sql = "SELECT * FROM helpstoryphoto WHERE username = '$profileID'";
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

	$sql = "SELECT * FROM helpstory WHERE username = '$profileID' ORDER BY id DESC";
	$result = mysql_query($sql);
	echo "<script>"; 
	echo "help_index_photo = new Array();";
	echo "help_title = new Array();";
	echo "help_text = new Array();";
	echo "help_date = new Array();";
	echo "</script>"; 
	$c = 0;
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		echo "<script>"; 
		echo "help_title[".$c."] = '".$row[2]."';";
		echo "help_text[".$c."] = '".$row[3]."';";
		echo "help_date[".$c."] = '".$row[4]."';";	
		echo "help_title['".$row[2]."'] = '".$row[2]."';";
		echo "help_text['".$row[2]."'] = '".$row[3]."';";
		echo "help_date['".$row[2]."'] = '".$row[4]."';";
		echo "help_index_photo['".$row[2]."'] = '".$row[5]."';";
		echo "</script>"; 
		$c++;
	}

	$sql = "SELECT * FROM information WHERE username = '$profileID'";
	$result = mysql_query($sql);
	$row = @mysql_fetch_row($result);
	if($row[2]!=null)
		$birthday = $row[2];
	else
		$birthday = "No Information";
	if($row[3]!=null)
		$sex = $row[3];
	else
		$sex = "No Information";
	if($row[4]!=null)
		$email = $row[4];
	else
		$email = "No Information";
}

?>
<html>
	<head>
		<meta charset="utf-8">	
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>	
		<script type="text/javascript" src="javascripts/profile.js"></script>			
		
		<!--external-->
		<link rel="stylesheet" href="external/bootstrap-theme.min.css">
		<link rel="stylesheet" href="external/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="external/bookblock.css" />
		<link rel="stylesheet" type="text/css" href="external/demo4.css" />	
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<script src="external/modernizr.custom.js"></script>
		<script src="external/jquerypp.custom.js"></script>
		<script src="external/jquery.bookblock.js"></script>
		<!--external-->
	</head>
	<body style="overflow-x: hidden">
	<h1>fuck</h1>
	</body>
	<!--external-->
	<script src="external/bootstrap.min.js"></script>
	<!--external-->
</html>
