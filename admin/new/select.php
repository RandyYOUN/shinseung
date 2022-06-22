<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수

$action = $_POST["action"];
//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

if($action == "select_view" && isset($_POST["id"])){
	
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


if($action == "select_view_ext" && isset($_POST["id"])){
	
	if($_POST["flag"]=="TB300020"){
		
		$procedure = "
		CREATE PROCEDURE SELECT_TB300020(IN user_id int(100))
		BEGIN
			SELECT *,FORMAT(AMOUNT_PAID,0) AS AMOUNT_PAID_ ,
			(SELECT REPLACE( DUTY_TYPE ,'대상자','')FROM TB300010 WHERE CSTID = user_id) AS DUTY_TYPE_ 
			FROM TB300020 WHERE CSTID = user_id;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300020"))
		{
		//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB300020(".$_POST["id"].")";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);


				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";
					while($row = mysqli_fetch_array($result)){
						$output .= '
						<tr>
							<td>'.$row["BIZ_NUM"].'</td>
							<td>'.$row["COMPANY"].'</td>
							<td>'.$row["INCOME_TYPE"].'</td>
							<td>'.$row["SEC_CODE"].'</td>
							<td>'.$row["BIZ_FORM"].'</td>
							<td>'.$row["DUTY_TYPE_"].'</td>
							<td>'.$row["AMOUNT_PAID_"].'원</td>
							<td>'.$row["REF_RATIO_N"].'</td>
							<td>'.$row["REF_RATIO_S"].'</td>
							<td>'.$row["SIM_RATIO_N"].'</td>
							<td>'.$row["SIM_RATIO_S"].'</td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
					<td colspan="11" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

			}

		}
		echo $output;
	} // if($_POST["flag"]=="TB300020"){ ... END



	if($_POST["flag"]=="TB300040"){
	
		$procedure = "
		CREATE PROCEDURE SELECT_TB300040(IN user_id int(100))
		BEGIN
			SELECT (SELECT VALUE_ FROM TB750010 WHERE CODE_ = CODE ) AS CODE_,
			(SELECT VALUE FROM TB300040 WHERE CSTID = user_id AND  YEAR=YEAR(NOW())-2 AND CODE=A.CODE ) AS YEAR_1,
			(SELECT VALUE FROM TB300040 WHERE CSTID = user_id AND  YEAR=YEAR(NOW())-3 AND CODE=A.CODE ) AS YEAR_2,
			(SELECT VALUE FROM TB300040 WHERE CSTID = user_id AND  YEAR=YEAR(NOW())-4 AND CODE=A.CODE ) AS YEAR_3
			 FROM TB300040 AS A WHERE A.CSTID = user_id AND YEAR=YEAR(NOW())-2 ;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300040"))
		{
		//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB300040(".$_POST["id"].")";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);


				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";

					while($row = mysqli_fetch_array($result)){

						$output .= '
						<tr>
							<td>'.$row["CODE_"].'</td>
							<td>'.$row["YEAR_3"].'</td>
							<td>'.$row["YEAR_2"].'</td>
							<td>'.$row["YEAR_1"].'</td>
						</tr>

						';
					}
				}// 네번째 if문 끝
				else
				{
					$output .= '
					<tr>
					<td colspan="4" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

			}

		}
		echo $output;
	} // if($_POST["flag"]=="TB300040"){ ... END





	if($_POST["flag"]=="TB300050"){
	
		$procedure = "
		CREATE PROCEDURE SELECT_TB300050(IN user_id int(100))
		BEGIN
			SELECT (SELECT VALUE_ FROM TB750010 WHERE CODE_ = CODE ) AS CODE_,PRICE,COMP,AVG FROM TB300050 AS A WHERE A.CSTID = user_id ;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300050"))
		{
		//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB300050(".$_POST["id"].")";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);


				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";

					while($row = mysqli_fetch_array($result)){

						$output .= '
						<tr>
							<td>'.$row["CODE_"].'</td>
							<td>'.$row["PRICE"].'</td>
							<td>'.$row["COMP"].'</td>
							<td>'.$row["AVG"].'</td>
						</tr>

						';
					}
				}// 네번째 if문 끝
				else
				{
					$output .= '
					<tr>
					<td colspan="4" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

			}

		}
		echo $output;
	} // if($_POST["flag"]=="TB300050"){ ... END




	if($_POST["flag"]=="TB300060"){
	
		$procedure = "
		CREATE PROCEDURE SELECT_TB300060(IN user_id int(100))
		BEGIN
			SELECT 
			 '건수' AS GUBUN,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1111' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1111 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1112' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1112 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1113' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1113 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1114' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1114 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1115' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1115 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1116' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1116 
			 FROM DUAL
			 UNION ALL 
			 SELECT 
			 '금액' AS GUBUN,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1111' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1111 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1112' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1112 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1113' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1113 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1114' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1114 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1115' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1115 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1116' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1116 
			 FROM DUAL;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300060"))
		{
		//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB300060(".$_POST["id"].")";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);


				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";

					while($row = mysqli_fetch_array($result)){

						$output .= '
						<tr>
							<td>'.$row["GUBUN"].'</td>
							<td>'.$row["B1111"].'</td>
							<td>'.$row["B1112"].'</td>
							<td>'.$row["B1113"].'</td>
							<td>'.$row["B1114"].'</td>
							<td>'.$row["B1115"].'</td>
							<td>'.$row["B1116"].'</td>
						</tr>

						';
					}
				}// 네번째 if문 끝
				else
				{
					$output .= '
					<tr>
					<td colspan="7" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

			}

		}
		echo $output;
	} // if($_POST["flag"]=="TB300060"){ ... END
	
} // if($action == "select_view_ext" ... END




if($action == "select_modify" && isset($_POST["id"])){
	
	$output = array();

	//넘어온 id에 해당하는 row를 출력하는 프로시저 쿼리를 만든다.
	$procedure = "
		CREATE PROCEDURE whereUser(IN user_id int(100))
		BEGIN
		SELECT * FROM SS_NEWS WHERE id = user_id;
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
					$output['SUBJECT'] = $row["SUBJECT"];
					$output['NEWS_REGUSER'] = $row["NEWS_REGUSER"];
					$output['NEWS_REGDATE'] = $row["NEWS_REGDATE"];
					$output['NEWS_REGUSER_COMP'] = $row["NEWS_REGUSER_COMP"];
					$output['CONTENTS'] = $row["CONTENTS_"];
					$output['IMG_URL'] = $row["IMG_URL"];
					$output['IMG_URL_FLAG'] = $row["IMG_URL_FLAG"];
					$output['FILE_URL'] = $row["FILE_URL"];
					$output['CATE'] = $row["CATE"];
					$output['C_CATE'] = $row["C_CATE"];
					$output['VISIBLE'] = $row["VISIBLE"];
					$output['SITE_GUBUN'] = $row["SITE_GUBUN"];
				}


				//json string 형식으로 변환 후 넘겨준다.
				echo json_encode($output);
			} // if(mysqli_query($connect, $procedure)) ...END
		} // if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereUser")) ...END
}




if($action == "select"){
	$head = '';
	$output = '';
	 
	$s_option = $_POST["s_option"];
	$g_option = $_POST["g_option"];
	$c_option = $_POST["c_option"];
	$s_str = $_POST["s_str"];
	$sort = $_POST["sort"];
	$flag = $_POST["flag"];
	$lastid = $_POST["lastid"];
	$first = $_POST["first"];
	$footer="";

	$query_str1 = " WHERE ";
	$query_str2 = "";
	$query_str3 = "";
	$query_str4 = "";
	$query_desc = "ORDER BY ID DESC";

	$page = $_POST["page"];

	$page_set = 12; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수


	$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' ";

	$result = mysqli_query($connect,$query);


	$row = mysqli_fetch_array($result);

	$total = $row[total]; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치


	if($s_str !=""){
		switch($s_option){
			case "subject" : 
				$query_str1 .= " SUBJECT like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$query_str1 .= " NEWS_REGUSER like '%".$s_str."%' ";
				break;
			case "comp" : 
				$query_str1 .= " NEWS_REGUSER_COMP like '%".$s_str."%' ";
				break;
			case "contents" : 
				$query_str1 .= " CONTENTS_ like '%".$s_str."%' ";
				break;
			default:
				$query_str1 .=" 1 = 1 ";
			}	
	}else{
		$query_str1 .=" 1 = 1 ";
	} // if($s_str !=""){ ...END

	switch($g_option){
		case "ALL" : 
			$query_str2 .= " AND 2 = 2 ";
			break;
		case "HOS" : 
			$query_str2 .= " AND SITE_GUBUN = 'HOS' ";
			break;
		default:
			$query_str2 .= " ";
	}


	if($c_option != ""){
		$query_str3 = "	AND CATE = '".$c_option."' ";
	}

	if($sort != "" && $flag != ""){
		$query_desc = "ORDER BY ".$flag." ".$sort;
	}

	if($lastid != ""){
		$query_str4 = " AND ID < ".$lastid .' ' ;
	}



	$head .= '
		<colgroup>
		<col width="100px">
		<col width="350px">
		<col width="150px">
		<col width="200px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		</colgroup>
		<thead>
		<tr>
			<th><a href="javascript:sort(\'id\');">ID</a><span id=\'sort_id\' style="color:#337ab7;"></span></th>
			<th><a href="javascript:sort(\'subject\');">제목</a><span style="color:#337ab7;" id=\'sort_subject\'></span></th>
			<th><a href="javascript:sort(\'news_reguser\');">기사작성자</a><span style="color:#337ab7;" id=\'sort_news_reguser\'></span></th>
			<th><a href="javascript:sort(\'news_regdate\');">기사작성일</a><span  style="color:#337ab7;"id=\'sort_news_regdate\'></span></th>
			<th><a href="javascript:sort(\'news_reguser_comp\');">소속</a><span style="color:#337ab7;"id=\'sort_news_reguser_comp\'></span></th>
			<th><a href="javascript:sort(\'site_gubun\');">사이트</a><span style="color:#337ab7;"id=\'sort_site_gubun\'></span></th>
			<th><a href="javascript:sort(\'cate\');">카테고리</a><span style="color:#337ab7;"id=\'sort_cate\'></span></th>
			<th><a href="javascript:sort(\'visible\');">노출여부</a><span style="color:#337ab7;" id=\'sort_visible\'></span></th>
			<th>수정</th>
		</tr>
		</thead>
		';

	if(isset($_POST["action"]))
	{
		//users테이블 조회 프로시져를 만든다.
		$procedure = "
		CREATE PROCEDURE selectNews()
		BEGIN
		SELECT * FROM SS_NEWS ".$query_str1.$query_str2.$query_str3.$query_str4.$query_desc."
		LIMIT $limit_idx, $page_set ;
		END;
		";
		//기존에 프로시져가 존재한다면 지운다.
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectNews"))
		{
			//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL selectNews()";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query);


				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";

					while($row = mysqli_fetch_array($result)){


					$gubun = $row["SITE_GUBUN"];
					$cate_ = $row["CATE"];
					$msg_id = $row["ID"];

					switch($gubun){
						case "ALL" : $gubun_name = "전체"; break;
						case "HOS" : $gubun_name = "병원톡"; break;
						default : $gubun_name = ""; 
					}

					if($gubun == "ALL"){
						switch($cate_ ){
							case 'SCH' : $cate_name = "세무일정"; break;
							case 'LED' : $cate_name = "장부기장"; break;
							case 'VAT' : $cate_name = "부가세"; break;
							case 'CIT' : $cate_name = "종소세"; break;
							case 'TRA' : $cate_name = "양도세"; break;
							case 'INH' : $cate_name = "상속세"; break;
							case 'GTX' : $cate_name = "증여세"; break;
							case 'THA' : $cate_name = "절세극장"; break;
							case 'TAX' : $cate_name = "조세"; break;
							case 'LAB' : $cate_name = "노무";break;
							case 'FOU' : $cate_name = "창업";break;
							case 'OPE' : $cate_name = "경영";break;
							case 'MNY' : $cate_name = "자금";break;
							case 'PRO' : $cate_name = "홍보";break;
							case 'ISS' : $cate_name = "이슈";break;

							case 'LAW' : $cate_name = "법률";break;
							case 'OP2' : $cate_name = "운영";break;
							case 'EDU' : $cate_name = "교육";break;
							case 'HEA' : $cate_name = "건강";break;
							case 'CUL' : $cate_name = "문화";break;
							case 'FAQ' : $cate_name = "FAQ";break;
							case '19T' : $cate_name = "19禁세금";break;
							case 'QNA' : $cate_name = "상담사례";break;
							case 'HOM' : $cate_name = "주택임대";break;
							default : $cate_name = "";
						} //  switch ... end
					}else{
						switch($cate_ ){
							case 'SCH' : $cate_name = "세무일정"; break;
							case 'TRT' : $cate_name = "세무신고"; break;
							case 'TIV' : $cate_name = "세무조사"; break;
							case 'FOU' : $cate_name = "개원";break;
							case 'LAB' : $cate_name = "노무";break;
							case 'GTX' : $cate_name = "증여세"; break;
							case 'INH' : $cate_name = "상속세"; break;
							case 'TRA' : $cate_name = "양도세"; break;
							case 'QNA' : $cate_name = "상담사례";break;
							case 'THA' : $cate_name = "절세극장"; break;
							case '19T' : $cate_name = "19禁세금";break;

							default : $cate_name = "";
						} // switch ... end
					} // if($gubun == "ALL"){ ... end


					$output .= '
					<tr>
					<td>'.$row["ID"].'</td>
					<td style="text-align:left;">&nbsp;&nbsp;<a href=\'/admin_newsview.php?id='.$row["ID"].'\' target=\'_blank\'>'.$row["SUBJECT"].'</a></td>
					<td>'.$row["NEWS_REGUSER"].'</td>
					<td>'.$row["NEWS_REGDATE"].'</td>
					<td>'.$row["NEWS_REGUSER_COMP"].'</td>
					<td>'.$gubun_name.'</td>
					<td>'.$cate_name.'</td>
					<td>'.$row["VISIBLE"].'</td>
					<td><button type="button" name="update" id="'.$row["ID"].'" class="update">수정</button></td>
					<!--td><button type="button" name="delete" id="'.$row["ID"].'" class="delete">삭제</button></td-->
					</tr>

					';
				} // if(mysqli_num_rows($result) >0)...END
			} // if(mysqli_query($connect,$procedure))...END
			
		} // if(mysqli_query(... END
		else
		{
			$output .= '
			<tr>
			<td colspan="10" align="center">데이터가 없습니다.</td>
			</tr>
			';
		} // else ... NE

		echo $head.$output;

	} // if(isset($_POST["action"])) ... END
	}

} // if(isset($action) == "select_modify"){ ... END

?>
