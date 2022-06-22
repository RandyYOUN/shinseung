<?php
   $ip_ck= $_SERVER["REMOTE_ADDR"];
 /*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 ADMIN</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="신승세무법인 ADMIN">
	<meta property="og:url" content="https://taxtok.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="../resources/images/sum2.png">
	<link rel="shortcut icon" href="../resources/images/icon.ico">
<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border-radius:5px;
margin-top:100px;

ol.timeline
{
list-style:none
}
ol.timeline li
{
position:relative;
border-bottom:1px #dedede dashed;
padding:8px;
}


</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 


</head>
<body>
<form method="post">
<div class="container box" style="width:400px;margin:0 0 0 50px;">
<span>
<img src="resources/images/new_logo.png">
</span>
<br><br>
<table class="table table-bordered" >
<tbody id="result">

<?php

//db연결 본인의 db 정보를 넣어준다!
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

$tmp_dir = "upload_others/trans";
$ignore = array(',','..');

function f_rename($src) { 
        $dir = opendir($src);  
        $test = '';


		while(false !== ( $file = readdir($dir)) ) 
		{  
			if (( $file != '.' ) && ( $file != '..' )) 
			{  
				if ( is_dir($src . '/' . $file) )
				{  

					//echo $src . '/' . $file.'<br>';                  		   
					//rename ( $src,iconv("UTF-8","euc-kr",$src) );
				    f_rename($src . '/' . $file); 
				}else
				{  
					//echo $src . '/' . $file.'<br>';                  		   

					//if( strpos($src,$test)!==false ){
						//rename ( $file,iconv("UTF-8","euc-kr",$file) );
						rename ( $file,iconv("UTF-8","cp949",$file) );


						echo '이름변경 ['.$file.'] -> [' .iconv("UTF-8","cp949",$file).']<br><br>';	


					//}			
				}  
			}  
		}
	
          
        closedir($dir);  
    }  
 
f_rename($tmp_dir);


?>
</table></tbody>
</div>
</form>
</body>
</html>