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
if( $username!=null ){
	$sql = "SELECT * FROM friends WHERE username = '$username' ORDER BY id DESC";
  	$result = mysql_query($sql);
	while( $row = mysql_fetch_array($result, MYSQL_NUM) ){
		echo $row[2];
	}
}
?>