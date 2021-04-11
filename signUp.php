<?php
$id=$_POST['id'];
$pw=$_POST['pw'];
$pwc=$_POST['pwc'];
$name=$_POST['name'];
$phone=$_POST['phone'];

if($pw!=$pwc) //비밀번호와 비밀번호 확인 문자열이 맞지 않을 경우
{
    echo "비밀번호와 비밀번호 확인이 서로 다릅니다.";
    echo "<a href=signUp.html>back page</a>";
    exit();
}
if($id==NULL || $pw==NULL || $name==NULL || $phone==NULL) //
{
    echo "빈 칸을 모두 채워주세요";
    echo "<a href=signUp.html>back page</a>";
    exit();
}

$mysqli=mysqli_connect("localhost","root","autoset","sobike");

$check="SELECT *from user WHERE userid='$id'";
$result=$mysqli->query($check);
if($result->num_rows==1)
{
    echo "중복된 id입니다.";
    echo "<a href=signUp.html>back page</a>";
    exit();
}

$signup=mysqli_query($mysqli,"INSERT INTO user (userid,userpw,username,phone)
VALUES ('$id','$pw','$name','$phone')");
if($signup){
    echo "sign up success";
    echo "<a href=intro.php>초기화면으로</a>";
}

?>
