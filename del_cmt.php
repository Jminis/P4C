<?php
include ('db_conn.php');
session_start();
$idx = $_GET['idx'];
$sql = "SELECT writer FROM comment WHERE idx='$idx'";
$row = mqr($sql);

if($row['writer'] == $_SESSION['username']){
    $idx=$_GET['idx'];
    $sql = "DELETE FROM comment WHERE idx = '$idx'";
    mq($sql);
    alert_msg('댓글이 삭제되었습니다.');
    history_go();
}else{
    alert_msg('잘못된 접근입니다.');
    history_go();
}
?>
