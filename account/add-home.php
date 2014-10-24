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
$country = $_POST['country'];
$address = $_POST['address'];
$cellphone = $_POST['cellphone'];
$telephone = $_POST['telephone'];
$persons = $_POST['persons'];
$help = $_POST['help'];
$help = implode (",", $help);
$detail = $_POST['detail'];
$detail = str_replace(" ","&nbsp",$detail);
$detail = str_replace("\n","",$detail);
$detail = preg_replace("/\s/","<br>",$detail);
if( $username != null && $title != null && $date != null && $address != null && $cellphone != null && $telephone != null && $persons != null && $detail != null  && $_FILES['fileToUpload']["tmp_name"][0]!=null )
{   
    $sql = "INSERT into houseprovide (username, houseTitle, houseDate, houseCountry, houseAddress, houseCellphone, houseTelephone, houseMostPersons, houseHelp, houseDetail) values ('$username', '$title', '$date', '$country', '$address', '$cellphone', '$telephone', '$persons', '$help', '$detail')";
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

            $sql = "INSERT into houseprovidephoto (username, houseTitle, houseDate, housePhoto) values ('$username', '$title', '$date', '$PhotoAddress')";
            mysql_query($sql);
            if ($i==$num_files-1){
                echo '<meta http-equiv=REFRESH CONTENT=1;url=../travel.php>';
            }
        }        
    }
    else
    {
        echo $lang->line("edit failure");
        echo '<meta http-equiv=REFRESH CONTENT=1;url=../travel.php>';
    }  
}
else
{
    echo $lang->line("info not complete");
    echo '<meta http-equiv=REFRESH CONTENT=1;url=../travel.php>';
}
?>