<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("connect.php");
$username = $_SESSION['username'];
$other = $_GET['other'];
$_GET['delete'];
if( $username!=null && $other!=null && !isset($_GET['delete']) ){
	$sql = "INSERT INTO friends (username, friends) VALUES ('".$username."', '".$other."')";
	mysql_query($sql);
	$sql = "INSERT INTO friends (username, friends) VALUES ('".$other."', '".$username."')";
	mysql_query($sql);

	$sql = "DELETE FROM addfriend WHERE sendUser = '$username' AND receiveUser = '$other'";
	mysql_query($sql);
	$sql = "DELETE FROM addfriend WHERE sendUser = '$other' AND receiveUser = '$username'";
	mysql_query($sql);
}
if (isset($_GET['delete'])){
	$sql = "DELETE FROM addfriend WHERE sendUser = '$username' AND receiveUser = '$other'";
	mysql_query($sql);
	$sql = "DELETE FROM addfriend WHERE sendUser = '$other' AND receiveUser = '$username'";
	mysql_query($sql);
}

?>