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
$P_Q1=mysqli_real_escape_string($connect,$_POST["home_q1"]);
$P_Q2=mysqli_real_escape_string($connect,$_POST["home_q2"]);
$P_Q3=mysqli_real_escape_string($connect,$_POST["home_q3"]);



	//insert 프로시저 생성
		$procedure = "
		CREATE PROCEDURE insertINCOME(IN P_CSTNAME varchar(45),P_MOBILE varchar(45), P_Q1 VARCHAR(2000),P_Q2 VARCHAR(2000),P_Q3 VARCHAR(2000) )

		BEGIN
			INSERT INTO INCOME_CST(CSTNAME,MOBILE,REGDATE,FLAG, HOME_Q1,HOME_Q2,HOME_Q3)
			VALUES(P_CSTNAME,P_MOBILE,NOW(),'HOME',P_Q1,P_Q2,P_Q3);
		END
		";

	//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertINCOME"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL  insertINCOME('".$CSTNAME."','".$MOBILE."','".$P_Q1."','".$P_Q2."','".$P_Q3."')";
				//프로시저 호출
				mysqli_query($connect,$query);
				echo '성공적으로 접수되었습니다. 

금일 전화상담 폭주로 인해 세액, 환급금, 수수료 안내가 지연되고 있습니다. 

이점 양해부탁드리며, 최대한 빨리 안내드리도록 하겠습니다.';
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