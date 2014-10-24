<?php
session_start();
include("connect.php");
$username = $_SESSION['username'];
$receiveUser = $_GET['receiveUser'];
$signal = $_GET['signal'];
if( $username!=null && $receiveUser!=null && $signal!=null ){
	$sql = "SELECT * FROM friends WHERE username = '$username' AND friends = '$receiveUser' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	if ( !isset($row[0]) ){
		if ( $signal=="not-friend"){
			$sql = "INSERT INTO addfriend (sendUser, receiveUser, time, ip) VALUES ('".$username."', '".$receiveUser."', '".time()."', '".$_SERVER["REMOTE_ADDR"]."')";
			mysql_query($sql);
		}
		if ( $signal=="send-friend"){
			$sql = "DELETE FROM addfriend WHERE sendUser = '$username' AND receiveUser = '$receiveUser'";
			mysql_query($sql);
		}
	}
}
?>