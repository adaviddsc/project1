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
$chatPeople = $_COOKIE['chatPeople'];
$anotherPeoplePhoto = $_COOKIE['anotherPeoplePhoto'];


if( $username!=null && $chatPeople!=null && $anotherPeoplePhoto!=null ){
	$sql = "SELECT * FROM chat WHERE username = '$chatPeople' AND receiver = '$username' AND refresh = 1";
	$result = mysql_query($sql);
	while( $row = mysql_fetch_array($result, MYSQL_NUM) ){
		if($row[1]==$chatPeople){
			echo '<div class="chatting-district-left"><div class="chatting-photo"><img src="'.$anotherPeoplePhoto.'"></div><div class="chatting-info" style="word-break:break-all">'.$row[3].'<span class="triangle"></span></div></div>';
		}
	}
	$sql = "UPDATE chat SET refresh = 0  WHERE  username = '$chatPeople' AND receiver = '$username' AND refresh = 1";
	mysql_query($sql);
}
?>