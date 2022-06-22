<?php
//echo 'api test';

try{
	include("../db_info.php");
	$output = array();
	$telno=$_GET["telno"];
	$teltime=$_GET["teltime"];
	$gen=$_GET["gen"];
	$userid=$_GET["userid"];
	$companyid=$_GET["companyid"];
	$loginid=$_GET["loginid"];
	$eventtype=$_GET["eventtype"];
	$callstat=$_GET["callstat"];
	$isdial=$_GET["isdial"];
	$begintime=$_GET["begintime"];
	$endtime=$_GET["endtime"];
	$inexten=$_GET["inexten"];
	$calllogid=$_GET["calllogid"];

	$procedure = "
	CREATE PROCEDURE `INSERT_IQ200`(P_TELNO varchar(45),
P_TELTIME DATETIME, 
P_GEN VARCHAR(45), 
P_USERID VARCHAR(45), 
P_COMPANYID VARCHAR(45), 
P_LOGINID VARCHAR(20), 
P_EVENTTYPE VARCHAR(45), 
P_CALLSTAT VARCHAR(45), 
P_ISDIAL VARCHAR(45), 
P_BEGINTIME DATETIME, 
P_ENDTIME DATETIME, 
P_INEXTEN VARCHAR(45),
P_CALLLOGID VARCHAR(45) )
	BEGIN
		
    	DECLARE TMP_CNT INT ;
        DECLARE CNT2 INT;
        DECLARE TMP_CSTID INT;        
        DECLARE TMP_BIZ_ID INT;
		
		
	    INSERT INTO IQ200_TEST (TELNO, TELTIME, GEN, USERID, COMPANYID ,LOGINID ,EVENTTYPE ,CALLSTAT , ISDIAL, BEGINTIME ,ENDTIME ,INEXTEN ,CALLLOGID)
        SELECT P_TELNO, NOW(), P_GEN, P_USERID, P_COMPANYID ,P_LOGINID ,P_EVENTTYPE ,P_CALLSTAT ,P_ISDIAL , P_BEGINTIME ,P_ENDTIME ,P_INEXTEN ,P_CALLLOGID;

        SELECT COUNT(1) INTO CNT2 FROM TB100020 WHERE REPLACE(MOBILE,'-','') = REPLACE(P_TELNO,'-','');
        SELECT CSTID INTO TMP_CSTID FROM TB100020 WHERE REPLACE(MOBILE,'-','') = REPLACE(P_TELNO,'-','');
        SELECT BIZ_ID INTO TMP_BIZ_ID FROM TB100022 WHERE CSTID = TMP_CSTID ;
#AND CST_TYPE_YEAR = 2021;
        
        IF CNT2 = 0 THEN
            CALL MAIN_INC_NEW_CST('전화문의',P_TELNO,'IQ200');
        ELSE
            UPDATE TB100022 SET EDTDATE = NOW() WHERE BIZ_ID = TMP_BIZ_ID;
        END IF;       
	
	END
	";
//echo 'cstname = '.$cstname;
	//기존에 프로시저가 있으면 삭제
	
	if(strlen($telno) > 5 ){
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_IQ200"))
	    { //위에서 만든 프로시저 실행
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL INSERT_IQ200('".$telno."','".$teltime."','".$gen."','".$userid."','".$companyid."','".$loginid."',
'".$eventtype."','".$callstat."','".$isdial."','".$begintime."','".$endtime."','".$inexten."','".$calllogid."')" or die(mysqli_error());
	            //프로시저 호출
	            //mysqli_query($connect,$query);
	            
	            if(mysqli_query($connect,$query))
	            {
	                $output["message"] = "data saved successfully";
	                $output["status"] = "ok";
	            }else{
	                $output["message"] = "data not saved successfully, ". mysqli_error($connect);
	                $output["status"] = "error";
	            }
	        }
	    }
	    
	}
}catch(Exception $e){
	$s = $e->getMessage() . ' (ErrorCode ==> ' . $e->getCode() . ')';
	$output["message"] = "Exception : ". $s;
    $output["status"] = "error";
}
	

//echo json_encode($output);

?>