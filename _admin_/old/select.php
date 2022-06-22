<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$head = '';
$output = '';

//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴
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
	}

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
<tr>
<th width="3%"><a href="javascript:sort(\'id\');">ID</a><span id=\'sort_id\' style="color:#337ab7;"></span></th>
<th width="20%"><a href="javascript:sort(\'subject\');">제목</a><span style="color:#337ab7;" id=\'sort_subject\'></span></th>
<th width="5%"><a href="javascript:sort(\'news_reguser\');">기사작성자</a><span style="color:#337ab7;" id=\'sort_news_reguser\'></span></th>
<th width="10%"><a href="javascript:sort(\'news_regdate\');">기사작성일</a><span  style="color:#337ab7;"id=\'sort_news_regdate\'></span></th>
<th width="5%"><a href="javascript:sort(\'news_reguser_comp\');">소속</a><span style="color:#337ab7;"id=\'sort_news_reguser_comp\'></span></th>
<th width="5%"><a href="javascript:sort(\'site_gubun\');">사이트</a><span style="color:#337ab7;"id=\'sort_site_gubun\'></span></th>
<th width="5%"><a href="javascript:sort(\'cate\');">카테고리</a><span style="color:#337ab7;"id=\'sort_cate\'></span></th>
<th width="5%"><a href="javascript:sort(\'visible\');">노출여부</a><span style="color:#337ab7;" id=\'sort_visible\'></span></th>
<th width="5%">기사링크</th>
<th width="5%"></th>
<!--th width="5%"></th-->
</tr>

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
	default : $cate_name = "";
	}
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
	}

}


$output .= '
<tr>
<td>'.$row["ID"].'</td>
<td>'.$row["SUBJECT"].'</td>
<td>'.$row["NEWS_REGUSER"].'</td>
<td>'.$row["NEWS_REGDATE"].'</td>
<td>'.$row["NEWS_REGUSER_COMP"].'</td>
<td>'.$gubun_name.'</td>
<td>'.$cate_name.'</td>
<td>'.$row["VISIBLE"].'</td>
<td><a href=\'../admin_newsview.php?id='.$row["ID"].'\' target=\'_blank\'>링크</a></td>
<td><button type="button" name="update" id="'.$row["ID"].'" class="update">수정</button></td>
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
