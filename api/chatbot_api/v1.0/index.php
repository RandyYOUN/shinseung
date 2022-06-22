<?php
//echo 'api test';

try{
    include("db_info.php");
    $output = array();
    $cstname_tmp=mysqli_real_escape_string($connect,$_GET["cstname"]);
    $mobile_tmp=mysqli_real_escape_string($connect,$_GET["mobile"]);
    $cst_type=mysqli_real_escape_string($connect,$_GET["cst_type"]);
    $sector=mysqli_real_escape_string($connect,$_GET["sector"]);
    $sector_code=mysqli_real_escape_string($connect,$_GET["sector_code"]);
    $sector2=mysqli_real_escape_string($connect,$_GET["sector2"]);
    $sector_code2=mysqli_real_escape_string($connect,$_GET["sector_code2"]);
    $year = "2021";
    $seq = "1";
    
    /*문자열 정규화*/
    $cstname = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $cstname_tmp);
    $mobile = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $mobile_tmp);
    /*문자열 정규화*/
    
    if($cstname == '') throw new Exception("cstname input error",1001);
    if($mobile == '') throw new Exception("mobile input error",1002);
    //if($flag == '') throw new Exception("flag input error",3);
    
    //$output["cstname"] = $cstname;
    //$output["mobile"] = $mobile;
    
    $procedure = "
	CREATE DEFINER=`sschina`@`%` PROCEDURE `insert_TB100020_DEV`(
		P_CSTNAME varchar(45), /*고객명*/
		P_MOBILE varchar(45), /*핸드폰*/
		P_CST_TYPE VARCHAR(50), /*세목 : 종합소득세/부가세 */
		P_YEAR VARCHAR(4), /* 연도 */
		P_SEQ VARCHAR(4), /* 기수 */
		P_SECTOR varchar(45), /* 업종 */
		P_SECTOR_CODE varchar(45), /* 업종코드 */
		P_SECTOR2 varchar(45), /* 업태 */
		P_SECTOR_CODE2 varchar(45) /* 업태코드 */
	)
	BEGIN
        
		DECLARE TMP_CSTID INT;
        DECLARE TMP_CST_TYPE VARCHAR(5);
        
        SELECT CSTID INTO TMP_CSTID FROM TB100020 WHERE CSTNAME=P_CSTNAME AND MOBILE=P_MOBILE;
        
		IF TMP_CSTID > 0 THEN
			UPDATE TB100020 SET UPT_CHECK = 'Y', SECTOR=P_SECTOR, SECTOR_CODE = P_SECTOR_CODE,SECTOR2 = P_SECTOR2, SECTOR_CODE2 = P_SECTOR_CODE2
			WHERE CSTNAME = P_CSTNAME AND MOBILE = P_MOBILE;
        
			CALL INSERT_TB100022(TMP_CSTID,P_CST_TYPE, P_YEAR, P_SEQ);
			/* TB100022 신규 세목 INSERT */
        
		ELSE
			INSERT INTO TB100020(CSTNAME, MOBILE, SECTOR, SECTOR_CODE, SECTOR2, SECTOR_CODE2)
			VALUES(P_CSTNAME,P_MOBILE, P_SECTOR, P_SECTOR_CODE, P_SECTOR2, P_SECTOR_CODE2);
        
			SELECT last_insert_id() INTO TMP_CSTID;
			CALL INSERT_TB100022(TMP_CSTID,P_CST_TYPE, P_YEAR, P_SEQ);
			/* TB100022 신규 세목 INSERT */
		END IF;
        
        
        
	END
	";
    //echo 'cstname = '.$cstname;
    //기존에 프로시저가 있으면 삭제
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_TB100020_DEV"))
    { //위에서 만든 프로시저 실행
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL insert_TB100020_DEV('".$cstname."','".$mobile."','".$cst_type."','".$year."','".$seq."','".$sector."','".$sector_code."','".$sector2."','".$sector_code2."')" or die(mysqli_error());
            //프로시저 호출
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
}catch(Exception $e){
    $s = $e->getMessage() . ' (ErrorCode ==> ' . $e->getCode() . ')';
    $output["message"] = "Exception : ". $s;
    $output["status"] = "error";
}


echo json_encode($output);

?>