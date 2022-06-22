	<div class="wrap">
<?php
include "top.php";


?>		

		<div class="content" style="width:1760px;">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				

				<div class="search">
    					
    					<div class="selectbox w150p" >
    						<label for="">상담자선택</label>
    						<select name="my_list" id ="my_list">
    							<option value="all">상담자전체</option>
    							<option value="my" selected>MY</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="prog_option" id ="prog_option">
    							<option value="">진행상태-전체</option>
    							<option value="E7201">등록</option>
    							<option value="E7208">수임</option>
    							<option value="E7231">보류</option>
    							<option value="E7232">카톡</option>
    							<option value="E7204">부재</option>
    							<option value="E7209">환불</option>
    							
    						</select>
    					</div>
    					
    					
    					<div class="selectbox w150p" >
    						<label for="">유입채널</label>
    						<select name="inf_channel" id ="inf_channel">
    							<option value="">유입채널-전체</option>
    							<option value="ct">채널톡</option>
    							<option value="ph">전화</option>
    							<option value="cc">카톡채널</option>
    							<option value="etc">기타</option>
    						</select>
    					</div>
    					
    					
    					<!-- div class="selectbox w150p" >
    						<label for="">지점선택</label>
    						<select name="b_option" id ="b_option">
    							<option value="">지점선택</option>
    							<option value="D1019">세무톡</option>
    							<option value="D1003">강남</option>
    							<option value="D1002">회계본부</option>
    							<option value="D1014">영업본부</option>
    							<option value="D1013">세무본부</option>
    							<option value="D1004">용인</option>
    							<option value="D1006">안양</option>
    							<option value="D1007">수원</option>
    							<option value="D1008">일산</option>
    							<option value="D1009">부천</option>
    							<option value="D1010">광주</option>
    							<option value="D1011">분당</option>
    							<option value="D1012">기흥</option>
    							<option value="D1021">동탄</option>
    						</select>
    					</div-->
    					
    					<div class="selectbox w150p">
    						<label for="">선택</label>
    						<select name="g_option" id ="g_option">
    							<option value = "">검색조건</option>
    							<option value="ID">ID</option>
    							<option value="CSTNAME" selected>이름</option>
    							<option value="MOBILE">핸드폰</option>
    							<option value="RESI">주민번호</option>
    							<option value="REGUSER">상담자</option>
    							<option value="MEMO">메모</option>
    						</select>
    					</div>
    					
    					<input type="box" style="height: 38px;" class="w300p" id="s_str" name="s_str">
    					<button class="b_search" id="btn_search" name="btn_search" style="cursor:pointer;">조회</button>
    					<button class="b_reset" id="btn_cancel" name="btn_cancel" style="cursor:pointer;">초기화</button>
    					<button class="b_newadd" style="background: #146cc5;color:white;cursor:pointer;" name="btn_cal" id="btn_cal">세액계산</button>
    					<button class="b_newadd" style="cursor:pointer;" name="btn_acc" id="btn_acc">입금확인</button>
    					<button class="b_newadd"  name="excel" id="excel" style="cursor:pointer;background-color:#426921;color:white;">엑셀다운</button>
    					
    					<DIV style="width: 500px;margin:-40px 0 10px 1440px;">
    						<button class="b_reset"  name="btn_simple" id="btn_simple" style="cursor:pointer;">간편안내</button>
    						<button class="b_reset"  name="btn_reg" id="btn_reg" style="cursor:pointer;">영업현황</button>
    						<button class="b_reset"  name="btn_acclist" id="btn_acclist" style="cursor:pointer;">접수현황</button>
    					</DIV>
				</div>

				<div class="board">
					<table style="width:1720px;">
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
$prog_option = $_GET["prog_option"];
$inf_channel = unescape($_GET["inf_channel"]);
$my_list = unescape($_GET["my_list"]);
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";
$page = $_GET["page"];


$QUERY_STR = "&g_option=".$g_option."&prog_option=".$prog_option."&b_option=".$b_option."&s_str=".$_GET["s_str"]."&inf_channel=".$inf_channel."&my_list=".$my_list;


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

    if($prog_option != ""){
        $query_str_prog .= " AND PROGRESS = '".$prog_option."' ";
    }
    

	if($b_option != "" && $b_option != "undefined"){
		$query_str2 .= " AND REG_BRANCH = '".$b_option."' ";
	}
	
	
	if($inf_channel != ""){
	    $query_str3 .= " AND INF_CHANNEL = '".$inf_channel."' ";
	}
	
	if($my_list == "all"){
	    $query_str_my .= " ";
	}else{
	    $query_str_my .= " AND D.USERID = '".$userid."' ";
	}
	
	

$query = "SELECT count(1) as total 
FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON A.CSTID=C.CSTID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	LEFT OUTER JOIN TB300031 AS E ON A.CSTID=E.CSTID
    LEFT OUTER JOIN TB100026 AS F ON B.BIZ_ID = F.BIZ_ID
where B.CST_TYPE = 'A1001' AND B.INF_PATH='전문상담' 
AND B.CST_TYPE_YEAR = '2021' ".$query_str1.$query_str2.$query_str3.$query_str_prog.$query_str_my;


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
	<input type=hidden id="page_flag" value="전문상담">
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



var req = new Request();

$('#inf_channel').on('change',function(){
	//var inf_flag = "channeltok";
	var inf_channel = $('#inf_channel').val();
    var g_option = $('#g_option').val();
    var prog_option = $('#prog_option').val();
    var my_list = $('#my_list').val();

	var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
	window.location.href=newURL  + "?g_option="+$('#g_option').val()+ "&prog_option="+$('#prog_option').val()+"&b_option="+escape($('#b_option').val())+"&s_str="+escape($('#s_str').val())+"&inf_channel="+inf_channel+"&my_list="+my_list;
});


$('#prog_option').on('change',function(){
	var inf_channel = $('#inf_channel').val();
    var g_option = $('#g_option').val();
    var prog_option = $('#prog_option').val();
    var my_list = $('#my_list').val();

	var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
	window.location.href=newURL  + "?g_option="+$('#g_option').val()+ "&prog_option="+$('#prog_option').val()+"&b_option="+escape($('#b_option').val())+"&s_str="+escape($('#s_str').val())+"&inf_channel="+inf_channel+"&my_list="+my_list;
});


$('#my_list').on('change',function(){
	var inf_channel = $('#inf_channel').val();
    var g_option = $('#g_option').val();
    var prog_option = $('#prog_option').val();
    var my_list = $('#my_list').val();

	var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
	window.location.href=newURL  + "?g_option="+$('#g_option').val()+ "&prog_option="+$('#prog_option').val()+"&b_option="+escape($('#b_option').val())+"&s_str="+escape($('#s_str').val())+"&inf_channel="+inf_channel+"&my_list="+my_list;
});



$('#g_option').on('change',function(){
	var select = $('#g_option');

	for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
		var idxData = select.eq(i).children('option:selected').text();
		select.eq(i).siblings('label').text(idxData);
	}
});




$(document).ready(function(){

	var req = new Request();
	var b_option = req.getParameter("b_option");
	var g_option = req.getParameter("g_option");
	var prog_option = req.getParameter("prog_option");
	var inf_channel = unescape(req.getParameter("inf_channel"));
	var s_str = unescape(req.getParameter("s_str"));
	var page = req.getParameter("page");
	var page_flag = document.getElementById("page_flag").value;
	var my_list = req.getParameter("my_list");
	

	top_menu(page_flag);
	select_fn();
	

	
	if (s_str!= "") {
		$('#s_str').val(s_str);
	}


	fetchUser();
	function checkit(){
		var g_option = $('#g_option').val();
		var b_option = $('#b_option').val();
		var prog_option = req.getParameter("prog_option");
		var inf_channel = $('#inf_channel').val();
		var s_str = escape($('#s_str').val());
		var my_list = $('#my_list').val();

		if(g_option !="" && s_str !=""){
			window.location.href= "?g_option="+$('#g_option').val()+"&prog_option="+$('#prog_option').val()+"&b_option="+escape($('#b_option').val())+"&s_str="+escape($('#s_str').val())+"&inf_channel="+inf_channel+"&my_list="+my_list;
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
			checkit();
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
				window.open("write_cal.php");
			}	
		);

	
	$('#excel').click(
			function() {
				var req = new Request();
				var page = req.getParameter("page");
					
				var b_option = $('#b_option').val();
				var g_option = $('#g_option').val();
				var prog_option = $('#prog_option').val();
				var inf_channel = $('#inf_channel').val();
				
				var s_str = $('#s_str').val();
				var cst_type = "A1001";//종합소득세
				var userid = "<?=$userid;?>";
				var req = new Request();
				var page = req.getParameter("page");
				var my_list = req.getParameter("my_list");
				const urlParams = new URLSearchParams(window.location.href);

				if(!urlParams.has('my_list')){
					my_list = "my";
				}

				
				var userid="<?= $userid ?>";
				var go_url = "excel_down_pro.php?g_option="+$('#g_option').val()+"&prog_option="+$('#prog_option').val()+"&b_option="+escape($('#b_option').val())+"&s_str="+escape($('#s_str').val())+"&inf_channel="+escape($('#inf_channel').val())+"&my_list="+my_list+"&userid="+userid;

				window.open(go_url);


			});


	$('#btn_cancel').click(
		function() {
			var g_option = '';
			var prog_option="";
			var b_option = '';
			var inf_channel = '';
			var s_str = '';
			var my_list = '';

			window.location.href="?b_option="+escape(b_option)+"&prog_option="+$('#prog_option').val()+"&g_option="+g_option+"&s_str="+s_str+"&page="+page+"&inf_channel="+inf_channel+"&my_list="+my_list;
		}	
	);
		

});


function go_cal(){
	window.open("cal_simple_income.php");
	//alert('1');
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


function ch_branch(obj){
	var id = $(obj).attr("id");
	var id_tmp = id.replace("bran_","");
	var branch = $("select#"+id+" option:selected").val();
	$("#reguser_"+id_tmp).empty();
	switch(branch){
	case "D1019" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
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
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1114'>정혜숙</option>");
		$("#reguser_"+id_tmp).append("<option value='1117'>마희숙</option>");
		$("#reguser_"+id_tmp).append("<option value='1241'>강남1</option>");
		$("#reguser_"+id_tmp).append("<option value='1242'>강남2</option>");
		$("#reguser_"+id_tmp).append("<option value='1243'>강남3</option>");
		$("#reguser_"+id_tmp).append("<option value='1244'>강남4</option>");
		$("#reguser_"+id_tmp).append("<option value='1245'>강남5</option>");
		$("#reguser_"+id_tmp).append("<option value='1246'>강남6</option>");
		$("#reguser_"+id_tmp).append("<option value='1247'>강남7</option>");
		break;
	case "D1002" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1148'>김용덕</option>");
		$("#reguser_"+id_tmp).append("<option value='1133'>이정희</option>");
		$("#reguser_"+id_tmp).append("<option value='1154'>김혜선</option>");
		$("#reguser_"+id_tmp).append("<option value='1248'>강설옥</option>");
		break;
	case "D1014" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1147'>노준석</option>");
		$("#reguser_"+id_tmp).append("<option value='1148'>이정민</option>");
		$("#reguser_"+id_tmp).append("<option value='1149'>윤형덕</option>");
		$("#reguser_"+id_tmp).append("<option value='1227'>김선진</option>");
		break;
	case "D1013" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
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
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1119'>오선미</option>");
		$("#reguser_"+id_tmp).append("<option value='1135'>노윤솔</option>");
		$("#reguser_"+id_tmp).append("<option value='1250'>김정아</option>");
		break;
	case "D1006" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1136'>김은정</option>");
		$("#reguser_"+id_tmp).append("<option value='1160'>박기령</option>");
		$("#reguser_"+id_tmp).append("<option value='1161'>김지영</option>");
		$("#reguser_"+id_tmp).append("<option value='1166'>안덕현</option>");
		break;
	case "D1007" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1116'>오미자</option>");
		$("#reguser_"+id_tmp).append("<option value='1257'>김세화</option>");
		$("#reguser_"+id_tmp).append("<option value='1251'>한지은</option>");
		break;
	case "D1008" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1120'>이찬희</option>");
		$("#reguser_"+id_tmp).append("<option value='1140'>김세아</option>");
		$("#reguser_"+id_tmp).append("<option value='1141'>강정민</option>");
		$("#reguser_"+id_tmp).append("<option value='1252'>김미경</option>");
		break;
	case "D1009" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1118'>신정희</option>");
		$("#reguser_"+id_tmp).append("<option value='1142'>양은경</option>");
		$("#reguser_"+id_tmp).append("<option value='1253'>신솔빈</option>");
		$("#reguser_"+id_tmp).append("<option value='1155'>장민경</option>");
		break;
	case "D1010" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1113'>이해옥</option>");
		$("#reguser_"+id_tmp).append("<option value='1144'>박혜진</option>");
		$("#reguser_"+id_tmp).append("<option value='1143'>염해림</option>");
		break;
	case "D1011" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1113'>이해옥</option>");
		$("#reguser_"+id_tmp).append("<option value='1158'>유수현</option>");
		$("#reguser_"+id_tmp).append("<option value='1145'>한세빈</option>");
		break;
	case "D1012" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1114'>한영순</option>");
		$("#reguser_"+id_tmp).append("<option value='1165'>강지혜</option>");
		$("#reguser_"+id_tmp).append("<option value='1255'>임봉규</option>");
		$("#reguser_"+id_tmp).append("<option value='1254'>한유정</option>");
		break;
	case "D1021" : 
		$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		$("#reguser_"+id_tmp).append("<option value='1115'>정혜숙</option>");
		$("#reguser_"+id_tmp).append("<option value='1116'>오미자</option>");
		break;
	default:$("#reguser_"+id_tmp).append("<option value=''>선택</option>");
		break;
	}
	//modify_option(id);
}

//select 옵션 저장
function modify_option(obj){ 
	var id_tmp = $(obj).attr("id");

	if(id_tmp.indexOf("bran_")>=0){
		ch_branch(obj);
	}
	
	var id = id_tmp.replace("proc_","");
	id = id.replace("bran_","");
	id = id.replace("reguser_","");
	id = id.replace("est_fee_","");
	id = id.replace("inf_channel_","");
		
	var proc_id = "#proc_"+id;
	var bran_id = "#bran_"+id;
	var reguser_id = "#reguser_"+id;
	var est_fee_id = "#est_fee_"+id;
	var inf_channel_id = "#inf_channel_"+id;
	var proc = $(proc_id).val();
	var branch = $(bran_id).val();
	var reguser = $(reguser_id).val();
	var est_fee = $(est_fee_id ).val();
	var inf_channel = $(inf_channel_id ).val();
		
	var action = "upt_simple_inc_opt_pro";

	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,proc:proc,reguser:reguser,est_fee:est_fee, branch:branch, inf_channel:inf_channel},
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



function switch_comp2(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("pay_lbl_","");
	
	document.getElementById("pay_lbl_"+id).style.display = "none";
	document.getElementById("pay_ip_"+id).style.display = "block";
	document.getElementById("pay_ip_"+id).focus();
}

function uncomma(str) { 
	str = "" + str.replace(/,/gi, ''); 
	str = str.replace(/(^\s*)|(\s*$)/g, ""); 
	return (new Number(str));//문자열을 숫자로 반환 
}

function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



function removeChar(event) { 
	event = event || window.event; 
	var keyID = (event.which) ? event.which : event.keyCode; 
	if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 ) { 
		return; 
	} else { //숫자만 입력 
		event.target.value = event.target.value.replace(/[^0-9]/g, ""); 
	} 
}

function inputNumberFormat(obj) { 
	obj.value = comma(obj.value); 
}


function comma(obj) { 
	var regx = new RegExp(/(-?\d+)(\d{3})/); 
	var bExists = obj.indexOf(".", 0); 
	var strArr = obj.split('.'); 
	while (regx.test(strArr[0])) { 
		strArr[0] = strArr[0].replace(regx, "$1,$2"); 
	} 

	if (bExists > -1) { 
		obj = strArr[0] + "." + strArr[1]; 
	} else { 
		obj = strArr[0]; 
	} 

	return obj; 
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


function pay_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("pay_ip_","");
	var pay_id = "#pay_ip_"+id;

	var pay = uncomma($(pay_id).val());
	var action = "upt_pay_pro";

	if(event.keyCode==13){

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id,pay:pay},
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



function send_kakao_pro(cstid,bizid,mobile){
	var tmp_flag="A1001";
	var userid = "<?php echo $userid?>";
	var temp_id = $('#send_kakao_'+bizid).val();
	
	var yn = confirm("알림톡을 발송하시겠습니까?");

	if(yn){
		
		var action = "send_kakao_pro";

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"api/send_tok_v1.php", 
			method:"POST",
			data:{cstid:cstid,bizid:bizid, action:action,tmp_flag:tmp_flag,userid:userid, temp_id:temp_id, mobile:mobile},
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


function select_fn(){

	var req = new Request();
	var b_option = req.getParameter("b_option");
	var g_option = req.getParameter("g_option");
	var prog_option = req.getParameter("prog_option");
	var inf_channel = req.getParameter("inf_channel");
	var my_list = req.getParameter("my_list");
	var userid = "<?=$userid;?>";


	
	if (inf_channel != "") {
		$('#inf_channel').val(inf_channel).prop("selected",true);
		var select = $('#inf_channel');

		for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
			var idxData = select.eq(i).children('option:selected').text();
			select.eq(i).siblings('label').text(idxData);
		}
	}
	

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

	if (prog_option != "") {
		$('#prog_option ').val(prog_option ).prop("selected",true);

		var select = $('#prog_option ');

		for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
			var idxData = select.eq(i).children('option:selected').text();
			select.eq(i).siblings('label').text(idxData);
		}
	}
	

	if (userid != "") {
		$('#my_list').val(my_list).prop("selected",true);

		var select = $('#my_list');

		for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
			var idxData = select.eq(i).children('option:selected').text();
			select.eq(i).siblings('label').text(idxData);
		}
	}

	
}

function open_file_info(id){
	window.open("list_file_info.php?id="+id);
}

function open_file_pay(id){
	window.open("list_file_pay.php?id="+id);
}

function fetchUser()
{

	var action = "select_list_pro";
	var b_option = $('#b_option').val();
	var g_option = $('#g_option').val();
	var prog_option = $('#prog_option ').val();
	var inf_channel = $('#inf_channel').val();
	
	var s_str = $('#s_str').val();
	var cst_type = "A1001";//종합소득세
	var userid = "<?=$userid;?>";
	var req = new Request();
	var page = req.getParameter("page");
	var my_list = req.getParameter("my_list");
	const urlParams = new URLSearchParams(window.location.href);

	if(!urlParams.has('my_list')){
		my_list = "my";
		$('#my_list').val(my_list).prop("selected",true);

		var select = $('#my_list');

		for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
			var idxData = select.eq(i).children('option:selected').text();
			select.eq(i).siblings('label').text(idxData);
		}

	}
		
	
	isloading.start();
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action,s_str:s_str,b_option:b_option,g_option:g_option, page:page,cst_type:cst_type, inf_channel:inf_channel,my_list:my_list,userid:userid,prog_option:prog_option},
		success:function(data){
			$('#result').html(data);
			isloading.stop();

		}
	})
}
</script>

</html>