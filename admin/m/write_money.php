<!doctype html>
<html>

<head>
	<meta charset="utf-8">
    <title>혜바라기 가계부</title>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>	
	<link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/common.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">	
</head>
<body>
    <div class="loginWrap" style="background:none;">
        <section class="login" style="margin:0 0 0 25px;">
            <h1>가게부</h1>
            

            <span>
            	<input type="button" value="리스트" name="list" id="list" style="width: 100px;    padding: 5px;    margin:10px 0 15px 0;">
                <input type="radio"  id="type1" name="rdo1" value="type1" checked>
				<label id="lbl_type1">고정지출</label>
				<input type="radio"  id="type2" name="rdo1">
				<label id="lbl_type2">변동지출</label>
				<br><br>
				<div id="rdo2_display">
				<input type="radio"  id="type2-1" name="rdo2" value="A1015">
				<label id="lbl_type2-1">식비</label>
				<input type="radio"  id="type2-2" name="rdo2" value="A1016">
				<label id="lbl_type2-2">외식비</label>
				<input type="radio"  id="type2-3" name="rdo2" value="A1017">
				<label id="lbl_type2-3">생활품비</label>
				<br><br>
				</div>
				
				<input type="box" placeholder="사용처" name="use_text" id="use_text"><br><br>
				<label id="code_to_value" name="code_to_value" style="width:200px;height:50px;font-size:20px;"></label>
                 
				 <select id="pay_flag" style="height:50px;">
						<option value="card" selected>카드</option>
						<option value="cash">현금</option>
				 </select>
				 <input type="box" placeholder="금액" name="money" id="money" style="width:77%;">
                
                <input type="button" value="입력" name="login" id="login">
                <input type="hidden" value="" id="code_" name="code_">
            </span>            
            <ul>
                <li></li>
                <li></li>
            </ul> 
        </section>
        <h5 class="copyright">COPYRIGHT(c) MAISONDEJHD COPY RIGHT RESERVED</h5>  
    </div>
</body>

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

	$('#rdo2_display').css('display','none');

	$('#type1').click(function(){
		$('#rdo2_display').css('display','none');
	});

	$('#type2').click(function(){
		$("#type2").prop("checked", true);
		$('#rdo2_display').css('display','');
	});

	$('#lbl_type1').click(function(){
		$("#type1").prop("checked", true);
		$('#rdo2_display').css('display','none');
	});

	$('#lbl_type2').click(function(){
		$("#type2").prop("checked", true);
		$('#rdo2_display').css('display','');
	});

	$('#lbl_type2-1').click(function(){
		$("#type2-1").prop("checked", true);
	});
	$('#lbl_type2-2').click(function(){
		$("#type2-2").prop("checked", true);
	});
	$('#lbl_type2-3').click(function(){
		$("#type2-3").prop("checked", true);
	});



	$("#use_text").keyup(function() { 
		var use_text = $('#use_text').val();
		var action = "select_text_to_code";

		$.ajax({
			url:"../select.php",
			method:"POST",
			data:{use_text:use_text, action:action},
			dataType:"json",
			success:function(data){
				if(data.VALUE_ != "" && data.VALUE_ != undefined){
					$('#code_to_value').html(data.VALUE_);
					$('#code_').val(data.CODE_);
				}else{
					$('#code_to_value').html("");
					$('#code_').val("");
				}
			},
			error: function (request, status, error) {
				//alert('ERROR!\n [code]: '+request.status+"\n"+'[message]: '+request.responseText+"\n"+'[error]: '+error);
			}
		});
	});

		


	$('#login').click(function(){
		var request = new Request();
		var id = request.getParameter("id");
		
		var dept1="";
		var dept2="";


		if($("#type1").is(":checked")){ 
			dept = "type1";
		}else{
			dept = $(':radio[name="rdo2"]:checked').val();

		}

		var use_text = $('#use_text').val();
		var money = $('#money').val();
		var code_ = $('#code_').val();
		var pay_flag =$('#pay_flag').val();
		var action = "insert_money";


		if(use_text != ""  && money !=""){
			$.ajax({
				url:"../action.php",
				method:"POST",
				data:{use_text:use_text,money:money,action:action, id:id, dept, dept, code_:code_, pay_flag:pay_flag},
				success:function(data){
					if(data.indexOf("success") > -1){
						alert("입력완료");
						window.location.reload();
					}
						

				},
				error: function (request, status, error) {
					alert('ERROR!\n [code]: '+request.status+"\n"+'[message]: '+request.responseText+"\n"+'[error]: '+error);
				}
			});
		}else{
			alert("필수값을 입력해주세요.");
		}
	});



	$('#list').click(function(){
		window.location.href="list_money.php";
	});

});


</script>