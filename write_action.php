<?php
include ('db_conn.php');
session_start();
$writer=$_SESSION['username'];
$track=$_SESSION['track'];
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

error_reporting( E_ALL );
ini_set( "display_errors", 1 );


$conn = db_connect();
$sql = "INSERT INTO story  (createtime, writer, track, title, content,hit) values(now(),'$writer','$track','$title','$content',0)";
$result = mysqli_query($conn,$sql);

if($result){
?>	<script> alert("글이 등록되었습니다.");	location.replace("main.php"); </script>
<?php
}
else{
	echo "FAIL";
}
mysqli_close($conn);

}
?>
