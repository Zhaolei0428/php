<?php
$p=$_GET["p"];
$username=$_GET["user_id"];


$conn = mysqli_connect("localhost", "root", "940428");
if(! $conn )
{
    die('连接失败: ' . mysqli_error($conn));
}
mysqli_select_db( $conn, 'users');
// 设置编码，防止中文乱码
mysqli_query($conn , "set names utf8");

$sql = "update userinfo set video_process='$p' where username='$username'";

$retval = mysqli_query($conn, $sql );
if(! $retval)
{
    die('无法更新数据:'.mysqli_error($conn));
}
?>
