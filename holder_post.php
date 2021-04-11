<?php
    session_start();
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

    $zoneid=$_POST['zoneid'];

    $query="SELECT * FROM `holder` where zoneid = '$zoneid'";
    $result=mysqli_query($connect, $query);
    $n = 1;
    while($data_row = mysqli_fetch_array($result)) {
      $n++;
    }
    $query = "INSERT INTO holder(holderid, zoneid) values('$n', '$zoneid')";
    mysqli_query($connect, $query);
    echo("<script>location.replace('./title.php');</script>");
 ?>

 <script>
 windows.alert('DB로 전송 완료 !');
 location.href='./holder_main.php';
 </script>
