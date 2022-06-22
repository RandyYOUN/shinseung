<!DOCTYPE html>
<html>

</html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승세무법인 ADMIN</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
	<div class="wrap">
		<div class="topwrap">
			<div class="topline"></div>
			<div class="top">
				<div class="toplogo"><a href="main.html"><img src="images/logo.png"></a></div>
				<div class="gnbwrap">
					<ul>
						<li>
							<a>뉴스톡</a>
							<div>
								<ul>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a>병의원QnA</a>
							<div>
								<ul>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a>조정료계산</a>
							<div>
								<ul>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
									<li><a href="">User</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a>세무일정</a>
						</li>
						<li>
							<a>고객리스트's </a>
						</li>
						<li>
							<a>주택임대 </a>
						</li>
						<li>
							<a>종합소득세 신청 </a>
						</li>
						<li>
							<a>콜백리스트</a>
						</li>
						<li id="RPA">
							<a>RPA</a>
						</li>
						<li>
							<a>Dev</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				<div class="boardwrite">
					<table>
						<tbody>
							<tr>
								<th><span>종목명</span></td>
								<td>
									<input type="box" class="w50" name="S_NAME" id="S_NAME">
								</td>
								<th><span>매수단가</span></td>
								<td>
									<input type="box" class="w50" name="S_PRICE" id="S_PRICE">
								</td>
								</TR>
								<TR>
								
								<th><span>수량</span></td>
								<td>
									<input type="box" class="w50" name="S_EA" id="S_EA">
								</td>
								<th><span>매수/매도</span></td>
								<td>
									<select name="S_FLAG" id ="S_FLAG">
										<option VALUE="B" selected>매수</option>
										<option value="S">매도</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="btn w100">
					<button class="b_newadd"  name="action" id="action">신규추가</button>
					<!-- <button>삭제</button> -->
				</div>

				<div class="search">
					<input type="box" class="w200p" id="s_str" name="s_str">
					<button class="b_search" id="btn_search" name="btn_search">조회</button>
					
				</div>



				<div class="board">
					<table>
						<tbody id="result">
						</tbody>
					</table>
					<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
				</div>

				
			</div>
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="Stock">
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
		$('#b_option').val(b_option).attr('selected','selected');
	}
	
	if (g_option != "") {
		$('#g_option').val(g_option).attr('selected','selected');
	}

	if (s_str!= "") {
		$('#s_str').val(s_str);
	}






	fetchUser();
	function fetchUser()
	{

		var action = "select";
		var b_option = $('#b_option').val();
		var g_option = $('#g_option').val();
		var s_str = $('#s_str').val();
		var cst_type = "종합소득세";
		
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select_STOCK.php",
			method:"POST",
			data:{action:action,s_str:s_str,b_option:b_option,g_option:g_option, page:page,cst_type:cst_type},
			success:function(data){
				$('#b_option').val(b_option);
				$('#g_option').val(g_option)
				$('#result').html(data);
			}
		})
	}


		
	$('#b_option').on('change',function(){
		var b_option = $('#b_option').val();
		window.location.href="?g_option="+g_option+"&b_option="+escape(b_option)+"&s_str="+escape(s_str)+"&page="+page;
	});
	

	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var S_NAME = $('#S_NAME').val();
		var S_PRICE= $('#S_PRICE').val();
		var S_EA= $('#S_EA').val();
		var S_FLAG= $("#S_FLAG").val();

		var action = "등록";

		//성과 이름이 올바르게 입력이 되면
		
		if( S_NAME !="" && S_PRICE != "" && S_EA != "") {

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"select_STOCK.php", 
				method:"POST",
				data:{S_NAME:S_NAME,S_PRICE:S_PRICE,S_EA:S_EA, S_FLAG:S_FLAG ,action:action },
				success:function(data){
					alert("입력완료");
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
			window.location.href="?b_option="+b_option+"&g_option="+g_option+"&s_str="+s_str+"&page="+page;
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
				window.location.href="?b_option="+b_option+"&g_option="+g_option+"&s_str="+s_str+"&page="+page;
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





</script>

</html>