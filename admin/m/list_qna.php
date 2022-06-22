<?php
   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 ADMIN</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="신승세무법인 ADMIN">
	<meta property="og:url" content="https://taxtok.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="resources/images/sum2.png">
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
<script type="text/javascript" src="../news/se2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
-->
<!-- Bootstrap -->



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border-radius:5px;
margin-top:100px;


}

</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>



</head>
<body>
<form method="post" onsubmit="return checkit()">

<div class="container box">
<span>
<img src="resources/images/new_logo.png">
</span>
<br><br>
<div>
	<span >
		<a href="https://taxtok.kr/admin/list.php">&nbsp;[뉴스톡]&nbsp;</a>
	</span>
	
	<span style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_qna.php">&nbsp;<B>[병의원QnA]</B>&nbsp;</a>
	</span>
	
	<span >
		<a href="https://taxtok.kr/admin/list_cal.php">&nbsp;[조정료계산]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_date.php">&nbsp;[세무일정]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_cst.php">&nbsp;[고객리스트's]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_home.php">&nbsp;[주택임대]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_income.php">&nbsp;[종합소득세 신청]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_callback.php">&nbsp;[콜백리스트]&nbsp;</a>
	</span>
	<span style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_RPA_income.php">&nbsp;<b>[RPA_종소세]</b>&nbsp;</a>
	</span>
	<span style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_RPA_vat.php">&nbsp;<b>[RPA_부가세]</b>&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_dev.php">&nbsp;[Dev]&nbsp;</a>
	</span>
</div>
<br>
<br>

<select name="s_option" id ="s_option" class="form-control" style="width:120px;display:table-cell;">
	<option value="" selected>선택</option>
	<option value="cstname">이름</option>
	<option value="phone">핸드폰</option>
	<option value="email">Email</option>
	<option value="contents">내용</option>
</select>
<input type = "text" style="width:300px;height:34px;" id="s_str" name="s_str"></input>
<input type = "text" style="width:300px;height:34px;display:none;" id="s_str2" name="s_str2"></input>
<input type="button" value="검색" id="btn_search" name="btn_search" style="height:34px;">
<br><br>
<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<div id="result" class="table-responsive">
</div>
<br/><br/><br/><br/><br/><br/> 
</div>
</form>
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

	var req = new Request();
	var s_option = req.getParameter("s_option");
	var s_str = req.getParameter("s_str");


	if (s_option != "") {
		switch (s_option)
		{
			case "cstname" : 	
				$('#s_option').val('cstname').attr('selected','selected');
				break;
			case "phone" : 		
				$('#s_option').val('phone').attr('selected','selected');
				break;
			case "email" : 						
				$('#s_option').val('email').attr('selected','selected');
				break;
			case "contents" : 	
				$('#s_option').val('contents').attr('selected','selected');
				break;
			default : alert("error");
		}
	} 

	if (req.getParameter("s_str") != "") {
		$('#s_str').val(req.getParameter("s_str"));;
	} 




//$('#btn_search').click(
	function checkit(){
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();

		if(s_option !="" && s_str !=""){
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

			if(s_option !="" && s_str !=""){
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

	fetchUser();
	function fetchUser()
	{

		var action = "select";
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();

		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select_qna.php",
			method:"POST",
			data:{action:action,s_str:s_str,s_option:s_option},
			success:function(data){
				$('#cstname').val('');
				//$('#news_regdate').val('');
				$('#phone').val('');
				$('#email').val('');
				$('#contents').val('');
				$('#result').html(data);
				var modi_contents = "";
				$('#summernote').summernote('code', modi_contents);
			}
		})


	}


		//[4]삭제 버튼을 클릭했을 때 작동되는 함수
		$(document).on('click','.delete',function(){

			var id = $(this).attr("id");

			if(confirm("삭제 하시겠습니까?"))
			{
			//구분자
			var action = "delete";
				$.ajax({
					url:"action_qna.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data){
						//리스트 다시 조회
						fetchUser();
						alert(data);
					}
				});
			}else
			{
				return false;
			}

		});


	});



	//[*]수정 버튼을 클릭했을 때 작동되는 함수
	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		window.open("modify_qna.php?id="+id);
	});


		

</script>


</body>
</html>