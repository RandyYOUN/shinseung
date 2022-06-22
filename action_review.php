<?php

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결

    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

	if($_POST["action"]=="리뷰")
	{ //ajax로 넘긴 data를 받아준다.
		$REV_HP=mysqli_real_escape_string($connect,$_POST["tel"]);
		$REV_CONTENT=mysqli_real_escape_string($connect,$_POST["content"]);
		$REV_SCORE=mysqli_real_escape_string($connect,$_POST["starwrite"]);
		$REV_CATE=mysqli_real_escape_string($connect,$_POST["select"]);

	//insert 프로시저 생성
		$procedure = "
		CREATE PROCEDURE insertReview(IN REV_HP varchar(45),REV_CONTENT varchar(500),REV_SCORE INT, REV_CATE VARCHAR(10) )
		BEGIN
			INSERT INTO SS_REVIEW(REV_HP,REV_CONTENT,REV_SCORE,REV_REGDATE,REV_CATE)
			VALUES(REV_HP,REV_CONTENT,REV_SCORE, NOW(), REV_CATE);
		END
		";

	//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertReview"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL  insertReview('".$REV_HP."','".$REV_CONTENT."',".$REV_SCORE.",'".$REV_CATE."')";
				//프로시저 호출
				mysqli_query($connect,$query);
				echo '성공적으로 입력 되었습니다.';
			}else{
				echo "error : '".$REV_HP."','".$REV_CONTENT."',".$REV_SCORE.",'".$REV_CATE."'".mysqli_error() ;
			}
		}else{
			echo "error : '".$REV_HP."','".$REV_CONTENT."',".$REV_SCORE.",'".$REV_CATE."'".mysqli_error() ;
		}
	}else{
		echo 'error';
	}

}else{
	echo "알수없는오류  ";
}


?> 