<?php
	
//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
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


	
	
	
	//재산제세 수동톡발송 : 시작
	if($_POST["action"] == "action_tok_trans"){
	    $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
	    
	    $procedure = "
		CREATE PROCEDURE SELECT_TOK_TRANS(IN P_CSTID INT(11) )
		BEGIN
			SELECT CSTID, CSTNAME
			FROM TB600010 
			WHERE CSTID = P_CSTID limit 1;
		END;
		";
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TOK_TRANS"))
	    {
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL SELECT_TOK_TRANS(".$cstid.",".$bizid.")";
	            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
	            
	            if(mysqli_num_rows($result) >0)
	            {
	                while($row = mysqli_fetch_array($result)){
	                    
	                    $MOBILE = $row["MOBILE"];
	                    
	                    $message = "고객님
(별) 신고대행을 의뢰해주셔서 감사드립니다.
아래의 필요서류 안내요청 버튼을 클릭하셔서
(꽃) 고객님 성함을 적어주십시오.
	                        
신고담당자가 추가 필요서류 및 신고 진행사항을 안내해드리겠습니다.
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
	                    $button1 = Array("name" => "필요서류 안내요청",
	                        "type" => "WL",
	                        "url_mobile" => "http://pf.kakao.com/_vexexkC/chat",
	                        "url_pc" => "http://pf.kakao.com/_vexexkC/chat"
	                    );
	                    
	                    
	                    $button[0] = $button1;
	                    
	                    $at = array(
	                        "senderkey" => "64427a5eb014f403b09932ea56cc77cf68f7effe",
	                        "templatecode" => "bizp_2021020113153725563775173",
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
	                        send_kakao_log($BIZ_ID, $MOBILE, $template_id, $sender_id,$send_step,$flag,$flag2,$userid);
	                    }else{
	                        echo 'error:abuse';
	                        
	                    }
	                    
	                    
	                    //print_r(json_decode($result));
	                    echo "전송완료";
	                }
	            }
	        }
	    }
	}
	//step2 : 끝
	


//step2 : 시작
	if($_POST["action"] == "action_tok_step2"){
		$cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
		$bizid=mysqli_real_escape_string($connect,$_POST["bizid"]);
		
		$procedure = "
		CREATE PROCEDURE SELECT_STEP2(IN P_CSTID INT(11), P_BIZID INT(11) )
		BEGIN
			SELECT A.CSTID AS CSTID, A.CSTNAME AS CSTNAME, 
			A.MOBILE AS MOBILE, B.EST_FEE AS EST_FEE 
			FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B 
			ON A.CSTID = B.CSTID 
			WHERE A.CSTID = P_CSTID limit 1;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_STEP2"))
		{
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL SELECT_STEP2(".$cstid.",".$bizid.")";
				$result = mysqli_query($connect,$query) or die(mysqli_error($connect));
				
				if(mysqli_num_rows($result) >0)
				{
					while($row = mysqli_fetch_array($result)){

						$MOBILE = $row["MOBILE"];
						
	$message = "고객님
(별) 신고대행을 의뢰해주셔서 감사드립니다. 
아래의 필요서류 안내요청 버튼을 클릭하셔서 
(꽃) 고객님 성함을 적어주십시오. 

신고담당자가 추가 필요서류 및 신고 진행사항을 안내해드리겠습니다. 
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
						$button1 = Array("name" => "필요서류 안내요청",
						"type" => "WL",
						"url_mobile" => "http://pf.kakao.com/_vexexkC/chat",
						"url_pc" => "http://pf.kakao.com/_vexexkC/chat"
						);


						$button[0] = $button1;
						
						$at = array(
							"senderkey" => "64427a5eb014f403b09932ea56cc77cf68f7effe",
							"templatecode" => "bizp_2021020113153725563775173",
							"message" => $message,
							"button" => $button
						);

						$data["content"] = array("at" => $at);
						
						// 알림톡 발송
						$sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
						//$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
						$jsonData = json_encode($data);
						
						$curl = curl_init(); 
						curl_setopt_array($curl, $opts);
						curl_setopt($curl, CURLOPT_URL, $SEND_URL);
						curl_setopt($curl, CURLOPT_HTTPHEADER, $sendHeader);
						curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
						
						$result = curl_exec($curl);
						curl_close($curl); 
						
						//print_r(json_decode($result));
						echo "전송완료";
					}
				}
			}
		} 
	}
//step2 : 끝



//재산제세 수동발송 : 시작
	if($_POST["action"] == "action_admin_vatRPA_tok"){
		$id=mysqli_real_escape_string($connect,$_POST["id"]);
		
		$procedure = "
		CREATE PROCEDURE SELECT_VAT_MOBILE(IN P_ID INT(11))
		BEGIN
			SELECT MOBILE
			FROM TB100020 
			WHERE CSTID = P_ID;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_VAT_MOBILE"))
		{
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL SELECT_VAT_MOBILE(".$id.")";
				$result = mysqli_query($connect,$query) or die(mysqli_error($connect));
				
				if(mysqli_num_rows($result) >0)
				{
					while($row = mysqli_fetch_array($result)){

						$MOBILE = $row["MOBILE"];
						
	$message = "고객님
(별) 신고대행을 의뢰하시려면 
아래의 신고대행의뢰 버튼을 클릭하셔서 
(해) 고객님 성함을 적어주십시오. 

신고담당자가 수수료 입금계좌 및 추가 필요서류를 안내해드리겠습니다. 
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
						$button1 = Array("name" => "신고대행의뢰",
						"type" => "WL",
						"url_mobile" => "http://pf.kakao.com/_vexexkC/chat",
						"url_pc" => "http://pf.kakao.com/_vexexkC/chat"
						);


						$button[0] = $button1;
						
						$at = array(
							"senderkey" => "64427a5eb014f403b09932ea56cc77cf68f7effe",
							"templatecode" => "bizp_2021020113183225563431174",
							"message" => $message,
							"button" => $button
						);

						$data["content"] = array("at" => $at);
						
						// 알림톡 발송
						$sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
						//$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
						$jsonData = json_encode($data);
						
						$curl = curl_init(); 
						curl_setopt_array($curl, $opts);
						curl_setopt($curl, CURLOPT_URL, $SEND_URL);
						curl_setopt($curl, CURLOPT_HTTPHEADER, $sendHeader);
						curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
						
						$result = curl_exec($curl);
						curl_close($curl); 
						
						//print_r(json_decode($result));
						echo "전송완료";
					}
				}
			}
		} 
	}
//재산제세 수동발송 : 끝


	
	
	
//영업현황 수동발송1 : 시작
	if($_POST["action"] == "Send_RPA_Reg_Self1"){
	    $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
	    $bizid=mysqli_real_escape_string($connect,$_POST["bizid"]);
	    $flag=mysqli_real_escape_string($connect,$_POST["tmp_flag"]);
	    $flag2=mysqli_real_escape_string($connect,$_POST["tmp_flag2"]);
	    $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
	    $send_step="STEP01";
	    
	    $procedure = "
		CREATE PROCEDURE SELECT_INC_SELF1(IN P_CSTID INT(11))
		BEGIN
			SELECT A.MOBILE, A.CSTNAME, B.BIZ_ID,B.REG_BRANCH,
            FORMAT(CAL_INC(A.CSTID),0) AS 'EXP_PAY_TAX_FN',
            CAL_FEE_CHANGE_DATE(A.CSTID) AS 'CAL_EST_FEE_FN'
			FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B
            ON A.CSTID = B.CSTID
			WHERE A.CSTID = P_CSTID;
		END;
		";
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_INC_SELF1"))
	    {
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL SELECT_INC_SELF1(".$cstid.")";
	            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
	            $count = mysqli_num_rows($result);
	            
	            if($count >0)
	            {
	                while($row = mysqli_fetch_array($result)){
	                    
	                    $MOBILE = $row["MOBILE"];
	                    $BIZ_ID = $row["BIZ_ID"];
	                    $BRANCH = $row["REG_BRANCH"];
	                    
	                    /*지점별 sender_id, template_id 셋팅*/
	                    $a = branch_id_return($BRANCH,"수동1" );
	                    $sender_id = $a["sender_id"];
	                    $template_id = $a["template_id"];
	                    
	                    
	                    if($sender_id == "e56810d07a43d4b74f22ff95178bd74efb868bda"){
	                        $message = "[신승세무법인] 종합소득세신고 안내 

사장님 

종합소득세 신고관련 문의주셔서 감사드립니다. 

■ 신고기간
2021년 5월 1일 ~ 5월 31일 (월) 까지 

▶ 신고관련 문의 및 접수 
아래의 카톡 채팅창에 
♥ 고객님 성함을 적어주십시오. 

신고담당자가 신고대행 수수료 및 필요서류를 안내해드리겠습니다.";
	                        
	                    }else{
	                    /* 지점별 메시지 셋팅*/
	                    $message = "사장님 

종합소득세 신고관련 문의주셔서 감사드립니다. 

■ 신고기간
2021년 5월 1일 ~ 5월 31일 (월) 까지 

▶ 신고관련 문의 및 접수 
아래의 카톡 채팅창에 
♥ 고객님 성함을 적어주십시오. 

신고담당자가 신고대행 수수료 및 필요서류를 안내해드리겠습니다.";
	                   }
	                   
	                   
	                    $data = array();
	                    $data["account"] = $account;
	                    $data["refkey"] = "shinseung";
	                    $data["type"] = "at";
	                    $data["from"] = "0234520608";
	                    $data["to"] = $MOBILE;
	                    
	                    
	                    $at = array(
	                        "senderkey" => $sender_id,
	                        "templatecode" => $template_id ,
	                        "message" => $message
	                    );
	                    /*버튼셋팅*/
	                    /*
	                    if($sender_id=="b63d000f857731a8f58397956fa3ddbd6318e49d"){ //세무톡
	                        $button1 = Array("name" => "세무톡 링크",
	                            "type" => "WL",
	                            "url_mobile" => "http://pf.kakao.com/_URxgxfT/chat",
	                            "url_pc" => "http://pf.kakao.com/_URxgxfT/chat"
	                        );
	                        $button[0] = $button1;
	                        
	                        $at = array(
	                            "senderkey" => $sender_id,
	                            "templatecode" => $template_id ,
	                            "message" => $message,
	                            "button" => $button
	                        );
	                        
	                    }else{ //세무톡이외 지점들
	                        $at = array(
	                            "senderkey" => $sender_id,
	                            "templatecode" => $template_id ,
	                            "message" => $message
	                        );
	                    }*/
	                    /*버튼셋팅*/
	                    
	                    /*
	                     * //2번버튼
	                     $button2 = array("name"=>"이전 대화보기",
	                     "type"=>"WL",
	                     "url_pc"=>"https://taxtoc.channel.io",
	                     "url_mobile"=>"https://taxtoc.channel.io");
	                     */
	                    //	$button = array("button1"=>$button1,"button2"=>$button2);
	                    
	                    
	                    
	                    
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
	                    
	                } // WHILE
	                
	                $connect=null;
	            }
	        }
	    }
	    
	}
	//영업현황 수동발송1  : 끝
	
	
	
	
	
	
//영업현황 수동발송2 : 시작
	if($_POST["action"] == "Send_RPA_Reg_Self2"){
	    $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
	    $bizid=mysqli_real_escape_string($connect,$_POST["bziid"]);
	    $flag=mysqli_real_escape_string($connect,$_POST["tmp_flag"]);
	    $flag2=mysqli_real_escape_string($connect,$_POST["tmp_flag2"]);
	    $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
	    $send_step="STEP02";
	    
	    $procedure = "
		CREATE PROCEDURE SELECT_INC_SELF2(IN P_CSTID INT(11))
		BEGIN
			SELECT A.MOBILE, A.CSTNAME, B.BIZ_ID,B.REG_BRANCH,
            FORMAT(CAL_INC(A.CSTID),0) AS 'EXP_PAY_TAX_FN',
            CAL_FEE_CHANGE_DATE(A.CSTID) AS 'CAL_EST_FEE_FN',
            FORMAT(B.EST_FEE_SELF,0) AS 'EST_FEE_SELF_',
            FORMAT(B.EXP_PAY_TAX_SELF,0) AS 'EXP_PAY_TAX_SELF_'
			FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B
            ON A.CSTID = B.CSTID
			WHERE A.CSTID = P_CSTID;
		END;
		";
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_INC_SELF2"))
	    {
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL SELECT_INC_SELF2(".$cstid.")";
	            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
	            $count = mysqli_num_rows($result);
	            
	            if($count >0)
	            {
	                while($row = mysqli_fetch_array($result)){
	                    
	                    
	                    if($flag2=="수동계산"){
	                        $EXP_PAY_TAX = $row["EXP_PAY_TAX_SELF_"];
	                        $EST_FEE = $row["EST_FEE_SELF_"];
	                    }else{
                            $EXP_PAY_TAX = $row["EXP_PAY_TAX_FN"];
                            $EST_FEE = $row["CAL_EST_FEE_FN"];
	                    }
	                    
	                    $MOBILE = $row["MOBILE"];
	                    //$EXP_PAY_TAX = $row["EXP_PAY_TAX_FN"];
	                    //$EST_FEE = $row["CAL_EST_FEE_FN"];
	                    $CSTNAME = $row["CSTNAME"];
	                    $BIZ_ID = $row["BIZ_ID"];
	                    $BRANCH = $row["REG_BRANCH"];
	                    
	                    /*지점별 sender_id, template_id 셋팅*/
	                    $a = branch_id_return($BRANCH,"수동2" );
	                    $sender_id = $a["sender_id"];
	                    $template_id = $a["template_id"];
	                    
	                    /* 지점별 메시지 셋팅*/
	                    $message = "$CSTNAME 님의 종합소득세 신고에 대해 안내드립니다.

■ 예상납부세액 
$EXP_PAY_TAX 원

■ 신고대행 수수료 
$EST_FEE 원

▶ 신고관련 문의 및 접수 
아래의 카톡 채팅창에 
♥ 고객님 성함을 적어주십시오. 

신고담당자가 수수료 입금계좌 및 추가 필요서류를 안내해드리겠습니다. 

■ 유의사항
예상 납부세액이 마이너스이면 환급금액입니다. 
예상 납부세액은 사업소득 기준 계산된 세액이며, [타소득여부]에 따라 실제 신고시에는 다소 상이할 수 있습니다. 

신고대행 수수료는 서류 검토 후 조정될 수 있습니다. 
이점 양해부탁드립니다

====================

쉽고, 싸고, 편한 종합소득세 신고 
신고 대행을 맡겨주시면 절세 포인트를 찾아 드리고, 
카톡으로 진행사항을 안내해드립니다. 

언제, 어디서나 
믿고 맡길 수 있는 국세청 33년 경력 신승세무법인";
	                    
	                    $data = array();
	                    $data["account"] = $account;
	                    $data["refkey"] = "shinseung";
	                    $data["type"] = "at";
	                    $data["from"] = "0234520608";
	                    $data["to"] = $MOBILE;
	                   
	                    /*버튼셋팅*/
	                    $at = array(
	                        "senderkey" => $sender_id,
	                        "templatecode" => $template_id ,
	                        "message" => $message
	                    );
	                    /*버튼셋팅*/
	                    
	                    /*
	                     * //2번버튼
	                     $button2 = array("name"=>"이전 대화보기",
	                     "type"=>"WL",
	                     "url_pc"=>"https://taxtoc.channel.io",
	                     "url_mobile"=>"https://taxtoc.channel.io");
	                     */
	                    //	$button = array("button1"=>$button1,"button2"=>$button2);
	                    
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
	                    
	                    
	                } // WHILE
	                
	                $connect=null;
	                
	            }
	        }
	    }
	    
	}
//영업현황 수동발송2  : 끝
	
	
	
	
//자동발송1 : 시작
	if($_POST["action"] == "Send_RPA_Reg_Auto1"){
	    $id=mysqli_real_escape_string($connect,$_POST["id"]);
	    $flag=mysqli_real_escape_string($connect,$_POST["tmp_flag"]);
	    $send_step="AUTO_STEP01";
	    
	    $procedure = "
		CREATE PROCEDURE SELECT_INC_AUTO1(IN P_ID INT(11))
		BEGIN
			SELECT A.CSTID, A.CSTNAME, A.MOBILE,A.HomeTaxID,A.HomeTaxPW, 
                FORMAT(B.AMOUNT_PAID,0) AS 'EXP_PAY_TAX_FN',
                FORMAT(CAL_FEE_MONEY( B.AMOUNT_PAID ),0) AS 'EST_FEE_FN',
                RESIDENT_ID_1(A.RESIDENT_ID) AS 'RESIDENT_ID1',
                RESIDENT_ID_2(A.RESIDENT_ID) AS 'RESIDENT_ID2'
            FROM TB100020 AS A LEFT OUTER JOIN TB100032 AS B ON A.CSTID = B.CSTID 
            WHERE A.CSTID = P_ID;
		END;
		";
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_INC_AUTO1"))
	    {
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL SELECT_INC_AUTO1(".$id.")";
	            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
	            $count = mysqli_num_rows($result);
	            
	            if($count >0)
	            {
	                while($row = mysqli_fetch_array($result)){
	                    
	                    $MOBILE = $row["MOBILE"];
	                    $EXP_PAY_TAX = $row["EXP_PAY_TAX_FN"];
	                    $EST_FEE = $row["EST_FEE_FN"];
	                    $CSTNAME = $row["CSTNAME"];
	                    $BIZ_ID = $row["BIZ_ID"];
	                    $BRANCH = $row["REG_BRANCH"];
	                    
	                    /*지점별 sender_id, template_id 셋팅*/
	                    //$a = branch_id_return($BRANCH,"수동2" );
	                    $sender_id = "b63d000f857731a8f58397956fa3ddbd6318e49d";
	                    $template_id = "bizp_2021041415280726670194770";
	                    
	                    /* 지점별 메시지 셋팅*/
	                    $message = "$CSTNAME 님의 종합소득세 신고에 대해 안내드립니다.
	                    
■ 예상납부세액
$EXP_PAY_TAX 원

■ 신고대행 수수료
$EST_FEE 원

▶ 신고관련 문의 및 접수
아래의 카톡 채팅창에
♥ 고객님 성함을 적어주십시오.

신고담당자가 수수료 입금계좌 및 추가 필요서류를 안내해드리겠습니다.

■ 유의사항
예상 납부세액이 마이너스이면 환급금액입니다.
예상 납부세액은 사업소득 기준 계산된 세액이며, [타소득여부]에 따라 실제 신고시에는 다소 상이할 수 있습니다.

신고대행 수수료는 서류 검토 후 조정될 수 있습니다.
이점 양해부탁드립니다

====================

쉽고, 싸고, 편한 종합소득세 신고
신고 대행을 맡겨주시면 절세 포인트를 찾아 드리고,
카톡으로 진행사항을 안내해드립니다.

언제, 어디서나
믿고 맡길 수 있는 국세청 33년 경력 신승세무법인";

$data = array();
$data["account"] = $account;
$data["refkey"] = "shinseung";
$data["type"] = "at";
$data["from"] = "0234520608";
$data["to"] = $MOBILE;

/*버튼셋팅*/
$at = array(
    "senderkey" => $sender_id,
    "templatecode" => $template_id ,
    "message" => $message
);
/*버튼셋팅*/

/*
 * //2번버튼
 $button2 = array("name"=>"이전 대화보기",
 "type"=>"WL",
 "url_pc"=>"https://taxtoc.channel.io",
 "url_mobile"=>"https://taxtoc.channel.io");
 */
//	$button = array("button1"=>$button1,"button2"=>$button2);

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
    send_kakao_log($BIZ_ID, $MOBILE, $template_id, $sender_id,$send_step,$flag,$flag2,$userid);
}else{
    echo 'error:abuse';
    
}


	                } // WHILE
	                
	                $connect=null;
	                
	            }
	        }
	    }
	    
	}
//자동발송1  : 끝
	


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
        
    IF CNT = 0 THEN

        INSERT INTO TB700010(SEND_BIZ_ID, SEND_MOBILE_NUM,SENDER_ID, SEND_TMP_ID, SEND_DATE, SEND_FLAG, SEND_TMP_STEP,SEND_FLAG2,REGUSER)
        SELECT P_BIZ_ID, P_MOBILE,P_SENDER_ID, P_TEMP_ID, NOW(), P_FLAG, P_STEP, P_FLAG2,P_USERID;
        
        SELECT last_insert_id() INTO TMP_CSTID;

    END IF;
        
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
                echo "send_ok";
                
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