<?php
  //session_start();
  if(!isset($_SESSION['userid'])) //세션이 존재하지 않을 때
  {
      header ('Location: ./login.html');
  }
 ?>

<html>
<head>
<title>대여존추가</title>
</head>
<body>
  <?
      include("./dbconnection.php");
      $connect=dbconn();
  ?>
  <form action='./zone_post.php' name='review_table' method='post'>
<br>
<br>
<CENTER>DB로 전송할 값 입력받기</b></div><br>
<form action="" method="post">
<label>이    름 : </label><input type="text" name="zonename" class="box"/></br>
<label>주    소 : </label><input type="text" name="address" class="box"/></br>
<label>위    도 : </label><input type="text" name="lat" class="box"/></br>
<label>경    도 : </label><input type="text" name="lng" class="box"/></br>
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
