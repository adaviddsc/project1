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
	<link rel="stylesheet" type="text/css" href="stylesheets/index-language-dialog.css">
	<script type="text/javascript" src="javascripts/index-language-dialog.js"></script>
</head>
<div class="modal fade" id="myModal-language" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <div class="language-choice"><h1><?php echo $lang->line("language choice");?></h1></div>
		    </div>
		    <div class="modal-body">	
		      	<div name="english" class="language-choice-body myButtonLan"><h1><?php echo $lang->line("english");?></h1></div>
		      	<div name="zh-tw" class="language-choice-body myButtonLan"><h1><?php echo $lang->line("zh-tw");?></h1></div>
		    </div>
		</div>
	</div>
</div>