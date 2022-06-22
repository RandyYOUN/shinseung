<?php
	
//url에 action이라는 값이 존재하면
if(isset($_GET["action"]))
{ //db연결
	
	$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
	
	$TOKEN_URL = "https://api.bizppurio.com/v1/token"; // 액세스토큰 요청URL
	$SEND_URL = "https://api.bizppurio.com/v3/message"; // 발송 URL
	$account = "shinseungat";
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


	
	
	
	
	//step2 : 시작
	if($_GET["action"] == "action_send_tok_complate"){
	    $cstid=mysqli_real_escape_string($connect,$_GET["cstid"]);
	    	    
	    $procedure = "
		CREATE PROCEDURE SELECT_SEND_TOK_COMPLATE(IN P_CSTID INT(11) )
		BEGIN
			SELECT A.CSTNAME ,
            REPLACE(A.MOBILE,'-','') AS 'MOBILE',
            B.INCOME_TAX AS 'INCOME_TAX',
            B.REPORT_NUM_INCOME AS 'REPORT_NUM_INCOME',
            B.JIBANG_TAX AS 'JIBANG_TAX',
            B.REPORT_NUM_WETAX AS 'REPORT_NUM_WETAX',
            B.REG_BRANCH AS 'REG_BRANCH',
            B.BIZ_ID
            FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
            LEFT OUTER JOIN TB100023 AS C ON B.BIZ_ID=C.BIZ_ID
            WHERE C.HomeTaxUpload='Y' 
            #AND B.BIZ_ID NOT IN (SELECT SEND_BIZ_ID FROM TB700010 WHERE SEND_TMP_STEP='AUTO_COMPLATE')
            AND B.RP_SEND_KAKAO = 'Y'
            ORDER BY C.ID DESC
            
            ;
		END;
		";
	    $send_step="AUTO_COMPLATE";
	    $flag="A1001";
	    $flag2="";
	    $userid = '101';
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_SEND_TOK_COMPLATE"))
	    {
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL SELECT_SEND_TOK_COMPLATE(".$cstid.")";
	            
	            $result = $connect->query($query);
	            
	            while($row = $result->fetch_array())
	            {
	                $rows[] = $row;
	            }
	            
	            foreach($rows as $row)
	            {
	            
	                    $CSTNAME = $row["CSTNAME"];
	                    $MOBILE = $row["MOBILE"];
	                    $INCOME_TAX = $row["INCOME_TAX"];
	                    $REPORT_NUM_INCOME = $row["REPORT_NUM_INCOME"];
	                    $JIBANG_TAX = $row["JIBANG_TAX"];
	                    $REPORT_NUM_WETAX = $row["REPORT_NUM_WETAX"];
	                    $BRANCH = $row["REG_BRANCH"];
	                    $BIZ_ID = $row["BIZ_ID"];
	                    
	                    $message = "$CSTNAME 님의 종합소득세 신고가 완료되었습니다. 

■ 납부서 확인
소득세 :  $INCOME_TAX 원
홈택스 전자신고번호 : $REPORT_NUM_INCOME

지방세 :  $JIBANG_TAX 원 
위택스 전자신고번호 : $REPORT_NUM_WETAX

납부서를 꼭 확인해주십시오. 

앞으로도 더 나은 서비스와 세무정보를 드리기 위해 최선을 다하겠습니다. 
감사합니다.";
	                    
	                    $data = array();
	                    $data["account"] = $account;
	                    $data["refkey"] = "shinseung";
	                    $data["type"] = "at";
	                    $data["from"] = "0234520608";
	                    $data["to"] = $MOBILE;
	                    /*
	                     $button2 = array("name"=>"이전 대화보기",
	                     "type"=>"WL",
	                     "url_pc"=>"https://taxtoc.channel.io",
	                     "url_mobile"=>"https://taxtoc.channel.io");
	                     */
	                    //	$button = array("button1"=>$button1,"button2"=>$button2);
	                    $button1 = Array("name" => "납부서 확인하기",
	                        "type" => "WL",
	                        "url_mobile" => "https://taxtok.kr/tax_income/cst_login.php",
	                        "url_pc" => "https://taxtok.kr/tax_income/cst_login.php"
	                    );
	                    
	                    
	                    $button[0] = $button1;
	                    
	                    $a = branch_id_return($BRANCH,"납부서확인" );
	                    $sender_id = $a["sender_id"];
	                    $template_id = $a["template_id"];
	                    
	                    $at = array(
	                        "senderkey" => $sender_id,
	                        "templatecode" => $template_id,
	                        "message" => $message,
	                        "button" => $button
	                    );
	                    
	                    $data["content"] = array("at" => $at);
	                    
	                    // 알림톡 발송
	                    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
	                    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
	                    $jsonData = json_encode($data);
	                    
	                    /*어뷰징 최종검증*/
	                    $ck_cnt = ck_send_message($BIZ_ID, $MOBILE, $template_id, $sender_id,$send_step,$flag);
	                    
	                    if($ck_cnt == 0){
	                        
	                        $curl = curl_init();
	                        curl_setopt_array($curl, $opts);
	                        curl_setopt($curl, CURLOPT_URL, $SEND_URL);
	                        curl_setopt($curl, CURLOPT_HTTPHEADER, $sendHeader);
	                        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
	                        
	                        $result = curl_exec($curl);
	                        curl_close($curl);
	                        // 알림톡 발송
	                        /*DB로그 남기기*/
	                        send_kakao_log($BIZ_ID, $MOBILE, $template_id, $sender_id,$send_step,$flag, $flag2, $userid);
	                    }else{
	                        echo 'error:abuse';
	                    }
	                    
	                    //print_r(json_decode($result));
	                    
	                }
	                
	                echo "전송완료";
	            
	        }
	    }
	}
	//step2 : 끝
	
	
	
}
	


/*지점별 id 분기처리*/
function branch_id_return($branch_id , $step_flag){
    
    if($step_flag=="수동1"){
        
        
        switch($branch_id){
            case "D1019" :
                $sender_id ="b63d000f857731a8f58397956fa3ddbd6318e49d";//세무톡
                $template_id = "bizp_2021041415210125563286776";
                break;
            case "D1003" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021041415253126670685768";
                break;
            case "D1002" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021041415253126670685768";
                break;
            case "D1014" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021041415253126670685768";
                break;
            case "D1013" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021041415253126670685768";
                break;
            case "D1004" :
                $sender_id ="964fe8801f7921690ad1797060fa25ac84abb4ef"; //용인
                $template_id = "bizp_2021041415221726670364762";
                break;
            case "D1006" :
                $sender_id ="55cde6abf7ff4d5696a2d76d280dd40797933abd";//안양
                $template_id = "bizp_2021041415224426670538764";
                break;
            case "D1007" :
                $sender_id ="c7b077e2dd61eb2f4aaabecb22b46f320047c47d";//수원
                $template_id = "bizp_2021041415231125563981777";
                break;
            case "D1008" :
                $sender_id ="ebb53d9ad7759f9e83fd3db7e8a681143f7f6993";//일산
                $template_id = "bizp_2021041415214326670665761";
                break;
            case "D1009" :
                $sender_id ="fd09db9cf6a9b12154e662aaa3aad88e91f6398b";//부천
                $template_id = "bizp_2021041415235725563969778";
                break;
            case "D1010" :
                $sender_id ="9cabc147927f4d849f891c648487c1079cd2ffad";//광주
                $template_id = "bizp_2021041415250726670263767";
                break;
            case "D1011" :
                $sender_id ="0ebb857ee7d38d23162a4703a9a12e61baec9515";//분당
                $template_id = "bizp_2021041415233426670724765";
                break;
            case "D1012" :
                $sender_id ="f94619501bd78fcbef6847dd5d1097193a32a894";//기흥
                $template_id = "bizp_2021041415244426670099766";
                break;
            case "D1021" :
                $sender_id ="e56810d07a43d4b74f22ff95178bd74efb868bda";//동탄
                $template_id = "bizp_2021041614212225563598938";
                break;
            default: $sender_id ="b63d000f857731a8f58397956fa3ddbd6318e49d";//세무톡
            $template_id = "bizp_2021041415210125563286776";
        }
        
        
    }elseif ($step_flag=="수동2"){
        
        switch($branch_id){
            case "D1019" :
                $sender_id ="b63d000f857731a8f58397956fa3ddbd6318e49d";//세무톡
                $template_id = "bizp_2021041415280726670194770";
                break;
            case "D1003" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021041415290825563978779";
                break;
            case "D1002" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021041415290825563978779";
                break;
            case "D1014" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021041415290825563978779";
                break;
            case "D1013" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021041415290825563978779";
                break;
            case "D1004" :
                $sender_id ="964fe8801f7921690ad1797060fa25ac84abb4ef"; //용인
                $template_id = "bizp_2021041415303226670954772";
                break;
            case "D1006" :
                $sender_id ="55cde6abf7ff4d5696a2d76d280dd40797933abd";//안양
                $template_id = "bizp_2021041415320826670175774";
                break;
            case "D1007" :
                $sender_id ="c7b077e2dd61eb2f4aaabecb22b46f320047c47d";//수원
                $template_id = "bizp_2021041415323226670947775";
                break;
            case "D1008" :
                $sender_id ="ebb53d9ad7759f9e83fd3db7e8a681143f7f6993";//일산
                $template_id = "bizp_2021041415295126670342771";
                break;
            case "D1009" :
                $sender_id ="fd09db9cf6a9b12154e662aaa3aad88e91f6398b";//부천
                $template_id = "bizp_2021041415335626670918777";
                break;
            case "D1010" :
                $sender_id ="9cabc147927f4d849f891c648487c1079cd2ffad";//광주
                $template_id = "bizp_2021041415362325563622782";
                break;
            case "D1011" :
                $sender_id ="0ebb857ee7d38d23162a4703a9a12e61baec9515";//분당
                $template_id = "bizp_2021041415330926670551776";
                break;
            case "D1012" :
                $sender_id ="f94619501bd78fcbef6847dd5d1097193a32a894";//기흥
                $template_id = "bizp_2021041415360126670760779";
                break;
            case "D1021" :
                $sender_id ="e56810d07a43d4b74f22ff95178bd74efb868bda";//동탄
                $template_id = "bizp_2021041614220626670958934";
                break;
            default: $sender_id ="b63d000f857731a8f58397956fa3ddbd6318e49d";//세무톡
            $template_id = "bizp_2021041415280726670194770";
        }
        
    }elseif ($step_flag=="납부서확인"){
        
        switch($branch_id){
            case "D1019" :
                $sender_id ="b63d000f857731a8f58397956fa3ddbd6318e49d";//세무톡
                $template_id = "bizp_2021042718175525563975611";
                break;
            case "D1003" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021042718185226670364665";
                break;
            case "D1002" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021042718185226670364665";
                break;
            case "D1014" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021042718185226670364665";
                break;
            case "D1013" :
                $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//강남
                $template_id = "bizp_2021042718185226670364665";
                break;
            case "D1004" :
                $sender_id ="964fe8801f7921690ad1797060fa25ac84abb4ef"; //용인
                $template_id = "bizp_2021042718103325563997605";
                break;
            case "D1006" :
                $sender_id ="55cde6abf7ff4d5696a2d76d280dd40797933abd";//안양
                $template_id = "bizp_2021042718114225563830606";
                break;
            case "D1007" :
                $sender_id ="c7b077e2dd61eb2f4aaabecb22b46f320047c47d";//수원
                $template_id = "bizp_2021042718124325563925607";
                break;
            case "D1008" :
                $sender_id ="ebb53d9ad7759f9e83fd3db7e8a681143f7f6993";//일산
                $template_id = "bizp_2021042718092126670951662";
                break;
            case "D1009" :
                $sender_id ="fd09db9cf6a9b12154e662aaa3aad88e91f6398b";//부천
                $template_id = "bizp_2021042718144126670036663";
                break;
            case "D1010" :
                $sender_id ="9cabc147927f4d849f891c648487c1079cd2ffad";//광주
                $template_id = "bizp_2021042718165126670254664";
                break;
            case "D1011" :
                $sender_id ="0ebb857ee7d38d23162a4703a9a12e61baec9515";//분당
                $template_id = "bizp_2021042718133725563761608";
                break;
            case "D1012" :
                $sender_id ="f94619501bd78fcbef6847dd5d1097193a32a894";//기흥
                $template_id = "bizp_2021042718155325563355610";
                break;
            case "D1021" :
                $sender_id ="e56810d07a43d4b74f22ff95178bd74efb868bda";//동탄
                $template_id = "bizp_2021042718081225563961604";
                break;
            default: $sender_id ="b63d000f857731a8f58397956fa3ddbd6318e49d";//세무톡
            $template_id = "bizp_2021042718175525563975611";
        }
        
    }
    
    
    return array("sender_id"=> $sender_id, "template_id"=>$template_id);
    
}


/*알림톡 발송 로그*/
function send_kakao_log($biz_id, $mobile, $temp_id, $sender_id, $send_step,$send_flag,$send_flag2,$userid){
    
    $connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
    
    $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `INSERT_TB700001`(IN P_BIZ_ID INT,
P_MOBILE VARCHAR(20),
P_TEMP_ID VARCHAR(50),
P_SENDER_ID VARCHAR(100),
P_STEP VARCHAR(20),
P_FLAG VARCHAR(10),
P_FLAG2 VARCHAR(45),
P_USERID VARCHAR(4)
)
BEGIN
        
DECLARE CNT INT;
DECLARE TMP_CSTID INT;
        
    SELECT ifnull(COUNT(1),0) INTO CNT FROM TB700010
    WHERE SEND_BIZ_ID = P_BIZ_ID AND SEND_TMP_ID = P_TEMP_ID AND SENDER_ID = P_SENDER_ID
    AND SEND_TMP_STEP = P_STEP AND SEND_FLAG=P_FLAG;
        
    #IF CNT = 0 THEN

        INSERT INTO TB700010(SEND_BIZ_ID, SEND_MOBILE_NUM,SENDER_ID, SEND_TMP_ID, SEND_DATE, SEND_FLAG, SEND_TMP_STEP,SEND_FLAG2,REGUSER,REGDATE)
        SELECT P_BIZ_ID, P_MOBILE,P_SENDER_ID, P_TEMP_ID, NOW(), P_FLAG, P_STEP, P_FLAG2,P_USERID,NOW();
        
        SELECT last_insert_id() INTO TMP_CSTID;

    #END IF;
    UPDATE TB100022 SET RP_SEND_KAKAO='' WHERE BIZ_ID = P_BIZ_ID;    
    SELECT TMP_CSTID;
        
END
		";
    
    //기존에 프로시저가 있으면 삭제
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB700001"))
    { //위에서 만든 프로시저 실행
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL INSERT_TB700001('".$biz_id."','".$mobile."','".$temp_id."','".$sender_id."','".$send_step."','".$send_flag."','".$send_flag2."','".$userid."')";
            //프로시저 호출
            try{
                
                mysqli_query($connect,$query);
                //echo "send_ok";
                
            }catch (Exception  $e){
                echo "error==>>".$e;
            }
            
            
        }
    }
    //$connect=null;
    
}



function ck_send_message($biz_id, $mobile, $temp_id, $sender_id, $send_step,$send_flag){
    
    $connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
    
    $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `CK_SENDLOG_TB700001`(IN P_BIZ_ID INT,
P_MOBILE VARCHAR(20),
P_TEMP_ID VARCHAR(50),
P_SENDER_ID VARCHAR(100),
P_STEP VARCHAR(10),
P_FLAG VARCHAR(10)
)
BEGIN
        
DECLARE CNT INT;
        
    SELECT ifnull(COUNT(1),0) INTO CNT FROM TB700010
    WHERE SEND_BIZ_ID = P_BIZ_ID 
    AND SEND_MOBILE_NUM = P_MOBILE    
    AND SEND_TMP_STEP = P_STEP 
    AND SEND_FLAG=P_FLAG;
    SELECT CNT;
        
END
		";
    
    //기존에 프로시저가 있으면 삭제
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS CK_SENDLOG_TB700001"))
    { //위에서 만든 프로시저 실행
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL CK_SENDLOG_TB700001('".$biz_id."','".$mobile."','".$temp_id."','".$sender_id."','".$send_step."','".$send_flag."')";
            //프로시저 호출
            try{
                $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
                if(mysqli_num_rows($result) >0)
                {
                    while($row = mysqli_fetch_array($result)){
                        
                        $CNT = $row["CNT"];
                    }
                }
                
            }catch (Exception  $e){
                echo "error==>>".$e;
            }
            
            
        }
    }
    
    return $CNT;
    
}


?>