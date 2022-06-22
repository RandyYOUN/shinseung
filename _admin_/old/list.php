<?php
   $ip_ck= $_SERVER["REMOTE_ADDR"];
 /*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('http://www.naver.com');</script>";
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>


<script src="summernote.js"></script>


</head>
<body>
<form method="post" onsubmit="return checkit()">

<div class="container box" style="width:1400px;">
<span>
<img src="resources/images/new_logo.png">
</span>
<br><br>
<div>
	<span  style="font-size:20px;">
		<a href="http://taxtok.kr/admin/list.php">&nbsp;<b>[뉴스톡]</b>&nbsp;</a>
	</span>
	
	<span >
		<a href="http://taxtok.kr/admin/list_qna.php">&nbsp;[병의원QnA]&nbsp;</a>
	</span>
	
	<span >
		<a href="http://taxtok.kr/admin/list_cal.php">&nbsp;[조정료계산]&nbsp;</a>
	</span>
	<span >
		<a href="http://taxtok.kr/admin/list_date.php">&nbsp;[세무일정]&nbsp;</a>
	</span>
	<span >
		<a href="http://taxtok.kr/admin/list_cst.php">&nbsp;[고객리스트's]&nbsp;</a>
	</span>
	<span>
		<a href="http://taxtok.kr/admin/list_home.php">&nbsp;[주택임대]&nbsp;</a>
	</span>
	<span>
		<a href="http://taxtok.kr/admin/list_income.php">&nbsp;[종합소득세 신청]&nbsp;</a>
	</span>
	<span >
		<a href="http://taxtok.kr/admin/list_callback.php">&nbsp;[콜백리스트]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_RPA_inc.php">&nbsp;[RPA_종소세]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_RPA_vat.php">&nbsp;[RPA_부가세]&nbsp;</a>
	</span>

	<span>
		<a href="http://taxtok.kr/admin/list_dev.php">&nbsp;[Dev]&nbsp;</a>
	</span>

</div>

<br>
<br>
<button type="button" name="new_beta" id="new_beta" class="new">신규등록</button>
<br><br>
<select name="g_option" id ="g_option" class="form-control" style="width:120px;display:table-cell;">
	<option value="ALL" selected>사이트전체</option>
	<option value="HOS">병원톡</option>
</select>

<select name="s_option" id ="s_option" class="form-control" style="width:120px;display:table-cell;">
	<!--option value="" >선택</option-->
	<option value="subject" selected>제목</option>
	<option value="contents">내용</option>
	<option value="reguser">기사작성자</option>
	<option value="comp">소속</option>
</select>

<select name="c_option" id ="c_option" class="form-control" style="width:120px;display:table-cell;">
	<!--option value="" >선택</option-->
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

<input type = "text" style="width:300px;height:34px;" id="s_str" name="s_str"></input>
<input type = "text" style="width:300px;height:34px;display:none;" id="s_str2" name="s_str2"></input>
<input type="button" value="검색" id="btn_search" name="btn_search" style="height:34px;">
<input type="button" value="초기화" id="btn_cancel" name="btn_cancel" style="width:70px;height:34px;">

<br><br>
<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->

<div class="table-responsive" >
<table class="table table-bordered" >
<tbody id="result">
</tbody>
</table>
<?php
include "db_info.php";


 function toString($text){
   return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
}


function unescape($text){
   return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'toString', $text));
}

$STR = "";
$STR2 = "";
$page = $_GET["page"];

$s_option = $_GET["s_option"];
$g_option = $_GET["g_option"];
$c_option = $_GET["c_option"];
$s_str = unescape($_GET["s_str"]);

$query_desc = "ORDER BY CSTID DESC";

$page = $_GET["page"];

$page_set = 12; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


	//if($s_str !=""){
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
	//}


	if($g_option != ""){
		$STR .= " AND SITE_GUBUN = '".$g_option."' ";
	}

	if($c_option != ""){
		$STR .= " AND CATE = '".$c_option."' ";
	}
	
	

$page_set = 12; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' ".$STR;

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
 
$query_str = "&s_option=".$_GET["s_option"]."&g_option=".$_GET["g_option"]."&s_str=".$_GET["s_str"]."&sort=".$_GET["sort"]."&flag=".$_GET["flag"]."&c_option=".$_GET["c_option"];

?>			
	<section class="paging">
				<div>
<?php 
echo ($prev_page > 0) ? "<a href='$PHP_SELF?page=$prev_page$query_str' class='prev'>PRVE</a> " : "<a  class='prev'>PRVE</a> ";
?>					
					<span>
<?php
//echo "query = ".$query;
for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='?page=$i$query_str'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>
					</span>
<?php 
echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$query_str' class='next'>NEXT</a> " : "<a class='next'>NEXT</a> ";
?>
				</div>
			</section>
	<div style="margin:0 0 0 97%;font-size:20px;"><a href="#" class="go_top">top</a></div>
</div>
<br/><br/><br/><br/><br/><br/> 

<input type="hidden" id="s_sort">
<input type="hidden" id="s_flag">
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
	var s_option = req.getParameter("s_option");
	var g_option = req.getParameter("g_option");
	var c_option = req.getParameter("c_option");
	var s_str = req.getParameter("s_str");
	var flag = req.getParameter("flag");
	var sort = req.getParameter("sort");

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



//$('#btn_search').click(
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

		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,s_option:s_option,g_option:g_option,sort:sort,flag:flag,c_option:c_option,first:first, page:page},
			success:function(data){
				$('#subject').val('');
				//$('#news_regdate').val('');
				$('#news_reguser').val('');
				$('#news_reguser_comp').val('');
				$('#img_url').val('');
				$('#cate').val('');
				//$('#s_option').val();
				//$('#s_str').val();
				$('#action').text("추가");
				$('#result').html(data);
				var modi_contents = "";
				$('#summernote').summernote('code', modi_contents);
			}
		})

	}


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
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

//		alert(action);

		//성과 이름이 올바르게 입력이 되면
		if(subject !='' && contents != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{subject:subject,news_regdate:news_regdate,news_reguser:news_reguser,news_reguser_comp:news_reguser_comp,contents:contents,img_url:img_url,cate:cate,id:id,action:action },
				success:function(data){

				//성공하면 action.php 에서 출력된 데이터가 넘어온다.
					alert(data);

					//입력 후 리스트 다시 갱신
					fetchUser();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}

	});

		//[3]수정 버튼을 클릭했을 때 작동되는 함수
		$(document).on('click', '.update', function(){


		//id속성값을 가져오기 - 클릭한 행의 id 값 - 즉 user_id 값이다.
			var id = $(this).attr("id");
			
			//window.location.href="modify.php?id="+id;
			window.open("modify.php?id="+id);

		});






		//버튼을 클릭했을 때 작동되는 함수
		$(document).on('click','.new',function(){

			var id = $(this).attr("id");

			window.location.href="write.php";

		});

		$(document).on('click','.new_beta',function(){

			var id = $(this).attr("id");

			window.location.href="write_.php";

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
	//alert(sort);
	window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&sort="+sort+"&flag="+str+"&c_option="+c_option;

	//var sort_tmp = document.getElementById("sort_"+str).innerHTML="▼";
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

</body>
</html>