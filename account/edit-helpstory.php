<?php
ob_start();
session_start();
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

$article = $_POST['article'];
$username = $_SESSION['username'];
$title = $_POST['title'];
$date = $_POST['date'];
$bookmark = $_POST['bookmark'];
$time = $_POST['time'];
$time = implode (",", $time);
$position = $_POST['position'];
$mood = $_POST['mood'];
$text = $_POST['text'];
$text = str_replace(" ","&nbsp",$text);
$text = str_replace("\n","",$text);
$text = preg_replace("/\s/","<br>",$text);
$data = array();

if( $article==0 ){
    if( $username != null && $title != null && $date != null && $bookmark != null && $time != null && $position != null && $mood != null && $text != null && $_FILES['fileToUpload']["tmp_name"][0]!=null )
    {
        $user_dir="upload";
        if (!is_dir("../".$user_dir."/".$username)) {
            mkdir("../".$user_dir."/".$username,0777);
        }

        $num_files = count($_FILES['fileToUpload']['tmp_name']);
        for($i=0; $i < $num_files;$i++)
        {
            if($_FILES['fileToUpload']["tmp_name"][$i]!=null){
                move_uploaded_file( $_FILES['fileToUpload']["tmp_name"][$i], iconv("utf-8", "big5", "../".$user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i]) );           
                $address= $user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i];
                $sql = "INSERT into travel_article (username, travelTitle, travelDate, travelBookmark, travelTime, travelPosition, travelMood, travelImg, travelText) values ('$username', '$title', '$date', '$bookmark', '$time', '$position', '$mood', '$address', '$text')";
                mysql_query($sql);
            }
        }
        array_push($data,array('data' => 'success','message' => '發文成功'));
    }
    else
    {
        array_push($data,array('data' => 'error','message' => '填入資料未完整'));
    }
}

else if( $article==2 ){
    if( $username != null && $title != null && $date != null && $bookmark != null && $time != null && $position != null && $mood != null && $text != null && $_FILES['fileToUpload']["tmp_name"][0]!=null )
    {
        $user_dir="upload";
        if (!is_dir("../".$user_dir."/".$username)) {
            mkdir("../".$user_dir."/".$username,0777);
        }

        $num_files = count($_FILES['fileToUpload']['tmp_name']);
        for($i=0; $i < $num_files;$i++)
        {
            if($_FILES['fileToUpload']["tmp_name"][$i]!=null){
                move_uploaded_file( $_FILES['fileToUpload']["tmp_name"][$i], iconv("utf-8", "big5", "../".$user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i]) );           
                $address= $user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i];
                $sql = "INSERT into travelarticle (username, travelTitle, travelDate, travelBookmark, travelTime, travelPosition, travelMood, travelImg, travelText) values ('$username', '$title', '$date', '$bookmark', '$time', '$position', '$mood', '$address', '$text')";
                mysql_query($sql);
            }
        }
        array_push($data,array('data' => 'success','message' => '發文成功'));
    }
    else
    {
        array_push($data,array('data' => 'error','message' => '填入資料未完整'));
    }
}

ob_end_clean();
echo json_encode($data);
?>