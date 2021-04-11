<?php
  //session_start();
  if(!isset($_SESSION['userid'])) //세션이 존재하지 않을 때
  {
      header ('Location: ./login.html');
  }
  echo '<center><td>아이디 : ' . $_SESSION['userid']. '</td>';
 ?>
<html>
<head>
<title>자전거 예약 대여 시스템 서버</title>
</head>
<body>
  <br>

  <CENTER>추가 항목 선택</b></div><br>
  <form action='./holder_main.php' name='review_table' method='post'>
    <br>
    <center><input type="submit" value="거치대추가"/><br />
  </form>
  <form action='./zone_main.php' name='review_table' method='post'>
    <br>
    <center><input type="submit" value="대여존추가"/><br /><br />
  </form>
  <form action='./bikeup_main.php' name='review_table' method='post'>
    <br>
    <center><input type="submit" value="자전거등록"/><br />
  </form>
  <form action='./share_main.php' name='review_table' method='post'>
    <br>
    <center><input type="submit" value="자전거 공유"/><br />
  </form>
  <form action='./endshare_main.php' name='review_table' method='post'>
    <br>
    <center><input type="submit" value="자전거 공유 종료"/><br /><br />
  </form>
  <form action='./reservation_main.php' name='review_table' method='post'>
    <br>
    <center><input type="submit" value="자전거예약"/><br />
  </form>
  <form action='./return_main.php' name='review_table' method='post'>
    <br>
    <center><input type="submit" value="자전거반납"/><br />
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
            $query = 'SELECT * FROM bike WHERE ownerid is not null';
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

            /* Load data */
            $query = 'SELECT * FROM holder as h, zone as z where h.zoneid = z.zoneid';
            $result = mysqli_query($conn, $query);

            echo '<table class="text-center"><tr>' .
                '<th>대여존이름</th>
                <th>거치대번호</th>
                <th>자전거</th>' .
                '</tr>';
            while( $row = mysqli_fetch_array($result) ) {
                echo '<tr><td>' . $row['zonename'] . '</td>' .
                    '<td>' . $row['holderid'] . '</td>' .
                    '<td>' . $row['bikeid'] . '</td></tr>';
            }
            echo '<br />';
            echo '</table>';

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

            echo "<a href=intro.php>메인화면으로</a>";

            mysqli_close($conn);
        ?>
</body>
</html>
