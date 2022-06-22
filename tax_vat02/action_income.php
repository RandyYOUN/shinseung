<?php
$_day = date("w");
$_hour = date("Hi");

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결

	$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면

	if($_POST["action"]=="등록")
	{ 
		$CSTNAME=mysqli_real_escape_string($connect,$_POST["cstname"]);
		$MOBILE=mysqli_real_escape_string($connect,$_POST["mobile"]);
		$QUEST=mysqli_real_escape_string($connect,$_POST["quest"]);

		$procedure = "
		CREATE PROCEDURE insertINCOME(IN P_CSTNAME varchar(45),P_MOBILE varchar(45), P_QUEST varchar(2000) )

		BEGIN
			INSERT INTO INCOME_CST(CSTNAME,MOBILE,QUEST,REGDATE, FLAG, VISIBLE)
			VALUES(P_CSTNAME,P_MOBILE,P_QUEST,NOW(),'INCOME','Y');
		END
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertINCOME"))
		{
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL  insertINCOME('".$CSTNAME."','".$MOBILE."','".$QUEST."')";
				mysqli_query($connect,$query);
			}
		}
	
/*
	//경로&파일확인
	 $cstname = iconv("UTF-8","cp949",$CSTNAME);
	 $uploaddir = 'upload/'.$cstname.'/';

	 //경로확인
	 if(is_dir($uploaddir )){ 
		/*
		 * 뿌리오 발송API 알림 TO : 신승직원
		 */
		 /*
		$_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';
		$_param['userid'] = 'shinseung'; // [필수] 뿌리오 아이디
		$_param['callback'] = '18993582'; // [필수] 발신번호 - 숫자만
//		$_param['phone'] = '01082634251'; //	한영순	
		$_param['phone'] = '01091778835'; //	마희숙
		$_param['msg'] = '신규 종합소득세 상담신청이 왔습니다. '.$CSTNAME."(".$MOBILE.")";
		$_param['subject'] = '종소세 응대요청';


		if($_day > 0 and $_day <6){
			if($_hour > 900 and $_hour < 2200){
							
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

		

		/*
		 * 뿌리오 발송API 끝
		 */
	//  }//경로확인


		echo '등록이 완료되었습니다. 빠른시간안에 연락드리겠습니다.';


	}
}


?> 