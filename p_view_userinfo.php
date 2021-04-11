<?php
  $connect = mysqli_connect("localhost", "root", "autoset", "sobike");

  $userid = $_POST['id'];

  $query = "SELECT * FROM user WHERE userid = '$userid'";
  $result = mysqli_query($connect, $query);
  $response = array();
  $n = 1;

  while( $row = mysqli_fetch_array($result) ) {
    $response[0]["phone"] = $row['phone'];
  }

  $query2 = "SELECT * FROM reservation as r, zone as z WHERE r.userid = '$userid' and z.zoneid = r.zoneid";
  $result2 = mysqli_query($connect, $query2);

  while( $row = mysqli_fetch_array($result2) ) {
    //$response[$n]["userid"] = $row['userid'];
    $response[$n]["zonename"] = $row['zonename'];
    $response[$n]["holderid"] = $row['holderid'];
    $response[$n]["starttime"] = $row['starttime'];
    $response[$n]["endtime"] = $row['endtime'];
    $n = $n + 1;
  }

  echo json_encode($response);
?>
