<?php
  $con = mysqli_connect("localhost", "root", "autoset", "sobike");

  $userID = $_POST["id"];
  $userPassword = $_POST["password"];
  $userName = $_POST["name"];
  $userPhone = $_POST["phone"];

  $statement = mysqli_prepare($con, "SELECT * FROM user WHERE userid = ?");
  mysqli_stmt_bind_param($statement, "s", $userID);
  mysqli_stmt_execute($statement);

  $data = mysqli_stmt_get_result($statement);

  $response = array();
  $response["errorcode"] = 0;

  if (mysqli_num_rows($data) > 0) {
    $response["success"] = false;
    $response["errorcode"] = 1;
  }
  else {
    $statement1 = mysqli_prepare($con, "INSERT INTO user VALUES (?, ?, ?, ?, null)");
    mysqli_stmt_bind_param($statement1, "ssss", $userID, $userPassword, $userName, $userPhone);
    mysqli_stmt_execute($statement1);

    $response["success"] = true;
  }

  echo json_encode($response);
 ?>
