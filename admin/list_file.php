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
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )
$id = $_GET["id"];
$path = "../tax_income/upload/";
$ignore = array(',','..');


if(isset($id))
{
	$procedure = "
		CREATE PROCEDURE selectFILES()
		BEGIN
			SELECT * FROM TB100020 WHERE CSTID = '".$id."';
		END;
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectFILES"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL selectFILES()";
				//프로시저 호출
				$result = mysqli_query($connect,$query);

				if(mysqli_num_rows($result) >0)
				{					
					while($row = mysqli_fetch_array($result)){
					    $iconv_cstname = iconv("UTF-8","cp949",$row["CSTNAME"]);
						$MOBILE = $row["MOBILE"];
						$dir = $path.$iconv_cstname."_".$MOBILE."/";
						//$down_dir = iconv("UTF-8","EUC-KR","../tax_income/upload/".$CSTNAME."_".$MOBILE."/");
						$down_dir = "../tax_income/upload/".$iconv_cstname."_".$MOBILE."/";
						//$dir = iconv("UTF-8","EUC-KR",$dir);

						if (is_dir($dir)){                              
						  if ($dh = opendir($dir)){                     //$df = array_diff(scandir($dir),$ignore);
							while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
									continue;
	     						}else{
									echo "<tr><td><a href='".$down_dir.$file . "' target=_blank>".$file."</a></td></tr>";        		
								}

							}                                           
							closedir($dh);                              
						  }                                             
						}else{
							echo 'no such dir...';
						}     


						


					}
				}

			}
		}

}

?>
</table></tbody>
</div>
</form>
</body>
</html>