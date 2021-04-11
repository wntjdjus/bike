<?php
  $connect = mysqli_connect("localhost", "root", "autoset", "sobike");

  $start = $_POST["start"];
  $end = $_POST["end"];
  $zoneid = $_POST["zoneid"];

  $response = array();
  $n = 0;

  $query = "SELECT * FROM share WHERE zoneid = '$zoneid' and starttime <= '$start' and endtime >= '$end'";
  $result = mysqli_query($connect, $query);
  while($row = mysqli_fetch_array($result)) {
    $zoneid = $row['zoneid'];
    $holderid = $row['holderid'];
    $query2 = "SELECT * FROM reservation WHERE zoneid = '$zoneid' and holderid = '$holderid' and starttime < '$end' and endtime > '$start'";
    $result2 = mysqli_query($connect, $query2);
    $t = 0;
    while($row2 = mysqli_fetch_array($result2)) {
      $t = 1;
      break;
    }
    if($t == 0) {
      $response[$n]["bikeid"] = $row['bikeid'];
      $response[$n]["zoneid"] = $row['zoneid'];
      $response[$n]["holderid"] = $row['holderid'];
      $n = $n + 1;
    }
  }

  echo json_encode($response);
?>
