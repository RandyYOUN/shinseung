<?php

error_reporting(E_ALL^ E_WARNING); 

try{

	$filename = $_GET["filename"];
	$fileurl = $_GET["fileurl"];
	//$filepath = iconv('UTF-8','EUC-KR',$fileurl.$filename);
	$filepath = $fileurl.$filename;
	$filesize = filesize($filepath); //파일사이즈 구하기
	 
	if (is_file($filepath)) {
	 
		
		//헤더 설정
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$filename"); //다운로드 되는 파일의 이름을 지정
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: $filesize"); //파일 사이즈 명시

		ob_clean();
		flush(); //버퍼 비우기
		readfile($filepath); //파일 읽어서 출력하기
	}
	else {
		echo "해당 파일이 없습니다.";
	}
}
catch(Exception $e){
	echo 'Message: ' .$e->getMessage();
}

?>
