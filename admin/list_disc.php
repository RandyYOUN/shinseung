<?php
include "top.php";

$checkArr = array(
    1227,
1136,
1264,
1147,
1117,
1112,
1118,
1116,
1119,
1149,
1130,
1120,
1113,
1198,
1114,
1121,
1115,
1111
);

//$userid = 9999;
if( ! in_array($userid, $checkArr) ){
?>
	<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title">관리자 권한이 없습니다.</h1>
			</div>
	</div>
<?php
}else{
?>		

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
							<option value="username" selected>이름</option>
							<option value="disc_type">유형</option>
						</select>
					</div>
					<input type="box" class="w200p" id="s_str" name="s_str" style="height: 26px;">
					<button class="b_search" id="btn_search" name="btn_search">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel">초기화</button>
					<button class="b_newadd"  name="new" id="new" style="background-color:#d83506e3;color:white;">신규테스트</button>
					<button class="b_newadd"  name="pop_layer" id="pop_layer" onclick="go_popup()" style="background-color:#f3ea1fe3;color:black;">알림톡발송</button>

					
				</div>



				<div class="board" style="width:1400px;">
					<table style="width:100%;">
						<tbody id="result">
						</tbody>
					</table>
				</div>

              <div id="popup" class="Pstyle">
            
              <span class="b-close">X</span>
            
              <div class="content" style="height: auto; width: auto;">
            	<div class="search">
            	   <input type="box" placeholder="이름" class="" id="name_kakao" name="s_str" style="height: 26px; margin: 0;"><br>
                   <input type="box" placeholder="핸드폰" class="" id="mobile_kakao" name="s_str" style="height: 26px; margin: 5px 0 0 0;"><br>
                   <button style="background-color:#f3ea1fe3;color:black;    width: 185px;    margin: 10px 0 0 0;    padding: 0;"  name="kakao_send" id="kakao_send" onclick="send_kakao_disc()" >발송</button>
            	</div>
                
              </div>


			</div>
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="page_flag" value="DISC체크">
	<input type="hidden" id="s_sort">
	<input type="hidden" id="s_flag">

</body>
<script src="js/jquery.bpopup.min.js"></script>
<style type="text/css">

.Pstyle {
 opacity: 0;
 display: none;
 position: relative;
 width: auto;
 border: 5px solid #fff;
 padding: 20px;
 background-color: #fff;
}

.b-close {
 position: absolute;
 right: 5px;
 top: 5px;
 padding: 5px;
 display: inline-block;
 cursor: pointer;
}
</style>

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

function go_popup() {
	   
    $('#popup').bPopup();
   
  };


function send_kakao_disc(){
	var name = $('#name_kakao').val();
	var mobile = $('#mobile_kakao').val();

	var action = "KAKAO_SEND_DISC_TESTER";

	if(confirm("알림톡을 발송하시겠습니까?") == true){
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"api/send_tok_v1.php", 
			method:"POST",
			data:{name:name,mobile:mobile,action:action},
			success:function(data){
				console.log(data);
				if(data.indexOf("전송완료") > -1){
					alert("알림톡이 발송되었습니다.");
					window.location.reload();
				}else{
					alert("오류가 발생했습니다. 관리자에게 문의하여 주세요.");
				}
				
			}
		});
	}	
}

$(document).ready(function(){

	var req = new Request();
	var s_option = req.getParameter("s_option");
	var s_str = req.getParameter("s_str");
	
	var page_flag = document.getElementById("page_flag").value;

	top_menu(page_flag);


	if (s_option != "") {
		switch (s_option)
		{
			case "username" : 	
				$('#s_option').val('username').attr('selected','selected');
				break;
			default : alert("error");
		}
	} 


	if (s_str != "") {
		$('#s_str').val(req.getParameter("s_str"));;
	} 

		
	$('#btn_cancel').click(
		function(){
			$("#s_option option:eq(1)").attr("selected","selected");
			$("#s_str").val('');
		}	
	);

	

	function checkit(){
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();

		if(s_option !="" ){
			window.location.href="?s_option="+s_option+"&s_str="+escape(s_str);		
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
			var s_str = $('#s_str').val();

			if(s_option !="" ){
				window.location.href="?s_option="+s_option+"&s_str="+escape(s_str);
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
			window.location.href="write_disc.php";
		});



	fetchUser();
	function fetchUser()
	{
		var req = new Request();
		var page = req.getParameter("page");

			
		var action = "select_disc_list";
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();

		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,s_option:s_option,page:page},
			success:function(data){
				$('#result').html(data);
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
		})

	}

});



</script>
<script>sort_onload();</script>

</html>

<?php 
}
?>