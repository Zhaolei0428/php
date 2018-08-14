<?php
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
?>


<!doctype html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <title>用户状态监控</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="mycss/show_data.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <h2>当前服务状态</h2>
      <table class="table table-hover"><tr><th>id</th><th>password</th><th>server</th><th>time</th></tr>
      <?php
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
        {
          echo "<tr><td> {$row['username']}</td> ".
                   "<td>{$row['password']} </td> ".
                   "<td>{$row['server']} </td> ".
                   "<td>{$row['video_process']} </td> ".
                   "</tr>";
        }
        mysqli_close($conn);
      ?>
      </table>
      <!--页面自动刷新 -->
      <script type="text/javascript">
        function fresh_page()   
        {
          window.location.reload();
        }
        setTimeout('fresh_page()',5000); 
      </script>
</html>

