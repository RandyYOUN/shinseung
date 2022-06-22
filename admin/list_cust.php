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
				<div class="boardwrite" style="display:none;" id="boardwrite" name="boardwrite">
					<table>
						<tbody>
							<tr>
								<td>
									<h2><i>기본정보 스크래핑</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>ID</td>
								<td>
									<input type="box" class="w50" name="HomeTaxID" id="HomeTaxID">
								</td>
								<th>PW</td>
								<td>
									<input type="box" class="w50" name="HomeTaxPW" id="HomeTaxPW">
								</td>
							</tr>
							<tr>
								<td>
									<h2><i>안내문 출력</i><strong></strong></h2>
								</td>
								<th><span>지점</span></td>
								<td>
									<div class="selectbox s50">
										<label for="">지점선택</label>
										<select name="BRANCH" id ="BRANCH">
											<option value="D1003">강남</option>
                							<option value="D1004">용인</option>
                							<option value="D1006">안양</option>
                							<option value="D1007">수원</option>
                							<option value="D1008">일산</option>
                							<option value="D1009">부천</option>
                							<option value="D1010">광주</option>
                							<option value="D1011">분당</option>
                							<option value="D1012">기흥</option>
                							<option value="D1020">주택임대</option>
										</select>
									</div>
								</td>
								<th><span>주민번호</span></td>
								<td>
									<input type="box" class="w100p" name="RESIDENT1" id="RESIDENT1"><i>-</i>
									<input type="box" class="w100p" name="RESIDENT2" id="RESIDENT2">
								</td>
							</tr>
							<tr>
								<td rowspan="4">
									<h2><i>SmartA제작, 신고, 접수증&납부서 PDF 다운</i><br><strong></strong></h2>
								</td>
								<th><span>이름</span></td>
								<td>
									<input type="box" class="w50" name="CSTNAME" id="CSTNAME">
								</td>
								<th><span>서버</span></td>
								<td>
									<div class="selectbox s50">
										<label for="">서버선택</label>
										<select name="SERVER" id ="SERVER">
											<option selected="selected">선택</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<th><span>코드</span></td>
								<td>
									<input type="box" class="w50" name="SERVER_NUM" id="SERVER_NUM" >
								</td>
								<th>넘버링</td>
								<td>
									<input type="box" class="w50" name="NUMBERING" id="NUMBERING" >
								</td>
							</tr>
							<tr>
								<th>핸드폰</td>
								<td>
									<input type="box" class="w50" name="MOBILE" id="MOBILE">
								</td>
								<th>환급은행(선택) </td>
								<td>
									<div class="selectbox s50">
										<label for="">선택</label>
										<select name="REF_BANK" id ="REF_BANK">
											<option selected="selected">선택</option>
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
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<th>계좌(선택)</td>
								<td colspan="3">
									<input type="box" class="w50" name="REF_ACC" id="REF_ACC">
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="btn w100">
					<button style="cursor:pointer; display:none;" class="b_newadd"   name="action_mod" id="action_mod">수정저장</button>
					<button style="cursor:pointer; display:none;" class="b_newadd"   name="action" id="action">신규저장</button>
					<button style="cursor:pointer;" name="open_div" id="open_div">간편등록 열기</button>
					<button style="cursor:pointer; display:none;" name="close_div" id="close_div">닫기</button>
					
				</div>

				<div class="search">
					<div class="selectbox w150p">
						<label for="">선택</label>
						<select name="g_option" id ="g_option">
							<option value = "">검색조건</option>
							<option value="NUM">넘버링</option>
							<option value="NAME">이름</option>
							<option value="MOBILE">핸드폰</option>
							<option value="RESI">주민번호</option>
						</select>
					</div>
					<input type="box" class="w200p" id="s_str" name="s_str">
					<button class="b_search" id="btn_search" name="btn_search" style="cursor:pointer;">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel" style="cursor:pointer;">초기화</button>
					<button class="b_newadd" style="background: #146cc5;color:white;cursor:pointer;" name="acc" id="acc">계좌확인</button>
					<button style="cursor:pointer;" name="btn_newwrite" id="btn_newwrite">신규등록</button>

					<div class="selectboxR w150p" >
						<label for="">지점선택</label>
						<select name="b_option" id ="b_option">
							<option value="">지점선택</option>
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
					</div>
					
				
										
				</div>

				<div class="board">
					<table style="width:1610px;">
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
$query_desc = "ORDER BY CSTID DESC";

$page = $_GET["page"];


$QUERY_STR = "&g_option=".$g_option."&b_option=".$_GET["b_option"]."&s_str=".$_GET["s_str"];


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

$query = "SELECT count(1) as total 
FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON A.CSTID=C.CSTID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	LEFT OUTER JOIN TB300031 AS E ON A.CSTID=E.CSTID
where B.CST_TYPE = 'A1001'   ".$query_str1.$query_str2;


//$QUERY_STR = $query_str1.$query_str2;

/*
####### PHP VER 7.0 #######
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));

$row = mysqli_fetch_array($result);

$total = $row["total"]; // 전체글수

*/
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));

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
	<input type=hidden id="page_flag" value="전체고객리스트">
	<input type=hidden id="tmp_cstid" name="tmp_cstid">
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

		var action = "select_list_cust";
		var b_option = $('#b_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		var cst_type = "";
		var page = req.getParameter("page");
		
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,b_option:b_option,g_option:g_option, page:page,cst_type:cst_type},
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

	$('#g_option').on('change',function(){
		var select = $('#g_option');

		for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
			var idxData = select.eq(i).children('option:selected').text();
			select.eq(i).siblings('label').text(idxData);
		}
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



	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action_mod').click(function(){

		var request = new Request();
		var id = request.getParameter("id");
		var action = "action_inc_update";

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
		var cst_type='A1001';
		var cstid = $('#tmp_cstid').val();
		
		if(cstname !="" && mobile !="" && cstid != ""){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{action:action, cstid:cstid, numbering:numbering, cstname:cstname, mobile:mobile,
					resident1:resident1, resident2:resident2,ref_bank:ref_bank, ref_acc:ref_acc,branch:branch,
					server:server, server_num:server_num, hometaxid:hometaxid, hometaxpw:hometaxpw,
					cst_type:cst_type },
				success:function(data){
					alert(data);
					location.reload();
				}
			});

		}else{
			alert('필수값을 입력해주세요');
			if(cstname == ""){
				$('#cstname').focus();
			}
			if(mobile== ""){
				$('#mobile').focus();
			}
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




	$('#acc').click(
		function() {
			window.open("list_acc.php");
		}	
	);


	$('#open_div').click(
			function() {
				$('#boardwrite').css('display','');
				$('#open_div').css('display','none');
				$('#close_div').css('display','');
				$('#action').css('display','');

				
				
			}	
		);

	$('#close_div').click(
			function() {
				$('#boardwrite').css('display','none');
				$('#open_div').css('display','');
				$('#close_div').css('display','none');
				$('#action').css('display','none');
			}	
		);


	$('#btn_newwrite').click(
			function() {
				window.location.href="write_inc_cst.php";
			}	
		);

});



/* 처리담당자 로딩 */
function sel_owner(id,owner){
	
	if(id != "" && owner != ""){
		var obj = "#select_decuser_"+id;
		$(obj).val(owner).attr("selected", "selected");
	}
	
}

/* 처리담당자 수정 */
function modify_owner(obj){
	
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("select_decuser_","");
	var owner_id = "select_decuser_"+id;
	var owner = document.getElementById(owner_id).value;

	if(id != ""){
		
		var action = "update_decuser";
		
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id,owner:owner},
			success:function(data){
				console.log(data);
			}
		})
	}
}


//select 옵션 저장
function modify_option(obj){ 
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("bran_","");
	var id = id.replace("dz_svr_","");

	var bran_id = "bran_"+id;
	var bran = document.getElementById(bran_id).value;
	var dz_svr_id = "dz_svr_"+id;
	var dz_svr = document.getElementById(dz_svr_id).value;	
	var action = "upt_inc_opt";

	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,bran:bran,dz_svr:dz_svr},
		success:function(data){
			console.log(data);
		}
	})

}


function acc_check(id,cstname,est_fee){
	var action = "ck_acc";

	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,cstname:cstname,est_fee:est_fee},
		success:function(data){
			console.log(data);
			alert("업데이트완료");
			window.location.reload();
		}
	})
	
}

function switch_comp(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_lbl_","");

	document.getElementById("memo_lbl_"+id).style.display = "none";
	document.getElementById("memo_ip_"+id).style.display = "block";

	document.getElementById("memo_ip_"+id).focus();
}


function memo_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_ip_","");
	var memo_id = "memo_ip_"+id;

	var memo = document.getElementById(memo_id).value;
	var action = "upt_memo_inc";


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



function switch_dzcode(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("dzcode_lbl_","");

	document.getElementById("dzcode_lbl_"+id).style.display = "none";
	document.getElementById("dzcode_ip_"+id).style.display = "block";

	document.getElementById("dzcode_ip_"+id).focus();
}


function dzcode_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("dzcode_ip_","");
	var dzcode_id = "dzcode_ip_"+id;

	var dzcode = document.getElementById(dzcode_id).value;
	var action = "upt_dzcode_inc";


	if(event.keyCode==13){

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id,dzcode:dzcode},
			success:function(data){
				//alert(data);
				location.reload();
			}
		})
	}

}



function file_pop(id){
	window.open("list_file.php?id="+id,"_blank","toolbar=no,scrollbars=no,resizable=no,width=500,height=600");
}


function upt_subm(id){
	//var id = $(obj).attr("id");
	
	if(confirm("수임동의 RPA로 등록하시겠습니까?") == true){
		var action = "upt_subm";

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id},
			success:function(data){
				//alert(data);
				location.reload();
			}
		})
			
		}else{
			return;
		}
	}



function upt_confirm(id){
	//var id = $(obj).attr("id");
	var userid = "<?=$userid ?>";

	if(userid == "1149"){

		if(confirm("결제완료 처리하시겠습니까?") == true){
			var action = "upt_confirm";

			$.ajax({
				url:"action.php",
				method:"POST",
				data:{action:action,id:id,userid:userid},
				success:function(data){
					alert("결제처리되었습니다.");
					location.reload();
				}
			})
				
			}else{
				return;
			}

	}else{
		alert("결제가능한 계정이 아닙니다.");
		return;	
	}
	
}

function fn_mod(id){

	$('#boardwrite').css('display','');
	$('#open_div').css('display','none');
	$('#close_div').css('display','');
	$('#action').css('display','');

	var offset = $("#boardwrite").offset();
	var offset_fix= offset.top - 75;
	$("html body").animate({scrollTop:offset_fix},300);
	
	var action = "select_inc_cst";

	if(id != ""){
		$('#action_mod').css('display','');
		$('#action').css('display','none');
		$('#tmp_cstid').val(id);
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id, action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			var res = data.RESIDENT_ID.split('-');
			for(var i in res){
				$('#RESIDENT1').val(res[0]);
				$('#RESIDENT2').val(res[1]);
				}
			
			
			$('#HomeTaxID').val(data.HomeTaxID);
			$('#HomeTaxPW').val(data.HomeTaxPW);
			//$('#REG_BRANCH').val(data.REG_BRANCH);
			$("#BRANCH").val(data.REG_BRANCH).prop("selected", true);
			//$('#RESIDENT1').val(data.RESIDENT_ID);
			$('#MOBILE').val(data.MOBILE);
			$('#CSTNAME').val(data.CSTNAME);
			$('#SERVER').val(data.DOUZONE_SVR);
			$('#SERVER_NUM').val(data.DOUZONE_CODE);
			$('#REF_BANK').val(data.REF_BANK);
			$('#REF_ACC').val(data.REF_ACC);
			select_ck();

			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})	
	}
	
}



function select_ck(){
	var select = $('select');
    for (var i = 0; i < select.length; i++) {
        var idxData = select.eq(i).children('option:selected').text();
        select.eq(i).siblings('label').text(idxData);
    }
    select.change(function () {
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });
}


</script>

</html>