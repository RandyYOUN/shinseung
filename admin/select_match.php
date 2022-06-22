<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$output = '';

//db연결 본인의 db 정보를 넣어준다!
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴

/*
$s_option = $_POST["s_option"];
$g_option = $_POST["g_option"];
$s_str = $_POST["s_str"];

$query_str1 = " WHERE ";
$query_str2 = "";

	switch($s_option){
	case "subject" : 
		$query_str1 = $query_str1." SUBJECT like '%".$s_str."%' ";
		break;
	case "reguser" : 
		$query_str1 = $query_str1." NEWS_REGUSER like '%".$s_str."%' ";
		break;
	case "comp" : 
		$query_str1 = $query_str1." NEWS_REGUSER_COMP like '%".$s_str."%' ";
		break;
	case "contents" : 
		$query_str1 = $query_str1." CONTENTS_ like '%".$s_str."%' ";
		break;
	default:
		$query_str1 ="";
	}


	switch($g_option){
	case "ALL" : 
		$query_str2 .= " AND 1 = 1 ";
		break;
	case "HOS" : 
		$query_str2 .= " AND SITE_GUBUN = 'HOS' ";
		break;
	default:
		$query_str2 .= " ";
	}
*/

if(isset($_POST["action"]))
{
//users테이블 조회 프로시져를 만든다.
$procedure = "
CREATE PROCEDURE selectNews()
BEGIN
SELECT A.COMP_NAME, B.CSTNAME, A.ADDRESS, A.PHONE,A.MOBILE,A.SECTOR,B.REGUSER,B.DEPARTMENT,B.GUBUN,B.Q_TYPE,B.APPOINT  FROM NEW_FOUNDER AS A LEFT OUTER JOIN CONSULT_CST AS B ON REPLACE(A.MOBILE ,'-','') = REPLACE(B.PHONE ,'-','') WHERE ifnull(B.NO,'') <> '';
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
$output .= '<BR>
<table class="table table-bordered">
<tr>
<th width="5%">직장명</th>
<th width="5%">고객명</th>
<th width="7%">주소</th>
<th width="5%">전화번호</th>
<th width="5%">핸드폰</th>
<th width="5%">산업분류</th>
<th width="5%">등록인</th>
<th width="5%">상담지점</th>
<th width="5%">상담방법</th>
<th width="5%">문의유형</th>
<th width="5%">수임여부</th>
</tr>

';
//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
if(mysqli_num_rows($result) >0)
{


	while($row = mysqli_fetch_array($result)){

		$output .= '
		<tr>
		<td>'.$row["COMP_NAME"].'</td>
		<td>'.$row["CSTNAME"].'</td>
		<td>'.$row["ADDRESS"].'</td>
		<td>'.$row["PHONE"].'</td>
		<td>'.$row["MOBILE"].'</td>
		<td>'.$row["SECTOR"].'</td>
		<td>'.$row["REGUSER"].'</td>
		<td>'.$row["DEPARTMENT"].'</td>
		<td>'.$row["GUBUN"].'</td>
		<td>'.$row["Q_TYPE"].'</td>
		<td>'.$row["APPOINT"].'</td>
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

$output .= '</table>';

//최종출력!
echo $output;

}// 세번째 if문 끝

} // 두번째 if 문 끝

}//첫번째 if문 끝!





?>
