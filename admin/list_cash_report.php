	<div class="wrap">
<?php
include "top.php";

?>		

		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>

				<div class="search">
					
					<div class="selectbox w100p">
						<label for="g_option" >선택</label>
						<select name="g_option" id ="g_option" >
							<option value="" selected>검색조건</option>
							<option value="NAME" >이름</option>
							<option value="MOBILE" >핸드폰</option>
						</select>
					</div>
					<input type="box" class="w200p" id="s_str" name="s_str" style="height:38px;">
					<button class="b_search" id="btn_search" name="btn_search" style="cursor:pointer;">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel" style="cursor:pointer;">초기화</button>
					<button class="b_excel" id="btn_excel" name="btn_excel" style="cursor:pointer;background-color:#426921;color:white;">엑셀다운</button>
										
				</div>



				<div class="board">
					<table style="width:1024px;">
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

$g_option = $_GET["g_option"];
$b_option = unescape($_GET["b_option"]);
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";

$page = $_GET["page"];


$QUERY_STR = "&g_option=".$g_option."&b_option=".$_GET["b_option"]."&s_str=".$_GET["s_str"];


$page_set = 100; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


	if($s_str !=""){
		switch($g_option){
			
			case "NAME" : 
				$query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
				break;
			case "MOBILE" :
			    $query_str1 .= " AND MOBILE like '%".$s_str."%' ";
			    break;
			default:
				$query_str1 .="";
			}	
	}



$query = "SELECT COUNT(1) AS 'total' FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
            WHERE IFNULL(B.CASH_REPORT_APP_NUM,'') <> '' ".$query_str1.$query_str2;


//$QUERY_STR = $query_str1.$query_str2;


####### PHP VER 7.0 #######
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));

$row = mysqli_fetch_array($result);

$total = $row["total"]; // 전체글수


//$QUERY_STR = $query_str1.$query_str2;

//$result = mysqli_query($connect,$query);

$result =  mysqli_query($connect,$query);

//while($row = mysqli_fetch_array($result)){
    
    $total = $row["total"]; // 전체글수
//}


 
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
	<input type=hidden id="page_flag" value="현금영수증 상세페이지">
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
	var page_flag = document.getElementById("page_flag").value;

	top_menu(page_flag);


	$('#btn_excel').click(
		function() {
			var req = new Request();
			var page = req.getParameter("page");
				
			//var action = "select_excel";
			var s_option = $('#s_option').val();
			//var g_option = $('#g_option').val();
			var s_str = $('#s_str').val();
			
			var first = "Y";
			var go_url = "excel_down_cash_report.php?s_option="+s_option+"&s_str="+s_str;

			window.open(go_url);


	});


	
	if (b_option != "") {
		$('#b_option').val(b_option).prop("selected",true);
		var select = $('#b_option');

		for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
			var idxData = select.eq(i).children('option:selected').text();
			select.eq(i).siblings('label').text(idxData);
		}
	}
	
	if (g_option != "") {
		$('#g_option').val(g_option).prop("selected",true);

		var select = $('#g_option');

		for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
			var idxData = select.eq(i).children('option:selected').text();
			select.eq(i).siblings('label').text(idxData);
		}

	}

	if (s_str!= "") {
		$('#s_str').val(s_str);
	}



	fetchUser();
	function fetchUser()
	{

		var action = "select_list_cash_report";
		var b_option = $('#b_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		var page = req.getParameter("page");
		
		isloading.start();
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,b_option:b_option,g_option:g_option, page:page},
			success:function(data){
				$('#result').html(data);
				isloading.stop();
			}
		})
	}


		
	$('#b_option').on('change',function(){
		var b_option = $('#b_option').val();

		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;


		window.location.href=newURL  + "?g_option="+g_option+"&b_option="+escape(b_option)+"&s_str="+escape(s_str);
	});

	


	$('#btn_cancel').click(
		function() {
			var g_option = '';
			var b_option = '';
			var s_str = '';

			window.location.href="?b_option="+escape(b_option)+"&g_option="+g_option+"&s_str="+s_str+"&page="+page;
		}	
	);
	


	function checkit(){
		var g_option = $('#g_option').val();
		var b_option = $('#b_option').val();
		var s_str = escape($('#s_str').val());

		if(g_option !="" && s_str !=""){
			window.location.href="?b_option="+escape(b_option)+"&g_option="+g_option+"&s_str="+s_str+"&page="+page;
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
				window.location.href="?b_option="+escape(b_option)+"&g_option="+g_option+"&s_str="+s_str+"&page="+page;
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



var select = $('select');
for (var i = 0; i < select.length; i++) {
    var idxData = select.eq(i).children('option:selected').text();
    select.eq(i).prev('label').text(idxData);
}
select.change(function () {
    var select_name = $(this).children("option:selected").text();
    $(this).siblings("label").text(select_name);
});





</script>

</html>