<?php
  $con = mysqli_connect("localhost", "root", "autoset", "sobike");

  $userID = $_POST["userID"];
  $bikeID = $_POST["bikeID"];

  $statement = mysqli_prepare($con, "UPDATE USER SET bike_id = null WHERE userid = ?");
  mysqli_stmt_bind_param($statement, "s", $userID);
  mysqli_stmt_execute($statement);

  $statement1 =  mysqli_prepare($con, "UPDATE holder SET bike_id = ? WHERE bike_id is null");
  mysqli_stmt_bind_param($statement1, "i", intval($bikeID));
  mysqli_stmt_execute($statement1);

  $response = array();
  $response["success"] = true;

  echo json_encode($response);
 ?>
