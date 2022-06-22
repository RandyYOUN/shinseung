<?php
//echo 'api test';

function ck_mobile($mobile_tmp){
    $tmp_82 = substr($mobile_tmp,0,4);
    if($tmp_82=="8210"){
        $mobile = str_replace('8210','010',$mobile_tmp);
    }else{
        $mobile = $mobile_tmp;
    }
    return $mobile;
    
}


try{
    include("db_info.php");
    $output = array();
    $cstname_tmp=mysqli_real_escape_string($connect,$_GET["cstname"]);
    $mobile_tmp=mysqli_real_escape_string($connect,$_GET["mobile"]);
    $cst_type_tmp=mysqli_real_escape_string($connect,$_GET["cst_type"]);
    switch ($cst_type_tmp){
        case "종합소득세" : $cst_type = "A1001"; break;
        case "부가세" : $cst_type = "A1002"; break;
        case "재산제세" : $cst_type = 	"A1003"	; break;
        case "면세사업현황신고" : $cst_type = 	"A1004"	; break;
        case "면세일반" : $cst_type = 	"A1005"	; break;
        case "면세주택임대" : $cst_type = 	"A1006"	; break;
        case "세무기장" : $cst_type = 	"A1007"; break;
        case "양도" : $cst_type = 	"A1008"	; break;
        case "상속" : $cst_type = 	"A1009"; break;
        case "증여" : $cst_type = 	"A1010"; break;
        default : $cst_type = 	"A1011"; break;
    }
  
    $sector=mysqli_real_escape_string($connect,$_GET["sector"]);
    $sector_code=mysqli_real_escape_string($connect,$_GET["sector_code"]);
    $sector2=mysqli_real_escape_string($connect,$_GET["sector2"]);
    $sector_code2=mysqli_real_escape_string($connect,$_GET["sector_code2"]);
    $year = "2020";
    $seq = "1";
    /* 추가컬럼 20210222 */
    /*공통*/
    $city=mysqli_real_escape_string($connect,$_GET["city"]);
    $utmSource=mysqli_real_escape_string($connect,$_GET["utmSource"]);
    $utmTerm=mysqli_real_escape_string($connect,$_GET["utmTerm"]);
    $utmCampaign=mysqli_real_escape_string($connect,$_GET["utmCampaign"]);
    $utmMedium=mysqli_real_escape_string($connect,$_GET["utmMedium"]);
    $utmContent=mysqli_real_escape_string($connect,$_GET["utmContent"]);
    $referrer=mysqli_real_escape_string($connect,$_GET["referrer"]);
    $root=mysqli_real_escape_string($connect,$_GET["root"]);
    $updateAt=mysqli_real_escape_string($connect,$_GET["updateAt"]);
    $createAt=mysqli_real_escape_string($connect,$_GET["createAt"]);
    $memberId=mysqli_real_escape_string($connect,$_GET["memberId"]);
    $tags=mysqli_real_escape_string($connect,$_GET["tags"]);
    $email=mysqli_real_escape_string($connect,$_GET["email"]);
    //$country=mysqli_real_escape_string($connect,$_GET["country"]);
    $country=$_GET["country"];
    $language=mysqli_real_escape_string($connect,$_GET["language"]);
    $hasPushToken=mysqli_real_escape_string($connect,$_GET["hasPushToken"]);
    $unsubscribed=mysqli_real_escape_string($connect,$_GET["unsubscribed"]);
    /*공통끝*/
    /*web*/
    $web_browser=mysqli_real_escape_string($connect,$_GET["web_browser"]);
    $web_lastSeenAt=mysqli_real_escape_string($connect,$_GET["web_lastSeenAt"]);
    $web_os=mysqli_real_escape_string($connect,$_GET["web_os"]);
    $web_sessionsCount=mysqli_real_escape_string($connect,$_GET["web_sessionsCount"]);
    $web_browserName=mysqli_real_escape_string($connect,$_GET["web_browserName"]);
    $web_osName=mysqli_real_escape_string($connect,$_GET["web_osName"]);
    $web_device=mysqli_real_escape_string($connect,$_GET["web_device"]);
    /*web 끝*/
    /*mobile*/
    $mobile_sessionsCount=mysqli_real_escape_string($connect,$_GET["mobile_sessionsCount"]);
    $mobile_lastSeenAt=mysqli_real_escape_string($connect,$_GET["mobile_lastSeenAt"]);
    $mobile_appName=mysqli_real_escape_string($connect,$_GET["mobile_appName"]);
    $mobile_osName=mysqli_real_escape_string($connect,$_GET["mobile_osName"]);
    $mobile_device=mysqli_real_escape_string($connect,$_GET["mobile_device"]);
    $mobile_appVersion=mysqli_real_escape_string($connect,$_GET["mobile_appVersion"]);
    $mobile_os=mysqli_real_escape_string($connect,$_GET["mobile_os"]);
    /*mobile끝*/
    $channel_id=mysqli_real_escape_string($connect,$_GET["id"]);
    
    /*문자열 정규화*/
    $cstname = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $cstname_tmp);
    $mobile = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $mobile_tmp);
    /*문자열 정규화*/
    
    if($cstname == '') throw new Exception("cstname input error",1001);
    if($mobile == '') throw new Exception("mobile input error",1002);
    
    $mobile = ck_mobile($mobile);
    //if($flag == '') throw new Exception("flag input error",3);
    
    //$output["cstname"] = $cstname;
    //$output["mobile"] = $mobile;
    
    $procedure = "
	CREATE PROCEDURE `insert_TB100020_API`(
		P_CSTNAME varchar(45), /*고객명*/
		P_MOBILE varchar(45), /*핸드폰*/
		P_CST_TYPE VARCHAR(50), /*세목 : 종합소득세/부가세 */
		P_YEAR VARCHAR(4), /* 연도 */
		P_SEQ VARCHAR(4), /* 기수 */
		P_SECTOR varchar(45), /* 업종 */
		P_SECTOR_CODE varchar(45), /* 업종코드 */
		P_SECTOR2 varchar(45), /* 업태 */
		P_SECTOR_CODE2 varchar(45), /* 업태코드 */
        P_CITY varchar(45),
        P_UTMSOURCE TEXT,
        P_UTMTERM TEXT,
        P_UTMCAMPAIGN TEXT,
        P_MEDIUM TEXT,
        P_CONTENT TEXT,
        P_REFERRER varchar(200),
        P_ROOT varchar(200),
        P_UPDATEAT varchar(200),
        P_CREATEAT varchar(200),
        P_MEMBERID varchar(200),
        P_TAGS varchar(200),
        P_EMAIL varchar(200),
        P_COUNTRY varchar(200),
        P_LANGUAGE varchar(45),
        P_HASPUSHTOKEN varchar(200),
        P_UNSUBSCRIBED varchar(200),
        P_WEB_BROWSER varchar(200),
        P_WEB_LASTSEENAT varchar(200),
        P_WEB_OS varchar(45),
        P_WEB_SESSIONSCOUNT INT(11),
        P_WEB_BROWSERNAME varchar(200),
        P_WEB_OSNAME varchar(45),
        P_WEB_DEVICE varchar(45),
        P_MOBILE_SESSIONSCOUNT INT(11),
        P_MOBILE_LASTSEENAT varchar(200),
        P_MOBILE_APPNAME varchar(200),
        P_MOBILE_OSNAME varchar(45),
        P_MOBILE_DEVICE varchar(45),
        P_MOBILE_APPVERSION varchar(45),
        P_MOBILE_OS varchar(45),
        P_CHANNEL_ID VARCHAR(200)
	)
	BEGIN
        
		DECLARE TMP_CSTID INT;
        DECLARE TMP_CSTID2 INT;
        DECLARE TMP_CST_TYPE VARCHAR(5);
        
        SELECT CSTID INTO TMP_CSTID FROM TB100020 WHERE CSTNAME=P_CSTNAME AND MOBILE=P_MOBILE;
        
		IF TMP_CSTID > 0 THEN
			UPDATE TB100020 SET SECTOR=P_SECTOR, SECTOR_CODE = P_SECTOR_CODE,SECTOR2 = P_SECTOR2, SECTOR_CODE2 = P_SECTOR_CODE2
			WHERE CSTNAME = P_CSTNAME AND MOBILE = REPLACE(P_MOBILE,'-','');
        
			CALL INSERT_TB100022(TMP_CSTID,P_CST_TYPE, P_YEAR, P_SEQ,null,null,null,null,null,'채널톡');
			/* TB100022 신규 세목 INSERT */
        
		ELSE
			INSERT INTO TB100020(CSTNAME, MOBILE, SECTOR, SECTOR_CODE, SECTOR2, SECTOR_CODE2)
			VALUES(P_CSTNAME,P_MOBILE, P_SECTOR, P_SECTOR_CODE, P_SECTOR2, P_SECTOR_CODE2);
        
			SELECT last_insert_id() INTO TMP_CSTID;
			CALL INSERT_TB100022(TMP_CSTID,P_CST_TYPE, P_YEAR, P_SEQ,null,null,null,null,null,'채널톡');
			/* TB100022 신규 세목 INSERT */
		END IF;
        
        /* TB100025 추가 채널톡정보 INSERT */
        SELECT CSTID INTO TMP_CSTID2 FROM TB100025 WHERE CSTID = TMP_CSTID;

        IF TMP_CSTID2 > 0 THEN
            UPDATE TB100025 SET CITY = P_CITY, UTMSOURCE  = P_UTMSOURCE ,    
            UTMTERM = P_UTMTERM ,   UTMCAMPAIGN =  P_UTMCAMPAIGN ,    
            UTMMEDIUM = P_MEDIUM ,   UTMCONTENT = P_CONTENT ,REFERRER =  P_REFERRER ,  
            ROOT = P_ROOT ,UPDATEAT= P_UPDATEAT ,  CREATEAT =  P_CREATEAT ,    
            MEMBERID  = P_MEMBERID ,TAGS = P_TAGS , EMAIL=   P_EMAIL ,    
            COUNTRY  = P_COUNTRY ,    LANGUAGE  = P_LANGUAGE ,    
            HASPUSHTOKEN  = P_HASPUSHTOKEN ,UNSUBSCRIBED  = P_UNSUBSCRIBED ,
            WEB_BROWSER  = P_WEB_BROWSER ,WEB_LASTSEENAT =  P_WEB_LASTSEENAT ,
            WEB_OS = P_WEB_OS ,WEB_SESSIONSCOUNT = P_WEB_SESSIONSCOUNT ,    
            WEB_BROWSERNAME = P_WEB_BROWSERNAME ,WEB_OSNAME  = P_WEB_OSNAME ,    
            WEB_DEVICE  = P_WEB_DEVICE ,MOBILE_SESSIONSCOUNT  = P_MOBILE_SESSIONSCOUNT ,    
            MOBILE_LASTSEENAT = P_MOBILE_LASTSEENAT ,MOBILE_APPNAME  = P_MOBILE_APPNAME ,
            MOBILE_OSNAME  = P_MOBILE_OSNAME ,MOBILE_DEVICE  = P_MOBILE_DEVICE ,    
            MOBILE_APPVERSION = P_MOBILE_APPVERSION ,MOBILE_OS  = P_MOBILE_OS ,
            CHANNEL_ID =  P_CHANNEL_ID 
            WHERE CSTID = TMP_CSTID2; 
        ELSE 
            INSERT INTO TB100025
            SELECT TMP_CSTID ,    P_CITY , P_UTMSOURCE ,    P_UTMTERM ,    P_UTMCAMPAIGN ,    P_MEDIUM ,    P_CONTENT ,    P_REFERRER ,    P_ROOT ,
            P_UPDATEAT ,    P_CREATEAT ,    P_MEMBERID ,    P_TAGS ,    P_EMAIL ,    P_COUNTRY ,    P_LANGUAGE ,    P_HASPUSHTOKEN ,    P_UNSUBSCRIBED ,
            P_WEB_BROWSER ,    P_WEB_LASTSEENAT ,    P_WEB_OS ,    P_WEB_SESSIONSCOUNT ,    P_WEB_BROWSERNAME ,    P_WEB_OSNAME ,    P_WEB_DEVICE ,
            P_MOBILE_SESSIONSCOUNT ,    P_MOBILE_LASTSEENAT ,    P_MOBILE_APPNAME ,    P_MOBILE_OSNAME ,    P_MOBILE_DEVICE ,    P_MOBILE_APPVERSION ,
            P_MOBILE_OS ,    P_CHANNEL_ID;
        END IF;
        
	END
	";

    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_TB100020_API"))
    { 
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL insert_TB100020_API('".$cstname."','".$mobile."','".$cst_type."','".$year."','".$seq."','".$sector."','".$sector_code."','".$sector2."','".$sector_code2."'
,'".$city."','".$utmSource."','".$utmTerm."','".$utmCampaign."','".$utmMedium."','".$utmContent."','".$referrer."',
'".$root."','".$updateAt."','".$createAt."','".$memberId."','".$tags."','".$email."','".$country."',
'".$language."','".$hasPushToken."','".$unsubscribed."','".$web_browser."','".$web_lastSeenAt."',
'".$web_os."','".$web_sessionsCount."','".$web_browserName."','".$web_osName."','".$web_device."',
'".$mobile_sessionsCount."','".$mobile_lastSeenAt."','".$mobile_appName."','".$mobile_osName."','".$mobile_device."','".$mobile_appVersion."','".$mobile_os."','".$channel_id."')" or die(mysqli_error());
      
            if(mysqli_query($connect,$query))
            {
                $output["message"] = "data saved successfully";
                $output["status"] = "ok";
            }else{
                $output["message"] = "data save fail..., ". mysqli_error($connect);
                $output["status"] = "error";
            }
        }
    }
}catch(Exception $e){
    $s = $e->getMessage() . ' (ErrorCode ==> ' . $e->getCode() . ')';
    $output["message"] = "Exception : ". $s;
    $output["status"] = "error";
}


echo json_encode($output);

?>