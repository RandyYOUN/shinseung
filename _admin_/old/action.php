<?php

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
	
	$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
	

	if($_POST["action"]=="팝업등록")
	{ //ajax로 넘긴 data를 받아준다.
		$hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
		$hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
		$residentid=mysqli_real_escape_string($connect,$_POST["residentid"]);

		$procedure = "
		CREATE PROCEDURE insert_TB100020_POP(IN hometaxid VARCHAR(45),hometaxpw VARCHAR(45) , residentid VARCHAR(15) )
		BEGIN

		DECLARE CNT INT(11) default 0;

		SELECT COUNT(*) INTO CNT FROM TB100020
        WHERE TB100020.HomeTaxID = hometaxid 
		AND TB100020.HomeTaxPW = hometaxpw;
		
        SELECT CNT FROM DUAL;
        
		IF CNT = 0
		THEN
			INSERT INTO TB100020(HomeTaxID, HomeTaxPW,RESIDENT_ID ) VALUES(hometaxid, hometaxpw,residentid);
		END IF;
		
        IF CNT > 0
		THEN
			UPDATE TB100020 SET HomeTaxID = hometaxid, HomeTaxPW=hometaxpw, RESIDENT_ID=residentid
            WHERE TB100020.HomeTaxID = hometaxid 
			AND TB100020.HomeTaxPW = hometaxpw;
		END IF;
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_TB100020_POP"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
			$query = "CALL insert_TB100020_POP('".$hometaxid."','".$hometaxpw."','".$residentid."')";
			//프로시저 호출
			mysqli_query($connect,$query);
			echo '성공적으로 입력 되었습니다.';
			}
		}
	}




	if($_POST["action"]=="등록_RPA")
	{ //ajax로 넘긴 data를 받아준다.
		$numbering=mysqli_real_escape_string($connect,$_POST["numbering"]);
		$cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
		$mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
		$resident1=mysqli_real_escape_string($connect,$_POST["resident1"]);
		$resident2=mysqli_real_escape_string($connect,$_POST["resident2"]);
		$ref_bank=mysqli_real_escape_string($connect,$_POST["ref_bank"]);
		$ref_acc=mysqli_real_escape_string($connect,$_POST["ref_acc"]);
		$branch=mysqli_real_escape_string($connect,$_POST["branch"]);
		$server=mysqli_real_escape_string($connect,$_POST["server"]);
		$server_num=mysqli_real_escape_string($connect,$_POST["server_num"]);
		$hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
		$hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
		$cst_type=mysqli_real_escape_string($connect,$_POST["cst_type"]);
		$biz_id=mysqli_real_escape_string($connect,$_POST["biz_id"]);

		$procedure = "
		CREATE PROCEDURE insert_TB100020(IN numbering varchar(5),cstname varchar(45),mobile varchar(45),resident1 varchar(10),resident2 varchar(10), ref_bank varchar(45),ref_acc varchar(100),branch varchar(10), server INT(11), server_num VARCHAR(5), hometaxid VARCHAR(45),hometaxpw VARCHAR(45) ,cst_type varchar(10), biz_id varchar(10) )
		BEGIN

		DECLARE resident_id VARCHAR(15);

		SET resident_id = CONCAT(resident1,'-',resident2);

		INSERT INTO TB100020(NUMBERING,CSTNAME, MOBILE,RESIDENT_ID,REF_BANK,REF_ACC, WRITE_REGDATE, BRANCH, SERVER, SERVER_NUM, HomeTaxID, HomeTaxPW, CST_TYPE, BIZ_ID) VALUES(numbering,cstname,mobile,resident_id,ref_bank,ref_acc, NOW(),branch, server, server_num, hometaxid, hometaxpw,cst_type,biz_id );
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_TB100020"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
			$query = "CALL insert_TB100020('".$numbering ."','".$cstname."','".$mobile."','".$resident1."','".$resident2."','".$ref_bank."','".$ref_acc."','".$branch."','".$server."','".$server_num."','".$hometaxid."','".$hometaxpw."','".$cst_type."','".$biz_id."')";
			//프로시저 호출
			mysqli_query($connect,$query);
			echo '성공적으로 입력 되었습니다.';
			}
		}
	}



	if($_POST["action"]=="추가")
	{ //ajax로 넘긴 data를 받아준다.
		$subject=mysqli_real_escape_string($connect,$_POST["subject"]);
		$news_reguser=mysqli_real_escape_string($connect,$_POST["news_reguser"]);
		$news_reguser_comp=mysqli_real_escape_string($connect,$_POST["news_reguser_comp"]);
		$news_regdate=mysqli_real_escape_string($connect,$_POST["news_regdate"]);
		$contents=mysqli_real_escape_string($connect,$_POST["contents"]);
		$img_url=mysqli_real_escape_string($connect,$_POST["img_url"]);
		$img_url_flag=mysqli_real_escape_string($connect,$_POST["img_url_flag"]);
		$file_url=mysqli_real_escape_string($connect,$_POST["file_url"]);
		$cate=mysqli_real_escape_string($connect,$_POST["cate"]);
		$c_cate=mysqli_real_escape_string($connect,$_POST["c_cate"]);		$visible=mysqli_real_escape_string($connect,$_POST["visible"]);
		$site_gubun=mysqli_real_escape_string($connect,$_POST["site_gubun"]);


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
		CREATE PROCEDURE insertNews(IN subject varchar(200),news_reguser varchar(45),news_regdate datetime,news_reguser_comp varchar(45),contents LONGTEXT, img_url varchar(500),img_url_flag char(1),file_url varchar(500), cate varchar(3), c_cate varchar(5), visible char(1), site_gubun varchar(3) )
		BEGIN
		INSERT INTO SS_NEWS(SUBJECT,NEWS_REGUSER, NEWS_REGDATE,NEWS_REGUSER_COMP ,CONTENTS_,IMG_URL,IMG_URL_FLAG,FILE_URL,CATE ,C_CATE,VISIBLE,SITE_GUBUN, REGDATE, REGUSER) VALUES(subject,news_reguser,news_regdate,news_reguser_comp, contents,img_url,img_url_flag,file_url,cate,c_cate,visible ,site_gubun, now(), 101);
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertNews"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
			$query = "CALL insertNews('".$subject ."','".$news_reguser."','".$news_regdate."','".$news_reguser_comp."','".$contents."','".$img_url."','".$img_url_flag."','".$file_url."','".$cate."','".$c_cate."','".$visible."','".$site_gubun."')";
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
		$img_url_flag=mysqli_real_escape_string($connect,$_POST["img_url_flag"]);
		$file_url=mysqli_real_escape_string($connect,$_POST["file_url"]);
		$cate=mysqli_real_escape_string($connect,$_POST["cate"]);
		$c_cate=mysqli_real_escape_string($connect,$_POST["c_cate"]);
		$visible=mysqli_real_escape_string($connect,$_POST["visible"]);
		$site_gubun=mysqli_real_escape_string($connect,$_POST["site_gubun"]);

		$procedure = "
		CREATE PROCEDURE updateNews(IN user_id int(111), subject varchar(200),news_reguser varchar(45),news_regdate datetime,news_reguser_comp varchar(45),contents LONGTEXT, img_url varchar(500),img_url_flag char(1),file_url varchar(500), cate varchar(3), c_cate varchar(5), visible char(1), site_gubun varchar(3) )
		BEGIN
		UPDATE SS_NEWS SET SUBJECT = subject, NEWS_REGUSER = news_reguser, NEWS_REGUSER_COMP = news_reguser_comp,
		NEWS_REGDATE = news_regdate, IMG_URL = img_url, IMG_URL_FLAG = img_url_flag,FILE_URL = file_url,CATE=cate , C_CATE=c_cate,VISIBLE=visible, CONTENTS_ = contents,SITE_GUBUN=site_gubun
		WHERE ID = user_id;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS updateNews"))
		{
			if(mysqli_query($connect, $procedure))
			{
				$query = "CALL updateNews('".$_POST["id"]."','".$subject ."','".$news_reguser."','".$news_regdate."','".$news_reguser_comp."','".$contents."','".$img_url."','".$img_url_flag."','".$file_url."','".$cate."','".$c_cate."','".$visible."','".$site_gubun."')";
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