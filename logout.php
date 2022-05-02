<?php
include('db_conn.php');
session_start();
$result=session_destroy();
if($result){
    alert_msg('로그아웃 되었습니다.');
    location_replace('login.html');
}
?>
