<?php
// 디버깅용
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

function db_connect(){
        $conn = mysqli_connect("localhost","root","","my_web") or die ("Can't access DB");
        return $conn;
}

function mq($sql){
    $conn = db_connect();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function mqr($sql){
    $conn = db_connect();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row;
}

function alert_msg($msg){
    echo "<script>alert('$msg');</script>";
}
function history_go(){
    echo "<script>history.go(-1);</script>";
}
function location_replace($url){
    echo "<script>location.replace('$url');</script>";
}

?>
