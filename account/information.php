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
$birth = $_POST['birth'];
$sex = $_POST['sex'];
$email = $_POST['email'];


if( $birth != null && $email != null && $sex != null )
{
    $sql = "SELECT * FROM account where username = '$username'";
    $result = mysql_query($sql);
    $row = @mysql_fetch_row($result);
    $user = $row[7];

    $sql = "SELECT * FROM information where user = '$user'";
    $result = mysql_query($sql);
    $row = @mysql_fetch_row($result);
    if ( $row[1]==null ){
    	$sql = "UPDATE information SET username = '$username', birth = '$birth', sex = '$sex' , email = '$email' WHERE user = '$user'";
    	if(mysql_query($sql))
        {
            echo $lang->line("edit success");
            //echo '<meta http-equiv=REFRESH CONTENT=2;url=../self.php>';
        }
        else
        {
            echo $lang->line("edit failure");
        }
    }
    else{
        $sql = "UPDATE information SET birth = '$birth', sex = '$sex', email = '$email' WHERE username = '$username'";
        if(mysql_query($sql))
        {
            echo $lang->line("edit success");
            //echo '<meta http-equiv=REFRESH CONTENT=2;url=../self.php>';
        }
        else
        {
            echo $lang->line("edit failure");
        }
    }
}
else
{
    echo $lang->line("info not complete");
    //echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>