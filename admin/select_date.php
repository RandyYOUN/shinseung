<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$output = '';

//db연결 본인의 db 정보를 넣어준다!
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )


$lastid = $_POST["lastid"];
$first = $_POST["first"];
$footer="";

$query_str4 = "";

	if($lastid != ""){
		$query_str4 = " AND ID < ".$lastid .' ' ;
	}


if(isset($_POST["action"]))
{
//users테이블 조회 프로시져를 만든다.
$procedure = "
CREATE PROCEDURE selectDate()
BEGIN
SELECT * FROM SS_TAXDATE WHERE 1=1 ".$query_str4." ORDER BY TAXDATE DESC limit 10;
END;
";

//기존에 프로시져가 존재한다면 지운다.
if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectDate"))
{
//mysqli_query:DB에 쿼리 전송
if(mysqli_query($connect,$procedure))
{
$query = "CALL selectDate()";

///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
$result = mysqli_query($connect,$query);
$head .= '<tr>
<th width="10%">세무일정날짜</th>
<th width="10%">내용</th>
<th width="10%">노출</th>
<th width="5%"></th>
<th width="5%"></th>
</tr>

';
//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
if(mysqli_num_rows($result) >0)
{

while($row = mysqli_fetch_array($result)){

$msg_id = $row["ID"];

$output .= '
<tr>
<td>'.$row["TAXDATE"].'</td>
<td>'.$row["CONTENT"].'</td>
<td>'.$row["VISIBLE"].'</td>
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
<td colspan="5" align="center">데이터가 없습니다.</td>
</tr>
';
}

$footer .= '
<tr>
<td colspan="10" align="center" id="hidden_'.$msg_id.'"><div id="more'.$msg_id.'" class="morebox" style="font-weight:bold;
color:#333333;
text-align:center;
border:solid 1px #333333;
padding:8px;
margin-top:8px;
margin-bottom:8px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;">
<a href="#" id='.$msg_id.' class="more">more</a>
</div></td>
</tr>
';

	//최종출력!

	if($first=="Y"){
		echo $head.$output.$footer;
	}else{
		echo $output.$footer;
	}

}// 세번째 if문 끝

} // 두번째 if 문 끝

}//첫번째 if문 끝!





?>
