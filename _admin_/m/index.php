<?php
include "db_info.php";
include "session_inc.php";
   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
//session_cache_expire(360);
session_start();

//if($jb_login == false){
	$str = "";
	$str .= '<script>';
	$str .= 'document.location.replace("main.php");</script>';

	echo $str;
//}

?>