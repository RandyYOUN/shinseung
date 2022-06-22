<?php

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
	
	//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
	
	if($_POST["action"]=="추가")
	{ //ajax로 넘긴 data를 받아준다.
		$subject=mysqli_real_escape_string($connect,$_POST["subject"]);
		$news_reguser=mysqli_real_escape_string($connect,$_POST["news_reguser"]);
		$news_reguser_comp=mysqli_real_escape_string($connect,$_POST["news_reguser_comp"]);
		$news_regdate=mysqli_real_escape_string($connect,$_POST["news_regdate"]);
		$contents=mysqli_real_escape_string($connect,$_POST["contents"]);
		$img_url=mysqli_real_escape_string($connect,$_POST["img_url"]);
		$cate=mysqli_real_escape_string($connect,$_POST["cate"]);
		$visible=mysqli_real_escape_string($connect,$_POST["visible"]);


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
		CREATE PROCEDURE insertNews(IN subject varchar(200),news_reguser varchar(45),news_regdate datetime,news_reguser_comp varchar(45),contents LONGTEXT, img_url varchar(500), cate varchar(3), visible char(1) )
		BEGIN
		INSERT INTO SS_NEWS(SUBJECT,NEWS_REGUSER, NEWS_REGDATE,NEWS_REGUSER_COMP ,CONTENTS_,IMG_URL,CATE,VISIBLE, REGDATE, REGUSER) VALUES(subject,news_reguser,news_regdate,news_reguser_comp, contents,img_url,cate,visible ,now(), 101);
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertNews"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
			$query = "CALL insertNews('".$subject ."','".$news_reguser."','".$news_regdate."','".$news_reguser_comp."','".$contents."','".$img_url."','".$cate."','".$visible."')";
			//프로시저 호출
			mysqli_query($connect,$query);
			echo '성공적으로 입력 되었습니다.';
			}
		}
	}


		
	// action 수정 버튼을 눌렀을 때
	if($_POST["action"] == "수정")
	{

		$subject=mysqli_real_escape_string($connect,$_POST["subject"]);
		$news_reguser=mysqli_real_escape_string($connect,$_POST["news_reguser"]);
		$news_reguser_comp=mysqli_real_escape_string($connect,$_POST["news_reguser_comp"]);
		$news_regdate=mysqli_real_escape_string($connect,$_POST["news_regdate"]);
		$contents=mysqli_real_escape_string($connect,$_POST["contents"]);
		$img_url=mysqli_real_escape_string($connect,$_POST["img_url"]);
		$cate=mysqli_real_escape_string($connect,$_POST["cate"]);
		$visible=mysqli_real_escape_string($connect,$_POST["visible"]);

		$procedure = "
		CREATE PROCEDURE updateNews(IN user_id int(111), subject varchar(200),news_reguser varchar(45),news_regdate datetime,news_reguser_comp varchar(45),contents LONGTEXT, img_url varchar(500), cate varchar(3), visible char(1) )
		BEGIN
		UPDATE SS_NEWS SET SUBJECT = subject, NEWS_REGUSER = news_reguser, NEWS_REGUSER_COMP = news_reguser_comp,
		NEWS_REGDATE = news_regdate, IMG_URL = img_url,CATE=cate,VISIBLE=visible, CONTENTS_ = contents
		WHERE ID = user_id;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS updateNews"))
		{
			if(mysqli_query($connect, $procedure))
			{
				$query = "CALL updateNews('".$_POST["id"]."','".$subject ."','".$news_reguser."','".$news_regdate."','".$news_reguser_comp."','".$contents."','".$img_url."','".$cate."','".$visible."')";
				mysqli_query($connect, $query);
				echo '수정 되었습니다.';
			}
		}

	}


	// action 삭제 버튼을 눌렀을 때
	if($_POST["action"] == "delete")
	{
		$procedure = "
		CREATE PROCEDURE deleteNews(IN user_id int(100))
		BEGIN
		DELETE FROM SS_NEWS WHERE id = user_id;
		END;
		";

		if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteNews"))
		{
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL deleteNews('".$_POST["id"]."')";
				mysqli_query($connect, $query);
				echo '삭제완료';
			}
		}

	}




}

?> 