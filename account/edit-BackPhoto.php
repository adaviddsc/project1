<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connect.php");
$username = $_SESSION['username'];   
if($username != null && $_FILES["fileToUpload"]["tmp_name"]!=null) 
{

        $user_dir="upload";
        if (!is_dir("../".$user_dir."/".$username)) {      //檢察upload資料夾是否存在
            mkdir("../".$user_dir."/".$username,0777);       //創建USER資料夾
        }
        if($_FILES["fileToUpload"]["tmp_name"]!=null){
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
            iconv("UTF-8", "big5", "../".$user_dir."/".$username."/".$_FILES["fileToUpload"]["name"] ));           
            $address= $user_dir."/".$username."/".$_FILES["fileToUpload"]["name"];
        }
        //echo $_FILES["fileToUpload"]["tmp_name"];
        $sql = "UPDATE account SET backPhoto = '$address' WHERE username = '$username'";  
        if(mysql_query($sql))
        {             
               // echo '<meta http-equiv=REFRESH CONTENT=2;url=../self.php>';
        }
        else
        {      
                //echo '<meta http-equiv=REFRESH CONTENT=2;url=../self.php>';
        }
}


?>