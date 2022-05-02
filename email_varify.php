<?php
include ('db_conn.php');
$useremail=$_POST['useremail'];
setcookie ( 'useremail' , "$useremail" );

function get_random($num){
    $res = '';
    for($i=0;$i<$num;$i++){
        $tmp = rand(0,9);
        $res .= (string)$tmp;
    }
    return $res;
}

if($_POST['useremail']==NULL){
    alert_msg('이메일 정보를 입력해주세요.');
    history_go();
    exit;
}else{

    //반영이 안됨.
    //echo "<script>document.getElementById('target_email').value= '$useremail';</script>";
    //echo "<script>document.getElementById('btn_check').disabled = false;</script>";
    $random = get_random(6);
    $sql = "SELECT createtime FROM varify WHERE useremail='$useremail' ORDER BY createtime DESC LIMIT 1";
    $row = mqr($sql);
    $current_time =  date("Y-m-d H:i:s",time());
    $createtime=$row['createtime'];
    $res=strtotime($current_time)-strtotime($createtime);
    if($res < 180){//3분이 안지난 경우
        alert_msg('재발송은 이전 발송 3분 이후에 가능합니다.');
        history_go();
    }

    //save_db for check
    $sql = "INSERT INTO varify (useremail,createtime,code) VALUES('$useremail',now(),'$random')";
    $result = mq($sql);
    alert_msg('인증코드가 전송되었습니다.\n5분내로 인증해주시길 바랍니다.');
    history_go();

    //send mail
    $to= $useremail;
    $subject = 'Verification from P4Css';
    $message = '
    <html>
    Please put the code below in the verification field on P4Css<br>
    ------------------------<br>
    '.$random.'<br>
    ------------------------<br>

    Please click this link to activate your account:<br>
    </html>
    ';

    $headers = 'From:noreply@example.com' . "\r\n";
    $headers .= 'Organization: Sender Organization ' . "\r\n";
    $headers .= 'MIME-Version: 1.0 ' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8 ' . "\r\n";
    $headers .= 'X-Priority: 3 ' ."\r\n" ;
    $headers .= 'X-Mailer: PHP". phpversion() ' ."\r\n" ;
    //$result=mail($to, $subject, $message, $headers);
    exit;

}

?>
