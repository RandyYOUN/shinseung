<?php
// Connect DB & CONNECTION STANDARD
//$connect = @mysqli_connect ( "db.sostax.kr:3306", "sschina", "shinseung1@" ) or die ( "DB접속에러" );
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306") or die ( "DB접속에러" );//url에 action이라는 값이 "추가" 라면
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
/*
mysqli_query ( "SET NAMES UTF8" ); // UTF-8 ENCODING

mysqli_query ( "set session character_set_connection=utf8mb4;" );
mysqli_query ( "set session character_set_results=utf8mb4;" );
mysqli_query ( "set session character_set_client=utf8mb4;" );
*/
// Select DB
//@mysqli_select_db ( "dbsschina", $connect ) or die ( "DB선택에러" );

// END OF Connect

?>