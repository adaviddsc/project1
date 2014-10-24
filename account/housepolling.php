<?php
session_start();
session_write_close();
ob_start();
include('connect.php');
include('../language.php');
if ( isset( $_COOKIE['language'] ) ){
        $language = $_COOKIE['language'];
}
else{
        $language = 'zh-tw';
}

$lang = new Language();
$lang->load($language);
$title = $_POST['title'];
$date = $_POST['date'];
$maxID = $_POST['maxID'];
$selecter = $_POST['selecter'];
$data = array();
if ( $maxID=='error'){
	$sql = "SELECT * from houseprovidecomment ORDER BY id DESC LIMIT 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$maxID = $row[0];
}
for ($i = 0; $i < 180; $i++ ) {
	$sql = "SELECT * FROM houseprovidecomment WHERE ( id > '$maxID' AND houseTitle = '$title' AND houseDate = '$date' ) ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ( $row[0]!=null ){
		$sqlMaxID = $row[0];
		array_push($data,array('id' => $row[0], 'username' => $row[1], 'comment' => $row[4], 'selecter' => $selecter ));
		while( $row = mysql_fetch_array($result, MYSQL_NUM) ){
			array_push($data,array('id' => $row[0], 'username' => $row[1], 'comment' => $row[4]));
			$sqlMaxID = $row[0];
		}
		array_push($data,array('id' => $sqlMaxID, 'username' => 'undefined', 'comment' => 'undefined'));
		break;
	}
	sleep(1);
	if ($i==179){
		echo json_encode($data,array('maxID' => $maxID,'selecter' => $selecter ));
		flush();
		exit(0);
	}
}
ob_end_clean();
echo json_encode($data);
flush();
exit(0);

?>