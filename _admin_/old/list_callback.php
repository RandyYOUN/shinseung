<?php
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
	<meta property="og:image" content="../resources/images/sum2.png">
	<link rel="shortcut icon" href="../resources/images/icon.ico">

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
<div class="container box" style="margin:0 0 0 300px;">
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
	<span style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_callback.php">&nbsp;<B>[콜백리스트]</B>&nbsp;</a>
	</span>
		<span>
		<a href="https://taxtok.kr/admin/list_RPA_inc.php">&nbsp;[RPA_종소세]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_RPA_vat.php">&nbsp;[RPA_부가세]&nbsp;</a>
	</span>	<span>
		<a href="https://taxtok.kr/admin/list_dev.php">&nbsp;[Dev]&nbsp;</a>
	</span>

</div>
<br>
<br>

<select name="s_option" id ="s_option" class="form-control" style="width:120px;display:table-cell;">
	<option value="" selected>선택</option>
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
<div class="table-responsive"  style="width:1440px;" >
<b><span style="color:red;">※ 첨부파일 다운로드시 팝업차단을 해제하여 주세요.</span></b>

	<table class="table table-bordered" style="width:1440px;" >
		<tbody id="result">
		</tbody>
	</table>
	<?php
include "db_info.php";


$STR = "";
$STR2 = "";
$page = $_GET["page"];
$page_set = 12; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' ".$STR.$STR2;

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
echo ($prev_page > 0) ? "<a href='$PHP_SELF?page=$prev_page$query_str' class='prev'>PRVE</a> " : "<a  class='prev'>PRVE</a> ";
?>					
					<span>
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='?page=$i$query_str'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>

						<!--a href=""><strong>1</strong>/10</a-->
					</span>
<?php 
echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$query_str' class='next'>NEXT</a> " : "<a class='next'>NEXT</a> ";
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



function select_cnt(obj){ //전화횟수 저장
	
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_ip_","");

	var select_val = obj.value;
		
	var memo_id = "memo_ip_"+id;
	var memo = document.getElementById(memo_id).value;
	var bran_id = "bran_"+id;
	var bran = document.getElementById(bran_id).value;
	var stat_id = "stat_"+id;
	var stat = document.getElementById(stat_id).value;
	var action = "등록";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_callback.php",
		method:"POST",
		data:{action:action,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
		success:function(data){
			//alert("저장완료");
		}
	})

}


function select_bran(obj){ //지점 저장
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("bran_","");
	
	var select_val = document.getElementById(id).value;
	
	var memo_id = "memo_ip_"+id;
	var memo = document.getElementById(memo_id).value;

	var bran = obj.value;

	var stat_id = "stat_"+id;
	var stat = document.getElementById(stat_id).value;
	var action = "등록";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_callback.php",
		method:"POST",
		data:{action:action,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
		success:function(data){
			//alert("저장완료");
		}
	})

}


function select_stat(obj){ //현황 저장
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("stat_","");

	var select_val = document.getElementById(id).value;

	var memo_id = "memo_ip_"+id;
	var memo = document.getElementById(memo_id).value;
	var bran_id = "bran_"+id;
	var bran = document.getElementById(bran_id).value;
	
	var stat = obj.value;

	var action = "등록";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_callback.php",
		method:"POST",
		data:{action:action,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
		success:function(data){
			//alert("저장완료");
		}
	})

}


function memo_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_ip_","");

	var memo_id = "memo_ip_"+id;
	var memo = document.getElementById(memo_id).value;
	var bran_id = "bran_"+id;
	var bran = document.getElementById(bran_id).value;
	var stat_id = "stat_"+id;
	var stat = document.getElementById(stat_id).value;

	var select_val = document.getElementById(id).value;
	var action = "등록";


	if(event.keyCode==13){

		$.ajax({
			url:"select_callback.php",
			method:"POST",
			data:{action:action,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
			success:function(data){
				//alert("저장완료");
				location.reload();
			}
		})
	}

}



function switch_comp(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_lbl_","");

	document.getElementById("memo_lbl_"+id).style.display = "none";
	document.getElementById("memo_ip_"+id).style.display = "block";

	document.getElementById("memo_ip_"+id).focus();
}




$(document).ready(function(){

	var req = new Request();
	var s_option = req.getParameter("s_option");
	var g_option = req.getParameter("g_option");
	var s_str = req.getParameter("s_str");
	var page = req.getParameter("page");


	if (s_option != "") {
		
		$('#s_option').val(s_option).attr('selected','selected');
	} 

	if (g_option != "") {
		
		$('#g_option').val(g_option).attr('selected','selected');
	} 

	if (req.getParameter("s_str") != "") {
		$('#s_str').val(s_str);;
	} 


	function checkit(){
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();

		if(s_option !="" && s_str !=""){
			window.location.href="?s_option="+s_option+"&s_str="+escape(s_str)+"&page="+page;
		}else{
			alert("검색 조건을 설정해주세요");
			if(s_option ==""){
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


$('#g_option').on('change',function(){
	var g_option = $('#g_option').val();
	window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&page="+page;
});


$('#btn_search').click(
	function() {
		
		var s_option = $('#s_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		s_str = s_str.replace(/\s/gi, ''); 

		if(s_option !="" &&  s_str !=""){
			window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&page="+page;
		}else{
			alert("검색 조건을 설정해주세요");
			if(s_option ==""){
				$('#s_option').focus();
			}else if(s_str ==""){
				$('#s_str').focus();
			}
		}
	}	
);

fetchUser();
function fetchUser()
{

	var action = "select";
	var s_option = $('#s_option').val();
	var g_option = $('#g_option').val();
	var s_str = $('#s_str').val();
	var first = "Y";

	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_callback.php",
		method:"POST",
		data:{action:action,s_str:s_str,s_option:s_option,g_option:g_option,first:first,page:page},
		success:function(data){
			$('#s_option').val(s_option);
			$('#g_option').val(g_option)
			$('#result').html(data);
		}
	})


}



});


function file_pop(id){
	window.open("https://taxtok.kr/admin/list_file.php?id="+id,"_blank","toolbar=no,scrollbars=no,resizable=no,width=500,height=600");
}
</script>


</body>
</html>