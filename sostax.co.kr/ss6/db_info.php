<?php
// Connect DB & CONNECTION STANDARD
$http_host = $_SERVER['HTTP_HOST'];
if($http_host=="localhost")
    $connect = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
else
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

?>