<?php
include ('db_conn.php');
session_start();
$writer=$_SESSION['username'];
$track=$_SESSION['usertrack'];
$title=$_POST['title'];
$content=$_POST['content'];

if( !isset ($_SESSION['username'] ) ){
    ?><script>location.replace("main.php");</script><?php
}else if($title == NULL || $content == NULL){?>
    <script>
    alert('제목 또는 내용을 채워주세요.');
    history.go(-1);
    </script>
<?php
}
else{
    // 파일 업로드
    if($_FILES['userfile']['name'] != NULL){
        $uploaddir = '/opt/lampstack-8.1.4-0/apache2/htdocs/upload/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            alert_msg('파일 업로드 성공!');
        } else {
            alert_msg('파일 업로드 실패!');
        }
    }

    $file = $_FILES['userfile']['name'];
    $sql = "INSERT INTO story (createtime, writer, track, title, content,hit,file) values(now(),'$writer','$track','$title','$content',0,'$file')";
    $result = mq($sql);

    if($result){
        alert_msg('글이 등록되었습니다.');
        location_replace('/main.php');
        exit;
    }
    else{
    	alert_msg('오류가 발생했습니다.');
        location_replace('/main.php');
        exit;
}
mysqli_close($conn);

}
?>
