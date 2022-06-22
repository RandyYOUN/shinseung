<?php

$_day = date("w");
$_hour = date("Hi");
$NEW_HP_CHK = '';


//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ 
	//db연결
	//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
	$action =$_POST["action"];
	
	
	
	if($_POST["action"]=="action_exem_step01")
	{ //ajax로 넘긴 data를 받아준다.
		$CSTNAME=mysqli_real_escape_string($connect,$_POST["cstname"]);
		$MOBILE=mysqli_real_escape_string($connect,$_POST["mobile"]);

	//insert 프로시저 생성
		$procedure = "
		CREATE PROCEDURE INSERT_EXEM_STEP01(IN P_CSTNAME varchar(45),P_MOBILE varchar(45) )

		BEGIN
			DECLARE TMP_CSTID INT(11);
            DECLARE TMP_BIZID INT(11);
			DECLARE CNT_CSTID INT(11);
            DECLARE FLAG_CSTID INT(11);

			SELECT COUNT(1) INTO CNT_CSTID FROM INCOME_CST
			WHERE CSTNAME = P_CSTNAME AND MOBILE=P_MOBILE;

			IF CNT_CSTID = 0 THEN
				INSERT INTO TB100020(CSTNAME,MOBILE,AGREEMENT,AG_REGDATE) VALUES(P_CSTNAME,P_MOBILE,'Y',NOW());
				
				SELECT last_insert_id() INTO TMP_CSTID;

				CALL INSERT_TB100022(TMP_CSTID,'면세사업현황신고','2021','1',NULL, NULL, '9',NULL,NULL);
                SELECT last_insert_id() INTO TMP_BIZID;
                SET FLAG_CSTID = 1;
			ELSE
				SELECT CSTID INTO TMP_CSTID FROM TB100020
				WHERE CSTNAME = P_CSTNAME AND MOBILE=P_MOBILE
                ORDER BY CSTID DESC LIMIT 1;
                SET FLAG_CSTID = 2;
			END IF;

			SELECT CSTID, BIZ_ID, FLAG_CSTID FROM TB100022 WHERE CSTID =  TMP_CSTID LIMIT 1;
		
		END
		";

	//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_EXEM_STEP01"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL  INSERT_EXEM_STEP01('".$CSTNAME."','".$MOBILE."')";
				//프로시저 호출
				$result = mysqli_query($connect,$query);
				
				while($row = mysqli_fetch_array($result))
				{
				    $output['CSTID'] = $row["CSTID"];
				    $output['BIZ_ID'] = $row["BIZ_ID"];
				    $output['FLAG_CSTID'] = $row["FLAG_CSTID"];
				}
				
				echo json_encode($output);
				
			}
		}
	}

	






	if($action=="action_vat_cst")
	{ 
		$CSTNAME_TMP=mysqli_real_escape_string($connect,$_POST["cstname"]);
		$MOBILE_TMP=mysqli_real_escape_string($connect,$_POST["mobile"]);
		$output = array();

		/*문자열 정규화*/
		$CSTNAME = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $CSTNAME_TMP);
		$MOBILE = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $MOBILE_TMP);
		/*문자열 정규화*/

		$procedure = "CREATE PROCEDURE INSERT_VAT_CST_MOBILE(IN P_CSTNAME varchar(45) CHARSET utf8, P_MOBILE varchar(45) )
		BEGIN
			DECLARE TMP_CSTID INT(11);
            DECLARE TMP_BIZID INT(11);
			DECLARE CNT_CSTID INT(11);
            DECLARE FLAG_CSTID INT(11);

			SELECT COUNT(1) INTO CNT_CSTID FROM TB100020
			WHERE CSTNAME = P_CSTNAME AND MOBILE=P_MOBILE;

			IF CNT_CSTID = 0 THEN
				INSERT INTO TB100020(CSTNAME,MOBILE,AGREEMENT,AG_REGDATE) VALUES(P_CSTNAME,P_MOBILE,'Y',NOW());
				
				SELECT last_insert_id() INTO TMP_CSTID;

				CALL INSERT_TB100022(TMP_CSTID,'부가세',DATE_FORMAT(now(), '%Y'),'1',NULL, NULL, '9',NULL,NULL);
                SELECT last_insert_id() INTO TMP_BIZID;
                SET FLAG_CSTID = 1;
			ELSE
				SELECT CSTID INTO TMP_CSTID FROM TB100020
				WHERE CSTNAME = P_CSTNAME AND MOBILE=P_MOBILE
                ORDER BY CSTID DESC LIMIT 1;
                SET FLAG_CSTID = 2;
			END IF;

			SELECT CSTID, BIZ_ID, FLAG_CSTID FROM TB100022 WHERE CSTID =  TMP_CSTID LIMIT 1;
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_VAT_CST_MOBILE"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL INSERT_VAT_CST_MOBILE('".$CSTNAME."','".$MOBILE."')";
				//프로시저 호출
				$result = mysqli_query($connect,$query);

				while($row = mysqli_fetch_array($result))
				{
					$output['CSTID'] = $row["CSTID"];
					$output['BIZ_ID'] = $row["BIZ_ID"];
					$output['FLAG_CSTID'] = $row["FLAG_CSTID"];
				}
			}
		}

		//ECHO "등록완료.";
		echo json_encode($output);
	}


	


	if($action=="upt_hometax_idpw")
	{ 

		$cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
		$hometax_id=mysqli_real_escape_string($connect,$_POST["hometax_id"]);
		$hometax_pw=mysqli_real_escape_string($connect,$_POST["hometax_pw"]);
		$res_id=mysqli_real_escape_string($connect,$_POST["res_id"]);
		
		$procedure = "CREATE PROCEDURE UPT_TB100020_HOMETAX_IDPW(
		IN P_CSTID INT(11),
		P_ID VARCHAR(50),
		P_PW VARCHAR(50),
		P_RESID VARCHAR(15)
		)
		BEGIN
			
			UPDATE TB100020 SET HomeTaxID = P_ID, HomeTaxPW=P_PW, RESIDENT_ID=P_RESID WHERE CSTID = P_CSTID;

		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_TB100020_HOMETAX_IDPW"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL UPT_TB100020_HOMETAX_IDPW('".$cstid."','".$hometax_id."','".$hometax_pw."','".$res_id."')";
				//프로시저 호출
				mysqli_query($connect,$query);
			}
		}

		ECHO "입력완료";
	}




	if($action=="upt_vatfee_complate_check")
	{ 

		$bizid=mysqli_real_escape_string($connect,$_POST["bizid"]);
		$seq=mysqli_real_escape_string($connect,$_POST["seq"]);
		
		$procedure = "CREATE PROCEDURE UPT_TB100022_CK_FEE(
		IN P_BIZID INT(11),
		P_CK_VALUE VARCHAR(1)
		)
		BEGIN
			
			
			DECLARE TMP_CK VARCHAR(1);

			IF P_CK_VALUE = 'Y' THEN
				SET TMP_CK = 'Y';
			ELSEIF P_CK_VALUE = 'I' THEN
				SET TMP_CK = 'I';
			ELSE
				SET TMP_CK = 'N';
			END IF;

			UPDATE TB100022 SET CST_FEE_COMP_CK = TMP_CK
			WHERE BIZ_ID = P_BIZID;

		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_TB100022_CK_FEE"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL UPT_TB100022_CK_FEE('".$bizid."','".$seq."')";
				//프로시저 호출
				mysqli_query($connect,$query);
			}
		}

		ECHO "입력완료";
	}





	
	if($action=="action_vat_option_insert")
	{ 
		$bizid=mysqli_real_escape_string($connect,$_POST["bizid"]);
		$option1=mysqli_real_escape_string($connect,$_POST["option1"]);
		$option2=mysqli_real_escape_string($connect,$_POST["option2"]);
		$option3=mysqli_real_escape_string($connect,$_POST["option3"]);
		$option4=mysqli_real_escape_string($connect,$_POST["option4"]);
		$option5=mysqli_real_escape_string($connect,$_POST["option5"]);
		$option6=mysqli_real_escape_string($connect,$_POST["option6"]);
		$option7=mysqli_real_escape_string($connect,$_POST["option7"]);
		$option8=mysqli_real_escape_string($connect,$_POST["option8"]);
		$option9=mysqli_real_escape_string($connect,$_POST["option9"]);
		$option10=mysqli_real_escape_string($connect,$_POST["option10"]);
		$option11=mysqli_real_escape_string($connect,$_POST["option11"]);
		$tmp_est_fee=mysqli_real_escape_string($connect,$_POST["est_fee"]);
		$est_fee = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $tmp_est_fee);


		$procedure = "CREATE PROCEDURE `INSERT_TB100024`(
		IN P_BIZID INT(11), 
		P_OPT1 varchar(1), 
		P_OPT2 varchar(1), 
		P_OPT3 varchar(1), 
		P_OPT4 varchar(1), 
		P_OPT5 varchar(1), 
		P_OPT6 varchar(1),
        P_EST_FEE INT(11)
		)
		BEGIN

			
			DECLARE CNT INT(11);
			
			SELECT COUNT(1) INTO CNT FROM TB100024 WHERE BIZ_ID = P_BIZID;
			
			IF CNT = 0 THEN
				INSERT INTO TB100024(BIZ_ID, OPTION1,OPTION2,OPTION3,OPTION4,OPTION5,OPTION6,REGDATE ) 
				VALUES(P_BIZID,P_OPT1,P_OPT2,P_OPT3,P_OPT4,P_OPT5,P_OPT6,NOW());
			ELSE
				UPDATE TB100024 SET OPTION1 = P_OPT1,
				OPTION2 = P_OPT2,
				OPTION3 = P_OPT3,
				OPTION4 = P_OPT4,
				OPTION5 = P_OPT5,
				OPTION6 = P_OPT6,
				EDTDATE = NOW()
                WHERE BIZ_ID = P_BIZID;
			END IF;
               
			IF IFNULL(P_EST_FEE ,'') <> '' THEN
				CALL UPT_TB100022_ESTFEE(P_BIZID,P_EST_FEE);
            END IF;

		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB100024"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL INSERT_TB100024('".$bizid."','".$option1."','".$option2."','".$option3."','".$option4."','".$option5."','".$option6."' , '".$est_fee."')";
				//프로시저 호출
				mysqli_query($connect,$query);
			}
		}

		ECHO "입력완료";


	}





	if($action=="동의")
	{ 
		$CSTNAME=mysqli_real_escape_string($connect,$_POST["cstname"]);
		$MOBILE=mysqli_real_escape_string($connect,$_POST["mobile"]);

		$procedure = "CREATE PROCEDURE insertAGREE(IN P_CSTNAME varchar(45) CHARSET utf8, P_MOBILE varchar(45) )
		BEGIN
			INSERT INTO CST_AGREEMENT(CSTNAME,MOBILE,AGREEMENT,AG_REGDATE) VALUES(P_CSTNAME,P_MOBILE,'Y',NOW());
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertAGREE"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL insertAGREE('".$CSTNAME."','".$MOBILE."')";
				//프로시저 호출
				mysqli_query($connect,$query);
			}
		}

		ECHO "동의완료.";


	}

	if($action=="추가")
	{ 
		//ajax로 넘긴 data를 받아준다.
		$NEW_HP=mysqli_real_escape_string($connect,$_POST["NEW_HP"]);
		$Q_TYPE=mysqli_real_escape_string($connect,$_POST["Q_TYPE"]);

		//insert 프로시저 생성
		$procedure = "CREATE PROCEDURE insertNEWHP(IN NEW_HP varchar(20), Q_TYPE varchar(20) )
		BEGIN
		INSERT INTO NEW_HP(NEW_HP,Q_TYPE,REGDATE,GUBUN) VALUES(NEW_HP,Q_TYPE,NOW(),'종합소득세');
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertNEWHP"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL insertNEWHP('".$NEW_HP."','".$Q_TYPE."')";
				//프로시저 호출
				mysqli_query($connect,$query);

					/*
					 * 뿌리오 발송API 알림 TO : 신승직원
					 */
					$_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';

					$_param['userid'] = 'shinseung'; // [필수] 뿌리오 아이디
					$_param['callback'] = '18993582'; // [필수] 발신번호 - 숫자만

					if($Q_TYPE == '종합소득세'){
						$_param['phone'] = '01038484309'; //	정혜숙	
//						$_param['phone'] = $lot_mobile; //	개발테스트
					}else if($Q_TYPE == '등록대행&법인설립지원'){
						$_param['phone'] = '01030925352'; //  노준석
					}
					else if($Q_TYPE == '정책자금'){
						$_param['phone'] = '01030925352'; //  노준석 
					}
					//여러명일 경우 |로 구분 010********|010********|

					$_param['msg'] = $Q_TYPE.' 전화상담 요청이 왔습니다. => '.$NEW_HP;
					$_param['subject'] = '응대요청';


					if($_day > 0 and $_day <6){
						if($_hour > 900 and $_hour < 2100){
										
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


					

					/*
					 * 뿌리오 발송API 접수알림 TO : 고객
					 */
					
					$_param['userid'] = 'shinseung';           // [필수] 뿌리오 아이디
					$_param['callback'] = '18993582';    // [필수] 발신번호 - 숫자만


					$_param['phone'] = $NEW_HP;


					//$_param['phone'] = $NEW_HP;       // [필수] 수신번호 - 여러명일 경우 |로 구분 '010********|010********|010********'


$_param['msg'] = '쉽고 빠른 세무서비스 세무톡 
국세청 33년 경력 신승세무법인과 함께합니다. 

상담 접수가 완료되었습니다. 

▶ 채팅상담 클릭
▶ https://taxtoc.channel.io

금일 전화상담 폭주로 인해 
전화상담이 지연되고 있습니다.
이점 양해 부탁드립니다. 

빠른 상담을 원하시면 
아래의 채팅상담 링크를 클릭하여 

▶[종합소득세 안내문]을 올려주시면 
신속하게 검토하여 답변드리겠습니다. 

▶ 채팅상담 클릭
▶ https://taxtoc.channel.io'; 


					$_param['subject'] = '접수 안내';          // [선택] 제목 (30byte)


//사용자 화면단 노출 얼럿			
				switch($Q_TYPE){
					case "종합소득세" : echo '성공적으로 접수되었습니다. 

금일 전화상담 폭주로 인해 세액, 환급금, 수수료 안내가 지연되고 있습니다. 

이점 양해부탁드리며, 최대한 빨리 안내드리도록 하겠습니다. 

▶[종합소득세 안내문]을 올려주시지 않으면 
검토 안내를 드릴수 없는 점 다시한번 양해부탁드립니다. 
';
					break;

					case "등록대행&법인설립지원" : echo '성공적으로 전화상담 요청이 신청되었습니다. 
조금만 기다려주시면 빠르고 전문적인 전화상담이 가능합니다. 
전화상담 가능시간 : 평일 오전 10시 ~ 오후 6시';
					break;

					case "정책자금" : echo '성공적으로 서비스가 신청되었습니다. 
정기적으로 카톡 또는 문자로 세무, 정책자금, 사업관련 필요정보를 맞춤제공해드립니다.';
					break;

					case "구독" : echo '성공적으로 세무소식 무료구독이 등록되었습니다. 
정기적으로 카톡 또는 문자로 세무, 정책자금, 사업관련 필요정보를 맞춤제공해드립니다.';
					break;
					default:"default";
				}
			}

		}
	}

}


?> 