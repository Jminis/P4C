<?php
include ('db_conn.php');

session_start();
$uid = $_POST['userid'];
$upw = $_POST['userpw'];

$sql = "SELECT * FROM userinfo WHERE userid='$uid' AND userpw=sha2('$upw',256)";
$result = mq($sql);
$row = $result->fetch_array();

if($result->num_rows == 1){
    $_SESSION['userid'] = $row['userid'];
    $_SESSION['usertrack'] = $row['usertrack'];
    $_SESSION['username'] = $row['username'];
    location_replace('main.php');
    exit;
}else {
    alert_msg('로그인 정보가 올바르지 않습니다.');
    history_go();
   exit;
}
?>
