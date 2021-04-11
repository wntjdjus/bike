<?php
  $connect = mysqli_connect("localhost", "root", "autoset", "sobike");

  $id = $_POST["id"];
  $starttime = $_POST["start"];

  $query = "DELETE FROM reservation WHERE userid = '$userid' and starttime = '$starttime'";
  $result = mysqli_query($connect, $query);
  
  if($result) {
    $response["success"] = true;
  }
  else {
    $response["success"] = false;
  }

  echo json_encode($response);
?>
