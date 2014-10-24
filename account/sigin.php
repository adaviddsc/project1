<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
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

//搜尋資料庫資料
$sql = "SELECT * FROM account where user = '$user'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if( $user != null && $password != null && $row[7] == $user && $row[2] == $password)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['username'] = $row[1];
        echo $lang->line("login success");
        echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';

}
else
{
        echo $lang->line("login failure");
}
?>