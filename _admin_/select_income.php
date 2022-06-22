<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$output = '';

//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴
$s_option = $_POST["s_option"];
$g_option = $_POST["g_option"];
$s_str = $_POST["s_str"];
$lastid = $_POST["lastid"];
$first = $_POST["first"];
$p_id =  $_POST["id"];
$p_val =  $_POST["select_val"];
$p_memo =  $_POST["memo"];
$p_bran =  $_POST["bran"];
$p_stat =  $_POST["stat"];
$action =  $_POST["action"];

$footer="";

$query_str1 = "";
$query_str2 = "";
$query_str4 = "";


$page = $_POST["page"];

$page_set = 12; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


$query = "SELECT count(ID) as total FROM INCOME_CST WHERE FLAG='INCOME' ";

$result = mysqli_query($connect,$query);


$row = mysqli_fetch_array($result);

$total = $row[total]; // 전체글수
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
$limit_idx = ($page - 1) * $page_set; // limit시작위치

	switch($s_option){
	case "CSTNAME" : 
		$query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
		break;
	case "MOBILE" : 
		$query_str1 .= " AND MOBILE like '%".$s_str."%' ";
		break;
	case "MEMO" : 
		$query_str1 .= " AND MEMO like '%".$s_str."%' ";
		break;
	default:
		$query_str1 ="";
	}

	if($g_option != "0" ){
		$query_str2 = "AND BRANCH = '".$g_option."' ";
	}

	if($lastid != ""){
		$query_str4 = " AND ID < ".$lastid .' ' ;
	}



if(isset($action))
{

	if($action == "등록"){
		$procedure_upt = "
			CREATE PROCEDURE upt_INCOME(IN p_id INT, p_val INT, p_memo LONGTEXT, p_bran INT, p_stat INT  )
			BEGIN
				UPDATE INCOME_CST SET CONTACT_CNT = p_val, CON_REGDATE = NOW(), MEMO = p_memo, MEMO_REGDATE = NOW(), BRANCH=p_bran, STAT=p_stat WHERE ID = p_id;
			END;
			";

			
			//기존에 프로시져가 존재한다면 지운다.
			if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS upt_INCOME"))
			{
				if(mysqli_query($connect,$procedure_upt))
				{
					$query_upt = "CALL upt_INCOME('".$p_id."','".$p_val."','".$p_memo."','".$p_bran."','".$p_stat."')";
					mysqli_query($connect,$query_upt);
				}
			}
	}



	if($action == "삭제"){
		$procedure_upt_del = "
			CREATE PROCEDURE UPT_DEL_INCOME(IN p_id INT )
			BEGIN
				UPDATE INCOME_CST SET VISIBLE='N' WHERE ID = p_id;
			END;
			";

			
			//기존에 프로시져가 존재한다면 지운다.
			if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_DEL_INCOME"))
			{
				if(mysqli_query($connect,$procedure_upt_del))
				{
					$query_upt = "CALL UPT_DEL_INCOME('".$p_id."')";
					mysqli_query($connect,$query_upt);
				}
			}
	}




//users테이블 조회 프로시져를 만든다.
$procedure = "
CREATE PROCEDURE selectINCOME()
BEGIN
SELECT 
ID, MOBILE,CSTNAME,QUEST, MEMO,IFNULL( BRANCH,0) AS BRANCH, IFNULL(STAT,0) STAT, IFNULL(CONTACT_CNT,0) AS CNT_,date_format(REGDATE,'%Y%m%d %H:%i') as REGDATE_ 
FROM INCOME_CST WHERE FLAG='INCOME' AND VISIBLE = 'Y' ".$query_str1.$query_str2.$query_str4." ORDER BY REGDATE DESC LIMIT $limit_idx, $page_set;
END;
";

//기존에 프로시져가 존재한다면 지운다.
if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectINCOME"))
{
//mysqli_query:DB에 쿼리 전송
if(mysqli_query($connect,$procedure))
{
$query = "CALL selectINCOME()";

///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
$result = mysqli_query($connect,$query);
$head .= '
<tr>
<th width="6%" >ID</th>
<th width="5%">이름</th>
<th width="7%">핸드폰번호</th>
<th width="30%">질문</th>
<th width="7%">신청일</th>
<th width="5%">첨부파일</th>
<th width="5%">전화횟수</th>
<th width="6%">지점</th>
<th width="7%">현황</th>
<th width="10%">메모<br>(메모영역 클릭하시면 수정가능)</th>
</tr>

';

$path = "../tax_income/upload/";
	

//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
if(mysqli_num_rows($result) >0)
{

$cate_name="";

while($row = mysqli_fetch_array($result)){

$msg_id = $row["ID"];
$dir = $path.$row["CSTNAME"]."/";
$dir = iconv("UTF-8","cp949",$dir);
$LINK = '';

if (is_dir($dir)){
	$LINK = '<a href="javascript:file_pop(\''.$row["ID"].'\')">링크</a>';	
}


$output .= '
<tr>
<td style="text-align:center;">'.$row["ID"].'<br><button onclick="javascript:hide(\''.$row["ID"].'\');">삭제</button></td>
<td>'.$row["CSTNAME"].'</td>
<td>'.$row["MOBILE"].'</td>
<td>'.$row["QUEST"].'</td>
<td>'.$row["REGDATE_"].'</td>
<td>'.$LINK.'</td>
<td>
	<select style="width:60px;height:35px;" id="'.$row["ID"].'" name="CONTACT_CNT" onchange="javascript:select_cnt(this);">';

	for($i=0; $i <=5; $i++ ){
		if($row["CNT_"] == $i){
			$output.= '<option value="'.$i.'" selected>'.$i.'회</option>';
		}else{
			$output.= '<option value="'.$i.'">'.$i.'회</option>';
		}	
	}

$output.= '</select>
</td>
<td>
<select style="width:70px;height:35px;" id="bran_'.$row["ID"].'" name="branch" onchange="javascript:select_bran(this);">';

$selected = "";

	for($i=0; $i <=12; $i++ ){
		
		if($row["BRANCH"] == $i){
			$selected = "selected";
		}else{
			$selected = "";
		}

		switch($i){
			case 0 : $output.= '<option value="0">선택</option>'; break;
			case 1 : $output.= '<option value="'.$i.'" '.$selected.'>강남</option>'; break;
			case 2 : $output.= '<option value="'.$i.'" '.$selected.'>용인</option>';break;
			case 3 : $output.= '<option value="'.$i.'" '.$selected.'>안양</option>';break;
			case 4 : $output.= '<option value="'.$i.'" '.$selected.'>수원</option>';break;
			case 5 : $output.= '<option value="'.$i.'" '.$selected.'>일산</option>';break;
			case 6 : $output.= '<option value="'.$i.'" '.$selected.'>부천</option>';break;
			case 7 : $output.= '<option value="'.$i.'" '.$selected.'>광주</option>';break;
			case 8 : $output.= '<option value="'.$i.'" '.$selected.'>분당</option>';break;
			case 9 : $output.= '<option value="'.$i.'" '.$selected.'>기흥</option>';break;
			case 10 : $output.= '<option value="'.$i.'" '.$selected.'>세무</option>';break;
			case 11 : $output.= '<option value="'.$i.'" '.$selected.'>회계</option>';break;
			case 12 : $output.= '<option value="'.$i.'" '.$selected.'>영업</option>';break;
		}
	}

$output.= '</select>
</td>
<td>
<select style="width:80px;height:35px;" id="stat_'.$row["ID"].'" name="stat" onchange="javascript:select_stat(this);">';

$selected = "";

	for($i=0; $i <=12; $i++ ){
		
		if($row["STAT"] == $i){
			$selected = "selected";
		}else{
			$selected = "";
		}

		switch($i){
			case 0 : $output.= '<option value="0">선택</option>'; break;
			case 1 : $output.= '<option value="'.$i.'" '.$selected.'>수신부재</option>'; break;
			case 2 : $output.= '<option value="'.$i.'" '.$selected.'>수임확정</option>';break;
			case 3 : $output.= '<option value="'.$i.'" '.$selected.'>수임예상</option>';break;
			case 4 : $output.= '<option value="'.$i.'" '.$selected.'>수임곤란</option>';break;
			case 5 : $output.= '<option value="'.$i.'" '.$selected.'>수임불가</option>';break;
		}
	}

$output.= '</select>
</td>
<td><DIV id="memo_lbl_'.$row["ID"].'" style="width:200px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.$row["MEMO"].'</DIV><input type="text" id="memo_ip_'.$row["ID"].'" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27) {memo_submit(this);}" value="'.$row["MEMO"].'" style="display:none;padding-top:10px;"></input></td>
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
/*
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
*/

echo $head.$output;

}// 세번째 if문 끝

} // 두번째 if 문 끝

}//첫번째 if문 끝!





?>
