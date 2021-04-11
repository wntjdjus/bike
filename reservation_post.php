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

    $userid=$_SESSION['userid'];
    $bikeid=$_POST['bikeid'];
    $start=$_POST['starttime'];
    $end=$_POST['endtime'];

    if($start >= $end) {
      echo "시간 설정이 잘못되었습니다.";
      echo "<a href=reservation_main.php>back page</a>";
      exit();
    }
    $query = "SELECT * FROM share WHERE bikeid = '$bikeid'";
    $result = mysqli_query($connect, $query);
    while($row = mysqli_fetch_array($result)) {
      if($start >= $row['starttime'] and $end <= $row['endtime']) {
        $zoneid=$row['zoneid'];
        $holderid=$row['holderid'];
        $query2 = "SELECT * FROM reservation WHERE zoneid = '$zoneid' AND holderid = '$holderid'";
        $result2 = mysqli_query($connect, $query2);
        while($row2 = mysqli_fetch_array($result2)) {
          if($start < $row2['endtime'] and $end > $row2['starttime']) {
            echo "이미 그 시간에 예약한 사람이 있습니다.";
            echo "<a href=reservation_main.php>back page</a>";
            exit();
          }
        }
        $query3 = "INSERT INTO reservation(userid, zoneid, holderid, starttime, endtime)
                  values('$userid','$zoneid','$holderid','$start','$end')";
        mysqli_query($connect, $query3);
        echo("<script>location.replace('./title.php');</script>");
      }
    }
    echo "그 시간에 공유된 자전거가 없습니다.";
    echo "<a href=reservation_main.php>back page</a>";
 ?>

 <script>
 windows.alert('DB로 전송 완료 !');
 location.href='./holder_main.php';
 </script>
