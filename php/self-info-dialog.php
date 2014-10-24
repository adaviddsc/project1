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

if ( isset( $_COOKIE['profileID'] ) || isset( $_SESSION['username'] ) ){
	if ( isset( $_COOKIE['profileID'] ) && $_COOKIE['profileID']!=$_SESSION['username'] ){
		echo "<script>"; 
		echo "var cookie = '".$_COOKIE['profileID']."';";
		echo "</script>"; 
		$profileID = $_COOKIE['profileID'];			
		$sql = "SELECT * FROM information WHERE username = '$profileID'";
	}
	else if ( isset( $_SESSION['username'] ) ){
		echo "<script>"; 
		echo "var cookie = '';";
		echo "</script>"; 
		$idSelf = $_SESSION['username'];
		$sql = "SELECT * FROM information WHERE username = '$idSelf'";
	}

	$result = mysql_query($sql);
	$row = @mysql_fetch_row($result);
	$birthday = "";
	$email = "";
	if(isset($row[2]))
		$birthday = $row[2];
	else if (isset( $_COOKIE['profileID'] )) {
		$birthday = $lang->line("no information");
	}
	else{
		$birthday = "";
	}
	if(isset($row[4])){
		$email = $row[4];
	}
	else if (isset( $_COOKIE['profileID'] )) {
		$email = $lang->line("no information");
	}
	else{
		$email = "";
	}
	echo "<script>"; 
	echo "var sex = '".$row[3]."';";
	echo "</script>"; 
}
?>

<head>
	<link rel="stylesheet" type="text/css" href="stylesheets/self-info-dialog.css">
	<script type="text/javascript" src="javascripts/self-info-dialog.js"></script>
</head>
<div class="modal fade" id="myModal-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <div class="info-h1"><h1><?php echo $lang->line("information");?></h1></div>
		    </div>
		    <div class="modal-body">	
		      	<form id="sex-form" method="post" action="account/information.php">	
		      		<div id="sex-form-container-up">		
						<p><?php echo $lang->line("birthday");?>:</p>
						<input class="dialog-input" type="date" name="birth" value="<?php echo $birthday;?>"><br>
						<p name="email"><?php echo $lang->line("email@");?>:</p>
						<input class="dialog-input" type="text" name="email" placeholder="Email" value="<?php echo $email;?>" ><br>
					</div>
					<div id="sex-form-container-down">
						<input class="dialog-radio" type="radio" name="sex" value="male"/>
						<label id="male" class="sex"><?php echo $lang->line("male");?></label>
						<input class="dialog-radio" type="radio" name="sex" value="female" />
						<label id="female" class="sex"><?php echo $lang->line("female");?></label>
						<br>
						<input class="dialog-button myButton" type="submit" name="button" value="<?php echo $lang->line("edit");?>">
						<input class="dialog-button myButton" type="button" data-dismiss="modal" name="button" value="<?php echo $lang->line("cancel");?>">
						<div id="alert-info">
							<h2></h2>
						</div>
					</div>
				</form>
		    </div>
		</div>
	</div>
</div>
