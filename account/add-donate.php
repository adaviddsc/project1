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
$title = $_POST['title'];
$date = $_POST['date'];
$items = $_POST['items'];
$address = $_POST['addr_county'].$_POST['addr_area'].$_POST['address'];
$cellphone = $_POST['cellphone'];
$telephone = $_POST['telephone'];
$detail = $_POST['detail'];
$detail = str_replace(" ","&nbsp",$detail);
$detail = str_replace("\n","",$detail);
$detail = preg_replace("/\s/","<br>",$detail);
if( $username != null && $title != null && $date != null && $items != null && $address != null && $cellphone != null && $telephone != null && $detail != null  && $_FILES['fileToUpload']["tmp_name"][0]!=null && $_POST['addr_county']!="台灣" && $_POST['addr_area']!="鄉鎮市區" )
{   
    $sql = "INSERT into donateevent (username, donateEventTitle, donateEventDate, donateEventItems, donateEventAddress, donateEventCellphone, donateEventTelephone, donateEventDetail) values ('$username', '$title', '$date', '$items', '$address', '$cellphone', '$telephone', '$detail')";
    $user_dir="upload";
    if (!is_dir("../".$user_dir."/".$username)) {      //檢察upload資料夾是否存在
        mkdir("../".$user_dir."/".$username,0777);       //創建USER資料夾
    }          

	if(mysql_query($sql))
    {
        $num_files = count($_FILES['fileToUpload']['tmp_name']);
        for($i=0; $i < $num_files;$i++)
        {

            if($_FILES['fileToUpload']["tmp_name"][$i]!=null){
                move_uploaded_file( $_FILES['fileToUpload']["tmp_name"][$i], iconv("utf-8", "big5", "../".$user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i]) );           
                $PhotoAddress= $user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i];
            }
            /*if($i==0){
                $sql = "UPDATE helpstory SET helpIndexPhoto = '$PhotoAddress' WHERE helpStoryTitle = '$title'"; 
                mysql_query($sql);
            }*/
            $sql = "INSERT into donateeventphoto (username, donateEventTitle, donateEventDate, donateEventPhoto) values ('$username', '$title', '$date', '$PhotoAddress')";
            mysql_query($sql);
            if ($i==$num_files-1){
                echo '<meta http-equiv=REFRESH CONTENT=1;url=../help.php>';
            }
        }        
    }
    else
    {
        echo $lang->line("edit failure");
    }  
}
else
{
    echo $lang->line("info not complete");
    echo '<meta http-equiv=REFRESH CONTENT=1;url=../help.php>';
    //echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>