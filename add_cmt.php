<?php
session_start();
include ('db_conn.php');
$content = $_POST['content'];
$writer = $_SESSION['username'];
$story_idx = $_POST['story_idx'];
if($content == NULL){
    alert_msg('내용을 입력해주세요');
    history_go();
}

$sql = "INSERT INTO comment (story_idx, createtime, writer, content) values('$story_idx',now(),'$writer','$content')";
mq($sql);
alert_msg('댓글이 등록되었습니다.');
history_go();

?>
