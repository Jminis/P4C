<?php
include ('db_conn.php');
session_start();
$username = $_SESSION['username'];
$idx = $_GET['idx'];

$cksql = "SELECT * FROM recommend WHERE username='$username' and story_idx='$idx'";
$row=mqr($cksql);

if($row){
    $upsql = "UPDATE story SET rmd_cnt = rmd_cnt -1 WHERE idx='$idx'";
    mq($upsql);
    $insql = "DELETE FROM recommend WHERE username='$username' and story_idx='$idx'";
    mq($insql);
    alert_msg('글 추천이 취소 되었습니다.');
    history_go();
}else{
    $upsql = "UPDATE story SET rmd_cnt = rmd_cnt + 1 WHERE idx='$idx'";
    mq($upsql);
    $insql = "INSERT INTO recommend (story_idx,username) VALUES ('$idx','$username')";
    mq($insql);
    alert_msg('글이 추천 되었습니다.');
    history_go();
}

?>
