	<div class="wrap">
<?php
include "top.php";


?>		

		<div class="content" style="width:1640px;">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				
				<div class="search">
    					<div class="selectbox w150p" >
    						<label for="">지점선택</label>
    						<select name="b_option" id ="b_option">
    							<option value="">지점선택</option>
    							<option value="D1003">강남</option>
    							<option value="D1004">용인</option>
    							<option value="D1006">안양</option>
    							<option value="D1007">수원</option>
    							<option value="D1008">일산</option>
    							<option value="D1009">부천</option>
    							<option value="D1010">광주</option>
    							<option value="D1011">분당</option>
    							<option value="D1012">기흥</option>
    							<option value="D1021">동탄</option>
    							<option value="D1013">세무</option>
    							<option value="D1014">영업</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w150p">
    						<label for="">선택</label>
    						<select name="g_option" id ="g_option">
    							<option value = "">검색조건</option>
    							<option value="CSTID">ID</option>
    							<option value="CSTNAME">이름</option>
    							<option value="MOBILE">핸드폰</option>
    							<option value="RESI">주민번호</option>
    							<option value="REGUSER">작성자</option>
    							<option value="MEMO">메모</option>
    						</select>
    					</div>
    					
    					<input type="box" style="height: 38px;" class="w300p" id="s_str" name="s_str">
    					<button class="b_search" id="btn_search" name="btn_search" style="cursor:pointer;">조회</button>
    					<button class="b_reset" id="btn_cancel" name="btn_cancel" style="cursor:pointer;">초기화</button>
    					<button class="b_newadd" style="background: #146cc5;color:white;cursor:pointer;" name="btn_cal" id="btn_cal">세액계산</button>
    					<button class="b_newadd" style="cursor:pointer;" name="btn_acc" id="btn_acc">입금확인</button>
    					<button class="b_newadd"  name="excel" id="excel" style="cursor:pointer;background-color:#426921;color:white;">엑셀다운</button>
    					
    					<DIV style="width: 400px;margin:-38px 0 10px 1215px;">
    						<button class="b_reset"  name="btn_simple" id="btn_simple" style="cursor:pointer;">간편안내</button>
    						<button class="b_reset"  name="btn_reg" id="btn_reg" style="cursor:pointer;">영업현황</button>
    						<button class="b_reset"  name="btn_acclist" id="btn_acclist" style="cursor:pointer;">접수현황</button>
    					</DIV>
				</div>

				<div class="board" style="width:100%;">
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


$page_set = 100; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


if($s_str !=""){
    switch($g_option){
        case "CSTID" :
            $query_str1 .= " AND A.CSTID like '%".$s_str."%' ";
            break;
        case "CSTNAME" :
            $query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
            break;
        case "MOBILE" :
            $query_str1 .= " AND A.MOBILE like '%".$s_str."%' ";
            break;
        case "RESI" :
            $query_str1 .= " AND A.RESIDENT_ID like '%".$s_str."%' ";
            break;
        case "REGUSER" :
            $query_str1 .= " AND D.USERNAME like '%".$s_str."%' ";
            break;
        case "MEMO" :
            $query_str1 .= " AND B.MEMO like '%".$s_str."%' ";
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
	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER            
    LEFT OUTER JOIN TB100032 AS E ON A.CSTID = E.CSTID          
	WHERE B.INF_PATH ='종소톡' AND B.CST_TYPE = 'A1001' ".$query_str1.$query_str2;


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
	<input type=hidden id="page_flag" value="종합소득세 간편안내">
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
		$('#btn_search').click();
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
			var page=1;

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




	$('#btn_acc').click(
		function() {
			window.open("list_acc.php");
		}	
	);


	$('#open_div').click(
			function() {
				
				$('#boardwrite').fadeIn(500).show();
				$('#open_div').fadeOut(500).hide();
				$('#close_div').fadeIn(500).show();
				$('#action').fadeIn(500).show();
			}	
		);

	$('#close_div').click(
			function() {
				$('#boardwrite').fadeOut(500).hide();
				$('#close_div').fadeOut(500).hide();
				$('#action').fadeOut(500).hide();
				$('#open_div').fadeIn(500).show();
			}	
		);


	$('#btn_newwrite').click(
			function() {
				window.location.href="write_inc_cst.php";
			}	
		);

	$('#btn_simple').click(
			function() {
				alert('현재 페이지입니다.');
				//window.location.href="write_inc_cst.php";
			}	
		);

	$('#btn_reg').click(
			function() {
				window.location.href="list_RPA_reg.php";
			}	
		);

	$('#btn_acclist').click(
			function() {
				window.location.href="list_RPA_acc.php";
			}	
		);


	$('#btn_cal').click(
			function() {
				window.location.href="write_cal.php";
			}	
		);

	
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
				var go_url = "excel_down_simple.php?s_option="+s_option+"&g_option="+g_option+"&s_str="+s_str+"&depth="+depth+"&userid="+userid+"&depid="+depid+"&s_date1="+s_date1+"&s_date2="+s_date2;

				window.open(go_url);


			});

	$('#btn_cancel').click(
		function() {
			var g_option = '';
			var b_option = '';
			var s_str = '';

			window.location.href="?b_option="+escape(b_option)+"&g_option="+g_option+"&s_str="+s_str+"&page="+page;
		}	
	);

});


/* 세액계산기 팝업 */
function open_cal(id){
	
	window.open("write_cal.php?id="+id);
}


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
	var id = id_tmp.replace("proc_","");
	id = id.replace("level_","");
	id = id.replace("reguser_","");
	id = id.replace("accck_","");
	id = id.replace("bran_","");

	if(id_tmp.indexOf("bran_")>=0){
		ch_branch(obj);
	}
	
	var proc_id = "proc_"+id;
	var bran_id = "bran_"+id;
	var reguser_id = "reguser_"+id;
	var acc_ck_id = "accck_"+id;
	var proc = document.getElementById(proc_id).value;
	var reguser = document.getElementById(reguser_id).value;
	var acc_ck = document.getElementById(acc_ck_id).value;
	var branch = document.getElementById(bran_id).value;
		
	var action = "upt_simple_inc_opt";

	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,proc:proc,reguser:reguser,acc_ck:acc_ck,branch:branch },
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

			if(data.RESIDENT_ID.indexOf('-')>0){
				var res = data.RESIDENT_ID.split('-');
				for(var i in res){
					$('#RESIDENT1').val(res[0]);
					$('#RESIDENT2').val(res[1]);
				}
			}else{
				var res = data.RESIDENT_ID.split('-');
				var len = res[0].length;
				if(len == 13){
					$('#RESIDENT1').val(res[0].substr(0,6));
					$('#RESIDENT2').val(res[0].substr(6));
					
				}
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




function send_kakao(flag,cstid,bizid, cstname){
	var tmp_flag="A1001";
	var userid = "<?php echo $userid?>";

	var branch=$("#bran_"+bizid).val();

	if(branch){
		if(flag=="self_1"){
			var yn = confirm("수동톡 1을 "+cstname+'님에게 발송하시겠습니까?');

			if(yn){
				
				var action = "Send_RPA_Reg_Self1";


				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"api/send_tok.php", 
					method:"POST",
					data:{cstid:cstid,bizid:bizid, action:action,tmp_flag:tmp_flag, userid:userid},
					//dataType:"json",
					success:function(data)
					{
						console.log(data);
						if(data.indexOf("send_ok")>=0){
							alert("전송완료");
							fetchUser();
						}else if(data.indexOf("error:abuse")>=0){
							alert("이미 알림톡이 발송된 사용자입니다.");
							fetchUser();
						}else{
							alert("에러가 발생했습니다. 관리자에게 문의하여주세요.");
							fetchUser();
						}
								
					}
				});
				
			}else{
				return false;
			}
		}else if(flag=="self_2"){
			var yn = confirm("수동톡 2을 "+cstname+'님에게 발송하시겠습니까?');

			if(yn){
				var action = "Send_RPA_Reg_Self2";

				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"api/send_tok.php", 
					method:"POST",
					data:{cstid:cstid,bizid:bizid, action:action,tmp_flag:tmp_flag, userid:userid},
					//dataType:"json",
					success:function(data)
					{
						console.log(data);
						if(data.indexOf("send_ok")>=0){
							alert("전송완료");
							fetchUser();
						}else if(data.indexOf("error:abuse")>=0){
							alert("이미 알림톡이 발송된 사용자입니다.");
							fetchUser();
						}else{
							alert("에러가 발생했습니다. 관리자에게 문의하여주세요.");
							fetchUser();
						}
								
					}
				});
			}else{
				return false;
				}
		} 
	}else{
		alert("지점을 선택하여 주세요.");
		$("#bran_"+bizid).focus();
	}
	
	
	
}



function ch_branch(obj){
	var id = $(obj).attr("id");
	var id_tmp = id.replace("bran_","");
	var branch = $("select#"+id+" option:selected").val();
	$("#reguser_"+id_tmp).empty();
	switch(branch){
	case "D1019" : 
		$("#reguser_"+id_tmp).append("<option value='1231'>신승01</option>");
		$("#reguser_"+id_tmp).append("<option value='1232'>신승02</option>");
		$("#reguser_"+id_tmp).append("<option value='1233'>신승03</option>");
		$("#reguser_"+id_tmp).append("<option value='1234'>신승04</option>");
		$("#reguser_"+id_tmp).append("<option value='1235'>신승05</option>");
		$("#reguser_"+id_tmp).append("<option value='1236'>신승06</option>");
		$("#reguser_"+id_tmp).append("<option value='1237'>신승07</option>");
		$("#reguser_"+id_tmp).append("<option value='1238'>신승08</option>");
		$("#reguser_"+id_tmp).append("<option value='1239'>신승09</option>");
		$("#reguser_"+id_tmp).append("<option value='1240'>신승10</option>");
		break;
	case "D1003" : 
		$("#reguser_"+id_tmp).append("<option value='1117'>마희숙</option>");
		$("#reguser_"+id_tmp).append("<option value='1131'>한예주</option>");
		$("#reguser_"+id_tmp).append("<option value='1132'>김지윤</option>");
		$("#reguser_"+id_tmp).append("<option value='1134'>용아름</option>");
		$("#reguser_"+id_tmp).append("<option value='1256'>김예빈</option>");
		$("#reguser_"+id_tmp).append("<option value='1241'>강남1</option>");
		$("#reguser_"+id_tmp).append("<option value='1242'>강남2</option>");
		$("#reguser_"+id_tmp).append("<option value='1243'>강남3</option>");
		$("#reguser_"+id_tmp).append("<option value='1244'>강남4</option>");
		$("#reguser_"+id_tmp).append("<option value='1245'>강남5</option>");
		$("#reguser_"+id_tmp).append("<option value='1246'>강남6</option>");
		$("#reguser_"+id_tmp).append("<option value='1247'>강남7</option>");
		break;
	case "D1002" : 
		$("#reguser_"+id_tmp).append("<option value='1148'>김용덕</option>");
		$("#reguser_"+id_tmp).append("<option value='1133'>이정희</option>");
		$("#reguser_"+id_tmp).append("<option value='1154'>김혜선</option>");
		$("#reguser_"+id_tmp).append("<option value='1248'>강설옥</option>");
		break;
	case "D1014" : 
		$("#reguser_"+id_tmp).append("<option value='1147'>노준석</option>");
		$("#reguser_"+id_tmp).append("<option value='1148'>이정민</option>");
		$("#reguser_"+id_tmp).append("<option value='1149'>윤형덕</option>");
		$("#reguser_"+id_tmp).append("<option value='1227'>김선진</option>");
		break;
	case "D1013" : 
		$("#reguser_"+id_tmp).append("<option value='1226'>김민</option>");
		$("#reguser_"+id_tmp).append("<option value='1228'>김규리</option>");
		$("#reguser_"+id_tmp).append("<option value='1249'>홍건호</option>");
		$("#reguser_"+id_tmp).append("<option value='1121'>최기정</option>");
		$("#reguser_"+id_tmp).append("<option value='1220'>이명진</option>");
		$("#reguser_"+id_tmp).append("<option value='1153'>김진규</option>");
		$("#reguser_"+id_tmp).append("<option value='1163'>한성민</option>");
		$("#reguser_"+id_tmp).append("<option value='1164'>한은진</option>");
		break;
	case "D1004" : 
		$("#reguser_"+id_tmp).append("<option value='1119'>오선미</option>");
		$("#reguser_"+id_tmp).append("<option value='1135'>노윤솔</option>");
		$("#reguser_"+id_tmp).append("<option value='1250'>김정아</option>");
		break;
	case "D1006" : 
		$("#reguser_"+id_tmp).append("<option value='1136'>김은정</option>");
		$("#reguser_"+id_tmp).append("<option value='1160'>박기령</option>");
		$("#reguser_"+id_tmp).append("<option value='1161'>김지영</option>");
		$("#reguser_"+id_tmp).append("<option value='1166'>안덕현</option>");
		break;
	case "D1007" : 
		$("#reguser_"+id_tmp).append("<option value='1116'>오미자</option>");
		$("#reguser_"+id_tmp).append("<option value='1257'>김세화</option>");
		$("#reguser_"+id_tmp).append("<option value='1251'>한지은</option>");
		break;
	case "D1008" : 
		$("#reguser_"+id_tmp).append("<option value='1120'>이찬희</option>");
		$("#reguser_"+id_tmp).append("<option value='1140'>김세아</option>");
		$("#reguser_"+id_tmp).append("<option value='1141'>강정민</option>");
		$("#reguser_"+id_tmp).append("<option value='1252'>김미경</option>");
		break;
	case "D1009" : 
		$("#reguser_"+id_tmp).append("<option value='1118'>신정희</option>");
		$("#reguser_"+id_tmp).append("<option value='1142'>양은경</option>");
		$("#reguser_"+id_tmp).append("<option value='1253'>신솔빈</option>");
		$("#reguser_"+id_tmp).append("<option value='1155'>장민경</option>");
		break;
	case "D1010" : 
		$("#reguser_"+id_tmp).append("<option value='1113'>이해옥</option>");
		$("#reguser_"+id_tmp).append("<option value='1144'>박혜진</option>");
		$("#reguser_"+id_tmp).append("<option value='1143'>염해림</option>");
		break;
	case "D1011" : 
		$("#reguser_"+id_tmp).append("<option value='1113'>이해옥</option>");
		$("#reguser_"+id_tmp).append("<option value='1158'>유수현</option>");
		$("#reguser_"+id_tmp).append("<option value='1145'>한세빈</option>");
		break;
	case "D1012" : 
		$("#reguser_"+id_tmp).append("<option value='1115'>한영순</option>");
		$("#reguser_"+id_tmp).append("<option value='1165'>강지혜</option>");
		$("#reguser_"+id_tmp).append("<option value='1255'>임봉규</option>");
		$("#reguser_"+id_tmp).append("<option value='1254'>한유정</option>");
		break;
	case "D1021" : 
		$("#reguser_"+id_tmp).append("<option value='1115'>정혜숙</option>");
		$("#reguser_"+id_tmp).append("<option value='1116'>오미자</option>");
		break;
	default:$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		break;
	}
	//modify_option(id);
}

function open_file_info(id){
	window.open("list_file_info.php?id="+id);
}

function fetchUser()
{

	var action = "select_list_simple";
	var b_option = $('#b_option').val();
	var g_option = $('#g_option').val();
	var s_str = $('#s_str').val();
	var cst_type = "A1001";//종합소득세
	var req = new Request();
	var page = req.getParameter("page");
	
	isloading.start();
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action,s_str:s_str,b_option:b_option,g_option:g_option, page:page,cst_type:cst_type},
		success:function(data){
			$('#result').html(data);
			isloading.stop();
		}
	})
}



</script>

</html>