<?php
    $connect = mysqli_connect('localhost', 'root', 'autoset', 'sobike');
    if ( !$connect ) die('DB Error');

    /* Set to UTF-8 Encoding */
    mysqli_query($connect, 'set session character_set_connection=utf8;');
    mysqli_query($connect, 'set session character_set_results=utf8;');
    mysqli_query($connect, 'set session character_set_client=utf8;');

    $userid=$_POST['id'];
    $zoneid=$_POST['zoneid'];
    $holderid=$_POST['holderid'];
    $start=$_POST['starttime'];
    $end=$_POST['endtime'];

    $query = "INSERT INTO reservation(userid, zoneid, holderid, starttime, endtime)
              values('$userid','$zoneid','$holderid','$start','$end')";
    $result = mysqli_query($connect, $query);
    if(!$result) {
      $response["success"] = false;
    }
    else {
      $response["success"] = true;
    }

  echo json_encode($response);
 ?>
