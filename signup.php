<?php
include ('db_conn.php');
$uemail = $_COOKIE['useremail'];
$uid = $_POST['userid'];
$upw = $_POST['userpw'];
$upwc = $_POST['userpw_ck'];
$uname = $_POST['username'];
$utrack =  $_POST['usertrack'];

if($uemail == NULL){
    alert_msg('이메일 인증을 진행해주세요.');
    history_go();
}
if($uid == NULL || $upw == NULL || $upwc==NULL || $uname==NULL || $utrack==NULL){
    alert_msg('모든 정보를 입력해주세요');
    history_go();
    exit;
}else if($upw != $upwc){
    alert_msg('비밀번호와 비밀번호 확인이 일치하지 않습니다.');
    history_go();
    exit;
}else{
    $check_sql="SELECT userid from userinfo WHERE userid='$uid' or useremail='$uemail'";
    $result=mq($check_sql);
    if($result->num_rows >= 1){
        alert_msg('아이디 또는 이메일 정보가 이미 사용 중입니다.');
        history_go();
        exit;
    }

    $cksql = "SELECT checked FROM varify WHERE useremail='$uemail' ORDER BY createtime DESC LIMIT 1";
    $row=mqr($cksql);
    if($row['checked'] == FALSE){
        alert_msg('인증되지 않은 이메일 정보입니다.');
        history_go();
        exit;
    }

    $sql = "INSERT INTO userinfo (useremail,userid,userpw,username,usertrack,createtime) VALUES('$uemail','$uid',sha2('$upw',256),'$uname','$utrack',now())";
    $result = mq($sql);
    if($result){
        alert_msg('성공적으로 등록되었습니다.');
        location_replace('./login.html');
    }
}
?>
