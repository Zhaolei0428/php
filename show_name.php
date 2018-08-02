<?php
	session_start();
	$user_id = $_COOKIE['user_id'];
	
	//输出为js语句，本系统中cookie名与用户id相同(user_id)
	echo "document.write('<p>{$user_id}，欢迎你！</p>')";
?>
