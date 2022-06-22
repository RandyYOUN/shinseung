<?php
header('Content-Type: application/json; charset=UTF-8');
$won_enter = 12000001;
echo $won_enter .'<br>';

if($won_enter > 12000000)
    $won_enter = floor( mt_rand(11850000,12000000) / 10 ) * 10 ;

    
    echo $won_enter;
?>