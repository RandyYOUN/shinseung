<?php
include "top.php";

?>	
		<br><br><br><br><br><br><br><br><br>
		id : <input type="text" id="input_id" style="width:200px;height:30px;">
		pw : <input type="password" id="input_pw" style="width:200px;height:30px;">
		<button id="btn_submit" style="width:200px;height:30px;">전송</button>
		<div id = "icmAmt"></div>
		<div id = "etcIncAmtYn"></div>
	</body>
</html>
<script>


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

	$('#btn_submit').click(
			function() {
				var action = "select_json";

				var input_id = $("#input_id").val();
				var input_pw = $("#input_pw").val();
				var year = "2020";
				
				$.ajax({
					url:"../tilko/UnitTest/HomeTax_API_1.php",
					method:"POST",
					dataType:"json",
					data:{action:action,input_id:input_id, input_pw:input_pw,year:year},
					success:function(data){
						$('#icmAmt').html(data.icmAmt);
						$('#etcIncAmtYn').html(data.etcIncAmtYn);
					}
				})		
			}	
		);
	
});
</script>
