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
	<link rel="stylesheet" type="text/css" href="stylesheets/travel-waterfall.css">
	<script type="text/javascript" src="javascripts/travel-waterfall.js"></script>
</head>

<div class="travelWaterfall-container">
	<div class="waterfall-columns">
		<!--<div class="waterfall-div"><img data-toggle="modal" data-target="#myModal-helpinfo" title="hi" src="images/台灣.jpg"><div class="waterfall-div-info"><img name="99" title="22" src="images/日本.jpg"><h1>我是標題</h1></div></div>-->
	</div>
</div>