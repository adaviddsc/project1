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
	<link rel="stylesheet" type="text/css" href="stylesheets/index-login_register-dialog.css">
	<script type="text/javascript" src="javascripts/index-login_register-dialog.js"></script>
</head>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
		       	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <div id="h1-Login" class="h1-login-register"><h1><?php echo $lang->line("login");?></h1></div>
		        <div id="h1-Register" class="h1-login-register"><h1><?php echo $lang->line("register");?></h1></div>
		    </div>
		    <div class="modal-body">	
		      	<div class="dialog-form">	      	
			        <form id="register-form" method="post" action="account/register.php">
						<input class="dialog-input" type="text" name="username" placeholder="<?php echo $lang->line("username");?>"> <br>
						<input class="dialog-input" type="password" name="password" placeholder="<?php echo $lang->line("password");?>"> <br>
						<input class="dialog-input" type="text" name="phone" placeholder="<?php echo $lang->line("phone");?>"> <br>
						<input class="dialog-input" type="text" name="address" placeholder="<?php echo $lang->line("address");?>"> <br>
						<input class="dialog-button myButton" type="submit" name="button" value="<?php echo $lang->line("register");?>">
						<input id="register-back" class="dialog-button myButton" type="button" name="button" value="<?php echo $lang->line("back");?>">
						<div class="dialog-alert" id="alert-R"><h2></h2></div>
					</form>	 
					<form id="login-form" method="post" action="account/sigin.php">
						<input class="dialog-input" type="text" name="username" placeholder="<?php echo $lang->line("username");?>"> <br>
						<input class="dialog-input" type="password" name="password" placeholder="<?php echo $lang->line("password");?>"> <br>
						<input class="dialog-button myButton" type="submit" name="button" value="<?php echo $lang->line("login");?>">
						<input id="login-back" class="dialog-button myButton" type="button" name="button" value="<?php echo $lang->line("register");?>">
						<div class="dialog-alert" id="alert-L"><h2></h2></div>
					</form>	
				</div>	
		      </div>
		    <div class="modal-footer myButtonFB-footer">
		      	<input class="myButtonFB" name="fb" type="button" value="facebook">
		    </div>
		</div>
	</div>
</div>