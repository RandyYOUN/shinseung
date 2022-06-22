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
						<label for="b_option">지점선택</label>
						<select name="b_option" id ="b_option">
							<option value="" selected>전지점</option>
							<option value="세무톡">세무톡</option>
							<option value="강남">강남</option>
							<option value="용인">용인</option>
							<option value="안양">안양</option>
							<option value="수원">수원</option>
							<option value="일산">일산</option>
							<option value="부천">부천</option>
							<option value="광주">광주</option>
							<option value="분당">분당</option>
							<option value="기흥">기흥</option>
							<option value="세무">세무</option>
							<option value="회계">회계</option>
							<option value="영업">영업</option>
							<option value="동탄">동탄</option>
						</select>
					</div>
					<div class="selectbox w50p">
						<label for="g_option">선택</label>
						<select name="g_option" id ="g_option">
							<option value="NAME" selected>이름</option>
						</select>
					</div>
					<input type="box" class="w200p" id="s_str" name="s_str" style="height:38px;">
					<button class="b_search" id="btn_search" name="btn_search" style="cursor:pointer;">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel" style="cursor:pointer;">초기화</button>
										
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


if($b_option != ""){
    $query_str2 .= " AND SWITCH_ACC_BRANCH(ACC_FLAG) = '".$b_option."' ";
}


$page_set = 100; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


	if($s_str !=""){
		switch($g_option){
			
			case "NAME" : 
				$query_str1 .= " AND ACC_NAME like '%".$s_str."%' ";
				break;
			default:
				$query_str1 .="";
			}	
	}



$query = "SELECT count(1) as total FROM TB100031  WHERE 1=1 ".$query_str1.$query_str2;


//$QUERY_STR = $query_str1.$query_str2;

/*
####### PHP VER 7.0 #######
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));

$row = mysqli_fetch_array($result);

$total = $row["total"]; // 전체글수

*/
//$QUERY_STR = $query_str1.$query_str2;

//$result = mysqli_query($connect,$query);

$result =  mysqli_query($connect,$query);

while($row = mysqli_fetch_array($result)){
    
    $total = $row["total"]; // 전체글수
}


 
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
	<input type=hidden id="page_flag" value="종합소득세_계좌입금확인">
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

		var action = "select_list_back_acc";
		var b_option = $('#b_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		var page = req.getParameter("page");
		
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,b_option:b_option,g_option:g_option, page:page},
			success:function(data){
				$('#result').html(data);
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