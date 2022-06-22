<?php 
include("db_info.php");

//	$numbering=mysqli_real_escape_string($connect,$_POST["numbering"]);
	$cstname=mysqli_real_escape_string($connect,$_GET["cstname"]);
	$mobile=mysqli_real_escape_string($connect,$_GET["mobile"]);

	$procedure = "
	CREATE PROCEDURE insert_TB100020_DEV(IN numbering varchar(5),cstname varchar(45),mobile varchar(45),resident1 varchar(10),resident2 varchar(10), ref_bank varchar(45),ref_acc varchar(100),branch varchar(10), server INT(11), server_num VARCHAR(5), hometaxid VARCHAR(45),hometaxpw VARCHAR(45) ,cst_type varchar(10) )
	BEGIN

	DECLARE resident_id VARCHAR(15);
	DECLARE TMP_CSTNAME VARCHAR(50);
	DECLARE TMP_MOBILE VARCHAR(50);
	DECLARE TMP_CNT INT ;
	SET resident_id = CONCAT(resident1,'-',resident2);
	
	SELECT COUNT(1) INTO TMP_CNT FROM TB100020 WHERE CSTNAME='' AND MOBILE='';

	IF TMP_CNT > 0
	THEN
		UPDATE TB100020 SET UPT_CHECK = 'Y' WHERE CSTNAME = cstname AND MOBILE = mobile;
	ELSE
		INSERT INTO TB100020(CSTNAME, MOBILE) VALUES(cstname,mobile);
	END
	";

	//기존에 프로시저가 있으면 삭제
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_TB100020_DEV"))
	{ //위에서 만든 프로시저 실행
		if(mysqli_query($connect,$procedure))
		{
		$query = "CALL insert_TB100020_DEV('".$cstname."','".$mobile."')";
		//프로시저 호출
		mysqli_query($connect,$query);
		echo json_encode('200');
		}
	}

?>

