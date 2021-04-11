<?php
  $con = mysqli_connect("localhost", "root", "autoset", "sobike");

  $userID = $_POST["userID"];
  $bikeID = $_POST["bikeID"];

  $statement = mysqli_prepare($con, "UPDATE USER SET bike_id = ? WHERE userid = ?");
  mysqli_stmt_bind_param($statement, "is", intval($bikeID), $userID);
  mysqli_stmt_execute($statement);

  $query="UPDATE holder SET bike_id = NULL WHERE bike_id = $bikeID";

  mysqli_query($con, $query);


  $response = array();
  $response["success"] = true;

  echo json_encode($response);
 ?>
