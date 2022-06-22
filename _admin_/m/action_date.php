<?php

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
	
	$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
	
	if($_POST["action"]=="추가")
	{ //ajax로 넘긴 data를 받아준다.
		$tax_date=mysqli_real_escape_string($connect,$_POST["tax_date"]);
		$tax_content=mysqli_real_escape_string($connect,$_POST["tax_content"]);
		$visible=mysqli_real_escape_string($connect,$_POST["visible"]);
		
		//insert 프로시저 생성
		$procedure = "
		CREATE PROCEDURE insertDates(IN tax_date datetime,tax_content varchar(100), visible varchar(1) )
		BEGIN
			INSERT INTO SS_TAXDATE(TAXDATE,CONTENT,VISIBLE) VALUES(tax_date,tax_content,visible);
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertDates"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
			$query = "CALL insertDates('".$tax_date ."','".$tax_content."','".$visible."')";
			//프로시저 호출
			mysqli_query($connect,$query);
			echo '성공적으로 입력 되었습니다.';
			}
		}
	}



	// action 수정 버튼을 눌렀을 때
	if($_POST["action"] == "수정")
	{

		$tax_date=mysqli_real_escape_string($connect,$_POST["tax_date"]);
		$tax_content=mysqli_real_escape_string($connect,$_POST["tax_content"]);
		$visible=mysqli_real_escape_string($connect,$_POST["visible"]);

		$procedure = "
		CREATE PROCEDURE updateDates(IN user_id int(111), tax_date datetime,tax_content varchar(100), visible varchar(1) )
		BEGIN
			UPDATE SS_TAXDATE SET TAXDATE = tax_date, CONTENT = tax_content, VISIBLE = visible
			WHERE ID = user_id;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS updateDates"))
		{
			if(mysqli_query($connect, $procedure))
			{
				$query = "CALL updateDates('".$_POST["id"]."','".$tax_date."','".$tax_content."','".$visible."')";
				mysqli_query($connect, $query);
				echo '수정 되었습니다.';
			}
		}

	}


	// action 삭제 버튼을 눌렀을 때
	if($_POST["action"] == "delete")
	{
		$procedure = "
		CREATE PROCEDURE deleteDate(IN user_id int(100))
		BEGIN
		DELETE FROM SS_TAXDATE WHERE id = user_id;
		END;
		";

		if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteDate"))
		{
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL deleteDate('".$_POST["id"]."')";
				mysqli_query($connect, $query);
				echo '삭제완료';
			}
		}

	}



}

?> 