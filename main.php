<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/mstyle.css">
        <title>P4CSS</title>
        <style>
        <?php  if(isset($_GET['track'])) echo "#lb_".$_GET['track'];
                    else echo "#lb_all"; ?>
        {
            background-color: rgba(16,141,191);
        }
        </style>
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

        <div id="body_container">
            <div id="left-body">
                <div id="lb_wrap">
                    <input id="lb_all" class="load_btn" type="button" value="ALL" onclick="location.href='main.php'"><br/>
                    <input id="lb_web" class="load_btn" type="button" value="WEB" onclick="location.href='main.php?track=web'"><br/>
                    <input id="lb_sys" class="load_btn" type="button" value="SYS" onclick="location.href='main.php?track=sys'">
                </div>
            </div>

            <div id="right-body">
                <p>
                    <form action="search.php" method="get">
                        <?php if(isset($_GET['track'])){ $track = $_GET['track']; echo "<input type='hidden' name='track' value=$track>";}?>
                        <select style="width: 70px;" name="key">
                            <option value="title">제목</option>
                            <option value="content">내용</option>
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
                        <th width = "100">추천</th>
                    </thead>
                    <tbody>
                        <?php
                        isset($_GET['page']) ? $page=$_GET['page']:$page=1;
                        $sql = "SELECT * FROM story".(isset($_GET['track'])? " WHERE track='".$_GET['track']."'" :"" );

                        $result = mq($sql);
                        $total = mysqli_num_rows($result);

                        $list = 10;
                        $block_cnt = 10;
                        $block_num = ceil($page / $block_cnt);
                        $block_start = (($block_num - 1) * $block_cnt) + 1;
                        $block_end = $block_start + $block_cnt - 1;

                        $total_page = ceil($total / $list);
                        if($block_end > $total_page){
                        	$block_end = $total_page;
                        }
                        $total_block = ceil($total_page / $block_cnt);
                        $page_start = ($page - 1) * $list;

                        if(isset($_GET['track'])) {
                            $track=$_GET['track'];
                            $sql = "SELECT * FROM story WHERE track ='$track' ORDER BY idx DESC LIMIT $page_start, $list";
                        }else $sql ="SELECT * FROM story ORDER BY idx DESC LIMIT $page_start, $list";

                        $result=mq($sql);
                        while($row = $result->fetch_array())
                        {
                          $title=$row['title'];
                          if(strlen($title)>20)
                          {
                            $title=substr($row['title'],0,25)."...";
                            $title=mb_strimwidth($row['title'],0,20,"...","utf-8");
                          }
                        ?>
                        <tr class='<?php echo $row['track']; ?>'>
                            <td width="100"><?php echo $row['idx']; ?></td>
                            <td style="font-size: 25px;" width="200"><?php echo $row['createtime']?></td>
                            <td width="700"><a href="read.php?idx=<?php echo $row["idx"];?>"><?php echo $title;?></a></td>
                            <td width="200"><?php echo $row['writer']?></td>
                            <td width="100"><?php echo $row['hit']; ?></td>
                            <td width="100"><?php echo $row['rmd_cnt']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div style="font-size:30px">
               <?php
               if ($page > 1) echo "<a href='main.php?".(isset($track) ? "track=".$track."&" : "")."page=1'>처음</a>";
               for($i = $block_start; $i <= $block_end; $i++){
                   if($page == $i){  echo "<b> $i </b>";  }
                   else {  echo "<a href='main.php?".(isset($track) ? "track=".$track."&" : "")."page=$i'> $i </a>"; }
               }
               if($page < $total_page) echo "<a href='main.php?".(isset($track) ? "track=".$track."&" : "")."page=$total_page'>마지막</a>";
               ?>
               </div>
            </div>
        </div>
    </body>
</html>
