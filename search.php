<!DOCTYPE HTML>
test_add
<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("account/connect.php");
include("language.php");
$username = $_SESSION['username'];
if ( isset( $_COOKIE['language'] ) ){
        $language = $_COOKIE['language'];
}
else{
        $language = "zh-tw";
}


?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script type="text/javascript" src="javascripts/search.js"></script>
		
		
		<!--external-->
		<link rel="stylesheet" href="external/bootstrap-theme.min.css">
		<link rel="stylesheet" href="external/bootstrap.min.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<!--external-->	
		
	</head>
	<body>
	</body>
	<!--external-->
	<script src="external/bootstrap.min.js"></script>

	<!--external-->
</html>