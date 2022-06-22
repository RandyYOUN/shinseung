<?php


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
        
        INSERT INTO TB700010(SEND_BIZ_ID, SEND_MOBILE_NUM,SENDER_ID, SEND_TMP_ID, SEND_DATE, SEND_FLAG, SEND_TMP_STEP,SEND_FLAG2,REGUSER, REGDATE)
        SELECT P_BIZ_ID, P_MOBILE,P_SENDER_ID, P_TEMP_ID, NOW(), P_FLAG, P_STEP, P_FLAG2,P_USERID,NOW();
        
        SELECT last_insert_id() INTO TMP_CSTID;
        
    #END IF;
        
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




function return_regbranch($branch){
    switch($branch){
        case "D1019" :
            $mobile_num ="18993582";//세무톡
            break;
        case "D1003" :
            $mobile_num ="18993582";//강남
            break;
        case "D1002" :
            $mobile_num ="18993582";//강남
            break;
        case "D1014" :
            $mobile_num ="18993582";//강남
            break;
        case "D1013" :
            $mobile_num ="18993582";//강남
            break;
        case "D1004" :
            $mobile_num ="0313350608"; //용인
            break;
        case "D1006" :
            $mobile_num ="0313870806";//안양
            break;
        case "D1007" :
            $mobile_num ="0312029620";//수원
            break;
        case "D1008" :
            $mobile_num ="0319320863";//일산
            break;
        case "D1009" :
            $mobile_num ="0323239620";//부천
            break;
        case "D1010" :
            $mobile_num ="0317633077";//광주
            break;
        case "D1011" :
            $mobile_num ="0317050608";//분당
            break;
        case "D1012" :
            $mobile_num ="0312110608";//기흥
            break;
        case "D1021" :
            $mobile_num ="18993582";//동탄

            break;
        default: $mobile_num ="18993582";//세무톡
    }
    return $mobile_num;
}


//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
    
    $connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    
    
    
    //개발 : 시작
    if($_POST["action"] == "dev"){
        $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $progress=mysqli_real_escape_string($connect,$_POST["progress"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
        $tax_flag=mysqli_real_escape_string($connect,$_POST["tax_flag"]);
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $cst_address=mysqli_real_escape_string($connect,$_POST["cst_address"]);
        $trans_target=mysqli_real_escape_string($connect,$_POST["trans_target"]);
        $pay_flag=mysqli_real_escape_string($connect,$_POST["pay_flag"]);
        $pay_date=mysqli_real_escape_string($connect,$_POST["pay_date"]);
        $price=mysqli_real_escape_string($connect,$_POST["price"]);
        $price2=mysqli_real_escape_string($connect,$_POST["price2"]);
        $trans_date=mysqli_real_escape_string($connect,$_POST["trans_date"]);
        $acq_date=mysqli_real_escape_string($connect,$_POST["acq_date"]);
        $delivery_flag=mysqli_real_escape_string($connect,$_POST["delivery_flag"]);
        $trans_price=mysqli_real_escape_string($connect,$_POST["trans_price"]);
        $acq_price=mysqli_real_escape_string($connect,$_POST["acq_price"]);
        $deadline=mysqli_real_escape_string($connect,$_POST["deadline"]);
        $total_tax=mysqli_real_escape_string($connect,$_POST["total_tax"]);
        $file_real_str=mysqli_real_escape_string($connect,$_POST["file_real_str"]);
        $file_view_str=mysqli_real_escape_string($connect,$_POST["file_view_str"]);
        $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
        $owner=mysqli_real_escape_string($connect,$_POST["owner"]);
        $num=mysqli_real_escape_string($connect,$_POST["num"]);
        $prio_num=mysqli_real_escape_string($connect,$_POST["prio_num"]);
        $rep_num=mysqli_real_escape_string($connect,$_POST["rep_num"]);
        $rep_date=mysqli_real_escape_string($connect,$_POST["rep_date"]);
        $reg_date=mysqli_real_escape_string($connect,$_POST["reg_date"]);
        $option_price=mysqli_real_escape_string($connect,$_POST["option_price"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_TRANS(IN REGUSER INT(11),PROGRESS VARCHAR(5) , CONTENTS LONGTEXT, REG_BRANCH VARCHAR(5), TAX_FLAG VARCHAR(5), CSTNAME VARCHAR(50), MOBILE VARCHAR(50), CST_ADDRESS VARCHAR(200),TRANS_TARGET VARCHAR(5),PAY_FLAG VARCHAR(5), PAY_DATE DATETIME, PRICE INT(11),PRICE2 INT(11),TRANS_DATE DATETIME, ACQ_DATE DATETIME, DELIVERY_FLAG VARCHAR(5), TRANS_PRICE INT(11),ACQ_PRICE INT(11),DEADLINE DATETIME, TOTAL_TAX INT(11), FILE_REAL_STR LONGTEXT, FILE_VIEW_STR LONGTEXT, CSTID INT(11), CATE VARCHAR(5), OWNER VARCHAR(5), NUM INT(11), PRIO_NUM VARCHAR(5), REP_NUM VARCHAR(50), REP_DATE DATETIME, REG_DATE DATETIME , OPTION_PRICE VARCHAR(45) )
			BEGIN
            
				DECLARE TMP_REGDATE DATETIME;
            
				SELECT DATE_FORMAT(A.REGDATE, '%y-%m-%d') INTO TMP_REGDATE FROM TB600010 AS A WHERE A.ID = cstid;
            
				IF TMP_REGDATE = DATE_FORMAT(reg_date, '%y-%m-%d') THEN
            
					UPDATE TB600010 SET
					EDTDATE=NOW(),
					PROGRESS=progress,
					CONTENTS=contents,
					REG_BRANCH=reg_branch,
					TAX_FLAG=tax_flag,
					CSTNAME=cstname,
					MOBILE=mobile,
					CST_ADDRESS=cst_address,
					TRANS_TARGET=trans_target,
					PAY_FLAG=pay_flag,
					PAY_DATE=pay_date,
					PRICE=REPLACE(price,',',''),
					PRICE2=REPLACE(price2,',',''),
					TRANS_DATE=trans_date,
					ACQ_DATE=acq_date,
					DELIVERY_FLAG=delivery_flag,
					TRANS_PRICE=REPLACE(trans_price,',',''),
					ACQ_PRICE=REPLACE(acq_price,',',''),
					DEADLINE=deadline,
					TOTAL_TAX=total_tax,
					FILE_REAL_STR=file_real_str,
					FILE_VIEW_STR=file_view_str,
					CATE = cate,
					OWNER_USER = owner,
					NUM = num,
					PRIO_NUM = prio_num,
					REP_NUM = rep_num,
					REP_DATE = rep_date,
					OPTION_PRICE = option_price
					WHERE ID = cstid ;
            
                ELSE
            
					UPDATE TB600010 SET
					EDTDATE=NOW(),
					PROGRESS=progress,
					CONTENTS=contents,
					REG_BRANCH=reg_branch,
					TAX_FLAG=tax_flag,
					CSTNAME=cstname,
					MOBILE=mobile,
					CST_ADDRESS=cst_address,
					TRANS_TARGET=trans_target,
					PAY_FLAG=pay_flag,
					PAY_DATE=pay_date,
					PRICE=REPLACE(price,',',''),
					PRICE2=REPLACE(price2,',',''),
					TRANS_DATE=trans_date,
					ACQ_DATE=acq_date,
					DELIVERY_FLAG=delivery_flag,
					TRANS_PRICE=REPLACE(trans_price,',',''),
					ACQ_PRICE=REPLACE(acq_price,',',''),
					DEADLINE=deadline,
					TOTAL_TAX=total_tax,
					FILE_REAL_STR=file_real_str,
					FILE_VIEW_STR=file_view_str,
					CATE = cate,
					OWNER_USER = owner,
					NUM = num,
					PRIO_NUM = prio_num,
					REP_NUM = rep_num,
					REP_DATE = rep_date,
					REGDATE = reg_date,
					OPTION_PRICE = option_price
					WHERE ID = cstid ;
            
                END IF;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TRANS"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_TRANS('".$reguser."','".$progress."','".$contents."','".$reg_branch."','".$tax_flag."','".$cstname."','".$mobile."','".$cst_address."','".$trans_target."','".$pay_flag."','".$pay_date."','".$price."','".$price2."','".$trans_date."','".$acq_date."','".$delivery_flag."','".$trans_price."','".$acq_price."','".$deadline."','".$total_tax."','".$file_real_str."','".$file_view_str."','".$cstid."','".$cate."','".$owner."','".$num."','".$prio_num."','".$rep_num."','".$rep_date."','".$reg_date."','".$option_price."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query.'수정 되었습니다.';
            }
        }
        
    }
    //개발 : 끝
    

    
    //개발 : 시작
    if($_POST["action"] == "action_insert_disc"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $username=mysqli_real_escape_string($connect,$_POST["username"]);
        $q_max_1=mysqli_real_escape_string($connect,$_POST["q_max_1"]);
        $q_max_2=mysqli_real_escape_string($connect,$_POST["q_max_2"]);
        $q_max_3=mysqli_real_escape_string($connect,$_POST["q_max_3"]);
        $q_max_4=mysqli_real_escape_string($connect,$_POST["q_max_4"]);
        $q_max_5=mysqli_real_escape_string($connect,$_POST["q_max_5"]);
        $q_max_6=mysqli_real_escape_string($connect,$_POST["q_max_6"]);
        $q_max_7=mysqli_real_escape_string($connect,$_POST["q_max_7"]);
        $q_max_8=mysqli_real_escape_string($connect,$_POST["q_max_8"]);
        $q_max_9=mysqli_real_escape_string($connect,$_POST["q_max_9"]);
        $q_max_10=mysqli_real_escape_string($connect,$_POST["q_max_10"]);
        $q_max_11=mysqli_real_escape_string($connect,$_POST["q_max_11"]);
        $q_max_12=mysqli_real_escape_string($connect,$_POST["q_max_12"]);
        $q_max_13=mysqli_real_escape_string($connect,$_POST["q_max_13"]);
        $q_max_14=mysqli_real_escape_string($connect,$_POST["q_max_14"]);
        $q_max_15=mysqli_real_escape_string($connect,$_POST["q_max_15"]);
        $q_max_16=mysqli_real_escape_string($connect,$_POST["q_max_16"]);
        $q_max_17=mysqli_real_escape_string($connect,$_POST["q_max_17"]);
        $q_max_18=mysqli_real_escape_string($connect,$_POST["q_max_18"]);
        $q_max_19=mysqli_real_escape_string($connect,$_POST["q_max_19"]);
        $q_max_20=mysqli_real_escape_string($connect,$_POST["q_max_20"]);
        $q_max_21=mysqli_real_escape_string($connect,$_POST["q_max_21"]);
        $q_max_22=mysqli_real_escape_string($connect,$_POST["q_max_22"]);
        $q_max_23=mysqli_real_escape_string($connect,$_POST["q_max_23"]);
        $q_max_24=mysqli_real_escape_string($connect,$_POST["q_max_24"]);
        $q_max_25=mysqli_real_escape_string($connect,$_POST["q_max_25"]);
        $q_max_26=mysqli_real_escape_string($connect,$_POST["q_max_26"]);
        $q_max_27=mysqli_real_escape_string($connect,$_POST["q_max_27"]);
        $q_max_28=mysqli_real_escape_string($connect,$_POST["q_max_28"]);
        $q_min_1=mysqli_real_escape_string($connect,$_POST["q_min_1"]);
        $q_min_2=mysqli_real_escape_string($connect,$_POST["q_min_2"]);
        $q_min_3=mysqli_real_escape_string($connect,$_POST["q_min_3"]);
        $q_min_4=mysqli_real_escape_string($connect,$_POST["q_min_4"]);
        $q_min_5=mysqli_real_escape_string($connect,$_POST["q_min_5"]);
        $q_min_6=mysqli_real_escape_string($connect,$_POST["q_min_6"]);
        $q_min_7=mysqli_real_escape_string($connect,$_POST["q_min_7"]);
        $q_min_8=mysqli_real_escape_string($connect,$_POST["q_min_8"]);
        $q_min_9=mysqli_real_escape_string($connect,$_POST["q_min_9"]);
        $q_min_10=mysqli_real_escape_string($connect,$_POST["q_min_10"]);
        $q_min_11=mysqli_real_escape_string($connect,$_POST["q_min_11"]);
        $q_min_12=mysqli_real_escape_string($connect,$_POST["q_min_12"]);
        $q_min_13=mysqli_real_escape_string($connect,$_POST["q_min_13"]);
        $q_min_14=mysqli_real_escape_string($connect,$_POST["q_min_14"]);
        $q_min_15=mysqli_real_escape_string($connect,$_POST["q_min_15"]);
        $q_min_16=mysqli_real_escape_string($connect,$_POST["q_min_16"]);
        $q_min_17=mysqli_real_escape_string($connect,$_POST["q_min_17"]);
        $q_min_18=mysqli_real_escape_string($connect,$_POST["q_min_18"]);
        $q_min_19=mysqli_real_escape_string($connect,$_POST["q_min_19"]);
        $q_min_20=mysqli_real_escape_string($connect,$_POST["q_min_20"]);
        $q_min_21=mysqli_real_escape_string($connect,$_POST["q_min_21"]);
        $q_min_22=mysqli_real_escape_string($connect,$_POST["q_min_22"]);
        $q_min_23=mysqli_real_escape_string($connect,$_POST["q_min_23"]);
        $q_min_24=mysqli_real_escape_string($connect,$_POST["q_min_24"]);
        $q_min_25=mysqli_real_escape_string($connect,$_POST["q_min_25"]);
        $q_min_26=mysqli_real_escape_string($connect,$_POST["q_min_26"]);
        $q_min_27=mysqli_real_escape_string($connect,$_POST["q_min_27"]);
        $q_min_28=mysqli_real_escape_string($connect,$_POST["q_min_28"]);
        
        
        
        $procedure = "
CREATE DEFINER=`sschina`@`%` PROCEDURE `INSERT_DISC`(
	IN P_ID VARCHAR(20),
	P_USERNAME VARCHAR(50),
	P_MAX_1 INT,P_MIN_1 INT,
	P_MAX_2 INT,P_MIN_2 INT,
	P_MAX_3 INT,P_MIN_3 INT,
	P_MAX_4 INT,P_MIN_4 INT,
	P_MAX_5 INT,P_MIN_5 INT,
	P_MAX_6 INT,P_MIN_6 INT,
	P_MAX_7 INT,P_MIN_7 INT,
	P_MAX_8 INT,P_MIN_8 INT,
	P_MAX_9 INT,P_MIN_9 INT,
	P_MAX_10 INT,P_MIN_10 INT,
	P_MAX_11 INT,P_MIN_11 INT,
	P_MAX_12 INT,P_MIN_12 INT,
	P_MAX_13 INT,P_MIN_13 INT,
	P_MAX_14 INT,P_MIN_14 INT,
	P_MAX_15 INT,P_MIN_15 INT,
	P_MAX_16 INT,P_MIN_16 INT,
	P_MAX_17 INT,P_MIN_17 INT,
	P_MAX_18 INT,P_MIN_18 INT,
	P_MAX_19 INT,P_MIN_19 INT,
	P_MAX_20 INT,P_MIN_20 INT,
	P_MAX_21 INT,P_MIN_21 INT,
	P_MAX_22 INT,P_MIN_22 INT,
	P_MAX_23 INT,P_MIN_23 INT,
	P_MAX_24 INT,P_MIN_24 INT,
	P_MAX_25 INT,P_MIN_25 INT,
	P_MAX_26 INT,P_MIN_26 INT,
	P_MAX_27 INT,P_MIN_27 INT,
	P_MAX_28 INT,P_MIN_28 INT
 )
BEGIN
            
	IF IFNULL(P_ID,'') <> '' THEN
		UPDATE TB980099 SET 
		USERNAME = P_USERNAME,
		Q1_MAX=P_MAX_1, Q1_MIN=P_MIN_1,
		Q2_MAX=P_MAX_2, Q2_MIN=P_MIN_2,
		Q3_MAX=P_MAX_3, Q3_MIN=P_MIN_3,
		Q4_MAX=P_MAX_4, Q4_MIN=P_MIN_4,
		Q5_MAX=P_MAX_5, Q5_MIN=P_MIN_5,
		Q6_MAX=P_MAX_6, Q6_MIN=P_MIN_6,
		Q7_MAX=P_MAX_7, Q7_MIN=P_MIN_7,
		Q8_MAX=P_MAX_8, Q8_MIN=P_MIN_8,
		Q9_MAX=P_MAX_9, Q9_MIN=P_MIN_9,
		Q10_MAX=P_MAX_10, Q10_MIN=P_MIN_10,
		Q11_MAX=P_MAX_11, Q11_MIN=P_MIN_11,
		Q12_MAX=P_MAX_12, Q12_MIN=P_MIN_12,
		Q13_MAX=P_MAX_13, Q13_MIN=P_MIN_13,
		Q14_MAX=P_MAX_14, Q14_MIN=P_MIN_14,
		Q15_MAX=P_MAX_15, Q15_MIN=P_MIN_15,
		Q16_MAX=P_MAX_16, Q16_MIN=P_MIN_16,
		Q17_MAX=P_MAX_17, Q17_MIN=P_MIN_17,
		Q18_MAX=P_MAX_18, Q18_MIN=P_MIN_18,
		Q19_MAX=P_MAX_19, Q19_MIN=P_MIN_19,
		Q20_MAX=P_MAX_20, Q20_MIN=P_MIN_20,
		Q21_MAX=P_MAX_21, Q21_MIN=P_MIN_21,
		Q22_MAX=P_MAX_22, Q22_MIN=P_MIN_22,
		Q23_MAX=P_MAX_23, Q23_MIN=P_MIN_23,
		Q24_MAX=P_MAX_24, Q24_MIN=P_MIN_24,
		Q25_MAX=P_MAX_25, Q25_MIN=P_MIN_25,
		Q26_MAX=P_MAX_26, Q26_MIN=P_MIN_26,
		Q27_MAX=P_MAX_27, Q27_MIN=P_MIN_27,
		Q28_MAX=P_MAX_28, Q28_MIN=P_MIN_28,
		EDTDATE = NOW()
		WHERE ID = P_ID;
		
	ELSE
		INSERT INTO TB980099(REGDATE,USERNAME,Q1_MAX,Q1_MIN,Q2_MAX,Q2_MIN,Q3_MAX,Q3_MIN,Q4_MAX,Q4_MIN,Q5_MAX,Q5_MIN,Q6_MAX,Q6_MIN,Q7_MAX,Q7_MIN,Q8_MAX,Q8_MIN,Q9_MAX,Q9_MIN,Q10_MAX,Q10_MIN,
		Q11_MAX,Q11_MIN,Q12_MAX,Q12_MIN,Q13_MAX,Q13_MIN,Q14_MAX,Q14_MIN,Q15_MAX,Q15_MIN,Q16_MAX,Q16_MIN,Q17_MAX,Q17_MIN,Q18_MAX,Q18_MIN,Q19_MAX,Q19_MIN,Q20_MAX,Q20_MIN,
		Q21_MAX,Q21_MIN,Q22_MAX,Q22_MIN,Q23_MAX,Q23_MIN,Q24_MAX,Q24_MIN,Q25_MAX,Q25_MIN,Q26_MAX,Q26_MIN,Q27_MAX,Q27_MIN,Q28_MAX,Q28_MIN)
		SELECT NOW(),P_USERNAME,P_MAX_1,P_MIN_1,P_MAX_2,P_MIN_2,P_MAX_3,P_MIN_3,P_MAX_4,P_MIN_4,P_MAX_5,P_MIN_5,P_MAX_6,P_MIN_6,P_MAX_7,P_MIN_7,P_MAX_8,P_MIN_8,P_MAX_9,P_MIN_9,P_MAX_10,P_MIN_10,
		P_MAX_11,P_MIN_11,P_MAX_12,P_MIN_12,P_MAX_13,P_MIN_13,P_MAX_14,P_MIN_14,P_MAX_15,P_MIN_15,P_MAX_16,P_MIN_16,P_MAX_17,P_MIN_17,P_MAX_18,P_MIN_18,P_MAX_19,P_MIN_19,P_MAX_20,P_MIN_20,
		P_MAX_21,P_MIN_21,P_MAX_22,P_MIN_22,P_MAX_23,P_MIN_23,P_MAX_24,P_MIN_24,P_MAX_25,P_MIN_25,P_MAX_26,P_MIN_26,P_MAX_27,P_MIN_27,P_MAX_28,P_MIN_28;
		
	END IF;
            
END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_DISC"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_DISC('".$id."','".$username."','".$q_max_1."','".$q_min_1."','".$q_max_2."','".$q_min_2."','"
                    .$q_max_3."','".$q_min_3."','".$q_max_4."','".$q_min_4."','".$q_max_5."','".$q_min_5."','".$q_max_6."','".$q_min_6."','".$q_max_7."','".$q_min_7."','"
                    .$q_max_8."','".$q_min_8."','".$q_max_9."','".$q_min_9."','".$q_max_10."','".$q_min_10."','".$q_max_11."','"
                    .$q_min_11."','".$q_max_12."','".$q_min_12."','".$q_max_13."','".$q_min_13."','".$q_max_14."','".$q_min_14."','".$q_max_15."','"
                    .$q_min_15."','".$q_max_16."','".$q_min_16."','".$q_max_17."','".$q_min_17."','".$q_max_18."','".$q_min_18."','".$q_max_19."','".$q_min_19."','"
                    .$q_max_20."','".$q_min_20."','".$q_max_21."','".$q_min_21."','".$q_max_22."','".$q_min_22."','".$q_max_23."','".$q_min_23."','".$q_max_24."','".$q_min_24."','"
                    .$q_max_25."','".$q_min_25."','".$q_max_26."','".$q_min_26."','".$q_max_27."','".$q_min_27."','".$q_max_28."','".$q_min_28."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '작성완료.';
            }
        }
        
    }
    //개발 : 끝

    
    
    if($_POST["action"]=="send_sms_self"){
        $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        //db연결 본인의 db 정보를 넣어준다!
        $connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
        //( "db.sostax.kr:3306", "sschina", "shinseung1@" )
        
        //ajax로 넘긴 데이터 값은 "select"
        //값이 존재하면 true를 리턴
        //users테이블 조회 프로시져를 만든다.
        $procedure = "
	CREATE PROCEDURE SELECT_CSTID_SEND_SMS(P_CSTID INT)
	BEGIN
        SELECT A.CSTID, A.CSTNAME,
REPLACE(REPLACE(RETURN_STR(A.MOBILE),'-',''),' ','') AS MOBILE,
B.REG_BRANCH, B.BIZ_ID, B.INCOME_TAX, B.REPORT_NUM_INCOME, B.JIBANG_TAX, B.REPORT_NUM_WETAX
	    FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
        WHERE A.CSTID = P_CSTID AND B.CST_TYPE='A1001' AND B.CST_TYPE_YEAR=DATE_FORMAT(now(), '%Y');
	END;
	";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CSTID_SEND_SMS"))
        {
            
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL SELECT_CSTID_SEND_SMS(".$cstid.")";
                $result = mysqli_query($connect,$query);
                
                if(mysqli_num_rows($result) >0)
                {
                    while($row = mysqli_fetch_array($result)){
                        $CSTNAME = $row["CSTNAME"];
                        $MOBILE = $row["MOBILE"];
                        $INCOME_TAX = $row["INCOME_TAX"];
                        $REPORT_NUM_INCOME = $row["REPORT_NUM_INCOME"];
                        $JIBANG_TAX = $row["JIBANG_TAX"];
                        $REPORT_NUM_WETAX = $row["REPORT_NUM_WETAX"];
                        $BIZ_ID = $row["BIZ_ID"];
                        $REG_BRANCH=$row["REG_BRANCH"];
                        
                        
                    }
                }
            }
        }
        mysqli_close($connect);
        
        
        /*
         * 뿌리오 발송API 내부알림
         */
        $_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';
        
        /*
         * 요청값
         */
        $_param['userid'] = 'shinseung';     // [필수] 뿌리오 아이디
        $_param['callback'] = return_regbranch($REG_BRANCH);    // [필수] 발신번호 - 숫자만
        
        //$MOBILE=return_regbranch($REG_BRANCH);
        $_param['phone'] = $MOBILE;
        //$_param['phone'] = '01055904957';
        
        $_param['msg'] = $CSTNAME."님의 종합소득세 신고가 완료되었습니다.
            
■ 납부서 확인
소득세 :  ".$INCOME_TAX." 원
홈택스 전자신고번호 : ".$REPORT_NUM_INCOME."
    
지방세 :  ".$JIBANG_TAX." 원
위택스 전자신고번호 : ".$REPORT_NUM_WETAX."
    
납부서를 꼭 확인해주십시오.
    
납부서확인하기 링크
http://taxtok.kr/tax_income/cst_login.php
    
앞으로도 더 나은 서비스와 세무정보를 드리기 위해 최선을 다하겠습니다.
감사합니다.";
        $_param['subject'] = '종합소득세 신고안내';
        
        if(mysqli_num_rows($result) > 0){
            
            $_curl = curl_init();
            curl_setopt($_curl,CURLOPT_URL,$_api_url);
            curl_setopt($_curl,CURLOPT_POST,true);
            curl_setopt($_curl,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($_curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($_curl,CURLOPT_POSTFIELDS,$_param);
            $_result = curl_exec($_curl);
            curl_close($_curl);
            //$test = $_result[0];
            $_result = json_decode($_result);
            //$test = json_encode($_result);
			$print_ok = $_result->{'result'}; 
            
        }
        if($print_ok == "ok"){
			send_kakao_log($BIZ_ID, $MOBILE, "SMS발송", "SMS발송", "SMS발송","A1001",'',$userid);
			//echo json_encode($_result);
			echo "전송완료";
		}else{
			send_kakao_log($BIZ_ID, $MOBILE, "SMS발송", $print_ok, "ERROR","A1001",'',$userid);
			echo $MOBILE;//json_encode($_result);
			//echo "에러";
		}
        
//        echo $print_ok; 

        
        /*
         뿌리오 끝
         */
        
    }




    
    if($_POST["action"]=="action_RPA_acc_insert")
    { //ajax로 넘긴 data를 받아준다.
        $CSTNAME=mysqli_real_escape_string($connect,$_POST["CSTNAME"]);
        $MOBILE=mysqli_real_escape_string($connect,$_POST["MOBILE"]);
        $REG_BRANCH=mysqli_real_escape_string($connect,$_POST["REG_BRANCH"]);
        $DEC_REGUSER=mysqli_real_escape_string($connect,$_POST["DEC_REGUSER"]);
        $EST_FEE=mysqli_real_escape_string($connect,$_POST["EST_FEE"]);
        $DEP_FEE=mysqli_real_escape_string($connect,$_POST["DEP_FEE"]);
        $DOUZONE_SVR=mysqli_real_escape_string($connect,$_POST["DOUZONE_SVR"]);
        $DOUZONE_CODE=mysqli_real_escape_string($connect,$_POST["DOUZONE_CODE"]);
        $SMARTA_REG_SERVER=mysqli_real_escape_string($connect,$_POST["SMARTA_REG_SERVER"]);
        $ACC_TAX=mysqli_real_escape_string($connect,$_POST["ACC_TAX"]);
        $DEL_TYPE_PAYMENT=mysqli_real_escape_string($connect,$_POST["DEL_TYPE_PAYMENT"]);
        $EMAIL=mysqli_real_escape_string($connect,$_POST["EMAIL"]);
        $RESIDENT1=mysqli_real_escape_string($connect,$_POST["RESIDENT1"]);
        $RESIDENT2=mysqli_real_escape_string($connect,$_POST["RESIDENT2"]);
        $REF_BANK=mysqli_real_escape_string($connect,$_POST["REF_BANK"]);
        $REF_ACC=mysqli_real_escape_string($connect,$_POST["REF_ACC"]);
        $ACC_HOLDER=mysqli_real_escape_string($connect,$_POST["ACC_HOLDER"]);
        $CST_TYPE=mysqli_real_escape_string($connect,$_POST["cst_type"]);
        $REGUSER=mysqli_real_escape_string($connect,$_POST["userid"]);
        $CSTID=mysqli_real_escape_string($connect,$_POST["cstid"]);
        
        $procedure = "
		CREATE DEFINER=`sschina`@`%` PROCEDURE `INSERT_UPDATE_TB100020`(
            IN P_CSTNAME varchar(45), 
            P_MOBILE varchar(45),
            P_REG_BRANCH VARCHAR(5),
            P_DEC_REGUSER VARCHAR(20),
            P_EST_FEE DOUBLE,
            P_DEP_FEE DOUBLE,
            P_DOUZONE_SVR VARCHAR(1),
            P_DOUZONE_CODE VARCHAR(4),
            P_SMARTA_REG_SERVER VARCHAR(10),
            P_ACC_TAX DOUBLE,
            P_DEL_TYPE_PAYMENT VARCHAR(10),
            P_EMAIL VARCHAR(50),
            P_RESIDENT1 varchar(10), 
            P_RESIDENT2 varchar(10),  
            P_REF_BANK varchar(45), 
            P_REF_ACC varchar(100),
            P_ACC_HOLDER VARCHAR(45),
            P_CST_TYPE varchar(10), 
            P_REGUSER VARCHAR(5),
            P_CSTID INT(11)
		)
BEGIN
            
        DECLARE P_RESIDENT_ID VARCHAR(15);
        DECLARE TMP_CSTID INT;
        DECLARE TMP_CSTID2 INT;
        DECLARE TMP_BIZID INT;
        DECLARE TMP_BIZID2  INT;
        DECLARE CNT INT;
        DECLARE CNT2 INT;
        DECLARE CNT3 INT;
        
        SET P_RESIDENT_ID = CONCAT(P_RESIDENT1,'-',P_RESIDENT2);
        
       IF IFNULL(P_CSTID,0) = 0 THEN
            
            SELECT IFNULL(CSTID,'') INTO TMP_CSTID FROM TB100020 WHERE CSTNAME = P_CSTNAME AND REPLACE(MOBILE,'-','')=REPLACE(P_MOBILE,'-','');
            
            IF IFNULL(TMP_CSTID,0) <> 0 THEN
                UPDATE TB100020 SET CSTNAME=P_CSTNAME,MOBILE=REPLACE(P_MOBILE,'-',''),  EMAIL=P_EMAIL,RESIDENT_ID=P_RESIDENT_ID,REF_BANK=P_REF_BANK,
                REF_ACC=P_REF_ACC,ACC_HOLDER=P_ACC_HOLDER, EDTDATE=NOW()
                WHERE CSTID = TMP_CSTID;
                
            ELSE
                INSERT INTO TB100020(CSTNAME,MOBILE,EMAIL,RESIDENT_ID,REF_BANK,REF_ACC,ACC_HOLDER,
                REGDATE)
                SELECT P_CSTNAME,REPLACE(REPLACE(P_MOBILE,'-',''),' ',''),P_EMAIL,P_RESIDENT_ID,P_REF_BANK,P_REF_ACC,P_ACC_HOLDER,
                NOW();
                SELECT last_insert_id() INTO TMP_CSTID;
            END IF;


            SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 WHERE CSTID=TMP_CSTID
            AND CST_TYPE='A1001'
            AND CST_TYPE_YEAR = DATE_FORMAT(now(), '%Y')
            ;


    
            IF IFNULL(TMP_BIZID,'') <> '' THEN
                UPDATE TB100022 SET REG_BRANCH=P_REG_BRANCH,DEC_REGUSER=P_DEC_REGUSER,EST_FEE_SELF=P_EST_FEE,
                DEP_FEE=P_DEP_FEE,SMARTA_REG_SERVER=P_SMARTA_REG_SERVER,ACC_TAX=P_ACC_TAX,
                DEL_TYPE_PAYMENT=P_DEL_TYPE_PAYMENT, EDTDATE=NOW()
                WHERE BIZ_ID = TMP_BIZID;
            ELSE
                INSERT INTO TB100022(CSTID,BIZ_ID,CST_TYPE,CST_TYPE_YEAR,CST_TYPE_SEQ,REG_BRANCH,DEC_REGUSER,
                EST_FEE_SELF,DEP_FEE,SMARTA_REG_SERVER,ACC_TAX,DEL_TYPE_PAYMENT,REGDATE,REGUSER,EDTDATE)
                SELECT TMP_CSTID,TMP_BIZID, 'A1001', DATE_FORMAT(now(), '%Y'),'1',P_REG_BRANCH,P_DEC_REGUSER,
                P_EST_FEE,P_DEP_FEE, P_SMARTA_REG_SERVER, P_ACC_TAX, P_DEL_TYPE_PAYMENT, NOW(),P_REGUSER,NOW();
    
                SELECT last_insert_id() INTO TMP_BIZID;
            END IF;


        ELSE
            UPDATE TB100020 SET CSTNAME=P_CSTNAME,MOBILE=REPLACE(P_MOBILE,'-',''), EMAIL=P_EMAIL,RESIDENT_ID=P_RESIDENT_ID,REF_BANK=P_REF_BANK,
            REF_ACC=P_REF_ACC,ACC_HOLDER=P_ACC_HOLDER, EDTDATE=NOW()
            WHERE CSTID = P_CSTID;

            SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 WHERE CSTID = P_CSTID AND CST_TYPE='A1001' AND CST_TYPE_YEAR=DATE_FORMAT(now(), '%Y');
            SET TMP_CSTID = P_CSTID;

            IF IFNULL(TMP_BIZID,'') <> '' THEN
                UPDATE TB100022 SET REG_BRANCH=P_REG_BRANCH,DEC_REGUSER=P_DEC_REGUSER,EST_FEE_SELF=P_EST_FEE,
                DEP_FEE=P_DEP_FEE,SMARTA_REG_SERVER=P_SMARTA_REG_SERVER,ACC_TAX=P_ACC_TAX,
                DEL_TYPE_PAYMENT=P_DEL_TYPE_PAYMENT, EDTDATE=NOW()
                WHERE BIZ_ID = TMP_BIZID;
            ELSE
                INSERT INTO TB100022(CSTID,BIZ_ID,CST_TYPE,CST_TYPE_YEAR,CST_TYPE_SEQ,REG_BRANCH,DEC_REGUSER,
                EST_FEE_SELF,DEP_FEE,SMARTA_REG_SERVER,ACC_TAX,DEL_TYPE_PAYMENT,REGDATE,REGUSER,EDTDATE)
                SELECT TMP_CSTID,TMP_BIZID, 'A1001', DATE_FORMAT(now(), '%Y'),'1',P_REG_BRANCH,P_DEC_REGUSER,
                P_EST_FEE,P_DEP_FEE, P_SMARTA_REG_SERVER, P_ACC_TAX, P_DEL_TYPE_PAYMENT, NOW(),P_REGUSER,NOW();
    
                SELECT last_insert_id() INTO TMP_BIZID;
            END IF;
        END IF;


        SELECT COUNT(1) INTO CNT FROM TB100030 WHERE BIZ_ID = TMP_BIZID;
        SELECT COUNT(1) INTO CNT2 FROM TB100026 WHERE BIZ_ID = TMP_BIZID;
        SELECT COUNT(1) INTO CNT3 FROM TB100023 WHERE BIZ_ID = TMP_BIZID AND CSTID = P_CSTID;

        IF CNT > 0 THEN
            UPDATE TB100030 SET DOUZONE_SVR=P_DOUZONE_SVR, DOUZONE_CODE=P_DOUZONE_CODE
            WHERE BIZ_ID = TMP_BIZID;
        ELSE
            INSERT INTO TB100030(BIZ_ID,CSTID,DOUZONE_SVR,DOUZONE_CODE)
            SELECT TMP_BIZID, TMP_CSTID, P_DOUZONE_SVR,P_DOUZONE_CODE;
        END IF;

         IF CNT2 = 0 THEN
            INSERT INTO TB100026(BIZ_ID,REGDATE,PROGRESS)
            SELECT TMP_BIZID, NOW(), 'E7208';
		else
			UPDATE TB100026 SET PROGRESS='E7208' WHERE BIZ_ID = TMP_BIZID;
        END IF;

        IF CNT3 = 0 THEN
            INSERT INTO TB100023(BIZ_ID, CSTID)
            SELECT TMP_BIZID, TMP_CSTID;
        END IF;
        
END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_UPDATE_TB100020"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_UPDATE_TB100020('".$CSTNAME ."','".$MOBILE."','".$REG_BRANCH."','".$DEC_REGUSER."','".$EST_FEE."','".$DEP_FEE."','".$DOUZONE_SVR."','".$DOUZONE_CODE."','".$SMARTA_REG_SERVER."','".$ACC_TAX."','".$DEL_TYPE_PAYMENT."','".$EMAIL."','".$RESIDENT1."','".$RESIDENT2."','".$REF_BANK."','".$REF_ACC."','".$ACC_HOLDER."','".$CST_TYPE."','".$REGUSER."','".$CSTID."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
    }
    





    
    //부가세 고객 상세등록/수정 : 시작
    if($_POST["action"] == "action_vat_insert" ){
        
        $output = array();
        $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
        $bizid=mysqli_real_escape_string($connect,$_POST["bizid"]);
        $comp_name=mysqli_real_escape_string($connect,$_POST["comp_name"]);
        $biz_id_num=mysqli_real_escape_string($connect,$_POST["biz_id_num"]);
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $resident_id=mysqli_real_escape_string($connect,$_POST["resident_id"]);
        $opening_day=mysqli_real_escape_string($connect,$_POST["opening_day"]);
        $biz_reg_date=mysqli_real_escape_string($connect,$_POST["biz_reg_date"]);
        $sector=mysqli_real_escape_string($connect,$_POST["sector"]);
        $biz_cate=mysqli_real_escape_string($connect,$_POST["biz_cate"]);
        $comp_address=mysqli_real_escape_string($connect,$_POST["comp_address"]);
        $hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
        $hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
        $comp_phone=mysqli_real_escape_string($connect,$_POST["comp_phone"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $email=mysqli_real_escape_string($connect,$_POST["email"]);
        $e_notice_date=mysqli_real_escape_string($connect,$_POST["e_notice_date"]);
        $douzone_svr=mysqli_real_escape_string($connect,$_POST["douzone_svr"]);
        $douzone_code=mysqli_real_escape_string($connect,$_POST["douzone_code"]);
        $reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
        $regdate=mysqli_real_escape_string($connect,$_POST["regdate"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $cst_type=mysqli_real_escape_string($connect,$_POST["cst_type"]);
        $inf_path=mysqli_real_escape_string($connect,$_POST["inf_path"]);
        $inf_channel=mysqli_real_escape_string($connect,$_POST["inf_channel"]);
        $utm_s=mysqli_real_escape_string($connect,$_POST["utm_s"]);
        $utm_t=mysqli_real_escape_string($connect,$_POST["utm_t"]);
        $utm_c=mysqli_real_escape_string($connect,$_POST["utm_c"]);
        $utm=mysqli_real_escape_string($connect,$_POST["utm"]);
        $option1=mysqli_real_escape_string($connect,$_POST["option1"]);
        $option2=mysqli_real_escape_string($connect,$_POST["option2"]);
        $option3=mysqli_real_escape_string($connect,$_POST["option3"]);
        $option4=mysqli_real_escape_string($connect,$_POST["option4"]);
        $option5=mysqli_real_escape_string($connect,$_POST["option5"]);
        $option6=mysqli_real_escape_string($connect,$_POST["option6"]);
        $est_fee = mysqli_real_escape_string($connect,$_POST["est_fee"]);
        $dep_fee = mysqli_real_escape_string($connect,$_POST["dep_fee"]);
        $dep_type = mysqli_real_escape_string($connect,$_POST["dep_type"]);
        $dep_date = mysqli_real_escape_string($connect,$_POST["dep_date"]);
        $cash_rec = mysqli_real_escape_string($connect,$_POST["cash_rec"]);
        $cash_rec_date = mysqli_real_escape_string($connect,$_POST["cash_rec_date"]);
        $subm_date = mysqli_real_escape_string($connect,$_POST["subm_date"]);
        $subm_date2 = mysqli_real_escape_string($connect,$_POST["subm_date2"]);
        $comp_reg_date = mysqli_real_escape_string($connect,$_POST["comp_reg_date"]);
        $dec_reguser = mysqli_real_escape_string($connect,$_POST["dec_reguser"]);
        $req_e_report = mysqli_real_escape_string($connect,$_POST["req_e_report"]);
        $req_user = mysqli_real_escape_string($connect,$_POST["req_user"]);
        $req_date = mysqli_real_escape_string($connect,$_POST["req_date"]);
        $comp_date = mysqli_real_escape_string($connect,$_POST["comp_date"]);
        $num_e_report = mysqli_real_escape_string($connect,$_POST["num_e_report"]);
        $del_date_payment = mysqli_real_escape_string($connect,$_POST["del_date_payment"]);
        $del_type_payment = mysqli_real_escape_string($connect,$_POST["del_type_payment"]);
        $conf_date_payment = mysqli_real_escape_string($connect,$_POST["conf_date_payment"]);
        $down_payment = mysqli_real_escape_string($connect,$_POST["down_payment"]);
        $memo = mysqli_real_escape_string($connect,$_POST["memo"]);
        
        $procedure = "
CREATE DEFINER=`sschina`@`%` PROCEDURE `INSERT_VAT_CST_ALL`(
IN P_CSTID INT(11),
P_BIZ_ID INT(11),
P_COMP_NAME VARCHAR(200), /*TB100022*/
P_BIZ_ID_NUM VARCHAR(10), /*TB100022*/
P_CSTNAME VARCHAR(45),  /*TB100020*/
P_RESIDENT_ID VARCHAR(15), /*TB100020*/
P_OPENING_DAY DATETIME, /*TB100020*/
P_BIZ_REG_DATE DATETIME, /*TB100020*/
P_SECTOR VARCHAR(45), /*TB100020*/
P_BIZ_CATE VARCHAR(50),  /*TB100020*/
P_COMP_ADDRESS VARCHAR(200),  /*TB100022*/
P_HOMETAXID  VARCHAR(45),  /*TB100020*/
P_HOMETAXPW VARCHAR(45), /*TB100020*/
P_COMP_PHONE VARCHAR(50), /*TB100020*/
P_MOBILE VARCHAR(45), /*TB100020*/
P_EMAIL VARCHAR(50), /*TB100020*/
P_E_NOTICE_DATE DATETIME , /*TB100020*/
P_DOUZONE_SVR VARCHAR(1) , /*TB100020*/
P_DOUZONE_CODE VARCHAR(4),  /*TB100020*/
P_REG_BRANCH VARCHAR(5), /*TB100022*/
P_REGDATE DATETIME , /*TB100022*/
P_REGUSER VARCHAR(5) ,  /*TB100022*/
P_CST_TYPE VARCHAR(5) ,  /*TB100022*/
P_INF_PATH VARCHAR(50),  /*TB100022*/
P_INF_CHANNEL VARCHAR(50),  /*TB100022*/
P_UTM_S TEXT,   /*TB100022*/
P_UTM_T TEXT,  /*TB100022*/
P_UTM_C TEXT,  /*TB100022*/
P_UTM  TEXT/*TB100022*/,
P_OPTION1 VARCHAR(1) , /*TB100024*/
P_OPTION2 VARCHAR(1) , /*TB100024*/
P_OPTION3 VARCHAR(1) , /*TB100024*/
P_OPTION4 VARCHAR(1) , /*TB100024*/
P_OPTION5 VARCHAR(1) , /*TB100024*/
P_OPTION6 VARCHAR(1) , /*TB100024*/
P_EST_FEE INT(11),
P_DEP_FEE INT(11),
P_DEP_TYPE VARCHAR(5),
P_DEP_DATE DATETIME,
P_CASH_REC VARCHAR(10),
P_CASH_REC_DATE DATETIME,
P_SUBM_DATE DATETIME,
P_SUBM_DATE2 DATETIME,
P_COMP_REG_DATE DATETIME,
P_DEC_REGUSER VARCHAR(20),
P_REQ_E_REPORT VARCHAR(1),
P_REQ_USER VARCHAR(20),
P_REQ_DATE DATETIME,
P_COMP_DATE DATETIME,
P_NUM_E_REPORT VARCHAR(50),
P_DEL_DATE_PAYMENT DATETIME,
P_DEL_TYPE_PAYMENT VARCHAR(10),
P_CONF_DATE_PAYMENT DATETIME,
P_DOWN_PAYMENT DATETIME,
P_MEMO TEXT
)
BEGIN
            
DECLARE TMP_CSTID INT(11);
DECLARE TMP_CODE_ VARCHAR(5);
DECLARE TMP_BIZ_ID INT(11);
            
IF IFNULL(P_CSTID,0) = 0 THEN
            
/*INSERT PROCESS */
            
    INSERT INTO TB100020(CSTNAME,RESIDENT_ID,OPENING_DAY,
    BIZ_REG_DATE,  HomeTaxID, HomeTaxPW, COMP_PHONE,
    MOBILE, EMAIL, E_NOTICE_DATE, DOUZONE_SVR, DOUZONE_CODE,AGREEMENT,AG_REGDATE, REGDATE
    ,SECTOR, BIZ_CATE, COMP_ADDRESS)
    VALUES(P_CSTNAME, P_RESIDENT_ID, P_OPENING_DAY,
    P_BIZ_REG_DATE,  P_HOMETAXID, P_HOMETAXPW,P_COMP_PHONE,
    REPLACE(REPLACE(P_MOBILE,'-',''),' ','') , P_EMAIL, P_E_NOTICE_DATE,  P_DOUZONE_SVR, P_DOUZONE_CODE, 'Y',NOW(),NOW(),
    P_SECTOR, P_BIZ_CATE, P_COMP_ADDRESS);
            
    SELECT last_insert_id() INTO TMP_CSTID;
            
            
    INSERT INTO TB100022(CSTID,COMP_NAME, BIZ_ID_NUM, COMP_ADDRESS, CST_TYPE, CST_TYPE_YEAR, CST_TYPE_SEQ,
    INF_PATH, INF_CHANNEL, UTM_S,UTM_T,UTM_C,UTM, REGDATE, EST_FEE, DEP_FEE,
    DEP_TYPE,DEP_DATE, CASH_REC, CASH_REC_DATE, SUBM_DATE, SUBM_DATE2,
    COMP_REG_DATE, DEC_REGUSER,REQ_E_REPORT,REQ_USER, REQ_DATE, COMP_DATE, NUM_E_REPORT,
    DEL_DATE_PAYMENT,DEL_TYPE_PAYMENT, CONF_DATE_PAYMENT, DOWN_PAYMENT, MEMO, REG_BRANCH)
    SELECT TMP_CSTID, P_COMP_NAME, P_BIZ_ID_NUM, P_COMP_ADDRESS,
    P_CST_TYPE, DATE_FORMAT(now(), '%Y'),'1', P_INF_PATH, P_INF_CHANNEL, P_UTM_S, P_UTM_T, P_UTM_C, P_UTM, NOW(),
    P_EST_FEE, P_DEP_FEE,P_DEP_TYPE,P_DEP_DATE, P_CASH_REC, P_CASH_REC_DATE,
    P_SUBM_DATE, P_SUBM_DATE2,    P_COMP_REG_DATE, P_DEC_REGUSER,
    P_REQ_E_REPORT, P_REQ_USER,
    P_REQ_DATE, P_COMP_DATE, P_NUM_E_REPORT,    P_DEL_DATE_PAYMENT,
    P_DEL_TYPE_PAYMENT, P_CONF_DATE_PAYMENT, P_DOWN_PAYMENT, P_MEMO , P_REG_BRANCH;
            
    SELECT last_insert_id() INTO TMP_BIZ_ID;
            
ELSE
            
/*UPDATE PROCESS */
            
    UPDATE TB100020 SET CSTNAME = P_CSTNAME, RESIDENT_ID = P_RESIDENT_ID,
    OPENING_DAY = P_OPENING_DAY, BIZ_REG_DATE = P_BIZ_REG_DATE,
    HomeTaxID =  P_HOMETAXID, HomeTaxPW = P_HOMETAXPW, COMP_PHONE = P_COMP_PHONE,
    MOBILE = REPLACE(P_MOBILE,'-',''), EMAIL = P_EMAIL, E_NOTICE_DATE = P_E_NOTICE_DATE,
    DOUZONE_SVR = P_DOUZONE_SVR, DOUZONE_CODE = P_DOUZONE_CODE, EDTDATE = NOW(),
    SECTOR=P_SECTOR, BIZ_CATE = P_BIZ_CATE, COMP_ADDRESS=P_COMP_ADDRESS
    WHERE CSTID = P_CSTID;
            
    UPDATE TB100022 SET COMP_NAME = P_COMP_NAME, BIZ_ID_NUM = P_BIZ_ID_NUM,
    COMP_ADDRESS = P_COMP_ADDRESS, CST_TYPE=P_CST_TYPE, INF_PATH = P_INF_PATH,
    INF_CHANNEL = P_INF_CHANNEL, UTM_S = P_UTM_S, UTM_C=P_UTM_C,UTM_T=P_UTM_T,UTM=P_UTM,
    EDTDATE = NOW(), EST_FEE = P_EST_FEE, DEP_FEE= P_DEP_FEE, DEP_TYPE = P_DEP_TYPE,
    DEP_DATE = P_DEP_DATE, CASH_REC = P_CASH_REC, CASH_REC_DATE = P_CASH_REC_DATE,
    SUBM_DATE = P_SUBM_DATE, SUBM_DATE2 = P_SUBM_DATE2,    COMP_REG_DATE = P_COMP_REG_DATE,
    DEC_REGUSER = P_DEC_REGUSER, REQ_E_REPORT = P_REQ_E_REPORT, REQ_USER=P_REQ_USER,
    REQ_DATE = P_REQ_DATE, COMP_DATE = P_COMP_DATE,
    NUM_E_REPORT = P_NUM_E_REPORT, DEL_DATE_PAYMENT= P_DEL_DATE_PAYMENT,
    DEL_TYPE_PAYMENT = P_DEL_TYPE_PAYMENT, CONF_DATE_PAYMENT = P_CONF_DATE_PAYMENT,
    DOWN_PAYMENT = P_DOWN_PAYMENT, MEMO = P_MEMO, REG_BRANCH=P_REG_BRANCH,
    EDTDATE=NOW()
    WHERE CSTID = P_CSTID
    AND CST_TYPE_YEAR = DATE_FORMAT(now(), '%Y') AND CST_TYPE_SEQ = '1';
            
	SELECT BIZ_ID INTO TMP_BIZ_ID FROM TB100022 WHERE CSTID = P_CSTID AND CST_TYPE_YEAR = DATE_FORMAT(now(), '%Y') AND CST_TYPE_SEQ = '1';
    SET TMP_CSTID = P_CSTID;
END IF;
            
CALL INSERT_TB100024(TMP_BIZ_ID,P_OPTION1,P_OPTION2,P_OPTION3,P_OPTION4,P_OPTION5,P_OPTION6,NULL,NULL,NULL,NULL,NULL,P_EST_FEE);
            
SELECT TMP_CSTID;
            
END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_VAT_CST_ALL"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_VAT_CST_ALL('".$cstid."', '".$bizid."' ,'".$comp_name."','".$biz_id_num."',
'".$cstname."','".$resident_id."','".$opening_day."', '".$biz_reg_date."',
'".$sector."','".$biz_cate."','".$comp_address."','".$hometaxid."','".$hometaxpw."',
'".$comp_phone."','".$mobile."','".$email."',
'".$e_notice_date."','".$douzone_svr."','".$douzone_code."',
'".$reg_branch."','".$regdate."','".$reguser."','".$cst_type."','".$inf_path."','".$inf_channel."',
'".$utm_s."','".$utm_t."','".$utm_c."','".$utm."', '".$option1."', '".$option2."' , '".$option3."' ,
'".$option4."' , '".$option5."' , '".$option6."', '".$est_fee."' , '".$dep_fee."'  , '".$dep_type."'  ,
'".$dep_date."'  , '".$cash_rec."'  , '".$cash_rec_date."'  , '".$subm_date."'  , '".$subm_date2."'  ,
'".$comp_reg_date."'  , '".$dec_reguser."'  , '".$req_e_report."'  , '".$req_user."'  , '".$req_date."'  ,
'".$comp_date."'  , '".$num_e_report."'  , '".$del_date_payment."'  , '".$del_type_payment."'  ,
'".$conf_date_payment."'  , '".$down_payment."'  , '".$memo."' )";
                //프로시저 호출
                $result = mysqli_query($connect,$query);
                while($row = mysqli_fetch_array($result)){
                    $output['CSTID'] = $row["TMP_CSTID"];
                }
                
                echo json_encode($output);
            }
        }
        
    }
    //부가세 고객 상세등록 : 끝
    
    
    //부가세 고객 간편등록 : 시작
    if($_POST["action"] == "action_vat_simple_ins"){
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $resident_id=mysqli_real_escape_string($connect,$_POST["resident_id"]);
        $biz_id_num=mysqli_real_escape_string($connect,$_POST["biz_id_num"]);
        $hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
        $hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
        $cash_rec=mysqli_real_escape_string($connect,$_POST["cash_rec"]);
        $est_fee=mysqli_real_escape_string($connect,$_POST["est_fee"]);
		$inf_path=mysqli_real_escape_string($connect,$_POST["inf_path"]);
        
        $procedure = "
			CREATE PROCEDURE INSERT_VAT_CST_SIMPLE(IN P_CSTNAME VARCHAR(45), P_MOBILE VARCHAR(45), P_RESIDENT_ID VARCHAR(15), P_BIZ_ID_NUM VARCHAR(10), P_HOMETAXID  VARCHAR(45), P_HOMETAXPW VARCHAR(45), P_CASH_REC VARCHAR(1), P_EST_FEE INT(11), P_INF_PATH VARCHAR(50) )
			BEGIN
            
				DECLARE TMP_CSTID INT(11);
				DECLARE TMP_BIZID INT(11);
				DECLARE CNT_CSTID INT(11);
				DECLARE FLAG_CSTID INT(11);
            
				SELECT COUNT(1) INTO CNT_CSTID FROM TB100020
				WHERE CSTNAME = P_CSTNAME AND REPLACE(MOBILE,'-','')=REPLACE(P_MOBILE,'-','');
            
				IF CNT_CSTID = 0 THEN
					INSERT INTO TB100020(CSTNAME,MOBILE,RESIDENT_ID, HomeTaxID, HomeTaxPW, AGREEMENT,AG_REGDATE) 
                    VALUES(P_CSTNAME,REPLACE(REPLACE(P_MOBILE,'-',''),' ',''),P_RESIDENT_ID, P_HOMETAXID, P_HOMETAXPW,'Y',NOW());
            
					SELECT last_insert_id() INTO TMP_CSTID;
            
					CALL INSERT_TB100022_EX(TMP_CSTID,'부가세',DATE_FORMAT(now(), '%Y'),'1',P_EST_FEE, NULL, '9', P_CASH_REC, P_BIZ_ID_NUM, P_INF_PATH);
					SELECT last_insert_id() INTO TMP_BIZID;
					SET FLAG_CSTID = 1;
				ELSE
					SELECT CSTID INTO TMP_CSTID FROM TB100020
					WHERE CSTNAME = P_CSTNAME AND REPLACE(MOBILE,'-','')=REPLACE(P_MOBILE,'-','')
					ORDER BY CSTID DESC LIMIT 1;
					SET FLAG_CSTID = 2;
				END IF;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_VAT_CST_SIMPLE"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_VAT_CST_SIMPLE('".$cstname."','".$mobile."','".$resident_id."','".$biz_id_num."','".$hometaxid."','".$hometaxpw."','".$cash_rec."','".$est_fee."','".$inf_path."')";
                //프로시저 호출
                $result = mysqli_query($connect,$query);
                
                
                
                
                echo "등록완료.";
            }
        }
        
    }
    //부가세 고객 간편등록 : 끝
    
    
    
    //수수료계산기 업데이트 : 시작
    if($_POST["action"] == "action_write_cal_insert"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $CSTNAME=mysqli_real_escape_string($connect,$_POST["CSTNAME"]);
        $MOBILE=mysqli_real_escape_string($connect,$_POST["MOBILE"]);
        $HOMETAXID=mysqli_real_escape_string($connect,$_POST["HOMETAXID"]);
        $HOMETAXPW=mysqli_real_escape_string($connect,$_POST["HOMETAXPW"]);
        $INFO_TYPE=mysqli_real_escape_string($connect,$_POST["INFO_TYPE"]);
        $REG_BRANCH=mysqli_real_escape_string($connect,$_POST["REG_BRANCH"]);
        $REGUSER=mysqli_real_escape_string($connect,$_POST["REGUSER"]);
        $INTEREST=mysqli_real_escape_string($connect,$_POST["INTEREST"]);
        $ALLOCATION=mysqli_real_escape_string($connect,$_POST["ALLOCATION"]);
        $WORK_SINGLE=mysqli_real_escape_string($connect,$_POST["WORK_SINGLE"]);
        $WORK_PLUR=mysqli_real_escape_string($connect,$_POST["WORK_PLUR"]);
        $INFORMAL=mysqli_real_escape_string($connect,$_POST["INFORMAL"]);
        $ETC=mysqli_real_escape_string($connect,$_POST["ETC"]);
        $EXP_PAY_TAX=mysqli_real_escape_string($connect,$_POST["EXP_PAY_TAX"]);
        $EST_FEE=mysqli_real_escape_string($connect,$_POST["EST_FEE"]);
        $EST_FEE=str_replace(",","",$EST_FEE);
        $PROGRESS=mysqli_real_escape_string($connect,$_POST["PROGRESS"]);
        $MEMO=mysqli_real_escape_string($connect,$_POST["MEMO"]);
        
        $output = array();
        
        $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `INSERT_WRITE_CAL`(IN P_ID INT, P_CSTNAME VARCHAR(50), P_MOBILE VARCHAR(50),
P_HOMETAXID  VARCHAR(45), P_HOMETAXPW VARCHAR(45) , P_INFO_TYPE VARCHAR(100), P_REG_BRANCH VARCHAR(10),
P_REGUSER VARCHAR(5), P_INTEREST CHAR(1), P_ALLOCATION CHAR(1), P_WORK_SINGLE CHAR(1), 
P_WORK_PLUR CHAR(1), P_INFORMAL CHAR(1), P_ETC CHAR(1), P_EXP_PAY_TAX DOUBLE, P_EST_FEE DOUBLE, 
P_PROGRESS VARCHAR(5), P_MEMO TEXT )
BEGIN

DECLARE TMP_BIZID INT;
DECLARE TMP_CSTID INT;
DECLARE TMP_CNT1 INT;
DECLARE TMP_CNT2 INT;
DECLARE CNT INT;

IF IFNULL(P_ID,0) <> 0 THEN
    UPDATE TB100020 SET CSTNAME=P_CSTNAME,MOBILE=REPLACE(P_MOBILE,'-',''),  HomeTaxID=P_HOMETAXID,
    HomeTaxPW = P_HOMETAXPW , EDTDATE = NOW()
    WHERE CSTID = P_ID;
    
    SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 WHERE CSTID = P_ID AND CST_TYPE='A1001';
	IF IFNULL(TMP_BIZID,0) > 0 THEN
		UPDATE TB100022 SET REG_BRANCH=P_REG_BRANCH,REGUSER=P_REGUSER,
		EXP_PAY_TAX_SELF=P_EXP_PAY_TAX,EST_FEE_SELF=P_EST_FEE, MEMO=P_MEMO, EDTDATE = NOW()
		WHERE BIZ_ID = TMP_BIZID;
        
        UPDATE TB100026 SET PROGRESS=P_PROGRESS, EDTDATE=NOW()
		WHERE BIZ_ID = TMP_BIZID;
		
    ELSE 
		INSERT INTO TB100022(CSTID, REG_BRANCH, REGUSER, EXP_PAY_TAX_SELF, EST_FEE_SELF, MEMO, REGDATE, CST_TYPE, CST_TYPE_YEAR, CST_TYPE_SEQ)
		SELECT TMP_CSTID,P_REG_BRANCH, P_REGUSER, P_EXP_PAY_TAX, P_EST_FEE, P_MEMO, NOW(),'A1001',DATE_FORMAT(now(), '%Y'),'1';
		SELECT last_insert_id() INTO TMP_BIZID;
        
        INSERT INTO TB100026(BIZ_ID, PROGRESS, REGDATE)
        SELECT TMP_BIZID, P_PROGRESS, NOW();
        
        INSERT INTO TB100023(BIZ_ID,CSTID)
        SELECT TMP_BIZID,P_ID;
    END IF;
    
    SELECT COUNT(1) INTO TMP_CNT1 FROM TB300010 WHERE CSTID = P_ID;
    IF IFNULL(TMP_CNT1,0) >0 THEN
		UPDATE TB300010 SET CSTNAME=P_CSTNAME, INFO_TYPE=P_INFO_TYPE
		WHERE CSTID = P_ID;
    ELSE
		INSERT INTO TB300010(CSTID,CSTNAME, INFO_TYPE)
		SELECT TMP_CSTID, P_CSTNAME, P_INFO_TYPE;
    END IF;
    
    SELECT COUNT(1) INTO TMP_CNT2 FROM TB300030 WHERE CSTID = P_ID;
    IF IFNULL(TMP_CNT2,0) > 0 THEN
		UPDATE TB300030 SET INTEREST=P_INTEREST, ALLOCATION=P_ALLOCATION,WORK_SINGLE=P_WORK_SINGLE,
		WORK_PLUR=P_WORK_PLUR,INFORMAL=P_INFORMAL,ETC=P_ETC
		WHERE CSTID = P_ID AND CST_TYPE_YEAR = DATE_FORMAT(now(), '%Y');
    ELSE
		INSERT INTO TB300030(INTEREST,ALLOCATION,WORK_SINGLE,WORK_PLUR,INFORMAL,ETC, CST_TYPE_YEAR,CSTID)
		SELECT P_INTEREST,P_ALLOCATION,P_WORK_SINGLE,P_WORK_PLUR,P_INFORMAL,P_ETC,DATE_FORMAT(now(), '%Y'),P_ID;
    END IF;
    
    SET TMP_CSTID = P_ID;

ELSE
	SELECT COUNT(1) INTO CNT FROM TB100020 WHERE CSTNAME = P_CSTNAME AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');
    
    IF IFNULL(CNT,0) > 0 THEN 
		SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 WHERE CSTID = P_ID AND CST_TYPE='A1001' AND CST_TYPE_YEAR=DATE_FORMAT(now(), '%Y');
        SELECT CSTID INTO TMP_CSTID FROM TB100020 WHERE CSTNAME = P_CSTNAME AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');

		UPDATE TB100020 SET CSTNAME=P_CSTNAME,MOBILE=REPLACE(P_MOBILE,'-',''),  HomeTaxID=P_HOMETAXID,
		HomeTaxPW = P_HOMETAXPW , EDTDATE = NOW()
		WHERE CSTID = TMP_CSTID;

		IF IFNULL(TMP_BIZID,0) > 0 THEN
			UPDATE TB100022 SET REG_BRANCH=P_REG_BRANCH,REGUSER=P_REGUSER,
			EXP_PAY_TAX_SELF=P_EXP_PAY_TAX,EST_FEE_SELF=P_EST_FEE, MEMO=P_MEMO, EDTDATE = NOW()
			WHERE BIZ_ID = TMP_BIZID;
			
			UPDATE TB100026 SET PROGRESS=P_PROGRESS, EDTDATE=NOW()
			WHERE BIZ_ID = TMP_BIZID;
			
		ELSE 
			INSERT INTO TB100022(CSTID, REG_BRANCH, REGUSER, EXP_PAY_TAX_SELF, EST_FEE_SELF, MEMO, REGDATE, CST_TYPE, CST_TYPE_YEAR, CST_TYPE_SEQ)
			SELECT TMP_CSTID,P_REG_BRANCH, P_REGUSER, P_EXP_PAY_TAX, P_EST_FEE, P_MEMO, NOW(),'A1001',DATE_FORMAT(now(), '%Y'),'1';
			SELECT last_insert_id() INTO TMP_BIZID;
			
			INSERT INTO TB100026(BIZ_ID, PROGRESS, REGDATE)
            SELECT TMP_BIZID, P_PROGRESS, NOW();
            
            INSERT INTO TB100023(BIZ_ID,CSTID)
            SELECT TMP_BIZID,TMP_CSTID;
		END IF;

		SELECT COUNT(1) INTO TMP_CNT1 FROM TB300010 WHERE CSTID = P_ID;
		IF IFNULL(TMP_CNT1,0) > 0 THEN
			UPDATE TB300010 SET CSTNAME=P_CSTNAME, INFO_TYPE=P_INFO_TYPE
			WHERE CSTID = P_ID;
		ELSE
			INSERT INTO TB300010(CSTID,CSTNAME, INFO_TYPE)
			SELECT P_ID, P_CSTNAME, P_INFO_TYPE;
		END IF;
		
		SELECT COUNT(1) INTO TMP_CNT2 FROM TB300030 WHERE CSTID = P_ID;
		IF IFNULL(TMP_CNT2,0) > 0 THEN
			UPDATE TB300030 SET INTEREST=P_INTEREST, ALLOCATION=P_ALLOCATION,WORK_SINGLE=P_WORK_SINGLE,
			WORK_PLUR=P_WORK_PLUR,INFORMAL=P_INFORMAL,ETC=P_ETC
			WHERE CSTID = P_ID AND CST_TYPE_YEAR = DATE_FORMAT(now(), '%Y');
		ELSE
			INSERT INTO TB300030(INTEREST,ALLOCATION,WORK_SINGLE,WORK_PLUR,INFORMAL,ETC, CST_TYPE_YEAR,CSTID)
			SELECT P_INTEREST,P_ALLOCATION,P_WORK_SINGLE,P_WORK_PLUR,P_INFORMAL,P_ETC,DATE_FORMAT(now(), '%Y'),P_ID;
		END IF;

    ELSE
		
        INSERT INTO TB100020(CSTNAME, MOBILE, HomeTaxID, HomeTaxPW,REGDATE)
		SELECT P_CSTNAME, REPLACE(REPLACE(P_MOBILE,'-',''),' ',''), P_HOMETAXID, P_HOMETAXPW,NOW();
		SELECT last_insert_id() INTO TMP_CSTID;

		INSERT INTO TB100022(CSTID, REG_BRANCH, REGUSER, EXP_PAY_TAX_SELF, EST_FEE_SELF, MEMO, REGDATE, CST_TYPE, CST_TYPE_YEAR, CST_TYPE_SEQ)
		SELECT TMP_CSTID,P_REG_BRANCH, P_REGUSER, P_EXP_PAY_TAX, P_EST_FEE, P_MEMO, NOW(),'A1001',DATE_FORMAT(now(), '%Y'),'1';
        SELECT last_insert_id() INTO TMP_BIZID;
        
        INSERT INTO TB100023(BIZ_ID,CSTID)
        SELECT TMP_BIZID,TMP_CSTID;

		INSERT INTO TB100026(BIZ_ID, PROGRESS, REGDATE)
		SELECT TMP_BIZID, P_PROGRESS, NOW();
		
		INSERT INTO TB300010(CSTID,CSTNAME, INFO_TYPE)
		SELECT TMP_CSTID, P_CSTNAME, P_INFO_TYPE;

		INSERT INTO TB300030(INTEREST,ALLOCATION,WORK_SINGLE,WORK_PLUR,INFORMAL,ETC, CST_TYPE_YEAR,CSTID)
		SELECT P_INTEREST,P_ALLOCATION,P_WORK_SINGLE,P_WORK_PLUR,P_INFORMAL,P_ETC,DATE_FORMAT(now(), '%Y'),TMP_CSTID;

    END IF;
END IF;
    
    SELECT TMP_CSTID;
END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_WRITE_CAL"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_WRITE_CAL('".$id."','".$CSTNAME."' , '".$MOBILE."','".$HOMETAXID."','".$HOMETAXPW."',
'".$INFO_TYPE."','".$REG_BRANCH."','".$REGUSER."','".$INTEREST."','".$ALLOCATION."','".$WORK_SINGLE."'
,'".$WORK_PLUR."','".$INFORMAL."','".$ETC."','".$EXP_PAY_TAX."','".$EST_FEE."','".$PROGRESS."','".$MEMO."')";
                //프로시저 호출
                $result = mysqli_query($connect,$query);
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                
                while($row = mysqli_fetch_array($result)){
                    $output['CSTID'] = $row["TMP_CSTID"];
                }
                
                echo json_encode($output);
            }
        }
        
    }
    //수수료계산기 업데이트 : 끝
    
    /*
     *  P_MOBILE VARCHAR(50),
P_HOMETAXID  VARCHAR(45), P_HOMETAXPW VARCHAR(45) , P_INFO_TYPE VARCHAR(100), P_REG_BRANCH VARCHAR(10),
P_REGUSER VARCHAR(5), P_INTEREST CHAR(1), P_ALLOCATION CHAR(1), P_WORK_SINGLE CHAR(1), 
P_WORK_PLUR CHAR(1), P_INFORMAL CHAR(1), P_ETC CHAR(1), P_EXP_PAY_TAX DOUBLE, P_EST_FEE DOUBLE, 
P_PROGRESS VARCHAR(5), P_MEMO
     * */
    
    
    //세액계산기 - 공제액 수정/저장 : 시작
    if($_POST["action"] == "action_tb300031_insert"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $EXI_TAX=mysqli_real_escape_string($connect,$_POST["EXI_TAX"]);
        $NPIP=mysqli_real_escape_string($connect,$_POST["NPIP"]);
        $PERSON_SAVE=mysqli_real_escape_string($connect,$_POST["PERSON_SAVE"]);
        $SMALL_BIZ_DED=mysqli_real_escape_string($connect,$_POST["SMALL_BIZ_DED"]);
        $RET_SAVE=mysqli_real_escape_string($connect,$_POST["RET_SAVE"]);
        $PEN_SAVE=mysqli_real_escape_string($connect,$_POST["PEN_SAVE"]);
        
        
        $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `INSERT_UPDATE_TB300031`(IN P_CSTID INT, P_EXI_TAX DOUBLE, P_NPIP DOUBLE , P_PERSON_SAVE DOUBLE , 
            P_SMALL_BIZ_DED DOUBLE , P_RET_SAVE DOUBLE , P_PEN_SAVE DOUBLE )
BEGIN

                DECLARE CNT INT;

                SELECT COUNT(1) INTO CNT FROM TB300031 WHERE CSTID = P_CSTID AND CST_TYPE_YEAR = date_format(NOW(),'%Y')-1;
            
                IF CNT>0 THEN 
                    UPDATE TB300031 SET EXI_TAX=P_EXI_TAX, NPIP=P_NPIP, PERSON_SAVE=P_PERSON_SAVE,
                    SMALL_BIZ_DED=P_SMALL_BIZ_DED, RET_SAVE=P_RET_SAVE, PEN_SAVE=P_PEN_SAVE,
                    EDTDATE = NOW(), FIX_IT = 'Y'
                    WHERE CSTID = P_CSTID AND CST_TYPE_YEAR = date_format(NOW(),'%Y')-1;
                ELSE
                    INSERT INTO TB300031(CSTID,EXI_TAX,NPIP,PERSON_SAVE,SMALL_BIZ_DED,RET_SAVE,PEN_SAVE,
                    EDTDATE,FIX_IT, CST_TYPE_YEAR)
                    SELECT P_CSTID, P_EXI_TAX,P_NPIP,P_PERSON_SAVE,P_SMALL_BIZ_DED,P_RET_SAVE,P_PEN_SAVE,
                    NOW(),'Y',date_format(NOW(),'%Y')-1;
                END IF;
				
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_UPDATE_TB300031"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_UPDATE_TB300031('".$id."','".$EXI_TAX."' ,'".$NPIP."' ,'".$PERSON_SAVE."' ,
'".$SMALL_BIZ_DED."' ,'".$RET_SAVE."' ,'".$PEN_SAVE."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                //echo ''.$reserv_date.' 날짜로 등록되었습니다.';
            }
        }
        
    }
    //세액계산기 - 공제액 수정/저장 : 끝
    
    
    
    //세액계산기 - 단순경비율 추가 저장 : 시작
    if($_POST["action"] == "action_tb300020_insert"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $EXT_PAID=mysqli_real_escape_string($connect,$_POST["EXT_PAID"]);
        $EXT_RATIO=mysqli_real_escape_string($connect,$_POST["EXT_RATIO"]);
        $EXT_HUMAN=mysqli_real_escape_string($connect,$_POST["EXT_HUMAN"]);
        
        $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `INSERT_TB300020`(IN P_CSTID INT, 
P_EXT_PAID DOUBLE, 
P_EXT_RATIO DOUBLE ,
P_EXT_HUMAN VARCHAR(1)
)
BEGIN            
	DECLARE MAX_CNT INT;
	DECLARE TMP_BIZID INT;

	SELECT IFNULL( MAX( TB_IDX),0) +1 INTO MAX_CNT FROM TB300020 WHERE CSTID = P_CSTID AND CST_TYPE_YEAR = date_format(NOW(),'%Y')-1;
	SELECT BIZ_ID INTO TMP_BIZID FROM TB300020 WHERE CSTID = P_CSTID AND CST_TYPE_YEAR = date_format(NOW(),'%Y')-1 GROUP BY BIZ_ID;

	INSERT INTO TB300020(CSTID,BIZ_ID,CST_TYPE_YEAR, TB_IDX,AMOUNT_PAID,SIM_RATIO_N ,EXT_YN , EXT_HUMAN)
	SELECT P_CSTID,TMP_BIZID, date_format(NOW(),'%Y')-1 ,MAX_CNT,P_EXT_PAID, P_EXT_RATIO,'Y', P_EXT_HUMAN;
END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB300020"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_TB300020('".$id."','".$EXT_PAID."' ,'".$EXT_RATIO."', '".$EXT_HUMAN."' )";
                //프로시저 호출
                mysqli_query($connect,$query);
                //echo ''.$reserv_date.' 날짜로 등록되었습니다.';
            }
        }
        
    }
    //세액계산기 - 단순경비율 추가 저장 : 끝
    
    
    
    //세액계산기 - 단순경비율 추가 삭제 : 시작
    if($_POST["action"] == "action_tb300020_delete"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $IDX=mysqli_real_escape_string($connect,$_POST["idx"]);
        
        $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `DELETE_TB300020`(IN P_CSTID INT,P_IDX INT )
BEGIN
            
	DELETE FROM TB300020 WHERE CSTID = P_CSTID AND CST_TYPE_YEAR = date_format(NOW(),'%Y')-1 
    AND TB_IDX = P_IDX;

END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS DELETE_TB300020"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL DELETE_TB300020('".$id."','".$IDX."'  )";
                //프로시저 호출
                mysqli_query($connect,$query);
                //echo ''.$reserv_date.' 날짜로 등록되었습니다.';
            }
        }
        
    }
    //세액계산기 - 단순경비율 추가 삭제 : 끝
    
    
    
    
    
    if($_POST["action"] == "upt_memo_trans"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $p_memo=mysqli_real_escape_string($connect,$_POST["memo"]);
        
        $procedure = "
			CREATE PROCEDURE UPT_MEMO_TRANS(IN p_id INT, p_memo LONGTEXT)
			BEGIN
				UPDATE TB600010 SET ETC = p_memo WHERE ID = p_id;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_MEMO_TRANS"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_MEMO_TRANS('".$p_id."','".$p_memo."')";
                mysqli_query($connect,$query_upt);
                //echo "수정되었습니다.";
            }
        }
    }


	
    if($_POST["action"] == "upt_memo_inc"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $p_memo=mysqli_real_escape_string($connect,$_POST["memo"]);
        
        $procedure = "
			CREATE PROCEDURE UPT_MEMO_INC(IN p_id INT, p_memo LONGTEXT)
			BEGIN
				UPDATE TB100022 SET MEMO = p_memo WHERE CSTID = p_id;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_MEMO_INC"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_MEMO_INC('".$p_id."','".$p_memo."')";
                mysqli_query($connect,$query_upt);
                //echo "수정되었습니다.";
            }
        }
    }
    
    
    if($_POST["action"] == "upt_subm"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        
        $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `UPT_SUBM_DATE`(
IN P_ID INT
)
BEGIN
DECLARE CNT INT;
SELECT COUNT(1) INTO CNT FROM TB100022
WHERE CSTID = P_ID;

IF CNT > 0 THEN
	UPDATE TB100022 SET SUBM_DATE =NOW(), SUBM='A' 
    WHERE CSTID = P_ID;
END IF;

END
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_SUBM_DATE"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_SUBM_DATE('".$p_id."' )";
                mysqli_query($connect,$query_upt);
                //echo "업데이트 되었습니다.";
            }
        }
    }
    
    
    
    if($_POST["action"] == "upt_confirm"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $p_userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `UPT_CONFIRM`(
IN P_ID INT,
P_USERID VARCHAR(4)
)
BEGIN
DECLARE CNT INT;
SELECT COUNT(1) INTO CNT FROM TB100022
WHERE CSTID = P_ID
AND IFNULL( CONFIRM_YN ,'') <> 'Y'
;
            
IF CNT > 0 THEN
	UPDATE TB100022 SET CONFIRM_YN='Y', CONFIRM_DATE=NOW() , CONFIRM_REGUSER=P_USERID
    WHERE CSTID = P_ID;
END IF;
            
END
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_CONFIRM"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_CONFIRM('".$p_id."','".$p_userid."' )";
                mysqli_query($connect,$query_upt);
                //echo "업데이트 되었습니다.";
            }
        }
    }
    
    


    if($_POST["action"] == "upt_dzcode_inc"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $p_dzcode=mysqli_real_escape_string($connect,$_POST["dzcode"]);
        
        $procedure = "
			CREATE PROCEDURE UPT_DZCODE_INC(IN P_ID INT, P_DZCODE VARCHAR(5))
			BEGIN
				UPDATE TB100030 SET DOUZONE_CODE = P_DZCODE WHERE CSTID = P_ID;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_DZCODE_INC"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_DZCODE_INC('".$p_id."','".$p_dzcode."')";
                mysqli_query($connect,$query_upt);
                //echo "수정되었습니다.";
            }
        }
    }
    
    
    
    //양도 담당세무사 옵션값 수정 : 시작
    if($_POST["action"] == "update_owner_user"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $owner=mysqli_real_escape_string($connect,$_POST["owner"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_TRANS_OWNER(IN P_ID INT(11),P_OWNER VARCHAR(5) )
			BEGIN
            
				UPDATE TB600010 SET OWNER_USER = P_OWNER
				WHERE ID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TRANS_OWNER"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_TRANS_OWNER('".$id."','".$owner."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                //echo 'upt_trans_opt complate..';
                
            }
        }
        
    }
    //양도 담당세무사 옵션값 수정 : 끝
    
    
    //종합소득세 신고서담당자 옵션값 수정 : 시작
    if($_POST["action"] == "update_decuser"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $owner=mysqli_real_escape_string($connect,$_POST["owner"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_INC_DECUSER(IN P_ID INT(11),P_OWNER VARCHAR(5) )
			BEGIN
            
				UPDATE TB100022 SET DEC_REGUSER = P_OWNER
				WHERE CSTID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_INC_DECUSER"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_INC_DECUSER('".$id."','".$owner."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                //echo 'upt_trans_opt complate..';
                
            }
        }
        
    }
    //종합소득세 신고서담당자 옵션값 수정 : 끝



    //양도 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_trans_opt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $prog=mysqli_real_escape_string($connect,$_POST["prog"]);
        $prio=mysqli_real_escape_string($connect,$_POST["prio"]);
        $pay=mysqli_real_escape_string($connect,$_POST["pay"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_TRANS_LIST(IN P_ID INT(11),P_PRIO VARCHAR(5) , P_PROG VARCHAR(5), P_PAY VARCHAR(5) )
			BEGIN
            
				UPDATE TB600010 SET PRIO_NUM = P_PRIO, PROGRESS= P_PROG, PAY_FLAG = P_PAY
				WHERE ID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TRANS_LIST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_TRANS_LIST('".$id."','".$prio."','".$prog."','".$pay."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query;
                
            }
        }
        
    }
    //양도 리스트 옵션값 수정 : 끝
    
    
    
    
    //종합소득세 접수현황 RPA스텝값 업데이트 분기처리 : 시작
    if($_POST["action"] == "upt_RPA_step_code"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $step_name=mysqli_real_escape_string($connect,$_POST["step_name"]);
        
        $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `UPDATE_ACC_RPA_STEP`(IN P_ID INT(11),
P_STEP VARCHAR(50)
)
BEGIN
                
            DECLARE CNT1 INT;
            DECLARE TMP_BIZID INT;
            
            SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 WHERE CSTID=P_ID AND CST_TYPE='A1001' AND CST_TYPE_YEAR=DATE_FORMAT(now(), '%Y');
            SELECT COUNT(1) INTO CNT1 FROM TB100023 WHERE CSTID=P_ID AND BIZ_ID = TMP_BIZID;
            #SELECT TMP_BIZID,CNT1;
                                
            IF CNT1 > 0 THEN
            
				IF P_STEP = 'CashReport' THEN
					UPDATE TB100023 SET CashReport = 'R' WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'HomeTaxConsignment' THEN
					UPDATE TB100023 SET HomeTaxConsignment = 'R' WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'CompanyReg' THEN
					UPDATE TB100023 SET CompRegCheck = 'R' WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'SmartA' THEN
					UPDATE TB100023 SET SmartAToConvert = 'R' WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'HT_Upload' THEN
					UPDATE TB100023 SET HomeTaxUpload = 'R' WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'HT_Print' THEN
					UPDATE TB100023 SET HomeTaxPrint = 'R' WHERE BIZ_ID = TMP_BIZID;
				END IF;
				
            ELSE
				IF P_STEP = 'CashReport' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,CashReport)
					SELECT TMP_BIZID,P_ID,'R';
				elseif P_STEP = 'HomeTaxConsignment' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,HomeTaxConsignment)
					SELECT TMP_BIZID,P_ID,'R';
				elseif P_STEP = 'CompanyReg' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,CompRegCheck)
					SELECT TMP_BIZID,P_ID,'R';
				elseif P_STEP = 'SmartA' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,SmartAToConvert)
					SELECT TMP_BIZID,P_ID,'R';
				elseif P_STEP = 'HT_Upload' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,HomeTaxUpload)
					SELECT TMP_BIZID,P_ID,'R';
				elseif P_STEP = 'HT_Print' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,HomeTaxPrint)
					SELECT TMP_BIZID,P_ID,'R';
				END IF;
                
            END IF;

            #UPDATE TB100022 SET RP_SEND_KAKAO='Y' WHERE BIZ_ID = TMP_BIZID;
            
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_ACC_RPA_STEP"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_ACC_RPA_STEP('".$id."','".$step_name."' )";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query;
                
            }
        }
        
    }
    //종합소득세 접수현황 RPA스텝값 업데이트 분기처리 : 끝
    
    
    
    //종합소득세 접수현황 ACTION_RP_KAKAO_SEND : 시작
    if($_POST["action"] == "ACTION_RP_KAKAO_SEND"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        
        $procedure = "
			CREATE DEFINER=`sschina`@`%` PROCEDURE `UPDATE_RP_KAKAO_SEND`(IN P_ID INT(11))
BEGIN
            
    UPDATE TB100022 SET RP_SEND_KAKAO='Y' WHERE BIZ_ID = P_ID 
    AND CST_TYPE='A1001' AND CST_TYPE_YEAR = DATE_FORMAT(now(), '%Y') ;

END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_RP_KAKAO_SEND"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_RP_KAKAO_SEND('".$id."' )";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query;
                
            }
        }
        
    }
    //종합소득세 접수현황 RPA스텝값 업데이트 분기처리 : 끝
    
    
    
    //종합소득세 접수현황 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_acc_inc_opt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $proc=mysqli_real_escape_string($connect,$_POST["proc"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        $confirm=mysqli_real_escape_string($connect,$_POST["confirm"]);
        $edtuser=mysqli_real_escape_string($connect,$_POST["edtuser"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_ACC_INC_LIST(IN P_ID INT(11),P_PROC VARCHAR(5), 
P_REGUSER VARCHAR(4) , P_BRANCH VARCHAR(5),P_CONFIRM VARCHAR(5),P_EDTUSER VARCHAR(4)
)
			BEGIN
                DECLARE TMP_BIZ_ID INT;
                DECLARE CNT INT;
            
            
                SELECT COUNT(1) INTO CNT FROM TB100026
                WHERE BIZ_ID = P_ID;
            
                IF CNT>0 THEN
    				UPDATE TB100026 SET PROGRESS = P_PROC, EDTDATE=NOW()
	       			WHERE BIZ_ID = P_ID;
                ELSE
                    INSERT INTO TB100026(BIZ_ID,PROGRESS,REGDATE)
                    SELECT P_ID, P_PROC,NOW();
                END IF;
            
                UPDATE TB100022 SET DEC_REGUSER = P_REGUSER, REG_BRANCH=P_BRANCH, CONFIRM=P_CONFIRM, CONFIRM_REGUSER=P_REGUSER,CONFIRM_DATE = NOW(),
                EDTUSER = P_EDTUSER, EDTDATE = NOW()
                WHERE BIZ_ID = P_ID
                AND CST_TYPE = 'A1001'
                AND CST_TYPE_SEQ=1;
            
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_ACC_INC_LIST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_ACC_INC_LIST('".$id."','".$proc."' , '".$reguser."','".$branch."', '".$confirm."','".$edtuser."' )";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query;
                
            }
        }
        
    }
    //종합소득세 리스트 옵션값 수정 : 끝
    
    
    
    
    //종합소득세 간편안내 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_simple_inc_opt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $proc=mysqli_real_escape_string($connect,$_POST["proc"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $acc_ck=mysqli_real_escape_string($connect,$_POST["acc_ck"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        $edtuser=mysqli_real_escape_string($connect,$_POST["edtuser"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_SIMPLE_INC_LIST(IN P_ID INT(11),P_PROC VARCHAR(5), P_REGUSER VARCHAR(4) , P_ACC_CK VARCHAR(10)
, P_BRANCH VARCHAR(5),P_EDTUSER VARCHAR(4)
)
			BEGIN
                DECLARE TMP_BIZ_ID INT;
                DECLARE CNT INT;
                
                
                SELECT COUNT(1) INTO CNT FROM TB100026
                WHERE BIZ_ID = P_ID;
                            
                IF CNT>0 THEN
    				UPDATE TB100026 SET PROGRESS = P_PROC, EDTDATE=NOW()
	       			WHERE BIZ_ID = P_ID;
                ELSE
                    INSERT INTO TB100026(BIZ_ID,PROGRESS,REGDATE)
                    SELECT P_ID, P_PROC,NOW();
                END IF;

                UPDATE TB100022 SET DEC_REGUSER = P_REGUSER, ACC_CHECK = P_ACC_CK, REG_BRANCH=P_BRANCH,EDTDATE=NOW() , EDTUSER=P_EDTUSER
                WHERE BIZ_ID = P_ID 
                AND CST_TYPE = 'A1001' 
                AND CST_TYPE_SEQ=1;
                
            
				
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_SIMPLE_INC_LIST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_SIMPLE_INC_LIST('".$id."','".$proc."' , '".$reguser."','".$acc_ck."', '".$branch."','".$edtuser."' )";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query;
                
            }
        }
        
    }
    //종합소득세 리스트 옵션값 수정 : 끝
    
    
  
    //종합소득세 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_inc_opt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $bran=mysqli_real_escape_string($connect,$_POST["bran"]);
        $dz_svr=mysqli_real_escape_string($connect,$_POST["dz_svr"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_INC_LIST(IN P_ID INT(11),P_BRAN VARCHAR(5) , P_DZ_SVR VARCHAR(5) )
			BEGIN
            
				UPDATE TB100022 SET REG_BRANCH = P_BRAN
				WHERE CSTID = P_ID;

				UPDATE TB100030 SET DOUZONE_SVR = P_DZ_SVR
				WHERE CSTID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_INC_LIST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_INC_LIST('".$id."','".$bran."','".$dz_svr."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query;
                
            }
        }
        
    }
    //종합소득세 리스트 옵션값 수정 : 끝
	
    
    //4대보험 문의유형 옵션값 수정 : 시작
    if($_POST["action"] == "upt_4insu_qst"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_4INSU_QUEST(IN P_ID INT(11),P_CATE VARCHAR(5) )
			BEGIN
            
				UPDATE TB600020 SET QUEST_FLAG = P_CATE
				WHERE ID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_4INSU_QUEST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_4INSU_QUEST('".$id."','".$cate."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                //echo '$id='.$id.'<br>$cate='.$cate;
            }
        }
        
    }
    //4대보험 리스트 옵션값 수정 : 끝
    
    
    
    //4대보험 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_4insu_opt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $prog=mysqli_real_escape_string($connect,$_POST["prog"]);
        $prio=mysqli_real_escape_string($connect,$_POST["prio"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_4INSU_LIST(IN P_ID INT(11),P_PRIO VARCHAR(5) , P_PROG VARCHAR(5) )
			BEGIN
            
				UPDATE TB600020 SET PRIO_NUM = P_PRIO, PROGRESS= P_PROG
				WHERE ID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_4INSU_LIST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_4INSU_LIST('".$id."','".$prio."','".$prog."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                //echo 'upt_trans_opt complate..';
            }
        }
        
    }
    //4대보험 리스트 옵션값 수정 : 끝
    
    
    //4대보험_등록 : 시작
    if($_POST["action"] == "action_4insu_insert"){
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $progress=mysqli_real_escape_string($connect,$_POST["progress"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
        $subject=mysqli_real_escape_string($connect,$_POST["subject"]);
        $reg_dept=mysqli_real_escape_string($connect,$_POST["reg_dept"]);
        $quest_flag=mysqli_real_escape_string($connect,$_POST["quest_flag"]);
        $svr_num=mysqli_real_escape_string($connect,$_POST["svr_num"]);
        $code_num=mysqli_real_escape_string($connect,$_POST["code_num"]);
        $company_name=mysqli_real_escape_string($connect,$_POST["company_name"]);
        $company_phone=mysqli_real_escape_string($connect,$_POST["company_phone"]);
        $file_real_str=mysqli_real_escape_string($connect,$_POST["file_real_str"]);
        $file_view_str=mysqli_real_escape_string($connect,$_POST["file_view_str"]);
        $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
        $etc=mysqli_real_escape_string($connect,$_POST["etc"]);
        
        $procedure = "
			CREATE PROCEDURE INSERT_4INSU(IN P_REGUSER INT(11),P_PROGRESS VARCHAR(5) , P_CONTENTS LONGTEXT, P_REG_BRANCH VARCHAR(5),P_SUBJECT VARCHAR(200),P_REG_DEPT VARCHAR(5), P_QUEST_FLAG VARCHAR(5),P_SVR_NUM VARCHAR(50),P_CODE_NUM VARCHAR(45) ,P_COMPANY_NAME VARCHAR(50),P_COMPANY_PHONE VARCHAR(45), P_FILE_REAL_STR LONGTEXT, P_FILE_VIEW_STR LONGTEXT, P_CATE VARCHAR(5) , P_ETC TEXT )
			BEGIN
            
				DECLARE TMP_NUM INT(11) DEFAULT 0;
            
				SELECT MAX(IFNULL(NUM,0))+1 INTO TMP_NUM FROM TB600020;
            
				INSERT INTO TB600020(NUM,REGUSER,REGDATE,PROGRESS,CONTENTS,REG_BRANCH,SUBJECT , REG_DEPT, QUEST_FLAG, SVR_NUM, CODE_NUM, COMPANY_NAME, COMPANY_PHONE, FILE_REAL_STR, FILE_VIEW_STR ,CATE, ETC) VALUES(TMP_NUM,P_REGUSER,NOW(), P_PROGRESS, P_CONTENTS, P_REG_BRANCH,P_SUBJECT, P_REG_DEPT,P_QUEST_FLAG, P_SVR_NUM,P_CODE_NUM, P_COMPANY_NAME, P_COMPANY_PHONE, P_FILE_REAL_STR, P_FILE_VIEW_STR,P_CATE,P_ETC);
            
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_4INSU"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_4INSU('".$reguser."','".$progress."','".$contents."','".$reg_branch."','".$subject."','".$reg_dept."','".$quest_flag."','".$svr_num."','".$code_num."','".$company_name."','".$company_phone."','".$file_real_str."','".$file_view_str."','".$cate."','".$etc."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query.'성공적으로 입력 되었습니다.';
                
            }
        }
        
    }
    //4대보험 등록 : 끝
    
    
    //4대보험_수정 : 시작
    if($_POST["action"] == "action_4insu_update"){
        $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $edtuser=mysqli_real_escape_string($connect,$_POST["edtuser"]);
        $progress=mysqli_real_escape_string($connect,$_POST["progress"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
        $subject=mysqli_real_escape_string($connect,$_POST["subject"]);
        $reg_dept=mysqli_real_escape_string($connect,$_POST["reg_dept"]);
        $quest_flag=mysqli_real_escape_string($connect,$_POST["quest_flag"]);
        $svr_num=mysqli_real_escape_string($connect,$_POST["svr_num"]);
        $code_num=mysqli_real_escape_string($connect,$_POST["code_num"]);
        $company_name=mysqli_real_escape_string($connect,$_POST["company_name"]);
        $company_phone=mysqli_real_escape_string($connect,$_POST["company_phone"]);
        $file_real_str=mysqli_real_escape_string($connect,$_POST["file_real_str"]);
        $file_view_str=mysqli_real_escape_string($connect,$_POST["file_view_str"]);
        $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
        $num=mysqli_real_escape_string($connect,$_POST["num"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $etc=mysqli_real_escape_string($connect,$_POST["etc"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_4INSU(IN P_REGUSER INT(11),P_PROGRESS VARCHAR(5) , P_CONTENTS LONGTEXT, P_REG_BRANCH VARCHAR(5),P_SUBJECT VARCHAR(200),P_REG_DEPT VARCHAR(5), P_QUEST_FLAG VARCHAR(5),P_SVR_NUM VARCHAR(50),P_CODE_NUM VARCHAR(45),P_COMPANY_NAME VARCHAR(50),P_COMPANY_PHONE VARCHAR(45), P_FILE_REAL_STR LONGTEXT, P_FILE_VIEW_STR LONGTEXT, P_CATE VARCHAR(5), P_NUM INT(11),P_EDTUSER VARCHAR(5), P_ID INT(11), P_ETC TEXT )
			BEGIN
            
				UPDATE TB600020 SET
				EDTUSER=P_EDTUSER,
				EDTDATE=NOW(),
				PROGRESS=P_PROGRESS,
				CONTENTS=P_CONTENTS,
				REG_BRANCH=P_REG_BRANCH,
				SUBJECT = P_SUBJECT,
				REG_DEPT = P_REG_DEPT,
				QUEST_FLAG = P_QUEST_FLAG,
				SVR_NUM = P_SVR_NUM,
				CODE_NUM = P_CODE_NUM,
				COMPANY_NAME = P_COMPANY_NAME,
				COMPANY_PHONE = P_COMPANY_PHONE,
				FILE_REAL_STR=file_real_str,
				FILE_VIEW_STR=file_view_str,
				CATE = P_CATE,
				NUM = P_NUM,
				ETC = P_ETC
				WHERE ID = P_ID ;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_4INSU"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_4INSU('".$reguser."','".$progress."','".$contents."','".$reg_branch."','".$subject."','".$reg_dept."','".$quest_flag."','".$svr_num."','".$code_num."','".$company_name."','".$company_phone."','".$file_real_str."','".$file_view_str."','".$cate."','".$num."','".$edtuser."','".$cstid."','".$etc."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '수정 되었습니다.';
            }
        }
        
    }
    //4대보험_수정 : 끝
    
    
    // 양도_삭제 : 시작
    if($_POST["action"] == "action_trans_delete")
    {
        $procedure = "
		CREATE PROCEDURE deleteTRANS(IN user_id int(100))
		BEGIN
			UPDATE TB600010 SET VISIBLE = 'N' WHERE ID = user_id;
		END;
		";
        
        if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteTRANS"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL deleteTRANS('".$_POST["id"]."')";
                mysqli_query($connect, $query);
                echo '삭제완료';
            }
        }
        
    }
    // 양도_삭제 : 끝
    
    
    //양도_수정 : 시작
    if($_POST["action"] == "action_trans_update"){
        $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $progress=mysqli_real_escape_string($connect,$_POST["progress"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
        $tax_flag=mysqli_real_escape_string($connect,$_POST["tax_flag"]);
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $cst_address=mysqli_real_escape_string($connect,$_POST["cst_address"]);
        $trans_target=mysqli_real_escape_string($connect,$_POST["trans_target"]);
        $pay_flag=mysqli_real_escape_string($connect,$_POST["pay_flag"]);
        $pay_date=mysqli_real_escape_string($connect,$_POST["pay_date"]);
        $price=mysqli_real_escape_string($connect,$_POST["price"]);
        $price2=mysqli_real_escape_string($connect,$_POST["price2"]);
        $trans_date=mysqli_real_escape_string($connect,$_POST["trans_date"]);
        $acq_date=mysqli_real_escape_string($connect,$_POST["acq_date"]);
        $delivery_flag=mysqli_real_escape_string($connect,$_POST["delivery_flag"]);
        $trans_price=mysqli_real_escape_string($connect,$_POST["trans_price"]);
        $acq_price=mysqli_real_escape_string($connect,$_POST["acq_price"]);
        $deadline=mysqli_real_escape_string($connect,$_POST["deadline"]);
        $total_tax=mysqli_real_escape_string($connect,$_POST["total_tax"]);
        $file_real_str=mysqli_real_escape_string($connect,$_POST["file_real_str"]);
        $file_view_str=mysqli_real_escape_string($connect,$_POST["file_view_str"]);
        $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
        $owner=mysqli_real_escape_string($connect,$_POST["owner"]);
        $num=mysqli_real_escape_string($connect,$_POST["num"]);
        $prio_num=mysqli_real_escape_string($connect,$_POST["prio_num"]);
        $rep_num=mysqli_real_escape_string($connect,$_POST["rep_num"]);
        $rep_date=mysqli_real_escape_string($connect,$_POST["rep_date"]);
        $reg_date=mysqli_real_escape_string($connect,$_POST["reg_date"]);
        $option_price=mysqli_real_escape_string($connect,$_POST["option_price"]);
        $edtuser=mysqli_real_escape_string($connect,$_POST["userid"]);
        $etc=mysqli_real_escape_string($connect,$_POST["etc"]);
        
        
        $procedure = "
			CREATE PROCEDURE UPDATE_TRANS(IN REGUSER INT(11),PROGRESS VARCHAR(5) , CONTENTS LONGTEXT, REG_BRANCH VARCHAR(5), TAX_FLAG VARCHAR(5), CSTNAME VARCHAR(50), MOBILE VARCHAR(50), CST_ADDRESS VARCHAR(200),TRANS_TARGET VARCHAR(5),PAY_FLAG VARCHAR(5), PAY_DATE DATETIME, PRICE INT(11),PRICE2 INT(11),TRANS_DATE DATETIME, ACQ_DATE DATETIME, DELIVERY_FLAG VARCHAR(5), TRANS_PRICE INT(11),ACQ_PRICE INT(11),DEADLINE DATETIME, TOTAL_TAX INT(11), FILE_REAL_STR LONGTEXT, FILE_VIEW_STR LONGTEXT, CSTID INT(11), CATE VARCHAR(5), OWNER VARCHAR(5), NUM INT(11), PRIO_NUM VARCHAR(5), REP_NUM VARCHAR(500), REP_DATE DATETIME, REG_DATE DATETIME , OPTION_PRICE VARCHAR(45),edtuser INT(11) , etc TEXT)
			BEGIN
            
				DECLARE TMP_REGDATE DATETIME;
            
				SELECT DATE_FORMAT(A.REGDATE, '%y-%m-%d') INTO TMP_REGDATE FROM TB600010 AS A WHERE A.ID = cstid;
            
				IF TMP_REGDATE = DATE_FORMAT(reg_date, '%y-%m-%d') THEN
            
					UPDATE TB600010 SET
					EDTDATE=NOW(),
					PROGRESS=progress,
					CONTENTS=contents,
					REG_BRANCH=reg_branch,
					TAX_FLAG=tax_flag,
					CSTNAME=cstname,
					MOBILE=mobile,
					CST_ADDRESS=cst_address,
					TRANS_TARGET=trans_target,
					PAY_FLAG=pay_flag,
					PAY_DATE=pay_date,
					PRICE=REPLACE(price,',',''),
					PRICE2=REPLACE(price2,',',''),
					TRANS_DATE=trans_date,
					ACQ_DATE=acq_date,
					DELIVERY_FLAG=delivery_flag,
					TRANS_PRICE=REPLACE(trans_price,',',''),
					ACQ_PRICE=REPLACE(acq_price,',',''),
					DEADLINE=deadline,
					TOTAL_TAX=total_tax,
					FILE_REAL_STR=file_real_str,
					FILE_VIEW_STR=file_view_str,
					CATE = cate,
					OWNER_USER = owner,
					NUM = num,
					PRIO_NUM = prio_num,
					REP_NUM = rep_num,
					REP_DATE = rep_date,
					OPTION_PRICE = option_price,
					EDTUSER=edtuser,
					ETC = etc
					WHERE ID = cstid ;
            
                ELSE
            
					UPDATE TB600010 SET
					EDTDATE=NOW(),
					PROGRESS=progress,
					CONTENTS=contents,
					REG_BRANCH=reg_branch,
					TAX_FLAG=tax_flag,
					CSTNAME=cstname,
					MOBILE=mobile,
					CST_ADDRESS=cst_address,
					TRANS_TARGET=trans_target,
					PAY_FLAG=pay_flag,
					PAY_DATE=pay_date,
					PRICE=REPLACE(price,',',''),
					PRICE2=REPLACE(price2,',',''),
					TRANS_DATE=trans_date,
					ACQ_DATE=acq_date,
					DELIVERY_FLAG=delivery_flag,
					TRANS_PRICE=REPLACE(trans_price,',',''),
					ACQ_PRICE=REPLACE(acq_price,',',''),
					DEADLINE=deadline,
					TOTAL_TAX=total_tax,
					FILE_REAL_STR=file_real_str,
					FILE_VIEW_STR=file_view_str,
					CATE = cate,
					OWNER_USER = owner,
					NUM = num,
					PRIO_NUM = prio_num,
					REP_NUM = rep_num,
					REP_DATE = rep_date,
					REGDATE = reg_date,
					OPTION_PRICE = option_price,
					EDTUSER=edtuser,
					ETC = etc
					WHERE ID = cstid ;
            
                END IF;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TRANS"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_TRANS('".$reguser."','".$progress."','".$contents."','".$reg_branch."','".$tax_flag."','".$cstname."','".$mobile."','".$cst_address."','".$trans_target."','".$pay_flag."','".$pay_date."','".$price."','".$price2."','".$trans_date."','".$acq_date."','".$delivery_flag."','".$trans_price."','".$acq_price."','".$deadline."','".$total_tax."','".$file_real_str."','".$file_view_str."','".$cstid."','".$cate."','".$owner."','".$num."','".$prio_num."','".$rep_num."','".$rep_date."','".$reg_date."','".$option_price."','".$edtuser."','".$etc."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '수정 되었습니다.';
            }
        }
        
    }
    //양도_수정 : 끝
    
    //양도_등록 : 시작
    if($_POST["action"] == "action_trans_insert"){
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $progress=mysqli_real_escape_string($connect,$_POST["progress"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
        $tax_flag=mysqli_real_escape_string($connect,$_POST["tax_flag"]);
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $cst_address=mysqli_real_escape_string($connect,$_POST["cst_address"]);
        $trans_target=mysqli_real_escape_string($connect,$_POST["trans_target"]);
        $pay_flag=mysqli_real_escape_string($connect,$_POST["pay_flag"]);
        $pay_date=mysqli_real_escape_string($connect,$_POST["pay_date"]);
        $price=mysqli_real_escape_string($connect,$_POST["price"]);
        $price2=mysqli_real_escape_string($connect,$_POST["price2"]);
        $trans_date=mysqli_real_escape_string($connect,$_POST["trans_date"]);
        $acq_date=mysqli_real_escape_string($connect,$_POST["acq_date"]);
        $delivery_flag=mysqli_real_escape_string($connect,$_POST["delivery_flag"]);
        $trans_price=mysqli_real_escape_string($connect,$_POST["trans_price"]);
        $acq_price=mysqli_real_escape_string($connect,$_POST["acq_price"]);
        $deadline=mysqli_real_escape_string($connect,$_POST["deadline"]);
        $total_tax=mysqli_real_escape_string($connect,$_POST["total_tax"]);
        $file_real_str=mysqli_real_escape_string($connect,$_POST["file_real_str"]);
        $file_view_str=mysqli_real_escape_string($connect,$_POST["file_view_str"]);
        $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
        $owner=mysqli_real_escape_string($connect,$_POST["owner"]);
        $prio_num=mysqli_real_escape_string($connect,$_POST["prio_num"]);
        $rep_num=mysqli_real_escape_string($connect,$_POST["rep_num"]);
        $rep_date=mysqli_real_escape_string($connect,$_POST["rep_date"]);
        $reg_date=mysqli_real_escape_string($connect,$_POST["reg_date"]);
        $option_price=mysqli_real_escape_string($connect,$_POST["option_price"]);
        $etc=mysqli_real_escape_string($connect,$_POST["etc"]);
        
        
        $procedure = "
			CREATE PROCEDURE INSERT_TRANS(IN REGUSER INT(11), REG_DATE DATETIME ,PROGRESS VARCHAR(5) , CONTENTS LONGTEXT, REG_BRANCH VARCHAR(5), TAX_FLAG VARCHAR(5), CSTNAME VARCHAR(50), MOBILE VARCHAR(50), CST_ADDRESS VARCHAR(200),TRANS_TARGET VARCHAR(5),PAY_FLAG VARCHAR(5), PAY_DATE DATETIME, PRICE INT(11),PRICE2 INT(11),TRANS_DATE DATETIME, ACQ_DATE DATETIME, DELIVERY_FLAG VARCHAR(5), TRANS_PRICE INT(11),ACQ_PRICE INT(11),DEADLINE DATETIME, TOTAL_TAX INT(11), FILE_REAL_STR LONGTEXT, FILE_VIEW_STR LONGTEXT, CATE VARCHAR(5) ,OWNER VARCHAR(5), PRIO_NUM VARCHAR(5),  REP_NUM VARCHAR(500),REP_DATE DATETIME, OPTION_PRICE VARCHAR(45), ETC TEXT )
			BEGIN
            
				DECLARE TMP_NUM INT(11) DEFAULT 0;
                DECLARE TMP_REGDATE DATETIME DEFAULT 0;
            
				SELECT MAX(NUM)+1 INTO TMP_NUM FROM TB600010;
            
				IF reg_date = DATE_FORMAT(NOW(), '%Y-%m-%d') THEN
					SET TMP_REGDATE = NOW();
				else
					SET TMP_REGDATE = reg_date;
				END IF;
            
				INSERT INTO TB600010(NUM,REGUSER,REGDATE,PROGRESS,CONTENTS,REG_BRANCH,TAX_FLAG,CSTNAME, MOBILE, CST_ADDRESS,TRANS_TARGET,PAY_FLAG, PAY_DATE,PRICE,PRICE2,TRANS_DATE, ACQ_DATE,DELIVERY_FLAG,TRANS_PRICE,ACQ_PRICE,DEADLINE,TOTAL_TAX, FILE_REAL_STR, FILE_VIEW_STR ,CATE,OWNER_USER, PRIO_NUM, VISIBLE, REP_NUM, REP_DATE, OPTION_PRICE, ETC) VALUES(TMP_NUM,reguser,TMP_REGDATE, progress, contents, reg_branch, tax_flag, cstname, mobile,cst_address,trans_target,pay_flag,pay_date,REPLACE(price,',',''),REPLACE(price2,',',''),trans_date,acq_date,delivery_flag,REPLACE(trans_price,',',''),REPLACE(acq_price,',',''),deadline,total_tax, file_real_str, file_view_str,cate,owner, prio_num,'Y', rep_num, rep_date , option_price, etc);
            
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TRANS"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_TRANS('".$reguser."','".$reg_date."','".$progress."','".$contents."','".$reg_branch."','".$tax_flag."','".$cstname."','".$mobile."','".$cst_address."','".$trans_target."','".$pay_flag."','".$pay_date."','".$price."','".$price2."','".$trans_date."','".$acq_date."','".$delivery_flag."','".$trans_price."','".$acq_price."','".$deadline."','".$total_tax."','".$file_real_str."','".$file_view_str."','".$cate."','".$owner."','".$prio_num."','".$rep_num."','".$rep_date."','".$option_price."','".$etc."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
                
            }
        }
        
    }
    //양도등록 생성 : 끝
    
    
    
    //직원정보 등록/수정 : 시작
    if($_POST["action"] == "reg_member"){
        $member_id=mysqli_real_escape_string($connect,$_POST["member_id"]);
        $member_pw=mysqli_real_escape_string($connect,$_POST["member_pw"]);
        $member_name=mysqli_real_escape_string($connect,$_POST["member_name"]);
        $depid=mysqli_real_escape_string($connect,$_POST["depid"]);
        //$position_id=mysqli_real_escape_string($connect,$_POST["position_id"]);
        $inner_phone=mysqli_real_escape_string($connect,$_POST["inner_phone"]);
        $outer_phone=mysqli_real_escape_string($connect,$_POST["outer_phone"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        
        $procedure = "
			CREATE PROCEDURE INSERT_TB980010(IN member_id VARCHAR(45),member_pw VARCHAR(45) , member_name VARCHAR(45), depid varchar(5), INNER_PHONE VARCHAR(45), OUTER_PHONE VARCHAR(45), MOBILE VARCHAR(45) )
			BEGIN
            
			DECLARE CNT INT(11) default 0;
			DECLARE TMP INT(11) default 0;
            
			SELECT COUNT(*) INTO CNT FROM TB980010
			WHERE ID = member_id;
            
			SELECT CNT FROM DUAL;
            
			IF CNT = 0
			THEN
				SELECT MAX(USERID)+1 INTO TMP FROM TB980010;
            
				INSERT INTO TB980010(USERID,ID, PW, USERNAME,DEPID, REGDATE, EDTDATE, INNER_PHONE, OUTER_PHONE, MOBILE ) VALUES(TMP,member_id, PASSWORD(member_pw),member_name,depid, NOW(), NOW(), inner_phone, outer_phone, mobile);
			END IF;
            
			IF CNT > 0
			THEN
				UPDATE TB980010 SET PW=PASSWORD(member_pw), USERNAME=member_name, DEPID=depid,
				EDTDATE = NOW(),
				INNER_PHONE = inner_phone,
				OUTER_PHONE = outer_phone,
				MOBILE = mobile
				WHERE ID = member_id ;
			END IF;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB980010"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_TB980010('".$member_id."','".$member_pw."','".$member_name."','".$depid."','".$inner_phone."','".$outer_phone."','".$mobile."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
        
    }
    //직원정보 등록/수정 : 끝
    
    
    //직원정보 등록/수정_어드민 : 시작
    if($_POST["action"] == "reg_member_admin"){
        $member_id=mysqli_real_escape_string($connect,$_POST["member_id"]);
        //$member_pw=mysqli_real_escape_string($connect,$_POST["member_pw"]);
        $member_name=mysqli_real_escape_string($connect,$_POST["member_name"]);
        $depid=mysqli_real_escape_string($connect,$_POST["depid"]);
        $position_id=mysqli_real_escape_string($connect,$_POST["position_id"]);
        $inner_phone=mysqli_real_escape_string($connect,$_POST["inner_phone"]);
        $outer_phone=mysqli_real_escape_string($connect,$_POST["outer_phone"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        
        $procedure = "
			CREATE PROCEDURE INSERT_TB980010(IN member_id VARCHAR(45),member_name VARCHAR(45), depid varchar(5), position_id varchar(5), INNER_PHONE VARCHAR(45), OUTER_PHONE VARCHAR(45), MOBILE VARCHAR(45) )
			BEGIN
            
			DECLARE CNT INT(11) default 0;
			DECLARE TMP INT(11) default 0;
            
			SELECT COUNT(*) INTO CNT FROM TB980010
			WHERE ID = member_id;
            
			SELECT CNT FROM DUAL;
            
			IF CNT = 0
			THEN
				SELECT MAX(USERID)+1 INTO TMP FROM TB980010;
            
				INSERT INTO TB980010(USERID,ID, USERNAME,DEPID,POSITION_ID, REGDATE, EDTDATE, INNER_PHONE, OUTER_PHONE, MOBILE ) VALUES(TMP,member_id, member_name,depid, position_id, NOW(), NOW(), inner_phone, outer_phone, mobile);
			END IF;
            
			IF CNT > 0
			THEN
				UPDATE TB980010 SET
				USERNAME=member_name, DEPID=depid,
				POSITION_ID = position_id,
				EDTDATE = NOW(),
				INNER_PHONE = inner_phone,
				OUTER_PHONE = outer_phone,
				MOBILE = mobile
				WHERE ID = member_id ;
			END IF;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB980010"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_TB980010('".$member_id."','".$member_name."','".$depid."','".$position_id."','".$inner_phone."','".$outer_phone."','".$mobile."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
        
    }
    //직원정보 등록/수정_어드민 : 끝
    
    
    
    if($_POST["action"]=="팝업등록")
    { //ajax로 넘긴 data를 받아준다.
        $hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
        $hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
        $residentid=mysqli_real_escape_string($connect,$_POST["residentid"]);
        
        $procedure = "
		CREATE PROCEDURE insert_TB100020_POP(IN hometaxid VARCHAR(45),hometaxpw VARCHAR(45) , residentid VARCHAR(15) )
		BEGIN
            
		DECLARE CNT INT(11) default 0;
            
		SELECT COUNT(*) INTO CNT FROM TB100020
        WHERE TB100020.HomeTaxID = hometaxid
		AND TB100020.HomeTaxPW = hometaxpw;
            
        SELECT CNT FROM DUAL;
            
		IF CNT = 0
		THEN
			INSERT INTO TB100020(HomeTaxID, HomeTaxPW,RESIDENT_ID ) VALUES(hometaxid, hometaxpw,residentid);
		END IF;
            
        IF CNT > 0
		THEN
			UPDATE TB100020 SET HomeTaxID = hometaxid, HomeTaxPW=hometaxpw, RESIDENT_ID=residentid
            WHERE TB100020.HomeTaxID = hometaxid
			AND TB100020.HomeTaxPW = hometaxpw;
		END IF;
		END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_TB100020_POP"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL insert_TB100020_POP('".$hometaxid."','".$hometaxpw."','".$residentid."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
    }
    
    
    
    if($_POST["action"]=="등록_RPA")
    { //ajax로 넘긴 data를 받아준다.
        $CSTNAME=mysqli_real_escape_string($connect,$_POST["CSTNAME"]);
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $resident1=mysqli_real_escape_string($connect,$_POST["resident1"]);
        $resident2=mysqli_real_escape_string($connect,$_POST["resident2"]);
        $ref_bank=mysqli_real_escape_string($connect,$_POST["ref_bank"]);
        $ref_acc=mysqli_real_escape_string($connect,$_POST["ref_acc"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        $server=mysqli_real_escape_string($connect,$_POST["server"]);
        $server_num=mysqli_real_escape_string($connect,$_POST["server_num"]);
        $hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
        $hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
        $cst_type=mysqli_real_escape_string($connect,$_POST["cst_type"]);
        
        $procedure = "
		CREATE PROCEDURE insert_TB100020(IN numbering varchar(5),cstname varchar(45),mobile varchar(45),resident1 varchar(10),resident2 varchar(10), ref_bank varchar(45),ref_acc varchar(100),branch varchar(10), server INT(11), server_num VARCHAR(5), hometaxid VARCHAR(45),hometaxpw VARCHAR(45) ,cst_type varchar(10) )
		BEGIN
            
		DECLARE resident_id VARCHAR(15);
            
		SET resident_id = CONCAT(resident1,'-',resident2);
            
		INSERT INTO TB100020(NUMBERING,CSTNAME, MOBILE,RESIDENT_ID,REF_BANK,REF_ACC, WRITE_REGDATE, BRANCH, SERVER, SERVER_NUM, HomeTaxID, HomeTaxPW, CST_TYPE) 
        VALUES(numbering,REPLACE(cstname,' ' ,''),REPLACE(REPLACE(mobile,'-',''),' ',''),resident_id,ref_bank,ref_acc, NOW(),branch, server, server_num, hometaxid, hometaxpw,cst_type);
		END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_TB100020"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL insert_TB100020('".$numbering ."','".$cstname."','".$mobile."','".$resident1."','".$resident2."','".$ref_bank."','".$ref_acc."','".$branch."','".$server."','".$server_num."','".$hometaxid."','".$hometaxpw."','".$cst_type."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
    }
    
    
    
    
    if($_POST["action"]=="action_inc_insert")
    { //ajax로 넘긴 data를 받아준다.
        $CSTNAME=mysqli_real_escape_string($connect,$_POST["CSTNAME"]);
        $MOBILE=mysqli_real_escape_string($connect,$_POST["MOBILE"]);
        $RESIDENT_ID=mysqli_real_escape_string($connect,$_POST["RESIDENT_ID"]);
        $EMAIL=mysqli_real_escape_string($connect,$_POST["EMAIL"]);
        $HomeTaxID=mysqli_real_escape_string($connect,$_POST["HomeTaxID"]);
        $HomeTaxPW=mysqli_real_escape_string($connect,$_POST["HomeTaxPW"]);
        $REF_BANK=mysqli_real_escape_string($connect,$_POST["REF_BANK"]);
        $REF_ACC=mysqli_real_escape_string($connect,$_POST["REF_ACC"]);
        $ACC_HOLDER=mysqli_real_escape_string($connect,$_POST["ACC_HOLDER"]);
        $DOUZONE_SVR=mysqli_real_escape_string($connect,$_POST["DOUZONE_SVR"]);
        $DOUZONE_CODE=mysqli_real_escape_string($connect,$_POST["DOUZONE_CODE"]);
        $MEMO=mysqli_real_escape_string($connect,$_POST["MEMO"]);
        $KAKAO_REG=mysqli_real_escape_string($connect,$_POST["KAKAO_REG"]);
        
        $procedure = "
		CREATE PROCEDURE insert_TB100020_inc(IN P_CSTNAME varchar(45),P_MOBILE varchar(45),
        P_RESIDENT_ID varchar(15),P_EMAIL varchar(200),P_HomeTaxID varchar(45), P_HomeTaxPW varchar(45)
        ,P_REF_BANK varchar(45),P_REF_ACC varchar(100), P_ACC_HOLDER VARCHAR(45), P_DOUZONE_SVR VARCHAR(1)
        , P_DOUZONE_CODE VARCHAR(4),P_MEMO LONGTEXT , P_KAKAO_REG VARCHAR(45) )
		BEGIN

        DECLARE CNT INT(11);
        DECLARE CNT2 INT(11);
        DECLARE TMP_CSTID INT(11);

        SELECT COUNT(1) INTO CNT FROM TB100020 WHERE CSTNAME = P_CSTNAME AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');
        
        IF CNT=0 THEN            
    		INSERT INTO TB100020(CSTNAME,MOBILE,RESIDENT_ID,EMAIL,HomeTaxID,HomeTaxPW, REF_BANK,
            REF_ACC, ACC_HOLDER, DOUZONE_SVR, DOUZONE_CODE, MEMO,KAKAO_REG) 
            VALUES(REPLACE(P_CSTNAME,' ',''),REPLACE(REPLACE(P_MOBILE,'-',''),' ',''),P_RESIDENT_ID,P_EMAIL,P_HomeTaxID,P_HomeTaxPW, P_REF_BANK,
            P_REF_ACC, P_ACC_HOLDER, P_DOUZONE_SVR, P_DOUZONE_CODE, P_MEMO,P_KAKAO_REG);

            SELECT last_insert_id() INTO TMP_CSTID;
            
            END IF;
             

            
        END IF;

        SELECT COUNT(1) INTO CNT2 FROM TB100030 WHERE CSTID =TMP_CSTID ; 

        IF CNT2 = 0 THEN
            INSERT INTO TB100030 (CSTID,DOUZONE_SVR, DOUZONE_CODE)
            VALUES (TMP_CSTID, P_DOUZONE_SVR, P_DOUZONE_CODE);
        ELSE    
            UPDATE TB100030 SET DOUZONE_SVR = P_DOUZONE_SVR, DOUZONE_CODE=P_DOUZONE_CODE WHERE CSTID = TMP_CSTID;
        END IF;
        
        SELECT TMP_CSTID;
		END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_TB100020_inc"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL insert_TB100020_inc('".$CSTNAME ."','".$MOBILE."','".$RESIDENT_ID."','".$EMAIL."','"
                    .$HomeTaxID."','".$HomeTaxPW."','".$REF_BANK."','".$REF_ACC."','".$ACC_HOLDER."','"
                        .$DOUZONE_SVR."','".$DOUZONE_CODE."','".$MEMO."','".$KAKAO_REG."')";
                //프로시저 호출
                //mysqli_query($connect,$query);
                //echo '성공적으로 입력 되었습니다.';
                
                $result = mysqli_query($connect,$query);
                while($row = mysqli_fetch_array($result)){
                    $output['CSTID'] = $row["TMP_CSTID"];
                }
                echo json_encode($output);                
            }
        }
    }
    
    
    
    
    if($_POST["action"]=="action_inc_insert_ex1")
    { //ajax로 넘긴 data를 받아준다.
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $REGDATE=mysqli_real_escape_string($connect,$_POST["REGDATE"]);
        $COMP_NAME=mysqli_real_escape_string($connect,$_POST["COMP_NAME"]);
        $tmp_biz_id=mysqli_real_escape_string($connect,$_POST["tmp_biz_id"]);
        $EXP_PAY_TAX=mysqli_real_escape_string($connect,$_POST["EXP_PAY_TAX"]);
        $EST_FEE=mysqli_real_escape_string($connect,$_POST["EST_FEE"]);
        $DEP_FEE=mysqli_real_escape_string($connect,$_POST["DEP_FEE"]);
        $DEP_TYPE=mysqli_real_escape_string($connect,$_POST["DEP_TYPE"]);
        $ACC_FLAG=mysqli_real_escape_string($connect,$_POST["ACC_FLAG"]);
        $DEADLINE_DATE=mysqli_real_escape_string($connect,$_POST["DEADLINE_DATE"]);
        $PAY_TAX=mysqli_real_escape_string($connect,$_POST["PAY_TAX"]);
        $NUM_E_REPORT =mysqli_real_escape_string($connect,$_POST["NUM_E_REPORT"]);
        $REPORT_NUM_INCOME=mysqli_real_escape_string($connect,$_POST["REPORT_NUM_INCOME"]);
        $REPORT_NUM_WETAX =mysqli_real_escape_string($connect,$_POST["REPORT_NUM_WETAX"]);
        $DEL_DATE_PAYMENT  =mysqli_real_escape_string($connect,$_POST["DEL_DATE_PAYMENT"]);
        $DEL_TYPE_PAYMENT  =mysqli_real_escape_string($connect,$_POST["DEL_TYPE_PAYMENT"]);
        $DEC_REGUSER   =mysqli_real_escape_string($connect,$_POST["DEC_REGUSER"]);
        $CST_TYPE  =mysqli_real_escape_string($connect,$_POST["CST_TYPE"]);
        $TAX_TYPE  =mysqli_real_escape_string($connect,$_POST["TAX_TYPE"]);
        $INF_CHANNEL  =mysqli_real_escape_string($connect,$_POST["INF_CHANNEL"]);
        $INF_PATH  =mysqli_real_escape_string($connect,$_POST["INF_PATH"]);
        $INF_GEAR  =mysqli_real_escape_string($connect,$_POST["INF_GEAR"]);
        $KEYWORD  =mysqli_real_escape_string($connect,$_POST["KEYWORD"]);
        $REG_BRANCH =mysqli_real_escape_string($connect,$_POST["REG_BRANCH"]);
        $ACC_PATH =mysqli_real_escape_string($connect,$_POST["ACC_PATH"]);
        $REC_PERSON =mysqli_real_escape_string($connect,$_POST["REC_PERSON"]);
        $REC_PERSON_PHONE =mysqli_real_escape_string($connect,$_POST["REC_PERSON_PHONE"]);
        $REGUSER =mysqli_real_escape_string($connect,$_POST["REGUSER"]);
        $SALES_REP =mysqli_real_escape_string($connect,$_POST["SALES_REP"]);
        $MEMO =mysqli_real_escape_string($connect,$_POST["MEMO"]);
        $SUBM_DATE2=mysqli_real_escape_string($connect,$_POST["SUBM_DATE2"]);
        $CASH_REC=mysqli_real_escape_string($connect,$_POST["CASH_REC"]);
        $CST_TYPE_YEAR=mysqli_real_escape_string($connect,$_POST["CST_TYPE_YEAR"]);
        $CST_TYPE_SEQ=mysqli_real_escape_string($connect,$_POST["CST_TYPE_SEQ"]);
        
        $procedure = "
		CREATE PROCEDURE INSERT_TB100020_INC_EX1(IN P_ID INT(11) ,P_REGDATE varchar(45),
        P_COMP_NAME varchar(45), P_EXP_PAY_TAX INT(11),P_EST_FEE INT(11), P_DEP_FEE INT(11)
        ,P_DEP_TYPE varchar(5),P_ACC_FLAG varchar(5), P_DEADLINE_DATE DATETIME,
P_PAY_TAX INT(11), P_NUM_E_REPORT VARCHAR(50), P_REPORT_NUM_INCOME VARCHAR(45),
P_REPORT_NUM_WETAX VARCHAR(45), P_DEL_DATE_PAYMENT DATETIME, P_DEL_TYPE_PAYMENT VARCHAR(10),
P_DEC_REGUSER VARCHAR(20), P_CST_TYPE VARCHAR(10), P_TAX_TYPE VARCHAR(5), 
P_INF_CHANNEL VARCHAR(50), P_INF_PATH VARCHAR(50), P_INF_GEAR VARCHAR(50),
P_KEYWORD TEXT, P_REG_BRANCH VARCHAR(50), P_ACC_PATH VARCHAR(200), P_REC_PERSON VARCHAR(50),
P_REC_PERSON_PHONE VARCHAR(45), P_REGUSER VARCHAR(5), P_SALES_REP VARCHAR(20), P_MEMO TEXT, 
P_SUBM_DATE2 DATETIME, P_CASH_REC VARCHAR(10), P_TMP_BIZ_ID INT(11), P_CST_TYPE_YEAR VARCHAR(4), P_CST_TYPE_SEQ VARCHAR(1)  )
		BEGIN
        
    DECLARE CNT INT;
    DECLARE TMP_BIZID INT;
    
        SELECT COUNT(1) INTO CNT FROM TB100022 WHERE CSTID = P_ID AND CST_TYPE =P_CST_TYPE
AND CST_TYPE_YEAR = P_CST_TYPE_YEAR  AND CST_TYPE_SEQ=P_CST_TYPE_SEQ;
            
        IF CNT=0 THEN
    		INSERT INTO TB100022(CSTID, 
REGDATE, 
COMP_NAME, 
EXP_PAY_TAX, 
EST_FEE, 
DEP_FEE, 
DEP_TYPE,
ACC_FLAG, 
DEADLINE_DATE, 
PAY_TAX,
NUM_E_REPORT,  
REPORT_NUM_INCOME,
REPORT_NUM_WETAX,
DEL_DATE_PAYMENT, 
DEL_TYPE_PAYMENT, 
DEC_REGUSER , 
CST_TYPE ,
TAX_TYPE, 
INF_CHANNEL , 
INF_PATH, 
INF_GEAR ,
KEYWORD, 
REG_BRANCH , 
ACC_PATH , 
REC_PERSON, 
REC_PERSON_PHONE, 
REGUSER , 
SALES_REP, 
MEMO , 
SUBM_DATE2 , 
CASH_REC, 
COMP_ID , CST_TYPE_YEAR, CST_TYPE_SEQ  )
SELECT P_ID, 
P_REGDATE, 
P_COMP_NAME, 
P_EXP_PAY_TAX, 
P_EST_FEE, 
P_DEP_FEE, 
P_DEP_TYPE,
P_ACC_FLAG, 
P_DEADLINE_DATE, 
P_PAY_TAX,
P_NUM_E_REPORT,  
P_REPORT_NUM_INCOME,
P_REPORT_NUM_WETAX,
P_DEL_DATE_PAYMENT, 
P_DEL_TYPE_PAYMENT, 
P_DEC_REGUSER , 
P_CST_TYPE ,
P_TAX_TYPE, 
P_INF_CHANNEL , 
P_INF_PATH, 
P_INF_GEAR ,
P_KEYWORD, 
P_REG_BRANCH , 
P_ACC_PATH , 
P_REC_PERSON, 
P_REC_PERSON_PHONE, 
P_REGUSER , 
P_SALES_REP, 
P_MEMO , 
P_SUBM_DATE2 , 
P_CASH_REC,
P_TMP_BIZ_ID,
P_CST_TYPE_YEAR,
P_CST_TYPE_SEQ;
           

    SELECT last_insert_id() INTO TMP_BIZID;
        
            END IF;
            
        SELECT TMP_BIZID;
		END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB100020_INC_EX1"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_TB100020_INC_EX1('".$id ."','".$REGDATE."','".$COMP_NAME."','".$EXP_PAY_TAX."','"
                    .$EST_FEE."','".$DEP_FEE."','".$DEP_TYPE."','".$ACC_FLAG."','".$DEADLINE_DATE."','"
                        .$PAY_TAX."','".$NUM_E_REPORT."','".$REPORT_NUM_INCOME."','".$REPORT_NUM_WETAX."','".$DEL_DATE_PAYMENT."',
'".$DEL_TYPE_PAYMENT."','".$DEC_REGUSER."','".$CST_TYPE."','".$TAX_TYPE."','".$INF_CHANNEL."','".$INF_PATH."'
,'".$INF_GEAR."','".$KEYWORD."','".$REG_BRANCH."','".$ACC_PATH."','".$REC_PERSON."','".$REC_PERSON_PHONE."'
,'".$REGUSER."','".$SALES_REP."','".$MEMO."','".$SUBM_DATE2."','".$CASH_REC."','".$tmp_biz_id."','".$CST_TYPE_YEAR."','".$CST_TYPE_SEQ."')";
                        //프로시저 호출
                        //mysqli_query($connect,$query);
                        //echo '성공적으로 입력 되었습니다.';
                        
                        $result = mysqli_query($connect,$query);
                        while($row = mysqli_fetch_array($result)){
                            $output['BIZID'] = $row["TMP_BIZID"];
                        }
                        echo json_encode($output);
            }
        }
    }
    
    
    
    
    
    if($_POST["action"]=="action_comp_insert")
    { //ajax로 넘긴 data를 받아준다.
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $COMPANY=mysqli_real_escape_string($connect,$_POST["COMPANY"]);
        $BIZ_NUM=mysqli_real_escape_string($connect,$_POST["BIZ_NUM"]);
        $OPENING_DAY=mysqli_real_escape_string($connect,$_POST["OPENING_DAY"]);
        $CLOSE_DAY=mysqli_real_escape_string($connect,$_POST["CLOSE_DAY"]);
        $BIZ_FORM=mysqli_real_escape_string($connect,$_POST["BIZ_FORM"]);
        $BIZ_CATE=mysqli_real_escape_string($connect,$_POST["BIZ_CATE"]);
        $ADDRESS_LOAD=mysqli_real_escape_string($connect,$_POST["ADDRESS_LOAD"]);
        $ADDRESS_LEGAL=mysqli_real_escape_string($connect,$_POST["ADDRESS_LEGAL"]);
        $COMP_PHONE=mysqli_real_escape_string($connect,$_POST["COMP_PHONE"]);
        $DOUZONE_SVR=mysqli_real_escape_string($connect,$_POST["DOUZONE_SVR"]);
        $DOUZONE_CODE=mysqli_real_escape_string($connect,$_POST["DOUZONE_CODE"]);
        $DIS_DATE=mysqli_real_escape_string($connect,$_POST["DIS_DATE"]);
        $DIS_REASON=mysqli_real_escape_string($connect,$_POST["DIS_REASON"]);
        
        $procedure = "
		CREATE PROCEDURE INSERT_TB100030(IN P_ID INT(11) ,P_COMPANY varchar(45),  P_BIZ_NUM VARCHAR(100), 
P_OPENING_DAY DATETIME, P_CLOSE_DAY DATETIME,P_BIZ_FORM VARCHAR(50), P_BIZ_CATE VARCHAR(50), 
P_ADDRESS_LOAD VARCHAR(200),P_ADDRESS_LEGAL VARCHAR(200),
P_COMP_PHONE VARCHAR(50),P_DOUZONE_SVR VARCHAR(1), P_DOUZONE_CODE VARCHAR(4),
P_DIS_DATE DATETIME, P_DIS_REASON VARCHAR(200) )
		BEGIN
            
    DECLARE CNT INT;
    DECLARE TMP_ID INT;
            
        SELECT COUNT(1) INTO CNT FROM TB100030 WHERE BIZ_ID = P_BIZ_NUM;
            
        IF CNT=0 THEN
            
    INSERT INTO TB100030(CSTID,COMPANY, BIZ_NUM, OPENING_DAY , CLOSE_DAY , 
BIZ_FORM, BIZ_CATE, ADDRESS_LOAD, ADDRESS_LEGAL,COMP_PHONE,
DOUZONE_SVR, DOUZONE_CODE ,DIS_DATE,DIS_REASON, BIZ_REGDATE )
SELECT   P_ID, P_COMPANY, P_BIZ_NUM, P_OPENING_DAY , P_CLOSE_DAY , 
P_BIZ_FORM, P_BIZ_CATE, P_ADDRESS_LOAD, P_ADDRESS_LEGAL,P_COMP_PHONE,
P_DOUZONE_SVR, P_DOUZONE_CODE ,P_DIS_DATE,P_DIS_REASON , NOW();

SELECT last_insert_id() INTO TMP_ID;
            
            END IF;
            
        SELECT TMP_ID;
		END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB100030"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_TB100030('".$id ."','".$COMPANY."','".$BIZ_NUM."','"
                    .$OPENING_DAY."','".$CLOSE_DAY."','".$BIZ_FORM."','".$BIZ_CATE."','".$ADDRESS_LOAD."','"
                        .$ADDRESS_LEGAL."','".$COMP_PHONE."','".$DOUZONE_SVR."','".$DOUZONE_CODE."','".$DIS_DATE."','".$DIS_REASON."')";
                        
                        $result = mysqli_query($connect,$query);
                        while($row = mysqli_fetch_array($result)){
                            $output['BIZID'] = $row["TMP_ID"];
                        }
                        echo json_encode($output);
            }
        }
    }
    
    
    
    
    
    
    
    
    
    if($_POST["action"]=="action_inc_update")
    { //ajax로 넘긴 data를 받아준다.
        $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
        $numbering=mysqli_real_escape_string($connect,$_POST["numbering"]);
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $resident1=mysqli_real_escape_string($connect,$_POST["resident1"]);
        $resident2=mysqli_real_escape_string($connect,$_POST["resident2"]);
        $ref_bank=mysqli_real_escape_string($connect,$_POST["ref_bank"]);
        $ref_acc=mysqli_real_escape_string($connect,$_POST["ref_acc"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        $server=mysqli_real_escape_string($connect,$_POST["server"]);
        $server_num=mysqli_real_escape_string($connect,$_POST["server_num"]);
        $hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
        $hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
        $cst_type=mysqli_real_escape_string($connect,$_POST["cst_type"]);
        
        $procedure = "
		CREATE PROCEDURE UPDATE_TB100020(IN P_NUMBERING varchar(5),P_CSTNAME varchar(45),
        P_MOBILE varchar(45),P_RESIDENT1 varchar(10), P_RESIDENT2 varchar(10), P_REF_BANK varchar(45),
        P_REF_ACC varchar(100),P_BRANCH varchar(10), P_DOUZONE_SVR INT(11), 
        P_DOUZONE_CODE VARCHAR(5), P_HOMETAXID VARCHAR(45), P_HOMETAXPW VARCHAR(45) ,
        P_CST_TYPE varchar(10) , P_CSTID INT(11) )
		BEGIN
            
		DECLARE P_RESIDENT_ID VARCHAR(15);
        DECLARE CNT1 INT(11);
        DECLARE CNT2 INT(11);
        DECLARE CNT3 INT(11);
            
		SET P_RESIDENT_ID = CONCAT(P_RESIDENT1,'-',P_RESIDENT2);
        SELECT COUNT(1) INTO CNT1 FROM TB100020 WHERE CSTID = P_CSTID;
        SELECT COUNT(1) INTO CNT2 FROM TB100022 WHERE CSTID = P_CSTID;
        SELECT COUNT(1) INTO CNT3 FROM TB100030 WHERE CSTID = P_CSTID;
        
        IF CNT1>0 THEN
            UPDATE TB100020 SET  HomeTaxID = P_HOMETAXID, HomeTaxPW = P_HOMETAXPW, RESIDENT_ID = P_RESIDENT_ID, 
            CSTNAME = P_CSTNAME ,REF_BANK = P_REF_BANK , REF_ACC = P_REF_ACC , MOBILE = REPLACE(P_MOBILE,'-','')
            WHERE CSTID = P_CSTID;
        END IF;
        
        IF CNT2>0 THEN
            UPDATE TB100022 SET REG_BRANCH = P_BRANCH, CST_TYPE=P_CST_TYPE 
            WHERE CSTID = P_CSTID;
        END IF;
        
        IF CNT3>0 THEN
            UPDATE TB100030 SET DOUZONE_SVR = P_DOUZONE_SVR , DOUZONE_CODE = P_DOUZONE_CODE
            WHERE CSTID = P_CSTID;  
        END IF;            
		
		END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TB100020"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_TB100020('".$numbering ."','".$cstname."','".$mobile."','".$resident1."','".$resident2."','".$ref_bank."','".$ref_acc."','".$branch."','".$server."','".$server_num."','".$hometaxid."','".$hometaxpw."','".$cst_type."','".$cstid."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
    }
    
    
    
    if($_POST["action"]=="추가")
    { //ajax로 넘긴 data를 받아준다.
        $subject=mysqli_real_escape_string($connect,$_POST["subject"]);
        $news_reguser=mysqli_real_escape_string($connect,$_POST["news_reguser"]);
        $news_reguser_comp=mysqli_real_escape_string($connect,$_POST["news_reguser_comp"]);
        $news_regdate=mysqli_real_escape_string($connect,$_POST["news_regdate"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $img_url=mysqli_real_escape_string($connect,$_POST["img_url"]);
        $img_url_flag=mysqli_real_escape_string($connect,$_POST["img_url_flag"]);
        $file_url=mysqli_real_escape_string($connect,$_POST["file_url"]);
        $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
        $c_cate=mysqli_real_escape_string($connect,$_POST["c_cate"]);		$visible=mysqli_real_escape_string($connect,$_POST["visible"]);
        $site_gubun=mysqli_real_escape_string($connect,$_POST["site_gubun"]);
        
        
        //참고-mysqli_real_escape_string
        //:MySQL로 질의를 전송하기 전에 안전하게 데이터를 만들기 위해 사용
        //특수 문자열을 이스케이프하여 mysql_query() 수행시 안전하게 질의할 수 있도록 한다.
        /*
         , , content varchar(8000)
         , , CONTENTS,
         ,  news_reguser_comp, content
         ."','".$news_regdate."','".$news_reguser_comp."','".$content
         */
        //insert 프로시저 생성
        $procedure = "
		CREATE PROCEDURE insertNews(IN subject varchar(200),news_reguser varchar(45),news_regdate datetime,news_reguser_comp varchar(45),contents LONGTEXT, img_url varchar(500),img_url_flag char(1),file_url varchar(500), cate varchar(3), c_cate varchar(5), visible char(1), site_gubun varchar(3) )
		BEGIN
		INSERT INTO SS_NEWS(SUBJECT,NEWS_REGUSER, NEWS_REGDATE,NEWS_REGUSER_COMP ,CONTENTS_,IMG_URL,IMG_URL_FLAG,FILE_URL,CATE ,C_CATE,VISIBLE,SITE_GUBUN, REGDATE, REGUSER) VALUES(subject,news_reguser,news_regdate,news_reguser_comp, contents,img_url,img_url_flag,file_url,cate,c_cate,visible ,site_gubun, now(), 101);
		END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertNews"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL insertNews('".$subject ."','".$news_reguser."','".$news_regdate."','".$news_reguser_comp."','".$contents."','".$img_url."','".$img_url_flag."','".$file_url."','".$cate."','".$c_cate."','".$visible."','".$site_gubun."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
    }
    
    
    
    // action 수정 버튼을 눌렀을 때
    if($_POST["action"] == "수정")
    {
        
        $subject=mysqli_real_escape_string($connect,$_POST["subject"]);
        $news_reguser=mysqli_real_escape_string($connect,$_POST["news_reguser"]);
        $news_reguser_comp=mysqli_real_escape_string($connect,$_POST["news_reguser_comp"]);
        $news_regdate=mysqli_real_escape_string($connect,$_POST["news_regdate"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $img_url=mysqli_real_escape_string($connect,$_POST["img_url"]);
        $img_url_flag=mysqli_real_escape_string($connect,$_POST["img_url_flag"]);
        $file_url=mysqli_real_escape_string($connect,$_POST["file_url"]);
        $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
        $c_cate=mysqli_real_escape_string($connect,$_POST["c_cate"]);
        $visible=mysqli_real_escape_string($connect,$_POST["visible"]);
        $site_gubun=mysqli_real_escape_string($connect,$_POST["site_gubun"]);
        
        $procedure = "
		CREATE PROCEDURE updateNews(IN user_id int(111), subject varchar(200),news_reguser varchar(45),news_regdate datetime,news_reguser_comp varchar(45),contents LONGTEXT, img_url varchar(500),img_url_flag char(1),file_url varchar(500), cate varchar(3), c_cate varchar(5), visible char(1), site_gubun varchar(3) )
		BEGIN
		UPDATE SS_NEWS SET SUBJECT = subject, NEWS_REGUSER = news_reguser, NEWS_REGUSER_COMP = news_reguser_comp,
		NEWS_REGDATE = news_regdate, IMG_URL = img_url, IMG_URL_FLAG = img_url_flag,FILE_URL = file_url,CATE=cate , C_CATE=c_cate,VISIBLE=visible, CONTENTS_ = contents,SITE_GUBUN=site_gubun
		WHERE ID = user_id;
		END;
		";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS updateNews"))
        {
            if(mysqli_query($connect, $procedure))
            {
                $query = "CALL updateNews('".$_POST["id"]."','".$subject ."','".$news_reguser."','".$news_regdate."','".$news_reguser_comp."','".$contents."','".$img_url."','".$img_url_flag."','".$file_url."','".$cate."','".$c_cate."','".$visible."','".$site_gubun."')";
                mysqli_query($connect, $query);
                echo '수정 되었습니다.';
            }
        }
        
    }
    
    
    // action 삭제 버튼을 눌렀을 때
    if($_POST["action"] == "delete")
    {
        $procedure = "
		CREATE PROCEDURE deleteNews(IN user_id int(100))
		BEGIN
		DELETE FROM SS_NEWS WHERE id = user_id;
		END;
		";
        
        if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteNews"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL deleteNews('".$_POST["id"]."')";
                mysqli_query($connect, $query);
                echo '삭제완료';
            }
        }
        
    }
    
    
    
    
}

?>
