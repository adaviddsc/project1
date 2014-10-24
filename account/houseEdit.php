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

$id = $_POST['id'];
$comment = $_POST['comment'];
$comment = str_replace(" ","&nbsp",$comment);
$comment = str_replace("\n","",$comment);
$comment = preg_replace("/\s/","<br>",$comment);
$action = $_POST['action'];


if( $id!=null && $comment!=null && $action!=null ){
	if ( $comment=='cancel' && $action=='cancel' ){
		$sql = "DELETE FROM houseprovidecomment WHERE id = '$id'";
		mysql_query($sql);
	}
	else if ( $action=='edit' ){
		$sql = "UPDATE houseprovidecomment SET houseComment = '$comment'  WHERE id = '$id'";
		mysql_query($sql);
	}
}
?>