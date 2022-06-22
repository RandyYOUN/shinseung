<?php

if(!session_id()) session_start();

// 내 어플리케이션 > REST API 키
$APP_KEY = "4a8c5c90356881a929cad69d567a9732";
// 내 어플리케이션 > 카카오로그인 에서 설정한 REDIRECT_URI
$REDIRECT_URI = "https://taxtok.kr/kakao/oauth.php";

// REDIRECT_URI로 인가코드를 받기 위한 URL 
$KAKAO_OAUTH_URI = "https://kauth.kakao.com/oauth/authorize?client_id=".$APP_KEY."&redirect_uri=".$REDIRECT_URI."&response_type=code";

// REDIRECT_URI로 토큰정보를 받기 위한 URL  
$KAKAO_TOKEN_URI = "https://kauth.kakao.com/oauth/token";

// 유저정보
$KAKAO_USER_URI = "https://kapi.kakao.com/v2/user/me";

 
	
function postWithToken($url, $token) {
	
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
	
	$header = array('Authorization: Bearer '.$token, 'Content-Type: application/json', 'charset=utf-8');
	// $json = json_encode($data, JSON_UNESCAPED_SLASHES);
	
	$curl = curl_init(); 
	curl_setopt_array($curl, $opts);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	// curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
	
	$response = curl_exec($curl);
	curl_close ($curl);
	return $response;
}

function post($url, $fields) {
    $post_field_string = http_build_query($fields, '', '&');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
    curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);
    curl_close ($ch);
    return $response;
}



?>