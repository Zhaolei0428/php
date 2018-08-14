<?php
header("content-type:text/html; charset=utf-8");
$dbhost = 'localhost';  // mysql服务器主机地址
$dbuser = 'root';            // mysql用户名
$dbpass = '940428';          // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "users");
if(! $conn )
{
    die('连接失败: ' . mysqli_error($conn));
}
//设置编码，防止中文乱码
mysqli_query($conn , "set names utf8");
 
$sql = 'SELECT * from userinfo';
 
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('无法读取数据: ' . mysqli_error($conn));
}

$i = 0;
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
         $arr = array(
             "username"=>$row['username'],
             "password"=>$row['password'],
             "server"=>$row['server'],
             "video_process"=>$row['video_process']
         );
         $data[$i] = $arr;
         $i = $i + 1;
}
        mysqli_close($conn);
echo json_encode($data);
?>

