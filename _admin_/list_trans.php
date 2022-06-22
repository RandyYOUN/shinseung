<?PHP 
include "top.php";
?>		
<div class="wrap">
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
							<option value="cstname">납세자명</option>
							<option value="mobile">연락처</option>
							<option value="progress">진행상태</option>
							<option value="etc">비고</option>
							<option value="num">번호</option>
							<option value="deadline">신고기한</option>
							<option value="rep_date">신고일</option>
							<option value="regdate">접수일</option>

						</select>
					</div>
					<span id="s_date" name="s_date" style="display:none;width:27%;margin:0px 10px 0px 10px;" >
						<input type="date" class="w200p" id="s_date1" name="s_date1" style="font-size:13px;width:135px;height:36px;">&nbsp;
						<font style="margin:0px 10px 0px 10px;">~</font>&nbsp;
						<input type="date" class="w200p" id="s_date2" name="s_date2" style="font-size:13px;width:135px;height:36px;">
					</span>
					<input type="box" class="w200p" id="s_str" name="s_str">
					<button class="b_search" id="btn_search" name="btn_search">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel">초기화</button>
					<button class="b_newadd"  name="new" id="new" style="background-color:#4e46467d;color:white;">신규추가</button>
					<button class="b_newadd"  name="excel" id="excel" style="background-color:#426921;color:white;">엑셀다운로드</button>
					
					<div class="selectbox w100p">
						<label for="">지점선택</label>
						<select name="g_option" id ="g_option">
							<option value="ALL" selected>전지점</option>
							<option value="D1003">강남</option>
							<option value="D1004">용인</option>
							<option value="D1006">안양</option>
							<option value="D1007">수원</option>
							<option value="D1008">일산</option>
							<option value="D1009">부천</option>
							<option value="D1010">광주</option>
							<option value="D1011">분당</option>
							<option value="D1012">기흥</option>
							<option value="D1013">세무</option>
							<option value="D1002">회계</option>
							<option value="D1014">영업</option>
							<option value="D1021">동탄</option>
						</select>
					</div>

				</div>



				<div class="board" style="width:1440px;">
					<table style="width:1440px;">
						<tbody id="result"  >
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

$s_option = $_GET["s_option"];
$g_option = $_GET["g_option"];
$s_date1 = $_GET["s_date1"];
$s_date2 = $_GET["s_date2"];
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";
$page = $_GET["page"];

if($depth == "D2005" && $userid !=""){
	$WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
}

$QUERY_STR = "&g_option=".$g_option."&b_option=".$_GET["b_option"]."&s_str=".$_GET["s_str"]."&s_date1=".$s_date1."&s_date2=".$s_date2;


$page_set = 100; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


	if($s_option != ""){
		switch($s_option){
			case "cstname" : 
				$WHERE_STR .= " AND A.CSTNAME like '%".$s_str."%' ";
				break;
			case "owner" : 
				$WHERE_STR .= " AND I.USERNAME like '%".$s_str."%' ";
				break;
			case "progress" : 
				$WHERE_STR .= " AND PROGRESS like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$WHERE_STR .= " AND B.USERNAME like '%".$s_str."%' ";
				break;
			case "mobile" : 
				$WHERE_STR .= " AND A.MOBILE like '%".$s_str."%' ";
				break;
			case "num" : 
				$WHERE_STR .= " AND A.ID = '".$s_str."' ";
				break;
			case "etc" : 
				$WHERE_STR .= " AND A.ETC LIKE '%".$s_str."%' ";
				break;
			case "deadline" : 
				$WHERE_STR .= " AND DATE_FORMAT(A.DEADLINE, '%Y-%m-%d') BETWEEN '".$s_date1."' AND '".$s_date2."' AND DATE_FORMAT(A.REGDATE, '%Y-%m-%d') <> '0000-00-00' ";
				break;
			case "rep_date" : 
				$WHERE_STR .= " AND DATE_FORMAT(A.REP_DATE, '%Y-%m-%d') BETWEEN '".$s_date1."' AND '".$s_date2."' AND DATE_FORMAT(A.REGDATE, '%Y-%m-%d') <> '0000-00-00'";
				break;
			case "regdate" : 
				$WHERE_STR .= " AND DATE_FORMAT(A.REGDATE, '%Y-%m-%d') BETWEEN '".$s_date1."' AND '".$s_date2."'  AND DATE_FORMAT(A.REGDATE, '%Y-%m-%d') <> '0000-00-00' ";
				break;
			default:
				$WHERE_STR ="";
		}	
	}

	if($g_option != "" && $g_option != "ALL"){
		$WHERE_STR .= " AND A.REG_BRANCH = '".$g_option."'";	
	}


$query = "SELECT count(A.ID) as total
			FROM dbsschina.TB600010 AS A 
LEFT OUTER JOIN TB980010 AS B ON B.USERID = A.REGUSER 
LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
LEFT OUTER JOIN TB750010 AS J ON J.CODE_ = A.PRIO_NUM
WHERE VISIBLE='Y' ".$WHERE_STR." ORDER BY A.ID DESC ";


//$QUERY_STR = $query_str1.$query_str2;
$connect = @mysqli_connect("211.43.203.77", "sschina", "shinseung1@", "dbsschina");
$result = mysqli_query($connect,$query);

$row = mysqli_fetch_array($result);
 
$total = $row["total"]; // 전체글수

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

$QUERY_STR = "&s_option=".$_GET["s_option"]."&g_option=".$_GET["g_option"]."&s_str=".$_GET["s_str"]."&sort=".$_GET["sort"]."&flag=".$_GET["flag"]."&c_option=".$_GET["c_option"]."&deadline=".$_GET["deadline"]."&rep_date=".$_GET["rep_date"]."&regdate=".$_GET["regdate"]."&s_date1=".$_GET["s_date1"]."&s_date2=".$_GET["s_date2"];
 

?>	
				<div class="page">
					
<?php 
//echo $query;

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
	<input type="hidden" id="page_flag" value="재산제세 상담보고">
	<input type="hidden" id="s_sort">
	<input type="hidden" id="s_flag">

</body>

<style>

[data-tooltip-text]:hover {
	position: relative;
}

[data-tooltip-text]:hover:after {
	background-color: #000000;
	background-color: rgba(0, 0, 0, 0.8);

	-webkit-box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);
	-moz-box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);
	box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);

	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;

	color: #FFFFFF;
	font-size: 12px;
	content: attr(data-tooltip-text);

  margin-bottom: 10px;
	top: -230%;
	left: 100;    
	padding: 10px 12px;
	position: absolute;
	width: auto;
	min-width: 100px;
	max-width: 400px;
	word-wrap: break-word;

	z-index: 9999;
}

</style>

<script language=JavaScript charset='utf-8'>

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


function memo_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_ip_","");
	var memo_id = "memo_ip_"+id;

	var memo = document.getElementById(memo_id).value;
	var action = "upt_memo_trans";


	if(event.keyCode==13){

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id,memo:memo},
			success:function(data){
				//alert(data);
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



function modify_option(obj){ //현황 저장
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("prio_","");
	var id = id.replace("prog_","");
	var id = id.replace("pay_","");

	//var select_val = document.getElementById(id_tmp).value;
	var prio_id = "prio_"+id;
	var prio = document.getElementById(prio_id).value;
	var prog_id = "prog_"+id;
	var prog = document.getElementById(prog_id).value;	
	var pay_id = "pay_"+id;
	var pay = document.getElementById(pay_id).value;	


	switch(prio){
		case "E7101" : 
			$("#"+prio_id).css("background-color","white");
			$("#"+prio_id).css("color","black");
			break;
		case "E7102" : 
			$("#"+prio_id).css("background-color","#f0ee57");
			$("#"+prio_id).css("color","black");
		break;
		case "E7103" : 
			$("#"+prio_id).css("background-color","#fb9e24");
			$("#"+prio_id).css("color","white");
		break;
		case "E7104" : 
			$("#"+prio_id).css("background-color","#de2519");
			$("#"+prio_id).css("color","white");
		break;
		case "E7105" : 
			$("#"+prio_id).css("background-color","cornflowerblue");
			$("#"+prio_id).css("color","white");
		break;
		default:
			$("#"+prio_id).css("background-color","white");
			$("#"+prio_id).css("color","black");
	}


	//var stat = obj.value;

	var action = "upt_trans_opt";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,prio:prio,prog:prog, pay:pay},
		success:function(data){
			console.log(data);
			//alert("저장완료");
		}
	})

}

function go_view(id){
	//alert(id);
	
	var req = new Request();
	var userid="<?= $userid ?>";
	var s_option = req.getParameter("s_option");
	var g_option = req.getParameter("g_option");
	var s_date1 = req.getParameter("s_date1");
	var s_date2 = req.getParameter("s_date2");
	var s_str = unescape(req.getParameter("s_str"));

	if(userid =="1149"){
		window.location.href="view_trans.php?id="+id +"&s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&s_date1="+s_date1+"&s_date2="+s_date2;
	}else{
		window.location.href="view_trans.php?id="+id;
	}

}

$(document).ready(function(){

	var req = new Request();
	var s_option = req.getParameter("s_option");
	var s_date1 = req.getParameter("s_date1");
	var s_date2 = req.getParameter("s_date2");
	var g_option = req.getParameter("g_option");
	var s_str = unescape(req.getParameter("s_str"));
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
			case "mobile" : 	
				$('#s_option').val('mobile').attr('selected','selected');
				break;
			case "num" : 	
				$('#s_option').val('num').attr('selected','selected');
				break;
			case "etc" : 	
				$('#s_option').val('etc').attr('selected','selected');
				break;
			case "deadline" : 	
				$('#s_option').val('deadline').attr('selected','selected');
				$('#s_date1').val(s_date1);
				$('#s_date2').val(s_date2);
				$('#s_date').css("display","");
				break;
			case "rep_date" : 	
				$('#s_option').val('rep_date').attr('selected','selected');
				$('#s_date1').val(s_date1);
				$('#s_date2').val(s_date2);
				$('#s_date').css("display","");
				break;
			case "regdate" : 	
				$('#s_option').val('regdate').attr('selected','selected');
				$('#s_date1').val(s_date1);
				$('#s_date2').val(s_date2);
				$('#s_date').css("display","");
				break;
			//default : alert("error");
		}
	} 

	if (g_option != "") {
		$('#g_option').val(g_option).attr('selected','selected');
	}

	if (s_str != "") {
		$('#s_str').val(s_str);
	} 

		
	$('#btn_cancel').click(
		function(){
			window.location.href="?s_option=&g_option=&s_str=&s_date1=&s_date2=";
		}	
	);

	

	function checkit(){
		var s_option = $('#s_option').val();
		var g_option = $('#g_option').val();
		var s_date1 = $('#s_date1').val();
		var s_date2 = $('#s_date2').val();
		var s_str = $('#s_str').val();

		if(s_option !="" ){
			window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&s_date1="+s_date1+"&s_date2="+s_date2;
		}else{
			alert("검색 조건을 설정해주세요");
			if(s_option ==""){
				$('#s_option').focus();
			}else if(s_str ==""){
				$('#s_str').focus();
			}
		}
	}	
	
	
	$('#ele').focusout(function() {
	  $(this).addClass('hidden');
	});


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
			var s_date1 = $('#s_date1').val();
			var s_date2 = $('#s_date2').val();
			var s_str = $('#s_str').val();

			if(s_option !="" ){
				window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&s_date1="+s_date1+"&s_date2="+s_date2;	
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
			window.location.href="write_trans.php";
		});

	$('#excel').click(
	function() {
		var req = new Request();
		var page = req.getParameter("page");
			
		//var action = "select_excel";
		var s_option = $('#s_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		var s_date1 = $('#s_date1').val();
		var s_date2 = $('#s_date2').val();

		var first = "Y";
		var depth="<?= $depthid ?>";
		var userid="<?= $userid ?>";
		var depid="<?= $depid ?>";
		var go_url = "excel_down.php?s_option="+s_option+"&g_option="+g_option+"&s_str="+s_str+"&depth="+depth+"&userid="+userid+"&depid="+depid+"&s_date1="+s_date1+"&s_date2="+s_date2;

		window.open(go_url);


	});




	fetchUser();
	function fetchUser()
	{
		var req = new Request();
		var page = req.getParameter("page");
			
		var action = "select_trans_list";
		var s_option = $('#s_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		var s_date1 = $('#s_date1').val();
		var s_date2 = $('#s_date2').val();
		var first = "Y";
		var depth="<?= $depthid ?>";
		var userid="<?= $userid ?>";
		var depid="<?= $depid ?>";


		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,s_option:s_option,g_option:g_option,first:first, page:page,depth:depth,userid:userid,depid:depid,s_date1:s_date1,s_date2:s_date2},
			success:function(data){
				console.log(data);
				$('#result').html(data);
			}
		})

	}

	$('#g_option').on('change',function(){
		var g_option = $('#g_option').val();
		window.location.href="?s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&page="+page+"&s_date1="+s_date1+"&s_date2="+s_date2;
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


	//* 이름에 특수문자 제거 *//
	$("#s_option").on("change", function() {
		var sel_opt = $("#s_option").val();

		if(sel_opt == "deadline"||sel_opt == "rep_date"||sel_opt == "regdate"){
			$("#s_date").css("display","");
		}else{
			$("#s_date").css("display","none");
		}

    });




});

/* 담당세무사 로딩 */
function sel_owner(id,owner){
	
	if(id != "" && owner != ""){
		var obj = "#select_owner_"+id;
		$(obj).val(owner).attr("selected", "selected");
	}
	
}

/* 담당세무사 수정 */
function modify_owner(obj){
	
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("select_owner_","");
	var owner_id = "select_owner_"+id;
	var owner = document.getElementById(owner_id).value;

	if(id != ""){
		
		var action = "update_owner_user";
		
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id,owner:owner},
			success:function(data){
				//alert(data);
				//location.reload();
				console.log(data);
			}
		})
	}
}


function send_kakao(str){
	
	var id = str;
	var action = "action_tok_trans";

	$.ajax({
	//insert page로 위에서 받은 데이터를 넣어준다.
		url:"api/send_tok.php", 
		method:"POST",
		data:{id:id,action:action},
		success:function(data){
			console.log(data);

			if(data.indexOf("전송완료") >= 0 ){
				alert("정상적으로 알림톡이 발송되었습니다.");
			}
			//location.reload();				
		}
	});
}

</script>

</html>  