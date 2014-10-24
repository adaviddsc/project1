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
	<link rel="stylesheet" type="text/css" href="stylesheets/top-frame-home.css">
	<script type="text/javascript" src="javascripts/top-frame-home.js"></script>
</head>
<div class="home-header">
	<div class="TL-logo-div">
		<img id="TL-logo" src="images/TL.png">
	</div>
	<div class="search-bar">
		<input class="form-control" type="text" placeholder="<?php echo $lang->line("search choice first");?>" disabled>
		<span class="glyphicon glyphicon-search"></span>
		<div class="dropdown">
	        <div id="drop4-search" role="button" data-toggle="dropdown"><i class="fa fa-check-square"></i> <?php echo $lang->line("search dropdown");?> <span class="caret"></span></div>
	        <ul id="menu1-search" class="dropdown-menu" role="menu" aria-labelledby="drop4">
	          	<li class="dropdown-li" role="presentation" title="user">
	          		&nbsp<i class="fa fa-user"></i>&nbsp<?php echo $lang->line("find user");?>
	          	</li>
	          	<li class="dropdown-li" role="presentation" title="donate">
	          		&nbsp<i class="fa fa-gift"></i>&nbsp<?php echo $lang->line("find donate story");?>
	          	</li>
	        </ul>
	     </div>
	     <div class="dropdown-icon-display">
	     	<i class="fa fa-user"></i>
	     </div>
	</div>
	<a id="drop4" role="button" data-toggle="dropdown" href="#">
		<button type="button" class="glyphicon glyphicon-align-justify"></button>
	</a>
	<ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop">
		<li role="presentation travel-logo">
		    <div class="function-logo fa fa-plane"></div>
		    <h1><?php echo $lang->line("travel");?></h1>
		</li>
		<li class="help-logo">
		    <div class="function-logo fa fa-heart"></div>
		    <h1 name="Help"><?php echo $lang->line("help");?></h1>
		</li>
		<li data-toggle="modal" data-target="#myModal-email" class="mail-logo">
		    <div class="function-logo fa fa-envelope"></div>
		    <h1 name="Email"><?php echo $lang->line("email");?></h1>
		</li>
		<li class="self-logo">
		    <div class="function-logo fa fa-user"></div>
		    <h1 name="Email"><?php echo $lang->line("personal");?></h1>
		</li>
		<li role="presentation" class="door-logo">
		    <div class="function-logo fa fa-sign-out"></div>
		    <h1><?php echo $lang->line("logout");?></h1>
		</li>
	</ul>
	<div class="function-logo-div">
		<div class="function-logo fa fa-sign-out door-logo"></div>
		<div class="function-logo fa fa-user self-logo"></div>
		<div class="function-logo fa fa-envelope mail-logo" data-toggle="modal" data-target="#myModal-email"></div>
		<div class="function-logo fa fa-heart help-logo"></div>
		<div class="function-logo fa fa-plane travel-logo"></div>
	</div>	
</div>

<div class="messageCircle-container">
	<div class="messageCircle-icon fa fa-users" id="chatting-users" name="close-chatting"></div>
	<div class="messageCircle-photo-container">
		<!--<div class="messageCircle-photo-people">
			<img src="upload/123/test.jpg">
			<div class="fa fa-comment-o chat-photo-fa" data-toggle="modal" data-target="#myModal-email"></div>
			<div class="fa fa-times messageCircle-fa-times"></div>
		</div>-->
	</div>	
</div>
