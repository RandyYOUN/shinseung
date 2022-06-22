<?php

$_day = date("w");
$_hour = date("Hi");
$NEW_HP_CHK = '';


//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ 
	//db연결
	$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면

	if($_POST["action"]=="추가")
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
				// 당일 중복신청고객 체크
				*/
				/*
				$procedure_HPCHECK = "SELECT NEW_HP FROM NEW_HP WHERE NEW_HP = '".$NEW_HP."' AND DATE_FORMAT(REGDATE,'%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')";
				
				$result_chk = mysqli_query($connect,$procedure_HPCHECK) or die("SQL error");

				while ($row = mysqli_fetch_array($result_chk)) {
				 $NEW_HP_CHK = $row["NEW_HP"];
				}*/

				/*
				// 당일 중복신청고객 체크
				*/

				//if($NEW_HP_CHK == ''){ // 당일중복 아닐경우에만 이하 실행
					
					/*
					* 전화 지점별 로테이션처리
					*/
					//$procedure_lot = "SELECT * FROM CALL_LOTATION WHERE CALL_LOTATION = 'Y'";
					//$query_UPT = "CALL CALL_LOTATION()";

					//$result_lot = mysqli_query($connect,$procedure_lot) or die("SQL error");
/*
					while ($row2 = mysqli_fetch_array($result_lot)) {
					 $lot_mobile = $row2["MOBILE"];
					 $branch_name = $row2["BRANCH_NAME"];
					}

					mysqli_query($connect,$query_UPT);
*/
					/*
					* 전화 지점별 로테이션처리
					*/


					/*
					 * 뿌리오 발송API 알림 TO : 신승직원
					 */
					$_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';

					$_param['userid'] = 'shinseung'; // [필수] 뿌리오 아이디
					$_param['callback'] = '18993582'; // [필수] 발신번호 - 숫자만

					if($Q_TYPE == '종합소득세'){
						$_param['phone'] = '01055904957'; //	정혜숙	
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
						if($_hour > 930 and $_hour < 1830){
										
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

					//if($_day > 0 and $_day <6){
					//	if($_hour > 930 and $_hour < 1830){
							if($Q_TYPE != "구독" && $Q_TYPE != "정책자금" ){
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
							
					//	}
					//}


				//} //신규HP체크


			
				switch($Q_TYPE){
					case "종합소득세" : echo '세무톡 
성공적으로 전화상담 요청이 신청되었습니다. 

금일 전화상담 폭주로 인해 전화상담이 지연되고 있습니다.
이점 양해 부탁드립니다. 

빠른 상담을 원하시면 
아래의 채팅상담 링크를 클릭하여 

▶[종합소득세 안내문]을 올려주시면 신속하게 검토하여 답변드리겠습니다.';
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