<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connect.php");
$username = $_SESSION['username']; 
$title = $_GET['title'];  
$photo = $_GET['photo'];
if($username!=null && $photo!=null && $title!=null) 
{
        $sql = "UPDATE helpstory SET helpIndexPhoto = '$photo' WHERE helpStoryTitle = '$title'";  
        if(mysql_query($sql))
        {             
            echo $title.','.$photo;
        }
}
?>