<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connect.php");
$username = $_SESSION['username'];   
if($username != null && isset($_FILES['fileToUpload']['tmp_name'])) 
{

        $user_dir="upload";
        if (!is_dir("../".$user_dir."/".$username)) {      //檢察upload資料夾是否存在
            mkdir("../".$user_dir."/".$username,0777);       //創建USER資料夾
        }

        $num_files = count($_FILES['fileToUpload']['tmp_name']);
        for($i=0; $i < $num_files;$i++)
        {
            if($_FILES['fileToUpload']["tmp_name"][$i]!=null){
                move_uploaded_file($_FILES['fileToUpload']["tmp_name"][$i],
                iconv("UTF-8", "big5", "../".$user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i] ));           
                $address= $user_dir."/".$username."/".$_FILES['fileToUpload']["name"][$i];
            }
            $sql = "INSERT into helpstoryphoto (username, helpPhoto) values ('$username', '$address')";
            //$sql = "UPDATE helpstory SET helpPhoto = '$address' WHERE username = '$username'";  
            if(mysql_query($sql))
            {             
                    //echo '<meta http-equiv=REFRESH CONTENT=2;url=../self.php>';
            }
            else
            {      
                    //echo '<meta http-equiv=REFRESH CONTENT=2;url=../self.php>';
            }

        }                  
        //echo '<meta http-equiv=REFRESH CONTENT=2;url=../self.php>';
}


?>