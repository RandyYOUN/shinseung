<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$head = '';
$output = '';

//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴

$g_option = $_POST["g_option"];
$b_option = $_POST["b_option"];
$s_str = $_POST["s_str"];
$footer="";

$query_str1 = "";
$query_str2 = "";
$query_desc = "ORDER BY CSTID DESC";

$page = $_POST["page"];

$page_set = 12; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


	if($s_str !=""){
		switch($g_option){
			case "NUM" : 
				$query_str1 .= " AND NUMBERING like '%".$s_str."%' ";
				break;
			case "NAME" : 
				$query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
				break;
			case "MOBILE" : 
				$query_str1 .= " AND MOBILE like '%".$s_str."%' ";
				break;
			case "RESI" : 
				$query_str1 .= " AND RESIDENT_ID like '%".$s_str."%' ";
				break;
			default:
				$query_str1 .="";
			}	
	}


	if($b_option != ""){
		$query_str2 .= " AND BRANCH = '".$b_option."' ";
	}



$query = "SELECT count(CSTID) as total FROM TB100020 WHERE 1=1 ".$query_str1.$query_str2;

$result = mysqli_query($connect,$query);


$row = mysqli_fetch_array($result);

$total = $row[total]; // 전체글수
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
$limit_idx = ($page - 1) * $page_set; // limit시작위치




$head .= '
<tr>
<th width="3%">넘버링</th>
<th width="3%">지점</th>
<th width="5%">이름</th>
<th width="8%">핸드폰</th>
<th width="8%">주민번호</th>
<th width="6%">처리시간</th>
<th width="3%">안내문</th>
<th width="3%">신고</th>
<th width="3%">PDF</th>
<th width="8%">오류</th>
<th width="7%">소득금액(단위:원)</th>
<th width="7%">지방세(단위:원)</th>
<th width="10%">납부번호</th>
<th width="10%">지방세납부번호</th>
<th width="7%">환급은행</th>
<th width="7%">계좌</th>
</tr>

';


if(isset($_POST["action"]))
{
//users테이블 조회 프로시져를 만든다.
$procedure = "
CREATE PROCEDURE SELECT_TB100020()
BEGIN
SELECT *, FORMAT(INCOME_TAX,0) AS INCOME_TAX_,FORMAT(JIBANG_TAX,0) AS JIBANG_TAX_  
, SELECT_RESULT(HomeTaxPrint) AS STEP1, SELECT_RESULT(SmartAToConvert) AS STEP3_1, SELECT_RESULT(HomeTaxUpload) AS STEP3_2 
FROM TB100020 WHERE 1=1 ".$query_str1.$query_str2.$query_desc.
" LIMIT $limit_idx, $page_set 
;
END;
";
	//기존에 프로시져가 존재한다면 지운다.
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100020"))
	{
		//mysqli_query:DB에 쿼리 전송
		if(mysqli_query($connect,$procedure))
		{
			$query1 = "CALL SELECT_TB100020()";

			///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
			$result = mysqli_query($connect,$query1);


			if(mysqli_num_rows($result) >0)
			{

				$cate_name="";

				while($row = mysqli_fetch_array($result)){

					$output .= '
					<tr>
					<td>'.$row["NUMBERING"].'</td>
					<td>'.$row["BRANCH"].'</td>
					<td>'.$row["CSTNAME"].'</td>
					<td>'.$row["MOBILE"].'</td>
					<td>'.$row["RESIDENT_ID"].'</td>
					<td>'.$row["REGDATE"].'</td>
					<td>'.$row["STEP1"].'</td>
					<td>'.$row["STEP3_1"].'</td>
					<td>'.$row["STEP3_2"].'</td>
					<td>'.$row["EXCEPTION"].'</td>
					<td>'.$row["INCOME_TAX_"].'</td>
					<td>'.$row["JIBANG_TAX_"].'</td>
					<td><SPAN STYLE=\'font-size:10px;\'>'.$row["REPORT_NUM_INCOME"].'</SPNA></td>
					<td><SPAN STYLE=\'font-size:10px;\'>'.$row["REPORT_NUM_JIBANG"].'</td>
					<td>'.$row["REF_BANK"].'</span></td>
					<td>'.$row["REF_ACC"].'</td>
					<!--td><button type="button" name="update" id="'.$row["ID"].'" class="update">수정</button></td-->
					<!--td><button type="button" name="delete" id="'.$row["ID"].'" class="delete">삭제</button></td-->
					</tr>

					';
				}
			}// 네번째 if문 끝
			else
			{
				$output .= '
				<tr>
				<td colspan="10" align="center">데이터가 없습니다.</td>
				</tr>
				';
			}


			//최종출력!
		/*
			if($first=="Y"){
				echo $head.$output.$footer;
			}else{
				echo $output.$footer;
			}
		*/
			echo $head.$output;

		}// 세번째 if문 끝

	} // 두번째 if 문 끝

}//첫번째 if문 끝!






?>
