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
							<option value="" selected>전체</option>
							<option value="num">번호</option>
							<option value="cstname">납세자명</option>
							<option value="owner">담당자명</option>
							<option value="progress">진행상태</option>
							<option value="reguser">접수자</option>
							<option value="mobile">연락처</option>
						</select>
					</div>
					<div class="selectbox w150p">
						<label for="">지점선택</label>
						<select name="g_option" id ="g_option">
							<option value="ALL" selected>지점선택</option>
							<option value="D1003">강남</option>
							<option value="D1004">용인</option>
							<option value="D1006">안양</option>
							<option value="D1007">수원</option>
							<option value="D1008">일산</option>
							<option value="D1009">부천</option>
							<option value="D1010">광주</option>
							<option value="D1011">분당</option>
							<option value="D1010">기흥</option>
							<option value="D1013">세무</option>
							<option value="D1002">회계</option>
							<option value="D1014">영업</option>
						</select>
					</div>
					<input type="box" class="w200p" id="s_str" name="s_str" style="height:38px;" >
					<button class="b_search" id="btn_search" name="btn_search">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel">초기화</button>
					<button class="b_newadd"  name="new" id="new" style="background-color:#6f4343b5;color:white;">신규추가</button>

					
				</div>



				<div class="board" style="width:1202px;">
					<table style="width:1200px;">
						<tbody id="result"  >
						</tbody>
					</table>
				</div>

				

<?php
/*페이징 처리 : S*/
 function toString($text){
   return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
}

function unescape($text){
   return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'toString', $text));
}


$STR = "";
$STR2 = "";

$s_option = $_GET["s_option"];
$g_option = $_GET["g_option"];
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";
$page = $_GET["page"];

if($depth == "D2005" && $userid !=""){
	$WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
}

$QUERY_STR = "&g_option=".$g_option."&b_option=".$_GET["b_option"]."&s_str=".$_GET["s_str"];


$page_set = 30; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


	switch($s_option){
			case "cstname" : 
				$STR .= " AND CSTNAME like '%".$s_str."%' ";
				break;
			case "progress" : 
				$STR .= " AND PROGRESS_ like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$STR .= " AND REGUSER like '%".$s_str."%' ";
				break;
			case "mobile" : 
				$STR .= " AND MOBILE like '%".$s_str."%' ";
				break;
			default:
				$STR .=" ";
			}	


	if($g_option != ""){
		$STR .= " AND SITE_GUBUN = '".$g_option."' ";
	}


$query = "SELECT count(A.ID) as total
			FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON A.REGUSER = B.USERID
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
			WHERE 1=1 ".$WHERE_STR." ORDER BY A.ID DESC ";


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
	<input type="hidden" id="page_flag" value="4대보험">
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

function popup_(id,str){
	window.open("pop_layer.php?id="+id+"&str="+str, "a", "width=425, height=815, left=100, top=50, location=no, titlebar=no,menubar=no");
}



function modify_option(obj){ //현황 저장
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("prio_","");
	var id = id.replace("prog_","");

	//var select_val = document.getElementById(id_tmp).value;
	var prio_id = "prio_"+id;
	var prio = document.getElementById(prio_id).value;
	var prog_id = "prog_"+id;
	var prog = document.getElementById(prog_id).value;	

	//var stat = obj.value;

	var action = "upt_4insu_opt";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,prio:prio,prog:prog},
		success:function(data){
			console.log(data);
			//alert("저장완료");
		}
	})

}


function modify_quest(obj){ //문의유형 저장
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("prio_","");
	var id = id.replace("prog_","");

	//var select_val = document.getElementById(id_tmp).value;
	var prio_id = "prio_"+id;
	var prio = document.getElementById(prio_id).value;
	var prog_id = "prog_"+id;
	var prog = document.getElementById(prog_id).value;	

	//var stat = obj.value;

	var action = "upt_4insu_opt";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,prio:prio,prog:prog},
		success:function(data){
			console.log(data);
			//alert("저장완료");
		}
	})

}



$(document).ready(function(){


	var req = new Request();
	var s_option = req.getParameter("s_option");
	var g_option = req.getParameter("g_option");
	var s_str = req.getParameter("s_str");
	var page = req.getParameter("page");
	var page_flag = document.getElementById("page_flag").value;
	top_menu(page_flag);
	var depid="<?= $depid ?>";

	if(depid != "" && g_option == "" ){
		if(depid == "D1003" || depid == "D1004" || depid == "D1006" || depid == "D1007" || depid == "D1008" || depid == "D1009" || depid == "D1010" || depid == "D1011" || depid == "D1012" ){
			g_option = depid;
		}
	}
    

	if (s_option != "") {
		switch (s_option)
		{
			case "cstname" : 	
				$('#s_option').val('cstname').attr('selected','selected');
				break;
			case "progress" : 		
				$('#s_option').val('progress').attr('selected','selected');
				break;
			case "reguser" : 						
				$('#s_option').val('reguser').attr('selected','selected');
				break;
			case "comp" : 	
				$('#s_option').val('mobile').attr('selected','selected');
				break;
			case "num" : 	
				$('#s_option').val('num').attr('selected','selected');
				break;
			default : alert("error");
		}
	} 

	if (g_option != "") {
		$('#g_option').val(g_option).attr('selected','selected');
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

	function ck_qst_flag(flag){
		alert(flag);
	}	

	function checkit(){
		var s_option = $('#s_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();

		if(s_option !="" ){
			window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str);		
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
			var s_str = $('#s_str').val();

			if(s_option !="" ){
				window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str);
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
			window.location.href="write_4insu.php";
		});



	fetchUser();
	function fetchUser()
	{
		var req = new Request();
		var page = req.getParameter("page");
			
		var action = "select_4insu_list";
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();
		var first = "Y";
		var depth="<?= $depthid ?>";
		var userid="<?= $userid ?>";
		var depid="<?= $depid ?>";

		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,s_option:s_option,g_option:g_option,first:first, page:page,depth:depth,userid:userid,depid:depid},
			success:function(data){
				
				$('#result').html(data);
				
			}
		})

	}

	$('#g_option').on('change',function(){
		var g_option = $('#g_option').val();
		window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&page="+page;
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





</script>

</html>