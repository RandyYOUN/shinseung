<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$output = '';

//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴
$s_option = $_POST["s_option"];
$s_str = $_POST["s_str"];

$query_str1 = " WHERE ";
$query_str2 = "";

	switch($s_option){
	case "cstname" : 
		$query_str1 = $query_str1." CSTNAME like '%".$s_str."%' ";
		break;
	case "phone" : 
		$query_str1 = $query_str1." PHONE like '%".$s_str."%' ";
		break;
	case "email" : 
		$query_str1 = $query_str1." EMAIL like '%".$s_str."%' ";
		break;
	case "contents" : 
		$query_str1 = $query_str1." CONTENTS like '%".$s_str."%' ";
		break;
	default:
		$query_str1 ="";
	}

if(isset($_POST["action"]))
{
//users테이블 조회 프로시져를 만든다.
$procedure = "
CREATE PROCEDURE selectQNA()
BEGIN
SELECT ID,ID_,PHONE,CSTNAME,EMAIL,CONCAT(LEFT( fnStripTags(CONTENTS),100),'...') AS CONTENTS FROM SS_QNAS ".$query_str1.$query_str2." ORDER BY ID DESC limit 100;
END;
";

//기존에 프로시져가 존재한다면 지운다.
if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectQNA"))
{
//mysqli_query:DB에 쿼리 전송
if(mysqli_query($connect,$procedure))
{
$query = "CALL selectQNA()";

///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
$result = mysqli_query($connect,$query);
$output .= '<BR>
<table class="table table-bordered">
<tr>
<th width="0%">ID</th>
<th width="10%">이름</th>
<th width="10%">핸드폰</th>
<th width="10%">이메일</th>
<th width="40%">내용</th>
<th width="10%"></th>
<th width="6%"></th>
<th width="6%"></th>
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

while($row = mysqli_fetch_array($result)){

$output .= '
<tr>
<td>'.$row["ID_"].'</td>
<td>'.$row["CSTNAME"].'</td>
<td>'.$row["PHONE"].'</td>
<td>'.$row["EMAIL"].'</td>
<td>'.$row["CONTENTS"].'</td>
<td><button type="button" name="update" id="'.$row["ID_"].'" class="update">답변/수정</button></td>
<td><button type="button" name="delete" id="'.$row["ID_"].'" class="delete">삭제</button></td>
<td><a href=\'http://medi-tax.kr/sub_qnaview.php?id='.$row["ID_"].'\' target=\'_blank\'>링크</a></td>
</tr>
';
}
}// 네번째 if문 끝
else
{
$output .= '
<tr>
<td colspan="9" align="center">데이터가 없습니다.</td>
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
