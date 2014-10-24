<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("../account/connect.php");
include("../language.php");
$username = $_SESSION['username'];
echo "<script>"; 
echo "session = '".$username."';";
echo "</script>";
if ( isset( $_COOKIE['language'] ) ){
        $language = $_COOKIE['language'];
}
else{
        $language = "zh-tw";
}
$lang = new Language();
$lang->load($language);

if ( isset( $_COOKIE['searchBy'] ) ){
	$searchBy = $_COOKIE['searchBy'];
}

if ( isset( $_COOKIE['search'] ) ){
	$search = $_COOKIE['search'];
}


if ( isset( $search ) && isset( $searchBy ) ){
	$sql = "SELECT * FROM account where user like '%$search%'";
	$result = mysql_query($sql);
	$c=0;
	echo "<script>"; 
	echo "searchUsername = new Array();";
	echo "searchPhoto = new Array();";
	echo "searchUser = new Array();";
	echo "</script>";
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    	$temp = $row[1];
    	echo "<script>"; 
    	echo "searchUsername[".$c."] = '".$row[1]."';";
		echo "searchPhoto[".$c."] = '".$row[5]."';";
		echo "searchUser[".$c."] = '".$row[7]."';";
		echo "</script>"; 
    	$c++;
    	echo "<script>"; 
    	echo "c = ".$c.";";
		echo "</script>"; 
	}

	if ( $searchBy=="user" ){
		$sql = "SELECT * FROM information where user like '%$search%'";
		$result = mysql_query($sql);
		echo "<script>"; 
		echo "searchBirth = new Array();";
		echo "searchSex = new Array();";
		echo "searchEmail = new Array();";
		echo "</script>";
	    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	    	echo "<script>"; 
	    	echo "searchBirth['".$row[1]."'] = '".$row[2]."';";
			echo "searchSex['".$row[1]."'] = '".$lang->line($row[3])."';";
			echo "searchEmail['".$row[1]."'] = '".$row[4]."';";
			echo "</script>"; 
		}
	}
	if ( $searchBy=="donate" ){
	}
}

?>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheets/search-result.css">	
	<script type="text/javascript" src="javascripts/search-result.js"></script>
	<script type="text/javascript" src="javascripts/cookies.js"></script>
</head>
<div class="search-result-container">
	<div class="search-result-header">
		<i class="fa fa-user"></i>&nbsp<?php echo $lang->line("search result");?>
	</div>
	<!--<div class="search-result odd">
		<div class="search-result-photo">
			<img src="">
		</div>
		<div class="search-result-info">
			<div class="search-result-info-div">
				<img src="images/id.png">
				<h1><?php echo $temp;?></h1>
			</div>
			<div class="search-result-info-div">
				<i class="fa fa-envelope-o"></i>
				<h1></h1>
			</div>
			<div class="search-result-info-div">
				<img src="images/birthday.png">
				<h1></h1>
			</div>
			<div class="search-result-info-div">
				<i class="fa fa-male sex"></i>
				<i class="fa fa-female sex"></i>
				<h1></h1>
			</div>
		</div>
	</div>
	<div class="dashed"></div>-->
	<!--<div class="search-result even"></div>
	<div class="dashed"></div>-->
</div>
