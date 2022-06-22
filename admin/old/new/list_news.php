<!DOCTYPE html>
<html>

</html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승세무법인 ADMIN</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
	<div class="wrap">
<?include "top.php";?>		

		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				

				

				<div class="search">
					<div class="selectbox w150p">
						<label for="">선택</label>
						<select name="g_option" id ="g_option">
							<option value="ALL" selected>사이트전체</option>
							<option value="HOS">병원톡</option>
						</select>
					</div>
					<div class="selectbox w150p">
						<label for="">선택</label>
						<select name="s_option" id ="s_option">
							<option value="subject" selected>제목</option>
							<option value="contents">내용</option>
							<option value="reguser">기사작성자</option>
							<option value="comp">소속</option>
						</select>
					</div>
					<div class="selectbox w150p">
						<label for="">선택</label>
						<select name="c_option" id ="c_option">
							<option value="" selected>카테고리</option>
							<option value="SCH" >세무일정</option>
							<option value="LED">장부기장</option>
							<option value="VAT">부가세</option>
							<option value="CIT">종소세</option>
							<option value="TRA">양도세</option>
							<option value="ING">상속세</option>
							<option value="GTX">증여세</option>
							<option value="THA">절세극장</option>
							<option value="TAX">조세</option>
							<option value="LAB">노무</option>
							<option value="FOU">창업</option>
							<option value="OPE">경영</option>
							<option value="MNY">자금</option>
							<option value="PRO">홍보</option>
							<option value="ISS">이슈</option>
							<option value="LAW">법률</option>
							<option value="OP2">운영</option>
							<option value="EDU">교육</option>
							<option value="HEA">건강</option>
							<option value="CUL">문화</option>
							<option value="FAQ">FAQ</option>
							<option value="19T">19금세금</option>
							<option value="QNA">상담사례</option>
						</select>
					</div>
					<input type="box" class="w200p" id="s_str" name="s_str">
					<button class="b_search" id="btn_search" name="btn_search">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel">초기화</button>
					<button class="b_newadd"  name="new" id="new" style="background-color:#d83506e3;color:white;">신규추가</button>

					
				</div>



				<div class="board" style="width:1300px;">
					<table style="width:100%;">
						<tbody id="result">
						</tbody>
					</table>
				</div>


<?php

 function toString($text){
   return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
}

function unescape($text){
   return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'toString', $text));
}


$STR = "";
$STR2 = "";

$c_option = $_GET["c_option"];
$g_option = $_GET["g_option"];
$b_option = unescape($_GET["b_option"]);
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";
$query_desc = "ORDER BY CSTID DESC";

$page = $_GET["page"];


$QUERY_STR = "&g_option=".$g_option."&b_option=".$_GET["b_option"]."&s_str=".$_GET["s_str"];


$page_set = 12; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


	switch($s_option){
			case "subject" : 
				$STR .= " AND SUBJECT like '%".$s_str."%' ";
				break;
			case "content" : 
				$STR .= " AND CONTENTS_ like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$STR .= " AND NEWS_REGUSER like '%".$s_str."%' ";
				break;
			case "comp" : 
				$STR .= " AND NEWS_REGUSER_COMP like '%".$s_str."%' ";
				break;
			default:
				$STR .=" ";
			}	


	if($g_option != ""){
		$STR .= " AND SITE_GUBUN = '".$g_option."' ";
	}

	if($c_option != ""){
		$STR .= " AND CATE = '".$c_option."' ";
	}

$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' ".$STR;


//$QUERY_STR = $query_str1.$query_str2;

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

$QUERY_STR = "&s_option=".$_GET["s_option"]."&g_option=".$_GET["g_option"]."&s_str=".$_GET["s_str"]."&sort=".$_GET["sort"]."&flag=".$_GET["flag"]."&c_option=".$_GET["c_option"];
 

?>	
				<div class="page">
					
<?php 

						echo ($prev_block > 0) ? "<a href='$PHP_SELF?page=$prev_block_page$QUERY_STR' class='first'><span class='icon'>처음</span></a>" : "<a  class='first'><span class='icon'>처음</span></a>";
						echo ($prev_page > 0) ? "
						<a href='$PHP_SELF?page=$prev_page$QUERY_STR' class='prev'><span class='icon'>이전</span></a> " : "<a  class='prev'><span class='icon'>이전</span></a> ";
?>	
					<span class="num">
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='$PHP_SELF?page=$i$QUERY_STR'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>
					</span>
<?php 
					echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$QUERY_STR' class='next'><span class='icon'>다음</span></a> " : "<a class='next'><span class='icon'>다음</span></a> ";
					echo ($next_block <= $total_block) ? "<a href='$PHP_SELF?page=$next_block_page$QUERY_STR' class='last'><span class='icon'>마지막</span></a>" : "<a class='last'><span class='icon'>마지막</span></a>";
?>

				</div>
			</div>
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="page_flag" value="뉴스톡">
	<input type="hidden" id="s_sort">
	<input type="hidden" id="s_flag">

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
	var s_option = req.getParameter("s_option");
	var g_option = req.getParameter("g_option");
	var c_option = req.getParameter("c_option");
	var s_str = req.getParameter("s_str");
	var flag = req.getParameter("flag");
	var sort = req.getParameter("sort");
	var page_flag = document.getElementById("page_flag").value;

	top_menu(page_flag);

	if(flag != ""){
		$('#s_flag').val(flag);	
	}

	if(sort != ""){
		$('#s_sort').val(sort);
	}

	
	if(c_option !=""){
		$('#c_option').val(c_option).attr('selected','selected');
	}

	if (s_option != "") {
		switch (s_option)
		{
			case "subject" : 	
				$('#s_option').val('subject').attr('selected','selected');
				break;
			case "contents" : 		
				$('#s_option').val('contents').attr('selected','selected');
				break;
			case "reguser" : 						
				$('#s_option').val('reguser').attr('selected','selected');
				break;
			case "comp" : 	
				$('#s_option').val('comp').attr('selected','selected');
				break;
			default : alert("error");
		}
	} 

	if (g_option != "") {
		switch (g_option)
		{
			case "ALL" : 	
				$('#g_option').val('ALL').attr('selected','selected');
				break;
			case "HOS" : 		
				$('#g_option').val('HOS').attr('selected','selected');
				break;
			default : alert("error");
		}
	}

	if (s_str != "") {
		$('#s_str').val(req.getParameter("s_str"));;
	} 

		
	$('#btn_cancel').click(
		function(){
			$("#g_option").val("ALL").attr("selected","selected");
			$("#s_option option:eq(1)").attr("selected","selected");
			$("#s_str").val('');
		}	
	);


	function checkit(){
		var s_option = $('#s_option').val();
		var g_option = $('#g_option').val();
		var c_option = $('#c_option').val();
		var sort =  $('#s_sort').val();
		var flag = $('#s_flag').val();
		var s_str = $('#s_str').val();

		if(s_option !="" ){
			window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&sort="+sort+"&flag="+flag+"&c_option="+c_option;		
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


	$('#btn_search').click(
		function() {
			var s_option = $('#s_option').val();
			var g_option = $('#g_option').val();
			var c_option = $('#c_option').val();
			var sort = $('#s_sort').val();
			var flag = $('#s_flag').val();
			var s_str = $('#s_str').val();

			if(s_option !="" ){
				window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&sort="+sort+"&flag="+flag+"&c_option="+c_option;
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


	$('#new').click(
		function() {
			window.location.href="write.php";
		});



	fetchUser();
	function fetchUser()
	{
		var req = new Request();
		var sort = req.getParameter("sort");
		var flag = req.getParameter("flag");
		var page = req.getParameter("page");

			
		var action = "select";
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();
		var first = "Y";

		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,s_option:s_option,g_option:g_option,sort:sort,flag:flag,c_option:c_option,first:first, page:page},
			success:function(data){
				$('#subject').val('');
				$('#news_reguser').val('');
				$('#news_reguser_comp').val('');
				$('#img_url').val('');
				$('#cate').val('');
				$('#action').text("추가");
				$('#result').html(data);
			}
		})

	}


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		var subject = $('#subject').val();
		var news_regdate= $('#news_regdate').val();
		var news_reguser= $('#news_reguser').val();
		var news_reguser_comp = $('#news_reguser_comp').val();
		var img_url = $('#img_url').val();
		var cate = $('#cate').val();
		var contents =  $('#summernote').summernote('code');
		var id= $('#user_id').val();
		var action = $('#action').text();
		var first = "Y";

		if(subject !='' && contents != ''){

			$.ajax({
				url:"action.php", 
				method:"POST",
				data:{subject:subject,news_regdate:news_regdate,news_reguser:news_reguser,news_reguser_comp:news_reguser_comp,contents:contents,img_url:img_url,cate:cate,id:id,action:action },
				success:function(data){
					alert(data);
					fetchUser();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}

	});

	//[3]수정 버튼을 클릭했을 때 작동되는 함수
	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		window.open("write.php?id="+id);
	});


	
	var select = $('select');
    for (var i = 0; i < select.length; i++) {
        var idxData = select.eq(i).children('option:selected').text();
        select.eq(i).siblings('label').text(idxData);
    }
    select.change(function () {
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });

});


function sort(str){

	var req = new Request();
	var sort = req.getParameter("sort");

	switch(sort){
		case "" : 
			sort = "desc";
			break;
		case "asc" : 
			sort = "desc";
			break;
		case "desc" : 
			sort = "asc";
			break;
		default:"";
	}

	var s_option = $('#s_option').val();
	var g_option = $('#g_option').val();
	var c_option = $('#c_option').val();
	var s_str = $('#s_str').val();

	$('#s_flag').val(str);
	$('#s_sort').val(sort);
	window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&sort="+sort+"&flag="+str+"&c_option="+c_option;
}


function sort_onload() {
	var req = new Request();
	var sort = req.getParameter("sort");
	var flag = req.getParameter("flag");
	
	switch(sort){
		case "desc" :
		document.getElementById("sort_"+flag).innerHTML="▼";
		break;
		case "asc" :
		document.getElementById("sort_"+flag).innerHTML="▲";
		break;
	}
}

</script>
<script>sort_onload();</script>

</html>