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

    $bikename=$_POST['bikename'];
    $info=$_POST['info'];
    $userid=$_SESSION['userid'];

    $query="INSERT into bike(bikename, info, shared, ownerid) values('$bikename','$info',0,'$userid')";
    mysqli_query($connect, $query);

    //$query="UPDATE holder h, bike b SET h.bike_id = $bikeid WHERE h.holder_id = $holderid AND h.bike_id is NULL AND b.bike_id = $bikeid";
    //mysqli_query($connect, $query);

    echo("<script>location.replace('./title.php');</script>");
 ?>
