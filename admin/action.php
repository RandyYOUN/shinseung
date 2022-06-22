<?php
include "db_info.php";

/*알림톡 발송 로그*/
function send_kakao_log($biz_id, $mobile, $temp_id, $sender_id, $send_step,$send_flag,$send_flag2,$userid){
    
    //$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
    //$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    
    $procedure = "
			CREATE PROCEDURE `INSERT_TB700001`(IN P_BIZ_ID INT,
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




$SET_YEAR = 2021;

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
    
    //$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    //$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    
    
    
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
    
    
    //부양가족_등록 : 시작
    if($_POST["action"] == "action_mymenu_del"){
        
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $procedure = "
			CREATE PROCEDURE DEL_MYMENU(
IN P_ID INT(11)
 )
			BEGIN
                DELETE FROM TB600050 WHERE ID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS DEL_MYMENU"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL DEL_MYMENU('".$id."')";
                //프로시저 호출
                
                try {
                    mysqli_query($connect,$query);
                    echo '삭제완료';
                } catch (Exception $e) {
                    echo 'error : ' .$e;
                }
                
                
            }
        }
        
    }
    //부양가족 등록 : 끝
    
    
    
    //FAQ노트 전문상담_등록 : 시작
    if($_POST["action"] == "action_tok_cst_save"){
        
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $sec_type=mysqli_real_escape_string($connect,$_POST["sec_type"]);
        $total_paid=mysqli_real_escape_string($connect,$_POST["total_paid"]);
        $hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
        $hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
        $reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
        $memo=mysqli_real_escape_string($connect,$_POST["memo"]);
        $est_tax=mysqli_real_escape_string($connect,$_POST["est_tax"]);
        $est_fee=mysqli_real_escape_string($connect,$_POST["est_fee"]);
        $inf_channel=mysqli_real_escape_string($connect,$_POST["inf_channel"]);
        
        $procedure = "
			CREATE PROCEDURE INSERT_TB100020_POP_CST_SAVE(
IN P_USERID INT(11),
P_CSTNAME VARCHAR(50),
P_MOBILE VARCHAR(45),
P_SECTOR VARCHAR(45),
P_TOTAL_PAID VARCHAR(45),
P_HOMETAXID VARCHAR(45),
P_HOMETAXPW VARCHAR(45),
P_REG_BRANCH VARCHAR(45),
P_MEMO TEXT,
P_EST_TAX INT,
P_EST_FEE INT,
P_INF_CHANNEL VARCHAR(50)
 )
BEGIN

DECLARE P_CSTID INT;
DECLARE P_BIZ_ID INT;
DECLARE P_CNT INT;
DECLARE P_CNT_TB100023 INT;

SELECT CSTID INTO P_CSTID FROM TB100020 
WHERE REPLACE(CSTNAME,' ','') = REPLACE(P_CSTNAME,' ','')
AND REPLACE(MOBILE , '-','') = REPLACE(P_MOBILE,'-','');

IF P_CSTID > 0 THEN
    UPDATE TB100020 SET SECTOR = P_SECTOR, HomeTaxID = P_HOMETAXID, HomeTaxPW = P_HOMETAXPW , EDTDATE=NOW()
    WHERE CSTID = P_CSTID;
ELSE
    INSERT INTO TB100020(CSTNAME,MOBILE, SECTOR, HomeTaxID, HomeTaxPW, REGDATE)
    SELECT REPLACE(P_CSTNAME,' ',''), REPLACE(P_MOBILE,'-',''),P_SECTOR, P_HOMETAXID, P_HOMETAXPW, NOW();

    SELECT last_insert_id() INTO P_CSTID; 
END IF;


SELECT BIZ_ID INTO P_BIZ_ID FROM TB100022
WHERE CST_TYPE = 'A1001'
AND CST_TYPE_YEAR = '$SET_YEAR'
AND CSTID = P_CSTID;


IF P_BIZ_ID > 0 THEN
    UPDATE TB100022 SET MEMO = P_MEMO, EDTDATE = NOW(), REG_BRANCH = P_REG_BRANCH, POP_AMOUNT_PAID = P_TOTAL_PAID, 
    EXP_PAY_TAX_SELF = P_EST_TAX, EST_FEE_SELF = P_EST_FEE,INF_PATH='전문상담' , INF_CHANNEL = P_INF_CHANNEL
    WHERE BIZ_ID = P_BIZ_ID;
ELSE
    INSERT INTO TB100022(CSTID, CST_TYPE,CST_TYPE_SEQ, CST_TYPE_YEAR, MEMO, REGDATE, REGUSER, INF_PATH,INF_CHANNEL, REG_BRANCH, POP_AMOUNT_PAID,EXP_PAY_TAX_SELF, EST_FEE_SELF)
    SELECT P_CSTID, 'A1001' ,'1','$SET_YEAR', P_MEMO, NOW(), P_USERID, '전문상담',P_INF_CHANNEL, P_REG_BRANCH, P_TOTAL_PAID, P_EST_TAX, P_EST_FEE;

    SELECT last_insert_id() INTO P_BIZ_ID;
END IF;

SELECT BIZ_ID INTO P_CNT_TB100023 FROM TB100023 WHERE BIZ_ID = P_BIZ_ID;

IF P_CNT_TB100023 > 0 THEN
    SELECT P_BIZ_ID;
ELSE
    INSERT INTO TB100023(BIZ_ID, CSTID)
    SELECT P_BIZ_ID, P_CSTID;
END IF;


SELECT COUNT(1) INTO P_CNT FROM TB100026
WHERE BIZ_ID = P_BIZ_ID;

IF P_CNT > 0 THEN
    UPDATE TB100026 SET PROGRESS='E7230', EDTDATE = NOW()
    WHERE BIZ_ID = P_BIZ_ID; 
ELSE
    INSERT INTO TB100026(BIZ_ID, REGDATE, PROGRESS)
    SELECT P_BIZ_ID, NOW(), 'E7230';
END IF;


END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB100020_POP_CST_SAVE"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_TB100020_POP_CST_SAVE('".$userid."','".$cstname."','".$mobile."','".$sec_type."','".$total_paid."','".$hometaxid."','".$hometaxpw."','".$reg_branch."','".$memo."',".$est_tax.",".$est_fee.",'".$inf_channel."')";
                //프로시저 호출
                
                try {
                    mysqli_query($connect,$query);
                    echo '등록완료';
                } catch (Exception $e) {
                    echo 'error : ' .$e;
                }
                
                
            }
        }
        
    }
    //FAQ노트 전문상담_등록 : 끝
    
    
    
    
    
    //FAQ노트 전화 상담_등록 : 시작
    if($_POST["action"] == "action_phone_cst_save_p"){
        
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $sector=mysqli_real_escape_string($connect,$_POST["sector"]);
        $hometaxid=mysqli_real_escape_string($connect,$_POST["hometaxid"]);
        $hometaxpw=mysqli_real_escape_string($connect,$_POST["hometaxpw"]);
        $total_paid=mysqli_real_escape_string($connect,$_POST["total_paid"]);
        $dvdnIncAmtYn=mysqli_real_escape_string($connect,$_POST["dvdnIncAmtYn"]);
        $intrIncAmtYn=mysqli_real_escape_string($connect,$_POST["intrIncAmtYn"]);
        $dblErinAmtYn=mysqli_real_escape_string($connect,$_POST["dblErinAmtYn"]);
        $erinAmtYn=mysqli_real_escape_string($connect,$_POST["erinAmtYn"]);
        $pnsnIncAmtYn=mysqli_real_escape_string($connect,$_POST["pnsnIncAmtYn"]);
        $etcIncAmtYn=mysqli_real_escape_string($connect,$_POST["etcIncAmtYn"]);
        $memo=mysqli_real_escape_string($connect,$_POST["memo"]);
        $est_tax=mysqli_real_escape_string($connect,$_POST["est_tax"]);
        $est_fee=mysqli_real_escape_string($connect,$_POST["est_fee"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        $reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
        $pro_flag=mysqli_real_escape_string($connect,$_POST["pro_flag"]);
        
        $PRO_COUNS = "";
        
        if($pro_flag=="Y")
            $PRO_COUNS="전문상담";
        else 
            $PRO_COUNS="";
        
        if($est_fee==NaN) $est_fee=0;
        if($est_tax==NaN) $est_tax=0;
        
        $procedure = "
			CREATE PROCEDURE INSERT_TB100020_POP_CST_SAVE_P(
P_CSTNAME VARCHAR(50),
P_MOBILE VARCHAR(45),
P_SECTOR VARCHAR(45),
P_HOMETAXID VARCHAR(45),
P_HOMETAXPW VARCHAR(45),
P_TOTAL_PAID VARCHAR(45),
P_DVDN VARCHAR(1),
P_INTR VARCHAR(1),
P_DBLE VARCHAR(1),
P_ERIN VARCHAR(1),
P_PNSN VARCHAR(1),
P_ETCI VARCHAR(1),
P_MEMO TEXT,
P_EST_TAX INT,
P_EST_FEE INT,
P_USERID INT(11),
P_REG_BRANCH VARCHAR(5)
 )
BEGIN

DECLARE P_CSTID INT;
DECLARE P_BIZ_ID INT;
DECLARE P_CNT INT;

SELECT CSTID INTO P_CSTID FROM TB100020
WHERE REPLACE(CSTNAME,' ','') = REPLACE(P_CSTNAME,' ','')
AND REPLACE(MOBILE , '-','') = REPLACE(P_MOBILE,'-','');

IF IFNULL(P_CSTID,'') <> '' THEN
    UPDATE TB100020 SET SECTOR = P_SECTOR, HomeTaxID = P_HOMETAXID, HomeTaxPW = P_HOMETAXPW , EDTDATE=NOW()
    WHERE CSTID = P_CSTID;
ELSE
    INSERT INTO TB100020(CSTNAME,MOBILE, SECTOR, HomeTaxID, HomeTaxPW, REGDATE)
    SELECT REPLACE(P_CSTNAME,' ',''), REPLACE(P_MOBILE,'-',''),P_SECTOR, P_HOMETAXID, P_HOMETAXPW, NOW();
    
    SELECT last_insert_id() INTO P_CSTID;
END IF;


SELECT BIZ_ID INTO P_BIZ_ID FROM TB100022
WHERE CST_TYPE = 'A1001'
AND CST_TYPE_YEAR = '$SET_YEAR'
AND CSTID = P_CSTID;


IF IFNULL(P_BIZ_ID,'') <> '' THEN
    UPDATE TB100022 SET MEMO = P_MEMO, EDTDATE = NOW(), REG_BRANCH = P_REG_BRANCH, POP_AMOUNT_PAID = P_TOTAL_PAID, 
    EXP_PAY_TAX_SELF = P_EST_TAX, EST_FEE_SELF = P_EST_FEE
    WHERE BIZ_ID = P_BIZ_ID;
ELSE
    INSERT INTO TB100022(CSTID, CST_TYPE,CST_TYPE_SEQ, CST_TYPE_YEAR, MEMO, REGDATE, REGUSER, INF_PATH,INF_CHANNEL, REG_BRANCH, POP_AMOUNT_PAID,EXP_PAY_TAX_SELF, EST_FEE_SELF)
    SELECT P_CSTID, 'A1001' ,'1','$SET_YEAR', P_MEMO, NOW(), P_USERID, '$PRO_COUNS','전화', P_REG_BRANCH, P_TOTAL_PAID, P_EST_TAX, P_EST_FEE;
    
    SELECT last_insert_id() INTO P_BIZ_ID;
END IF;

SELECT COUNT(1) INTO P_CNT FROM TB100026
WHERE BIZ_ID = P_BIZ_ID;

IF P_CNT > 0 THEN
    UPDATE TB100026 SET PROGRESS='E7230', EDTDATE = NOW()
    WHERE BIZ_ID = P_BIZ_ID;
ELSE
    INSERT INTO TB100026(BIZ_ID, REGDATE, PROGRESS)
    SELECT P_BIZ_ID, NOW(), 'E7230';
END IF;

CALL IN_UP_TB300030(P_CSTID, $SET_YEAR, P_INTR, P_DVDN, P_ERIN, P_DBLE, P_PNSN, P_ETCI);

END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB100020_POP_CST_SAVE_P"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_TB100020_POP_CST_SAVE_P('".$cstname."','".$mobile."','".$sector."','".$hometaxid."','".$hometaxpw."',
'".$total_paid."','".$dvdnIncAmtYn."','".$intrIncAmtYn."','".$dblErinAmtYn."','".$erinAmtYn."','".$pnsnIncAmtYn."','".$etcIncAmtYn."'
,'".$memo."',".$est_tax.",".$est_fee.",".$userid.",'".$reg_branch."')";
                //프로시저 호출
                
                try {
                    mysqli_query($connect,$query);
                    echo '등록완료';
                } catch (Exception $e) {
                    echo 'error : ' .$e;
                }
                
                
            }
        }
        
    }
    //FAQ노트 전화 상담_등록 : 끝
    
    
    
    //부양가족_등록 : 시작
    if($_POST["action"] == "action_add_memu"){
        
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $contents=mysqli_real_escape_string($connect,$_POST["contents"]);
        $subject=mysqli_real_escape_string($connect,$_POST["subject"]);
        $subject2=mysqli_real_escape_string($connect,$_POST["subject2"]);
        
        $procedure = "
			CREATE PROCEDURE ADD_MYMENU(
IN P_USERID INT(11),
P_SUBJECT VARCHAR(200),
P_SUBJECT2 VARCHAR(200),
P_CONTENT TEXT
 )
			BEGIN
                DECLARE P_CNT INT(11);

                SELECT IFNULL(MAX(MENU_IDX)+1,1) INTO P_CNT FROM TB600050 WHERE IND_USERID = P_USERID AND CATE='MY';
            				
                INSERT INTO TB600050(REGUSERID,REGDATE,CATE,MENU_IDX, MENU_NAME, REGUSER, CONTENT_, IND_USERID, SUBJECT)
                SELECT P_USERID, NOW(),'MY',P_CNT , P_SUBJECT, P_USERID, P_CONTENT, P_USERID, P_SUBJECT2;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS ADD_MYMENU"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL ADD_MYMENU('".$id."','".$subject."','".$subject2."','".$contents."')";
                //프로시저 호출
                
                try {
                    mysqli_query($connect,$query);
                    echo '등록완료';
                } catch (Exception $e) {
                    echo 'error : ' .$e;
                }
                
                
            }
        }
        
    }
    //부양가족 등록 : 끝
    
    
    
    
    
    //부양가족_등록 : 시작
    if($_POST["action"] == "insert_family"){
        $fam_relation=mysqli_real_escape_string($connect,$_POST["fam_relation"]);
        $fam_name=mysqli_real_escape_string($connect,$_POST["fam_name"]);
        $fam_resident_id=mysqli_real_escape_string($connect,$_POST["fam_resident_id"]);
        $fam_disabled=mysqli_real_escape_string($connect,$_POST["fam_disabled"]);
        $fam_woman=mysqli_real_escape_string($connect,$_POST["fam_woman"]);
        $fam_single=mysqli_real_escape_string($connect,$_POST["fam_single"]);
        $is_school=mysqli_real_escape_string($connect,$_POST["is_school"]);
        $fam_birth_adoption=mysqli_real_escape_string($connect,$_POST["fam_birth_adoption"]);
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        
        $procedure = "
			CREATE PROCEDURE INSERT_FAMILY(IN P_ID INT(11),P_RELATION VARCHAR(10) , P_FAM_NAME VARCHAR(20), P_RESIDENT_ID VARCHAR(45),
P_DISABLED VARCHAR(10),P_WOMAN VARCHAR(10), P_SINGLE VARCHAR(10), P_SCHOOL VARCHAR(10),P_BIRTH_ADOPTION VARCHAR(10)
 )
			BEGIN
            
				DECLARE TMP_BIZ_ID INT(11);
            
				SELECT BIZ_ID INTO TMP_BIZ_ID FROM TB100022 WHERE CSTID = P_ID AND CST_TYPE_YEAR = date_format(NOW(),'%Y')-1 AND CST_TYPE='A1001';
            
				INSERT INTO TB310040(CSTID ,BIZ_ID ,RELATION ,FAM_NAME ,RESIDENT_ID ,DISORDER ,WOMAN ,SINGLE_PARENT,IS_SCHOOL ,BIRTH_ADOPTION , REGDATE)
                SELECT P_ID, TMP_BIZ_ID, P_RELATION , P_FAM_NAME , P_RESIDENT_ID , P_DISABLED, P_WOMAN , P_SINGLE, P_SCHOOL, P_BIRTH_ADOPTION, now();
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_FAMILY"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_FAMILY('".$id."','".$fam_relation."','".$fam_name."','".$fam_resident_id."','".$fam_disabled."','".$fam_woman."','".$fam_single."','".$is_school."','".$fam_birth_adoption."')";
                //프로시저 호출
                
                try {
                    mysqli_query($connect,$query);
                    echo 'insert_ok';
                } catch (Exception $e) {
                    echo 'error : ' .$e;
                }
                
                
            }
        }
        
    }
    //부양가족 등록 : 끝
    
    
    
    
    //부양가족 삭제 : 시작
    if($_POST["action"] == "del_family"){
        $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
        $str=mysqli_real_escape_string($connect,$_POST["str"]);
        
        $procedure = "
			CREATE PROCEDURE DEL_FAMILY(IN P_CSTID INT(11),P_ID INT(11) )
			BEGIN
            
				DELETE FROM TB310040 WHERE CSTID = P_CSTID AND ID = P_ID;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS DEL_FAMILY"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL DEL_FAMILY('".$cstid."','".$str."')";
                //프로시저 호출
                
                try {
                    mysqli_query($connect,$query);
                    echo 'delete_ok';
                } catch (Exception $e) {
                    echo 'error : ' .$e;
                }
                
                
            }
        }
        
    }
    //부양가족 등록 : 끝
    
    
    
    //자동 장부페이지 경비율조정 update 
    if($_POST["action"] == "update_user_ratio"){
        $cstid=$_POST["id"];
        $user_ratio=$_POST["user_ratio"];
        
        $procedure = "
			CREATE PROCEDURE UPT_USER_RATIO(IN P_ID INT, P_USER_RATIO INT )
			BEGIN
                UPDATE TB100022 SET USER_RATIO = P_USER_RATIO
                WHERE CSTID = P_ID
                AND CST_TYPE = 'A1001'
                AND CST_TYPE_YEAR = $SET_YEAR;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_USER_RATIO"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_USER_RATIO('".$cstid."','".$user_ratio."')";
                mysqli_query($connect,$query_upt);
                echo "ok";
            }
        }
        
    }
    //자동 장부페이지 경비율조정 update : 끝
    
    
    
    
    //가계부 옵션값 수정 : 시작
    if($_POST["action"] == "upt_money_select"){
        $p_id=$_POST["id"];
        $p_dept=$_POST["dept"];
        $p_code=$_POST["code"];
        $p_value=$_POST["value"];
        $p_money=$_POST["money"];
        $p_pay=$_POST["pay"];
        $p_user=$_POST["user"];
        
        $procedure = "
			CREATE PROCEDURE UPT_MONEY_SELECT(IN P_ID INT, P_DEPT VARCHAR(50), P_CODE VARCHAR(50), 
            P_VALUE VARCHAR(50), P_MONEY VARCHAR(50), P_PAY VARCHAR(50), P_USER VARCHAR(50) )
			BEGIN
                UPDATE TB750020_Y SET DEPT = P_DEPT , CODE_ = P_CODE, VALUE_ = P_VALUE, MONEY=P_MONEY, PAY_FLAG=P_PAY,
                INSERT_USER = P_USER
                WHERE ID = P_ID;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_MONEY_SELECT"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_MONEY_SELECT('".$p_id."','".$p_dept."','".$p_code."','".$p_value."','".$p_money."','".$p_pay."','".$p_user."')";
                mysqli_query($connect,$query_upt);
                echo "ok";
            }
        }
        
    }
    //가계부 필드값 수정 : 끝
    
    
    //가계부 옵션값 수정 : 시작
    if($_POST["action"] == "del_money"){
        $p_id=$_POST["id"];
        
        $procedure = "
			CREATE PROCEDURE DEL_MONEY(IN P_ID INT)
			BEGIN
                DELETE FROM TB750020_Y WHERE ID = P_ID;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS DEL_MONEY"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL DEL_MONEY('".$p_id."')";
                mysqli_query($connect,$query_upt);
                echo "ok";
            }
        }
        
    }
    //가계부 필드값 수정 : 끝
    
    
    
    //가계부 옵션값 수정 : 시작
    if($_POST["action"] == "upt_money_opt"){
        $p_id=$_POST["id"];
        $p_value=$_POST["value"];
        $p_flag=$_POST["flag"];
        
        
        $procedure = "
			CREATE PROCEDURE UPT_MONEY(IN P_ID INT, P_FLAG VARCHAR(50), P_VALUE VARCHAR(50) )
			BEGIN
                IF P_FLAG = 'MONEY' THEN
                    UPDATE TB750020_Y SET MONEY = P_VALUE WHERE ID = P_ID;
                ELSEIF P_FLAG ='VALUE' THEN
                    UPDATE TB750020_Y SET VALUE_ = P_VALUE WHERE ID = P_ID;
                ELSEIF P_FLAG ='USER' THEN
                    UPDATE TB750020_Y SET INSERT_USER = P_VALUE WHERE ID = P_ID;
                ELSEIF P_FLAG ='DATE' THEN
                    UPDATE TB750020_Y SET REGDATE = P_VALUE WHERE ID = P_ID;
                END IF;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_MONEY"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_MONEY('".$p_id."','".$p_flag."','".$p_value."')";
                mysqli_query($connect,$query_upt);
                echo "ok";
            }
        }
        
    }
    //가계부 필드값 수정 : 끝
    
    
    if($_POST["action"] == "upt_name_kakao_vat"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $p_name=mysqli_real_escape_string($connect,$_POST["name"]);
        
        $procedure = "
			CREATE PROCEDURE UPT_NAME_KAKAO(IN p_id INT, p_name LONGTEXT)
			BEGIN
				UPDATE TB100020 SET KAKAO_SEND_NAME = p_name WHERE CSTID = p_id;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_NAME_KAKAO"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_NAME_KAKAO('".$p_id."','".$p_name."')";
                mysqli_query($connect,$query_upt);
                //echo "수정되었습니다.";
            }
        }
    }
    
    
    
    //양도 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_disc_upt_prog"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $prog=mysqli_real_escape_string($connect,$_POST["prog"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        
        $procedure = "
			CREATE PROCEDURE UPDATE_DISC_PROG(IN P_ID INT(11), P_PROG VARCHAR(5), P_USERID INT(11) )
			BEGIN
            
				UPDATE TB980090 SET PROGRESS=P_PROG, PROG_EDTUSER = P_USERID, EDTDATE = NOW()
				WHERE USERID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_DISC_PROG"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_DISC_PROG('".$id."','".$prog."','".$userid."')";
                //프로시저 호출
                if(mysqli_query($connect,$query)){
                    echo "true";
                }else{
                    echo "false";
                }
                //echo $query;
                
            }
        }
        
    }
    //양도 리스트 옵션값 수정 : 끝
    
    
    
    //disc_평가_수정 시작
    if($_POST["action"] == "insert_money"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $use_text=mysqli_real_escape_string($connect,$_POST["use_text"]);
        $money=mysqli_real_escape_string($connect,$_POST["money"]);
		$dept=mysqli_real_escape_string($connect,$_POST["dept"]);
		$code_=mysqli_real_escape_string($connect,$_POST["code_"]);
		$pay_flag = mysqli_real_escape_string($connect,$_POST["pay_flag"]);

		/*
		use_text:use_text,money:money,action:action, id:id, dept, dept
		*/
        
        $procedure = "
			CREATE PROCEDURE INSERT_MONEY(IN P_ID VARCHAR(20) ,P_USE_TEXT varchar(45) ,P_MONEY INT ,P_DEPT VARCHAR(50), P_CODE_ VARCHAR(5), P_PAY_FLAG VARCHAR(4) )
			BEGIN
                DECLARE TMP_CODE VARCHAR(5);
                DECLARE TMP_DEPT VARCHAR(20);

                IF P_DEPT = 'type1' THEN
                    INSERT INTO TB750020_Y(DEPT ,CODE_ ,VALUE_ ,INSERT_USER ,MONEY, REGDATE, PAY_FLAG)
                    SELECT P_DEPT, P_CODE_, P_USE_TEXT, P_ID,P_MONEY, NOW(), P_PAY_FLAG;
                ELSE
                    SET TMP_CODE = P_DEPT;
                    SET TMP_DEPT = 'type2';

                    INSERT INTO TB750020_Y(DEPT ,CODE_ ,VALUE_ ,INSERT_USER ,MONEY, REGDATE, PAY_FLAG)
                    SELECT TMP_DEPT, TMP_CODE, P_USE_TEXT, P_ID,P_MONEY, NOW(), P_PAY_FLAG;
                
                END IF;

                
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_MONEY"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                
                $query = "CALL INSERT_MONEY('".$id."','".$use_text."','".$money."','".$dept."','".$code_."','".$pay_flag."')";
                //프로시저 호출
                
                try{
                    mysqli_query($connect,$query);
                    echo 'success';
                }catch(Exception $e){
                    echo $e;
                }
            }
        }
        
    }
    //disc_평가_수정 : 끝


    
    //disc_평가_수정 시작
    if($_POST["action"] == "action_disc_update"){
        $cstid=mysqli_real_escape_string($connect,$_POST["id"]);
        $file_real_str=mysqli_real_escape_string($connect,$_POST["file_real_str"]);
        $file_view_str=mysqli_real_escape_string($connect,$_POST["file_view_str"]);
		$birth=mysqli_real_escape_string($connect,$_POST["birth"]);
		$age=mysqli_real_escape_string($connect,$_POST["age"]);
		$car_year=mysqli_real_escape_string($connect,$_POST["car_year"]);
		$car_month=mysqli_real_escape_string($connect,$_POST["car_month"]);
		$new_begin=mysqli_real_escape_string($connect,$_POST["new_begin"]);
		$total_car_year=mysqli_real_escape_string($connect,$_POST["total_car_year"]);
		$total_car_month=mysqli_real_escape_string($connect,$_POST["total_car_month"]);
		$total_new_begin=mysqli_real_escape_string($connect,$_POST["total_new_begin"]);
		$eval_userid=mysqli_real_escape_string($connect,$_POST["eval_userid"]);
		$final_edu=mysqli_real_escape_string($connect,$_POST["final_edu"]);
		$final_school=mysqli_real_escape_string($connect,$_POST["final_school"]);
		$impression=mysqli_real_escape_string($connect,$_POST["impression"]);
		$desire=mysqli_real_escape_string($connect,$_POST["desire"]);
		$knowledge=mysqli_real_escape_string($connect,$_POST["knowledge"]);
		$ability=mysqli_real_escape_string($connect,$_POST["ability"]);
		$physical=mysqli_real_escape_string($connect,$_POST["physical"]);
		$total_eval=mysqli_real_escape_string($connect,$_POST["total_eval"]);
		$hope_money=mysqli_real_escape_string($connect,$_POST["hope_money"]);
		$include_sev=mysqli_real_escape_string($connect,$_POST["include_sev"]);
		$interview_comment=mysqli_real_escape_string($connect,$_POST["interview_comment"]);
		$interview_report=mysqli_real_escape_string($connect,$_POST["interview_report"]);
		$interview_date=mysqli_real_escape_string($connect,$_POST["interview_date"]);
		$branch_disc=mysqli_real_escape_string($connect,$_POST["branch_disc"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_DISC(IN P_USERID int ,P_BRANCH varchar(45) ,P_BIRTH datetime ,P_AGE int ,P_CAREER_YEAR int ,P_CAREER_MONTH int ,P_TOTAL_CAR_YEAR int ,P_TOTAL_CAR_MONTH int ,P_NEW_BEGIN char(1) ,P_TOTAL_NEW_BEGIN char(1) ,P_EVAL_USERID int ,P_FINAL_EDU varchar(5) ,P_FINAL_SCHOOL varchar(45) ,P_IMPRESSION varchar(5) ,P_DESIRE varchar(5) ,P_KNOWLEDGE varchar(5) ,P_ABILITY varchar(5) ,P_PHYSICAL varchar(5) ,P_TOTAL_EVAL varchar(5) ,P_HOPE_MONEY int ,P_INCLUDE_SEV char(1) ,P_INTERVIEW_REPORT varchar(5) ,P_INTERVIEW_COMMENT varchar(450) ,P_FILE_REAL_STR varchar(1000) ,P_FILE_VIEW_STR varchar(1000),
            P_INTERVIEW_DATE DATETIME)
			BEGIN
		
				UPDATE TB980090 SET
				EDTDATE=NOW(),
				BRANCH=P_BRANCH,
				BIRTH = P_BIRTH,
				AGE=P_AGE,
				CAREER_YEAR=P_CAREER_YEAR,
				CAREER_MONTH=P_CAREER_MONTH,
				TOTAL_CAR_YEAR=P_TOTAL_CAR_YEAR,
				TOTAL_CAR_MONTH=P_TOTAL_CAR_MONTH,
				NEW_BEGIN = P_NEW_BEGIN,
				TOTAL_NEW_BEGIN=P_TOTAL_NEW_BEGIN,
				EVAL_USERID=P_EVAL_USERID,
				FINAL_EDU=P_FINAL_EDU,
				FINAL_SCHOOL=P_FINAL_SCHOOL,
				IMPRESSION=P_IMPRESSION,
				DESIRE=P_DESIRE,
				KNOWLEDGE=P_KNOWLEDGE,
				ABILITY=P_ABILITY,
				PHYSICAL=P_PHYSICAL,
				TOTAL_EVAL=P_TOTAL_EVAL,
				HOPE_MONEY=P_HOPE_MONEY,
				INCLUDE_SEV=P_INCLUDE_SEV,
				INTERVIEW_REPORT=P_INTERVIEW_REPORT,
				INTERVIEW_COMMENT=P_INTERVIEW_COMMENT,
                INTERVIEW_DATE=P_INTERVIEW_DATE,
				FILE_REAL_STR=P_FILE_REAL_STR,
				FILE_VIEW_STR=P_FILE_VIEW_STR
				WHERE USERID = P_USERID ;
            
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_DISC"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                
                $query = "CALL UPDATE_DISC('".$cstid."','".$branch_disc."','".$birth."','".$age."','".$car_year."','".$car_month."','".$total_car_year."','".$total_car_month."','".$new_begin."','".$total_new_begin."','".$eval_userid."','".$final_edu."','".$final_school."','".$impression."','".$desire."','".$knowledge."','".$ability."','".$physical."','".$total_eval."','".$hope_money."','".$include_sev."','".$interview_report."','".$interview_comment."','".$file_real_str."','".$file_view_str."','".$interview_date."')";
                //프로시저 호출
                
                try{
                    mysqli_query($connect,$query);
                    echo '수정 되었습니다.';
                }catch(Exception $e){
                    echo $e;
                }
                
                //echo '수정 되었습니다.';
            }
        }
        
    }
    //disc_평가_수정 : 끝
    
    
    
    //댓글삭제 : 시작
    if($_POST["action"] == "action_trans_del_comment"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        //echo $count;
        try{
            
            $procedure = "
        			CREATE PROCEDURE DEL_COMMENT_TRANS(IN P_ID INT,P_USERID INT)
        			BEGIN
                        UPDATE TB600042 SET VISIBLE = 'N', DEL_DATE=NOW(), DEL_USER=P_USERID
                        WHERE ID = P_ID;
        			END
        		";
            
            //기존에 프로시저가 있으면 삭제
            if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS DEL_COMMENT_TRANS"))
            { //위에서 만든 프로시저 실행
                if(mysqli_query($connect,$procedure))
                {
                    $query = "CALL DEL_COMMENT_TRANS('".$id."','".$userid."')";
                    //프로시저 호출
                    if(mysqli_query($connect,$query)){
                        echo 'success';
                    }else{
                        echo '에러발생.';
                    }
                    
                }
            }
            
            
        }
        catch(Exception $e){
            
            echo $e;
        }
        
        
    }
    //댓글삭제 : 끝
    
    //댓글등록_ : 시작
    if($_POST["action"] == "action_trans_insert_comment"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        $comment=mysqli_real_escape_string($connect,$_POST["comment"]);
		$b_flag = mysqli_real_escape_string($connect,$_POST["b_flag"]);
        
        //echo $count;
        try{
            
            $procedure = "
        			CREATE PROCEDURE INSERT_COMMENT_TRANS(IN P_ID INT,P_USERID INT, P_CMT VARCHAR(1000) , P_BOARD_FLAG VARCHAR(5))
        			BEGIN
                        INSERT INTO TB600042(CSTID,REGUSER,REGDATE,COMMENT, BOARD_FLAG)
                        SELECT P_ID, P_USERID, NOW(),P_CMT,P_BOARD_FLAG;
        			END
        		";
            
            //기존에 프로시저가 있으면 삭제
            if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_COMMENT_TRANS"))
            { //위에서 만든 프로시저 실행
                if(mysqli_query($connect,$procedure))
                {
                    $query = "CALL INSERT_COMMENT_TRANS('".$id."','".$userid."','".$comment."','".$b_flag."')";
                    //프로시저 호출
                    if(mysqli_query($connect,$query)){
                        echo 'success';
                    }else{
                        echo '에러발생.';
                    }
                }
            }
            
            
        }
        catch(Exception $e){
            
            echo $e;
        }
        
        
    }
    //댓글등록 : 끝
    
    
    //disc 진행상태 변경 : 시작
    if($_POST["action"] == "action_trans_prog_upt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $prog=mysqli_real_escape_string($connect,$_POST["prog"]);
        
        //echo $count;
        try{
            
            $procedure = "
        			CREATE PROCEDURE UPT_PROG_TB600040(IN P_ID INT,P_PROG VARCHAR(5) )
        			BEGIN
                        UPDATE TB600010 SET PROGRESS = P_PROG WHERE ID=P_ID;
        			END
        		";
            
            //기존에 프로시저가 있으면 삭제
            if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_PROG_TB600040"))
            { //위에서 만든 프로시저 실행
                if(mysqli_query($connect,$procedure))
                {
                    $query = "CALL UPT_PROG_TB600040('".$id."','".$prog."')";
                    //프로시저 호출
                    if(mysqli_query($connect,$query)){
                        echo 'success';
                    }else{
                        echo '에러발생.';
                    }
                    
                }
            }
            
            
        }
        catch(Exception $e){
            
            echo $e;
        }
        
        
    }
    // : 끝


    // : 시작
    if($_POST["action"] == "action_trans_prog_upt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $prog=mysqli_real_escape_string($connect,$_POST["prog"]);
        
        //echo $count;
        try{
            
            $procedure = "
        			CREATE PROCEDURE UPT_PROG_TB600040(IN P_ID INT,P_PROG VARCHAR(5) )
        			BEGIN
                        UPDATE TB600010 SET PROGRESS = P_PROG WHERE ID=P_ID;
        			END
        		";
            
            //기존에 프로시저가 있으면 삭제
            if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_PROG_TB600040"))
            { //위에서 만든 프로시저 실행
                if(mysqli_query($connect,$procedure))
                {
                    $query = "CALL UPT_PROG_TB600040('".$id."','".$prog."')";
                    //프로시저 호출
                    if(mysqli_query($connect,$query)){
                        echo 'success';
                    }else{
                        echo '에러발생.';
                    }
                    
                }
            }
            
            
        }
        catch(Exception $e){
            
            echo $e;
        }
        
        
    }
    // : 끝
    
    
    
    //그룹 멤버 삭제 : 시작
    if($_POST["action"] == "delete_group_member"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        //echo $count;
        try{
                
                $procedure = "
        			CREATE PROCEDURE DEL_TB600040(IN P_GROUP_ID INT,P_USERID INT )
        			BEGIN
                        DELETE FROM TB600040 WHERE GROUP_ID = P_GROUP_ID AND USERID = P_USERID;
        			END
        		";
                
                //기존에 프로시저가 있으면 삭제
                if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS DEL_TB600040"))
                { //위에서 만든 프로시저 실행
                    if(mysqli_query($connect,$procedure))
                    {
                        $query = "CALL DEL_TB600040('".$id."','".$userid."')";
                        //프로시저 호출
                        if(mysqli_query($connect,$query)){
                            echo '삭제 되었습니다.';
                        }else{
                            echo '에러발생.';
                        }

                    }
                }
            
            
        }
        catch(Exception $e){
            
            echo $e;
        }
        
        
    }
    //그룹 멤버 삭제 : 끝
    
    
    
    
    
    
    //알림톡 발송 그룹 등록 : 시작
    if($_POST["action"] == "insert_group_member"){
        $group_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["userid"]);
        $check = $_POST['check'];
        $count = count($check);
        $ERROR_CNT = 0;
        $COMMIT_CNT = 0;
        $message = "";
        
        
        //echo $count;
        try{
            for($i=0;$i<$count;$i++){
                //echo $check[$i];
                
                $procedure = "
        			CREATE PROCEDURE INSERT_TB600040(IN P_GROUP_ID INT,P_USERID INT, P_REGUSER INT )
        			BEGIN
                        DECLARE TMP_CNT INT;
                        
                        SELECT COUNT(1) INTO TMP_CNT FROM TB600040 WHERE GROUP_ID = P_GROUP_ID 
                        AND USERID = P_USERID;

                        IF IFNULL(TMP_CNT,0) = 0 THEN 
                            
            				INSERT INTO TB600040(GROUP_ID,USERID,REGUSER,REGDATE )
                            SELECT P_GROUP_ID,P_USERID,P_REGUSER,NOW() ;

                        END IF;
                            
        			END
        		";
                
                //기존에 프로시저가 있으면 삭제
                if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB600040"))
                { //위에서 만든 프로시저 실행
                    if(mysqli_query($connect,$procedure))
                    {
                        $query = "CALL INSERT_TB600040('".$group_id."','".$check[$i]."','".$reguser."')";
                        //프로시저 호출
                        if(mysqli_query($connect,$query)){
                            $COMMIT_CNT++;
                        }else{
                            $ERROR_CNT++;
                        }
                        //echo '성공적으로 입력 되었습니다.';
                    }
                }
            }
            
        }
        catch(Exception $e){
            $ERROR_CNT++;
            $message .= $e;
        }
        
        if($count == $COMMIT_CNT){
            $message .= '성공적으로 입력 되었습니다.';
        }else{
            $message .= '진행중 오류가 발생하였습니다. 관리자에게 문의하여 주세요.';
        }
        
        echo $message;
        
    }
    //알림톡 발송 그룹 등록 : 끝
    
    
    
    //멘토멘티 삭제 : 시작
    if($_POST["action"] == "action_delete_relation"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        
        $procedure = "
			CREATE PROCEDURE ACTION_DEL_RELATION(IN P_ID INT )
			BEGIN
            
    			DELETE FROM TB980093 WHERE ID = P_ID;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS ACTION_DEL_RELATION"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL ACTION_DEL_RELATION('".$id."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '삭제 되었습니다.';
            }
        }
        
    }
    //멘토멘티 삭제 : 끝
    
    
    
    //멘토멘티 등록 : 시작
    if($_POST["action"] == "action_insert_relation"){
        $list_master=mysqli_real_escape_string($connect,$_POST["list_master"]);
        $list_slave=mysqli_real_escape_string($connect,$_POST["list_slave"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        $procedure = "
			CREATE PROCEDURE ACTION_INS_RELATION(IN P_MASTER INT, P_SLAVE INT, P_USERID INT )
			BEGIN
            
    			INSERT INTO TB980093(M_SLAVE, M_MASTER, REGDATE, REGUSER )
                SELECT P_SLAVE, P_MASTER, NOW(),P_USERID;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS ACTION_INS_RELATION"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL ACTION_INS_RELATION('".$list_master."','".$list_slave."','".$userid."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
        
    }
    //멘토멘티 등록 : 끝
    
    
    //알림톡 발송 그룹 등록 : 시작
    if($_POST["action"] == "action_group"){
        $group_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $group_name=mysqli_real_escape_string($connect,$_POST["group_name"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $use_yn=mysqli_real_escape_string($connect,$_POST["use_yn"]);
        $use_menu=mysqli_real_escape_string($connect,$_POST["use_menu"]);
        $etc=mysqli_real_escape_string($connect,$_POST["etc"]);
        $flag=mysqli_real_escape_string($connect,$_POST["flag"]);
        
        $procedure = "
			CREATE PROCEDURE ACTION_TB600041(IN P_GROUP_ID INT, P_GROUP_NAME VARCHAR(45),P_REGUSER INT, P_USE_YN char(1), P_ETC VARCHAR(1000), P_FLAG CHAR(1), P_USE_MENU_ID VARCHAR(5) )
			BEGIN
            
			DECLARE TMP INT(11) default 0;
            
			IF P_FLAG = 'I'
			THEN
				SELECT IFNULL( MAX(GROUP_ID),0)+1 INTO TMP FROM TB600041;
            
				INSERT INTO TB600041(GROUP_ID,GROUP_NAME, ETC,REGDATE,REGUSER,EDTDATE,EDTUSER, USE_YN, USE_MENU_ID ) 
                SELECT TMP,P_GROUP_NAME,P_ETC,NOW(),P_REGUSER,NOW(),P_REGUSER,P_USE_YN , P_USE_MENU_ID;
			
            ELSEIF P_FLAG = 'U'
			THEN
				UPDATE TB600041 SET
				GROUP_NAME=P_GROUP_NAME,
                ETC=P_ETC,
                USE_YN=P_USE_YN,
                EDTDATE=NOW(),
                EDTUSER=P_REGUSER,
                USE_MENU_ID = P_USE_MENU_ID
				WHERE GROUP_ID = P_GROUP_ID ;
			END IF;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS ACTION_TB600041"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL ACTION_TB600041('".$group_id."','".$group_name."','".$reguser."','".$use_yn."','".$etc."','".$flag."','".$use_menu."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '성공적으로 입력 되었습니다.';
            }
        }
        
    }
    //알림톡 발송 그룹 등록 : 끝
    
    
    
    
    //개발 : 시작
    if($_POST["action"] == "action_insert_disc_basic"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $username=mysqli_real_escape_string($connect,$_POST["username"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        $rep_flag=mysqli_real_escape_string($connect,$_POST["rep_flag"]);
        
        $procedure = "
CREATE PROCEDURE `INSERT_DISC_BASIC`(
	IN P_ID VARCHAR(20),
	P_USERNAME VARCHAR(50),
	P_MOBILE VARCHAR(25),
    P_BRANCH VARCHAR(25),
P_REP_FLAG CHAR(1)
 )
BEGIN
    DECLARE CNT INT;
    DECLARE TMP_ID INT;
            
	IF IFNULL(P_ID,'') <> '' THEN
        UPDATE TB980090 SET
    		USERNAME = P_USERNAME,
    		MOBILE=P_MOBILE,
            BRANCH=P_BRANCH,
            REP_FLAG = P_REP_FLAG,
    		EDTDATE = NOW()
		WHERE USERID = P_ID;

        SET TMP_ID = P_ID;
		
	ELSE
        SELECT USERID INTO TMP_ID FROM TB980090 
        WHERE REPLACE(USERNAME,' ','') = REPLACE(P_USERNAME,' ','') 
        AND REPLACE(MOBILE,'-','')=REPLACE(P_MOBILE,'-','');
        
        IF IFNULL(TMP_ID,0) <> 0 THEN
            UPDATE TB980090 SET
    		USERNAME = P_USERNAME,
    		MOBILE=P_MOBILE,
            BRANCH=P_BRANCH,
            REP_FLAG = P_REP_FLAG,
    		EDTDATE = NOW()
    		WHERE REPLACE(USERNAME,' ','') = REPLACE(P_USERNAME,' ','') 
            AND REPLACE(MOBILE,'-','')=REPLACE(P_MOBILE,'-','');
        ELSE
        	INSERT INTO TB980090(USERNAME,REGDATE,MOBILE,BRANCH,REP_FLAG)
        	SELECT P_USERNAME,NOW(),P_MOBILE, P_BRANCH, P_REP_FLAG;

            SELECT last_insert_id() INTO TMP_ID;
        END IF;
	END IF;

    SELECT TMP_ID;            
END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_DISC_BASIC"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_DISC_BASIC('".$id."','".$username."','".$mobile."','".$branch."','".$rep_flag."')";
                //프로시저 호출
                //mysqli_query($connect,$query);
                $result = mysqli_query($connect, $query);
                
                while($row = mysqli_fetch_array($result))
                {
                    $output['TMP_ID'] = $row["TMP_ID"];
                }
                
                echo json_encode($output);
            }
        }
        
    }
    //개발 : 끝
    
    
    
    
    //개발 : 시작
    if($_POST["action"] == "action_insert_disc_all"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $username=mysqli_real_escape_string($connect,$_POST["username"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $rep_flag=mysqli_real_escape_string($connect,$_POST["rep_flag"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        
        $procedure = "
CREATE PROCEDURE `INSERT_DISC_TOTAL`(
	IN P_USERID VARCHAR(20),
	P_USERNAME VARCHAR(50),
    P_MOBILE VARCHAR(30) ,
    P_BRANCH VARCHAR(25),
    P_REP_FLAG CHAR(1)
 )
BEGIN
   DECLARE TMP_ID int;
   DECLARE CNT int;
    DECLARE MAX_CNT INT;
    DECLARE MIN_CNT INT;
    DECLARE TMP_TYPE INT;
DECLARE TMP_G1_NUM INT;
DECLARE TMP_G2_NUM INT;
DECLARE TMP_G3_NUM INT;
DECLARE TMP_G1_TYPE VARCHAR(50);
DECLARE TMP_G2_TYPE VARCHAR(50);
DECLARE TMP_G3_TYPE VARCHAR(50);


    IF IFNULL(P_USERID,'') = '' THEN
        SELECT COUNT(1) INTO CNT FROM TB980090 WHERE USERNAME = P_USERNAME AND IFNULL(MOBILE,'') = IFNULL(P_MOBILE,'');

        IF IFNULL(CNT,0) > 0 THEN
            SELECT USERID INTO TMP_ID FROM TB980090 WHERE USERNAME = P_USERNAME AND MOBILE = P_MOBILE;
        ELSE
            INSERT INTO TB980090(USERNAME,REGDATE, MOBILE, BRANCH, REP_FLAG)
            SELECT P_USERNAME, NOW(),P_MOBILE, P_BRANCH,P_REP_FALG;
    
            SELECT last_insert_id() INTO TMP_ID;
        END IF;       
    ELSE
        SET TMP_ID = P_USERID;
    END IF; 

   
    SELECT COUNT(1) INTO MAX_CNT FROM TB980091 WHERE USERID = TMP_ID AND FLAG='max';
    SELECT COUNT(1) INTO MIN_CNT FROM TB980091 WHERE USERID = TMP_ID AND FLAG='min';
    
    IF MAX_CNT = 28 AND MIN_CNT = 28 THEN

        SET TMP_G1_NUM = CONCAT(G1_CAL_D(CAL_CNT(TMP_ID,'max','D')) ,G1_CAL_I(CAL_CNT(TMP_ID,'max','I')) ,G1_CAL_S(CAL_CNT(TMP_ID,'max','S')) ,G1_CAL_C(CAL_CNT(TMP_ID,'max','C')) );
        SET TMP_G2_NUM = CONCAT(G2_CAL_D(CAL_CNT(TMP_ID,'min','D')) ,G2_CAL_I(CAL_CNT(TMP_ID,'min','I')) ,G2_CAL_S(CAL_CNT(TMP_ID,'min','S')) ,G2_CAL_C(CAL_CNT(TMP_ID,'min','C')) );
        SET TMP_G3_NUM = CONCAT(G3_CAL_D(CAL_CNT(TMP_ID,'max','D') - CAL_CNT(TMP_ID,'min','D')),G3_CAL_I(CAL_CNT(TMP_ID,'max','I') - CAL_CNT(TMP_ID,'min','I')),G3_CAL_S(CAL_CNT(TMP_ID,'max','S') - CAL_CNT(TMP_ID,'min','S')),G3_CAL_C(CAL_CNT(TMP_ID,'max','C') - CAL_CNT(TMP_ID,'min','C')));
        SELECT TYPE INTO TMP_G1_TYPE FROM TB_DISC WHERE ID = TMP_G1_NUM;
        SELECT TYPE INTO TMP_G2_TYPE FROM TB_DISC WHERE ID = TMP_G2_NUM;
        SELECT TYPE INTO TMP_G3_TYPE FROM TB_DISC WHERE ID = TMP_G3_NUM;

        UPDATE TB980090 SET
        BRANCH = P_BRANCH,
        G1_NUM = TMP_G1_NUM, G1_TYPE = TMP_G1_TYPE,
        G2_NUM = TMP_G2_NUM, G2_TYPE = TMP_G2_TYPE,
        G3_NUM = TMP_G3_NUM, G3_TYPE = TMP_G3_TYPE,
        REP_FLAG = P_REP_FLAG
        WHERE USERID = TMP_ID;  

        UPDATE TB980090 SET 
        REP_TYPE = STR_REP_TYPE(TMP_ID)
        WHERE USERID = TMP_ID;
    END IF;
  
    SELECT TMP_ID;       
            
            
END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_DISC_TOTAL"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_DISC_TOTAL('".$id."','".$username."','".$mobile."','".$branch."','".$rep_flag."')";
                //프로시저 호출
                $result = mysqli_query($connect,$query);
                while($row = mysqli_fetch_array($result)){
                    $output['TMP_ID'] = $row["TMP_ID"];
                }
                
                echo json_encode($output);
            }
        }
        
    }
    //개발 : 끝
    
    
    
    
    
    //개발 : 시작
    if($_POST["action"] == "action_insert_disc"){
        $id=mysqli_real_escape_string($connect,$_POST["userid"]);
        $username=mysqli_real_escape_string($connect,$_POST["username"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $num=mysqli_real_escape_string($connect,$_POST["num"]);
        $flag=mysqli_real_escape_string($connect,$_POST["flag"]);
        $value=mysqli_real_escape_string($connect,$_POST["value"]);
        
        
        $procedure = "
CREATE PROCEDURE `INSERT_DISC`(
	IN P_USERID VARCHAR(20),
	P_USERNAME VARCHAR(50),
    P_MOBILE VARCHAR(30),
    P_NUM INT,
	P_FLAG VARCHAR(20),
    P_VALUE INT
 )
BEGIN
   DECLARE TMP_ID int;
   DECLARE CNT int;
DECLARE CNT2 int;

   IF IFNULL(P_USERID,'') <> '' THEN
        SELECT COUNT(1) INTO CNT2 FROM TB980091 WHERE USERID = P_USERID AND FLAG=P_FLAG AND NUM = P_NUM;

        IF IFNULL(CNT2,0)>0 THEN
            UPDATE TB980091 SET
            FLAG = P_FLAG,
            VALUE = P_VALUE,
            DISC = GET_DISC_VALUE(P_NUM, FLAG,P_VALUE)    		
		    WHERE USERID = P_USERID AND NUM = P_NUM AND FLAG=P_FLAG;
        ELSE
            INSERT INTO TB980091(USERID,NUM,FLAG,VALUE,DISC)
        	SELECT P_USERID, P_NUM, P_FLAG, P_VALUE, GET_DISC_VALUE(P_NUM, P_FLAG,P_VALUE);
        END IF;
                
	ELSE
        SELECT USERID INTO TMP_ID FROM TB980090 
        WHERE REPLACE(USERNAME,' ','') = REPLACE(P_USERNAME,' ','') 
        AND REPLACE(MOBILE,'-','')=REPLACE(P_MOBILE,'-','');
       
       SELECT COUNT(1) INTO CNT FROM TB980091 WHERE USERID = TMP_ID AND FLAG=P_FLAG AND NUM = P_NUM;
        
        IF IFNULL(CNT,0) <>  0 THEN
        	UPDATE TB980091 SET
        		VALUE = P_VALUE,
                DISC = GET_DISC_VALUE(P_NUM, P_FLAG,P_VALUE)    		
    		WHERE USERID = TMP_ID AND FLAG=P_FLAG AND NUM = P_NUM;
        ELSE
			INSERT INTO TB980091(USERID,NUM,FLAG,VALUE,DISC)
        	SELECT TMP_ID, P_NUM, P_FLAG, P_VALUE, GET_DISC_VALUE(P_NUM, P_FLAG,P_VALUE);
        END IF;

        
	END IF; 
            
	
            
END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_DISC"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_DISC('".$id."','".$username."','".$mobile."','".$num."','".$flag."','".$value."')";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo '작성완료';
            }
        }
        
    }
    //개발 : 끝

    
    
    if($_POST["action"]=="send_sms_self"){
        $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        //db연결 본인의 db 정보를 넣어준다!
        //$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
        //$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
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
        WHERE A.CSTID = P_CSTID AND B.CST_TYPE='A1001' AND B.CST_TYPE_YEAR=DATE_FORMAT(now(), '%Y')-1;
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
		CREATE PROCEDURE `INSERT_UPDATE_TB100020`(
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
            
            SELECT IFNULL(CSTID,'') INTO TMP_CSTID FROM TB100020 
            WHERE REPLACE(CSTNAME , ' ','') = REPLACE(P_CSTNAME,' ','') 
            AND REPLACE(MOBILE,'-','')=REPLACE(P_MOBILE,'-','');
            
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

            SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 WHERE CSTID = P_CSTID AND CST_TYPE='A1001' AND CST_TYPE_YEAR=$SET_YEAR;
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
            SELECT TMP_BIZID, NOW(), 'E7230';
		else
			UPDATE TB100026 SET PROGRESS='E7230', EDTDATE=NOW() WHERE BIZ_ID = TMP_BIZID;
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
CREATE PROCEDURE `INSERT_VAT_CST_ALL`(
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
    INF_PATH, INF_CHANNEL, REGDATE, EST_FEE, DEP_FEE,
    DEP_TYPE,DEP_DATE, CASH_REC, CASH_REC_DATE, SUBM_DATE, SUBM_DATE2,
    COMP_REG_DATE, DEC_REGUSER,REQ_E_REPORT,REQ_USER, REQ_DATE, COMP_DATE, NUM_E_REPORT,
    DEL_DATE_PAYMENT,DEL_TYPE_PAYMENT, CONF_DATE_PAYMENT, DOWN_PAYMENT, MEMO, REG_BRANCH)
    SELECT TMP_CSTID, P_COMP_NAME, P_BIZ_ID_NUM, P_COMP_ADDRESS,
    P_CST_TYPE, DATE_FORMAT(now(), '%Y'),'1', P_INF_PATH, P_INF_CHANNEL, NOW(),
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
            
CALL INSERT_TB100024(TMP_BIZ_ID,P_OPTION1,P_OPTION2,P_OPTION3,P_OPTION4,P_OPTION5,P_OPTION6,P_EST_FEE);
            
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
				WHERE REPLACE(CSTNAME, ' ','') = REPLACE(P_CSTNAME,' ','') 
                AND REPLACE(MOBILE,'-','')=REPLACE(P_MOBILE,'-','');
            
				IF CNT_CSTID = 0 THEN
					INSERT INTO TB100020(CSTNAME,MOBILE,RESIDENT_ID, HomeTaxID, HomeTaxPW, AGREEMENT,AG_REGDATE) 
                    VALUES(REPLACE(P_CSTNAME,' ',''),REPLACE(REPLACE(P_MOBILE,'-',''),' ',''),P_RESIDENT_ID, P_HOMETAXID, P_HOMETAXPW,'Y',NOW());
            
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
			CREATE PROCEDURE `INSERT_WRITE_CAL`(IN P_ID INT, P_CSTNAME VARCHAR(50), P_MOBILE VARCHAR(50),
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
	SELECT COUNT(1) INTO CNT FROM TB100020 
    WHERE REPLACE(CSTNAME,' ','') = REPLACE(P_CSTNAME,' ','') 
    AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');
    
    IF IFNULL(CNT,0) > 0 THEN 
		SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 WHERE CSTID = P_ID AND CST_TYPE='A1001' AND CST_TYPE_YEAR=DATE_FORMAT(now(), '%Y')-1;
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
			CREATE PROCEDURE `INSERT_UPDATE_TB300031`(IN P_CSTID INT, P_EXI_TAX DOUBLE, P_NPIP DOUBLE , P_PERSON_SAVE DOUBLE , 
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
			CREATE PROCEDURE `INSERT_TB300020`(IN P_CSTID INT, 
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
			CREATE PROCEDURE `DELETE_TB300020`(IN P_CSTID INT,P_IDX INT )
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
    
    
    
    if($_POST["action"] == "upt_memo_rpa_vat"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $p_memo=mysqli_real_escape_string($connect,$_POST["memo"]);
        
        $procedure = "
			CREATE PROCEDURE UPT_MEMO_TRANS(IN p_id INT, p_memo LONGTEXT)
			BEGIN
				UPDATE TB100022 SET MEMO = p_memo WHERE CSTID = p_id
                AND CST_TYPE = 'A1002'
                AND CST_TYPE_YEAR = DATE_FORMAT(NOW(), '%Y') ;
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
    
    
    
    
    
    if($_POST["action"] == "upt_pay_pro"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        $p_pay=mysqli_real_escape_string($connect,$_POST["pay"]);
        
        $procedure = "
			CREATE PROCEDURE UPT_EST_PAY_SELF_PRO(IN p_id INT, p_pay INT)
			BEGIN
				UPDATE TB100022 SET EXP_PAY_TAX_SELF = p_pay WHERE BIZ_ID = p_id;
			END;
			";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_EST_PAY_SELF_PRO"))
        {
            if(mysqli_query($connect,$procedure))
            {
                $query_upt = "CALL UPT_EST_PAY_SELF_PRO('".$p_id."','".$p_pay."')";
                mysqli_query($connect,$query_upt);
                //echo "수정되었습니다.";
            }
        }
    }
    
    
    
    
    
    if($_POST["action"] == "upt_subm"){
        $p_id=mysqli_real_escape_string($connect,$_POST["id"]);
        
        $procedure = "
			CREATE PROCEDURE `UPT_SUBM_DATE`(
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
			CREATE PROCEDURE `UPT_CONFIRM`(
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
    if($_POST["action"] == "upt_trans_opt_vip"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $vip=mysqli_real_escape_string($connect,$_POST["vip"]);
        $userid=mysqli_real_escape_string($connect,$_POST["userid"]);
        
        
        $procedure = "
			CREATE PROCEDURE UPDATE_TRANS_LIST_VIP(IN P_ID INT(11), P_VIP VARCHAR(5), P_USERID INT(11) )
			BEGIN
            
				UPDATE TB600010 SET VIP_CK = P_VIP, UPT_USERID = P_USERID, VIP_EDTDATE = NOW() 
				WHERE ID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TRANS_LIST_VIP"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_TRANS_LIST_VIP('".$id."','".$vip."','".$userid."')";
                //프로시저 호출
                if(mysqli_query($connect,$query)){
                    echo "true";
                }else{
                    echo "false";
                }
                //echo $query;
                
            }
        }
        
    }
    //양도 리스트 옵션값 수정 : 끝
    

    //양도 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_trans_opt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $prog=mysqli_real_escape_string($connect,$_POST["prog"]);
        $prio=mysqli_real_escape_string($connect,$_POST["prio"]);
        $pay=mysqli_real_escape_string($connect,$_POST["pay"]);
        $vip=mysqli_real_escape_string($connect,$_POST["vip"]);
        $path=mysqli_real_escape_string($connect,$_POST["path"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_TRANS_LIST(IN P_ID INT(11),P_PRIO VARCHAR(5) , 
            P_PROG VARCHAR(5), P_PAY VARCHAR(5), P_VIP CHAR(1),
            P_PATH VARCHAR(5) 
            )
			BEGIN
            
				UPDATE TB600010 SET PRIO_NUM = P_PRIO, PROGRESS= P_PROG, PAY_FLAG = P_PAY, VIP_CK = P_VIP,
                PATH_INFO = P_PATH
				WHERE ID = P_ID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TRANS_LIST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_TRANS_LIST('".$id."','".$prio."','".$prog."','".$pay."','".$vip."','".$path."')";
                //프로시저 호출
                if(mysqli_query($connect,$query)){
                    echo "true";
                }else{
                    echo "false";
                }
                //echo $query;
                
            }
        }
        
    }
    //양도 리스트 옵션값 수정 : 끝
    
    
    
    
    //종합소득세 접수현황 RPA스텝값 업데이트 분기처리 : 시작
    if($_POST["action"] == "upt_RPA_step_code"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $step_name=mysqli_real_escape_string($connect,$_POST["step_name"]);
        
        $procedure = "
			CREATE PROCEDURE `UPDATE_ACC_RPA_STEP`(IN P_ID INT(11),
P_STEP VARCHAR(50)
)
BEGIN
                
            DECLARE CNT1 INT;
            DECLARE TMP_BIZID INT;
            
            SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 WHERE CSTID=P_ID AND CST_TYPE='A1001' 
            AND CST_TYPE_YEAR=$SET_YEAR;

            SELECT COUNT(1) INTO CNT1 FROM TB100023 WHERE CSTID=P_ID AND BIZ_ID = TMP_BIZID;
            #SELECT TMP_BIZID,CNT1;
                                
            IF CNT1 > 0 THEN
            
				IF P_STEP = 'CashReport' THEN
					UPDATE TB100023 SET CashReport = 'R',CashReport_REGDATE = NOW() 
                    WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'HomeTaxConsignment' THEN
					UPDATE TB100023 SET HomeTaxConsignment = 'R', HomeTaxConsignment_REGDATE=NOW() 
                    WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'CompanyReg' THEN
					UPDATE TB100023 SET CompRegCheck = 'R',CompRegCheck_REGDATE=NOW()  
                    WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'SmartA' THEN
					UPDATE TB100023 SET SmartAToConvert = 'R',SmartAToConvert_REGDATE=NOW()  
                    WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'HT_Upload' THEN
					UPDATE TB100023 SET HomeTaxUpload = 'R' , HomeTaxUpload_REGDATE=NOW()  
                    WHERE BIZ_ID = TMP_BIZID;
				elseif P_STEP = 'HT_Print' THEN
					UPDATE TB100023 SET HomeTaxPrint = 'R', HomeTaxPrint_REGDATE=NOW()  
                    WHERE BIZ_ID = TMP_BIZID;
                elseif P_STEP = 'SmartABookMake' THEN
					UPDATE TB100023 SET SmartABookMake = 'R', SmartABookMake_REGDATE=NOW()  
                    WHERE BIZ_ID = TMP_BIZID;
                elseif P_STEP = 'WehagoBookMake' THEN
					UPDATE TB100023 SET WehagoBookMake = 'R', WehagoBookMake_REGDATE=NOW()  
                    WHERE BIZ_ID = TMP_BIZID;
                elseif P_STEP = 'Manual_Down' THEN
					UPDATE TB100023 SET ManualDown = 'R', ManualDown_REGDATE=NOW()  
                    WHERE BIZ_ID = TMP_BIZID;

				END IF;

				
            ELSE
				IF P_STEP = 'CashReport' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,CashReport, CashReport_REGDATE)
					SELECT TMP_BIZID,P_ID,'R', NOW();
				elseif P_STEP = 'HomeTaxConsignment' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,HomeTaxConsignment,HomeTaxConsignment_REGDATE)
					SELECT TMP_BIZID,P_ID,'R',NOW();
				elseif P_STEP = 'CompanyReg' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,CompRegCheck,CompRegCheck_REGDATE)
					SELECT TMP_BIZID,P_ID,'R',NOW();
				elseif P_STEP = 'SmartA' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,SmartAToConvert,SmartAToConvert_REGDATE)
					SELECT TMP_BIZID,P_ID,'R',NOW();
				elseif P_STEP = 'HT_Upload' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,HomeTaxUpload,HomeTaxUpload_REGDATE)
					SELECT TMP_BIZID,P_ID,'R',NOW();
				elseif P_STEP = 'HT_Print' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,HomeTaxPrint,HomeTaxPrint_REGDATE)
					SELECT TMP_BIZID,P_ID,'R',NOW();
                elseif P_STEP = 'SmartABookMake' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,SmartABookMake,SmartABookMake_REGDATE)
					SELECT TMP_BIZID,P_ID,'R', NOW();
                elseif P_STEP = 'WehagoBookMake' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,WehagoBookMake,WehagoBookMake_REGDATE)
					SELECT TMP_BIZID,P_ID,'R',NOW();
                elseif P_STEP = 'Manual_Down' THEN
					INSERT INTO TB100023(BIZ_ID,CSTID,ManualDown,ManualDown_REGDATE)
					SELECT TMP_BIZID,P_ID,'R',NOW();
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
			CREATE PROCEDURE UPDATE_RP_KAKAO_SEND(IN P_ID INT(11))
BEGIN
            
    UPDATE TB100022 SET RP_SEND_KAKAO='Y' WHERE BIZ_ID = P_ID 
    AND CST_TYPE='A1001' AND CST_TYPE_YEAR = $SET_YEAR ;

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
        $user_ratio=mysqli_real_escape_string($connect,$_POST["user_ratio"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_ACC_INC_LIST(IN P_ID INT(11),P_PROC VARCHAR(5), 
P_REGUSER VARCHAR(4) , P_BRANCH VARCHAR(5),P_CONFIRM VARCHAR(5), P_EDTUSER VARCHAR(4),P_USER_RATIO INT
)
			BEGIN
                DECLARE TMP_BIZ_ID INT;
                DECLARE CNT INT;
            
            
                SELECT COUNT(1) INTO CNT FROM TB100026
                WHERE BIZ_ID = P_ID;
            
                IF IFNULL(P_PROC,'') <> '' THEN
                    IF CNT>0 THEN
        				UPDATE TB100026 SET PROGRESS = P_PROC, EDTDATE=NOW()
    	       			WHERE BIZ_ID = P_ID;
                    ELSE
                        INSERT INTO TB100026(BIZ_ID,PROGRESS,REGDATE)
                        SELECT P_ID, P_PROC,NOW();
                    END IF;
                END IF;
                
            
                UPDATE TB100022 SET DEC_REGUSER = P_REGUSER, REG_BRANCH=P_BRANCH, CONFIRM=P_CONFIRM, CONFIRM_REGUSER=P_REGUSER,CONFIRM_DATE = NOW(),
                EDTUSER = P_EDTUSER, EDTDATE = NOW(), USER_RATIO = P_USER_RATIO
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
                $query = "CALL UPDATE_ACC_INC_LIST('".$id."','".$proc."' , '".$reguser."','".$branch."', '".$confirm."','".$edtuser."','".$user_ratio."' )";
                //프로시저 호출
                mysqli_query($connect,$query);
                //echo $query;
                
            }
        }
        
    }
    //종합소득세 리스트 옵션값 수정 : 끝
    
    
    
    //종합소득세 전문상담 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_simple_inc_opt_pro"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $proc=mysqli_real_escape_string($connect,$_POST["proc"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $acc_ck=mysqli_real_escape_string($connect,$_POST["acc_ck"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        $edtuser=mysqli_real_escape_string($connect,$_POST["edtuser"]);
        $est_fee=mysqli_real_escape_string($connect,$_POST["est_fee"]);
        $inf_channel=mysqli_real_escape_string($connect,$_POST["inf_channel"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_SIMPLE_PRO_LIST(IN P_ID INT(11),P_PROC VARCHAR(5), P_REGUSER VARCHAR(4) , P_ACC_CK VARCHAR(10)
, P_BRANCH VARCHAR(5),P_EDTUSER VARCHAR(4),P_EST_FEE INT, P_INF_CHANNEL VARCHAR(20)
)
			BEGIN
                DECLARE TMP_BIZ_ID INT;
                DECLARE CNT INT;
            
            
                SELECT COUNT(1) INTO CNT FROM TB100026
                WHERE BIZ_ID = P_ID;
            
                IF IFNULL(P_PROC,'') <> '' THEN
                    IF CNT>0 THEN
        				UPDATE TB100026 SET PROGRESS = P_PROC, EDTDATE=NOW()
    	       			WHERE BIZ_ID = P_ID;
                    ELSE
                        INSERT INTO TB100026(BIZ_ID,PROGRESS,REGDATE)
                        SELECT P_ID, P_PROC,NOW();
                    END IF;
                END IF;
            
                UPDATE TB100022 SET DEC_REGUSER = P_REGUSER, ACC_CHECK = P_ACC_CK, REG_BRANCH=P_BRANCH,EDTDATE=NOW() , EDTUSER=P_EDTUSER,
                EST_FEE_SELF = P_EST_FEE, INF_CHANNEL=P_INF_CHANNEL
                WHERE BIZ_ID = P_ID
                AND CST_TYPE = 'A1001'
                AND CST_TYPE_SEQ=1;
            
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_SIMPLE_PRO_LIST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL UPDATE_SIMPLE_PRO_LIST('".$id."','".$proc."' , '".$reguser."','".$acc_ck."', '".$branch."','".$edtuser."','".$est_fee."','".$inf_channel."' )";
                //프로시저 호출
                mysqli_query($connect,$query);
                echo $query;
                
            }
        }
        
    }
    //종합소득세 전문상담 리스트 옵션값 수정 : 끝
    
    
    
    //종합소득세 간편안내 리스트 옵션값 수정 : 시작
    if($_POST["action"] == "upt_simple_inc_opt"){
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $proc=mysqli_real_escape_string($connect,$_POST["proc"]);
        $reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
        $acc_ck=mysqli_real_escape_string($connect,$_POST["acc_ck"]);
        $branch=mysqli_real_escape_string($connect,$_POST["branch"]);
        $edtuser=mysqli_real_escape_string($connect,$_POST["edtuser"]);
        $est_fee=mysqli_real_escape_string($connect,$_POST["est_fee"]);
        $inf_path=mysqli_real_escape_string($connect,$_POST["inf_path"]);
        
        $procedure = "
			CREATE PROCEDURE UPDATE_SIMPLE_INC_LIST(IN P_ID INT(11),P_PROC VARCHAR(5), P_REGUSER VARCHAR(4) , P_ACC_CK VARCHAR(10)
, P_BRANCH VARCHAR(5),P_EDTUSER VARCHAR(4),P_EST_FEE INT, P_INF_PATH VARCHAR(50)
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

                UPDATE TB100022 SET DEC_REGUSER = P_REGUSER, ACC_CHECK = P_ACC_CK, REG_BRANCH=P_BRANCH,EDTDATE=NOW() , EDTUSER=P_EDTUSER,
                EST_FEE = P_EST_FEE, INF_PATH = P_INF_PATH
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
                $query = "CALL UPDATE_SIMPLE_INC_LIST('".$id."','".$proc."' , '".$reguser."','".$acc_ck."', '".$branch."','".$edtuser."','".$est_fee."', '".$inf_path."' )";
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
					TRANS_DATE=DATE_FORMAT(trans_date, '%Y-%m-%d'),
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
                
                try{
                    mysqli_query($connect,$query);
                    echo '수정 되었습니다.';
                }catch(Exception $e){
                    echo $e;
                }
                
                //echo '수정 되었습니다.';
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
            
				INSERT INTO TB980010(USERID,ID, PW, USERNAME,DEPID, REGDATE, EDTDATE, INNER_PHONE, OUTER_PHONE, MOBILE ) 
                VALUES(TMP,member_id, CONCAT('*',UPPER(SHA1(UNHEX(SHA1(member_pw))))),member_name,depid, NOW(), NOW(), inner_phone, outer_phone, mobile);
			END IF;
            
			IF CNT > 0
			THEN
				UPDATE TB980010 SET PW=CONCAT('*',UPPER(SHA1(UNHEX(SHA1(member_pw))))), USERNAME=member_name, DEPID=depid,
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
DECLARE P_CSTID INT;
            
		SET resident_id = CONCAT(resident1,'-',resident2);
        
        SELECT CSTID INTO P_CSTID FROM TB100020 
        WHERE REPLACE(CSTNAME,' ','') = REPLACE(cstname,' ','')
        AND REPLACE(MOBILE,'-','') = REPLACE(mobile,'-','');

        IF P_CSTID > 0 THEN
            UPDATE TB100020 SET RESIDENT_ID = resident_id, HomeTaxID = hometaxid, HomeTaxPW = hometaxPW 
            WHERE CSTID = P_CSTID;   
        ELSE
    		INSERT INTO TB100020(NUMBERING,CSTNAME, MOBILE,RESIDENT_ID,REF_BANK,REF_ACC, WRITE_REGDATE, BRANCH, SERVER, SERVER_NUM, HomeTaxID, HomeTaxPW, CST_TYPE) 
            VALUES(numbering,REPLACE(cstname,' ' ,''),REPLACE(REPLACE(mobile,'-',''),' ',''),resident_id,ref_bank,ref_acc, NOW(),branch, server, server_num, hometaxid, hometaxpw,cst_type);
            SELECT last_insert_id() INTO P_CSTID;

            
            SELECT BIZ_ID INTO P_BIZ_ID FROM TB100022 
            WHERE CSTID = P_CSTID AND CST_TYPE='A1001' AND CST_TYPE_YEAR = (YEAR(NOW())-1) ;
            
            IF P_BIZ_ID > 0 THEN
    			UPDATE TB100022 SET REG_BRANCH=P_REG_BRANCH, EDTDATE=NOW(),INF_PATH='등록_RPA'
                WHERE BIZ_ID = P_BIZ_ID;
            ELSE
    			INSERT INTO TB100022(CSTID,CST_TYPE,CST_TYPE_YEAR,CST_TYPE_SEQ, REGDATE, INF_PATH, REG_BRANCH)
    			SELECT P_CSTID,'A1001',YEAR(NOW())-1,1,NOW(),'등록_RPA', STR_TO_CODE(P_REG_BRANCH);
    
    			SELECT last_insert_id() INTO P_BIZ_ID;
            END IF;

            CALL IN_AND_UP_TB100026(P_BIZ_ID, 'E7228');

        END IF;

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

        SELECT COUNT(1) INTO CNT FROM TB100020 WHERE REPLACE(CSTNAME,' ','') = REPLACE(P_CSTNAME,' ' ,'') 
        AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');
        
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
