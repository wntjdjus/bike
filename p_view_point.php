<?php
  $connect = mysqli_connect("localhost", "root", "autoset", "sobike");

  $query = "SELECT * FROM zone";
  $result = mysqli_query($connect, $query);
  $response = array();
  $n = 0;

  while( $row = mysqli_fetch_array($result) ) {
    $response[$n]["zoneid"] = $row['zoneid'];
    $response[$n]["zonename"] = $row['zonename'];
    $response[$n]["address"] = $row['address'];
    $response[$n]["lat"] = $row['lat'];
    $response[$n]["lng"] = $row['lng'];
    $n = $n + 1;
  }

  echo json_encode($response);
?>
