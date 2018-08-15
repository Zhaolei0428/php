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
         $arr1 = array(
             "username"=>$row['username'],
             "password"=>$row['password'],
             "server"=>$row['server'],
             "video_process"=>$row['video_process']
         );
         $user_data[$i] = $arr1;
         $i = $i + 1;
}
 
$sql = 'SELECT * from server_info';
 
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('无法读取数据: ' . mysqli_error($conn));
}

$i = 0;
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
         $arr2 = array(
             "server_name"=>$row['server_name'],
             "server_status"=>$row['server_status'],
             "ip"=>$row['ip'],
	     "username"=>$row['username'],
	     "password"=>$row['password']
         );
         $server_data[$i] = $arr2;
         $i = $i + 1;
}
     mysqli_close($conn);
$data = array(
             "server_data"=>$server_data,
	     "user_data"=>$user_data
);
echo json_encode($data);
?>

