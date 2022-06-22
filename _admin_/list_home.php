
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
						<select name="s_option" id ="s_option">
							<option value="" selected>선택</option>
							<option value="CSTNAME">이름</option>
							<option value="MOBILE">핸드폰</option>
							<option value="MEMO">메모</option>
						</select>
					</div>
					
					<input type="box" class="w200p" id="s_str" name="s_str">
					<button class="b_search" id="btn_search" name="btn_search">조회</button>
					
					<div class="selectbox w150p">
						<label for="">지점선택</label>
						<select name="g_option" id ="g_option">
							<option value="0" selected>전체</option>
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
					</div>
						
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

$result = mysqli_query($connect,$query);

$row = mysqli_fetch_array($result);
 
$total = $row['total']; // 전체글수

 
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
	<input type="hidden" id="page_flag" value="주택임대">
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
	var action2 = "등록";
	var action = "select_home";
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action,action2:action2,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
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
	var action2 = "등록";
	var action = "select_home";

	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action,action2:action2,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
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

	var action2 = "등록";
	var action = "select_home";

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action,action2:action2, id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
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
	var action2 = "등록";
	var action = "select_home";


	if(event.keyCode==13){

		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,action2:action2,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
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
	var page_flag = document.getElementById("page_flag").value;
	top_menu(page_flag);

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

	var action = "select_home";
	var action2 = "select";
	var s_option = $('#s_option').val();
	var g_option = $('#g_option').val();
	var s_str = $('#s_str').val();
	var first = "Y";

	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action,action2:action2,s_str:s_str,s_option:s_option,g_option:g_option,first:first,page:page},
		success:function(data){
			$('#s_option').val(s_option);
			$('#g_option').val(g_option)
			$('#result').html(data);


		}
	})
}

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


function file_pop(id){
	window.open("https://taxtok.kr/admin/list_file.php?id="+id,"_blank","toolbar=no,scrollbars=no,resizable=no,width=500,height=600");
}
</script>


</html>