<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("connect.php");
include("../language.php");
if ( isset( $_COOKIE['language'] ) ){
        $language = $_COOKIE['language'];
}
else{
        $language = "zh-tw";
}

$lang = new Language();
$lang->load($language);

$username = $_SESSION['username'];
$title = $_POST['title'];
$date = $_POST['date'];
$commentMessage = $_POST['commentMessage'];
$commentMessage = str_replace(" ","&nbsp",$commentMessage);
$commentMessage = str_replace("\n","",$commentMessage);
$commentMessage = preg_replace("/\s/","<br>",$commentMessage);

if( $username!=null && $commentMessage!=null ){
	$sql = "INSERT INTO houseprovidecomment (username, houseTitle, houseDate ,houseComment) VALUES ('".$username."', '".$title."', '".$date."', '".$commentMessage."')";
	mysql_query($sql);
}
?>