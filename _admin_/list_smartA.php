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

		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="page_flag" value="Smart A 멤버리스트">

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

		var action = "select_smartA";
				
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

});



	function memo_submit(obj){ // 메모저장

		var id_tmp = $(obj).attr("id");
		var id = id_tmp.replace("ip_","");
		var ip_id = "ip_"+id;
		var pw = document.getElementById(ip_id).value;
		var action = "select_smartA";
		var action2 = "등록";


		if(event.keyCode==13){

			$.ajax({
				url:"select.php",
				method:"POST",
				data:{action:action,id:id,pw:pw,action2:action2},
				success:function(data){
					//alert("저장완료");
					location.reload();
				}
			})
		}

	}



	function switch_comp(obj,flag){ // 메모란 클릭시 입력창 노출함수
		var id_tmp = $(obj).attr("id");
		var id = id_tmp.replace("lbl_","");
		var id = id.replace("pw_","");
		var id = id.replace("userid_","");
		var id = id.replace("username_","");

		if(flag == "pw"){			
			document.getElementById(id_tmp).style.display = "none";
			document.getElementById("ip_"+id).style.display = "block";
		}else if(flag == "userid"){
			document.getElementById(id_tmp).style.display = "none";
			document.getElementById("userid_"+id).style.display = "block";		
		}else if(flag == "username"){
			document.getElementById(id_tmp).style.display = "none";
			document.getElementById("username_"+id).style.display = "block";		
		}

		document.getElementById("ip_"+id).focus();
	}


	function select_insert(obj){ //지점 저장
		var id = $(obj).attr("id");	
		var id = id.replace("ip_","");
		var id = id.replace("bran_","");
		var id = id.replace("useryn_","");
		var id = id.replace("userid_","");
		var id = id.replace("username_","");


		var ip_id = "ip_"+id;
		var bran_id = "bran_"+id;
		var useryn_id = "useryn_"+id;
		var userid_id = "userid_"+id;
		var username_id = "username_"+id;

		var pw = document.getElementById(ip_id).value;
		var branch = document.getElementById(bran_id ).value;
		var useryn = document.getElementById(useryn_id ).value;
		var userid = document.getElementById(userid_id ).value;
		var username = document.getElementById(username_id ).value;
		var action = "update_smartA";

		$.ajax({
				url:"select.php",
				method:"POST",
				data:{username:username,userid:userid,action:action,id:id,pw:pw,branch:branch,useryn:useryn},
				success:function(data){
					//alert("저장완료");
					location.reload();
				}
			})
	}


	function del(id){ //지점 저장

		var pw = "";
		var branch = "";
		var useryn = "";
		var userid = "";
		var username = "";
		var action = "update_smartA";

		$.ajax({
				url:"select.php",
				method:"POST",
				data:{username:username,userid:userid,action:action,id:id,pw:pw,branch:branch,useryn:useryn},
				success:function(data){
					//alert("저장완료");
					location.reload();
				}
			})
	}

</script>

</html>