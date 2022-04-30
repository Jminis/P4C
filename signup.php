<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

include ('db_conn.php');
$uemail = $_COOKIE['useremail'];
$uid = $_POST['userid'];
$upw = $_POST['userpw'];
$upwc = $_POST['userpw_ck'];
$uname = $_POST['username'];
$utrack =  $_POST['usertrack'];

if($uemail == NULL || $uid == NULL || $upw == NULL || $upwc==NULL || $uname==NULL || $utrack==NULL){
?>
        <script>
                alert('모든 정보를 입력해주세요');
                history.go(-1);
        </script>
<?php
    exit;
}else if($upw != $upwc){
?>
	<script>
		alert('비밀번호와 비밀번호 확인이 일치하지 않습니다.');
		history.go(-1);
	</script>
<?php
    exit;
}else{
    $conn = db_connect();
    $check_sql="SELECT userid from userinfo WHERE userid='$uid' or useremail='$uemail'";
    $result=mysqli_query($conn,$check_sql);

    if($result->num_rows >= 1){
?>
            <script>
                    alert('아이디 또는 이메일 정보가 이미 사용 중입니다.');
                    history.go(-1);
            </script>
<?php
        exit;
    }

    $cksql = "SELECT checked FROM varify WHERE useremail='$uemail' ORDER BY createtime DESC LIMIT 1";
    $result=mysqli_query($conn,$cksql);
    $row=mysqli_fetch_array($result);
    if($row['checked'] == FALSE){
?>
                    <script>
                            alert('인증되지 않은 이메일 정보입니다.');
                            history.go(-1);
                    </script>
<?php
        mysqli_close($conn);
        exit;
    }

    $sql = "INSERT INTO userinfo (useremail,userid,userpw,username,usertrack,createtime) VALUES('$uemail','$uid',sha2('$upw',256),'$uname','$utrack',now())";
    $result = mysqli_query($conn, $sql);
    if($result){
?>
            <script>
                    alert('성공적으로 등록되었습니다.');
                    location.replace('./login.html');
            </script>
<?php
}
}
?>
