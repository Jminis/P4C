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
                <?php include('db_conn.php') ; session_start();  if(isset($_SESSION['username']))  echo $_SESSION['username'];  else location_replace('login.html'); ?> 님
                </p>
                <a href="logout.php" >LOGOUT</a>
            </div>
        </div>
<?php
    $idx=$_GET['idx'];
    $sql ="SELECT * FROM story WHERE idx='$idx'";
    $row=mqr($sql);

    if(!isset($_COOKIE['readNo_'.$idx])) {
        $hit=$row['hit']+1;
        $hitsql = "UPDATE story SET hit = '$hit' WHERE idx = '$idx'";
        $hitquery=mq($hitsql);
        setcookie("readNo_".$idx, $idx, time() + 60 * 60);
    }
?>

        <div id="body_container">
            <div id="left-body">
                <div id="lb_wrap">
                    <input id="lb_all" class="load_btn" type="button" value="ALL" onclick="location.href='main.php'"><br/>
                    <input id="lb_web" class="load_btn" type="button" value="WEB" onclick="location.href='main.php?track=web'"><br/>
                    <input id="lb_sys" class="load_btn" type="button" value="SYS" onclick="location.href='main.php?track=sys'">
                </div>
            </div>

            <div id="right-body">
            	<div style="margin-top: 20px;">
                    <a href="main.php" style="font-size: 40px;">돌아가기&nbsp;</a>
                </div>
                <p style="margin-left: 10px;text-align:left; font-size: 30px;">
                    <?php echo $row['createtime']?><br/>
                    글쓴이:<?php echo $row['writer'];?>

                    <!--글 삭제 -->
                    <?php
                    if($row['writer'] == $_SESSION['username']){ ?>
                        <a href="delete.php?idx=<?php echo $idx;?>" style="font-size: 20px;">삭제</a>
                        <?php } ?>
                </p>
				<p>
						<p style="font-size:50px;"><?php echo $row['title']?></p>
						<p style="font-size:30px; height:300px; box-sizing : border-box;"><?php echo $row['content']?></p>
                        <?php if($row['file'] != NULL) { ?>
                        <img style="width: 400px; margin-bottom:20px;" src="<?php echo 'upload/'.$row['file'];?>">
                        <?php } ?>
				</p>

                <div id="cmt_form">
                    <div id="cmt_count">댓글
                        <span id="count">0</span>
                    </div>
                    <form class="" action="add_cmt.php" method="post">
                        <div>
                            <textarea name="content" placeholder="Input your comment."></textarea>
                            <input type="hidden" name="story_idx" value=<?php echo $idx;?>>
                            <input type="submit" id="cmt_submit" value="남기기">
                        </div>
                    </form>
                    <div id="cmt_row">
                        <table >
                            <thead>
                                <th width = "1000">내용</th>
                                <th width = "200">작성자</th>
                                <th width = "200">날짜</th>
                                <th width = "100"></th>
                            </thead>
                            <tbody>
                                <?php
                                $sql ="SELECT * FROM comment WHERE story_idx='$idx'  ORDER BY idx desc";
                                $result = mq($sql);
                                    while($row = $result->fetch_array())
                                    { ?>
                                <tr>
                                    <td width="1000"><?php echo $row['content']; ?></td>
                                    <td width="200"><?php echo $row['writer']?></td></td>
                                    <td width="200" style="font-size:20px"><?php echo $row['createtime']?></td>
                                    <td width="100"><?php if($row['writer'] == $_SESSION['username']){ ?>
                                        <a href="del_cmt.php?idx=<?php echo $row['idx'];?>" style="font-size: 20px;">삭제</a>
                                        <?php } ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                  </div>


              <!--<script src="test.js"></script> 왜 안되는 걸까요옹?-->
              <a href="recommend.php?idx=<?php echo $idx;?>" style="font-size: 40px;"><br>추천하기</a>
            </div>
        </div>
    </body>
</html>
