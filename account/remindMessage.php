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
	$sql = "SELECT DISTINCT username AS name FROM chat WHERE receiver = '$username' AND remindmessage = 1 ";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	    echo $row[0];
	}

	$sql1 = "UPDATE chat SET remindmessage = 0  WHERE  receiver = '$username' AND remindmessage = 1";
	mysql_query($sql1);


}

?>