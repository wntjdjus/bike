<?php
  //session_start();
  if(!isset($_SESSION['userid'])) //세션이 존재하지 않을 때
  {
      header ('Location: ./login.html');
  }
 ?>

<html>
<head>
<title>자전거 반납</title>
</head>
<body>
  <?
      include("./dbconnection.php");
      $connect=dbconn();
  ?>
  <form action='./return_post.php' name='review_table' method='post'>
<br>
<br>
<CENTER>자전거 반납</b></div><br>
<form action="" method="post">
<label>대여존ID : </label><input type="text" name="zoneid" class="box"/><br>
<label>거치대ID : </label><input type="text" name="holderid" class="box"/><br>
<label>반납시간 : </label>
                  <input type="text" name="endtime" class="box"/>
                  </br>

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

          //$query="SELECT * FROM share as s, bike as b where b.ownerid = '$_SESSION['userid']' and s.bikeid = b.bikeid";
          $query="SELECT * FROM reservation";
          //$query = 'SELECT * FROM bike WHERE ownerid = '$userid'';
          $result = mysqli_query($conn, $query);

          echo '<table class="text-center"><tr>' .
              '<th>대여자ID</th>
              <th>대여존ID</th>
              <th>거치대ID</th>
              <th>시작시간</th>
              <th>종료시간</th>' .
              '</tr>';
          while( $row = mysqli_fetch_array($result) ) {
              echo '<tr>' .
              '<td>' . $row['userid'] . '</td>' .
              '<td>' . $row['zoneid'] . '</td>' .
              '<td>' . $row['holderid'] . '</td>' .
              '<td>' . $row['starttime'] . '</td>' .
              '<td>' . $row['endtime'] . '</td>' .
              '</tr>';
          }
          echo '<br />';
          echo '</table>';

          echo "<a href=title.php>뒤로가기</a>";

          mysqli_close($conn);
      ?>
</body>

</html>
