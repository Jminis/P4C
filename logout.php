<?php
session_start();
$result=session_destroy();
if($result){
echo "<script>alert('로그아웃 되었습니다.');</script>";
echo "<script>location.replace('./login.html');</script>";
}
?>
