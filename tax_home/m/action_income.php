<?php

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결

	//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

	if($_POST["action"]=="등록")
	{ //ajax로 넘긴 data를 받아준다.
		$CSTNAME=mysqli_real_escape_string($connect,$_POST["cstname"]);
		$MOBILE=mysqli_real_escape_string($connect,$_POST["mobile"]);

	//insert 프로시저 생성
		$procedure = "
		CREATE PROCEDURE insertINCOME(IN P_CSTNAME varchar(45),P_MOBILE varchar(45) )

		BEGIN
			INSERT INTO INCOME_CST(CSTNAME,MOBILE,REGDATE,FLAG)
			VALUES(P_CSTNAME,P_MOBILE,NOW(),'HOME');
		END
		";

	//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertINCOME"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL  insertINCOME('".$CSTNAME."','".$MOBILE."')";
				//프로시저 호출
				mysqli_query($connect,$query);
				echo '등록이 완료되었습니다. 빠른시간안에 연락드리겠습니다.';
			}else{
				echo "error : '".$CSTNAME."','".$MOBILE."'".mysqli_error() ;
			}
		}else{
			echo "error : '".$CSTNAME."','".$MOBILE."'".mysqli_error() ;
		}
	}else{
		echo 'error';
	}

}else{
	echo "알수없는오류  ";
}


?> 