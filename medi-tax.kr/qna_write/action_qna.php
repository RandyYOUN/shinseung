<?php

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
	
	//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
	
	if($_POST["action"]=="추가")
	{ //ajax로 넘긴 data를 받아준다.
		$cstname=mysqli_real_escape_string($connect,$_POST["CSTNAME"]);
		$phone=mysqli_real_escape_string($connect,$_POST["PHONE"]);
		$email=mysqli_real_escape_string($connect,$_POST["EMAIL"]);
		$contents=mysqli_real_escape_string($connect,$_POST["contents"]);


		//참고-mysqli_real_escape_string
		//:MySQL로 질의를 전송하기 전에 안전하게 데이터를 만들기 위해 사용
		//특수 문자열을 이스케이프하여 mysql_query() 수행시 안전하게 질의할 수 있도록 한다.
		/*
		, , content varchar(8000)
		, , CONTENTS,
		,  news_reguser_comp, content 
		."','".$news_regdate."','".$news_reguser_comp."','".$content
		*/
		//insert 프로시저 생성
		$procedure = "
		CREATE PROCEDURE insertQNA(IN CSTNAME varchar(50),PHONE varchar(45),EMAIL varchar(200), CONTENTS LONGTEXT )
		BEGIN
		INSERT INTO SS_QNAS(CSTNAME,PHONE, EMAIL,CONTENTS_, REGDATE) VALUES(cstname,phone,email,contents,now());
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertQNA"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
			$query = "CALL insertQNA('".$cstname."','".$phone."','".$email."','".$contents."')";
			//프로시저 호출
			mysqli_query($connect,$query);
			echo $procedure.'성공적으로 입력 되었습니다.';
			}
		}
	}
}

?> 