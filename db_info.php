<?php
// Connect DB & CONNECTION STANDARD
$http_host = $_SERVER['HTTP_HOST'];
if($http_host=="localhost")
    $connect = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
    else
        $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
        //( "db.sostax.kr:3306", "sschina", "shinseung1@" )
        
        //echo 'http_host = '.$http_host;
        // Select DB
        //@mysqli_select_db ( "dbsschina", $connect ) or die ( "DB선택에러" );
        
        // END OF Connect
        
        ?>