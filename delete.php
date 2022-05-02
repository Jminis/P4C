<?php
include ('db_conn.php');
session_start();
$idx = $_GET['idx'];
$sql = "SELECT writer FROM story WHERE idx='$idx'";
$row = mqr($sql);

if($row['writer'] == $_SESSION['username']){
    $idx=$_GET['idx'];
    $sql = "DELETE FROM story WHERE idx = '$idx'";
    $sql2 = "DELETE FROM comment WHERE story_idx = '$idx'";
    mq($sql);
    mq($sql2);
    alert_msg('글이 삭제되었습니다.');
    location_replace('/main.php');
}else{
    alert_msg('잘못된 접근입니다.');
    location_replace('/main.php');
}
?>
