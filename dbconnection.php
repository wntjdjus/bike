<?
function dbconn(){
$host_name="localhost";
$db_user_id ="root";
$db_name="sobike";
$db_pw="autoset";
$connect = mysqli_connect($host_name, $db_user_id, $db_pw, $db_name);
#$connect=@mysql_connect($host_name, $db_user_id, $db_pw);
#mysqli_query("set names utf8", $connect);
#mysqli_select_db($db_name, $connect);
/* Set to UTF-8 Encoding */
mysqli_query($connect, 'set session character_set_connection=utf8;');
mysqli_query($connect, 'set session character_set_results=utf8;');
mysqli_query($connect, 'set session character_set_client=utf8;');
if(!$connect)die("연결에 실패".mysqli_error());
return $connect;
}

//에러메세지 출력
function Error($msg)
{
  echo"
  <script>
  window.alert('$msg');
  history.back(1);
  </script>
  ";
  exit; //위 에러 메세지만 띄우기
}
?>
