<?php
// Connect DB & CONNECTION STANDARD
$connect = @mysql_connect ( "db.sostax.kr:3306", "sschina", "shinseung1@" ) or die ( "DB접속에러" );
mysql_query ( "SET NAMES UTF8" ); // UTF-8 ENCODING

mysql_query ( "set session character_set_connection=utf8mb4;" );
mysql_query ( "set session character_set_results=utf8mb4;" );
mysql_query ( "set session character_set_client=utf8mb4;" );

// Select DB
@mysql_select_db ( "dbsschina", $connect ) or die ( "DB선택에러" );

// END OF Connect

?>