<?php
//system("echo '940428' | sudo -S su", $status);//只有失败的时候返回NULL
//echo $status;
    $username=$_POST["username"];
    $password=$_POST["password"];
    $ip=$_POST["ip"];
    if(!function_exists("ssh2_connect")){
        echo ('SSH extention not found!');
    }
    $connection=ssh2_connect($ip, 22);
    if(!$connection){
        echo ("connect failed!");
    }
    if(!ssh2_auth_password($connection,$username,$password)){
        echo "auth failed!";
    }

    $cmd = "echo $password | sudo -S ./imm_video_server.sh";
    $stream = ssh2_exec($connection, $cmd);
    $dio_stream = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);  //获得标准输入输出留
    $err_stream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);  //获得错误输出留
    stream_set_blocking($err_stream, true);
    stream_set_blocking($dio_stream, true);
    $result_dio = stream_get_contents($dio_stream); //获取流的内容，即命令的返回内容

    //echo "result_err: $result_err result_dio: $result_dio";
    if($result_dio == "")
	echo "failed";
    else
    {
	$conn = mysqli_connect("localhost", "root", "940428");
	if(! $conn )
	{
	    echo ('连接失败: ' . mysqli_error($conn));
	}
	mysqli_select_db( $conn, 'users');
	// 设置编码，防止中文乱码
	mysqli_query($conn , "set names utf8");

	$sql = "update server_info set server_status='on' where ip='$ip'";

	$retval = mysqli_query($conn, $sql );
	if(! $retval)
	{
	    echo ('无法更新数据:'.mysqli_error($conn));
	}
        else 
	    echo "ok";
    }

?>
