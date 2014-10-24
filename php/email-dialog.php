<!DOCTYPE HTML>
<?php
session_start();
include("../account/connect.php");
include("../language.php");
if ( isset( $_COOKIE['language'] ) ){
  $language = $_COOKIE['language'];
}
else{
  $language = "zh-tw";
}

$lang = new Language();
$lang->load($language);

if ( isset( $_SESSION['username'] ) ){
  $idSelf = $_SESSION['username'];
  echo "<script>"; 
  echo "session = '".$_SESSION['username']."';";
  echo "</script>"; 

  $sql = "SELECT * FROM account";
  $result = mysql_query($sql);
  echo "<script>"; 
  echo "var username_photo = new Array();";
  echo "var user_account = new Array();";
  echo "</script>"; 
  while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    echo "<script>"; 
    echo "username_photo['".$row[1]."'] = '".$row[5]."';";
    echo "user_account['".$row[1]."'] = '".$row[7]."';";
    echo "</script>"; 
  }


  $sql = "SELECT * FROM addfriend WHERE receiveUser = '$idSelf' ORDER BY id DESC";
  $result = mysql_query($sql);
  echo "<script>"; 
  echo "var sendUser = new Array();";
  echo "var c = 0";
  echo "</script>"; 
  $c=0;
  while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    if (isset($row[0])){
      echo "<script>"; 
      echo "sendUser[".$c++."] = '".$row[1]."';";
      echo "c = ".$c.";";
      echo "</script>";       
    }
  }

  $sql = "SELECT DISTINCT username AS name FROM chat WHERE receiver = '$idSelf' AND messagesignal = 1 ";
  $result = mysql_query($sql);
  echo "<script>"; 
  echo "var usercircle = new Array();";
  echo "var d = 0";
  echo "</script>"; 
  $d=0;
  while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    if (isset($row[0])){
      echo "<script>"; 
      echo "usercircle[".$d++."] = '".$row[0]."';";
      echo "</script>";       
    }
  }

}


?>
<head>
  <link rel="stylesheet" type="text/css" href="stylesheets/email-dialog.css">
  <script type="text/javascript" src="javascripts/email-dialog.js"></script>
  <script type="text/javascript" src="javascripts/cookies.js"></script>
</head>
<div class="modal fade" id="myModal-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content-email">
      <div class="modal-header">           
        <div class="email-header">
          <i class="fa fa-times" data-dismiss="modal"></i>
          <i class="fa fa-envelope">&nbsp<?php echo $lang->line("email");?></i>
        </div>
      </div>
      <div class="modal-body">
        <div class="email-container">
          <div class="email-container-header">
            <div class="header-circle-out">
              <div class="header-circle-in" id="chat-click">
                <i class="fa fa-comments-o"></i>
              </div>
            </div>
            <div class="header-circle-out">
              <div class="header-circle-in" id="user-click">
                <i class="fa fa-user"></i>
                <i class="fa fa-plus-circle"></i>
              </div>
            </div>
            <div class="header-circle-out">
              <div class="header-circle-in" id="other-click">
                <i class="fa fa-bell-o"></i>
              </div>
            </div>
          </div>

          <div class="email-container-chat">
            <div class="email-container-chat-container-people">
              <!--<div class="email-container-chat-photo" name="close">
                <img src="upload/123/images (5).jpg">
                <div class="fa fa-users"></div>
                <div class="fa fa-comment-o" id="chat-photo-fa-comment"></div>  
              </div> -->
            
            </div>

            <div class="fa fa-chevron-left" id="chatting-district-back"></div>
            <div class="email-container-chat-container-chatting">
              
              

              <!--<div class="chatting-district-left">
                <div class="chatting-photo">
                  <img src="upload/123/test.jpg" alt="">
                </div>
                <div class="chatting-info">
                  我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋我是大笨蛋
                  <span class="triangle"></span>
                </div>
              </div>


              <div class="chatting-district-right">
                <div class="chatting-photo">
                  <img src="upload/123/test.jpg" alt="">
                </div>
                <div class="chatting-info">
                  我是笨
                  <span class="triangle"></span>
                </div>
              </div>-->

            </div>

            <div class="chatting-district-input">
              <form id="chat-form" method="post" action="account/sendMessage.php">
                <input type="submit" class="btn btn-success">
                <textarea id="chat-textarea" class="form-control" name="senderMessage" wrap="off" onkeypress="return EnterSubmit(event)"></textarea>
              </form>
            </div>

          </div>
          <div class="email-container-user">
            <!--<div class="email-container-user-container">
              <div class="email-container-user-photo">
                <img src="upload/123/30.jpg">  
              </div>
              <div class="email-container-user-info">
                  <h1>我是ID唷唷唷</h1>
                  <div class="user-info-button">
                    <div class="user-info-left">
                      <i class="fa fa-user"></i>
                      <i class="fa fa-plus-circle"></i>
                    </div>
                    <div class="user-info-right">
                      <i class="fa fa-times-circle"></i>
                    </div>
                  </div> 
              </div>         
            </div>-->



          <div class="email-container-other">
            
          </div>
        </div>
      </div>
      <!--<div class="modal-footer"></div>-->
    </div>
  </div>
</div>
<form id="receiveMessage" method="post" action="account/receiveMessage.php"></form>
<form id="refreshMessage" method="post" action="account/refreshMessage.php"></form> <!--1.5s ajax-->
<form id="refreshAddFriends" method="post" action="account/refreshAddFriends.php"></form> <!--1.5s ajax-->
<form id="refreshFriendsCircle" method="post" action="account/refreshFriendsCircle.php"></form> <!--1.5s ajax-->
<form id="delete-signalMessage" method="post" action="account/delete-signalMessage.php"></form>
<form id="remindMessage" method="post" action="account/remindMessage.php"></form> <!--1.5s ajax-->
<audio id="remindSound" src="images/doorbell.wav" controls="controls"></audio>