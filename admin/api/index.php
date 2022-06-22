<?php

//$connect = mysqli_connect("", "", "","dbsschina","3306");
//$select = "SELECT * FROM dbsschina.;";
//$result = mysqli_query($connect,$query) or die(mysqli_error($connect));


$db_conn = @mysqli_connect("211.43.203.77", "sschina", "shinseung1@", "dbsschina");

$query = "SELECT * FROM COMP_SERVER";
$result = mysqli_query($db_conn, $query);
	
if ( $result ) {
    echo "조회된 행의 수 : ".mysqli_num_rows($result)."<br />";

    while ($row = mysqli_fetch_assoc($result)) {
        printf ("%s : %s <br />", $row["CODE"], $row["COMP_NAME"]);
    }

    // 결과 해제
    mysqli_free_result($result);

} else {
    echo "Error : ".mysqli_error($db_conn);
}

mysqli_close($db_conn);

// phpinfo()
 // xdebug_info()


?>