<?php
  $con = mysqli_connect("localhost", "root", "autoset", "sobike");

  $userID = $_POST["userid"];
  $userPassword = $_POST["password"];

  $statement = mysqli_prepare($con, "SELECT * FROM user WHERE userid = ? AND userpw = ?");
  mysqli_stmt_bind_param($statement, "ss", $userID, $userPassword);
  mysqli_stmt_execute($statement);

  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $userId, $userPassword, $userName, $phone, $bikeid);

  $response = array();
  $response["success"] = false;

  while(mysqli_stmt_fetch($statement)){
    $response["success"] = true;
    $response["userName"] = $userName;
  }

  echo json_encode($response);
?>
