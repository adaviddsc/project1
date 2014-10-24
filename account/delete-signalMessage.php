<?php session_start();
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
$deleteMessage = $_COOKIE['deleteMessage'];
if( $username!=null && $deleteMessage!=null ){
	$sql = "UPDATE chat SET messagesignal = 0  WHERE  username = '$deleteMessage' AND messagesignal = 1";
	mysql_query($sql);
}

?>