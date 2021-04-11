<?php
  $connect = mysqli_connect("localhost", "root", "autoset", "sobike");

  $id = $_POST["id"];


  $response = array();




  echo json_encode($response);
?>
