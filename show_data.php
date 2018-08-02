<?php
$dbhost = 'localhost';  // mysql服务器主机地址
$dbuser = 'root';            // mysql用户名
$dbpass = '940428';          // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "users");
if(! $conn )
{
    die('连接失败: ' . mysqli_error($conn));
}
// 设置编码，防止中文乱码
mysqli_query($conn , "set names utf8");
 
$sql = 'SELECT * from userinfo';
 
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('无法读取数据: ' . mysqli_error($conn));
}

//显示页面
echo '<h2>当前服务状态<h2>';
echo '<table border="1"><tr><td>id</td><td>password</td><td>server</td><td>time</td></tr>';
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
    echo "<tr><td> {$row['username']}</td> ".
         "<td>{$row['password']} </td> ".
         "<td>{$row['server']} </td> ".
         "<td>{$row['video_process']} </td> ".
         "</tr>";
}
echo '</table>';
mysqli_close($conn);
#$username = 'evil';
#setcookie("username", $username, time()+24*60*60);

//页面自动刷新
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
echo ("setTimeout('fresh_page()',5000);");      
echo ("</script>");
?>
