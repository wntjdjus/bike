<?php
  //session_start();
  if(!isset($_SESSION['userid'])) //세션이 존재하지 않을 때
  {
      header ('Location: ./login.html');
  }
 ?>

<html>
<head>
<title>거치대추가</title>
</head>
<body>
  <?
      include("./dbconnection.php");
      $connect=dbconn();
  ?>
  <form action='./holder_post.php' name='review_table' method='post'>
<br>
<br>
<CENTER>거치대 추가</b></div><br>
<form action="" method="post">
<label>대 여 존 : </label><input type="text" name="zoneid" class="box"/></br>
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
          $query = 'SELECT * FROM zone';
          $result = mysqli_query($conn, $query);

          echo '<table class="text-center"><tr>' .
              '<th>대여존ID</th>
              <th>대여존이름</th>
              <th>주소</th>
              <th>위도</th>
              <th>경도</th>' .
              '</tr>';
          while( $row = mysqli_fetch_array($result) ) {
              echo '<tr><td>' . $row['zoneid'] . '</td>' .
                  '<td>' . $row['zonename'] . '</td>' .
                  '<td>' . $row['address'] . '</td>' .
                  '<td>' . $row['lat'] . '</td>' .
                  '<td class="text-right">' . $row['lng'] . '</td></tr>';
          }

          echo '</br />';
          echo '</table>';

          echo "<a href=title.php>뒤로가기</a>";

          mysqli_close($conn);
      ?>
</body>

</html>
