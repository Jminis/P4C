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
    $conn=db_connect();
    $random = get_random(6);


    //반영이 안됨.
    //echo "<script>document.getElementById('target_email').value= '$useremail';</script>";
    //echo "<script>document.getElementById('btn_check').disabled = false;</script>";


    //save_db for check
    $sql = "INSERT INTO varify (useremail,createtime,code) VALUES('$useremail',now(),'$random')";
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
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

    $headers = 'From:noreply@naver.com' . "\r\n";
    $headers .= 'Organization: Sender Organization ' . "\r\n";
    $headers .= 'MIME-Version: 1.0 ' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8 ' . "\r\n";
    $headers .= 'X-Priority: 3 ' ."\r\n" ;
    $headers .= 'X-Mailer: PHP". phpversion() ' ."\r\n" ;
    //$result=mail($to, $subject, $message, $headers);
    exit;

}

?>
