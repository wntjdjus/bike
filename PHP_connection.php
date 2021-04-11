<?php

$con=mysqli_connect("localhost","root","autoset","sobike");

if(mysqli_connect_errno($con))
{
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

mysqli_set_charset($con,"utf-8");

$res = mysqli_query($con,"select * from HumanInfo;");

$result = array();

while($row = mysqli_fetch_array($res)){
    array_push($result,
              array('id'=>$row[0],'name'=>$row[1],'address'=>$row[2]
                   ));
}

echo json_encode(array("result"=>$result));

mysqli_close($con);

?>
