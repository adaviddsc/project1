<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Taipei');
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
$commentsUser = $_POST['commentsUser'];
$commentsTitle = $_POST['commentsTitle'];
$commentsContent = $_POST['commentsContent'];
$commentsStarts = $_POST['commentsStarts'];
$commentsContent = str_replace(" ","&nbsp",$commentsContent);
$commentsContent = str_replace("\n","",$commentsContent);
$commentsContent = preg_replace("/\s/","<br>",$commentsContent);
$commentsDate = date("Y-m-d H:i:s");
$data = array();
if($username != null && $commentsUser!=null && $commentsTitle!=null && $commentsContent!=null && $commentsStarts!=null && $commentsDate!=null && $_FILES['fileToUpload']["tmp_name"][0]!=null )
{

    $user_dir="upload";
    if (!is_dir("../".$user_dir."/".$username)) {      //檢察upload資料夾是否存在
        mkdir("../".$user_dir."/".$username,0777);       //創建USER資料夾
    }

    $num_files = count($_FILES['fileToUpload']['tmp_name']);

    for($i=0; $i < $num_files;$i++)
    {
        if($_FILES['fileToUpload']["tmp_name"][$i]!=null){
            move_uploaded_file( $_FILES['fileToUpload']["tmp_name"][$i], iconv("utf-8", "big5", "../".$user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i]) );
            $address= $user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i];
        }
        $sql = "INSERT into comments (username, commentsUser, commentsTitle, commentsDate, commentsContent, commentsPhoto, commentsStarts) values ('$username', '$commentsUser', '$commentsTitle', '$commentsDate', '$commentsContent', '$address', '$commentsStarts')";
        if(mysql_query($sql))
        {
            array_push($data,array('data' => 'success','message' => '完成評論','username' => $username,'commentsUser' => $commentsUser,'commentsTitle' => $commentsTitle,'commentsDate' => $commentsDate,'commentsContent' => $commentsContent,'commentsPhoto' => $address,'commentsStarts' => $commentsStarts));
        }
    }
    array_push($data,array('data' => 'success','message' => '完成評論','commentsPhoto' => 'undefined'));
}
else{
    array_push($data,array('data' => 'error','message' => '填寫資料未完整'));
}
ob_end_clean();
echo json_encode($data);
?>