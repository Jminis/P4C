<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/mstyle.css">
        <title>P4CSS</title>
    </head>
    <body>
        <div id ="header_container">
            <div id="left-header">
                <a href="main.php" style="font-size: 150px">Story Shared</a>
            </div>
            <div id="right-header"><p ><br/>
                <?php   session_start();  if(isset($_SESSION['username']))  echo $_SESSION['username'];  else echo"<script>location.replace('/login.html')</script>"?> 님
                </p>
                <a href="logout.php" >LOGOUT</a>
            </div>
        </div>
<?php
    include('db_conn.php');
    $conn = db_connect();
    $idx=$_GET['idx'];
    $sql ="SELECT writer,createtime,hit,title,content FROM story WHERE idx='$idx'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);

    $hit=$row['hit']+1;
    $hitsql = "UPDATE story SET hit = '$hit' WHERE idx = '$idx'";
    $hitquery=mysqli_query($conn,$hitsql)

?>

        <div id="body_container">
            <div id="left-body">
                <input class="load_btn" type="button" onclick="alert(1);"><br/>
                <input class="load_btn" type="button" onclick="alert(1);">

            </div>
            <div id="right-body">
            	<div style="margin-top: 20px;">
                    <a href="main.php" style="font-size: 40px;">돌아가기&nbsp;</a>
                </div>
                <p style="margin-left: 10px;text-align:left; font-size: 30px;">
                    <?php echo $row['createtime']?><br/>
                    글쓴이:<?php echo $row['writer']?>
                </p>
				<p>
						<p style="font-size:50px;"><?php echo $row['title']?></p>
						<p style="font-size:30px;"><?php echo $row['content']?></p>
				</p>

                <a href="1" style="font-size: 40px;">추천하기</a>
            </div>
        </div>
    </body>
</html>
