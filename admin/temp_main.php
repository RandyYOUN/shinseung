<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>신승세무법인 ADMIN</title>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/temp_common.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php
include "top.php";
?>
<div class="wrap">
		<div class="content">
			<div class="navi"></div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				<div class="search">
					<!--button type="button" name="new" id="new" class="b_newadd" style="cursor:pointer;">신규등록</button-->
				</div>
			</div>
			<div id="result" class="conwrap conleft">
				<!-- 퀵링크 -->
			</div>
			<div class="conwrap conright">
				<!-- <div id="result_1" class="conwrap conright"> -->
				<!-- 연락처 -->

				<div class="board" style="width: 800px;">
					<table style="width: 100%;">
						<tbody>
						
						
						<colgroup>
							<col style="width: 30px;">
							<col style="width: 30px;">
							<col style="width: 15px;">
							<col style="width: 50px;">
							<col style="width: 50px;">
						</colgroup>
						<thead>
							<tr>
								<th>부서명</th>
								<th>성명/직급</th>
								<th>내선</th>
								<th>대표번호</th>
								<th>핸드폰번호</th>
							</tr>
						</thead>
						<tr>
							<td>CH</td>
							<td>현성호 회장</td>
							<td>1101</td>
							<td>070-4870-0902</td>
							<td>010-3711-1107</td>
						</tr>
						<tr>
							<td>회계본부</td>
							<td>변기영 대표</td>
							<td>2101</td>
							<td>070-4870-0903</td>
							<td>010-4768-6752</td>
						</tr>
						<tr>
							<td>기장>용인</td>
							<td>마희숙 상무</td>
							<td>3001</td>
							<td>070-4870-0763</td>
							<td>010-9177-8835</td>
						</tr>
						<tr>
							<td>기장>안양</td>
							<td>오선미 이사</td>
							<td>3201</td>
							<td>070-4870-0914</td>
							<td>010-8831-8738</td>
						</tr>
						<tr>
							<td>기장>수원</td>
							<td>오미자 이사</td>
							<td>3401</td>
							<td>070-4870-7111</td>
							<td>010-9022-1640</td>
						</tr>
						<tr>
							<td>CH</td>
							<td>현성호 회장</td>
							<td>1101</td>
							<td>070-4870-0902</td>
							<td>010-3711-1107</td>
						</tr>
						<tr>
							<td>회계본부</td>
							<td>변기영 대표</td>
							<td>2101</td>
							<td>070-4870-0903</td>
							<td>010-4768-6752</td>
						</tr>
						<tr>
							<td>기장>용인</td>
							<td>마희숙 상무</td>
							<td>3001</td>
							<td>070-4870-0763</td>
							<td>010-9177-8835</td>
						</tr>
						<tr>
							<td>기장>안양</td>
							<td>오선미 이사</td>
							<td>3201</td>
							<td>070-4870-0914</td>
							<td>010-8831-8738</td>
						</tr>
						<tr>
							<td>기장>수원</td>
							<td>오미자 이사</td>
							<td>3401</td>
							<td>070-4870-7111</td>
							<td>010-9022-1640</td>
						</tr>
						<tr>
							<td>CH</td>
							<td>현성호 회장</td>
							<td>1101</td>
							<td>070-4870-0902</td>
							<td>010-3711-1107</td>
						</tr>
						<tr>
							<td>회계본부</td>
							<td>변기영 대표</td>
							<td>2101</td>
							<td>070-4870-0903</td>
							<td>010-4768-6752</td>
						</tr>
						<tr>
							<td>기장>용인</td>
							<td>마희숙 상무</td>
							<td>3001</td>
							<td>070-4870-0763</td>
							<td>010-9177-8835</td>
						</tr>
						<tr>
							<td>기장>안양</td>
							<td>오선미 이사</td>
							<td>3201</td>
							<td>070-4870-0914</td>
							<td>010-8831-8738</td>
						</tr>
						<tr>
							<td>기장>수원</td>
							<td>오미자 이사</td>
							<td>3401</td>
							<td>070-4870-7111</td>
							<td>010-9022-1640</td>
						</tr>
						</tbody>
					</table>
				</div>


			</div>
		</div>
	</div>
	<br>
	<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="page_flag" value="임시메인">

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
	var page_flag = document.getElementById("page_flag").value;
	top_menu(page_flag);

	fetchUser();
	function fetchUser()
	{

		var action = "select_link";
		var action_1 = "select_link_1";
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"temp_select_dev.php",
			method:"POST",
			data:{action:action},
			success:function(data){
				$('#result').html(data);
			}
		})

		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"temp_select_dev.php",
			method:"POST",
			data:{action_1:action_1},
			success:function(data){
				$('#result_1').html(data);
			}
		})


	}

});


</script>

</html>