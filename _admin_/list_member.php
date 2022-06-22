
<?php
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
					<button type="button" name="new" id="new" class="b_newadd" style="cursor:pointer;">신규등록</button>
				</div>
				<div class="conwrap">
					<div class="board" style="width:1300px;">
						<table style="width:100%;">
							<tbody id="result">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
<br>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="page_flag" value="신승ADMIN 사용자리스트">

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

		var action = "select_memberlist";
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action},
			success:function(data){
				$('#result').html(data);
			}
		})


	}


	
	$(document).on('click','.b_newadd',function(){
		window.location.href="reg_member.php";
	});

});


</script>

</html>