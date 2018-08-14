<?php
	session_start();
	$user_id = $_COOKIE['user_id'];
	$a_href = "#";
	$a_class = "navbar-brand";
	$style = "color:blue;";
	//输出为js语句，本系统中cookie名与用户id相同(user_id)
	echo "document.write('<a href=$a_href class=$a_class style=$style>{$user_id}</a>')";
?>
