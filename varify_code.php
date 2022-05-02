<?php
include ('db_conn.php');
$useremail=$_COOKIE['useremail'];
$input_code = $_POST['input_code'];

if($useremail==NULL){
    alert_msg('먼저 인증코드를 발송해주세요');
    exit;
}else{

    $conn=db_connect();

    //check with db
    $sql = "SELECT code,createtime FROM varify WHERE useremail='$useremail' ORDER BY createtime DESC LIMIT 1";
    $row = mqr($sql);

    $current_time =  date("Y-m-d H:i:s",time());
    $createtime=$row['createtime'];
    $res=strtotime($current_time)-strtotime($createtime);
    $code = $row['code'];
    if($code == $input_code){
        if($res > 300){//5분이 지날 경우
            alert_msg('코드의 유효시간이 만료되었습니다.');
            history_go();
            mysqli_close($conn);
            exit;
        }else{
            $cksql = "UPDATE varify SET checked=TRUE WHERE code='$code' ";
            mysqli_query($conn,$cksql);
            alert_msg('이메일 인증이 완료되었습니다.');
            history_go();
            mysqli_close($conn);
            exit;
        }
    }else{
        alert_msg('인증코드가 올바르지 않습니다.');
        history_go();
    }
    mysqli_close($conn);
}

?>
