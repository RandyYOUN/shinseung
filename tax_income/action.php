<?php
include "db_info.php";
$_day = date("w");
$_hour = date("Hi");
$NEW_HP_CHK = '';
$SET_YEAR = 2021;

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ 
	//db연결
	//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    //$connect = mysqli_connect("127.0.0.1", "sschina", "Andy4240!@","dbsschina","3306");
	
	
    
    
    //사용자 배송지 주소 변경 : S
    if($_POST["action"] == "upt_cst_address"){
        $output = array();
        $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
        $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $postnum=mysqli_real_escape_string($connect,$_POST["postnum"]);
        $address=mysqli_real_escape_string($connect,$_POST["address"]);
        
        $procedure = "
			CREATE  PROCEDURE `UPT_CST_ADDRESS`(IN P_CSTID INT(11), P_CSTNAME VARCHAR(45), P_MOBILE VARCHAR(45),
P_POSTNUM VARCHAR(6), P_ADDRESS VARCHAR(200) )
BEGIN
            
                UPDATE TB100021 SET CSTNAME = P_CSTNAME, MOBILE = REPLACE(P_MOBILE,'-',''),
                ADDRESS1 = P_ADDRESS, POST_NUM = P_POSTNUM
                WHERE CSTID = P_CSTID;
            
                SELECT P_CSTID;
            
			END
			";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_CST_ADDRESS"))
        {
            if(mysqli_query($connect, $procedure))
            {
                $query = "CALL UPT_CST_ADDRESS('".$cstid."','".$cstname."','".$mobile."','".$postnum."','".$address."')";
                $result = mysqli_query($connect, $query);
                
                while($row = mysqli_fetch_array($result))
                {
                    $output['ID'] = $row["P_CSTID"];
                }
                echo json_encode($output);
            }
        }
    }
    //사용자 배송지 주소 변경 : E
    
    
    // 고객 달력발송 주소 매칭용 select  select : 시작
    if($_POST["action"] == "select_cst_info_address"){
        
        $output = array();
        $id=mysqli_real_escape_string($connect,$_POST["id"]);
        $procedure = "
	CREATE PROCEDURE SELECT_CST_ADDRESS(IN user_id int(11) )
	BEGIN
        SELECT * FROM TB100021 WHERE CSTID = user_id ;
	END;
	";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CST_ADDRESS"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_CST_ADDRESS('".$id."')";
                $result = mysqli_query($connect,$query1);
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                
                while($row = mysqli_fetch_array($result)){
                    $output['CSTID'] = $row["CSTID"];
                    $output['CSTNAME'] = $row["CSTNAME"];
                    $output['MOBILE'] = $row["MOBILE"];
                    $output['POST_NUM'] = $row["POST_NUM"];
                    $output['ADDRESS1'] = $row["ADDRESS1"];
                    $output['ADDRESS2'] = $row["ADDRESS2"];
                }
                echo json_encode($output);
            }
        }
    }
    // 고객 달력발송 주소 매칭용 select : 끝
    
    
    
    
	//사용자 리뷰등록 : S
	if($_POST["action"] == "insert_inc_review_pop"){
	    $output = array();
	    $cstid=mysqli_real_escape_string($connect,$_POST["cstid"]);
	    $cstname=mysqli_real_escape_string($connect,$_POST["cstname"]);
	    $mobile=mysqli_real_escape_string($connect,$_POST["mobile"]);
	    $content=mysqli_real_escape_string($connect,$_POST["content"]);
	    $score=mysqli_real_escape_string($connect,$_POST["score"]);
	    $cate=mysqli_real_escape_string($connect,$_POST["cate"]);
	    $procedure = "
			CREATE  PROCEDURE `INSERT_SS_REVIEW_POP`(IN P_CSTID INT(11), P_CSTNAME VARCHAR(45), P_MOBILE VARCHAR(45), 
P_CONTENT TEXT, P_SCORE INT(11), P_CATE VARCHAR(10) )
BEGIN

                DECLARE TMP_ID INT;

                INSERT INTO SS_REVIEW(REV_HP, REV_CONTENT, REV_SCORE, REV_REGDATE, REV_CATE, REV_NAME, VISIBLE)
                SELECT P_MOBILE, P_CONTENT,P_SCORE, NOW(),P_CATE,P_CSTNAME, 'Y'; 

                SELECT last_insert_id() INTO TMP_ID;

                SELECT TMP_ID;
	        
			END
			";
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_SS_REVIEW_POP"))
	    {
	        if(mysqli_query($connect, $procedure))
	        {
	            $query = "CALL INSERT_SS_REVIEW_POP('".$cstid."','".$cstname."','".$mobile."','".$content."','".$score."','".$cate."')";
	            $result = mysqli_query($connect, $query);
	            
	            while($row = mysqli_fetch_array($result))
	            {
	                $output['ID'] = $row["TMP_ID"];
	            }
	            echo json_encode($output);
	        }
	    }
	}
	//사용자 리뷰등록 : E
	
	
	
	//사용자 이름/핸드폰 로그인 : S
	if($_POST["action"] == "select_cst_info_simple"){
	    $output = array();
	    $CSTID=mysqli_real_escape_string($connect,$_POST["cstid"]);
		$year = mysqli_real_escape_string($connect,$_POST["year"]);
		if($year=="")
		    $year=$SET_YEAR;
		
	    $procedure = "
			CREATE PROCEDURE SELECT_CSTNAME_MOBILE(IN P_CSTID INT(11) )
			BEGIN
                DECLARE TMP_CSTID INT(11);
	        
				SELECT A.CSTID,A.CSTNAME, 
                REPLACE(B.INCOME_TAX,',','') AS 'INCOME_TAX',
                REPLACE(B.JIBANG_TAX,',','') AS 'JIBANG_TAX',				
                IFNULL(B.INCOME_TAX,'') AS 'INCOME_TAX_' ,
                IFNULL(B.JIBANG_TAX,'') AS 'JIBANG_TAX_',  
                B.REPORT_NUM_INCOME AS 'REPORT_NUM_INCOME', 
                B.REPORT_NUM_WETAX AS 'REPORT_NUM_WETAX' 
                FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
                WHERE A.CSTID = P_CSTID 
                AND B.CST_TYPE = 'A1001' 
				AND CST_TYPE_YEAR = $year;
	        
                SELECT TMP_CSTID;
	        
			END;
			";
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CSTNAME_MOBILE"))
	    {
	        if(mysqli_query($connect, $procedure))
	        {
	            $query = "CALL SELECT_CSTNAME_MOBILE('".$CSTID."')";
	            $result = mysqli_query($connect, $query);
	            
	            while($row = mysqli_fetch_array($result))
	            {
	                
	                if($row["INCOME_TAX"] < 0)
	                    $num_flag_income="음";
	                else
	                    $num_flag_income="양";
	                
                    if($row["JIBANG_TAX"] < 0)
                        $num_flag_ji="음";
                    else
                        $num_flag_ji="양";
                        
	                    
	                $output['CSTID'] = $row["CSTID"];
	                $output['CSTNAME'] = $row["CSTNAME"];
	                $output['INCOME_TAX'] = $row["INCOME_TAX_"];
	                $output['NUM_FLAG_INCOME'] = $num_flag_income;
	                $output['NUM_FLAG_JI'] = $num_flag_ji;
	                $output['JIBANG_TAX'] = $row["JIBANG_TAX_"];
	                $output['REPORT_NUM_INCOME'] = $row["REPORT_NUM_INCOME"];
	                $output['REPORT_NUM_WETAX'] = $row["REPORT_NUM_WETAX"];
	            }
	            echo json_encode($output);
	        }
	    }
	}
	//사용자 이름/핸드폰 로그인 : E
	
	
	
	
	//사용자 이름/핸드폰 로그인 : S
	if($_POST["action"] == "login_cstname_mobile"){
	    $output = array();
	    $CSTNAME=mysqli_real_escape_string($connect,$_POST["cstname"]);
	    $MOBILE=mysqli_real_escape_string($connect,$_POST["mobile"]);
	    
	    $CSTNAME = preg_replace("/\s+/", "", $CSTNAME);
	    $MOBILE = preg_replace("/\s+/", "", $MOBILE);
	    
	    $procedure = "
			CREATE PROCEDURE SELECT_CSTNAME_MOBILE(IN P_CSTNAME VARCHAR(45) , P_MOBILE VARCHAR(50) )
			BEGIN
                DECLARE TMP_CSTID INT(11);

                
                
				SELECT A.CSTID INTO TMP_CSTID FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B
                ON A.CSTID = B.CSTID WHERE B.CST_TYPE = 'A1001' AND B.CST_TYPE_YEAR=$SET_YEAR
                AND REPLACE(A.CSTNAME,' ','') = REPLACE(P_CSTNAME,' ','') 
                AND REPLACE(A.MOBILE,'-','') = REPLACE(P_MOBILE,'-','');

                IF IFNULL(TMP_CSTID,'') <> '' THEN
                    INSERT INTO TB700020(CSTID,STEP_NAME, LOG, LOG_TIME)
                    SELECT TMP_CSTID,'LOGIN','login date insert',now();
                ELSE
                    INSERT INTO TB700020(CSTID,STEP_NAME, LOG, LOG_TIME)
                    SELECT TMP_CSTID,'LOGIN','login fail',now();
                END IF;

                SELECT TMP_CSTID;

			END;
			";
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CSTNAME_MOBILE"))
	    {
	        if(mysqli_query($connect, $procedure))
	        {
	            $query = "CALL SELECT_CSTNAME_MOBILE('".$CSTNAME."','".$MOBILE."')";
	            $result = mysqli_query($connect, $query);
	            
	            while($row = mysqli_fetch_array($result))
	            {
	                $output['CSTID'] = $row["TMP_CSTID"];
	            }
	            echo json_encode($output);
	        }
	    }
	}
	//사용자 이름/핸드폰 로그인 : E
	
	
	
	
	
	if($_POST["action"] == "select_inc_step2" && isset($_POST["id"])){
	    $output = array();
	    
	    $procedure = "
			CREATE PROCEDURE SELECT_VAT_STEP2(IN user_id int(100))
			BEGIN
				SELECT *
				FROM dbsschina.TB100024
				WHERE BIZ_ID = user_id;
			END;
			";
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_VAT_STEP2"))
	    {
	        if(mysqli_query($connect, $procedure))
	        {
	            $query = "CALL SELECT_VAT_STEP2(".$_POST["bizid"].")";
	            $result = mysqli_query($connect, $query);
	            
	            while($row = mysqli_fetch_array($result))
	            {
	                $output['OPTION1'] = $row["OPTION1"];
	                $output['OPTION2'] = $row["OPTION2"];
	                $output['OPTION3'] = $row["OPTION3"];
	                $output['OPTION4'] = $row["OPTION4"];
	                $output['OPTION5'] = $row["OPTION5"];
	                $output['OPTION6'] = $row["OPTION6"];
	                $output['OPTION7'] = $row["OPTION7"];
	                $output['OPTION8'] = $row["OPTION8"];
	                $output['OPTION9'] = $row["OPTION9"];
	                $output['OPTION10'] = $row["OPTION10"];
	                $output['OPTION11'] = $row["OPTION11"];
	                
	            }
	            echo json_encode($output);
	        }
	    }
	}
	//부가세 2STEP select : 끝
	
	
	
	
	
	
	
	if($_POST["action"]=="동의")
	{ 
		$CSTNAME=mysqli_real_escape_string($connect,$_POST["cstname"]);
		$MOBILE=mysqli_real_escape_string($connect,$_POST["mobile"]);

		$procedure = "CREATE PROCEDURE insertAGREE(IN P_CSTNAME varchar(45) CHARSET utf8, P_MOBILE varchar(45) )
		BEGIN
			INSERT INTO CST_AGREEMENT(CSTNAME,MOBILE,AGREEMENT,AG_REGDATE) VALUES(P_CSTNAME,P_MOBILE,'Y',NOW());
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertAGREE"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL insertAGREE('".$CSTNAME."','".$MOBILE."')";
				//프로시저 호출
				mysqli_query($connect,$query);
			}
		}

		ECHO "동의완료.";


	}

	
	
	// 종소세 고객 수정클릭시 select
	if($_POST["action"] == "select_wait_change_flag"){
	    
	    $output = array();
	    $id=mysqli_real_escape_string($connect,$_POST["id"]);
	    
	    $procedure = "
		CREATE PROCEDURE SELECT_TB100032(IN P_ID INT )
		BEGIN
	        
            DECLARE CNT INT;
	        
            SELECT CSTID,COPY_FLAG
            FROM TB100032
            WHERE CSTID=P_ID;
	        
            SELECT CNT;
	        
		END;
		";
	    
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100032"))
	    {
	        //mysqli_query:DB에 쿼리 전송
	        if(mysqli_query($connect,$procedure))
	        {
	            $query1 = "CALL SELECT_TB100032('".$id."')";
	            $result = mysqli_query($connect,$query1);
	            ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
	            
	            while($row = mysqli_fetch_array($result)){
	                $output['CSTID'] = $row["CSTID"];
	                $output['COPY_FLAG'] = $row["COPY_FLAG"];
	            }
	            
	            echo json_encode($output);
	            
	        }
	        
	    }
	    
	}
	// 종소세 고객 수정클릭시 select : 끝
	
	
	
	if($_POST["action"]=="add_new_inc_cst")
	{ 
		
        $CSTNAME=mysqli_real_escape_string($connect,$_POST["cstname"]);
        $MOBILE=mysqli_real_escape_string($connect,$_POST["mobile"]);
        $INF_PATH=mysqli_real_escape_string($connect,$_POST["inf_path"]);
        $output = array();
        
        $procedure = "
		CREATE  PROCEDURE `MAIN_INC_NEW_CST`(
			IN P_CSTNAME VARCHAR(50), 
			P_MOBILE VARCHAR(50),
            P_INF_PATH VARCHAR(50)
			)
BEGIN
				
			DECLARE TMP_BIZID INT;
			DECLARE TMP_CSTID INT;
			DECLARE CNT INT;
			DECLARE CNT_TB100023 INT;
			DECLARE CNT_TB100026 INT;
            DECLARE CNT_TB100032 INT;
			
			
				SELECT COUNT(1) INTO CNT FROM TB100020 
                WHERE REPLACE(CSTNAME,' ','') = REPLACE(P_CSTNAME,' ','') 
                AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');
				
				IF IFNULL(CNT,0) > 0 THEN 
					SELECT CSTID INTO TMP_CSTID FROM TB100020 WHERE REPLACE(CSTNAME,' ','') = REPLACE(P_CSTNAME,' ','') 
                    AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');

                    SELECT BIZ_ID INTO TMP_BIZID FROM TB100022 
                    WHERE CSTID = TMP_CSTID AND CST_TYPE='A1001' AND CST_TYPE_YEAR=$SET_YEAR;					
			
					IF IFNULL(TMP_BIZID,'') = '' THEN
						INSERT INTO TB100022(CSTID, REGDATE, CST_TYPE, CST_TYPE_YEAR, CST_TYPE_SEQ, INF_PATH, INF_CHANNEL)
 						SELECT TMP_CSTID, NOW(),'A1001',$SET_YEAR,'1',P_INF_PATH, P_INF_PATH;
						SELECT last_insert_id() INTO TMP_BIZID;
					END IF;
					
					SELECT COUNT(1) INTO CNT_TB100023 FROM TB100023 WHERE BIZ_ID = TMP_BIZID;
					IF CNT_TB100023 = 0 THEN
						INSERT INTO TB100023(BIZ_ID,CSTID)
						SELECT TMP_BIZID,TMP_CSTID;
					END IF;
			
					SELECT COUNT(1) INTO CNT_TB100026 FROM TB100026 WHERE BIZ_ID = TMP_BIZID;
					IF CNT_TB100026 = 0 THEN
						INSERT INTO TB100026(BIZ_ID, PROGRESS, REGDATE)
						SELECT TMP_BIZID, 'E7201', NOW();
					END IF;
			
				ELSE
					
					INSERT INTO TB100020(CSTNAME, MOBILE,REGDATE, AGREEMENT,AG_REGDATE)
					SELECT P_CSTNAME, REPLACE(REPLACE(P_MOBILE,'-',''),' ',''), NOW() ,'Y',NOW();
					SELECT last_insert_id() INTO TMP_CSTID;
			
					INSERT INTO TB100022(CSTID, REGDATE, CST_TYPE, CST_TYPE_YEAR, CST_TYPE_SEQ, INF_PATH, INF_CHANNEL)
					SELECT TMP_CSTID, NOW(),'A1001',$SET_YEAR,'1',P_INF_PATH, P_INF_PATH;
					SELECT last_insert_id() INTO TMP_BIZID;
					
					INSERT INTO TB100023(BIZ_ID,CSTID)
					SELECT TMP_BIZID,TMP_CSTID;
			
					INSERT INTO TB100026(BIZ_ID, PROGRESS, REGDATE)
					SELECT TMP_BIZID, 'E7201', NOW();
					
				END IF;

                #빠른스크래핑용 데이터 INSERT
                SELECT COUNT(1) INTO CNT_TB100032 FROM TB100032 WHERE CSTNAME = P_CSTNAME 
                AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');

                IF CNT_TB100032 = 0 THEN
                    INSERT INTO TB100032(CSTNAME, MOBILE, CSTID)
                    SELECT P_CSTNAME,P_MOBILE,TMP_CSTID;
                END IF;
                #빠른스크래핑용 데이터 INSERT
			
				
				SELECT TMP_CSTID;
			END
		";
        
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS MAIN_INC_NEW_CST"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL MAIN_INC_NEW_CST('".$CSTNAME."' , '".$MOBILE."','".$INF_PATH."')";
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

	
	
	
	
	
	if($_POST["action"]=="update_add_info")
	{
	    $id=mysqli_real_escape_string($connect,$_POST["id"]);
	    $total_paid=mysqli_real_escape_string($connect,$_POST["total_paid"]);
	    $est_tax=mysqli_real_escape_string($connect,$_POST["est_tax"]);
	    $est_fee=mysqli_real_escape_string($connect,$_POST["est_fee_tmp"]);
	    	    
	    $output = array();
	    
	    $procedure = "CREATE PROCEDURE UPDATE_ADD_INFO( IN P_ID INT, P_TOTAL_PAID DOUBLE
, P_EST_FEE INT, P_EST_TAX INT
 )
		BEGIN
	        
			UPDATE TB100022 SET POP_AMOUNT_PAID = P_TOTAL_PAID, 
            EST_FEE_SELF=P_EST_FEE,
            EXP_PAY_TAX_SELF = P_EST_TAX
            WHERE CSTID = P_ID AND CST_TYPE='A1001' AND CST_TYPE_YEAR = $SET_YEAR;
	        
		END
		";
	    
	    //기존에 프로시저가 있으면 삭제
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_ADD_INFO"))
	    { //위에서 만든 프로시저 실행
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL UPDATE_ADD_INFO('".$id."','".$total_paid."',".$est_fee.",".$est_tax.")";
	            //프로시저 호출
	            mysqli_query($connect,$query);
	        }
	    }
	}
	
	
	
	
	if($_POST["action"]=="action_insert_HT_info")
	{ 
	    $id=mysqli_real_escape_string($connect,$_POST["id"]);
	    $HTID=mysqli_real_escape_string($connect,$_POST["HTID"]);
	    $HTPW=mysqli_real_escape_string($connect,$_POST["HTPW"]);
	    $CSTNAME=mysqli_real_escape_string($connect,$_POST["CSTNAME"]);
	    $MOBILE=mysqli_real_escape_string($connect,$_POST["MOBILE"]);
	    
	    $output = array();
	    
	    $procedure = "CREATE PROCEDURE UPDATE_HTID_HTPW( IN P_ID INT, P_HTID VARCHAR(50), P_HTPW VARCHAR(50),
        P_CSTNAME VARCHAR(45), P_MOBILE VARCHAR(45)
 )
		BEGIN
            
			UPDATE TB100020 SET HomeTaxID = P_HTID, HomeTaxPW=P_HTPW
            WHERE CSTID = P_ID;

            UPDATE TB100032 SET HomeTaxID = P_HTID, HomeTaxPW=P_HTPW, COPY_FLAG='R'
            WHERE CSTID = P_ID;

           
		END
		";
	    
	    //기존에 프로시저가 있으면 삭제
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_HTID_HTPW"))
	    { //위에서 만든 프로시저 실행
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL UPDATE_HTID_HTPW('".$id."','".$HTID."','".$HTPW."','".$CSTNAME."' , '".$MOBILE."')";
	            //프로시저 호출
	            mysqli_query($connect,$query);
	        }
	    }
	}

	
	
	
	
	
	if($_POST["action"]=="save_resident")
	{
	    $id=mysqli_real_escape_string($connect,$_POST["id"]);
	    $res1=mysqli_real_escape_string($connect,$_POST["res1"]);
	    $res2=mysqli_real_escape_string($connect,$_POST["res2"]);
	    
	    $output = array();
	    
	    $procedure = "CREATE PROCEDURE UPDATE_RESIDENT_ID( IN P_ID INT, P_RES1 VARCHAR(50), P_RES2 VARCHAR(50) )
		BEGIN
			UPDATE TB100020 SET RESIDENT_ID = CONCAT(P_RES1,'-',P_RES2)
            WHERE CSTID = P_ID;
		END
		";
	    
	    //기존에 프로시저가 있으면 삭제
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_RESIDENT_ID"))
	    { //위에서 만든 프로시저 실행
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL UPDATE_RESIDENT_ID('".$id."','".$res1."','".$res2."')";
	            //프로시저 호출
	            mysqli_query($connect,$query);
	        }
	    }
	}
	
	
	if($_POST["action"]=="select_inc_filecnt"){
	    $id=mysqli_real_escape_string($connect,$_POST["id"]);
	    $procedure = "
		CREATE PROCEDURE SELECT_FILE_CNT()
		BEGIN
			SELECT * FROM TB100020 WHERE CSTID = '".$id."';
		END;
		";
	    $output = array();
	    $path = "../admin/upload_income/2021/";
	    $hostname=$_SERVER["HTTP_HOST"];
	    
	    //기존에 프로시저가 있으면 삭제
	    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_FILE_CNT"))
	    { //위에서 만든 프로시저 실행
	        if(mysqli_query($connect,$procedure))
	        {
	            $query = "CALL SELECT_FILE_CNT()";
	            //프로시저 호출
	            $result = mysqli_query($connect,$query);
	            
	            if(mysqli_num_rows($result) >0)
	            {
	                while($row = mysqli_fetch_array($result)){
	                    if($hostname=="localhost")
	                        $iconv_cstname = $row["CSTNAME"];
                        else
                            $iconv_cstname = iconv("UTF-8","CP949",$row["CSTNAME"]);
                        
	                    $MOBILE = $row["MOBILE"];
	                    $dir = $path.$iconv_cstname."_".$MOBILE."/";
	                    //$down_dir = iconv("UTF-8","EUC-KR","../tax_income/upload/".$CSTNAME."_".$MOBILE."/");
	                    //$down_dir = "upload/".$iconv_cstname."_".$MOBILE."/";
	                    //$dir = iconv("UTF-8","EUC-KR",$dir);
	                    $FILE_CNT=0;
	                    if (is_dir($dir)){
	                        if ($dh = opendir($dir)){                     //$df = array_diff(scandir($dir),$ignore);
	                            while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
	                                continue;
	                            }else{
	                                $FILE_CNT++;
	                            }
	                            
	                            }
	                            closedir($dh);
	                        }
	                    }
	                    
	                    $output["FILE_CNT"] = $FILE_CNT;
	                }// END WHILE
	            }
	            
	        }
	    }
	    
	    
	    
	    echo json_encode($output);
	    
	}
	
	
	
	if($_POST["action"]=="select_inc_info")
	{
	    $id=mysqli_real_escape_string($connect,$_POST["id"]);
	    $output = array();
	    $path = "upload/";
	    $procedure = "CREATE PROCEDURE SELECT_CSTNAME_MOBILE(IN P_ID INT )
		BEGIN
			SELECT A.CSTID, A.CSTNAME, A.MOBILE,A.HomeTaxID,A.HomeTaxPW, 
                FORMAT(CAL_INC(A.CSTID),0) AS 'EXP_PAY_TAX_FN', 
                CAL_FEE_CHANGE_DATE(A.CSTID) AS 'CAL_EST_FEE_FN',
                CAL_FEE_MONEY(E.AMOUNT_PAID) AS 'CAL_EST_FEE_FN2'
            	FROM TB100020 AS A
            	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
            	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
            	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER            
                LEFT OUTER JOIN TB100032 AS E ON A.CSTID = E.CSTID
            WHERE A.CSTID = P_ID LIMIT 1;
		END
		";
	    
	    
	    try{
	        //기존에 프로시저가 있으면 삭제
	        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CSTNAME_MOBILE"))
	        { //위에서 만든 프로시저 실행
	            if(mysqli_query($connect,$procedure))
	            {
	                $query = "CALL SELECT_CSTNAME_MOBILE('".$id."')";
	                //프로시저 호출
	                $result = mysqli_query($connect,$query);
	                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
	                
	                while($row = mysqli_fetch_array($result)){
	                    $output['CSTID']= $row["CSTID"];
	                    $output['CSTNAME']= $row["CSTNAME"];
	                    $output['MOBILE'] = $row["MOBILE"];
	                    $output['HTID'] = $row["HomeTaxID"];
	                    $output['HTPW'] = $row["HomeTaxPW"];
	                    $output['EXP_PAY_TAX'] = $row["EXP_PAY_TAX_FN"];
	                    
	                    $output['RESIDENT_ID1'] = $row["RESIDENT_ID1"];
	                    $output['RESIDENT_ID2'] = $row["RESIDENT_ID2"];
	                    $output['REGDATE'] = $row["REGDATE_"];
	                    
	                    $est_fee1 =  $row["CAL_EST_FEE_FN"];
	                    $est_fee2 =  $row["CAL_EST_FEE_FN2"];
	                    
	                    if( ($est_fee1 == null || $est_fee1=="") && ($est_fee2 != ""|| $est_fee2!=null)){
	                        $output['EST_FEE'] = $est_fee2;//$est_paid = $est_fee2;
	                    }else{
	                        $output['EST_FEE'] = $est_fee1;//$est_paid = $est_fee1;
	                    }
	                    
	                }
	            }
	        }
	        
	        
	    }
	    catch(Exception $e){
	        echo $e;
	    }
	    
	    
	    
	    
	    echo json_encode($output);
	}
	
	
	

	if($_POST["action"]=="추가")
	{ 
		//ajax로 넘긴 data를 받아준다.
		$NEW_HP=mysqli_real_escape_string($connect,$_POST["NEW_HP"]);
		$Q_TYPE=mysqli_real_escape_string($connect,$_POST["Q_TYPE"]);

		//insert 프로시저 생성
		$procedure = "CREATE PROCEDURE insertNEWHP(IN NEW_HP varchar(20), Q_TYPE varchar(20) )
		BEGIN
		INSERT INTO NEW_HP(NEW_HP,Q_TYPE,REGDATE,GUBUN) VALUES(NEW_HP,Q_TYPE,NOW(),'종합소득세');
		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertNEWHP"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL insertNEWHP('".$NEW_HP."','".$Q_TYPE."')";
				//프로시저 호출
				mysqli_query($connect,$query);

				/*
				// 당일 중복신청고객 체크
				*/
				/*
				$procedure_HPCHECK = "SELECT NEW_HP FROM NEW_HP WHERE NEW_HP = '".$NEW_HP."' AND DATE_FORMAT(REGDATE,'%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')";
				
				$result_chk = mysqli_query($connect,$procedure_HPCHECK) or die("SQL error");

				while ($row = mysqli_fetch_array($result_chk)) {
				 $NEW_HP_CHK = $row["NEW_HP"];
				}*/

				/*
				// 당일 중복신청고객 체크
				*/

				//if($NEW_HP_CHK == ''){ // 당일중복 아닐경우에만 이하 실행
					
					/*
					* 전화 지점별 로테이션처리
					*/
					//$procedure_lot = "SELECT * FROM CALL_LOTATION WHERE CALL_LOTATION = 'Y'";
					//$query_UPT = "CALL CALL_LOTATION()";

					//$result_lot = mysqli_query($connect,$procedure_lot) or die("SQL error");
/*
					while ($row2 = mysqli_fetch_array($result_lot)) {
					 $lot_mobile = $row2["MOBILE"];
					 $branch_name = $row2["BRANCH_NAME"];
					}

					mysqli_query($connect,$query_UPT);
*/
					/*
					* 전화 지점별 로테이션처리
					*/


					/*
					 * 뿌리오 발송API 알림 TO : 신승직원
					 */
					$_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';

					$_param['userid'] = 'shinseung'; // [필수] 뿌리오 아이디
					$_param['callback'] = '18993582'; // [필수] 발신번호 - 숫자만

					if($Q_TYPE == '종합소득세'){
						$_param['phone'] = '01038484309'; //	정혜숙	
//						$_param['phone'] = $lot_mobile; //	개발테스트
					}else if($Q_TYPE == '등록대행&법인설립지원'){
						$_param['phone'] = '01030925352'; //  노준석
					}
					else if($Q_TYPE == '정책자금'){
						$_param['phone'] = '01030925352'; //  노준석 
					}
					//여러명일 경우 |로 구분 010********|010********|

					$_param['msg'] = $Q_TYPE.' 전화상담 요청이 왔습니다. => '.$NEW_HP;
					$_param['subject'] = '응대요청';


					if($_day > 0 and $_day <6){
						if($_hour > 900 and $_hour < 2100){
										
							$_curl = curl_init();
							curl_setopt($_curl,CURLOPT_URL,$_api_url);
							curl_setopt($_curl,CURLOPT_POST,true);
							curl_setopt($_curl,CURLOPT_SSL_VERIFYPEER,false);
							curl_setopt($_curl,CURLOPT_RETURNTRANSFER,true);
							curl_setopt($_curl,CURLOPT_POSTFIELDS,$_param);
							$_result = curl_exec($_curl);
							curl_close($_curl);

							$_result = json_decode($_result);
						}
					}

					/*
					 * 뿌리오 발송API 끝
					 */


					

					/*
					 * 뿌리오 발송API 접수알림 TO : 고객
					 */
					
					$_param['userid'] = 'shinseung';           // [필수] 뿌리오 아이디
					$_param['callback'] = '18993582';    // [필수] 발신번호 - 숫자만


					$_param['phone'] = $NEW_HP;


					//$_param['phone'] = $NEW_HP;       // [필수] 수신번호 - 여러명일 경우 |로 구분 '010********|010********|010********'


$_param['msg'] = '쉽고 빠른 세무서비스 세무톡 
국세청 33년 경력 신승세무법인과 함께합니다. 

상담 접수가 완료되었습니다. 

▶ 채팅상담 클릭
▶ https://taxtoc.channel.io

금일 전화상담 폭주로 인해 
전화상담이 지연되고 있습니다.
이점 양해 부탁드립니다. 

빠른 상담을 원하시면 
아래의 채팅상담 링크를 클릭하여 

▶[종합소득세 안내문]을 올려주시면 
신속하게 검토하여 답변드리겠습니다. 

▶ 채팅상담 클릭
▶ https://taxtoc.channel.io'; 


					$_param['subject'] = '접수 안내';          // [선택] 제목 (30byte)
/*
					//if($_day > 0 and $_day <6){
					//	if($_hour > 930 and $_hour < 1830){
							if($Q_TYPE != "구독" && $Q_TYPE != "정책자금" ){
								$_curl = curl_init();
								curl_setopt($_curl,CURLOPT_URL,$_api_url);
								curl_setopt($_curl,CURLOPT_POST,true);
								curl_setopt($_curl,CURLOPT_SSL_VERIFYPEER,false);
								curl_setopt($_curl,CURLOPT_RETURNTRANSFER,true);
								curl_setopt($_curl,CURLOPT_POSTFIELDS,$_param);
								$_result = curl_exec($_curl);
								curl_close($_curl);

								$_result = json_decode($_result);
							}
							*/
					//	}
					//}


				//} //신규HP체크


//사용자 화면단 노출 얼럿			
				switch($Q_TYPE){
					case "종합소득세" : echo '성공적으로 접수되었습니다. 

금일 전화상담 폭주로 인해 세액, 환급금, 수수료 안내가 지연되고 있습니다. 

이점 양해부탁드리며, 최대한 빨리 안내드리도록 하겠습니다. 

▶[종합소득세 안내문]을 올려주시지 않으면 
검토 안내를 드릴수 없는 점 다시한번 양해부탁드립니다. 
';
					break;

					case "등록대행&법인설립지원" : echo '성공적으로 전화상담 요청이 신청되었습니다. 
조금만 기다려주시면 빠르고 전문적인 전화상담이 가능합니다. 
전화상담 가능시간 : 평일 오전 10시 ~ 오후 6시';
					break;

					case "정책자금" : echo '성공적으로 서비스가 신청되었습니다. 
정기적으로 카톡 또는 문자로 세무, 정책자금, 사업관련 필요정보를 맞춤제공해드립니다.';
					break;

					case "구독" : echo '성공적으로 세무소식 무료구독이 등록되었습니다. 
정기적으로 카톡 또는 문자로 세무, 정책자금, 사업관련 필요정보를 맞춤제공해드립니다.';
					break;
					default:"default";
				}
			}

		}
	}

}


?> 