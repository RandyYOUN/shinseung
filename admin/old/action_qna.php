<?php

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
	
	$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
	
	if($_POST["action"]=="select")
	{ //ajax로 넘긴 data를 받아준다.
		
		$procedure = "
		CREATE PROCEDURE SelectQNAS(IN user_id VARCHAR(20))
		BEGIN
		SELECT * FROM SS_QNAS WHERE ID_ = user_id;
		END;
		";
		//기존의 프로시저가 존재한다면 삭제 후
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SelectQNAS"))
		{
			//위에서 선언한 프로시저 선언(1)
			if(mysqli_query($connect, $procedure))
			{
			//프로시저 호출(2)
				$query = "CALL SelectQNAS(".$_POST["id"].")";
				$result = mysqli_query($connect, $query);

				while($row = mysqli_fetch_array($result))
				{
					//위에서 만든 배열에 넣어준다.
					$output['CSTNAME'] = $row["CSTNAME"];
					$output['PHONE'] = $row["PHONE"];
					$output['EMAIL'] = $row["EMAIL"];
					$output['CONTENTS'] = $row["CONTENTS"];
					$output['REGDATE'] = $row["REGDATE"];
					$output['ANSWER'] = $row["ANSWER"];

				}


				//json string 형식으로 변환 후 넘겨준다.
				echo json_encode($output);
			}
		}

	}



	// action 수정 버튼을 눌렀을 때
	if($_POST["action"] == "수정")
	{

		$answer=mysqli_real_escape_string($connect,$_POST["answer"]);
		$procedure = "
		CREATE PROCEDURE updateQNAS(IN user_id VARCHAR(20), answer LONGTEXT )
		BEGIN
			UPDATE SS_QNAS SET ANSWER = answer WHERE ID_ = user_id;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS updateQNAS"))
		{
			if(mysqli_query($connect, $procedure))
			{
				$query = "CALL updateQNAS('".$_POST["id"]."','".$answer."')";
				mysqli_query($connect, $query);
				echo '수정 되었습니다.';
			}
		}
		
		$_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';

		/*
		 * 요청값
		 */
		$_param['userid'] = 'shinseung';           // [필수] 뿌리오 아이디
		$_param['callback'] = '18993582';    // [필수] 발신번호 - 숫자만
		$_param['phone'] = $_POST["phone"]; // 노준석

$_param['msg'] ='병의원 Q&A 답변이 등록되었습니다.

medi-tax.kr/sub_qnaview.php?id='.$_POST["id"];
		$_param['subject'] = '세무Q&A 답변알림';


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


	// action 삭제 버튼을 눌렀을 때
	if($_POST["action"] == "delete")
	{
		
		$procedure = "
		CREATE PROCEDURE deleteQna(IN user_id VARCHAR(20))
		BEGIN
		DELETE FROM SS_QNAS WHERE ID_ = user_id;
		END;
		";

		if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteQna"))
		{
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL deleteQna('".$_POST["id"]."')";
				mysqli_query($connect, $query);
				echo '삭제완료';
			}
		}

	}



}

?> 