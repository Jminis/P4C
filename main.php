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
    $sql ="SELECT * FROM story ORDER BY idx desc";
    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);
?>

        <div id="body_container">
            <div id="left-body">
                <input class="load_btn" type="button" onclick="alert(1);"><br/>
                <input class="load_btn" type="button" onclick="alert(1);">

            </div>
            <div id="right-body">
                <p>
                    <form action="search.php" method="post">
                        <select style="width: 70px;" name="track">
                            <option value="title">제목</option>
                            <option value="contents">내용</option>
                            <option value="writer">작성자</option>
                        </select>
                        <input type="text" name="value" placeholder="Search">
                        <input class="btn_search" type="submit" value="검색">
                    </form>
                </p>
                <p style="text-align:right">
                    <a href="write.php" style="font-size: 40px;">글쓰기&nbsp;</a>
                </p>
                <table >
                    <thead>
                        <th width = "100">번호</th>
                        <th width = "200">날짜</th>
                        <th width = "800">제목</th>
                        <th width = "200">작성자</th>
                        <th width = "100">조회수</th>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $result->fetch_array())
                            {
                              $title=$row['title'];
                              if(strlen($title)>15)
                              {
                                $title=substr($row['title'],0,15)."...";
                              }
                        ?>
                        <tr class='<?php echo $row['track']; ?>'>
                            <td width="100"><?php echo $row['idx']; ?></td>
                            <td width="200"><?php echo $row['createtime']?></td>
                            <td width="800"><a href="read.php?idx=<?php echo $row["idx"];?>"><?php echo $title;?></a></td>
                            <td width="200"><?php echo $row['writer']?></td>
                            <td width="100"><?php echo $row['hit']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
