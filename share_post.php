<?php
    //session_start();
    if(!isset($_SESSION['userid'])) //세션이 존재하지 않을 때
    {
        header ('Location: ./login.html');
    }
    #include './dbconnection.php';
    #$connect=dbconn();

    $connect = mysqli_connect('localhost', 'root', 'autoset', 'sobike');
    if ( !$connect ) die('DB Error');

    /* Set to UTF-8 Encoding */
    mysqli_query($connect, 'set session character_set_connection=utf8;');
    mysqli_query($connect, 'set session character_set_results=utf8;');
    mysqli_query($connect, 'set session character_set_client=utf8;');

    $bikeid=$_POST['bikeid'];
    $zoneid=$_POST['zoneid'];
    $holderid=$_POST['holderid'];
    $start=$_POST['starttime'];
    $end=$_POST['endtime'];

    $query = "SELECT * FROM bike WHERE bikeid = '$bikeid'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    if($_SESSION['userid'] != $row['ownerid']) {
      echo "다른 유저의 자전거입니다..";
      echo "<a href=share_main.php>back page</a>";
      exit();
    }
    if($start >= $end) {
      echo "시간 설정이 잘못되었습니다.";
      echo "<a href=share_main.php>back page</a>";
      exit();
    }
    $query = "SELECT * FROM share WHERE zoneid = '$zoneid' AND holderid = '$holderid'";
    $result = mysqli_query($connect, $query);
    while( $row = mysqli_fetch_array($result) ) {
      if($start < $row['endtime'] and $end > $row['starttime']) {
        echo "이미 그 시간에 공유된 자전거가 있습니다.";
        echo "<a href=share_main.php>back page</a>";
        exit();
      }
    }
    $query = "SELECT * FROM share WHERE bikeid = '$bikeid'";
    $result = mysqli_query($connect, $query);
    while( $row = mysqli_fetch_array($result) ) {
      if($start < $row['endtime'] and $end > $row['starttime']) {
        echo "이미 그 시간에 자전거가 다른 거치대에서 공유되고 있습니다.";
        echo "<a href=share_main.php>back page</a>";
        exit();
      }
    }
    $query = "INSERT INTO share(bikeid, zoneid, holderid, starttime, endtime)
              values('$bikeid','$zoneid','$holderid','$start','$end')";
    mysqli_query($connect, $query);
    echo("<script>location.replace('./title.php');</script>");
 ?>

 <script>
 windows.alert('DB로 전송 완료 !');
 location.href='./holder_main.php';
 </script>
