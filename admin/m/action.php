<?php
include "db_info.php";
//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
	
	//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");


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


	
	
	
	//양도 리스트 옵션값 수정 : 시작
	if($_POST["action"] == "upt_trans_opt"){
		$id=mysqli_real_escape_string($connect,$_POST["id"]);
		$prog=mysqli_real_escape_string($connect,$_POST["prog"]);
		$prio=mysqli_real_escape_string($connect,$_POST["prio"]);

		$procedure = "
			CREATE PROCEDURE UPDATE_TRANS_LIST(IN P_ID INT(11),P_PRIO VARCHAR(5) , P_PROG VARCHAR(5) )
			BEGIN
				
				UPDATE TB600010 SET PRIO_NUM = P_PRIO, PROGRESS= P_PROG
				WHERE ID = P_ID;
			END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TRANS_LIST"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL UPDATE_TRANS_LIST('".$id."','".$prio."','".$prog."')";
				//프로시저 호출
				mysqli_query($connect,$query);
				echo 'upt_trans_opt complate..';
				
			}
		}

	}
	//양도 리스트 옵션값 수정 : 끝


	//4대보험_등록 : 시작
	if($_POST["action"] == "action_4insu_insert"){
		$reguser=mysqli_real_escape_string($connect,$_POST["reguser"]);
		$progress=mysqli_real_escape_string($connect,$_POST["progress"]);
		$contents=mysqli_real_escape_string($connect,$_POST["contents"]);
		$reg_branch=mysqli_real_escape_string($connect,$_POST["reg_branch"]);
		$subject=mysqli_real_escape_string($connect,$_POST["subject"]);
		$reg_dept=mysqli_real_escape_string($connect,$_POST["reg_dept"]);
		$quest_flag=mysqli_real_escape_string($connect,$_POST["quest_flag"]);
		$svr_code=mysqli_real_escape_string($connect,$_POST["svr_code"]);
		$company_name=mysqli_real_escape_string($connect,$_POST["company_name"]);
		$company_phone=mysqli_real_escape_string($connect,$_POST["company_phone"]);
		$file_real_str=mysqli_real_escape_string($connect,$_POST["file_real_str"]);
		$file_view_str=mysqli_real_escape_string($connect,$_POST["file_view_str"]);
		$cate=mysqli_real_escape_string($connect,$_POST["cate"]);

		$procedure = "
			CREATE PROCEDURE INSERT_4INSU(IN P_REGUSER INT(11),P_PROGRESS VARCHAR(5) , P_CONTENTS LONGTEXT, P_REG_BRANCH VARCHAR(5),P_SUBJECT VARCHAR(200),P_REG_DEPT VARCHAR(5), P_QUEST_FLAG VARCHAR(5),P_SVR_CODE VARCHAR(50),P_COMPANY_NAME VARCHAR(50),P_COMPANY_PHONE VARCHAR(45), P_FILE_REAL_STR LONGTEXT, P_FILE_VIEW_STR LONGTEXT, P_CATE VARCHAR(5)  )
			BEGIN

				DECLARE TMP_NUM INT(11) DEFAULT 0;

				SELECT MAX(IFNULL(NUM,0))+1 INTO TMP_NUM FROM TB600020;
				
				INSERT INTO TB600020(NUM,REGUSER,REGDATE,PROGRESS,CONTENTS,REG_BRANCH,SUBJECT , REG_DEPT, QUEST_FLAG, SVR_CODE, COMPANY_NAME, COMPANY_PHONE, FILE_REAL_STR, FILE_VIEW_STR ,CATE) VALUES(TMP_NUM,P_REGUSER,NOW(), P_PROGRESS, P_CONTENTS, P_REG_BRANCH,P_SUBJECT, P_REG_DEPT,P_QUEST_FLAG, P_SVR_CODE, P_COMPANY_NAME, P_COMPANY_PHONE, P_FILE_REAL_STR, P_FILE_VIEW_STR,P_CATE);
			

			END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_4INSU"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL INSERT_4INSU('".$reguser."','".$progress."','".$contents."','".$reg_branch."','".$subject."','".$reg_dept."','".$quest_flag."','".$svr_code."','".$company_name."','".$company_phone."','".$file_real_str."','".$file_view_str."','".$cate."')";
				//프로시저 호출
				mysqli_query($connect,$query);
				echo '성공적으로 입력 되었습니다.';
				
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
		$svr_code=mysqli_real_escape_string($connect,$_POST["svr_code"]);
		$company_name=mysqli_real_escape_string($connect,$_POST["company_name"]);
		$company_phone=mysqli_real_escape_string($connect,$_POST["company_phone"]);
		$file_real_str=mysqli_real_escape_string($connect,$_POST["file_real_str"]);
		$file_view_str=mysqli_real_escape_string($connect,$_POST["file_view_str"]);
		$cate=mysqli_real_escape_string($connect,$_POST["cate"]);
		$num=mysqli_real_escape_string($connect,$_POST["num"]);
		$contents=mysqli_real_escape_string($connect,$_POST["contents"]);

		$procedure = "
			CREATE PROCEDURE UPDATE_4INSU(IN P_REGUSER INT(11),P_PROGRESS VARCHAR(5) , P_CONTENTS LONGTEXT, P_REG_BRANCH VARCHAR(5),P_SUBJECT VARCHAR(200),P_REG_DEPT VARCHAR(5), P_QUEST_FLAG VARCHAR(5),P_SVR_CODE VARCHAR(50),P_COMPANY_NAME VARCHAR(50),P_COMPANY_PHONE VARCHAR(45), P_FILE_REAL_STR LONGTEXT, P_FILE_VIEW_STR LONGTEXT, P_CATE VARCHAR(5), P_NUM INT(11),P_EDTUSER VARCHAR(5), P_ID INT(11) )
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
				SVR_CODE = P_SVR_CODE,
				COMPANY_NAME = P_COMPANY_NAME,
				COMPANY_PHONE = P_COMPANY_PHONE,
				FILE_REAL_STR=file_real_str,
				FILE_VIEW_STR=file_view_str,
				CATE = P_CATE,
				NUM = P_NUM
				WHERE ID = P_ID ;			

			END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_4INSU"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL UPDATE_4INSU('".$reguser."','".$progress."','".$contents."','".$reg_branch."','".$subject."','".$reg_dept."','".$quest_flag."','".$svr_code."','".$company_name."','".$company_phone."','".$file_real_str."','".$file_view_str."','".$cate."','".$num."','".$edtuser."','".$cstid."')";
				//프로시저 호출
				mysqli_query($connect,$query);
				echo '수정 되었습니다.';
			}
		}

	}
	//4대보험_수정 : 끝


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


		$procedure = "
			CREATE PROCEDURE UPDATE_TRANS(IN REGUSER INT(11),PROGRESS VARCHAR(5) , CONTENTS LONGTEXT, REG_BRANCH VARCHAR(5), TAX_FLAG VARCHAR(5), CSTNAME VARCHAR(50), MOBILE VARCHAR(50), CST_ADDRESS VARCHAR(200),TRANS_TARGET VARCHAR(5),PAY_FLAG VARCHAR(5), PAY_DATE DATETIME, PRICE INT(11),PRICE2 INT(11),TRANS_DATE DATETIME, ACQ_DATE DATETIME, DELIVERY_FLAG VARCHAR(5), TRANS_PRICE INT(11),ACQ_PRICE INT(11),DEADLINE DATETIME, TOTAL_TAX INT(11), FILE_REAL_STR LONGTEXT, FILE_VIEW_STR LONGTEXT, CSTID INT(11), CATE VARCHAR(5), OWNER VARCHAR(5), NUM INT(11), PRIO_NUM VARCHAR(5) )
			BEGIN

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
				PRIO_NUM = prio_num
				WHERE ID = cstid ;			

			END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPDATE_TRANS"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL UPDATE_TRANS('".$reguser."','".$progress."','".$contents."','".$reg_branch."','".$tax_flag."','".$cstname."','".$mobile."','".$cst_address."','".$trans_target."','".$pay_flag."','".$pay_date."','".$price."','".$price2."','".$trans_date."','".$acq_date."','".$delivery_flag."','".$trans_price."','".$acq_price."','".$deadline."','".$total_tax."','".$file_real_str."','".$file_view_str."','".$cstid."','".$cate."','".$owner."','".$num."','".$prio_num."')";
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


		$procedure = "
			CREATE PROCEDURE INSERT_TRANS(IN REGUSER INT(11),PROGRESS VARCHAR(5) , CONTENTS LONGTEXT, REG_BRANCH VARCHAR(5), TAX_FLAG VARCHAR(5), CSTNAME VARCHAR(50), MOBILE VARCHAR(50), CST_ADDRESS VARCHAR(200),TRANS_TARGET VARCHAR(5),PAY_FLAG VARCHAR(5), PAY_DATE DATETIME, PRICE INT(11),PRICE2 INT(11),TRANS_DATE DATETIME, ACQ_DATE DATETIME, DELIVERY_FLAG VARCHAR(5), TRANS_PRICE INT(11),ACQ_PRICE INT(11),DEADLINE DATETIME, TOTAL_TAX INT(11), FILE_REAL_STR LONGTEXT, FILE_VIEW_STR LONGTEXT, CATE VARCHAR(5) ,OWNER VARCHAR(5), PRIO_NUM VARCHAR(5) )
			BEGIN

				DECLARE TMP_NUM INT(11) DEFAULT 0;

				SELECT MAX(NUM)+1 INTO TMP_NUM FROM TB600010;
				
				INSERT INTO TB600010(NUM,REGUSER,REGDATE,PROGRESS,CONTENTS,REG_BRANCH,TAX_FLAG,CSTNAME, MOBILE, CST_ADDRESS,TRANS_TARGET,PAY_FLAG, PAY_DATE,PRICE,PRICE2,TRANS_DATE, ACQ_DATE,DELIVERY_FLAG,TRANS_PRICE,ACQ_PRICE,DEADLINE,TOTAL_TAX, FILE_REAL_STR, FILE_VIEW_STR ,CATE,OWNER_USER, PRIO_NUM) VALUES(TMP_NUM,reguser,NOW(), progress, contents, reg_branch, tax_flag, cstname, mobile,cst_address,trans_target,pay_flag,pay_date,REPLACE(price,',',''),REPLACE(price2,',',''),trans_date,acq_date,delivery_flag,REPLACE(trans_price,',',''),REPLACE(acq_price,',',''),deadline,total_tax, file_real_str, file_view_str,cate,owner, prio_num);
			

			END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TRANS"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL INSERT_TRANS('".$reguser."','".$progress."','".$contents."','".$reg_branch."','".$tax_flag."','".$cstname."','".$mobile."','".$cst_address."','".$trans_target."','".$pay_flag."','".$pay_date."','".$price."','".$price2."','".$trans_date."','".$acq_date."','".$delivery_flag."','".$trans_price."','".$acq_price."','".$deadline."','".$total_tax."','".$file_real_str."','".$file_view_str."','".$cate."','".$owner."','".$prio_num."')";
				//프로시저 호출
				mysqli_query($connect,$query);
				echo '성공적으로 입력 되었습니다.';
				
			}
		}

	}
	//양도등록 생성 : 끝



	//신규직원 생성 : 시작
	if($_POST["action"] == "reg_member"){
		$member_id=mysqli_real_escape_string($connect,$_POST["member_id"]);
		$member_pw=mysqli_real_escape_string($connect,$_POST["member_pw"]);
		$member_name=mysqli_real_escape_string($connect,$_POST["member_name"]);
		$depid=mysqli_real_escape_string($connect,$_POST["depid"]);

		$procedure = "
			CREATE PROCEDURE INSERT_TB980010(IN member_id VARCHAR(45),member_pw VARCHAR(45) , member_name VARCHAR(45), depid varchar(5) )
			BEGIN

			DECLARE CNT INT(11) default 0;
			DECLARE TMP INT(11) default 0;

			SELECT COUNT(*) INTO CNT FROM TB980010
			WHERE ID = member_id;
			
			SELECT CNT FROM DUAL;
			
			IF CNT = 0
			THEN
				SELECT MAX(USERID)+1 INTO TMP FROM TB980010;

				INSERT INTO TB980010(USERID,ID, PW, USERNAME,DEPID, REGDATE, EDTDATE ) VALUES(TMP,member_id, PASSWORD(member_pw),member_name,depid, NOW(), NOW());
			END IF;
			
			IF CNT > 0
			THEN
				UPDATE TB980010 SET PW=PASSWORD(member_pw), USERNAME=member_name, DEPID=depid, EDTDATE = NOW()
				WHERE ID = member_id ;
			END IF;
			END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_TB980010"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL INSERT_TB980010('".$member_id."','".$member_pw."','".$member_name."','".$depid."')";
				//프로시저 호출
				mysqli_query($connect,$query);
				echo '성공적으로 입력 되었습니다.';
			}
		}

	}
	//신규직원 생성 : 끝

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
		CREATE PROCEDURE insert_TB100020(IN numbering varchar(5),cstname varchar(45),mobile varchar(45),resident1 varchar(10),resident2 varchar(10), ref_bank varchar(45),ref_acc varchar(100),branch varchar(10), server INT(11), server_num VARCHAR(5), hometaxid VARCHAR(45),hometaxpw VARCHAR(45) ,cst_type varchar(10) )
		BEGIN

		DECLARE resident_id VARCHAR(15);

		SET resident_id = CONCAT(resident1,'-',resident2);

		INSERT INTO TB100020(NUMBERING,CSTNAME, MOBILE,RESIDENT_ID,REF_BANK,REF_ACC, WRITE_REGDATE, BRANCH, SERVER, SERVER_NUM, HomeTaxID, HomeTaxPW, CST_TYPE) VALUES(numbering,cstname,mobile,resident_id,ref_bank,ref_acc, NOW(),branch, server, server_num, hometaxid, hometaxpw,cst_type);
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
