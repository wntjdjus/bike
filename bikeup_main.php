<?php
  //session_start();
  if(!isset($_SESSION['userid'])) //세션이 존재하지 않을 때
  {
      header ('Location: ./login.html');
  }
 ?>

<html>
<head>
<title>자전거추가</title>
</head>
<body>
  <?
      include("./dbconnection.php");
      $connect=dbconn();
  ?>
  <form action='./bikeup_post.php' name='review_table' method='post'>
<br>
<br>
<CENTER>DB로 전송할 값 입력받기</b></div><br>
<form action="" method="post">
<label>이    름 : </label><input type="text" name="bikename" class="box"/></br>
<label>정    보 : </label><input type="text" name="info" class="box"/></br>
<center><input type="submit" value="DB로 전송"/><br />

</form>
<?php
          /* Load DB */
          $conn = mysqli_connect('localhost', 'root', 'autoset', 'sobike');
          if ( !$conn ) die('DB Error');

          /* Set to UTF-8 Encoding */
          mysqli_query($conn, 'set session character_set_connection=utf8;');
          mysqli_query($conn, 'set session character_set_results=utf8;');
          mysqli_query($conn, 'set session character_set_client=utf8;');

          /* Load data */
          $userid=$_SESSION['userid'];

          $query="SELECT * FROM bike where ownerid = '$userid'";
          //$query = 'SELECT * FROM bike WHERE ownerid = '$userid'';
          $result = mysqli_query($conn, $query);

          echo '<table class="text-center"><tr>' .
              '<th>자전거ID</th>
              <th>자전거이름</th>
              <th>자전거주인</th>' .
              '</tr>';
          while( $row = mysqli_fetch_array($result) ) {
              echo '<tr>' .
              '<td>' . $row['bikeid'] . '</td>' .
              '<td>' . $row['bikename'] . '</td>' .
              '<td>' . $row['ownerid'] . '</td>' .
              '</tr>';
          }
          echo '<br />';
          echo '</table>';

          echo "<a href=title.php>뒤로가기</a>";

          mysqli_close($conn);
      ?>
</body>

</html>
