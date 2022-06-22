<?php

$_day = date("w");
$_hour = date("Hi");


//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ 
	//db연결
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

	if($_POST["action"]=="추가")
	{ 
		//ajax로 넘긴 data를 받아준다.
		$NEW_HP=mysqli_real_escape_string($connect,$_POST["NEW_HP"]);
		$Q_TYPE=mysqli_real_escape_string($connect,$_POST["Q_TYPE"]);

		//insert 프로시저 생성
		$procedure = "CREATE PROCEDURE insertNEWHP(IN NEW_HP varchar(20), Q_TYPE varchar(20) )
		BEGIN
		INSERT INTO NEW_HP(NEW_HP,Q_TYPE,REGDATE,GUBUN) VALUES(NEW_HP,Q_TYPE,NOW(),'창업세무상담센터');
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
				 * 뿌리오 발송API 내부알림
				 */
				$_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';

				/*
				 * 요청값
				 */
				$_param['userid'] = 'shinseung';           // [필수] 뿌리오 아이디
				$_param['callback'] = '18993582';    // [필수] 발신번호 - 숫자만

				if($Q_TYPE == '세무상담'){
					$_param['phone'] = '01038484309'; //	정혜숙	
				}else if($Q_TYPE == '등록대행&법인설립지원'){
					$_param['phone'] = '01030925352'; //  노준석
				}
				else if($Q_TYPE == '정책자금'){
					$_param['phone'] = '01030925352'; //  노준석 
				}//else if($Q_TYPE == '창업_제휴문의'){
					//$_param['phone'] = '01030925352'; // 
				//}
				//$_param['phone'] = $NEW_HP;       // [필수] 수신번호 - 여러명일 경우 |로 구분 '010********|010********|010********'

				$_param['msg'] = '창업세무상담센터에서 '.$NEW_HP.' 번호로 ['.$Q_TYPE. '] 전화상담 문의가 왔습니다. 응대부탁드립니다.';
				$_param['subject'] = '응대요청';


				//if($_day > 0 and $_day <6){
					//if($_hour > 930 and $_hour < 1830){
									
						$_curl = curl_init();
						curl_setopt($_curl,CURLOPT_URL,$_api_url);
						curl_setopt($_curl,CURLOPT_POST,true);
						curl_setopt($_curl,CURLOPT_SSL_VERIFYPEER,false);
						curl_setopt($_curl,CURLOPT_RETURNTRANSFER,true);
						curl_setopt($_curl,CURLOPT_POSTFIELDS,$_param);
						$_result = curl_exec($_curl);
						curl_close($_curl);

						$_result = json_decode($_result);
					//}
				//}
				/*
				 * 뿌리오 발송API 끝
				 */


				/*
				 * 뿌리오 발송API 고객접수알림
				 */

				/*
				 * 요청값
				 */
				$_param['userid'] = 'shinseung';           // [필수] 뿌리오 아이디
				$_param['callback'] = '18993582';    // [필수] 발신번호 - 숫자만


				$_param['phone'] = $NEW_HP;


				//$_param['phone'] = $NEW_HP;       // [필수] 수신번호 - 여러명일 경우 |로 구분 '010********|010********|010********'




$_param['msg'] = ' 안녕하세요. 고객님 
쉽고 빠른 세무서비스 세무톡입니다. 

조금만 기다려주시면 
전화를 드려 빠르고 전문적인 세무상담토록 하겠습니다. 

※ 신승세무법인
세무톡은 국세청 33년 경력 믿고 맡길 수 있는 신승세무법인의 스마트 세무회계 서비스 브랜드입니다. 
신승세무법인으로 전화가 오시면 받아주세요. 

※ 전화상담 가능시간 
평일 오전 10시 ~ 오후 6시
토,일, 공휴일은 휴무여서 다음 영업일 오전에 전화드리도록 하겠습니다. 

※ 채팅상담 
전화 상담의 경우 접수자가 많아 상담이 지연될수 있습니다. 
더 빠른 상담을 원하시면 아래의 링크를 클릭해주세요. 

☞   https://taxtoc.channel.io

※ 전화상담
☎ 1899-3582';   

				$_param['subject'] = '접수 안내';          // [선택] 제목 (30byte)

				if($_day > 0 and $_day <6){
					if($_hour > 930 and $_hour < 1830){
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
						
					}
				}


				
				/*
				 * 뿌리오 발송API 끝
				 */


				switch($Q_TYPE){
					case "세무상담" : echo '성공적으로 전화상담 요청이 신청되었습니다. 
조금만 기다려주시면 빠르고 전문적인 전화상담이 가능합니다. 
전화상담 가능시간 : 평일 오전 10시 ~ 오후 6시';
					break;

					case "사업자 등록대행&법인설립 지원 서비스" : echo '성공적으로 전화상담 요청이 신청되었습니다. 
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