<?php
//session_start();
if(!isset($_SESSION['userid'])) //세션이 존재하지 않을 때
{
    header ('Location: ./login.html');
}

echo "홈(로그인 성공)";

echo "<a href=title.php>자전거 대여 시스템 시작</a>";

echo "<a href=logout.php>로그아웃</a>";

?>
