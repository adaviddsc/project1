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
$anotherPeoplePhoto = $_COOKIE['anotherPeoplePhoto'];


if( $username!=null && $chatPeople!=null && $selfPeoplePhoto!=null && $anotherPeoplePhoto!=null ){
	$sql = "SELECT * FROM chat WHERE ( username = '$username' AND receiver = '$chatPeople' AND refresh = 0 ) OR ( username = '$chatPeople' AND receiver = '$username' AND refresh = 0 )";
	$result = mysql_query($sql);
	while( $row = mysql_fetch_array($result, MYSQL_NUM) ){
		if($row[1]==$username){
			echo '<div class="chatting-district-right"><div class="chatting-photo"><img src="'.$selfPeoplePhoto.'"></div><div class="chatting-info" style="word-break:break-all">'.$row[3].'<span class="triangle"></span></div></div>';
		}
		if($row[1]==$chatPeople){
			echo '<div class="chatting-district-left"><div class="chatting-photo"><img src="'.$anotherPeoplePhoto.'"></div><div class="chatting-info" style="word-break:break-all">'.$row[3].'<span class="triangle"></span></div></div>';
		}
	}
	$sql = "SELECT * FROM chat WHERE username = '$username' AND receiver = '$chatPeople' AND refresh = 1"; 
	$result = mysql_query($sql);
	while( $row = mysql_fetch_array($result, MYSQL_NUM) ){
		if($row[1]==$username){
			echo '<div class="chatting-district-right"><div class="chatting-photo"><img src="'.$selfPeoplePhoto.'"></div><div class="chatting-info" style="word-break:break-all">'.$row[3].'<span class="triangle"></span></div></div>';
		}
	}

	$sql = "UPDATE chat SET refresh = 0  WHERE  username = '$username' AND receiver = '$chatPeople' AND refresh = 1";
	mysql_query($sql);
}
?>