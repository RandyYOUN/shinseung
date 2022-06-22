<?php

//db연결
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");


//url을 통해 id 값이 존재하면
if(isset($_POST["id"]))
{

//빈 배열을 만들고
$output = array();

//넘어온 id에 해당하는 row를 출력하는 프로시저 쿼리를 만든다.
$procedure = "
	CREATE PROCEDURE whereUser(IN user_id int(100))
	BEGIN
		SELECT A.CSTID, A.CSTNAME, A.MOBILE, A.RESIDENT_ID,A.BRANCH, A.SECTOR, A.SECTOR_CODE, 
		B.CST_BIRTH, B.INFO_TYPE, B.ARS_CERT_NUM, B.DUTY_TYPE, B.EXP_RATIO , 
		D.INTEREST, D.ALLOCATION, D.WORK_SINGLE, D.WORK_PLUR, D.INFORMAL, D.ETC,
		E.EXI_TAX, FORMAT(E.NPIP,0) AS NPIP, E.PERSON_SAVE,E.SMALL_BIZ_DED, E.RET_SAVE, E.PEN_SAVE
		FROM TB100020 AS A 
		LEFT OUTER JOIN dbsschina.TB300010 AS B ON A.CSTID = B.CSTID
		LEFT OUTER JOIN dbsschina.TB300030 AS D ON A.CSTID = D.CSTID
		LEFT OUTER JOIN dbsschina.TB300031 AS E ON A.CSTID = E.CSTID
		WHERE A.CSTID = user_id;
	END;
	";
	//기존의 프로시저가 존재한다면 삭제 후
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereUser"))
	{
		//위에서 선언한 프로시저 선언(1)
		if(mysqli_query($connect, $procedure))
		{
		//프로시저 호출(2)
			$query = "CALL whereUser(".$_POST["id"].")";
			$result = mysqli_query($connect, $query);

			while($row = mysqli_fetch_array($result))
			{
				//위에서 만든 배열에 넣어준다.
				$output['CSTNAME'] = $row["CSTNAME"];
				$output['MOBILE'] = $row["MOBILE"];
				$output['RESIDENT_ID'] = $row["RESIDENT_ID"];
				$output['BRANCH'] = $row["BRANCH"];
				$output['SECTOR'] = $row["SECTOR"];
				$output['SECTOR_CODE'] = $row["SECTOR_CODE"];
				$output['CST_BIRTH'] = $row["CST_BIRTH"];
				$output['INFO_TYPE'] = $row["INFO_TYPE"];
				$output['ARS_CERT_NUM'] = $row["ARS_CERT_NUM"];
				$output['DUTY_TYPE'] = $row["DUTY_TYPE"];
				$output['EXP_RATIO'] = $row["EXP_RATIO"];
				$output['INTEREST'] = $row["INTEREST"];
				$output['ALLOCATION'] = $row["ALLOCATION"];
				$output['WORK_SINGLE'] = $row["WORK_SINGLE"];
				$output['WORK_PLUR'] = $row["WORK_PLUR"];
				$output['INFORMAL'] = $row["INFORMAL"];
				$output['ETC'] = $row["ETC"];
				$output['EXI_TAX'] = $row["EXI_TAX"];
				$output['NPIP'] = $row["NPIP"];
				$output['PERSON_SAVE'] = $row["PERSON_SAVE"];
				$output['SMALL_BIZ_DED'] = $row["SMALL_BIZ_DED"];
				$output['RET_SAVE'] = $row["RET_SAVE"];
				$output['PEN_SAVE'] = $row["PEN_SAVE"];

			}


			//json string 형식으로 변환 후 넘겨준다.
			echo json_encode($output);
		}
	}

}
?>