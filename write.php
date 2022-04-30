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
    $sql ="SELECT * FROM story ORDER BY idx desc";
    $result = mq($sql);
    $total = mysqli_num_rows($result);
?>

        <div id="body_container">
            <div id="left-body">
                <input class="load_btn" type="button" onclick="alert(1);"><br/>
                <input class="load_btn" type="button" onclick="alert(1);">

            </div>
            <div id="right-body">
            	<div style="margin-top: 20px;"><a float="left" href="main.php" style="font-size: 40px;">돌아가기&nbsp;</a></div>
				<p>
					<form method ="post" action="write_action.php" enctype="multipart/form-data">
						<p><input type="text" name="title" placeholder="TITLE"></p>
						<p><textarea rows=15px cols=40px name="content" placeholder="CONTENTS"></textarea></p>
                        <input type="file" name="userfile">
						<p><input class ="btn_write" type="submit" value="작성하기"></p>
					</form>

				</p>
            </div>
        </div>
    </body>
</html>
