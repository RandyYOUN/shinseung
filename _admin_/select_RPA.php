<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$head = '';
$output = '';

//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴
$cst_type = $_POST["cst_type"];
$g_option = $_POST["g_option"];
$b_option = $_POST["b_option"];
$s_str = $_POST["s_str"];
$footer="";

$query_str1 = "";
$query_str2 = "";
$query_desc = " ORDER BY A.CSTID DESC";

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



$query = "SELECT count(1) as total FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B A.CSTID = B.CSTID WHERE 1=1 ".$query_str1.$query_str2;

$row = mysqli_query($connect,$query);


//$row = mysqli_fetch_array($result);

$total = $row["total"]; // 전체글수
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
$limit_idx = ($page - 1) * $page_set; // limit시작위치


if($cst_type == "A1001"){
	
	$head .= '
	<colgroup>
    <col width="60px">
	<col width="50px">
	<col width="70px">
	<col width="110px">
	<col width="170px">
	<col width="170px">
	<col width="240px">
	<col width="50px">
	<col width="50px">
	<col width="50px">
	<col width="100px">
	<col width="150px">
	<col width="170px">
	<col width="150px">
	<col width="150px">
	<col width="150px">
	<col width="150px">

	</colgroup>
	<thead>
	<tr>
		<th>넘버링</th>
		<th>지점</th>
		<th>이름</th>
		<th>HomeTaxID</th>
		<th>핸드폰</th>
		<th>주민번호</th>
		<th>처리시간</th>
		<th>안내문</th>
		<th>신고</th>
		<th>PDF</th>
		<th>오류</th>
		<th>소득금액(단위:원)</th>
		<th>지방세(단위:원)</th>
		<th>납부번호</th>
		<th>지방세납부번호</th>
		<th>환급은행</th>
		<th>계좌</th>
	</tr>
	</thead>
	';

}else{
	
	$head .= '
	<colgroup>
    
    <col width="50px">
	<col width="100px">
	<col width="100px">
	<col width="100px">
	<col width="100px">
	<col width="100px">
	<col width="50px">
	<col width="50px">
	<col width="50px">
	<col width="50px">
	<col width="50px">
	<col width="50px">
	<col width="80px">
	<col width="60px">
	<col width="80px">
    <col width="80px">
    <col width="300px">
    
	</colgroup>
	<thead>
      <tr>
        <th rowspan="2">no</th>
        <th rowspan="2">접수일</th>
        <th colspan="2">기본정보</th>
        <th colspan="3">수수료</th>
        <th colspan="2">홈택스 수임</th>
        <th colspan="2">자료</th>
        <th>회사</th>
        <th colspan="3">전자신고</th>
        <th>납부서</th>
        <th rowspan="2">메모</th>
      </tr>
      <tr>
        <td style="border:1px solid #e3e3e3;">상호</td>
        <td>이름</td>
        <td>수수료</td>
        <td>입금금액</td>
        <td>영수증</td>
        <td>요청</td>
        <td>여부</td>
        <td>추출</td>
        <td>첨부</td>
        <td>등록</td>
        <td>신고담당</td>
        <td>요청</td>
        <td>완료</td>
        <td>전송완료</td>
      </tr>
    </thead>
	';

}


if(isset($_POST["action"]))
{
//users테이블 조회 프로시져를 만든다.
$procedure = "
CREATE PROCEDURE SELECT_TB100020()
BEGIN
SELECT  A.CSTID AS 'ID',
B.REGDATE AS 'REGDATE_',
B.COMP_NAME,
A.CSTNAME,
B.EST_FEE,
B.DEP_FEE,
B.CASH_REC,
DATE_FORMAT(B.SUBM_DATE, '%y-%m-%d') 'SUBM_DATE_',
DATE_FORMAT(B.SUBM_DATE2, '%y-%m-%d') 'SUBM_DATE2_',
B.EXT_DATE ,
B.ATTACH_FILE,
A.CompRegCheck,
B.DEC_REGUSER,
B.REQ_E_REPORT,
DATE_FORMAT(B.COMP_DATE, '%y-%m-%d') 'COMP_DATE_',
DATE_FORMAT(B.DEL_DATE_PAYMENT, '%y-%m-%d') 'DEL_DATE_PAYMENT_',
B.MEMO
FROM TB100020 AS A
LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
WHERE B.CST_TYPE = '".$cst_type."' ".$query_str1.$query_str2.$query_desc.
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


			if($result)
			{

				$cate_name="";

				while($row = mysqli_fetch_array($result)){

					if($cst_type == "A1001"){
						$output .= '
						<tr>
						<td>'.$row["ID"].'</td>
						<td>'.$row["REGDATE_"].'</td>
						<td><a href="view_cst.php?id='.$row["ID"].'">'.$row["COMP_NAME"].'</a></td>
                        <td><a href="view_cst.php?id='.$row["ID"].'">'.$row["CSTNAME"].'</a></td>
						<td>'.$row["EST_FEE"].'</td>
						<td>'.$row["DEP_FEE"].'</td>
						<td>'.$row["CASH_REC"].'</td>
						<td>'.$row["SUBM_DATE_"].'</td>
						<td>'.$row["SUBM_DATE2_"].'</td>
						<td>'.$row["EXT_DATE"].'</td>
						<td>'.$row["ATTACH_FILE"].'</td>
						<td>'.$row["DEC_REGUSER"].'</td>
						<td>'.$row["REQ_E_REPORT"].'</td>
						<td>'.$row["COMP_DATE_"].'</td>
						<td>'.$row["DEL_DATE_PAYMENT_"].'</span></td>
						<td>'.$row["MEMO"].'</td>
						</tr>';
					}else{
						$output .= '
						<tr>
						<td>'.$row["ID"].'</td>
						<td>'.$row["REGDATE_"].'</td>
						<td><a href="view_cst.php?id='.$row["ID"].'">'.$row["COMP_NAME"].'</a></td>
                        <td><a href="view_cst.php?id='.$row["ID"].'">'.$row["CSTNAME"].'</a></td>
						<td>'.$row["EST_FEE"].'</td>
						<td>'.$row["DEP_FEE"].'</td>
						<td>'.$row["CASH_REC"].'</td>
						<td>'.$row["SUBM_DATE_"].'</td>
						<td>'.$row["SUBM_DATE2_"].'</td>
						<td>'.$row["EXT_DATE"].'</td>
						<td>'.$row["ATTACH_FILE"].'</td>
                        <td>'.$row["CompRegCheck"].'</td>
						<td>'.$row["DEC_REGUSER"].'</td>
						<td>'.$row["REQ_E_REPORT"].'</td>
						<td>'.$row["COMP_DATE_"].'</td>
						<td>'.$row["DEL_DATE_PAYMENT_"].'</span></td>
						<td>'.$row["MEMO"].'</td>
						</tr>';
					}  // if($cst_type == "종합소득세") 끝
				}
			}// 네번째 if문 끝
			else
			{
				$output .= '
				<tr>
				<td colspan="20" align="center">데이터가 없습니다.</td>
				</tr>
				';
			}

			echo $head.$output;

		}// 세번째 if문 끝

	} // 두번째 if 문 끝

}//첫번째 if문 끝!






?>
