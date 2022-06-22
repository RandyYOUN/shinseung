<?php
include "../db_info.php";	
//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
	
	//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    

    
    
    //접수현황 리스트 알림톡발송 : 시작

        
        
        
        
        
        
        
        //step2 : 시작
    if($_POST["action"] == "action_send_tok_complate"){
            
            $http_host = $_SERVER['HTTP_HOST'];
            if($http_host=="localhost")
                $connect = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
            else
                $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
                
            $id=mysqli_real_escape_string($connect,$_POST["id"]);
            
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
            
               
            $procedure = "
CREATE PROCEDURE SELECT_SEND_TOK_COMPLATE(P_BIZ_ID INT)
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
    #AND B.RP_SEND_KAKAO = 'Y'
    AND B.BIZ_ID = P_BIZ_ID
    #ORDER BY C.ID DESC
                
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
                    $query = "CALL SELECT_SEND_TOK_COMPLATE(".$id.")";
                            
                            
                    $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
                    
                    if(mysqli_num_rows($result) >0)
                    {
                        while($row = mysqli_fetch_array($result)){
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
                            
                            //$a = branch_id_return($BRANCH,"납부서확인" );
                            $sender_id = "64427a5eb014f403b09932ea56cc77cf68f7effe";
                            $template_id = "bizp_2021042718185226670364665";
                            /*
                             *  default: $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//세무톡
            $template_id = "bizp_2021042718185226670364665";
                             * */
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
                        }
                    }
                    
                    echo "전송완료";
                    
                }
            }
        
        //step2 : 끝
    }
    //전문상담 리스트 알림톡발송: 끝
    
    
    

    //전문상담 리스트 알림톡발송 : 시작
    if($_POST["action"] == "MENUPOP_CAL_KAKAO_SEND_P"){
        
        
        $CSTNAME=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $flag_type_name=mysqli_real_escape_string($connect,$_POST["flag_type_name"]);
        $EXP_PAY_TAX=mysqli_real_escape_string($connect,$_POST["exp_pay_tax"]);
        $EST_FEE=mysqli_real_escape_string($connect,$_POST["est_fee"]);
        $AUTH_CODE=mysqli_real_escape_string($connect,$_POST["auth_code"]);
        $temp_id=mysqli_real_escape_string($connect,$_POST["tmp_id"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        $err = "전송완료";
        $mobile = str_replace('-','',$mobile);
        $REGDATE = "~ 2022년 5월 31일 (화)";
        
        try{
            
            fn_switch_kakao_send($temp_id,$CSTNAME,$EXP_PAY_TAX ,$EST_FEE,$AUTH_CODE,$mobile,0,$userid,$REGDATE);
            //send_kakao_shinseung_popup_menu_cal($mobile , 101 , $message,"E4006","","팝업메뉴 세액계산기 알림톡발송");
            
        }catch(Exception $e){
            $err = $e->getMessage().'(오류코드 : '.$e->getCode().')';
        }
        
        echo $err ;
    }
    //전문상담 리스트 알림톡발송: 끝
    
    
    
    
    //전문상담 리스트 알림톡발송 : 시작
    if($_POST["action"] == "send_kakao_pro"){
                
        $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
        $bizid=mysqli_real_escape_string($connect,$_POST["bizid"]);
        $tmp_flag=mysqli_real_escape_string($connect,$_POST["tmp_flag"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        $temp_id=mysqli_real_escape_string($connect,$_POST["temp_id"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $err = "전송완료";
        $mobile = str_replace('-','',$mobile);
        $REGDATE = "~ 2022년 5월 31일 (화)";

try{
    
    $procedure = "
		CREATE PROCEDURE SELECT_CST_PRO_LIST(IN P_CSTID INT(11), P_BIZ_ID INT(11) )
		BEGIN
            SELECT A.CSTNAME, A.MOBILE, FORMAT(B.EST_FEE_SELF,0) AS EST_FEE_SELF_ ,FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF_, 
            SELECT_AUTH_CODE_TO_EST_FEE(P_BIZ_ID,EST_FEE_SELF) AS AUTH_CODE
            FROM TB100020 AS A
            LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
            WHERE A.CSTID = P_CSTID
            AND B.BIZ_ID = P_BIZ_ID 
;
		END;
		";
    
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CST_PRO_LIST"))
    {
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL SELECT_CST_PRO_LIST(".$cstid.", ".$bizid.")";
            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
            
            if(mysqli_num_rows($result) >0)
            {
                while($row = mysqli_fetch_array($result)){
                    
                    $CSTNAME = $row["CSTNAME"];
                    $MOBILE = $row["MOBILE"];
                    $EST_FEE = $row["EST_FEE_SELF_"];
                    $EXP_PAY_TAX = $row["EXP_PAY_TAX_SELF_"];
                    $AUTH_CODE = $row["AUTH_CODE"];
                    

                }
            }
        }
    }
    
    fn_switch_kakao_send($temp_id,$CSTNAME,$EXP_PAY_TAX ,$EST_FEE,$AUTH_CODE,$mobile,$bizid,$userid,$REGDATE);
    //send_kakao_shinseung_popup_menu_cal($mobile , 101 , $message,"E4006","","팝업메뉴 세액계산기 알림톡발송");
    
}catch(Exception $e){
    $err = $e->getMessage().'(오류코드 : '.$e->getCode().')';
}



    echo $err ;
}    
//전문상담 리스트 알림톡발송: 끝
    
    
    
    
    
    
    //팝업메뉴 > 각지점장에게 발송 : 시작
    if($_POST["action"] == "MENUPOP_KAKAO_SEND_BRANCH"){
        
        
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $sec_type=mysqli_real_escape_string($connect,$_POST["sec_type"]);
        $total_paid=mysqli_real_escape_string($connect,$_POST["total_paid"]);
        $hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
        $hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
        $inf_channel=mysqli_real_escape_string($connect,$_POST["inf_channel"]);
        $memo=mysqli_real_escape_string($connect,$_POST["memo"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        $branch_mobile ="";
        $err = "전송완료";
        
        
        switch ($branch) {
            case "D1003_1": $branch_mobile = "01038484309"
            ; // 강남1:정혜숙
            break;
            case "D1003_2": $branch_mobile = "01091778835"
            ; // 강남2:마희숙
            break;
            case "D1004": $branch_mobile = "01088318738"
            ; // 용인:오선미
            break;
                
            case "D1006": $branch_mobile = "01053270152"
            ; // 안양:김은정
            break;
                
            case "D1007": $branch_mobile = "01090221640"
            ; // 수원 : 오미자
            break;
                
            case "D1008": $branch_mobile = "01092474635"
            ; // 일산 : 이찬희
            break;
                
            case "D1009": $branch_mobile = "01084406266"
            ; // 부천 : 신정희
            break;
                
            case "D1010": $branch_mobile = "01088881748"
            ; // 광주 : 이해옥
            break;
                
            case "D1011": $branch_mobile = "01091693327"  
            ; // 분당 : 한세빈
            break;
                
            case "D1012": $branch_mobile = "01082634251"
            ; // 기흥 : 한영순
            break;
            
            case "D1000": $branch_mobile = "01055904957"
            ; // 개발자
            break;
                
            default: $branch_mobile = ""
                ;
            break;
        }
        
        
        
        $message = "[세무톡] 전문상담 요청 

■ 기초정보 
- 고객명 : $cstname
- 연락처 : $mobile
- 업종 : $sec_type
- 연매출 : $total_paid
- 홈택스 ID : $hometaxid
- 홈택스 PW : $hometaxpw
- 접수채널 : $inf_channel

■ 메모 
$memo";

try{
    send_kakao_shinseung_popup_menu_branch($branch_mobile , 101 , $message,"A1001",$userid,"팝업메뉴 채널톡_전문상담_지점장 알림톡발송");
    
}catch(Exception $e){
    $err = $e->getMessage().'(오류코드 : '.$e->getCode().')';
}



echo $err ;
    }
    
    //팝업메뉴 > 세액계산 후 발송 : 끝
    
    
    
	//팝업메뉴 > 세액계산 후 발송 : 시작
    if($_POST["action"] == "MENUPOP_CAL_KAKAO_SEND"){
        
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $flag_type_name=mysqli_real_escape_string($connect,$_POST["flag_type_name"]);
        $exp_pay_tax=mysqli_real_escape_string($connect,$_POST["exp_pay_tax"]);
        $est_fee=mysqli_real_escape_string($connect,$_POST["est_fee"]);
        $auth_code=mysqli_real_escape_string($connect,$_POST["auth_code"]);
        $err = "전송완료";
        
        $message = "$cstname 고객님
$flag_type_name 신고 문의주셔서 감사드립니다. 

■ 예상납부세액
$exp_pay_tax 원
- (마이너스)이면 환급금액입니다. 

■ 신고대행 수수료
$est_fee 원

▶ 접수방법
신고대행을 의뢰하시려면 아래의 카톡 링크를 클릭하셔서 
♥ '본인이름' 과  
인증코드번호 (꽃)'$auth_code' 을 남겨주세요.   

예시) 홍길동  $auth_code  

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다. 

▶ 카톡링크 
http://pf.kakao.com/_vexexkC/chat

■ 유의사항 
납부세액은 홈택스 기초값으로 계산된 세액이며, 부양가족여부, 타소득여부 등 추가 정보에 따라 실제 신고시에는 상이할 수 있습니다. 
이점 양해 부탁드립니다.";
        
        try{
            send_kakao_shinseung_popup_menu_cal($mobile , 101 , $message,"E4006","","팝업메뉴 세액계산기 알림톡발송");
            
        }catch(Exception $e){
            $err = $e->getMessage().'(오류코드 : '.$e->getCode().')';
        }
        
        echo $err ;
    }
    
    //팝업메뉴 > 세액계산 후 발송 : 끝
    
    
    
    
    
    
    
    
    
    
    //재산제세 > 진행상태변경 수신참조 발송 : 시작
    if($_POST["action"] == "KAKAO_SEND_DISC_TESTER"){
        $name=mysqli_real_escape_string($connect,$_POST["name"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $err = "전송완료";
        
        $message = "안녕하세요 ".$name."님.

저희 신승세무법인에 입사지원해주셔서 감사합니다.

아래 바로가기 링크를 클릭하시면 
간단한 업무성향 테스트가 진행됩니다.

옳고 그른것을 고르는게 아닌 업무처리방식에 대한 테스트이므로

부담없이 선택하여 주시면 되겠습니다.

(굿)";
        
        try{
            send_kakao_shinseung_members_disc_tester($mobile , 9999 , $message,"E4006","","disc체크 알림톡발송");
            
        }catch(Exception $e){
            $err = $e->getMessage().'(오류코드 : '.$e->getCode().')';
        }

        

        echo $err ;
}
       
    //step2 : 끝
    
    




    //재산제세 > 진행상태변경 수신참조 발송 : 시작
if($_POST["action"] == "Send_VAT_Reg_Self"){
    $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
    $bizid=mysqli_real_escape_string($connect,$_POST["bizid"]);
    $tmp_flag=mysqli_real_escape_string($connect,$_POST["tmp_flag"]);
    $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
    $flag_vat = mysqli_real_escape_string($connect,$_POST["flag_vat"]);
    
    /*
     * cstid:cstid,bizid:bizid, action:action,tmp_flag:tmp_flag,userid:userid
     * */
    
    $procedure = "
		CREATE PROCEDURE SELECT_CSTNAME(IN P_CSTID INT(11) )
		BEGIN
            SELECT CSTNAME,KAKAO_SEND_NAME, MOBILE
            FROM dbsschina.TB100020 AS A
            WHERE A.CSTID = P_CSTID;
		END;
		";
    
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CSTNAME"))
    {
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL SELECT_CSTNAME(".$cstid.")";
            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
            
            if(mysqli_num_rows($result) >0)
            {
                while($row = mysqli_fetch_array($result)){
                    
                    $CSTNAME = $row["CSTNAME"];
                    $KAKAO_SEND_NAME = $row["KAKAO_SEND_NAME"];
                    $MOBILE = $row["MOBILE"];
                    
                    if($KAKAO_SEND_NAME!=null && $KAKAO_SEND_NAME !="")
                        $SEND_NAME = $KAKAO_SEND_NAME;
                    else
                        $SEND_NAME = $CSTNAME;
                    
                    if($tmp_flag =="A1001")
                        $flag_name = "종합소득세";
                    elseif($tmp_flag =="A1002")
                        $flag_name = "부가세";
                    
                        
                        if($flag_vat == "1"){
                            $message = $SEND_NAME."님
                            
$flag_name 신고대행을 의뢰하시려면

▶여기 카톡에

사장님 성함을 남겨주십시오.

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다.";
                            
                        }elseif($flag_vat == "2"){
                            $message = $SEND_NAME."님 

세무신고관련 문의는 

▶여기 카톡에 

사장님 성함을 남겨주신 후 상담부탁드립니다. 

세무 담당자가 관련한 상담을 도와드리겠습니다.";
                        }
                        
                    
                    
                    send_kakao_shinseung_vat($MOBILE , $cstid, $message,$bizid,$userid,"부가세알림톡발송".$flag_vat,$flag_vat);
                    
                    echo "전송완료";
                }
            }
        }
    }
}
//step2 : 끝






//재산제세 > 진행상태변경 수신참조 발송 : 시작
if($_POST["action"] == "action_send_disc_add_member"){
    $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
    $add_member=mysqli_real_escape_string($connect,$_POST["add_member"]);
    $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
    $br_flag=mysqli_real_escape_string($connect,$_POST["br_flag"]);
    
    $procedure = "
		CREATE PROCEDURE SELECT_TOK_DISC_ADDMEMBER(IN P_CSTID INT(11) )
		BEGIN
            SELECT A.USERNAME, A.MOBILE, A.BRANCH,CODE_TO_STR(A.BRANCH) AS 'BRANCH_', A.REP_FLAG,
			A.CAREER_YEAR AS 'CAR_YEAR', A.CAREER_MONTH AS 'CAR_MONTH',
			A.TOTAL_CAR_YEAR, A.TOTAL_CAR_MONTH,
			A.NEW_BEGIN, A.TOTAL_NEW_BEGIN, SELECT_REGUSER(EVAL_USERID) 'EVAL_USERID_',
			EVAL_USERID,INTERVIEW_DATE,
			date_format(INTERVIEW_DATE, '%Y-%m-%d') 'INTERVIEW_DATE_', date_format(BIRTH, '%Y-%m-%d') 'BIRTH_', AGE,FINAL_EDU,
			CODE_TO_STR(FINAL_EDU) 'FINAL_EDU_', FINAL_SCHOOL,IMPRESSION, CODE_TO_STR(IMPRESSION) 'IMPRESSION_',DESIRE, CODE_TO_STR(DESIRE) 'DESIRE_', KNOWLEDGE, CODE_TO_STR(KNOWLEDGE) 'KNOWLEDGE_',ABILITY , CODE_TO_STR(ABILITY) 'ABILITY_',PHYSICAL, CODE_TO_STR(PHYSICAL) 'PHYSICAL_', TOTAL_EVAL, CODE_TO_STR(TOTAL_EVAL) 'TOTAL_EVAL_',
            FORMAT(HOPE_MONEY,0) 'HOPE_MONEY', INTERVIEW_REPORT, INTERVIEW_COMMENT, PROGRESS, RECEPTION,
            SELECT_REGUSER(INTERVIEW_REPORT) 'INTERVIEW_REPORT_', INTERVIEW_COMMENT, PROGRESS, RECEPTION, INCLUDE_SEV, FILE_VIEW_STR, FILE_REAL_STR,
            A.G3_TYPE
            FROM dbsschina.TB980090 AS A
            WHERE A.USERID = P_CSTID;
		END;
		";
    
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TOK_DISC_ADDMEMBER"))
    {
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL SELECT_TOK_DISC_ADDMEMBER(".$cstid.")";
            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
            
            if(mysqli_num_rows($result) >0)
            {
                while($row = mysqli_fetch_array($result)){
                    
                    $USERNAME = $row["USERNAME"];
                    $MOBILE = $row["MOBILE"];
                    $INTERVIEW_DATE_ = $row["INTERVIEW_DATE_"];
                    $REP_TYPE = $row["G3_TYPE"];
                    $EVAL_USERID_ = $row["EVAL_USERID_"];
                    $TOTAL_EVAL = $row["TOTAL_EVAL_"];
                    $HOPE_MONEY = $row["HOPE_MONEY"]."만원";
                    $prog = $row["PROGRESS"];
                    
                    $message = "[면접결과]

신승 DISC & 면접결과 보고를 올립니다.

성명 : $USERNAME
연락처 : $MOBILE
면접일 : $INTERVIEW_DATE_
행동유형 : $REP_TYPE
평가자 : $EVAL_USERID_
종합평가 : $TOTAL_EVAL
희망연봉 : $HOPE_MONEY";


mysqli_next_result($connect);

if($br_flag != "Y"){
    $procedure2 = "
        CREATE PROCEDURE SELECT_ADD_MEMBER(IN P_POSITION_ID VARCHAR(5) )
        BEGIN
        	 SELECT *,RETURN_STR(MOBILE) 'MOBILE_' FROM TB980010
            WHERE POSITION_ID = P_POSITION_ID;
        END;
        ";
            
}else{
    $procedure2 = "
        CREATE PROCEDURE SELECT_ADD_MEMBER(IN P_DEPID VARCHAR(5) )
        BEGIN
        	 SELECT *,RETURN_STR(MOBILE) 'MOBILE_' FROM TB980010
            WHERE POSITION_ID = 'D2005' AND DEPID=P_DEPID;
        END;
        ";
            
}


if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_ADD_MEMBER"))
{
    if(mysqli_query($connect,$procedure2))
    {
        $query2 = "CALL SELECT_ADD_MEMBER('".$add_member."')";
        $result2 = mysqli_query($connect,$query2) or die(mysqli_error($connect));
        
        if(mysqli_num_rows($result2) >0)
        {
            while($row2 = mysqli_fetch_array($result2)){
                //$USERID = $row2["USERID"];
                $MOBILE_ = $row2["MOBILE_"];
                send_kakao_shinseung_members_disc($MOBILE_ , $cstid, $message,$prog,$userid,"면접결과");
                
                //해당글 지점장에게도 발송
                //send_kakao_shinseung_members_cons($MOBILE_MANAGER , $cstid, $message,$OWNER_USER,$userid,$SUBJECT);
                
                //어드민관리자
                //send_kakao_shinseung_members_new2("01055904957", $cstid, $message,$prog,$userid,$SUBJECT);
            }
            
        }
    }
}

echo "전송완료";
                }
            }
        }
    }
}
//step2 : 끝



    
    //재산제세 > 진행상태변경 수신참조 발송 : 시작
    if($_POST["action"] == "action_trans_send_prog_add_member"){
        $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
        $add_member=mysqli_real_escape_string($connect,$_POST["add_member"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        $procedure = "
		CREATE PROCEDURE SELECT_TOK_TRANS_ADDMEMBER(IN P_CSTID INT(11) )
		BEGIN
SELECT A.ETC,
RETURN_STR(A.MOBILE) 'MOBILE_',
H.VALUE_ 'VIP_CK_',
A.PROGRESS ,
D.VALUE_ 'PROGRESS_' ,
E.VALUE_ 'TAX_FLAG',
CSTNAME,FX_MOBILE(A.MOBILE) 'MOBILE',
G.VALUE_ 'PAY_FLAG_',
format(PRICE+PRICE2,0) 'PRICE_',
DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
C.VALUE_ 'REG_BRANCH',
I.USERNAME 'OWNER_',
format(TOTAL_TAX,0) 'TOTAL_TAX_',
DATE_FORMAT(A.DEADLINE, '%y-%m-%d') 'DEADLINE_',
RETURN_STR((SELECT MOBILE from TB980010 WHERE BRANCH_MANAGER = A.REG_BRANCH)) 'MANAGER_MOBILE'
			FROM TB600010 AS A
            LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
            LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
            LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
            LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.VIP_CK
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			WHERE A.ID = P_CSTID AND E.CODE_ <> 'E1008' limit 1;
		END;
		";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TOK_TRANS_ADDMEMBER"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL SELECT_TOK_TRANS_ADDMEMBER(".$cstid.")";
                $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
                
                if(mysqli_num_rows($result) >0)
                {
                    while($row = mysqli_fetch_array($result)){
                        
                        $TAX_FLAG = $row["TAX_FLAG"];
                        $CSTNAME = $row["CSTNAME"];
                        $PAY_FLAG_ = $row["PAY_FLAG_"];
                        $PRICE_ = $row["PRICE_"];
                        $PAY_DATE_ = $row["PAY_DATE_"];
                        $REG_BRANCH = $row["REG_BRANCH"];
                        $OWNER_ = $row["OWNER_"];
                        $TOTAL_TAX_ = $row["TOTAL_TAX_"];
                        $DEADLINE_ = $row["DEADLINE_"];
                        $prog = $row["PROGRESS"];
                        
                        if($prog == 'E5009'){
                            $SUBJECT = "[보충조서 검토요청 안내]";
                            $PROG_ = "검토요청";
                        }elseif($prog == 'E5006'){
                            $SUBJECT = "[보충조서 결재완료 안내]";
                            $PROG_ = "결재완료";
                        }else{
                            $SUBJECT = "[보충조서 수신참조 안내]";
                            $PROG_ = $row["PROGRESS_"];;
                        }
                        
                        
                        $VIP_CK = $row["VIP_CK_"];
                        $ETC_ = $row["ETC"];
                        $MOBILE_ = $row["MOBILE_"];
                        
                        $message = "$SUBJECT
■ 주요내역
진행상태 : $PROG_
컨설팅 : $VIP_CK
담당세무사 : $OWNER_

■ 세부내역
납세자 : $CSTNAME
연락처 : $MOBILE_
세목 : $TAX_FLAG
접수지점 : $REG_BRANCH
접수일 : $PAY_DATE_
수수료 : $PRICE_
수수료 납부 여부 : $PAY_FLAG_
총 납부세액 : $TOTAL_TAX_
신고 기한 : $DEADLINE_

■ 비고
$ETC_";
                        
                        
                        mysqli_next_result($connect);
                        
                        $procedure2 = "
                		CREATE PROCEDURE SELECT_ADD_MEMBER(IN P_POSITION_ID VARCHAR(5) )
                		BEGIN
                			 SELECT *,RETURN_STR(MOBILE) 'MOBILE_' FROM TB980010
                            WHERE POSITION_ID = P_POSITION_ID;
                		END;
                		";
                        
                        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_ADD_MEMBER"))
                        {
                            if(mysqli_query($connect,$procedure2))
                            {
                                $query2 = "CALL SELECT_ADD_MEMBER('".$add_member."')";
                                $result2 = mysqli_query($connect,$query2) or die(mysqli_error($connect));
                                
                                if(mysqli_num_rows($result2) >0)
                                {
                                    while($row2 = mysqli_fetch_array($result2)){
                                        //$USERID = $row2["USERID"];
                                        $MOBILE_ = $row2["MOBILE_"];
                                        send_kakao_shinseung_members_new2($MOBILE_ , $cstid, $message,$prog,$userid,$SUBJECT);
                                        
                                        //해당글 지점장에게도 발송
                                        //send_kakao_shinseung_members_cons($MOBILE_MANAGER , $cstid, $message,$OWNER_USER,$userid,$SUBJECT);
                                        
                                        //어드민관리자
                                        //send_kakao_shinseung_members_new2("01055904957", $cstid, $message,$prog,$userid,$SUBJECT);
                                    }
                                    
                                }
                            }
                        }
                        
                        echo "전송완료";
                    }
                }
            }
        }
    }
    //step2 : 끝
    
    
    
    
    
	//재산제세 > 코멘트작성시 작성자에게 코멘트 내용 발송 : 시작
    if($_POST["action"] == "action_trans_send_comment"){
        $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
        $comment=mysqli_real_escape_string($connect,$_POST["comment"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        $procedure = "
		CREATE PROCEDURE SELECT_TOK_TRANS_COMMENT(IN P_CSTID INT(11) )
		BEGIN
SELECT
D.VALUE_ 'PROGRESS_' ,
E.VALUE_ 'TAX_FLAG',
CSTNAME,
G.VALUE_ 'PAY_FLAG_',
I.USERNAME 'OWNER_',
A.OWNER_USER,
SELECT_REGUSER(A.REGUSER) 'REGUSER_'
			FROM TB600010 AS A
            LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
            LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			WHERE A.ID = P_CSTID AND E.CODE_ <> 'E1008' limit 1;
		END;
		";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TOK_TRANS_COMMENT"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL SELECT_TOK_TRANS_COMMENT(".$cstid.")";
                $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
                
                if(mysqli_num_rows($result) >0)
                {
                    while($row = mysqli_fetch_array($result)){
                        
                        //$MOBILE = $row["MOBILE"];
                        $TAX_FLAG = $row["TAX_FLAG"];
                        $CSTNAME = $row["CSTNAME"];
                        $OWNER_ = $row["OWNER_"];
                        $REGUSER_ = $row["REGUSER_"];
                        $SUBJECT="[댓글알림]";
                        $PROG_ = $row["PROGRESS_"];
                        $OWNER_USER = $row["OWNER_USER"];
                        
                        $message = "$SUBJECT

작성자 : $REGUSER_
내용 : $comment

납세자명 : $CSTNAME
세목 : $TAX_FLAG
진행상태 : $PROG_";


mysqli_next_result($connect);

$procedure2 = "
                		CREATE PROCEDURE SELECT_RELATION(IN P_OWNER INT(11) )
                		BEGIN
                			 SELECT
                            SELECT_REGUSER(A.M_MASTER) AS 'M_MASTER',RETURN_STR( D.MOBILE ) AS 'M_MOBILE',
                            SELECT_REGUSER(A.M_SLAVE) AS 'M_SLAVE' ,RETURN_STR( C.MOBILE ) AS 'S_MOBILE'
                            FROM TB980093 AS A
                            LEFT OUTER JOIN TB980010 AS B ON A.M_SLAVE = B.USERID
                            LEFT OUTER JOIN TB980010 AS C ON A.M_SLAVE = C.USERID
                            LEFT OUTER JOIN TB980010 AS D ON A.M_MASTER = D.USERID
                            WHERE B.DEPID = 'D1013'
                            AND M_SLAVE = P_OWNER;
                		END;
                		";

if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_RELATION"))
{
    if(mysqli_query($connect,$procedure2))
    {
        $query2 = "CALL SELECT_RELATION('".$OWNER_USER."')";
        $result2 = mysqli_query($connect,$query2) or die(mysqli_error($connect));
        
        if(mysqli_num_rows($result2) >0)
        {
            while($row2 = mysqli_fetch_array($result2)){
                //$USERID = $row2["USERID"];
                $M_MOBILE = $row2["M_MOBILE"];
                //send_kakao_shinseung_members_cons($M_MOBILE , $cstid, $message,$OWNER_USER,$userid,$SUBJECT);
                $S_MOBILE = $row2["S_MOBILE"];
                //send_kakao_shinseung_members_cons($S_MOBILE , $cstid, $message,$OWNER_USER,$userid,$SUBJECT);
                
                //해당글 지점장에게도 발송
                //send_kakao_shinseung_members_cons($MOBILE_MANAGER , $cstid, $message,$OWNER_USER,$userid,$SUBJECT);
                
                //어드민관리자
                //send_kakao_shinseung_members_comment("01055904957" , $cstid, $message,$OWNER_USER,$userid,$SUBJECT);
            }
            
        }
    }
}

echo "전송완료";
                    }
                }
            }
        }
    }
    //step2 : 끝
    
    
    
    
    
    
    //재산제세 > 담당 세무사 설정시 멘토멘티각각 알림톡 발송 : 시작
    if($_POST["action"] == "action_tok_trans_owner"){
        $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
        $owner=mysqli_real_escape_string($connect,$_POST["owner"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        $procedure = "
		CREATE PROCEDURE SELECT_TOK_TRANS(IN P_CSTID INT(11) )
		BEGIN
			SELECT A.ETC,
RETURN_STR(A.MOBILE) 'MOBILE_',
H.VALUE_ 'VIP_CK_',
D.VALUE_ 'PROGRESS_' ,
E.VALUE_ 'TAX_FLAG',
CSTNAME,FX_MOBILE(A.MOBILE) 'MOBILE',
G.VALUE_ 'PAY_FLAG_',
format(PRICE+PRICE2,0) 'PRICE_',
DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
C.VALUE_ 'REG_BRANCH',
I.USERNAME 'OWNER_',
format(TOTAL_TAX,0) 'TOTAL_TAX_',
DATE_FORMAT(A.DEADLINE, '%y-%m-%d') 'DEADLINE_',
RETURN_STR((SELECT MOBILE from TB980010 WHERE BRANCH_MANAGER = A.REG_BRANCH)) 'MANAGER_MOBILE'
			FROM TB600010 AS A
            LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
            LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
            LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
            LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.VIP_CK
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			WHERE A.ID = P_CSTID AND E.CODE_ <> 'E1008' limit 1;
		END;
		";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TOK_TRANS"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL SELECT_TOK_TRANS(".$cstid.")";
                $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
                
                if(mysqli_num_rows($result) >0)
                {
                    while($row = mysqli_fetch_array($result)){
                        
                        //$MOBILE = $row["MOBILE"];
                        $TAX_FLAG = $row["TAX_FLAG"];
                        $CSTNAME = $row["CSTNAME"];
                        $PAY_FLAG_ = $row["PAY_FLAG_"];
                        $PRICE_ = $row["PRICE_"];
                        $PAY_DATE_ = $row["PAY_DATE_"];
                        $REG_BRANCH = $row["REG_BRANCH"];
                        $OWNER_ = $row["OWNER_"];
                        $SUBJECT="[담당세무사 배정 안내]";
                        $PROG_ = $row["PROGRESS_"];
                        $VIP_CK = $row["VIP_CK_"];
                        $ETC_ = $row["ETC"];
                        $MOBILE_ = $row["MOBILE_"];
                        $MOBILE_MANAGER =$row["MANAGER_MOBILE"];
                        
                        $message = "$SUBJECT
■ 주요내역
진행상태 : $PROG_
컨설팅 : $VIP_CK
담당세무사 : $OWNER_

■ 세부내역
납세자 : $CSTNAME
연락처 : $MOBILE_
세목 : $TAX_FLAG
접수지점 : $REG_BRANCH
접수일 : $PAY_DATE_
수수료 : $PRICE_
수수료 납부 여부 : $PAY_FLAG_

■ 비고
$ETC_";
                        
                        
                        mysqli_next_result($connect);
                        
                        $procedure2 = "
                		CREATE PROCEDURE SELECT_RELATION(IN P_OWNER INT(11) )
                		BEGIN
                			 SELECT 
                            SELECT_REGUSER(A.M_MASTER) AS 'M_MASTER',RETURN_STR( D.MOBILE ) AS 'M_MOBILE',
                            SELECT_REGUSER(A.M_SLAVE) AS 'M_SLAVE' ,RETURN_STR( C.MOBILE ) AS 'S_MOBILE'
                            FROM TB980093 AS A 
                            LEFT OUTER JOIN TB980010 AS B ON A.M_SLAVE = B.USERID
                            LEFT OUTER JOIN TB980010 AS C ON A.M_SLAVE = C.USERID
                            LEFT OUTER JOIN TB980010 AS D ON A.M_MASTER = D.USERID
                            WHERE B.DEPID = 'D1013'
                            AND M_SLAVE = P_OWNER;                                     
                		END;
                		";
                                
                                if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_RELATION"))
                                {
                                    if(mysqli_query($connect,$procedure2))
                                    {
                                        $query2 = "CALL SELECT_RELATION('".$owner."')";
                                        $result2 = mysqli_query($connect,$query2) or die(mysqli_error($connect));
                                        
                                        if(mysqli_num_rows($result2) >0)
                                        {
                                            while($row2 = mysqli_fetch_array($result2)){
                                                //$USERID = $row2["USERID"];
                                                $M_MOBILE = $row2["M_MOBILE"];
                                                send_kakao_shinseung_members_cons($M_MOBILE , $cstid, $message,$owner,$userid,$SUBJECT);
                                                $S_MOBILE = $row2["S_MOBILE"];
                                                send_kakao_shinseung_members_cons($S_MOBILE , $cstid, $message,$owner,$userid,$SUBJECT);
                                                
                                                //해당글 지점장에게도 발송
                                                send_kakao_shinseung_members_cons($MOBILE_MANAGER , $cstid, $message,$owner,$userid,$SUBJECT);
                                                
                                                //어드민관리자
                                                //send_kakao_shinseung_members_cons("01055904957" , $cstid, $message,$owner,$userid,$SUBJECT);
                                            }
                                            
                                        }
                                    }
                                }
                                
                        echo "전송완료";
                    }
                }
            }
        }
    }
    //step2 : 끝
    
    
    
    
    //재산제세 수동톡발송 : 시작
    if($_POST["action"] == "action_tok_trans_up5k"){
        $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
        $prog=mysqli_real_escape_string($connect,$_POST["prog"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        $procedure = "
		CREATE PROCEDURE SELECT_TOK_TRANS(IN P_CSTID INT(11) )
		BEGIN
			SELECT A.ETC,
RETURN_STR(A.MOBILE) 'MOBILE_',
H.VALUE_ 'VIP_CK_',
D.VALUE_ 'PROGRESS_' ,
E.VALUE_ 'TAX_FLAG',
CSTNAME,FX_MOBILE(A.MOBILE) 'MOBILE',
G.VALUE_ 'PAY_FLAG_',
format(PRICE+PRICE2,0) 'PRICE_',
DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
C.VALUE_ 'REG_BRANCH',
I.USERNAME 'OWNER_',
format(TOTAL_TAX,0) 'TOTAL_TAX_',
DATE_FORMAT(A.DEADLINE, '%y-%m-%d') 'DEADLINE_',
RETURN_STR((SELECT MOBILE from TB980010 WHERE BRANCH_MANAGER = A.REG_BRANCH)) 'MANAGER_MOBILE'
			FROM TB600010 AS A
            LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
            LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
            LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
            LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.VIP_CK
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			WHERE A.ID = P_CSTID AND E.CODE_ <> 'E1008' limit 1;
		END;
		";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TOK_TRANS"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL SELECT_TOK_TRANS(".$cstid.")";
                $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
                
                if(mysqli_num_rows($result) >0){
                    while($row = mysqli_fetch_array($result)){
                        //$MOBILE = $row["MOBILE"];
                        $TAX_FLAG = $row["TAX_FLAG"];
                        $CSTNAME = $row["CSTNAME"];
                        $PAY_FLAG_ = $row["PAY_FLAG_"];
                        $PRICE_ = $row["PRICE_"];
                        $PAY_DATE_ = $row["PAY_DATE_"];
                        $REG_BRANCH = $row["REG_BRANCH"];
                        $OWNER_ = $row["OWNER_"];
                        $TOTAL_TAX_ = $row["TOTAL_TAX_"];
                        $DEADLINE_ = $row["DEADLINE_"];
                        $SUBJECT = "[컨설팅 예상건 안내]";
                        $PROG_ = $row["PROGRESS_"];
                        $VIP_CK = $row["VIP_CK_"];
                        $ETC_ = $row["ETC"];
                        $MOBILE_ = $row["MOBILE_"];
                        $MOBILE_MANAGER =$row["MANAGER_MOBILE"];
                        
                        $message = "$SUBJECT
■ 주요내역
진행상태 : $PROG_
컨설팅 : $VIP_CK
담당세무사 : $OWNER_

■ 세부내역
납세자 : $CSTNAME
연락처 : $MOBILE_
세목 : $TAX_FLAG
접수지점 : $REG_BRANCH
접수일 : $PAY_DATE_
수수료 : $PRICE_
수수료 납부 여부 : $PAY_FLAG_
총 납부세액 : $TOTAL_TAX_
신고 기한 : $DEADLINE_

■ 비고
$ETC_";


mysqli_close();


try{
    $http_host = $_SERVER['HTTP_HOST'];
    if($http_host=="localhost")
        $connect2 = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
        else
            $connect2 = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
            
            $procedure2 = "
                    		CREATE PROCEDURE SELECT_USERID(IN P_GROUP_ID INT(11) )
                    		BEGIN
                    			SELECT RETURN_STR(MOBILE) AS 'MOBILE'
                                FROM TB980010
                                WHERE USERID IN
                                (
                                SELECT USERID
                                FROM TB600040
                                WHERE GROUP_ID IN (SELECT GROUP_ID FROM TB600041 WHERE USE_MENU_ID = P_GROUP_ID)
                                );
                
                    		END;
                    		";
            
            if(mysqli_query($connect2,"DROP PROCEDURE IF EXISTS SELECT_USERID"))
            {
                if(mysqli_query($connect2,$procedure2))
                {
                    $query2 = "CALL SELECT_USERID('".$prog."')";
                    $result2 = mysqli_query($connect2,$query2) or die(mysqli_error($connect2));
                    
                    if(mysqli_num_rows($result2) >0)
                    {
                        while($row2 = mysqli_fetch_array($result2)){
                            //$USERID = $row2["USERID"];
                            $MOBILE = $row2["MOBILE"];
                            // 멘토상무
                            send_kakao_shinseung_members_new2($MOBILE , $cstid, $message,$prog,$userid,$SUBJECT);
                        }
                        
                        //CH
                        //send_kakao_shinseung_members_new2("01037111107" , $cstid, $message,$prog,$userid,$SUBJECT);
                        
                        //해당글 지점장
                        send_kakao_shinseung_members_cons($MOBILE_MANAGER , $cstid, $message,$owner,$userid,$SUBJECT);
                        
                        //어드민관리자
                        //send_kakao_shinseung_members_new2("01055904957" , $cstid, $message,$prog,$userid,$SUBJECT);
                        
                    }
                    mysqli_close();
                }
            }
            
            
            
}catch(Exception $e){
    echo $e;
}

echo "전송완료";
                    }
                }
            }
        }
    }
    //step2 : 끝
    
    
    
    
    
	//재산제세 수동톡발송 : 시작
	if($_POST["action"] == "action_tok_trans_prog"){
	    $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
	    $prog=mysqli_real_escape_string($connect,$_POST["prog"]);
	    $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
	    
	    $procedure = "                                                          
		CREATE PROCEDURE SELECT_TOK_TRANS(IN P_CSTID INT(11) )
		BEGIN
			SELECT A.ETC,
RETURN_STR(A.MOBILE) 'MOBILE_',
H.VALUE_ 'VIP_CK_',
D.VALUE_ 'PROGRESS_' ,
E.VALUE_ 'TAX_FLAG',
CSTNAME,FX_MOBILE(A.MOBILE) 'MOBILE',
G.VALUE_ 'PAY_FLAG_',
format(PRICE+PRICE2,0) 'PRICE_',
DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
C.VALUE_ 'REG_BRANCH',
I.USERNAME 'OWNER_',
format(TOTAL_TAX,0) 'TOTAL_TAX_',
DATE_FORMAT(A.DEADLINE, '%y-%m-%d') 'DEADLINE_'
			FROM TB600010 AS A
            LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
            LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
            LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
            LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.VIP_CK
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			WHERE A.ID = P_CSTID AND E.CODE_ <> 'E1008' limit 1;
		END;
		";
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TOK_TRANS"))
	    {
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL SELECT_TOK_TRANS(".$cstid.")";
	            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
	            
	            if(mysqli_num_rows($result) >0){
	                while($row = mysqli_fetch_array($result)){
	                    //$MOBILE = $row["MOBILE"];
	                    $TAX_FLAG = $row["TAX_FLAG"];
	                    $CSTNAME = $row["CSTNAME"];
	                    $PAY_FLAG_ = $row["PAY_FLAG_"];
	                    $PRICE_ = $row["PRICE_"];
	                    $PAY_DATE_ = $row["PAY_DATE_"];
	                    $REG_BRANCH = $row["REG_BRANCH"];
	                    $OWNER_ = $row["OWNER_"];
	                    $TOTAL_TAX_ = $row["TOTAL_TAX_"];
	                    $DEADLINE_ = $row["DEADLINE_"];
	                    
	                    if($prog == 'E5009'){
	                        $SUBJECT = "[보충조서 검토요청 안내]";
	                        $PROG_ = "검토요청";
	                    }elseif($prog == 'E5006'){
	                       $SUBJECT = "[보충조서 결재완료 안내]";
	                       $PROG_ = "결재완료";
	                    }
	                    
	                    
	                    $VIP_CK = $row["VIP_CK_"];
	                    $ETC_ = $row["ETC"];
	                    $MOBILE_ = $row["MOBILE_"];
	                    
	                    $message = "$SUBJECT
■ 주요내역
진행상태 : $PROG_
컨설팅 : $VIP_CK
담당세무사 : $OWNER_

■ 세부내역
납세자 : $CSTNAME
연락처 : $MOBILE_
세목 : $TAX_FLAG
접수지점 : $REG_BRANCH
접수일 : $PAY_DATE_
수수료 : $PRICE_
수수료 납부 여부 : $PAY_FLAG_
총 납부세액 : $TOTAL_TAX_
신고 기한 : $DEADLINE_

■ 비고
$ETC_";
	                    
	                   
	                   mysqli_close();
	                   
	                   
	                   try{
	                       $http_host = $_SERVER['HTTP_HOST'];
	                       if($http_host=="localhost")
	                           $connect2 = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
                           else
                               $connect2 = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
                               
	                       $procedure2 = "
                    		CREATE PROCEDURE SELECT_USERID(IN P_GROUP_ID INT(11) )
                    		BEGIN
                    			SELECT RETURN_STR(MOBILE) AS 'MOBILE'
                                FROM TB980010
                                WHERE USERID IN 
                                (
                                SELECT USERID
                                FROM TB600040
                                WHERE GROUP_ID IN (SELECT GROUP_ID FROM TB600041 WHERE USE_MENU_ID = P_GROUP_ID)
                                );

                    		END;
                    		";
	                       
	                       if(mysqli_query($connect2,"DROP PROCEDURE IF EXISTS SELECT_USERID"))
	                       {
	                           if(mysqli_query($connect2,$procedure2))
	                           {
	                               $query2 = "CALL SELECT_USERID('".$prog."')";
	                               $result2 = mysqli_query($connect2,$query2) or die(mysqli_error($connect2));
	                               
	                               if(mysqli_num_rows($result2) >0)
	                               {
	                                   while($row2 = mysqli_fetch_array($result2)){
	                                       //$USERID = $row2["USERID"];
	                                       $MOBILE = $row2["MOBILE"];
	                                       // 멘토상무
	                                       send_kakao_shinseung_members_new2($MOBILE , $cstid, $message,$prog,$userid,$SUBJECT);
	                                   }
	                                   
	                                   
	                                   //CH
	                                   //send_kakao_shinseung_members_new2("01037111107" , $cstid, $message,$prog,$userid,$SUBJECT);
	                                   
	                                   // 어드민 관리자
	                                   //send_kakao_shinseung_members_new2("01055904957" , $cstid, $message,$prog,$userid,$SUBJECT);
	                                   
	                               }
	                               mysqli_close();
	                           }
	                       }
	                       
	                       
	                       
	                   }catch(Exception $e){
	                       echo $e;
	                   }
	                   
	                   echo "전송완료";
	                }
	            }
	        }
	    }
	}
	//step2 : 끝
	
	
	
	
	
	
	//재산제세 컨설팅 수동톡발송 : 시작
	if($_POST["action"] == "action_tok_trans_cons"){
	    $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
	    $cons=mysqli_real_escape_string($connect,$_POST["cons"]);
	    $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
	    
	    $procedure = "
		CREATE PROCEDURE SELECT_TOK_TRANS(IN P_CSTID INT(11) )
		BEGIN
			SELECT A.ETC,
RETURN_STR(A.MOBILE) 'MOBILE_',
H.VALUE_ 'VIP_CK_',
D.VALUE_ 'PROGRESS_' ,
E.VALUE_ 'TAX_FLAG',
CSTNAME,FX_MOBILE(A.MOBILE) 'MOBILE',
G.VALUE_ 'PAY_FLAG_',
format(PRICE+PRICE2,0) 'PRICE_',
DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
C.VALUE_ 'REG_BRANCH',
I.USERNAME 'OWNER_',
format(TOTAL_TAX,0) 'TOTAL_TAX_',
DATE_FORMAT(A.DEADLINE, '%y-%m-%d') 'DEADLINE_'
			FROM TB600010 AS A
            LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
            LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
            LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
            LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.VIP_CK
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			WHERE A.ID = P_CSTID AND E.CODE_ <> 'E1008' limit 1;
		END;
		";
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TOK_TRANS"))
	    {
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL SELECT_TOK_TRANS(".$cstid.")";
	            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
	            
	            if(mysqli_num_rows($result) >0)
	            {
	                while($row = mysqli_fetch_array($result)){
	                    
	                    //$MOBILE = $row["MOBILE"];
	                    $TAX_FLAG = $row["TAX_FLAG"];
	                    $CSTNAME = $row["CSTNAME"];
	                    $PAY_FLAG_ = $row["PAY_FLAG_"];
	                    $PRICE_ = $row["PRICE_"];
	                    $PAY_DATE_ = $row["PAY_DATE_"];
	                    $REG_BRANCH = $row["REG_BRANCH"];
	                    $OWNER_ = $row["OWNER_"];
	                    $TOTAL_TAX_ = $row["TOTAL_TAX_"];
	                    $DEADLINE_ = $row["DEADLINE_"];
	                    $SUBJECT="컨설팅 예상건 안내";
	                    $PROG_ = $row["PROGRESS_"];
	                    $VIP_CK = $row["VIP_CK_"];
	                    $ETC_ = $row["ETC"];
	                    $MOBILE_ = $row["MOBILE_"];
	                    
	                    $message = "$SUBJECT
■ 주요내역
진행상태 : $PROG_
컨설팅 : $VIP_CK
담당세무사 : $OWNER_

■ 세부내역
납세자 : $CSTNAME
연락처 : $MOBILE_
세목 : $TAX_FLAG
접수지점 : $REG_BRANCH
접수일 : $PAY_DATE_
수수료 : $PRICE_
수수료 납부 여부 : $PAY_FLAG_

■ 비고
$ETC_";
	                    
	                    
	                    mysqli_close();
	                    
	                    
	                    try{
	                        $http_host = $_SERVER['HTTP_HOST'];
	                        if($http_host=="localhost")
	                            $connect2 = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
                            else
                                $connect2 = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
                                
	                                $procedure2 = "
                    		CREATE PROCEDURE SELECT_USERID_MOBILE(IN P_MENU_ID VARCHAR(5) )
                    		BEGIN
                    			SELECT RETURN_STR(MOBILE) AS 'MOBILE'
                                FROM TB980010
                                WHERE USERID IN
                                (
                                SELECT USERID
                                FROM TB600040
                                WHERE GROUP_ID IN (SELECT GROUP_ID FROM TB600041 WHERE USE_MENU_ID = P_MENU_ID)
                                );
	                                    
                    		END;
                    		";
	                                
	                                if(mysqli_query($connect2,"DROP PROCEDURE IF EXISTS SELECT_USERID_MOBILE"))
	                                {
	                                    if(mysqli_query($connect2,$procedure2))
	                                    {
	                                        $query2 = "CALL SELECT_USERID_MOBILE('".$cons."')";
	                                        $result2 = mysqli_query($connect2,$query2) or die(mysqli_error($connect2));
	                                        
	                                        if(mysqli_num_rows($result2) >0)
	                                        {
	                                            while($row2 = mysqli_fetch_array($result2)){
	                                                //$USERID = $row2["USERID"];
	                                                $MOBILE = $row2["MOBILE"];
	                                                send_kakao_shinseung_members_cons($MOBILE , $cstid, $message,$cons,$userid,$SUBJECT);
	                                            }
	                                            //어드민관리자
	                                            //send_kakao_shinseung_members_cons("01055904957" , $cstid, $message,$cons,$userid,$SUBJECT);
	                                            
	                                        }
	                                        mysqli_close();
	                                    }
	                                }
	                                
	                                
	                                
	                    }catch(Exception $e){
	                        echo $e;
	                    }
	                    
	                    echo "전송완료";
	                }
	            }
	        }
	    }
	}
	//step2 : 끝
	
	
	
	
}
	


function fn_switch_kakao_send($temp_id,$CSTNAME,$EXP_PAY_TAX ,$EST_FEE,$AUTH_CODE,$mobile,$bizid,$userid,$REGDATE){
    
    /*
     * $temp_id 값에 따라 swich작업
     * */
    switch ($temp_id):
    case "bizp_2022042113590613488325669" : //세액&수수료안내
        $message = "$CSTNAME 고객님 (하트)
[세무톡] 신승세무법인입니다.
종합소득세 신고 문의주셔서 감사드립니다.

■ 예상세액
$EXP_PAY_TAX 원
- (마이너스)이면 환급금액입니다.

■ 신고대행 수수료
$EST_FEE 원  (부가세 포함)

▶ 접수방법
신고대행을 의뢰하시려면
아래의 (카톡) 카톡 채팅창에

♥ 【본인이름】과
♥ 인증코드번호
【".$AUTH_CODE."】을 남겨주세요.

예시) $CSTNAME   $AUTH_CODE

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다.

■ 유의사항
예상납부세액은 홈택스 기초값으로 계산된 세액이며, 부양가족여부, 타소득여부 등 추가 정보에 따라 실제 신고시에는 상이할 수 있습니다.
또한, 신고대행수수료는 서류 검토 후 조정될 수 있습니다.
이점 양해 부탁드립니다.";

send_kakao_shinseung_prolist($mobile , 101 ,$message, $bizid ,$userid,"전문상담리스트 [세액&수수료안내] 알림톡","bizp_2022042113590613488325669");


break;
    case "bizp_2022042114014314053182657" : //수수료안내
        $message = "$CSTNAME 고객님 (하트)
[세무톡] 신승세무법인입니다.
종합소득세 신고 문의주셔서 감사드립니다.

■ 신고대행 수수료
$EST_FEE 원  (부가세 포함)

▶ 접수방법
신고대행을 의뢰하시려면
아래의 (카톡) 카톡 채팅창에

♥ 【본인이름】과
♥ 인증코드번호
【".$AUTH_CODE."】을 남겨주세요.

예시) $CSTNAME   $AUTH_CODE

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다.

■ 유의사항
신고대행수수료는 서류 검토 후 조정될 수 있습니다.
이점 양해 부탁드립니다.";
send_kakao_shinseung_prolist($mobile , 101 , $message,$bizid ,$userid,"전문상담리스트 [수수료 안내] 알림톡","bizp_2022042114014314053182657");
break;
    case "bizp_2022042114030514053585658" : // 예상세액 안내
        $message = "$CSTNAME 고객님 (하트)
[세무톡] 신승세무법인입니다.
종합소득세 신고 문의주셔서 감사드립니다.

■ 예상납부세액
$EXP_PAY_TAX 원
- (마이너스)이면 환급금액입니다.
예상납부세액은 실제 납부금액과는 차이가 있습니다.

▶ 접수방법
신고대행을 의뢰하시려면
아래의 (카톡) 카톡 채팅창에

♥ 【본인이름】과
♥ 인증코드번호
【".$AUTH_CODE."】을 남겨주세요.

예시) $CSTNAME   $AUTH_CODE

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다.

■ 유의사항
예상납부세액은 홈택스 기초값으로 계산된 세액이며, 부양가족여부, 타소득여부 등 추가 정보에 따라 실제 신고시에는 상이할 수 있습니다.";
send_kakao_shinseung_prolist($mobile , 101 , $message,$bizid ,$userid,"전문상담리스트 [예상세액 안내] 알림톡","bizp_2022042114030514053585658");
break;
    case "bizp_2022042114073514053486659" : // 부재중전화 안내
        $message = "$CSTNAME 고객님 (하트)
[세무톡] 신승세무법인입니다.
종합소득세 신고 문의주셔서 감사드립니다.

상담 폭주로 인해 상담이 지연되는 점 양해부탁드립니다.

▶ 빠른 상담안내
빠른 상담을 원하시면
아래의 (카톡) 카톡 채팅창에

♥ 【본인이름】과
♥ 인증코드번호
【".$AUTH_CODE."】을 남겨주세요.

예시) $CSTNAME   $AUTH_CODE

담당자가 신고관련 자세한 상담 및 필요서류, 처리절차 등을 안내해드리겠습니다.";
        send_kakao_shinseung_prolist($mobile , 101 , $message,$bizid ,$userid,"전문상담리스트 [부재중전화 안내] 알림톡","bizp_2022042114073514053486659");
        break;
    case "bizp_2022042114114213488987672" : //[홈택스 안내문 조회방법
        $message = "$CSTNAME 고객님 (하트)
[세무톡] 신승세무법인입니다.
종합소득세 신고 문의주셔서 감사드립니다.

홈택스에서 종합소득세 안내문을 조회하여 PDF파일로 다운받아 전달 부탁드립니다.

(하트) 홈택스 안내문 조회방법

홈택스 로그인
> 조회/발급
> 세금신고납부
> 종합소득세 신고도움 서비스
> [기본사항]과 [신고 참고자료]를

조회가 어려우시면 저희가 조회하여 안내드리겠습니다.
홈택스 아이디 / 패스워드를 알려주십시오.

▶ 빠른 상담을 원하시면
아래의 카톡 채팅창에
♥ 【본인이름】 과
♥ 인증코드번호
【".$AUTH_CODE."】을 남겨주세요.

예시) $CSTNAME   $AUTH_CODE";
        send_kakao_shinseung_prolist($mobile , 101 , $message,$bizid ,$userid,"전문상담리스트 [홈택스 안내문 조회방법] 알림톡","bizp_2022042114114213488987672");
        break;
    case "bizp_2022042114131114053954660" : // 신고마감임박 안내
        $message = "[신고 및 납부기간]
$REGDATE

미신고시 가산세가 부과되오니 꼭 신고하시길 안내드립니다.
========================

$CSTNAME 고객님 (하트)
[세무톡] 신승세무법인입니다.
종합소득세 신고 및 납부기간이 [임박]하여 안내올립니다.


▶ 접수방법
신고대행을 의뢰하시려면
아래의 (카톡) 카톡 채팅창에

♥ 【본인이름】과
♥ 인증코드번호
【".$AUTH_CODE."】을 남겨주세요.

예시) $CSTNAME   $AUTH_CODE

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다.";
send_kakao_shinseung_prolist($mobile , 101 , $message,$bizid ,$userid,"전문상담리스트 [신고마감임박 안내] 알림톡","bizp_2022042114131114053954660");
break;
    case "bizp_2022042114151414053069663" :
        $message = "$CSTNAME 고객님
[세무톡] 신승세무법인입니다.
종합소득세 신고 대행 수수료가 아래와 같이 조정되어 안내드립니다.

■ 조정 신고대행 수수료
$EST_FEE 원 (부가세 포함)

▶ 접수방법
신고대행을 의뢰하시려면
아래의 (카톡) 카톡 채팅창에

♥ 【본인이름】과
♥ 인증코드번호
【".$AUTH_CODE."】을 남겨주세요.

예시) $CSTNAME   $AUTH_CODE

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다.";
send_kakao_shinseung_prolist($mobile , 101 , $message,$bizid ,$userid,"전문상담리스트 [수수료 조정 안내] 알림톡","bizp_2022042114151414053069663");
break;
    case "bizp_2022042114040413488193671" :
        $AUTH_CODE = "0013";
        $message = "$CSTNAME 고객님 (하트)
[세무톡] 신승세무법인입니다. 
종합소득세 간편안내를 이용해주셔서 감사드립니다. 

상담 폭주로 인해 상담이 지연되는 점 양해부탁드립니다. 

▶ 빠른 상담안내 
빠른 상담을 원하시면 
아래의 (카톡) 카톡 채팅창에 

♥ 【본인이름】과  
♥ 인증코드번호 
【".$AUTH_CODE."】을 남겨주세요.   

예시) $CSTNAME   $AUTH_CODE

담당자가 신고상담, 필요서류, 처리절차 등을 안내해드리겠습니다.";
send_kakao_shinseung_prolist($mobile , 101 , $message,$bizid ,$userid,"전문상담리스트 [빠른상담안내] 알림톡","bizp_2022042114040413488193671");
break;
default:
    echo "error";
    endswitch;
}


function send_kakao_shinseung_prolist($SEND_PHONE, $cstid,$message, $prog,$userid,$subject, $TEMP_CODE){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    //$TEMP_CODE = "bizp_2022042113590613488325669";
        
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
        
        
        /*회장님 : 시작*/
        //$SEND_PHONE = "01037111107";
        $data = array();
        $data["account"] = $account;
        $data["refkey"] = "shinseung";
        $data["type"] = "at";
        $data["from"] = "0234520608";
        //$data["to"] = $MOBILE;
        $data["to"] = $SEND_PHONE;
        //$data["to"] = "01055904957";
        
        
        switch ($TEMP_CODE):
        case "bizp_2022042113590613488325669" : //세액&수수료안내
            $button1 = Array("name" => "신고대행 의뢰하기",
                "type" => "MD"
            );
            $button[0] = $button1;
        break;
        
        case "bizp_2022042114014314053182657" : //수수료안내
            $button1 = Array("name" => "신고대행 의뢰하기",
            "type" => "MD"
                );
            $button[0] = $button1;
        break;
            
        case "bizp_2022042114030514053585658" : //예상세액 안내
            $button1 = Array("name" => "신고대행 의뢰하기",
            "type" => "MD"
                );
            $button[0] = $button1;
        break;
            
        case "bizp_2022042114073514053486659" : //부재중전화 안내
            $button1 = Array("name" => "전문상담 요청",
            "type" => "MD"
                );
            
            $button2 = Array("name" => "홈택스 조회방법",
            "type" => "WL",
            "url_mobile" => "https://taxtok.kr/m/sub_newsview.php?id=916",
            "url_pc" => "https://taxtok.kr/sub_newsview.php?id=916"
                );
            $button[0] = $button1;//array("button1"=>$button1,"button2"=>$button2);
            $button[1] = $button2;
        break;
            
        case "bizp_2022042114114213488987672" : //홈택스 안내문 조회방법
            $button1 = Array("name" => "신고 상담하기",
            "type" => "MD"
                );
            
            $button2 = Array("name" => "홈택스 조회방법",
                "type" => "WL",
                "url_mobile" => "https://taxtok.kr/m/sub_newsview.php?id=916",
                "url_pc" => "https://taxtok.kr/sub_newsview.php?id=916"
            );
            $button3 = Array("name" => "홈택스 바로가기",
                "type" => "WL",
                "url_mobile" => "https://www.hometax.go.kr",
                "url_pc" => "https://www.hometax.go.kr"
            );
            $button[0] = $button1;//array("button1"=>$button1,"button2"=>$button2);
            $button[1] = $button2;
            $button[2] = $button3;
        break;
            
        case "bizp_2022042114131114053954660" : //신고마감임박 안내
            $button1 = Array("name" => "신고대행 의뢰하기",
            "type" => "MD"
                );
            $button[0] = $button1;
        break;
            
        case "bizp_2022042114151414053069663" : //수수료 조정 안내
            $button1 = Array("name" => "신고대행 의뢰하기",
            "type" => "MD"
                );
            $button[0] = $button1;
        break;
        
        case "bizp_2022042114040413488193671" : //빠른상담안내 조정 안내
            $button1 = Array("name" => "빠른 상담요청",
            "type" => "MD"
                );
            $button[0] = $button1;
            break;
        endswitch;
        
        $at = array(
            "senderkey" => $SENDER_KEY,
            "templatecode" => $TEMP_CODE,
            "message" => $message,
            "button" => $button
        );
        
        $data["content"] = array("at" => $at);
        // 알림톡 발송
        $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
        //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
        $jsonData = json_encode($data);
        
        
        /*어뷰징 최종검증*/
        //$ck_cnt = ck_send_message($cstid, $MOBILE, "bizp_2021080916341105928894221", "bcdc7fbde9bec506790e366bcc2b99d947868f10","STEP_1_CEO","A1003");
        $ck_cnt = 0;
        
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
            send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1001","",$userid);
        }else{
            echo 'error:abuse';
        }
        /*회장님 : 끝*/
}




/*
 * 부가세 알림톡발송1
 * */
function send_kakao_shinseung_vat($SEND_PHONE, $cstid, $message,$prog,$userid,$subject, $flag_vat){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    if($flag_vat=="1")
        $TEMP_CODE = "bizp_2022010517052394819665381";
    elseif($flag_vat=="2")
        $TEMP_CODE = "bizp_2022010517065118311320374";
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
      
    $at = array(
        "senderkey" => $SENDER_KEY,
        "templatecode" => $TEMP_CODE,
        "message" => $message
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message($cstid, $MOBILE, "bizp_2021080916341105928894221", "bcdc7fbde9bec506790e366bcc2b99d947868f10","STEP_1_CEO","A1003");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1008","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
}




function send_kakao_shinseung_popup_menu_branch($SEND_PHONE, $cstid, $message,$prog,$userid,$subject){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    $TEMP_CODE = "bizp_2022042113552813488006668";
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
    /*
     $button2 = array("name"=>"이전 대화보기",
     "type"=>"WL",
     "url_pc"=>"https://taxtoc.channel.io",
     "url_mobile"=>"https://taxtoc.channel.io");
     */
    //	$button = array("button1"=>$button1,"button2"=>$button2);
    $button1 = Array("name" => "전문상담 확인완료",
        "type" => "MD"
    );
    $button2 = Array("name" => "전문상담 리스트",
        "type" => "WL",
        "url_mobile" => "https://taxtok.kr/admin/list_RPA_pro.php",
        "url_pc" => "https://taxtok.kr/admin/list_RPA_pro.php"
    );
    
    
    $button[0] = $button1;
    $button[1] = $button2;
    
    $at = array(
        "senderkey" => $SENDER_KEY,
        "templatecode" => $TEMP_CODE,
        "message" => $message,
        "button" => $button
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message_disc($cstid, $SEND_PHONE, "bizp_2021123013241694819883100", "64427a5eb014f403b09932ea56cc77cf68f7effe","면접결과","A1008");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1001","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
}





function send_kakao_shinseung_popup_menu_cal($SEND_PHONE, $cstid, $message,$prog,$userid,$subject){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    $TEMP_CODE = "bizp_2022041816584314053032388";
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
    /*
     $button2 = array("name"=>"이전 대화보기",
     "type"=>"WL",
     "url_pc"=>"https://taxtoc.channel.io",
     "url_mobile"=>"https://taxtoc.channel.io");
     */
    //	$button = array("button1"=>$button1,"button2"=>$button2);
    $button1 = Array("name" => "카톡링크",
        "type" => "WL",
        "url_mobile" => "http://pf.kakao.com/_vexexkC/chat",
        "url_pc" => "http://pf.kakao.com/_vexexkC/chat"
    );
    
    
    $button[0] = $button1;
    
    $at = array(
        "senderkey" => $SENDER_KEY,
        "templatecode" => $TEMP_CODE,
        "message" => $message,
        "button" => $button
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message_disc($cstid, $SEND_PHONE, "bizp_2021123013241694819883100", "64427a5eb014f403b09932ea56cc77cf68f7effe","면접결과","A1008");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1001","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
}






function send_kakao_shinseung_members_disc($SEND_PHONE, $cstid, $message,$prog,$userid,$subject){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    $TEMP_CODE = "bizp_2021123013241694819883100";
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
    /*
     $button2 = array("name"=>"이전 대화보기",
     "type"=>"WL",
     "url_pc"=>"https://taxtoc.channel.io",
     "url_mobile"=>"https://taxtoc.channel.io");
     */
    //	$button = array("button1"=>$button1,"button2"=>$button2);
    $button1 = Array("name" => "바로가기",
        "type" => "WL",
        "url_mobile" => "https://taxtok.kr/admin/view_disc.php?id=$cstid",
        "url_pc" => "https://taxtok.kr/admin/view_disc.php?id=$cstid"
    );
    
    
    $button[0] = $button1;
    
    $at = array(
        "senderkey" => $SENDER_KEY,
        "templatecode" => $TEMP_CODE,
        "message" => $message,
        "button" => $button
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message_disc($cstid, $SEND_PHONE, "bizp_2021123013241694819883100", "64427a5eb014f403b09932ea56cc77cf68f7effe","면접결과","A1008");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1008","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
}


/*
 * disc체크 알림톡발송 to 테스터
 * */

function send_kakao_shinseung_members_disc_tester($SEND_PHONE, $cstid, $message,$prog,$userid,$subject){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    $TEMP_CODE = "bizp_2022010614163194819597428";
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
    /*
     $button2 = array("name"=>"이전 대화보기",
     "type"=>"WL",
     "url_pc"=>"https://taxtoc.channel.io",
     "url_mobile"=>"https://taxtoc.channel.io");
     */
    //	$button = array("button1"=>$button1,"button2"=>$button2);
    $button1 = Array("name" => "바로가기",
        "type" => "WL",
        "url_mobile" => "https://taxtok.kr/admin/m/login_disc.php",
        "url_pc" => "https://taxtok.kr/admin/write_disc.php"
    );
    
    
    $button[0] = $button1;
    
    $at = array(
        "senderkey" => $SENDER_KEY,
        "templatecode" => $TEMP_CODE,
        "message" => $message,
        "button" => $button
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message($cstid, $MOBILE, "bizp_2021080916341105928894221", "bcdc7fbde9bec506790e366bcc2b99d947868f10","STEP_1_CEO","A1003");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1008","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
}

	
/*
 * 
 * 재산제세
 * 컨설팅 변경시 알림톡 발송
 * 
 * */
function send_kakao_shinseung_members_cons($SEND_PHONE, $cstid, $message,$prog,$userid,$subject){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    $TEMP_CODE = "bizp_2021100711040726514528469";
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
    /*
     $button2 = array("name"=>"이전 대화보기",
     "type"=>"WL",
     "url_pc"=>"https://taxtoc.channel.io",
     "url_mobile"=>"https://taxtoc.channel.io");
     */
    //	$button = array("button1"=>$button1,"button2"=>$button2);
    $button1 = Array("name" => "세부내역 바로가기",
        "type" => "WL",
        "url_mobile" => "https://taxtok.kr/admin/m/view_trans_free.php?id=$cstid",
        "url_pc" => "https://taxtok.kr/admin/view_trans_free.php?id=$cstid"
    );
    
    
    $button[0] = $button1;
    
    $at = array(
        "senderkey" => $SENDER_KEY,
        "templatecode" => $TEMP_CODE,
        "message" => $message,
        "button" => $button
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message($cstid, $MOBILE, "bizp_2021080916341105928894221", "bcdc7fbde9bec506790e366bcc2b99d947868f10","STEP_1_CEO","A1003");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1008","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
}


function send_kakao_shinseung_members_new2($SEND_PHONE, $cstid, $message,$prog,$userid,$subject){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    $TEMP_CODE = "bizp_2021100711070426514573470";
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
    /*
     $button2 = array("name"=>"이전 대화보기",
     "type"=>"WL",
     "url_pc"=>"https://taxtoc.channel.io",
     "url_mobile"=>"https://taxtoc.channel.io");
     */
    //	$button = array("button1"=>$button1,"button2"=>$button2);
    $button1 = Array("name" => "세부내역 바로가기",
        "type" => "WL",
        "url_mobile" => "https://taxtok.kr/admin/m/view_trans_free.php?id=$cstid",
        "url_pc" => "https://taxtok.kr/admin/view_trans_free.php?id=$cstid"
    );
    
    
    $button[0] = $button1;
    
    $at = array(
        "senderkey" => $SENDER_KEY,
        "templatecode" => $TEMP_CODE,
        "message" => $message,
        "button" => $button
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message($cstid, $MOBILE, "bizp_2021080916341105928894221", "bcdc7fbde9bec506790e366bcc2b99d947868f10","STEP_1_CEO","A1003");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1008","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
}


/*
 *
 * 재산제세
 * 보충조서검토, 컨설팅예상건 변경시 알림톡 발송
 *
 * */

function send_kakao_shinseung_members_comment($SEND_PHONE, $cstid, $message,$prog,$userid,$subject){
    //    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $SENDER_KEY = "64427a5eb014f403b09932ea56cc77cf68f7effe";
    $TEMP_CODE = "bizp_2021102013554605367537137";
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
    /*
     $button2 = array("name"=>"이전 대화보기",
     "type"=>"WL",
     "url_pc"=>"https://taxtoc.channel.io",
     "url_mobile"=>"https://taxtoc.channel.io");
     */
    //	$button = array("button1"=>$button1,"button2"=>$button2);
    $button1 = Array("name" => "바로가기",
        "type" => "WL",
        "url_mobile" => "https://taxtok.kr/admin/m/view_trans_free.php?id=$cstid",
        "url_pc" => "https://taxtok.kr/admin/view_trans_free.php?id=$cstid"
    );
    
    
    $button[0] = $button1;
    
    $at = array(
        "senderkey" => $SENDER_KEY,
        "templatecode" => $TEMP_CODE,
        "message" => $message,
        "button" => $button
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message($cstid, $MOBILE, "bizp_2021080916341105928894221", "bcdc7fbde9bec506790e366bcc2b99d947868f10","STEP_1_CEO","A1003");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, $TEMP_CODE, $SENDER_KEY,$subject,"A1008","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
}



function send_kakao_shinseung_members($SEND_PHONE, $cstid, $message,$prog,$userid){
//    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    
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
    
    
    /*회장님 : 시작*/
    //$SEND_PHONE = "01037111107";
    $data = array();
    $data["account"] = $account;
    $data["refkey"] = "shinseung";
    $data["type"] = "at";
    $data["from"] = "0234520608";
    //$data["to"] = $MOBILE;
    $data["to"] = $SEND_PHONE;
    //$data["to"] = "01055904957";
    /*
     $button2 = array("name"=>"이전 대화보기",
     "type"=>"WL",
     "url_pc"=>"https://taxtoc.channel.io",
     "url_mobile"=>"https://taxtoc.channel.io");
     */
    //	$button = array("button1"=>$button1,"button2"=>$button2);
    $button1 = Array("name" => "보충조서 바로가기",
        "type" => "WL",
        "url_mobile" => "https://taxtok.kr/admin/m/view_trans_free.php?id=$cstid",
        "url_pc" => "https://taxtok.kr/admin/view_trans_free.php?id=$cstid"
    );
    
    
    $button[0] = $button1;
    
    $at = array(
        "senderkey" => "bcdc7fbde9bec506790e366bcc2b99d947868f10",
        "templatecode" => "bizp_2021080916341105928894221",
        "message" => $message,
        "button" => $button
    );
    
    $data["content"] = array("at" => $at);
    // 알림톡 발송
    $sendHeader = array('Authorization: Bearer '.$tokenJosnDecode['accesstoken'], 'Content-Type: application/json', 'charset=utf-8');
    //$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
    $jsonData = json_encode($data);
    
    
    /*어뷰징 최종검증*/
    //$ck_cnt = ck_send_message($cstid, $MOBILE, "bizp_2021080916341105928894221", "bcdc7fbde9bec506790e366bcc2b99d947868f10","STEP_1_CEO","A1003");
    $ck_cnt = 0;
    
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
        send_kakao_log($prog, $SEND_PHONE, "bizp_2021080916341105928894221", "bcdc7fbde9bec506790e366bcc2b99d947868f10","KAKAO_SEND_GROUP","A1003","",$userid);
    }else{
        echo 'error:abuse';
    }
    /*회장님 : 끝*/
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
            default: $sender_id ="64427a5eb014f403b09932ea56cc77cf68f7effe";//세무톡
            $template_id = "bizp_2021042718185226670364665";
        }
        
    }
    
    
    return array("sender_id"=> $sender_id, "template_id"=>$template_id);
    
}


/*알림톡 발송 로그*/
function send_kakao_log($biz_id, $mobile, $temp_id, $sender_id, $send_step,$send_flag,$send_flag2,$userid){
    
    //$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
    $http_host = $_SERVER['HTTP_HOST'];
    if($http_host=="localhost")
        $connect3 = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
    else
        $connect3 = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

    $procedure = "
			CREATE PROCEDURE `INSERT_TB700001`(IN P_BIZ_ID VARCHAR(20),
P_MOBILE VARCHAR(20),
P_TEMP_ID VARCHAR(50),
P_SENDER_ID VARCHAR(100),
P_STEP VARCHAR(100),
P_FLAG VARCHAR(10),
P_FLAG2 VARCHAR(45),
P_USERID VARCHAR(4)
)
BEGIN
        
DECLARE CNT INT;
DECLARE TMP_CSTID INT;
        
    #SELECT ifnull(COUNT(1),0) INTO CNT FROM TB700010
    #WHERE SEND_BIZ_ID = P_BIZ_ID AND SEND_TMP_ID = P_TEMP_ID AND SENDER_ID = P_SENDER_ID
    #AND SEND_TMP_STEP = P_STEP AND SEND_FLAG=P_FLAG
    #AND SEND_MOBILE_NUM = P_MOBILE;
        
    #IF CNT = 0 THEN

        INSERT INTO TB700010(SEND_BIZ_ID, SEND_MOBILE_NUM,SENDER_ID, SEND_TMP_ID, SEND_DATE,REGDATE, SEND_FLAG, SEND_TMP_STEP,SEND_FLAG2,REGUSER)
        SELECT P_BIZ_ID, P_MOBILE,P_SENDER_ID, P_TEMP_ID, NOW(), NOW(), P_FLAG, P_STEP, P_FLAG2,P_USERID;
        
        SELECT last_insert_id() INTO TMP_CSTID;

    #END IF;
        
    SELECT TMP_CSTID;
        
END
		";
    
    //기존에 프로시저가 있으면 삭제
    if(mysqli_query($connect3,"DROP PROCEDURE IF EXISTS INSERT_TB700001"))
    { //위에서 만든 프로시저 실행
        if(mysqli_query($connect3,$procedure))
        {
            $query = "CALL INSERT_TB700001('".$biz_id."','".$mobile."','".$temp_id."','".$sender_id."','".$send_step."','".$send_flag."','".$send_flag2."','".$userid."')";
            //프로시저 호출
            try{
                
                mysqli_query($connect3,$query);
                echo "send_ok";
                
            }catch (Exception  $e){
                echo "error==>>".$e;
            }
            mysqli_close();
            
        }
    }
    //$connect=null;
    
}



function ck_send_message($biz_id, $mobile, $temp_id, $sender_id, $send_step,$send_flag){
    
    //$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
    //$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    
    $procedure = "
			CREATE PROCEDURE `CK_SENDLOG_TB700001`(IN P_BIZ_ID INT,
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



function ck_send_message_disc($biz_id, $mobile, $temp_id, $sender_id, $send_step,$send_flag){
    
    //$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
    //$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    $http_host = $_SERVER['HTTP_HOST'];
    if($http_host=="localhost")
        $connect = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
    else
        $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    
    $procedure = "
			CREATE PROCEDURE `CK_SENDLOG_TB700001_DISC`(IN P_BIZ_ID INT,
P_MOBILE VARCHAR(20),
P_TEMP_ID VARCHAR(50),
P_SENDER_ID VARCHAR(100),
P_STEP VARCHAR(10),
P_FLAG VARCHAR(10)
)
BEGIN
        
DECLARE CNT INT;
        
    SELECT ifnull(COUNT(1),0) INTO CNT FROM TB700010
    WHERE SEND_TMP_ID = P_TEMP_ID
    AND SEND_MOBILE_NUM = P_MOBILE
    AND SEND_TMP_STEP = P_STEP
    AND SEND_FLAG=P_FLAG;
    SELECT CNT;
        
END
		";
    
    //기존에 프로시저가 있으면 삭제
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS CK_SENDLOG_TB700001_DISC"))
    { //위에서 만든 프로시저 실행
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL CK_SENDLOG_TB700001_DISC('".$biz_id."','".$mobile."','".$temp_id."','".$sender_id."','".$send_step."','".$send_flag."')";
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