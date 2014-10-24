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

$user = $_POST['username'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$username = uniqid();
if( $username != null && $password != null && $phone != null && $address != null && $user!=null )
{
    $sql = "INSERT INTO information (user) values ('$user')";
    mysql_query($sql);
	$sql = "INSERT INTO account (username, password, phone, address, photo, user) values ('$username', '$password', '$phone', '$address', 'images/TL.png', '$user')";
	if(mysql_query($sql))
    {
        echo $lang->line("regist success");
        //echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
    }
    else
    {
        echo $lang->line("regist failure");
    }
}
else
{
    echo $lang->line("info not complete");
    //echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>