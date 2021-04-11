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

    $zonename=$_POST['zonename'];
    $address=$_POST['address'];
    $zonelat=$_POST['lat'];
    $zonelng=$_POST['lng'];

    $query="INSERT into zone(zonename, address, lat, lng) values('$zonename', '$address', '$zonelat', '$zonelng')";
    #mysqli_query("set names utf8", $connect);
    #mysqli_query($query, $connect);
    #$result=$mysqli->query($check);
    mysqli_query($connect, $query);

    echo("<script>location.replace('./title.php');</script>");
 ?>

 <script>
 windows.alert('DB로 전송 완료 !');
 location.href='./zone_main.php';
 </script>
