<?PHP
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
				<div class="btn w100">
					
				</div>

				<div class="boardwrite">
					<table>
						<tbody>
							<tr>
								<td>
									<h2><i>고객 정보[알림톡 발송]</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>이름</td>
								<td>
									<input type="box" class="w50" name="CSTNAME" id="CSTNAME">
								</td>
								<th>핸드폰번호</td>
								<td>
									<input type="box" class="w50" name="MOBILE" id="MOBILE">
								</td>
							</tr>
							<tr>
								<td>
									<h2><i>기초 자료 스크랩핑[사업자 정보]</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>홈택스ID</td>
								<td>
									<input type="box" class="w50" name="HomeTaxID" id="HomeTaxID">
								</td>
								<th>홈택스PW</td>
								<td>
									<input type="box" class="w50" name="HomeTaxPW" id="HomeTaxPW">
								</td>
							</tr>
							<tr>
								<td>
									<h2><i>홈택스 수임동의</i></h2>
								</td>
								<th>주민등록번호</td>
								<td>
									<input type="box" class="w50" name="RESIDENT_ID" id="RESIDENT_ID">
								</td>
								<th>사업자등록번호</td>
								<td>
									<input type="box" class="w50" name="BIZ_ID_NUM" id="BIZ_ID_NUM">
								</td>
							</tr>
							<tr>
								<td>
									<h2><i>입금확인 & 영수증발급</i></h2>
								</td>
								<th>예정 수수료</td>
								<td>
									<input type="box" class="w50" name="EST_FEE" id="EST_FEE">
								</td>
								<th>영수증</td>
								<td>
									<label><input type="radio" name="CASH_REC" id="CASH_REC" value="c"> 현금영수증</label>
									<label><input type="radio" name="CASH_REC" id="CASH_REC" value="t"> 세금계산서</label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="btn w100">
					<button class=""  name="action_cancel" id="action_cancel">입력 취소</button>
					<button class="b_newadd"  name="action" id="action">간편등록</button>
					<button class="b_newadd"  name="action_insert_new" id="action_insert_new">상세 등록</button>
					<!-- <button>삭제</button> -->
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
					<button class="b_search" id="btn_search" name="btn_search">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel">초기화</button>

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



				<div class="board" style="width:1370px;">
					<table style="width:1440px;">
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
$query_desc = "ORDER BY A.CSTID DESC";

$page = $_GET["page"];


$QUERY_STR = "&g_option=".$g_option."&b_option=".$_GET["b_option"]."&s_str=".$_GET["s_str"];


$page_set = 20; // 한페이지 줄수
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

$query = "SELECT count(1) as total FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID where CST_TYPE = 'A1002'   ".$query_str1.$query_str2;


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
	<input type=hidden id="page_flag" value="RPA 부가세">
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

		var action = "select_RPA";
		var b_option = $('#b_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		var cst_type = "A1002";//종합소득세
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
		var cstname= $('#CSTNAME').val();
		var mobile= $('#MOBILE').val();
		var hometaxid = $('#HomeTaxID').val();
		var hometaxpw = $('#HomeTaxPW').val();

		var resident_id = $('#RESIDENT_ID').val().replace(/-/gi, "");
		var biz_id_num = $('#BIZ_ID_NUM').val();

		var cash_rec = $(":input:radio[name=CASH_REC]:checked").val();
		var est_fee = $('#EST_FEE').val();
		var cst_type ="A1002";
		var inf_path = "간편입력";

		var action = "action_vat_simple_ins";

		//성과 이름이 올바르게 입력이 되면
		
		if(cstname != "" && mobile !="" ) {

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{action:action,cstname:cstname, mobile:mobile,hometaxid:hometaxid,hometaxpw:hometaxpw, resident_id:resident_id,biz_id_num:biz_id_num,cash_rec:cash_rec,est_fee:est_fee,cst_type:cst_type,inf_path:inf_path},
				success:function(data){
					//alert(data);
					if(data.CSTID !=""){
						alert('등록되었습니다.');
						location.reload();
					}
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


	$('#action_insert_new').click(
		function() {
			window.location.href="write_vat_cst.php";
		}	
	);



});



function send_kakao(str){
	
	var id = str;
	var action = "action_admin_vatRPA_tok";

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