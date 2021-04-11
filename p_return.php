<?php
  $connect = mysqli_connect("localhost", "root", "autoset", "sobike");

  $flag = $_POST["flag"];
  $userid = $_POST["id"];
  $currentime = date("Y-m-d H:i:s");
  $temp = strtotime("+5 minute", strtotime($currentime));
  $time = date("Y-m-d H:i:s", $temp);

  $response["success"] = false;

  /* Set to UTF-8 Encoding */
  mysqli_query($connect, 'set session character_set_connection=utf8;');
  mysqli_query($connect, 'set session character_set_results=utf8;');
  mysqli_query($connect, 'set session character_set_client=utf8;');

  if($flag == 0) {
    $query = "SELECT * FROM reservation WHERE userid = '$userid' and starttime <= '$time' and endtime >= '$time'";
    $result = mysqli_query($connect, $query);
    while($row = mysqli_fetch_array($result)) {
      $zoneid = $row['zoneid'];
      $holderid = $row['holderid'];
      $query2 = "UPDATE holder SET rent = 0 WHERE holderid = '$holderid' and zoneid = '$zoneid'";
      $result2 = mysqli_query($connect, $query2);
      $query3 = "DELETE FROM reservation WHERE userid = '$userid' and starttime <= '$time' and endtime >= '$time'";
      $result3 = mysqli_query($connect, $query3);
      if($result3) {
        $response["success"] = true;
      }
    }
  }

echo json_encode($response);
?>
