<?php
	session_start();

	//若cookie存在，无操作；否则跳转报错
	if(isset($_COOKIE['user_id']))
	{
		;
	}
	else
	{
		echo "window.location.href='no_authority.html'";
	}
	
?>
