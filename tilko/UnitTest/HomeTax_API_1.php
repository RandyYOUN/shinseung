<?php

set_include_path(get_include_path() . PATH_SEPARATOR . '../phpseclib1.0.19');
require_once('Crypt/RSA.php');
// $id="rotc34";
// $pw="dlwodyd72@";
// $year="2020";

//$action = $_POST["action"];
$action = "select_json";

//dev : 시작
if($action == "select_json"){
    $id = $_POST["input_id"];
    $pw = $_POST["input_pw"];
    $year = $_POST["year"];
    
    $apiHost   = "https://api.tilko.net/";
    $apiKey    = "70147f7862ef4520b928185085a9afea";
    
    // RSA Public Key 조회
    $rsaPublicKey   = getPublicKey($apiKey);
    //print("rsaPublicKey:" . $rsaPublicKey);
    
    
    // AES Secret Key 및 IV 생성
    $aesKey     = random_bytes(16);
    $aesIv      = str_repeat(chr(0), 16);
    
    
    // AES Key를 RSA Public Key로 암호화
    $rsa            = new Crypt_RSA();
    $rsa->loadKey($rsaPublicKey);
    $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    
    $aesCipheredKey = $rsa->encrypt($aesKey);
    
    
    // API URL 설정(정부24 간편인증 요청: https://tilko.net/Help/Api/POST-api-apiVersion-GovSimpleAuth-SimpleAuthRequest)
    $url        = $apiHost . "api/v1.0/hometaxidlogin/uternaat32";
    
    
    // API 요청 파라미터 설정
    $headers    = array(
        "Content-Type:"             . "application/json",
        "API-Key:"                  . $apiKey,
        "ENC-Key:"                  . base64_encode($aesCipheredKey),
    );
    
    $bodies     = array(
        "UserId"                  => aesEncrypt($aesKey, $aesIv, $id),
        "UserPassword"                 => aesEncrypt($aesKey, $aesIv, $pw),
        "Year"       => $year,
    );
    
    
    // API 호출
    $curl   = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL             => $url,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_CUSTOMREQUEST   => "POST",
        CURLOPT_POSTFIELDS      => json_encode($bodies),
        CURLOPT_HTTPHEADER      => $headers,
        CURLOPT_VERBOSE         => false,
        CURLOPT_SSL_VERIFYHOST  => 0,
        CURLOPT_SSL_VERIFYPEER  => 0
    ));
    
    $response   = curl_exec($curl);
    
    curl_close($curl);
    
    //print($response);
    $stat = json_decode( $response , true );
    //echo 'icmAmt = '.$stat['Result']['bmanIcmKndInqrList']['Rows'][0]['icmAmt']."<br>";
    //echo '사업소득 외 합산대상 타소득자료 유무 - 기타 = '.$stat['Result']['Maps'][0]['etcIncAmtYn'];
    $output = array();
    
    $output = array();
    
    $Status = $stat['Status'];
    $Message = $stat['Message'];
    // 총수입금액
    $total_paid = $stat['Result']['bmanIcmKndInqrList']['Rows'][0]['totaSumIcmAmt'];
    $length = count($stat['Result']['bmanIcmKndInqrList']['Rows']);
    //$length_map = count($stat['Result']['Map1']);
    
    // 4천만원 이상이하에 맞춰 경비율 자가/초과 부분 분류
    if($total_paid > 40000000)
        $ext_ratio = $stat['Result']['bmanIcmKndInqrList']['Rows'][0]['smplXpsrtMhRte'];
    else
        $ext_ratio = $stat['Result']['bmanIcmKndInqrList']['Rows'][0]['smplXpsrtGnrlRte'];
            
    $output['Status'] = $Status;
    $output['Message'] = $Message;
    $output['total_paid'] = $total_paid; // 총수입금액
    $output['ext_ratio'] = $ext_ratio; // 경비율
    $output['del_price'] = $stat['Result']['Map1']['npInfeeDdcAmt']; // 소득공제 - 국민연금보험료
    $output['add_tax'] = $stat['Result']['Map1']['pwtxTxamt']; // 기납부세액 - 원천징수세액
    
    for($i=0; $i<$length;$i++){
        $output['xpsrt'][$i] = $stat['Result']['bmanIcmKndInqrList']['Rows'][$i]['xpsrt']; // 추계신고시 적용경비율 : 단순/기준경비율
        $output['bmanNm'][$i] = $stat['Result']['bmanIcmKndInqrList']['Rows'][$i]['bmanNm']; // 상호
        $output['txprDscmNoEncCntn'][$i] = $stat['Result']['bmanIcmKndInqrList']['Rows'][$i]['txprDscmNoEncCntn']; // 사업자번호
        $output['tfbCd'][$i] = $stat['Result']['bmanIcmKndInqrList']['Rows'][$i]['tfbCd']; // 업종코드
    }
    
    $output['intrIncAmtYn'] = $stat['Result']['Map1']['intrIncAmtYn']; // 사업소득 외 합산대상 타소득자료 우무 - 이자
    $output['etcIncAmtYn'] = $stat['Result']['Map1']['etcIncAmtYn']; // 사업소득 외 합산대상 타소득자료 우무 - 기타
    $output['dblErinAmtYn'] = $stat['Result']['Map1']['dblErinAmtYn']; // 사업소득 외 합산대상 타소득자료 우무 - 근로(복수)
    $output['erinAmtYn'] = $stat['Result']['Map1']['erinAmtYn']; // 사업소득 외 합산대상 타소득자료 우무 - 근로(단일)
    $output['dvdnIncAmtYn'] = $stat['Result']['Map1']['dvdnIncAmtYn']; // 사업소득 외 합산대상 타소득자료 우무 - 배당
    $output['pnsnIncAmtYn'] = $stat['Result']['Map1']['pnsnIncAmtYn']; // 사업소득 외 합산대상 타소득자료 우무 - 연금
    
    
    $output['rows_cnt'] = $length;
    
    
    echo json_encode($output);
    
}

// AES 암호화 함수
function aesEncrypt($aesKey, $aesIv, $plainText) {
    $ret = openssl_encrypt($plainText, 'AES-128-CBC', $aesKey, OPENSSL_RAW_DATA, $aesIv);	//default padding은 PKCS7 padding
    return base64_encode($ret);
}


// RSA 공개키(Public Key) 조회 함수
function getPublicKey($apiKey) {
    global $apiHost;

    $url        = $apiHost . "api/Auth/GetPublicKey?APIkey=" . $apiKey;

    $curl       = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL             => $url,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_CUSTOMREQUEST   => "GET",
        CURLOPT_SSL_VERIFYHOST  => 0,
        CURLOPT_SSL_VERIFYPEER  => 0
    ));

    $response   = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true)["PublicKey"];
}


/*
// RSA Public Key 조회
$rsaPublicKey   = getPublicKey($apiKey);
//print("rsaPublicKey:" . $rsaPublicKey);


// AES Secret Key 및 IV 생성
$aesKey     = random_bytes(16);
$aesIv      = str_repeat(chr(0), 16);


// AES Key를 RSA Public Key로 암호화
$rsa            = new Crypt_RSA();
$rsa->loadKey($rsaPublicKey);
$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);

$aesCipheredKey = $rsa->encrypt($aesKey);


// API URL 설정(정부24 간편인증 요청: https://tilko.net/Help/Api/POST-api-apiVersion-GovSimpleAuth-SimpleAuthRequest)
$url        = $apiHost . "api/v1.0/hometaxidlogin/uternaat32";


// API 요청 파라미터 설정
$headers    = array(
    "Content-Type:"             . "application/json",
    "API-Key:"                  . $apiKey,
    "ENC-Key:"                  . base64_encode($aesCipheredKey),
);

$bodies     = array(
    "UserId"                  => aesEncrypt($aesKey, $aesIv, "rotc34"),
    "UserPassword"                 => aesEncrypt($aesKey, $aesIv, "dlwodyd72@"),
    "Year"       => "2020",
);


// API 호출
$curl   = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL             => $url,
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_CUSTOMREQUEST   => "POST",
    CURLOPT_POSTFIELDS      => json_encode($bodies),
    CURLOPT_HTTPHEADER      => $headers,
    CURLOPT_VERBOSE         => false,
    CURLOPT_SSL_VERIFYHOST  => 0,
    CURLOPT_SSL_VERIFYPEER  => 0
));

$response   = curl_exec($curl);

curl_close($curl);

print($response);
print "<br><br><br><br>";
$stat = json_decode( $response , true );
//$test1 = var_dump( $stat['Result']['Maps']);
echo 'icmAmt = '.$stat['Result']['bmanIcmKndInqrList']['Rows'][0]['icmAmt']."<br>";
echo '사업소득 외 합산대상 타소득자료 유무 - 기타 = '.$stat['Result']['Maps'][0]['etcIncAmtYn'];
*/
?>
