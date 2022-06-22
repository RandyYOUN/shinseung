<?php
include "db_info.php";

   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 ADMIN</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="신승세무법인 ADMIN">
	<meta property="og:url" content="https://taxtok.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="resources/images/sum2.png">
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
<script type="text/javascript" src="../news/se2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
-->
<!-- Bootstrap -->



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border-radius:5px;
margin-top:100px;


}

.paging { width: 1400px; margin: 0 auto 100px; }
.paging div { font-size: 0; text-align: center; margin: 30px 0 0 0; }
.paging div a.prev { display: inline-block; width: 52px; font-size: 15px; line-height: 15px; color: #777; font-weight: bold; text-align: right; margin: 0 20px 0 0; padding: 10px 0px 10px 0px; background: url("../images/pagingleft.png") 0px 50% no-repeat; }
.paging div a.prev:hover { color: #444; background: url("../images/pagingleftOn.png") 0px 50% no-repeat; }
.paging div span { display: inline-block; }
.paging div span a { width: 32px; display: inline-block; font-size: 15px; line-height: 15px; color: #999; font-weight: bold; text-align: center; padding: 10px 0px 10px 0px; }
.paging div span a.active { position: relative; width: 32px; display: inline-block; color: #444; }
.paging div span a.active:after { content: ''; position: absolute; left: 0px; bottom: 6px; width: 80%; height: 1px; background: #444; }
.paging div a.next { display: inline-block; width: 52px; font-size: 15px; line-height: 15px; color: #777; font-weight: bold; text-align: left; margin: 0 0 0 20px; padding: 10px 0px 10px 0px; background: url("../images/pagingright.png") 100% 50% no-repeat; }
.paging div a.next:hover { color: #444; background: url("../images/pagingrightOn.png") 100% 50% no-repeat; }


</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 


</head>
<body style="font-size:14px;">
<form method="post" onsubmit="return checkit()">
<div class="container box" style="margin:0 0 0 50px;">
<span>
<img src="resources/images/new_logo.png">
</span>
<br><br>
<div>
	<span >
		<a href="https://taxtok.kr/admin/list.php">&nbsp;[뉴스톡]&nbsp;</a>
	</span>
	
	<span >
		<a href="https://taxtok.kr/admin/list_qna.php">&nbsp;[병의원QnA]&nbsp;</a>
	</span>
	
	<span >
		<a href="https://taxtok.kr/admin/list_cal.php">&nbsp;[조정료계산]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_date.php">&nbsp;[세무일정]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_cst.php">&nbsp;[고객리스트's]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_home.php">&nbsp;[주택임대]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_income.php">&nbsp;[종합소득세 신청]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_callback.php">&nbsp;[콜백리스트]&nbsp;</a>
	</span>
	<span  style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_RPA_inc.php">&nbsp;<B>[RPA_종소세]</B>&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_RPA_vat.php">&nbsp;[RPA_부가세]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_dev.php">&nbsp;[Dev]&nbsp;</a>
	</span>

</div>
<br>
<br>

<!--select name="s_option" id ="s_option" class="form-control" style="width:120px;display:table-cell;">
	<option value="" selected>선택</option>
	<option value="CSTNAME">이름</option>
	<option value="MOBILE">핸드폰</option>
	<option value="MEMO">메모</option>
</select>
<input type = "text" style="width:300px;height:34px;" id="s_str" name="s_str"></input>
<input type = "text" style="width:300px;height:34px;display:none;" id="s_str2" name="s_str2"></input>
<input type="button" value="검색" id="btn_search" name="btn_search" style="height:34px;">

<select name="g_option" id ="g_option" class="form-control" style="width:120px;display:table-cell;margin-left:55px;">
	<option value="0" selected>지점선택</option>
	<option value="1">강남</option>
	<option value="2">용인</option>
	<option value="3">안양</option>
	<option value="4">수원</option>
	<option value="5">일산</option>
	<option value="6">부천</option>
	<option value="7">광주</option>
	<option value="8">분당</option>
	<option value="9">기흥</option>
	<option value="10">세무</option>
	<option value="11">회계</option>
	<option value="12">영업</option>
</select>


<br><br>
<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<div class="table-responsive"  style="width:1640px;" >
<!--b><span style="color:red;">※ 첨부파일 다운로드시 팝업차단을 해제하여 주세요.</span></b-->

<B>등록</B>
<TABLE class="table table-bordered" style="width:1640px;">
	<TR><TD COLSPAN=5><b>Step 1 - id/pw 스크래핑</b></TD></TR>
	<TR>
		<TD WIDTH="20%"><SPAN STYLE="COLOR:RED;">※</SPAN>&nbsp;ID <input type="text" name="HomeTaxID" id="HomeTaxID" class="" STYLE="PADDING:6px 12px;width:120px;" />
		</TD>
		<TD WIDTH="20%"><SPAN STYLE="COLOR:RED;">※</SPAN>&nbsp;PW <input type="text" name="HomeTaxPW" id="HomeTaxPW" class="" STYLE="PADDING:6px 12px;width:120px;" />
		</TD>
		<TD COLSPAN="3"></TD>
		
	</TR>
	
	<TR><TD COLSPAN=5><b>Step 3 - 안내문 출력</b></TD></TR>
	<TR>
		<TD WIDTH="20%"><SPAN STYLE="COLOR:RED;">※</SPAN>&nbsp;지점 <select name="BRANCH" id ="BRANCH" STYLE="PADDING:6px 12px;width:85px;">
			<option value="">선택</option>
			<option value="강남">강남</option>
			<option value="용인">용인</option>
			<option value="안양">안양</option>
			<option value="수원">수원</option>
			<option value="일산">일산</option>
			<option value="부천">부천</option>
			<option value="광주">광주</option>
			<option value="분당">분당</option>
			<option value="주택임대">주택임대</option>
		</select>

		</TD>
		<TD><SPAN STYLE="COLOR:RED;">※</SPAN>&nbsp;주민번호  <input type="text" name="RESIDENT1" id="RESIDENT1" class="" STYLE="PADDING:6px 12px;width:85px;" />&nbsp;-&nbsp;<input type="text" name="RESIDENT2" id="RESIDENT2" class="" STYLE="PADDING:6px 12px;width:85px;" />
		</TD>
		<TD COLSPAN="3"></TD>
		
	</TR>
	<TR><TD COLSPAN=5><b>Step 6 - 전자신고 및 접수증,납부서 PDF다운</b></TD></TR>
	<TR>
		<TD><SPAN STYLE="COLOR:RED;">※</SPAN>&nbsp;이름  <input type="text" name="CSTNAME" id="CSTNAME" style="width:200px;PADDING:6px 12px;" /></TD>
		<TD>서버 <select name="SERVER" id ="SERVER" style="width:200px;PADDING:6px 12px;" >
			<option value="">선택</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
		</select></TD>
		<TD>코드 <input type="text" name="SERVER_NUM" id="SERVER_NUM" style="width:200px;PADDING:6px 12px;" /></TD>
		<TD colspan=2>&nbsp;</TD>
		
		
	</TR><TR>
		<TD>넘버링 <input type="text" name="NUMBERING" id="NUMBERING" style="width:200px;PADDING:6px 12px;" /></TD>
		<TD>핸드폰(-포함)  <input type="text" name="MOBILE" id="MOBILE" style="width:200px;PADDING:6px 12px;"/></TD>

		<TD>환급은행(선택)  <select name="REF_BANK" id ="REF_BANK" STYLE="PADDING:6px 12px;width:200px;">
			<option value="">선택</option>
			<option value="SC제일은행">SC제일은행</option>
			<option value="경남은행">경남은행</option>
			<option value="광주은행">광주은행</option>
			<option value="국민은행">국민은행</option>
			<option value="기업은행">기업은행</option>
			<option value="농협중앙회">농협중앙회</option>
			<option value="농협회원(지역농협)">농협회원(지역농협)</option>
			<option value="대구은행">대구은행</option>
			<option value="부산은행">부산은행</option>
			<option value="산립조합">산립조합</option>
			<option value="산업은행">산업은행</option>
			<option value="상호저축은행">상호저축은행</option>
			<option value="새마을금고">새마을금고</option>
			<option value="수협">수협</option>
			<option value="신한은행">신한은행</option>
			<option value="우리은행">우리은행</option>
			<option value="전북은행">전북은행</option>
			<option value="제주은행">제주은행</option>
			<option value="카카오뱅크">카카오뱅크</option>
			<option value="케이뱅크">케이뱅크</option>
			<option value="하나은행">하나은행</option>
			<option value="한국씨티은행">한국씨티은행</option>
		</select></TD>
		<TD>계좌(선택)  <input type="text" name="REF_ACC" id="REF_ACC" style="width:200px;PADDING:6px 12px;"/></TD>
	</TR>
</TABLE>



<button type="button" name="action" id="action" class="btn btn-warning">추가</button>
<BR><BR>


<select name="g_option" id ="g_option" class="form-control" style="width:120px;display:table-cell;">
	<option value="" selected>검색조건</option>
	<option value="NUM">넘버링</option>
	<option value="NAME">이름</option>
	<option value="MOBILE">핸드폰</option>
	<option value="RESI">주민번호</option>
</select>


<input type = "text" style="width:300px;height:34px;" id="s_str" name="s_str"></input>

<input type="button" value="검색" id="btn_search" name="btn_search" style="height:34px;">
<input type="button" value="초기화" id="btn_cancel" name="btn_cancel" style="width:70px;height:34px;">

<select name="b_option" id ="b_option" class="form-control" style="width:120px;display:table-cell;margin-left:55px;">
	<option value="" selected>지점선택</option>
	<option value="강남">강남</option>
	<option value="용인">용인</option>
	<option value="안양">안양</option>
	<option value="수원">수원</option>
	<option value="일산">일산</option>
	<option value="부천">부천</option>
	<option value="광주">광주</option>
	<option value="분당">분당</option>
	<option value="기흥">기흥</option>
	<option value="주택임대">주택임대</option>
</select>

<BR><BR>
	<table class="table table-bordered" style="width:100%" >
		<tbody id="result">
		</tbody>
	</table>
<?php

 function toString($text){
   return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
}

function unescape($text){
   return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'toString', $text));
}

$g_option = $_GET["g_option"];
$b_option = unescape($_GET["b_option"]);
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";
$query_desc = "ORDER BY CSTID DESC";

$page = $_GET["page"];

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

$query = "SELECT count(CSTID) as total FROM TB100020 where CST_TYPE = '종합소득세'   ".$query_str1.$query_str2;


$QUERY_STR = $query_str1.$query_str2;

$result = mysql_query($query, $connect) or die ("쿼리 에러 : ".mysql_error($connect));

$row = mysql_fetch_array($result);
 
$total = $row[total]; // 전체글수

 
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
 
$limit_idx = ($page - 1) * $page_set; // limit시작위치


// 페이지번호 & 블럭 설정
$first_page = (($block - 1) * $block_set) + 1; // 첫번째 페이지번호
$last_page = min ($total_page, $block * $block_set); // 마지막 페이지번호
 
$prev_page = $page - 1; // 이전페이지
$next_page = $page + 1; // 다음페이지
 
$prev_block = $block - 1; // 이전블럭
$next_block = $block + 1; // 다음블럭
 
// 이전블럭을 블럭의 마지막으로 하려면...
$prev_block_page = $prev_block * $block_set; // 이전블럭 페이지번호
// 이전블럭을 블럭의 첫페이지로 하려면...
//$prev_block_page = $prev_block * $block_set - ($block_set - 1);
$next_block_page = $next_block * $block_set - ($block_set - 1); // 다음블럭 페이지번호
 

?>			
	<section class="paging">
				<div>
<?php 
echo ($prev_page > 0) ? "<a href='$PHP_SELF?page=$prev_page$QUERY_STR' class='prev'>PRVE</a> " : "<a  class='prev'>PRVE</a> ";
?>					
					<span>
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='?page=$i&s_str=$s_str&g_option=$g_option'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>

						<!--a href=""><strong>1</strong>/10</a-->
					</span>
<?php 
echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$QUERY_STR' class='next'>NEXT</a> " : "<a class='next'>NEXT</a> ";
?>
				</div>
			</section>
</div>
<br/><br/><br/><br/><br/><br/> 
</div>
</form>
</body>


<script>


var first = "Y";


function Request() {
	var requestParam = "";

	//getParameter 펑션
	this.getParameter = function (param) {
		//현재 주소를 decoding
		var url = unescape(location.href);
		//파라미터만 자르고, 다시 &그분자를 잘라서 배열에 넣는다. 
		var paramArr = (url.substring(url.indexOf("?") + 1, url.length)).split("&");

		for (var i = 0; i < paramArr.length; i++) {
			var temp = paramArr[i].split("="); //파라미터 변수명을 담음

			if (temp[0].toUpperCase() == param.toUpperCase()) {
				// 변수명과 일치할 경우 데이터 삽입
				requestParam = paramArr[i].split("=")[1];
				break;
			}
		}
		return requestParam;
	}
}





$(document).ready(function(){

	var req = new Request();
	var b_option = req.getParameter("b_option");
	var g_option = req.getParameter("g_option");
	var s_str = unescape(req.getParameter("s_str"));
	var page = req.getParameter("page");

	if (b_option != "") {
		$('#b_option').val(b_option).attr('selected','selected');
	}
	
	if (g_option != "") {
		$('#g_option').val(g_option).attr('selected','selected');
	}

	if (s_str!= "") {
		$('#s_str').val(s_str);
	}

	fetchUser();
	function fetchUser()
	{

		var action = "select";
		var b_option = $('#b_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		var cst_type = "종합소득세";
		
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select_RPA.php",
			method:"POST",
			data:{action:action,s_str:s_str,b_option:b_option,g_option:g_option, page:page,cst_type:cst_type},
			success:function(data){
				$('#b_option').val(b_option);
				$('#g_option').val(g_option)
				$('#result').html(data);
			}
		})
	}


		
	$('#b_option').on('change',function(){
		var b_option = $('#b_option').val();
		window.location.href="?g_option="+g_option+"&b_option="+escape(b_option)+"&s_str="+escape(s_str)+"&page="+page;
	});
	

	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var numbering = $('#NUMBERING').val();
		var cstname= $('#CSTNAME').val();
		var mobile= $('#MOBILE').val();
		var resident1 = $('#RESIDENT1').val();
		var resident2 = $('#RESIDENT2').val();
		var ref_bank = $('#REF_BANK').val();
		var ref_acc = $('#REF_ACC').val();
		var branch = $('#BRANCH').val();
		var server = $('#SERVER').val();
		var server_num = $('#SERVER_NUM').val();
		var hometaxid = $('#HomeTaxID').val();
		var hometaxpw = $('#HomeTaxPW').val();
		var cst_type ="종합소득세";

		var action = "등록_RPA";

		//성과 이름이 올바르게 입력이 되면
		
		if( (branch!=''&& resident1 != ''&& resident2 != '') || (cstname != '') || (hometaxid !='' && hometaxpw !='' )) {

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{numbering:numbering, cstname:cstname, mobile:mobile, resident1:resident1,resident2:resident2,ref_bank:ref_bank,ref_acc:ref_acc ,action:action, branch:branch, server:server, server_num:server_num,hometaxid:hometaxid,hometaxpw:hometaxpw,cst_type:cst_type  },
				success:function(data){
					alert(data);
					location.reload();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}



	});		


	function checkit(){
		var g_option = $('#g_option').val();
		var b_option = $('#b_option').val();
		var s_str = escape($('#s_str').val());

		if(g_option !="" && s_str !=""){
			window.location.href="?b_option="+b_option+"&g_option="+g_option+"&s_str="+s_str+"&page="+page;
		}else{
			alert("검색 조건을 설정해주세요");
			if(g_option ==""){
				$('#s_option').focus();
			}else if(s_str ==""){
				$('#s_str').focus();
			}
		}
	}	


	$("#s_str").keydown(
		function(key) {
			if (key.keyCode == 13) {
				checkit();
			}
		}
	);


	$('#btn_search').click(
		function() {
			var g_option = $('#g_option').val();
			var b_option = $('#b_option').val();
			var s_str = escape($('#s_str').val());

			if(g_option !="" && s_str !=""){
				window.location.href="?b_option="+b_option+"&g_option="+g_option+"&s_str="+s_str+"&page="+page;
			}else{
				alert("검색 조건을 설정해주세요");
				if(g_option ==""){
					$('#s_option').focus();
				}else if(s_str ==""){
					$('#s_str').focus();
				}
			}
		}	
	);




});





</script>


</body>
</html>