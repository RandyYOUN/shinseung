<?php

setlocale(LC_ALL,'ko_KR.UTF-8');
 /*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 CRM</title>
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
//
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
$http_host = $_SERVER['HTTP_HOST'];
if($http_host=="localhost")
    $connect = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
else
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )
$id = $_GET["id"];
$year = $_GET["year"];
$year_path = $year+1;
$path = "../tax_income/upload/$year_path/강남/안내문/";

if(isset($id))
{
	$procedure = "
		CREATE PROCEDURE selectFILES()
		BEGIN
			SELECT *,
            CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
            substring( REPLACE(A.MOBILE,'-',''),4) AS 'MOBILE_PATH'
            FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B
            ON A.CSTID = B.CSTID WHERE A.CSTID = '".$id."';
		END;
		";
	$hostname=$_SERVER["HTTP_HOST"];
	
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
					    //실서버
					    
					    //if($hostname=="localhost")
					        //$iconv_cstname = $row["REG_BRANCH_PATH"]."/안내문/".$row["CSTNAME"];
					    $iconv_cstname = $row["CSTNAME"];
					    //else
					      //  $iconv_cstname = iconv("UTF-8","CP949",$row["REG_BRANCH_PATH"]."/안내문/".$row["CSTNAME"]);
					    

						$MOBILE = $row["MOBILE_PATH"];
						$dir = $path.$iconv_cstname.$MOBILE."/";
						//$down_dir = iconv("UTF-8","EUC-KR","../tax_income/upload/".$CSTNAME."_".$MOBILE."/");
						$down_dir = $path.$row["CSTNAME"].$MOBILE."/" ;
						//$dir = iconv("UTF-8","EUC-KR",$dir);
						
						//getFiles($dir);

						if (is_dir($dir)){                              
						  if ($dh = opendir($dir)){                     //$df = array_diff(scandir($dir),$ignore);
							while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
									continue;
	     						}else{
	     						    //echo mb_detect_encoding($file, 'auto'); // 자동 감지
	     						    
	     						    //if($hostname=="localhost")
	     						        $file_name = $file;
     						        //else
     						          //  $file_name = iconv("EUC-KR","UTF-8",$file);
	     						            
	     						    echo "<tr><td><a href='javascript:down(\"".$file_name."\",\"".$down_dir."\");'>".$file_name."</a></td></tr>";        		
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
<script>

function down(name,dir){
	//alert(str);
	window.open("down.php?fileurl="+dir+"&filename="+name);

	/*
	$.fileDownload(str)
		.done(function(){alert('성공'); })
		.fail(function(){alert('실패'); });
	return false;
	*/
}

</script>
</html>