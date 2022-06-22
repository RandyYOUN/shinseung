<?php

	$TOKEN_URL = "https://api.bizppurio.com/v1/token"; // 액세스토큰 요청URL
	$SEND_URL = "https://api.bizppurio.com/v3/message"; // 발송 URL
	$account = "shinseungat";
	
	/* 웹에서 등록한 템플릿 내용과 발송 요청 시 message 파라미터가 같아야 발송됨.
	메시지 내용 같지 않을 시 정상적으로 처리되었다는 응답이 오지만 카톡으로 발송 안됨.
	*/
	$message = "부가가치세 신고기간 및 필요서류 안내 

■ 부가가치세 신고기간
2020년 1기 확정(상반기) 
7월 1일부터 7월 25일까지입니다. 

개인사업자 중 일반과세자께서는 신고 및 납부를 완료하셔야 합니다. 

■ 부가가치세 필요서류
▶ 필수서류   
1. 사업자등록증 
2. 대표자 신분증  
3. 홈택스 ID / PW 

▶ 추가 기타서류
4. 기타 매출자료  
= 종이 또는 수기 매출자료  
= 제외 : 전자 세금계산서, 홈택스 등록 카드매출내역, 현금영수증 매출내역  

5. 기타 매입자료  
= 종이 또는 수기 매입자료  
= 제외 : 전자 세금계산서, 홈택스 등록 카드매입내역, 현금영수증 매입내역 

◆ 홈택스 미등록 신용카드내역은  
카드사에 카드매입내역 엑셀파일로 요청하여 
보내주십시오.";
	
	
	$base64 = base64_encode($account.":ssat1@#$");
	$opts = array(
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_VERBOSE => true,
		CURLOPT_POST => true,
		CURLOPT_NOSIGNAL => 1,
		CURLOPT_TIMEOUT => 3
		
	); 
	
	// 액세스토큰 요청
	$accessHeader = array('Authorization: Basic '.$base64, 'Content-Type: application/json', 'charset=utf-8');
	$curl = curl_init(); 
	curl_setopt_array($curl, $opts);
	curl_setopt($curl, CURLOPT_URL, $TOKEN_URL);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $accessHeader);
	
	// 취득한 액세스 토큰
	$tokenJson = curl_exec($curl);
	$tokenJosnDecode = json_decode($tokenJson, true);
	curl_close($curl); 
	
	$data = array();
	$data["account"] = $account;
	$data["refkey"] = "shinseung";
	$data["type"] = "at";
	$data["from"] = "07000000000";
	$data["to"] = "01055904957";
	
	$at = array(
		"senderkey" => "b63d000f857731a8f58397956fa3ddbd6318e49d",
		"templatecode" => "bizp_2020070613011626115819245",
		"message" => $message
	);
	$data["content"] = array("at" => $at);
	
	
	// 알림톡 발송
	$sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
	$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
	
	$curl = curl_init(); 
	curl_setopt_array($curl, $opts);
	curl_setopt($curl, CURLOPT_URL, $SEND_URL);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $sendHeader);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
	
	$result = curl_exec($curl);
	curl_close($curl); 
	
	print_r(json_decode($result));
	
?>