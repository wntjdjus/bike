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

    $zoneid=$_POST['zoneid'];
    $holderid=$_POST['holderid'];
    $end=$_POST['endtime'];

    $query = "DELETE from reservation where zoneid = '$zoneid' AND holderid = '$holderid' AND endtime = '$end'";
    $result = mysqli_query($connect, $query);
    echo("<script>location.replace('./title.php');</script>");
 ?>

 <script>
 windows.alert('DB로 전송 완료 !');
 location.href='./holder_main.php';
 </script>
