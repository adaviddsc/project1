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
$chatPeople = $_COOKIE['chatPeople'];
$selfPeoplePhoto = $_COOKIE['selfPeoplePhoto'];
$senderMessage = $_POST['senderMessage'];
$senderMessage = str_replace(" ","&nbsp",$senderMessage);
$senderMessage = str_replace("\n","",$senderMessage);
$senderMessage = preg_replace("/\s/","<br>",$senderMessage);

if( $username!=null && $chatPeople!=null && $senderMessage!=null ){
	$sql = "INSERT INTO chat (username, receiver, message ,refresh ,time ,ip ,messagesignal, remindmessage) VALUES ('".$username."', '".$chatPeople."', '".$senderMessage."',1 , '".time()."', '".$_SERVER["REMOTE_ADDR"]."',1 ,1 )";
	if( mysql_query($sql) ){
		echo '<div class="chatting-district-right"><div class="chatting-photo"><img src="'.$selfPeoplePhoto.'"></div><div class="chatting-info" style="word-break:break-all">'.$senderMessage.'<span class="triangle"></span></div></div>';
	}
}
?>