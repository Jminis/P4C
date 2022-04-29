<?php
include ('db_conn.php');

session_start();
$conn=db_connect();
$uid = $_POST['userid'];
$upw = $_POST['userpw'];

$sql = "SELECT * FROM userinfo WHERE userid='$uid' AND userpw='$upw'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($result->num_rows == 1){
    $_SESSION['userid'] = $row['userid'];
    $_SESSION['track'] = $row['track'];
    $_SESSION['username'] = $row['username'];
    echo "<script>location.replace('main.php');</script>";
    exit;
}else {
   echo "<script>alert('로그인 정보가 올바르지 않습니다.')</script>";
   echo "<script>history.go(-1);</script>";
   exit;
}

?>
