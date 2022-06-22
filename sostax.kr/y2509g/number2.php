<html>
<body>
<?php
// Connect DB & CONNECTION STANDARD
$connect = @mysql_connect ( "db.sostax.kr:3306", "sschina", "shinseung1@" ) or die ( "DB접속에러" );
mysql_query ( "SET NAMES UTF8" ); // UTF-8 ENCODING

mysql_query ( "set session character_set_connection=utf8;" );
mysql_query ( "set session character_set_results=utf8;" );
mysql_query ( "set session character_set_client=utf8;" );

// Select DB
@mysql_select_db ( "dbsschina", $connect ) or die ( "DB선택에러" );

// END OF Connect

echo "DB Connect ok...<br>";

echo "Query Start<br>";

$result = @mysql_query("SELECT * FROM dbsschina.guests_2019 where city = 'Seoul'") or die("SQL error");

echo "Query ing...<br>";

while ($row = mysql_fetch_array($result)) {

       echo "'" .  $row["id"] . "','" . $row["name"] . "','" . $row["profile"] . "'";
	   echo "<br>";

}


?>


</body>
</html>