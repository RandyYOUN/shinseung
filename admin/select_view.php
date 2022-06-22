<?php

$head = '';
$output = '';
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

$head .= '
<tr><td colspan=11>※ 사업장별 수입금액</td></tr>
<tr>
<th width="10%" rowspan="2">사업장<br>등록번호</th>
<th width="10%" rowspan="2">상호</th>
<th width="10%" rowspan="2">수입종류<br>구분코드</th>
<th width="10%" rowspan="2">업종<br>코드</th>
<th width="10%" rowspan="2">사업<br>형태</th>
<th width="10%" rowspan="2">기장<br>의무</th>
<th width="10%" rowspan="2">수입금액</th>
<th width="10%" colspan="2">기준경비율</th>
<th width="10%" colspan="2">단순경비율</th>
</tr>
<tr>
<th>일반</th>
<th>자가</th>
<th>일반<br>(기본)</th>
<th>자가<br>(초과)</th>
</tr>
';


$head2 .= '
<tr><td colspan=4>※ 최근 3년간 종합소득세 신고상황  (단위 : 천원)</td></tr>
<tr>
<th width="10%" >구분</th>
<th width="10%" >2016귀속</th>
<th width="10%" >2017귀속</th>
<th width="10%" >2018귀속</th>
</tr>
';


$head3 .= '
<tr><td colspan=4><SPAN STYLE="align:left">※ 2018년 매출액 대비 주요 판관비율 분석(주사업장 기준)<SPAN STYLE="align:right">(단위: 천원)</span></SPAN>
</td></tr>
<tr>
<th width="10%" >계정과목</th>
<th width="10%" >금액</th>
<th width="10%" >당해업체(%)</th>
<th width="10%" >업종평균(%)</th>
</tr>
';


$head4 .= '
<tr><td colspan=7><SPAN STYLE="align:left">※ 2019년 사업용 신용카드 사용현황분석
<SPAN STYLE="align:right">(단위: 건원)</span></SPAN>
</td></tr>
<tr>
<th width="10%" >구분</th>
<th width="10%" >합계</th>
<th width="10%" >신변잡화구입</th>
<th width="10%" >가정용품구입</th>
<th width="10%" >업무무관<BR>업소이용</th>
<th width="10%" >개인적치료</th>
<th width="10%" >해외사용액</th>
</tr>
';


	if(isset($_POST["id"]))
	{
		
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
					}// 네번째 if문 끝
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
		}



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
		}




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
		}



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
		}




		

	}


switch($_POST["flag"]){
	case "TB300020" : echo $head.$output; break;
	case "TB300040" : echo $head2.$output;break;
	case "TB300050" : echo $head3.$output;break;
	case "TB300060" : echo $head4.$output;break;
}





?>