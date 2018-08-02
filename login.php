<?php
	//获取用户提交数据
	$id = $_POST["user_id"];
	$password = $_POST["password"];
	$cookie = $_POST["cookie"];

	//连接数据库
	$connection = mysqli_connect("localhost", "root", "940428", "users");
	if(!$connection)
	{
		die("Connection failed! " . mysqli.error());
	}

	//设置编码，防止中文乱码
	mysqli_query($connection, "set names utf8");


	//查询语句
	$sql = "select * from userinfo where username = '$id' and password = '$password'";
//	echo 0;

	//查询数据库
	$result = mysqli_query($connection, $sql);

	//检查用户权限
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$user_id = $row["username"];
			$user_password = $row["password"];

			//如果校验通过，分配cookie并执行跳转			
			if(($id == $user_id)&&($password == $user_password))
			{
				switch($cookie)
				{
					case 0: 
						setcookie("user_id", $row['username']);
						break;
					case 1:
						setcookie("user_id", $row['username'], time()+24*60*60);
						break;
					case 2:
						setcookie("user_id", $row['username'], time()+30*24*60*60);
						break;
					case 3:
						setcookie("user_id", $row['username'], time()+365*24*60*60);
						break;							
				}
				header("refresh:0;url=welcome.html");
				exit;
			}
			//否则报错
			else
			{
				echo "用户名或密码有误！";
			}
		}
	}
	else
	{
		echo "用户名或密码有误！";
	}	

	mysqli_close($connection);

?>
