<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$output = '';

//db연결 본인의 db 정보를 넣어준다!
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴
if(isset($_POST["action"]))
{
//users테이블 조회 프로시져를 만든다.
$procedure = "
CREATE PROCEDURE selectNews()
BEGIN
SELECT * FROM SS_NEWS ORDER BY ID DESC;
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
$output .= '
<table class="table table-bordered">
<tr>
<th width="23%">제목</th>
<th width="7%">기사작성자</th>
<th width="10%">기사작성일</th>
<th width="10%">소속</th>
<th width="5%">구분</th>
<th width="5%">노출여부</th>
<th width="8%">기사바로가기</th>
<th width="7%">태그입력</th>
<th width="5%"></th>
<th width="5%"></th>
</tr>

';
//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
if(mysqli_num_rows($result) >0)
{

//mysqli_fetch_array 함수는 mysqli_query 를 통해 얻은 리절트 셋(result set)에서 레코드를 1개씩 리턴해주는 함수다.
//레코드를 1개씩 리턴해주는 것은 mysqli_fetch_row 나 mysqli_fetch_assoc 와 동일하지만 리턴하는 배열의 형태가 틀리다.
//mysqli_fetch_array 함수는 순번을 키로 하는 일반 배열과 컬럼명을 키로 하는 연관배열 둘 모두 값으로 갖는 배열을 리턴한다.
//#참고!
//mysqli_fetch_row 일반 배열(순번을 키로한다.)
//mysqli_fetch_assoc 연관 배열
//mysqli_fetch_array 일반 배열 + 연관배열(컬럼명을 키로 한다)
/*
<option value="SCH">세무일정</option>
	<option value="LED">장부기장</option>
	<option value="VAT">부가세</option>
	<option value="CIT">종소세</option>
	<option value="TRA">양도세</option>
	<option value="INH">상속/증여</option>
	<option value="THA">절세극장</option>
	<option value="TAX">조세</option>
	<option value="LAB">노무</option>
	<option value="FOU">창업</option>
	<option value="OPE">경영</option>
	<option value="MNY">자금</option>
	<option value="PRO">홍보</option>
	<option value="ISS">이슈</option>
*/
//값이 있으면 true를 리턴한다.
$cate_name="";

while($row = mysqli_fetch_array($result)){
$cate_ = $row["CATE"];
	switch($cate_ ){
	case 'SCH' : $cate_name = "세무일정"; break;
	case 'LED' : $cate_name = "장부기장"; break;
	case 'VAT' : $cate_name = "부가세"; break;
	case 'CIT' : $cate_name = "종소세"; break;
	case 'TRA' : $cate_name = "양도세"; break;
	case 'INH' : $cate_name = "상속/증여"; break;
	case 'THA' : $cate_name = "절세극장"; break;
	case 'TAX' : $cate_name = "조세"; break;
	case 'LAB' : $cate_name = "노무";break;
	case 'FOU' : $cate_name = "참업";break;
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
	default : $cate_name = "";
	}


$output .= '
<tr>
<td>'.$row["SUBJECT"].'</td>
<td>'.$row["NEWS_REGUSER"].'</td>
<td>'.$row["NEWS_REGDATE"].'</td>
<td>'.$row["NEWS_REGUSER_COMP"].'</td>
<td>'.$cate_name.'</td>
<td>'.$row["VISIBLE"].'</td>
<td><a href=\'sub_newsview.php?id='.$row["ID"].'\'>링크</a></td>
<td><a href=\'tag_insert.php?id='.$row["ID"].'\'>입력</a></td>
<td><button type="button" name="update" id="'.$row["ID"].'" class="update">수정</button></td>
<td><button type="button" name="delete" id="'.$row["ID"].'" class="delete">삭제</button></td>
</tr>

';
}
}// 네번째 if문 끝
else
{
$output .= '
<tr>
<td colspan="4">데이터가 없습니다.</td>
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
