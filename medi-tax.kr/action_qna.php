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
		$now=mysqli_real_escape_string($connect,$_POST["now"]);

		//insert 프로시저 생성
		$procedure = "
		CREATE PROCEDURE insertQNA(IN CSTNAME varchar(50),PHONE varchar(45),EMAIL varchar(200), CONTENTS LONGTEXT , ID_ VARCHAR(20))
		BEGIN
		INSERT INTO SS_QNAS(CSTNAME,PHONE, EMAIL,CONTENTS, REGDATE, ID_) VALUES(cstname,phone,email,contents,now(), $now);
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertQNA"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
			$query = "CALL insertQNA('".$cstname."','".$phone."','".$email."','".$contents."','".$now."')";
			//프로시저 호출
			mysqli_query($connect,$query);
			echo '성공적으로 입력 되었습니다.';
			}
		}


		$_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';

		/*
		 * 요청값
		 */
		$_param['userid'] = 'shinseung';           // [필수] 뿌리오 아이디
		$_param['callback'] = '18993582';    // [필수] 발신번호 - 숫자만
		$_param['phone'] = '01055904957|01030925352'; // 테스트=노준석,윤형덕

$_param['msg'] ='병의원 Q&A 질문이 등록되었습니다.
medi-tax.kr/sub_qnaview.php?id='.$now.'';
		$_param['subject'] = '병의원Q&A 질문접수알림';


				$_curl = curl_init();
				curl_setopt($_curl,CURLOPT_URL,$_api_url);
				curl_setopt($_curl,CURLOPT_POST,true);
				curl_setopt($_curl,CURLOPT_SSL_VERIFYPEER,false);
				curl_setopt($_curl,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($_curl,CURLOPT_POSTFIELDS,$_param);
				$_result = curl_exec($_curl);
				curl_close($_curl);

				$_result = json_decode($_result);


	}
}

?> 