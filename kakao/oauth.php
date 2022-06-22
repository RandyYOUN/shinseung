<?php

include_once 'common.php';

$code = $_GET["code"];

if ($code != null) {
	
	// 요청 파라미터
	$data = array(
		'grant_type' => 'authorization_code',
		'client_id' => $APP_KEY,
		'redirect_uri' => $REDIRECT_URI,
		'code' => $code
	);
	
	$result = post($KAKAO_TOKEN_URI, $data);
	$result = json_decode($result, true);
	
	// 세션에 토큰 저장하고 리다이렉트
	$_SESSION['token'] = $result['access_token'];
	header('Location: https://taxtok.kr/kakao/user.php');
}


?>